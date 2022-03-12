<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminmw')->except('logout');
        $this->middleware('preventBackHistory');

    }

    public function index(){
        return view('admin.dashboard');
    }


    /*
    ********************************************************************************************
    USER LOGIC::
    ********************************************************************************************
    */

    public function users(){
        $users = User::all();

        return view('admin.users',[
            'users' => $users,
        ]);
    }

    public function getuser($uid){
        $user = User::where('id',$uid)->get();

        $userstatus =  array($user[0]['status']); //this returns the target user's status
        $status = config('enum.userstatus'); //this returns the key values in _enum file
        $us = $status[$userstatus[0]] ?? "<b class='text-danger'>Unknown User Status</b>"; //use null coalesence if value is undefined in enum.

        $userdesignation =  array($user[0]['role']); //this returns the target designation's status
        $designation = config('enum.userdesignation'); //this returns the key values in _enum file
        $ud = $designation[$userdesignation[0]] ?? "<b class='text-danger'>Unknown User Designation</b>"; //use null coalesence if value is undefined in enum.


        return view('admin.viewuser',[
            'user' => $user,
            'status' => $us,
            'role' => $ud,
        ]);
    }

    public function adduserform(){
        $designation = config('enum.userdesignation');
        $status = config('enum.userstatus');


        return view('admin.adduserform',[
            'designation' => $designation,
            'status' => $status,
        ]);
    }

    public function edituserform($uid){
        $user = User::where('id',$uid)->get();

        $userstatus =  array($user[0]['status']); //this returns the target designation's status
        $status = config('enum.userstatus'); //this returns the key values in _enum file
        $usname = $status[$userstatus[0]] ?? "<b class='text-danger'>Unknown User status</b>"; //use null coalesence if value is undefined in enum.
        $usid = array_keys($status, $usname, false);

        $userdesignation =  array($user[0]['role']); //this returns the target designation's status
        $designation = config('enum.userdesignation'); //this returns the key values in _enum file
        $udname = $designation[$userdesignation[0]] ?? "<b class='text-danger'>Unknown User Designation</b>"; //use null coalesence if value is undefined in enum.
        $udid = array_keys($designation, $udname, false);

        return view('admin.edituserform',[
            'user' => $user,
            'status' => $status,
            'designation' =>$designation,
            'usid' => $usid,
            'usname' => $usname,
            'udid' => $udid,
            'udname' => $udname
        ]);
    }

    public function addnewuser(Request $request){
        User::create([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect(route('adminusers'));
    }




    public function edituser(Request $request, $uid){
        User::where('id',$uid)->update([
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
        return redirect(route('adminusers'));
    }



    public function deleteuser($uid){
        User::destroy($uid);
        return redirect(route('adminusers'));
    }



    /*
    ********************************************************************************************
    ARTICLES LOGIC::
    ********************************************************************************************
    */


    public function articles(){
        $articles = Article::all();
        return view('admin.articles',[
            'articles' => $articles
        ]);
    }


    public function getarticle($aid){
        $article = Article::where('id',$aid)->get();

        $articlestatus =  array($article[0]['status']); //this returns the target user's status
        $status = config('enum.contentstatus'); //this returns the key values in _enum file
        $as = $status[$articlestatus[0]] ?? "<b class='text-danger'>Unknown Article Status</b>"; //use null coalesence if value is undefined in enum.

        $usercatergories =  array($article[0]['catergory']); //this returns the target user's status
        $status = config('enum.contentcatergory'); //this returns the key values in _enum file
        $ac = $status[$usercatergories[0]] ?? "<b class='text-danger'>Unknown User Status</b>"; //use null coalesence if value is undefined in enum.

        //dd($article);

        return view('admin.viewarticle',[
            'article' => $article,
            'as' => $as,
            'ac' => $ac,
        ]);
    }

    public function addarticleform(){
        $contentstatus = config('enum.contentstatus');
        $contentdesignation = config('enum.contentcatergory');

        return view('admin.addarticleform',[
            'status' => $contentstatus,
            'catergories' => $contentdesignation
        ]);
    }


    public function editarticleform($aid){
        $article = Article::where('id',$aid)->get();
        $approvedauthors = User::where('role',array_search('ADMIN',config('enum.userdesignation')))
            ->Where('status',array_search('ACTIVE',config('enum.userstatus')))
            ->orWhere('role',array_search('WRITER',config('enum.userdesignation')))
            ->get()->pluck('id', 'name');


        //array_search('ACTIVE',config('enum.userstatus'))
        //dd($approvedauthors);

        $articlestatus =  array($article[0]['status']); //this returns the target user's status
        $status = config('enum.contentstatus'); //this returns the key values in _enum file
        $as = $status[$articlestatus[0]] ?? "<b class='text-danger'>Unknown Article Status</b>"; //use null coalesence if value is undefined in enum.

        $articlecatergory =  array($article[0]['catergory']); //this returns the target designation's status
        $catergory = config('enum.contentcatergory'); //this returns the key values in _enum file
        $ad = $catergory[$articlecatergory[0]] ?? "<b class='text-danger'>Unknown Article Designation</b>"; //use null coalesence if value is undefined in enum.

        $currentauthor = User::where('id',$article[0]['byuserid'])->get();
        //dd($approvedauthors);

        return view('admin.editarticleform',[
            'article' => $article,
            'catergory' => $catergory,
            'status' => $status,
            'currentauthor' => $currentauthor,
            'approvedauthors' => $approvedauthors,
            'as' => $as,
            'ad' => $ad
        ]);


    }

    public function addarticle(Request $request){

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
        return redirect(route('adminarticles'));
    }

    public function editarticle(Request $request ,$aid){

        $updatearticle = Article::where('id',$aid)->get();

        $eaapprovedbyuser = $updatearticle[0]['approvedbyid'];
        $eaapproveddate = $updatearticle[0]['approveddate'];


        if($request->hasFile('thumbnail')) {
            $newthumbnail = time() . '-' . $request->title . '.' .$request->thumbnail->extension();
            $request->thumbnail->move(public_path('thumbnail'),$newthumbnail);


        Article::where('id',$aid)->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'catergory' => $request->input('catergory'),
            'status' => $request->input('status'),
            'thumbnail' => $newthumbnail,
            'byuserid' => $request->input('byuserid'),
            'content' => $request->input('content'),
            'date' => Carbon::parse($request->date)->setTimezone( config('app.timezone') )->format('Y-m-d h:i:s'),
            'authorizedbyid' => $eaapprovedbyuser,
            'authorizeddate' => $eaapproveddate,
        ]);

        // $updatearticle->update([
        //     'title' => $request->input('title'),
        //     'subtitle' => $request->input('subtitle'),
        //     'catergory' => $request->input('catergory'),
        //     'status' => $request->input('status'),
        //     'thumbnail' => $newthumbnail,
        //     'byuserid' => $request->input('byuserid'),
        //     'content' => $request->input('content'),
        //     'date' => $request->input('date'),
        // ]);

        return redirect(route('adminarticles'));

        }else{

            Article::where('id',$aid)->update([
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'catergory' => $request->input('catergory'),
                'status' => $request->input('status'),
                'thumbnail' => $updatearticle[0]['thumbnail'],
                'byuserid' => $request->input('byuserid'),
                'content' => $request->input('content'),
                'date' => Carbon::parse($request->input('date'))->setTimezone( config('app.timezone') )->format('Y-m-d\TH:i'),
                'authorizedbyid' => $eaapprovedbyuser,
                'authorizeddate' => $eaapproveddate,
            ]);

            return redirect(route('adminarticles'));
        }



       // return redirect(route('adminarticles'));
    }


    public function approvearticle($aid){
        Article::where('id',$aid)->update([
            'status' => array_search('LIVE',config('enum.contentstatus')),
            'authorizedbyid' => Auth::user()->id,
            'authorizeddate' => Carbon::now(),
        ]);

        return redirect(route('adminarticles'));
    }



    public function revokearticle($aid){
        Article::where('id',$aid)->update([
            'status' => array_search('PENDINGAPPROVAL',config('enum.contentstatus')),
            'authorizedbyid' => null,
            'authorizeddate' => null,
        ]);

        return redirect(route('adminarticles'));
    }

    public function deletearticle($aid){
        Article::destroy($aid);
        return redirect(route('adminarticles'));
    }


    /*
    ********************************************************************************************
    COMMENTS LOGIC::
    ********************************************************************************************
    */


    public function comments(){
        $comments = Comment::all();
        return view('admin.comments',[
            'comments' => $comments
        ]);
    }


    public function getcomment($cid){
        $comment = Comment::where('id',$cid)->get();

        $commentstatus =  array($comment[0]['status']); //this returns the target designation's status
        $status = config('enum.contentstatus'); //this returns the key values in _enum file
        $csname = $status[$commentstatus[0]] ?? "<b class='text-danger'>Unknown User status</b>"; //use null coalesence if value is undefined in enum.
        $csid = array_keys($status, $csname, false);


        //dd($csid,$csname);
        //$userstatus =  array($user[0]['status']); //this returns the target designation's status
        //$status = config('enum.userstatus'); //this returns the key values in _enum file
        //$usname = $status[$userstatus[0]] ?? "<b class='text-danger'>Unknown User status</b>"; //use null coalesence if value is undefined in enum.
        //$usid = array_keys($status, $usname, false);


        return view('admin.viewcomment',[
            'comment' => $comment,
            'status' => $csname,
            'csid' => $csid,
        ]);
    }


    public function addcommentform(){
        $catergories = config('enum.contentstatus');


        $approvedusers = User::where('role',array_search('ADMIN',config('enum.userdesignation')))
            ->Where('status',array_search('ACTIVE',config('enum.userstatus')))
            ->orWhere('role',array_search('WRITER',config('enum.userdesignation')))
            ->orWhere('role',array_search('USER',config('enum.userdesignation')))
            ->get()->pluck('id', 'name');

        $approvedarticles = Article::Where('status',array_search('LIVE',config('enum.contentstatus')))
            ->get()->pluck('id', 'title','subtitle');

        $status = config('enum.contentstatus');



        return view('admin.addcommentform',[
            'catergories' => $catergories,
            'status' => $status,
            'approvedusers' => $approvedusers,
            'approvedarticles' => $approvedarticles,
        ]);
    }


    public function editcommentform($cid){

        $comment = Comment::where('id',$cid)->get();

        $approvedusers = User::where('role',array_search('ADMIN',config('enum.userdesignation')))
            ->Where('status',array_search('ACTIVE',config('enum.userstatus')))
            ->orWhere('role',array_search('WRITER',config('enum.userdesignation')))
            ->orWhere('role',array_search('USER',config('enum.userdesignation')))
            ->get()->pluck('id', 'name');

        $approvedarticles = Article::Where('status',array_search('LIVE',config('enum.contentstatus')))
            ->get()->pluck('id', 'title','subtitle');

        $commentstatus =  array($comment[0]['status']); //this returns the target user's status
        $status = config('enum.contentstatus'); //this returns the key values in _enum file
        $cs = $status[$commentstatus[0]] ?? "<b class='text-danger'>Unknown Article Status</b>"; //use null coalesence if value is undefined in enum.


        $onarticleinfo =  array($comment[0]['onarticleid']); //this returns the target user's status
        $currentarticle = Article::where('id',$onarticleinfo)
            ->Where('status',array_search('LIVE',config('enum.contentstatus')))
            ->get()
            ->toArray();

        $onuserinfo = array($comment[0]['byuserid']);
        $currentuser = User::where('id',$onuserinfo)
            ->Where('status',array_search('ACTIVE',config('enum.userstatus')))
            ->get()
            ->toArray();




        return view('admin.editcommentform',[
            'comment' => $comment,
            'status' => $status,
            'cs' => $cs,

            'commentstatus' => $commentstatus,

            'currentuser' => $currentuser,
            'approvedusers' => $approvedusers,

            'currentarticle' => $currentarticle,
            'approvedarticles' => $approvedarticles,

        ]);
    }



    public function addcomment(Request $request){
        Comment::create([
            'content' =>$request->input('content'),
            'byuserid' =>$request->input('byuserid'),
            'onarticleid' => $request->input('onarticleid'),
            'status' => $request->input('status'),
            'date' => Carbon::parse($request->date)->setTimezone( config('app.timezone') )->format('Y-m-d h:i:s'),
            'authorizedbyid' => null,
            'authorizeddate' => null,
        ]);

        return redirect(route('admincomments'));

    }


    public function editcomment(Request $request, $cid){
        Comment::where('id',$cid)->update([
            'content' =>$request->input('content'),
            'byuserid' =>$request->input('byuserid'),
            'onarticleid' => $request->input('onarticleid'),
            'status' => $request->input('status'),
            'date' => Carbon::parse($request->input('date'))->setTimezone( config('app.timezone') )->format('Y-m-d h:i:s'),
            'authorizedbyid' => null,
            'authorizeddate' => null,
        ]);

        return redirect(route('admincomments'));
    }


    public function approvecomment($cid){
        Comment::where('id',$cid)->update([
            'status' => array_search('LIVE',config('enum.contentstatus')),
            'authorizedbyid' => Auth::user()->id,
            'authorizeddate' => Carbon::now(),
        ]);

        return redirect(route('admincomments'));


    }


    public function revokecomment($cid){
        Comment::where('id',$cid)->update([
            'status' => array_search('PENDINGAPPROVAL',config('enum.contentstatus')),
            'authorizedbyid' => null,
            'authorizeddate' => null,
        ]);

        return redirect(route('admincomments'));
    }


    public function deletecomment($cid){
        Comment::destroy($cid);
        return redirect(route('admincomments'));
    }









}
