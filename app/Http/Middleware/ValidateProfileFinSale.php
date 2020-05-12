<?php

namespace App\Http\Middleware;

use Closure;

class ValidateProfileFinSale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->name == null || auth()->user()->phone == null ||
            auth()->user()->address == null || auth()->user()->cp_zip == null || auth()->user()->state == null) {
            return redirect()->route('myaccount')->with("myaccount", "profile_not_complete");
        }

        return $next($request);
    }
}
