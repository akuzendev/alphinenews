<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('guest')
    ->as('guest')
    //->middleware('guest')
    ->controller(GuestController::class)
    ->group(function(){
            Route::get('','index')->name('guesthome');

            Route::get('account-set-deletion','accsettodeletion')->name('accountdeletion');
            Route::get('blocked','accblocked')->name('accountblocked');
            Route::get('under-review','accundereview')->name('accountreview');
            Route::get('catergories/{id}','showbycatergory')->name('showbycatergory');
            Route::get('article/{id}','showarticle')->name('showarticle');
            Route::get('login','showloginpage')->name('showloginpage');
            Route::get('register','showregisterpage')->name('showregisterpage');


});


Route::prefix('user')
    ->as('user')
    ->middleware('usermw')
    ->middleware('verifystatus')
    ->controller(UserController::class)
    ->group(function(){
            Route::get('','index')->name('userhome');

});


Route::prefix('writer')
    ->as('writer')
    ->middleware('writermw')
    ->middleware('verifystatus')
    ->controller(WriterController::class)
    ->group(function(){
            Route::get('','index')->name('writerdashboard');
            Route::get('/articles','getyourarticles')->name('getyourarticles');
            Route::get('/articles/{aid}','viewyourarticle')->name('viewyourarticle')->where('aid','[0-9+]');
            Route::get('/addarticle','addyourarticleform')->name('addyourarticleform');
            Route::get('/editarticle/{aid}','edityourarticleform')->name('edityourarticleform')->where('aid','[0-9+]');

            Route::post('/articles','addyourarticle')->name('addyourarticle');
            Route::put('/articles/{aid}','edityourarticle')->name('edityourarticle')->where('uid','[0-9+]');
            Route::delete('/articles/{aid}','deleteyourarticle')->name('deleteyourarticle')->where('uid','[0-9+]');

});


Route::prefix('admin')
    ->as('admin')
    ->middleware('adminmw')
    ->middleware('verifystatus')
    ->controller(AdminController::class)
    ->group(function(){
            Route::get('','index')->name('dashboard');

            Route::get('users','users')->name('users');
            Route::get('users/{uid}','getuser')->name('getuser')->where('uid','[0-9+]');
            Route::get('users/adduserform','adduserform')->name('adduserform');
            Route::get('users/edituser/{uid}','edituserform')->name('edituserform')->where('uid','[0-9+]');

            Route::post('users','addnewuser')->name('adduser');
            Route::put('users/{uid}','edituser')->name('edituser')->where('uid','[0-9+]');
            Route::delete('users/{uid}','deleteuser')->name('deleteuser')->where('uid','[0-9+]');



            Route::get('articles','articles')->name('articles');
            Route::get('articles/{aid}','getarticle')->name('getarticle')->where('aid','[0-9+]');
            Route::get('articles/addarticleform','addarticleform')->name('addarticleform');
            Route::get('articles/editarticle/{aid}','editarticleform')->name('editarticleform')->where('aid','[0-9+]');

            Route::post('articles','addarticle')->name('addarticle');

            Route::put('articles/{aid}','editarticle')->name('editarticle')->where('aid','[0-9+]');
            Route::put('articles/approve/{aid}','approvearticle')->name('approvearticle')->where('aid','[0-9+]');
            Route::put('articles/revoke/{aid}','revokearticle')->name('revokearticle')->where('aid','[0-9+]');

            Route::delete('articles/{aid}','deletearticle')->name('deletearticle')->where('aid','[0-9+]');



            Route::get('comments','comments')->name('comments');

            Route::get('comments','comments')->name('comments');
            Route::get('comments/{cid}','getcomment')->name('getcomment')->where('cid','[0-9+]');
            Route::get('comments/addcommentform','addcommentform')->name('addcommentform');
            Route::get('comments/editcomment/{cid}','editcommentform')->name('editcommentform')->where('cid','[0-9+]');

            Route::post('comments','addcomment')->name('addcomment');

            Route::put('comments/{cid}','editcomment')->name('editcomment')->where('cid','[0-9+]');
            Route::put('comments/approve/{cid}','approvecomment')->name('approvecomment')->where('cid','[0-9+]');
            Route::put('comments/revoke/{cid}','revokecomment')->name('revokecomment')->where('cid','[0-9+]');

            Route::delete('comments/{cid}','deletecomment')->name('deletecomment')->where('cid','[0-9+]');



});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
