<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class ScoreReviewIds
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

        $username   = base64_decode($request->calificado_id);
        $sale_id    = $request->sale_id;
        $calificado = DB::table("users")->where("username", $username)->first();
        $sale       = DB::table("sales")->where("nickname", $sale_id)->first();

        if ($sale == null || $calificado == null) {
            return redirect()->route("myaccount");
        }

        $quealify = DB::table("ratings")
                        ->where('user_id', auth()->user()->user_id)
                        ->where('calificado_id', $calificado->user_id)
                        ->where('sale_id', $sale->sale_id)
                        ->where('rating', null)
                        ->first();

        if ($quealify == null) {
            return redirect()->route("myaccount");
        }

        return $next($request);
    }
}
