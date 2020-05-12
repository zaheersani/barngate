<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class RestringUpdateSale
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
        if (!$request->id) {
           return redirect()->route("myaccount");
        }

        $sale = DB::table("sales")->where("nickname", $request->id)->first();
        if ($sale == null) {
            return redirect()->route("myaccount");
        }

        if ($sale->user_id != auth()->user()->user_id) {
            return redirect()->route("myaccount");
        }

        if ($request->routeIs("sale.updateplan")) {
            
            if ($sale->plan_id == 3 || $sale->disabled == 1) {
                return redirect()->route("myaccount");
            }

        }

        return $next($request);
    }
}
