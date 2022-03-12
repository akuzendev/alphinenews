<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyStatus
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
        //$userstatus = Auth::user()->status; //=== array_search('ACTIVE',config('enum.userstatus'));


        if (!Auth::check()) {
            return redirect()->route('login');
            abort(404);
        }else if(Auth::user()->status === array_search('ACTIVE',config('enum.userstatus'))){
            return $next($request);
        }else if(Auth::user()->status === array_search('PENDING',config('enum.userstatus'))){
            Auth::logout();
            return redirect(route('guestaccountreview'));

        }else if(Auth::user()->status === array_search('BLOCKED',config('enum.userstatus'))){
            Auth::logout();
            return redirect(route('guestaccountblocked'));

        }else if(Auth::user()->status === array_search('TODELETED',config('enum.userstatus'))){
            Auth::logout();
            return redirect(route('guestaccountdeletion'));

        }else{
            Auth::logout();
            return redirect(route('guestguesthome'));

        }


        //return $next($request);
    }
}
