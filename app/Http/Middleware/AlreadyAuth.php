<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyAuth
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
        if(session()->has('LoginId') && session()->has('Verified') && (url('Login')==$request->url() || url('LoginUser')==$request->url()|| url('VerifyOTP')==$request->url() || url('AuthMail')==$request->url())){
            return back();
        }
        return $next($request);
    }
}
