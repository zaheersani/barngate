<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\User;
use Pusher;
use DB;

class ChatController extends Controller
{
	function __construct()
	{
		$this->middleware("auth");
		$this->middleware("CheckChatId", ["only" => ["index"]]);
	}
    
    public function index(Request $request)
    {
    	$channel = $request->user_id;

    	//OBTENER LOS DATOS DEL USUARIO CON EL QUE CHATEA EL USUARIO DE LA SESSION ACTUAL
    	$user_client = DB::table("chats_rooms")->where("token_chat", $channel)->first();
    	if ($user_client->user_id == auth()->user()->user_id) {
    		$user_chat  = DB::table("users")->where("user_id", $user_client->user_two_id)->first();
            $usuario    = $user_client->user_two_id;
    	}
    	else {
    		$user_chat  = DB::table("users")->where("user_id", $user_client->user_id)->first();
            $usuario    = $user_client->user_id;
    	}

    	//MENSAJES DE CHAT
    	$msn_chat       = DB::table("messages")->where("chat_id", $user_client->chat_id)->get();
        $notificaciones = $this->getNotify();
        $promedio       = $this->getPromedio($usuario);

		return view("site.chat", compact("channel", "user_chat", "msn_chat", "notificaciones", "promedio"));

    }


    public function getPromedio($user_id)
    {
        $prom   = DB::table("ratings")->where("calificado_id", $user_id)->get();
        $calify = 0;
        $cont   = 0;
        $mypromedio = 0;
        if ($prom != null) {
            foreach ($prom as $key) {
                $calify += $key->rating;
                $cont++;
            }

            if ($calify != 0 && $cont != 0) {
               $mypromedio = floatval($calify) / floatval($cont);
            }
            return round($mypromedio);
        }

        return null;
    }


    public function getNotify()
    {
        if (auth()->check()) {
        
            $noti = DB::table("notifications")->where("user_id", auth()->user()->user_id)->limit(5)->orderBy("notify_id", "desc")->get();
            $i = 0;
            $arrNot = null;
            
            if ($noti != null) {        
                foreach ($noti as $notify) {
                    if ($notify->typo_notify_id == 1) {
                        $usuario                        = DB::table("users")->where("user_id", $notify->other_user_id)->first();

                        //OBTENER TOKEN DE CHAT
                        $_token = null;
                        $token = DB::table("chats_rooms")
                                        ->where("user_id", auth()->user()->user_id)
                                        ->where("user_two_id", $notify->other_user_id)
                                        ->orWhere("user_two_id", auth()->user()->user_id)
                                        ->where("user_id", $notify->other_user_id)
                                        ->first();


                        if ($token != null) {
                            $_token = $token->token_chat;
                        }

                        $arrNot[$i]["nombre_usuario"]   = $usuario->username;
                        $arrNot[$i]["img_user"]         = $usuario->urlImg;
                        $arrNot[$i]["typo_not"]         = $notify->typo_notify_id;
                        $arrNot[$i]["time"]             = $notify->created_at;
                        $arrNot[$i]["pending"]          = $notify->read_notify;
                        $arrNot[$i]["url"]              = $_token;
                    }
                    else if ($notify->typo_notify_id == 2 || $notify->typo_notify_id == 3) {
                        $sale_expire                    = DB::table("sales")
                                                                ->where("sale_id", $notify->sale_id)
                                                                ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                                                                ->select('sales.*', 'animals.name as animal_name')
                                                                ->first();

                        $arrNot[$i]["img"]              = $this->primerImagenProducto( $sale_expire->user_id, $sale_expire->animal_id, $sale_expire->sale_id );
                        $arrNot[$i]["sale_name"]        = $sale_expire->animal_name;
                        $arrNot[$i]["time"]             = $notify->created_at;
                        $arrNot[$i]["typo_not"]         = $notify->typo_notify_id;
                        $arrNot[$i]["pending"]          = $notify->read_notify;
                        $arrNot[$i]["url"]              = $sale_expire->nickname;
                    }

                    $i++;
                }
            }
            return $arrNot;
        }

        return null;
    }



    public function primerImagenProducto($usuario, $categoria, $producto)
    {
        $directory= base_path()."/storage/app/public/images/".$usuario."/".$categoria."/".$producto;
        if (is_dir($directory)) {
            $dirint = dir($directory);
            $primero = "";

            while (($archivo = $dirint->read()) !== false)
            {
                if (preg_match("{gif}", $archivo) || preg_match("{jpeg}", $archivo) || preg_match("{png}", $archivo) || preg_match("{jpg}", $archivo) || preg_match("{webp}", $archivo)){
                    $primero = $archivo;
                    break;
                }
            }
            $dirint->close();


            return $usuario."/".$categoria."/".$producto."/".$primero;
        }
       
        return false;
    }


    public function messagesChat(Request $request)
    {
    	if (!$request->has("message") || !$request->has("canal") || !$request->has("socket_id")) {
    		return response()->json(["message" => "error"], 202);
    	}

    	date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d H:i:s', time());

    	$options = array(
		    'cluster' => 'us2',
		    'useTLS' => true
		);

		$pusher = new Pusher(
		    'fa91802443afec1d96ac',
		    '0900c57c923b2096ffcd',
		    '955993',
		    $options
  		);

  		$data['mensaje'] = $request->message;
  		$data['hora'] = $date;
  		$evento = $request->canal."-message";
  		if ( $pusher->trigger($request->canal, $evento, $data, $request->socket_id) ) {

  			$canal = DB::table("chats_rooms")->where("token_chat", $request->canal)->first();

            //NOTIFICACIONES DE CHAT
            $primerMsj = DB::table("messages")->where("chat_id", $canal->chat_id)->first();
            if ($primerMsj == null) {

                $myuser = DB::table("users")->where("user_id", $canal->user_two_id)->first();
                if ($myuser != null) {
                    if ($myuser->receive_text == 1) {
                        $mensaje = "The user ".auth()->user()->username." sent you a message";
                        //$this->sendMessageTwilio($myuser->phone, $mensaje);
                    }
                }
               
                DB::table("notifications")->insert([
                    "user_id" => $canal->user_two_id,
                    "typo_notify_id" => 1,
                    "other_user_id" => auth()->user()->user_id,
                    "created_at" => $date,
                ]);
            }
            else {
                $segundoMsj = DB::table("messages")->where([
                                            "user_id" => $canal->user_two_id,
                                            "chat_id" => $canal->chat_id,]
                                    )->first();

                $oneUser = DB::table("users")->where("user_id", $canal->user_id)->first();
                if ($oneUser != null) {
                    if ($oneUser->receive_text == 1) {
                        $twoUser = DB::table("users")->where("user_id", $canal->user_two_id)->first();
                        $mensaje = "The user ".$twoUser->username." sent you a message";
                        //$this->sendMessageTwilio($oneUser->phone, $mensaje);
                    }
                }

                if ($segundoMsj == null) {
                    DB::table("notifications")->insert([
                        "user_id" => $canal->user_id,
                        "typo_notify_id" => 1,
                        "other_user_id" => $canal->user_two_id,
                        "created_at" => $date,
                    ]);
                }
            }

  			DB::table("messages")->insert([
  				"chat_id" => $canal->chat_id,
  				"user_id" => auth()->user()->user_id,
  				"message" => $request->message,
  				"created_at" => $date,
  				"updated_at" => $date
  			]);


  			return response()->json(["message" => "ok", "fecha" => $date], 202);
  		}
    }


    public function sendMessageTwilio($phone, $msj)
    {
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );

        $client->messages->create(
            $phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => env( 'TWILIO_FROM' ),
                // the body of the text message you'd like to send
                'body' => $msj
            )
        );
    }
}
