<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Moderl
use App\User;
use App\Sale;
use App\Favorite;

//DB
use DB;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware("ValidateURLSeoSearch", ["only" => ["VistaSearch"]]);
    }


    public function VistaSearch($category = null)
    {
        switch ($category) {
            case 'buy-cattle-online':
                $category = 1;
                $titulo = "The best way to Buy cattle online in USA | Barngate";
                $description = "The best experience to buy cattle online. Find the best cattle according to your needs. Visit us!";
                break;
            case 'buy-a-horse-online':
                $category = 2;
                $titulo = "The best way to Buy a horse online in USA | Barngate";
                $description = "Explore, find and buy a horse online today. New horses daily. Visit us!";
                break;
            case 'buy-sheep-online':
                $category = 3;
                $titulo = "The best way to Buy a sheep online in USA | Barngate";
                $description = "Buy a sheep online; anytime, anywhere. Compare, negotiate price and buy sheep online 24/7. Visit us!";
                break;
            case 'buy-goat-online':
                $category = 4;
                $titulo = "The best way to Buy a goat online in USA | Barngate";
                $description = "Buy a goat online; anytime, anywhere. Compare, negotiate price and buy sheep online 24/7. Visit us!";
                break;
            case 'buy-pig-online':
                $category = 5;
                $titulo = "The best way to Buy a pig online in USA | Barngate";
                $description = "Buy a pig online; anytime, anywhere. Compare, negotiate price and buy sheep online 24/7. Visit us!";
                break;
            case 'online-pet-classifleds':
                $category = 6;
                $titulo = "Best online pet classifieds in USA | Barngate";
                $description = "Search our easy to use online Pets classifieds to find all kinds of Pets listings online. Visit us!";
                break;
            default:
                $category = 1;
                break;
        }
        
        if ($category != 1 && $category != 2 && $category != 3 && $category != 4 && $category != 5 && $category != 6) {
            $category  = 1;
        }

    	$animal     = array();
        $where      = $category == 6 ? [["sales.animal_id", "=", 7], ["sales.disabled", "=", 0], ["sales.sold", "=", 0]] : [];
    	$animalsrow = Sale::join('animals', 'sales.animal_id', '=', 'animals.animal_id')
    						->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
	                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                            ->join('cities', 'sales.city', '=', 'cities.id_ciudad')
                            ->where([["sales.animal_id", "=", $category], ["sales.disabled", "=", 0], ["sales.sold", "=", 0]])
                            ->orWhere($where)
	    					->select('sales.*', 
		    							'animals.name as animal_name', 
	                                    'breeds.name as breeds_name', 
	                                    'users.username as users_name',
                                        'cities.*')->orderBy("plan_id", "DESC")->get();

        

        if ($animalsrow->count() > 0) {
            $ban = 0;
            foreach ($animalsrow as $animalrow) {
                $animal[$ban]["animal_name"]    = $animalrow->animal_name;
                $animal[$ban]["img"]            = $this->primerImagenProducto( $animalrow->user_id, $animalrow->animal_id, $animalrow->sale_id );
                $animal[$ban]["nickname"]       = $animalrow->nickname;
                $animal[$ban]["users_name"]     = base64_encode($animalrow->users_name);
                $animal[$ban]["breeds_name"]    = $animalrow->breeds_name;
                $animal[$ban]["gender_name"]    = $animalrow->gender_name;
                $animal[$ban]["price"]    		= $animalrow->price;
                $animal[$ban]["user_id"]        = $animalrow->user_id;
                $animal[$ban]["price_filtro"]   = str_replace(",", "", $animalrow->price);
                $animal[$ban]["animal_id"]      = $animalrow->animal_id;
                $animal[$ban]["breed_id"]       = $animalrow->breed_id;
                $animal[$ban]["color_id"]       = $animalrow->color_id;
                $animal[$ban]["color"]          = isset($animalrow->color) ? $animalrow->color->name : null;
                $animal[$ban]["age_id"]         = $animalrow->age_id;
                $animal[$ban]["gender_id"]      = $animalrow->gender_id;
                $animal[$ban]["discipline_id"]  = $animalrow->discipline_id;
                $animal[$ban]["description"]    = $animalrow->description;
                $animal[$ban]["state"]          = $animalrow->state;
                $animal[$ban]["adress"]         = $animalrow->ciudad.", ".$animalrow->estado;
                $animal[$ban]["categorie_id"]   = $animalrow->categorie_id;
                $animal[$ban]["vaccinations"]   = $animalrow->vaccinations;
                $animal[$ban]["horns"]          = $animalrow->horns;
                $animal[$ban]["type"]           = $animalrow->type_id;
                $animal[$ban]["class"]          = $animalrow->class_id;
                $animal[$ban]["size"]           = $animalrow->size_id;
                $animal[$ban]["homepage"]       = $animalrow->homepage;
                $animal[$ban]["myfavorito"]     = false;


                if (auth()->check()) {
                    $myfavorito = DB::table("favorites")
                                        ->where("user_id", auth()->user()->user_id)
                                        ->where("sale_id", $animalrow->sale_id)
                                        ->first();

                    if ($myfavorito != null) {
                        $animal[$ban]["myfavorito"]   = true;
                    }
                }
                $ban++;
            }
        }

        $animals        = DB::table("animals")->get();

        if ($category == 6) {
            $breeds     = DB::table("breeds")->where(["animal_id" => $category])->orWhere(["animal_id" => 7])->get();
            $colors     = DB::table("colors")->where(["animal_id" => $category])->orWhere(["animal_id" => 7])->get();
        }
        else {
            $breeds     = DB::table("breeds")->where("animal_id", $category)->get();
            $colors     = DB::table("colors")->where("animal_id", $category)->get();
        }
        
        $genders        = DB::table("genders")->where("animal_id", $category)->get();
        $disciplines    = DB::table("disciplines")->get();
        $categories     = DB::table("categories")->get();
        $types          = DB::table("types")->get();
        $classe         = DB::table("class")->where("animal_id", $category)->get();
        $sizes          = DB::table("sizes")->get();
        $estados        = DB::table("cities")->groupBy("estado")->get();
        $misFavoritos   = false;

        if (auth()->check()) {
            $misFavoritos   = $this->getFavorites(auth()->user()->user_id);
        }
        
        $notificaciones = $this->getNotify();

    	return view('site.vista', compact("animal", "animals", "breeds", "colors", "genders", "disciplines", "estados", "misFavoritos", "category", "notificaciones", "categories", "types", "classe", "sizes", "titulo", "description"));
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


    public function getFavorites($user_id)
    {
        $favorite = favorite::where("user_id", $user_id)->get();
        $favoriteArray = array();

        if ($favorite->count() > 0) {
            $cont = 0;
            foreach ($favorite as $favorites) {
                $favoritefull = Sale::where("sale_id", $favorites->sale_id)
                                    ->where("disabled", 0)
                                    ->where("sold", 0)
                                    ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                                    ->join('users', 'sales.user_id', '=', 'users.user_id')
                                    ->select('sales.*', 'animals.name as animal_name', 'users.username as users_name')
                                    ->first();

                if ($favoritefull) {
                    $favoriteArray[$cont]["animal_name"]  = $favoritefull->animal_name;
                    $favoriteArray[$cont]["nickname"]      = $favoritefull->nickname;
                     $favoriteArray[$cont]["price"]         = $favoritefull->price;
                    $favoriteArray[$cont]["img"]           = $this->primerImagenProducto( $favoritefull->user_id, $favoritefull->animal_id, $favoritefull->sale_id );
                    $favoriteArray[$cont]["users_name"]    = base64_encode($favoritefull->users_name);
                    $cont++;
                }
            }

            return $favoriteArray;

        }

       return false;
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

}
