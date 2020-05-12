<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendUpdateSaleFavorites;
use Illuminate\Support\Facades\Mail;

//Moderl
use App\User;
use App\Sale;
use App\Favorite;

//DB
use DB;

//
use Session;
use Stripe;
use Validator;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth", ["except" => ["show", "SearchAnimal"]]);
        $this->middleware("ValidateProfileFinSale", ["except" => ["show", "SearchAnimal"]]);
        $this->middleware("RestrictedAccessExpired", ["only" => ["show"]]);
        $this->middleware("RestringUpdateSale", ["only" => ["updatePlan", "PageUpdatePlan"]]);
        $this->middleware("ValidateEditAnimal", ["only" => ["edit"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals    = DB::table("animals")->get();
        $type       = DB::table("types")->get();
        $size       = DB::table("sizes")->get();
        $categories = DB::table("categories")->get();
        $breeds     = DB::table("breeds")->get();
        $colors     = DB::table("colors")->get();
        $genders    = DB::table("genders")->get();
        $class      = DB::table("class")->get();
        $disciplines = DB::table("disciplines")->get();
        $estados    = DB::table("cities")->groupBy("estado")->get();
        $notificaciones = $this->getNotify();

        return view('site.sale', compact("animals", "breeds", "colors", "genders", "disciplines", "estados", "class", "categories", "type", "size", "notificaciones"));
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



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (request("animals") == 1) {
            
            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "vaccinations" => "required|max:2",
                "vaccinations" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "categories" => "required|max:2",
                "categories" => "numeric",
                "weight" => "required",
                "conditions" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 2) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "discipline" => "required|max:2",
                "temperament" => "required|max:2",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 3) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 4) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "type" => "required|max:2",
                "type" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 5) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 6) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if (request("animals") == 7) {

            $validator = Validator::make($request->all(), [
                "animals" => "required|max:2",
                "animals" => "numeric",
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "declawed" => "required|max:2",
                "declawed" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }


        if ($validator->fails()) {
            return redirect("sale")->withErrors($validator, "paso1")->withInput();
        }

        $validator2 = Validator::make($request->all(), [
            "planSelect" => "required|numeric",
            "planSelect" => "max:2"
        ]);

        if ($validator2->fails()) {
            return redirect("sale")->withErrors($validator2, "paso2")->withInput();
        }


        // if (request("planSelect") == 3) {
        //     $validator3 = Validator::make($request->all(), [
        //         "url-videos" => "required|max:255"
        //     ]);

        //     if ($validator3->fails()) {
        //         return redirect("sale")->withErrors($validator3, "paso3")->withInput();
        //     }
        // }


        
        //Fecha del plan
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        //GUARDAR FECHA PARA LOS DATOS
        if (request("planSelect") == 1) {
            $fechafinal = strtotime ( '+1 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }
        else if (request("planSelect") == 2) {
            $fechafinal = strtotime ( '+3 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }
        else if (request("planSelect") == 3) {
            $fechafinal = strtotime ( '+6 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }



        DB::beginTransaction();

        $sale                   = new Sale();
        $sale->user_id          = auth()->user()->user_id;
        $sale->animal_id        = request("animals");

        if (request("animals") == 1) {
            $sale->breed_id         = request("breeds");
            $sale->age_id           = request("ages");
            $sale->vaccinations     = request("vaccinations");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->conditions       = request("conditions");
            $sale->number_of_head   = request("number_of_head");
            $sale->categorie_id    = request("categories");
        }

        else if (request("animals") == 2) {
            $sale->breed_id         = request("breeds");
            $sale->color_id         = request("colors");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->discipline_id    = request("discipline");
            $sale->temperament      = request("temperament");
        }

        else if (request("animals") == 3) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 4) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->type_id          = request("type");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 5) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }

        else if (request("animals") == 6) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
        }

        else if (request("animals") == 7) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
            $sale->declawed        = request("declawed");
        }

        $sale->price            = request("price");
        $sale->description      = request("description");
        $sale->city             = request("city");
        $sale->state            = request("region");
        $sale->zip              = request("zip");
        $sale->country          = request("country");
        $sale->plan_id          = request("planSelect");
        $sale->date_init        = $date;
        $sale->date_end         = $fechafinal;

        // if (request("planSelect") == 3) {
        //     $sale->video = request("url-videos");
        // }

        $precio = 0;

        if ($request->has("hompage") || $request->has("hompage2")) {
            $sale->homepage = 1;
            $precio = 20;
        }
        else {
             $sale->homepage = 0;
        }


        if (request("animals") == 6) {
            if (request("planSelect") == 2) {
                $precio += 5;
            }
            else if (request("planSelect") == 3) {
                $precio += 10;
            }
        }
        else {
            if (request("planSelect") == 2) {
                $precio += 10;
            }
            else if (request("planSelect") == 3) {
                $precio += 20;
            }
        }

        if ($sale->save()) {

            $sale->nickname = $this->getNickname($sale);
            $sale->save();

            if ($request->has("filepond")) {
                for ($i=0; $i <= count($request->get('filepond')) - 1; $i++) {
                    try {
                        $this->uploadImg($request, $i, $sale->sale_id);
                    } 
                    catch(Exception $e) {
                        DB::rollback();
                        \Log::error("No se guardo correctamente la imagen: error: ".$e->getMessage());
                    }
                }

                if ($precio > 0 && $request->has("stripeToken")) {
                    if ($this->stripePost(request("stripeToken"), $precio)) {
                        DB::commit();
                        return back()->with('status.success', '1');
                    }

                    DB::rollback();
                    return back()->with('status.error.pago', '1');

                }

                DB::commit();
                return back()->with('status.success', '1');
            }
            else {
                DB::rollback();
                return back()->withInput()->with('status.error.not.file', 'The field is required');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $animalprincipal = DB::table('sales')->where('nickname', $id)->first();

        if ($animalprincipal->animal_id == 1) {
            
            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('categories', 'sales.categorie_id', '=', 'categories.categorie_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name',  
                                    'categories.name as categories_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 2) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('disciplines', 'sales.discipline_id', '=', 'disciplines.discipline_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'disciplines.name as desc_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 3) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 4) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('types', 'sales.type_id', '=', 'types.type_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'types.name as types_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 5) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('class', 'sales.class_id', '=', 'class.class_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'class.name as class_name', 
                                    'genders.name as gender_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 6) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('sizes', 'sales.size_id', '=', 'sizes.size_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'sizes.name as sizes_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        else if ($animalprincipal->animal_id == 7) {

            $animal =   DB::table('sales')
                        ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                        ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                        ->join('colors', 'sales.color_id', '=', 'colors.color_id')
                        ->join('genders', 'sales.gender_id', '=', 'genders.gender_id')
                        ->join('sizes', 'sales.size_id', '=', 'sizes.size_id')
                        ->join('users', 'sales.user_id', '=', 'users.user_id')
                        ->select('sales.*', 
                                    'animals.name as animal_name', 
                                    'breeds.name as breeds_name', 
                                    'colors.name as colors_name', 
                                    'genders.name as gender_name',
                                    'sizes.name as sizes_name',
                                    'users.username as user_name',
                                    'users.urlImg')
                        ->where('nickname', $id)->first();
        }

        $favorite       = $this->getFavoriteProduct($animalprincipal->sale_id, $animalprincipal->user_id);
        $todasImg       = $this->todasImagenesProducto($animalprincipal->user_id, $animalprincipal->animal_id, $animalprincipal->sale_id);
        $notificaciones = $this->getNotify();
        $promedio       = $this->getPromedio($animalprincipal->user_id);
        $relacionados   = $this->getRelaciones($animalprincipal->animal_id, $animalprincipal->sale_id);

        return view("site.principal", compact("animal", "todasImg", "favorite", "notificaciones", "promedio", "relacionados"));
    }

    public function getRelaciones($animal_id, $except_sale)
    {
        $sales = null;
        $salesRela = DB::table("sales")
                            ->join('breeds', 'sales.breed_id', '=', 'breeds.breed_id')
                            ->select('sales.*', 'breeds.name as breeds_name')
                            ->where([
                                "sales.animal_id" => $animal_id,
                                "disabled" => 0,
                                "sold" => 0,
                            ])
                            ->where("sale_id", "!=", $except_sale)
                            ->inRandomOrder()
                            // ->limit(5)
                            ->get();

        if ($salesRela != null) {
            $conta = 0;
            foreach ($salesRela as $ksale) {
                $sales[$conta]["breed"] = $ksale->breeds_name;
                $sales[$conta]["img"] = $this->primerImagenProducto( $ksale->user_id, $ksale->animal_id, $ksale->sale_id );
                $sales[$conta]["nickname"] = $ksale->nickname;
                $conta++;
            }
        }

        return $sales;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animalprincipal = DB::table("sales")->where(["user_id" => auth()->user()->user_id, "nickname" => $id])->first();
        $todasImg   = $this->todasImagenesProducto($animalprincipal->user_id, $animalprincipal->animal_id, $animalprincipal->sale_id);
        $ciudades   = DB::table("cities")->where("id_estado", $animalprincipal->state)->get();

        if ($animalprincipal->animal_id == 1) {
            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $categories = DB::table("categories")->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "categories", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");
        }
        else if ($animalprincipal->animal_id == 2) {

            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $colors     = DB::table("colors")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $disciplines = DB::table("disciplines")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "colors", "genders", "disciplines", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");

        }
        else if ($animalprincipal->animal_id == 3) {

            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $class      = DB::table("class")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "class", "genders", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");

        }
        else if ($animalprincipal->animal_id == 4) {

            $type       = DB::table("types")->where("animal_id", $animalprincipal->animal_id)->get();
            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $class      = DB::table("class")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "class", "type", "genders", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");
        }
        else if ($animalprincipal->animal_id == 5) {


            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $class      = DB::table("class")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "class", "genders", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");
        }
        else if ($animalprincipal->animal_id == 6) {

            $size       = DB::table("sizes")->get();
            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $colors     = DB::table("colors")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "size", "genders", "colors", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");
        }
        else if ($animalprincipal->animal_id == 7) {

            $size       = DB::table("sizes")->get();
            $breeds     = DB::table("breeds")->where("animal_id", $animalprincipal->animal_id)->get();
            $colors     = DB::table("colors")->where("animal_id", $animalprincipal->animal_id)->get();
            $genders    = DB::table("genders")->where("animal_id", $animalprincipal->animal_id)->get();
            $estados    = DB::table("cities")->groupBy("estado")->get();
            $notificaciones = $this->getNotify();

            $compact = compact("breeds", "size", "genders", "colors", "estados", "notificaciones", "animalprincipal", "todasImg", "id", "ciudades");
        }

        return view("site.edit_animal", $compact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id             = $request->route("id");
        $animal         = Sale::where(["nickname" => $id, "user_id" => auth()->user()->user_id])->first();
        $favoritoMail   = false;

        if ($animal->animal_id == 1) {
            
            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "vaccinations" => "required|max:2",
                "vaccinations" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "categories" => "required|max:2",
                "categories" => "numeric",
                "weight" => "required",
                "conditions" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 2) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:4",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "discipline" => "required|max:2",
                "temperament" => "required|max:2",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 3) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 4) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "type" => "required|max:2",
                "type" => "numeric",
                "horns" => "required|max:2",
                "horns" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 5) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "class" => "required|max:2",
                "class" => "numeric",
                "weight" => "required",
                "number_of_head" => "required|max:2",
                "number_of_head" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 6) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }
        else if ($animal->animal_id == 7) {

            $validator = Validator::make($request->all(), [
                "breeds" => "required|max:2",
                "breeds" => "numeric",
                "colors" => "required|max:2",
                "colors" => "numeric",
                "genders" => "required|max:2",
                "genders" => "numeric",
                "ages" => "required|max:2",
                "ages" => "numeric",
                "size" => "required|max:2",
                "size" => "numeric",
                "declawed" => "required|max:2",
                "declawed" => "numeric",
                "price" => "required|max:255",
                "description" => "required",
                "city" => "required|numeric",
                "region" => "required|numeric",
                "zip" => "required|numeric",
                "zip" => "max:5",
                "country" => "required|max:255",
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route("sale.edit", $id)->withErrors($validator, "paso1")->withInput();
        }


        DB::beginTransaction();

        $sale                   = Sale::find($animal->sale_id);

        if ($sale->price != request("price")) {
            $favoritoMail = true;
        }

        if ($animal->animal_id == 1) {
            $sale->breed_id         = request("breeds");
            $sale->age_id           = request("ages");
            $sale->vaccinations     = request("vaccinations");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->conditions       = request("conditions");
            $sale->number_of_head   = request("number_of_head");
            $sale->categorie_id    = request("categories");
        }
        else if ($animal->animal_id == 2) {
            $sale->breed_id         = request("breeds");
            $sale->color_id         = request("colors");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->discipline_id    = request("discipline");
            $sale->temperament      = request("temperament");
        }
        else if ($animal->animal_id == 3) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }
        else if ($animal->animal_id == 4) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->type_id          = request("type");
            $sale->class_id         = request("class");
            $sale->horns            = request("horns");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }
        else if ($animal->animal_id == 5) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->age_id           = request("ages");
            $sale->class_id         = request("class");
            $sale->weight           = request("weight");
            $sale->number_of_head   = request("number_of_head");
        }
        else if ($animal->animal_id == 6) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
        }
        else if ($animal->animal_id == 7) {
            $sale->breed_id         = request("breeds");
            $sale->gender_id        = request("genders");
            $sale->color_id         = request("colors");
            $sale->age_id           = request("ages");
            $sale->size_id         = request("size");
            $sale->declawed        = request("declawed");
        }

        $sale->price            = request("price");
        $sale->description      = request("description");
        $sale->city             = request("city");
        $sale->state            = request("region");
        $sale->zip              = request("zip");
        $sale->country          = request("country");
        $sale->nickname         = $this->getNicknameUpdate($sale);


        if ($sale->save()) {

            if ($request->has("filepond")) {

                //OBTENER EL NUMERO DE IMAGENES QUE SE QUIEREN GUARDAR
                $imagenesUp = count($request->get('filepond'));

                //OBTENER EL NUMERO DE IMAGENES GUARDADAS DEL PRODUCTO
                $directory  = 'images/'.auth()->user()->user_id.'/'.$sale->animal_id.'/'.$sale->sale_id.'/';
                $files      = Storage::allFiles($directory);
                $imagenSave = count($files);

                //OPBTENER EL PLAN
                $plan           = $animal->plan_id;
                $totalImagenes  = $imagenesUp + $imagenSave;


                if ($plan == 1 && $totalImagenes > 1) {
                    DB::rollback();
                    return back()->with('status.error', '2');
                }
                else if ($plan == 2 && $totalImagenes > 5) {
                    DB::rollback();
                    return back()->with('status.error', '2');
                }

                //SI HAY IMAGENES LAS RECORREMOS PARA GUARDAR
                for ($i=0; $i <= count($request->get('filepond')) - 1; $i++) {
                    try {
                        $this->uploadImgUpdate($request, $i, $sale->sale_id, $sale->animal_id);
                    } 
                    catch(Exception $e) {
                        DB::rollback();
                        \Log::error("No se guardo correctamente la imagen: error: ".$e->getMessage());
                        return back()->with('status.error', '1');
                    }
                }

                if ($favoritoMail == true) {
                    $this->sendEmailFavChangue($sale->sale_id);
                }
                
                DB::commit();
                return redirect()->route("sale.edit", $sale->nickname)->with('status.success', '1');
            }
            else {

                if ($favoritoMail == true) {
                    $this->sendEmailFavChangue($sale->sale_id);
                }

                DB::commit();
                return redirect()->route("sale.edit", $sale->nickname)->with('status.success', '1');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function removeImgEd(Request $request)
    {
        if (!$request->has("url_img")) {
           return response()->json(["message"=>"error", "desc" => "no_parameter"]);
        }

        if (!$request->has("sale_id")) {
           return response()->json(["message"=>"error", "desc" => "no_parameter"]);
        }

        $sale = DB::table("sales")->where(["nickname" => $request->sale_id, "user_id" => auth()->user()->user_id])->first();
        if ($sale == null) {
            return response()->json(["message"=>"error", "desc" => "no_sale_user"]);
        }

        $nombre_url = "images/".auth()->user()->user_id."/".$sale->animal_id."/".$sale->sale_id."/".basename($request->url_img);
        if (!Storage::delete($nombre_url)) {
            return response()->json(["message" => "not_remove"]);
        }

        return response()->json(["message" => "ok"]);
    }


    public function updatePlan($id)
    {
         $notificaciones = $this->getNotify();
         $sale = Sale::where("nickname", $id)->first();
        return view("site.renovate", compact("id", "notificaciones", "sale"));
    }


    public function PageUpdatePlan(Request $request, $id)
    {


        //VALIDAR EL PLAN
        $validator2 = Validator::make($request->all(), [
            "planSelect" => "required|numeric",
            "planSelect" => "max:2"
        ]);

        if ($validator2->fails()) {
            return redirect("/plan/".$id)->withErrors($validator2, "paso2")->withInput();
        }


        //Fecha del plan
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d', time());

        //GUARDAR FECHA PARA LOS DATOS
        if (request("planSelect") == 1) {
            $fechafinal = strtotime ( '+1 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }
        else if (request("planSelect") == 2) {
            $fechafinal = strtotime ( '+3 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }
        else if (request("planSelect") == 3) {
            $fechafinal = strtotime ( '+6 month' , strtotime ( $date ) ) ;
            $fechafinal = date ( 'Y-m-d' , $fechafinal );
        }


        //OBTENER EL REGISTRO DEL ANIMAL
        $saleGet    = Sale::where("nickname", $id)->first();
        $sale       = Sale::find($saleGet->sale_id);



        //SABER QUE PLAN TIENE PARA RECORTAR LA CANTIDAD DE IMAGENES
        $directory = 'images/'.auth()->user()->user_id.'/'.$sale->animal_id.'/'.$sale->sale_id.'/';
        $files = Storage::allFiles($directory);


        if (request("planSelect") == 1) {
            if (count($files) > 1) {
                $counta = count($files) - 2;
                for ($i=0; $i <= $counta; $i++) { 
                    Storage::delete($files[$i]);
                }
            }
        }
        else if (request("planSelect") == 2) {
            if (count($files) > 5) {
                $counta = count($files) - 6;
                for ($i=0; $i <= $counta; $i++) { 
                    Storage::delete($files[$i]);
                }
            }
        }




        $precio = 0;
        if ($request->has("hompage") || $request->has("hompage2")) {
            $sale->homepage = 1;
            $precio = 20;
        }
        else {
             $sale->homepage = 0;
        }


        if ($request->animal_id == 6) {
            if (request("planSelect") == 2) {
                $precio += 5;
            }
            else if (request("planSelect") == 3) {
                $precio += 10;
            }
        }
        else {
            if (request("planSelect") == 2) {
                $precio += 10;
            }
            else if (request("planSelect") == 3) {
                $precio += 20;
            }
        }

        //UPDATE
        $sale->plan_id      = request("planSelect");
        $sale->date_init    = $date;
        $sale->date_end     = $fechafinal;
        $sale->disabled     = 0;


        //PAGAR CON STRIPE
        if ($sale->save()) {
            if ($precio > 0 && $request->has("stripeToken")) {
                if ($this->stripePost(request("stripeToken"), $precio)) {
                    DB::commit();
                    return redirect()->route("myaccount")->with('status.success', '1');
                }

                DB::rollback();
                return redirect()->route("myaccount")->with('status.error.pago', '1');
            }

            DB::commit();
            return redirect("/myaccount")->route("myaccount")->with('status.success', '1');
        }

    }


    public function SearchState(Request $request)
    {
        if ($request->has('estado')) {
            
           $codigo = DB::table('cities')
                        ->where('id_estado', $request->estado)
                        ->get();

            if ($codigo) {
               return response()->json(['message' => 'ok', 'result' => $codigo]);
              
            }

            return response()->json(['message' => 'not']);
        }

        return response()->json(['message' => 'not parameters']);
    }



    public function uploadImg($request, $i, $sale_id)
    {
        $jsonImg     = json_decode($request->get("filepond")[$i]);
        $imgDecode   = base64_decode($jsonImg->data);
        $extencion   = explode("/", $jsonImg->type);
        $imageName   = str_random(10).time().'.'.trim($extencion[1]);
        $path        = "images/".auth()->user()->user_id."/".$request->get("animals")."/".$sale_id;

        if ($extencion[1] == "jpg" || $extencion[1] == "jpeg" || $extencion[1] == "png") {
            \Storage::makeDirectory($path, 0777, true);
            \Storage::put($path. "/" . $imageName, $imgDecode);
        }  
    }


    public function uploadImgUpdate($request, $i, $sale_id, $animal_id)
    {
        $jsonImg     = json_decode($request->get("filepond")[$i]);
        $imgDecode   = base64_decode($jsonImg->data);
        $extencion   = explode("/", $jsonImg->type);
        $imageName   = str_random(10).time().'.'.trim($extencion[1]);
        $path        = "images/".auth()->user()->user_id."/".$animal_id."/".$sale_id;

        if ($extencion[1] == "jpg" || $extencion[1] == "jpeg" || $extencion[1] == "png") {
            \Storage::makeDirectory($path, 0777, true);
            \Storage::put($path. "/" . $imageName, $imgDecode);
        }  
    }



    public function todasImagenesProducto($usuario, $categoria, $producto)
    {
        $directory= base_path()."/storage/app/public/images/".$usuario."/".$categoria."/".$producto;
        if (is_dir($directory)) {
            $dirint = dir($directory);
            $todas = Array();
            while (($archivo = $dirint->read()) !== false)
            {
                if (preg_match("{gif}", $archivo) || preg_match("{jpeg}", $archivo) || preg_match("{png}", $archivo) || preg_match("{jpg}", $archivo) || preg_match("{webp}", $archivo)){
                    $todas[] = $usuario."/".$categoria."/".$producto."/".$archivo;
                }
            }
            $dirint->close();
            return $todas;
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


    public function SearchAnimal(Request $request)
    {
        if ($request->has('animal')) {

            $breed      = null;
            $genders    = null;
            $size       = null;
            $color      = null;
            $class      = null;

            $breed  = DB::table('breeds')
                        ->where('animal_id', $request->animal)
                        ->get();

            $genders = DB::table('genders')
                        ->where('animal_id', $request->animal)
                        ->get();

            $color  = DB::table('colors')
                        ->where('animal_id', $request->animal)
                        ->get();


             $class = DB::table('class')
                        ->where('animal_id', $request->animal)
                        ->get();


            $result = array("breeds" => $breed, 
                            "genders" => $genders, 
                            "color" => $color, "class" => $class);

            return response()->json(['message' => 'ok', "result" => $result]);
        }

        return response()->json(['message' => 'not parameters']);
    }

  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost($stripeToken, $precio)
    {
        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => $precio * 100,
                    "currency" => "USD",
                    "source" => $stripeToken,
                    "description" => "Test payment from itsolutionstuff.com." 
            ]);   

            return true;

        } catch (\Exception $e) {
            \Log::error("Error al pagaar con stripe: ".$e->getMessage());
            redirect("sale")->withInput()->with("card_errors", $e->getMessage());
            return false;
        }
    }


    public function getNickname($sale)
    {
        $animal = DB::table("animals")->where("animal_id", $sale->animal_id)->first();
        $breed  = DB::table("breeds")->where("breed_id", $sale->breed_id)->first();
        $url    = null;

        if ($sale->color_id != null && $sale->color_id != 0) {
            $color = DB::table("colors")->where("color_id", $sale->color_id)->first();
            $url = $color->name."-".$animal->name."-".$breed->name;
        }
        else {
             $url = $animal->name."-".$breed->name;
        }

        $url = str_replace(" ", "-", $url);

        return $this->slugify($url)."-MLM=".base64_encode($sale->sale_id).time();
    }


    public function getNicknameUpdate($sale)
    {
        $animal     = DB::table("animals")->where("animal_id", $sale->animal_id)->first();
        $breed      = DB::table("breeds")->where("breed_id", $sale->breed_id)->first();
        $nickname   = explode("-", $sale->nickname);
        $url        = null;

        if ($sale->color_id != null && $sale->color_id != 0) {
            $color = DB::table("colors")->where("color_id", $sale->color_id)->first();
            $url = $color->name."-".$animal->name."-".$breed->name;
        }
        else {
             $url = $animal->name."-".$breed->name;
        }

        $url = str_replace(" ", "-", $url);

        return $this->slugify($url)."-".$nickname[count($nickname) - 1];
    }


    public function getFavoriteProduct($idsale, $userid)
    {

        if (!auth()->check()) {
            return false;
        }

        if ($userid == auth()->user()->user_id) {
           return true;
        }

        $favorito = Favorite::where(['sale_id' => $idsale, 'user_id' => auth()->user()->user_id])->first();
        if ($favorito !== null) {
            return true;
        }

        return false;
    }


    public function sendEmailFavChangue($sale_id)
    {
        $favoritos = DB::table("favorites")->where("sale_id", $sale_id)->get();
        if ($favoritos != null) {
            foreach ($favoritos as $favorite) {
               $user = DB::table("users")->where("user_id", $favorite->user_id)->first();
               $saleUp = DB::table("sales")
                                    ->join('animals', 'sales.animal_id', '=', 'animals.animal_id')
                                    ->select('sales.*', 'animals.name as animal_name')
                                    ->where("sale_id", $sale_id)
                                    ->where("disabled", 0)
                                    ->first();

                if ($user->email_favorite == 1) {
                    Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new SendUpdateSaleFavorites($user, $saleUp));
                }
               
            }
        }
        
    }



    public function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }
}
