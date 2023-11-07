<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Socialite;

class AuthController extends Controller
{
    /**
     * Show specified view.
     */
    public function loginView(): View
    {
        return view('login.main', [
            'layout' => 'base'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(LoginRequest $request): void
    {
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if (!Auth::attempt([
            $fieldType => $request->email,
            'password' => $request->password
        ])) {
            throw new \Exception('Usuario o contraseña invalidos.');
        }
    }

    /**
     * Logout user.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('login');
    }

    /* Funcion que redirecciona a seleccionar la cuenta de google*/
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /*Funcion que captura los datos y los maneja*/
    public function handleGoogleCallback()
    {
        try {
            
            $user = Socialite::driver('google')->user();

            //$findGuser = User::where('email', $user->email)->first();
            $findGuser = User::where(DB::raw('lower(email)'), 'LIKE', strtolower($user->email) )->first();
            
            if($findGuser ){
            
               $usuarioId = $findGuser->username;
               
               
               Auth::login($findGuser);
               return $this->cargaPermisosRuta( $usuarioId);
    
               
               //return redirect('/home');
     
            } else {
                //$msg = 'It is done';
                \Session::flash('msgWarning', 'Su cuenta '.$user->email.' no pertenece a una registrada, por favor use otra.' );
                
                return redirect('login');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
