<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class PageEstaticController extends Controller
{
    public function __construct()
    {
    	$this->middleware("auth", ["only" => ["showNotifications", "getNotify"]]);
    }

    public function showNotifications()
    {
    	//Fecha HOY
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d H:i:s', time());

        $fechafinal = strtotime ( '-1 month' , strtotime ( $date ) ) ;
        $fechafinal = date ( 'Y-m-d H:i:s' , $fechafinal );

        // return $fechafinal;
        $notifyArray   = null;
    	$notifications = DB::table("notifications")
    						->where("user_id", auth()->user()->user_id)
    						->where("created_at", "<=", $date)
    						->where("created_at", ">=", $fechafinal)
                            ->orderBy("notify_id", "desc")
    						->get();

    	if ($notifications != null) {
    		$conta = 0;
    		foreach ($notifications as $keyNotify) {
    			if ($keyNotify->typo_notify_id == 1) {
    				$otro_usuario 						= DB::table("users")->where("user_id", $keyNotify->other_user_id)->first();

                    //OBTENER TOKEN DE CHAT
                    $_token = null;
                    $token = DB::table("chats_rooms")
                                        ->where("user_id", auth()->user()->user_id)
                                        ->where("user_two_id", $keyNotify->other_user_id)
                                        ->orWhere("user_two_id", auth()->user()->user_id)
                                        ->where("user_id", $keyNotify->other_user_id)
                                        ->first();


                    if ($token != null) {
                        $_token = $token->token_chat;
                    }


    				$notifyArray[$conta]["img"] 		= $otro_usuario->urlImg;
    				$notifyArray[$conta]["user_id"] 	= $keyNotify->other_user_id;
    				$notifyArray[$conta]["user_name"] 	= $otro_usuario->username;
    				$notifyArray[$conta]["fecha"] 		= $keyNotify->created_at;
    				$notifyArray[$conta]["description"] = "The user sent you a message";
    				$notifyArray[$conta]["typo_notify_id"] = $keyNotify->typo_notify_id;
                    $notifyArray[$conta]["pending"]        = $keyNotify->read_notify;
                    $notifyArray[$conta]["url"]            = $_token;
    			}
    			else if ($keyNotify->typo_notify_id == 2 || $keyNotify->typo_notify_id == 3) {
    				$sale_expire 						= DB::table("sales")
    															->where("sale_id", $keyNotify->sale_id)
    															->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
    															->select('sales.*', 'animals.name as animal_name')
    															->first();

    				$notifyArray[$conta]["img"] 		= $this->primerImagenProducto( $sale_expire->user_id, $sale_expire->animal_id, $sale_expire->sale_id );
    				$notifyArray[$conta]["sale_name"] 	= $sale_expire->animal_name;
    				$notifyArray[$conta]["fecha"] 		= $keyNotify->created_at;
    				$notifyArray[$conta]["description"] = "Your ad has expired";
    				$notifyArray[$conta]["typo_notify_id"] = $keyNotify->typo_notify_id;
                    $notifyArray[$conta]["pending"]        = $keyNotify->read_notify;
                    $notifyArray[$conta]["url"]            = $sale_expire->nickname;
    			}

    			$conta++;
    		}
    	}

    	$notificaciones = $this->getNotify();
    	return view('site.notifications', compact("notifyArray", "notificaciones"));
    }


    public function showFaqs()
    {
        $notificaciones = $this->getNotify();
        return view('site.faqs', compact("notificaciones"));
    }

    public function showPrivacy()
    {
        $notificaciones = $this->getNotify();
        return view('site.privacy', compact("notificaciones"));
    }

    public function showAbout()
    {
        $notificaciones = $this->getNotify();
        return view('site.about', compact("notificaciones"));
    }

    public function showContact()
    {
        $notificaciones = $this->getNotify();
        return view('site.contact', compact("notificaciones"));
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
}
