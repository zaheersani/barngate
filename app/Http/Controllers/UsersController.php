<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\MessageRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



//MODELS
use App\User;

//DB
use DB;

class UsersController extends Controller
{


    public function ajaxLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }


       $userEmail = User::where('email', $request->email)->first();

        if ($userEmail) {
            
            $auth = false;
            $credentials = $request->only('email', 'password');

            if ( Auth::attempt($credentials, $request->has('remember')) ) {
                $auth = true; // Success
            }

            //return response()->json($credentials);

           return response()->json([
                'auth' => $auth,
                'message' => 'password'
            ]);
        }

        return response()->json([
                'auth' => false,
                'message' => 'email'
        ]);
    }
    
    public function createRegistro(Request $request)
    {

        //return response()->json(\Hash::make($request->password));

    	$validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => ['required'],
        ]);


        if ($validator->fails()) {
        	return response()->json($validator->errors(), 202);
        }


        //VALIDAR RECAPTCHA
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LcFBegUAAAAAH0omvVqxZQEV6JjNwaxzGsSzYwu',
            'response' => request("g-recaptcha-response"),
        );
        $options = array(
            'http' => array (
                'header' => "Content-Type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context            = stream_context_create($options);
        $verify             = file_get_contents($url, false, $context);
        $captcha_success    = json_decode($verify);


        if ($captcha_success->success) {

    	   DB::beginTransaction();

        	$users 					= new User();
            $users->username      	= $request->username;
            $users->email       	= $request->email;
            $users->password		= bcrypt($request->password);

            if ($users->save()) {

                // login automatico
                Auth::login($users);

                try {
               	    //Mail::to("853e9296af-b1cadc@inbox.mailtrap.io")->send(new MessageRegister($request));
                } catch(Exception $e) {
                     \Log::error("El error de Email de Registro ".$e->getMessage());
                }


               	DB::commit();
                return response()->json(["message" => "ok"], 202);
            }
            else {
                DB::rollback();
                return response()->json(["message" => "off"], 202);
            }
        }
        else {
            return response()->json(["message" => "error_captcha"], 202);
        }
    }
}
