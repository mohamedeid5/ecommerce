<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // mobile phone must be verified
        if(Auth::guard()->check()) {

            if(auth()->user()->email_verified_at == null) {
                return redirect()->route('verification.code.show');
            }
        }

        return $next($request);
    }
}
