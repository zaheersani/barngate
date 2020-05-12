<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;
use App\Contact;

use Validator;
use DB;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topAnimals = $this->TopAnimals();
        $notificaciones = $this->getNotify();
        return view('site.index', ['blog' => $this->blog(), 'topAnimals' => $topAnimals, 'notificaciones' => $notificaciones]);
    }

    public function blog()
    {
        $items = [];
        $url = "https://blog.barngate.com/feed/";
        $oXml = simplexml_load_file($url);
        if ($oXml[0] != 'Service unavailable.') {
            for ($i = 0; $i <= 2; $i++) {
                $item = $oXml->channel->item[$i];
                $items[] = [
                    "link" => $item->link,
                    "image" => $item->image,
                    "title" => strip_tags($item->title),
                    "content" => strip_tags($item->description),
                    "date" => explode(" ", $item->pubDate)
                ];
            }
        }

        return $items;
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


    public function TopAnimals()
    {
        // $homepage = Sale::where("homepage", 1)
        //                 ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
        //                 ->where("sales.disabled", 0)
        //                 ->select('sales.*', 'animals.name as animal_name')
        //                 ->limit(15)
        //                 ->get();

        $homepage = Sale::join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->where([["sales.disabled", "=", 0], ["sales.sold", "=", 0]])
                        ->select('sales.*', 'animals.name as animal_name')
                        ->limit(15)
                        ->get();

        $ArrayTopAnimals = array();
        $cont            = 0;

        foreach ($homepage as $homepageObj) {
            $ArrayTopAnimals[$cont]["animal_name"] = $homepageObj->animal_name;
            $ArrayTopAnimals[$cont]["img"]         = $this->primerImagenProducto( $homepageObj->user_id, $homepageObj->animal_id, $homepageObj->sale_id );
            $ArrayTopAnimals[$cont]["nickname"]    = $homepageObj->nickname;
            $ArrayTopAnimals[$cont]["animal_id"]   = $homepageObj->animal_id;
            $cont++;
        }

        return $ArrayTopAnimals;
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




    public function ContactSend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required|max:100",
            "last_name" => "required|max:100",
            "email_contact" => "required|max:50",
            "phone" => "required|max:20",
            "phone" => "numeric",
            "questions" => "required|max:300"
        ]);

        if ($validator->fails()) {
            return redirect("contact")->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        $contact                = new Contact();
        $contact->first_name    = $request->first_name;
        $contact->last_name     = $request->last_name;
        $contact->email         = $request->email_contact;
        $contact->phone         = $request->phone;
        $contact->questions     = $request->questions;

        if ( $contact->save() ) {

            DB::commit();
            return back()->with('status.success', "1");
        }

        return back()->withInput()->with('status.error', "1");

    }

}
