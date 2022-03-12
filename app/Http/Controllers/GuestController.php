<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;


class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }

    public function index(){
        $catergories = config('enum.contentcatergory');


        $recentarticles = null;
        $list1 = null;
        $list2 = null;
        $list3 = null;

        return view('guest.home',[
            'catergories' => $catergories,
            'recentarticles' => $recentarticles,
            'list1' => $list1,
            'list2' => $list2,
            'list3' => $list3


        ]);
    }

    public function accsettodeletion(){
        return view('accountdel');
    }

    public function accblocked(){
        return view('blocked');
    }

    public function accundereview(){
        return view('reviewing');
    }

    public function showbycatergory($id){
        $catergories = config('enum.contentcatergory');

        $articlebycat = Article::Where('status',array_search('LIVE',config('enum.contentstatus')))
        ->where('catergory',$id)
        ->get(['id','title','subtitle','thumbnail','date','catergory','status']);

            $catergory = config('enum.contentcatergory'); //this returns the key values in _enum file
            $ac = $catergory[$id[0]] ?? "<b class='text-danger'>Unknown Article Catergory</b>"; //use null coalesence if value is undefined in enum.

        return view('guest.catergory',[
            'catergories' => $catergories,
            'articlebycat' => $articlebycat,
            'ac' => $ac,

        ]);

    }

    public function showarticle($id){
        $catergories = config('enum.contentcatergory');

        $article = Article::Where('id',$id)->where('status',array_search('LIVE',config('enum.contentstatus')))->get();

        $comments = array();
        $commentauthor = array();

        //dd($commentauthor);

        return view('guest.article',[
            'catergories' => $catergories,
            'article' => $article,
            'comments' => $comments,
            'commentauthor' => $commentauthor,
        ]);





        //dd($commentauthor);

    }

    public function showloginpage(){

    }

    public function showregisterpage(){

    }

}
