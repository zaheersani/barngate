<?php

namespace App\Http\Middleware;

use Closure;

//Moderl
use App\User;
use App\ChatRoom;

use DB;

class CheckChatId
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
        //VALIDAMOS SI EL PARAMETRO EXISTE
        if ($request->user_id == null || $request->user_id == false) {
            return response()->view('errors.404', [], 404);
        }

        //VERIFICAMOS EL REQUES SI TIENE YA LA SALA CREADA
        $sala   =  DB::table("chats_rooms")->where([
                        ["user_id", auth()->user()->user_id],
                        ["token_chat", $request->user_id],
                    ])
                    ->orWhere([
                        ["user_two_id", auth()->user()->user_id],
                        ["token_chat", $request->user_id],
                    ])->first();

        if ($sala == null) {

            //SI EL REQUEST NO TIENE LA SALA, VAMOS A CREEAR UNA

            $user_name  = base64_decode($request->user_id);
            $user       = User::where("username", $user_name)->first();

            //VALIDAMOS SI EL USUARIO EXISTE
            if ($user == null) {
                return response()->view('errors.404', [], 404);
            }


            //SI EXISTE VAMOS A CREEAR UNA SALA
            //VERIFICAR SI YA EXISTE SALA ENTRE ESTOS 2 USUARIOS

            $SalaExist = DB::table("chats_rooms")->where([
                            ["user_id", $user->user_id],
                            ["user_two_id", auth()->user()->user_id]
                        ])
                        ->orWhere([
                            ["user_id", auth()->user()->user_id],
                            ["user_two_id", $user->user_id]
                        ])->first();

            if ($SalaExist == null) {

                DB::beginTransaction();
                $token      = $this->token_chat($user->user_id, auth()->user()->user_id);
                $ChatRoom   = new ChatRoom();

                $ChatRoom->token_chat      = $token;
                $ChatRoom->user_id         = auth()->user()->user_id;
                $ChatRoom->user_two_id     = $user->user_id;
                
                if ( !$ChatRoom->save() ) {
                    DB::rollback();
                    return response()->view('errors.404', [], 404);
                }

                //UNA VEZ CREADA LA SALA REDIRECCIONAMOS A LA MIMS URL
                DB::commit();
                return redirect()->route("chat.index", $token);
                //return $next($request);
            }

             //SI LA SALA YA EXISTE REDIRECCIONAMOS A LA MISMA URL
            return redirect()->route("chat.index", $SalaExist->token_chat);
        }


        //VERIFICAMOS LAS NOTIFICACIONES DE EL CHAT
        $chat_room = DB::table("chats_rooms")->where("token_chat", $request->user_id)->first();
        $otroU = ($chat_room->user_id == auth()->user()->user_id) ? $chat_room->user_two_id : $chat_room->user_id;


        DB::table("notifications")
                ->where(["user_id" => auth()->user()->user_id, "other_user_id" => $otroU, "typo_notify_id" => 1])
                ->update(["read_notify" => 0]);


        return $next($request);
    }



    public function token_chat($user_id, $user_two_id)
    {
        return "MLMK=".base64_encode($user_id).base64_encode($user_two_id).time();
    }
}
