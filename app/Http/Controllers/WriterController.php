<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class WriterController extends Controller
{

    public function __construct()
    {
        $this->middleware('writermw')->except('logout');
        $this->middleware('preventBackHistory');

    }

    public function index(){
        return view('writer.dashboard');
    }

    public function getyourarticles(){
        $currentuser = Auth::user()->id;
        $yourarticles = Article::where('byuserid',$currentuser)->get();

        return view('writer.articles',[
            'articles' => $yourarticles
        ]);
    }
    public function viewyourarticle($aid){
        $currentuser = Auth::user()->id;
        $yourarticles = Article::where('byuserid',$currentuser)->where('id',$aid)->get();

        $articlestatus =  array($yourarticles[0]['status']); //this returns the target user's status
        $status = config('enum.contentstatus'); //this returns the key values in _enum file
        $as = $status[$articlestatus[0]] ?? "<b class='text-danger'>Unknown Article Status</b>"; //use null coalesence if value is undefined in enum.

        $usercatergories =  array($yourarticles[0]['catergory']); //this returns the target user's status
        $status = config('enum.contentcatergory'); //this returns the key values in _enum file
        $ac = $status[$usercatergories[0]] ?? "<b class='text-danger'>Unknown User Status</b>"; //use null coalesence if value is undefined in enum.


        return view('writer.viewarticle',[
            'article' => $yourarticles,
            'ac' => $ac,
            'as' => $as
        ]);

    }
    public function addyourarticleform(){
        $contentdesignation = config('enum.contentcatergory');

        return view('writer.addarticle',[
            'catergories' => $contentdesignation,
        ]);
    }


    public function edityourarticleform($aid){
        $article = Article::where('id',$aid)->get();


        $articlecatergory =  array($article[0]['catergory']); //this returns the target designation's status
        $catergory = config('enum.contentcatergory'); //this returns the key values in _enum file
        $ad = $catergory[$articlecatergory[0]] ?? "<b class='text-danger'>Unknown Article Designation</b>"; //use null coalesence if value is undefined in enum.



        return view('writer.editarticle',[
            'article' => $article,
            'catergory' => $catergory,
            'ad' => $ad
        ]);
    }



    public function addyourarticle(Request $request){
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $newthumbnail = time() . '-' . $request->title . '.' .$request->thumbnail->extension();
        $request->thumbnail->move(public_path('thumbnail'),$newthumbnail);

        Article::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'catergory' => $request->input('catergory'),
            'status' => array_search('PENDINGAPPROVAL',config('enum.contentstatus')),
            'thumbnail' => $newthumbnail,
            'byuserid' => Auth::user()->id,
            'content' => $request->input('content'),
            'date' => $request->input('date'),
            'authorizedbyid' => null,
            'authorizeddate' => null,
        ]);
        return redirect(route('writergetyourarticles'));
    }

    public function edityourarticle(Request $request, $aid){
        $updatearticle = Article::where('id',$aid)->get();

        $eaapprovedbyuser = $updatearticle[0]['approvedbyid'];
        $eaapproveddate = $updatearticle[0]['approveddate'];
        $eastatus = $updatearticle[0]['status'];
        //dd(array_search('LIVE',config('enum.contentstatus')));




        if($request->hasFile('thumbnail')) {
            $newthumbnail = time() . '-' . $request->title . '.' .$request->thumbnail->extension();
            $request->thumbnail->move(public_path('thumbnail'),$newthumbnail);


        Article::where('id',$aid)->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'catergory' => $request->input('catergory'),
            'status' => $eastatus,
            'thumbnail' => $newthumbnail,
            'byuserid' => Auth::user()->id,
            'content' => $request->input('content'),
            'date' => Carbon::parse($request->date)->setTimezone( config('app.timezone') )->format('Y-m-d h:i:s'),
            'authorizedbyid' => $eaapprovedbyuser,
            'authorizeddate' => $eaapproveddate,
        ]);


        return redirect(route('writergetyourarticles'));

        }else{

            Article::where('id',$aid)->update([
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'catergory' => $request->input('catergory'),
                'status' => $eastatus,
                'thumbnail' => $updatearticle[0]['thumbnail'],
                'byuserid' => Auth::user()->id,
                'content' => $request->input('content'),
                'date' => Carbon::parse($request->input('date'))->setTimezone( config('app.timezone') )->format('Y-m-d\TH:i'),
                'authorizedbyid' => $eaapprovedbyuser,
                'authorizeddate' => $eaapproveddate,
            ]);

            return redirect(route('writergetyourarticles'));
        }
    }


    public function deleteyourarticle($aid){
        $currentuser = Auth::user()->id;
        $articletodelete = Article::where('id',$aid)->get()->toArray();

        if($articletodelete[0]['byuserid'] == $currentuser){
            Article::destroy($aid);
            return redirect(route('writergetyourarticles'));
        }else{
            Auth::logout();
            echo "Attempt to Delete Another person's Article. Exitting...";
        }


    }

}
