<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        //$userrole = Auth::user()->role;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //return redirect(RouteServiceProvider::HOME);
                $role = Auth::user()->role;

                $adminval = array_search('ADMIN',config('enum.userdesignation'));
                $writerval = array_search('WRITER',config('enum.userdesignation'));
                $userval = array_search('USER',config('enum.userdesignation'));


                switch ($role) {
                    case $adminval:
                       return redirect('/admin');
                       break;
                    case $writerval:
                       return redirect('/writer');
                       break;
                    case $userval:
                       return redirect('/user');
                       break;

                    default:
                       return redirect('/guest');
                       break;
                  }

                /*
                if (!Auth::check()) {
                    return redirect()->route('login');
                }else if (Auth::user()->role === array_search('ADMIN',config('enum.userdesignation'))) {
                    return redirect()->route('adminadmindashboard');
                }else if (Auth::user()->role === array_search('USER',config('enum.userdesignation'))) {
                    return redirect()->route('useruserhome');
                }else if (Auth::user()->role === array_search('WRITER',config('enum.userdesignation'))) {
                    return $next($request);
                }
                */


            }
        }

        return $next($request);
    }
}
