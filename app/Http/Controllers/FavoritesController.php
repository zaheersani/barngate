<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ConfirmFavorites;
use Illuminate\Support\Facades\Mail;
use App\Favorite;
use App\Sale;
use DB;

class FavoritesController extends Controller
{


    public function __construct()
    {
        $this->middleware("auth");
    }


    public function addFavorite(Request $request) {

    	if ($request->has('idProducto')) {
            
           $product = DB::table('sales')->where('nickname', $request->idProducto)->first();

            if ($product) {
                
                $favorite = new Favorite();
                $favorite->user_id = auth()->user()->user_id;
                $favorite->sale_id = $product->sale_id;

                if ($favorite->save()) {

                    try {
                        if (auth()->user()->email_favorite == true) {
                            $sale = Sale::find($product->sale_id);
                            //Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new ConfirmFavorites($sale));
                        }
                    } catch(Exception $e) {
                         \Log::error("El error de Email de Favoritos ".$e->getMessage());
                    }
                    

                    return response()->json(['message' => 'ok']);
                }

                return response()->json(['message' => 'not_save']);
              
            }

            return response()->json(['message' => 'not']);
        }

        return response()->json(['message' => 'not parameters']);
    }
}
