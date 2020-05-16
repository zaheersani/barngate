<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Validator;

use Socialite;
use Auth;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        return abort(404);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try 
        {
            $socailuser = Socialite::driver('google')->user();
            $user = User::where('email',$socailuser->getEmail())->first();
            if( $user ) {
                $user->update([
                    'username' => $socailuser->getName(),
                    'email' => $socailuser->getEmail(),
                ]);   
            
            } else {
                // create a new user
                $user = User::create([
                    'username' => $socailuser->getName(),
                    'email' => $socailuser->getEmail(),
                ]);
            }
        
            Auth::login($user, true);
            
            return redirect()->intended('/');
        } 
        catch (Exception $e) 
        {
            //dd($e);
            return redirect('login/google');
        }

        
    }

    public function redirectToFacebook()
    {
        //return Socialite::driver('facebook')->redirect();


        return Socialite::driver('facebook')->fields([
            'username', 'email'
        ])->scopes([
            'email'
        ])->redirect();


    }
    public function handleFacebookCallback()
    {
        try 
        {
              $socailuser = Socialite::driver('facebook')->stateless()->user();          
        } 
        catch (Exception $e) 
        {
           dd($e);
            return redirect('/');
        }
        $user = User::where('email',$socailuser->getEmail())->first();
        if( $user ) {
            $user->update([
                'username' => $socailuser->getName(),
                'email' => $socailuser->getEmail(),
             ]);   
           
        } else {
            // create a new user
            $user = User::create([
                'username' => $socailuser->getName(),
                'email' => $socailuser->getEmail(),
            ]);
        }
    //    dd($user);
       Auth::login($user, true);
         
        return redirect()->intended('/');
         
    }
}
