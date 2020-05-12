<?php

namespace App\Http\Middleware;

use Closure;

class ValidateURLSeoSearch
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

        if ($request->category == "buy-cattle-online") {
            return $next($request);
        }
        else if ($request->category == "buy-a-horse-online") {
            return $next($request);
        }
        else if ($request->category == "buy-sheep-online") {
            return $next($request);
        }
        else if ($request->category == "buy-goat-online") {
            return $next($request);
        }
        else if ($request->category == "buy-pig-online") {
            return $next($request);
        }
        else if ($request->category == "online-pet-classifleds") {
            return $next($request);
        }


        return response()->view('errors.404', [], 404);
    }
}
