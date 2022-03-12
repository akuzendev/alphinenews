<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
                //return $next($request);

                if (!Auth::check()) {
                    return redirect()->route('login');
                }


                if (Auth::user()->role === array_search('ADMIN',config('enum.userdesignation'))) {
                    return redirect()->route('adminadmindashboard');
                }


                if (Auth::user()->role === array_search('USER',config('enum.userdesignation'))) {
                    return $next($request);
                }


                if (Auth::user()->role === array_search('WRITER',config('enum.userdesignation'))) {
                    return redirect()->route('writerwriterdashboard');
                }
    }
}
