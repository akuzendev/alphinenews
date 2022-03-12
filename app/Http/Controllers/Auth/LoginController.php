<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers {
        logout as performLogout;
    }




    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('preventBackHistory');

    }




    public function redirectTo(){

        $admin = array_search('ADMIN', config('enum.userdesignation')); // ADMIN from config
        $writer = array_search('WRITER', config('enum.userdesignation')); //USER from config
        $user = array_search('USER', config('enum.userdesignation')); // USER from config


        switch(Auth::user()->role){
            case $admin:
            $this->redirectTo = route('admindashboard');
            return $this->redirectTo;
                break;
            case $writer:
                $this->redirectTo = route('writerwriterdashboard');
                return $this->redirectTo;
                break;
            case $user:
                $this->redirectTo = route('useruserhome');
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = 'login';
                return $this->redirectTo;
        }


    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('guestguesthome');
    }
}
