<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class RestrictedAccessExpired
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
        //dd($request->id);

        $animalprincipal = DB::table('sales')->where('nickname', $request->id)->first();

        if (!auth()->check()) {
            if ($animalprincipal->disabled == 0 && $animalprincipal->sold == 0) {
                return $next($request);
            }

            return redirect()->route("home");
        }

        if ( $animalprincipal->disabled == 0 && $animalprincipal->sold == 0 && $animalprincipal->user_id != auth()->user()->user_id) {
            return $next($request);
        }
        else if ( $animalprincipal->disabled == 1 && $animalprincipal->sold == 1 && $animalprincipal->user_id == auth()->user()->user_id ) {
            DB::table("notifications")->where(["sale_id" => $animalprincipal->sale_id, "user_id" => auth()->user()->user_id])->update(["read_notify" => 0]);
            return $next($request);
        }
        else if ( $animalprincipal->disabled == 0 && $animalprincipal->sold == 0 && $animalprincipal->user_id == auth()->user()->user_id ) {
            DB::table("notifications")->where(["sale_id" => $animalprincipal->sale_id, "user_id" => auth()->user()->user_id])->update(["read_notify" => 0]);
            return $next($request);
        }

        //return response()->json($animalprincipal->disabled);
        return redirect()->route("home");
    }
}
