<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class ValidateEditAnimal
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
        if ($request->id == null) {
            redirect()->back();
        }

        $sale = DB::table("sales")->where(["user_id" => auth()->user()->user_id, "nickname" => $request->id])->first();
        if ($sale == null) {
            redirect()->back();
        }
        
        return $next($request);
    }
}
