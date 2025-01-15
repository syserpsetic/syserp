<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;

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
    public function handleGoogleCallback(Request $request)
{
    $response = Http::get(env('API_BASE_URL_ZETA').'/api/auth/google/callback');
    //throw new Exception('Hola');
    if ($response->successful()) {
        $data = $response->json();

        // Guarda el token en el cliente (por ejemplo, en localStorage o cookies)
        session(['access_token' => $data['access_token']]);

        return redirect('/');
    }

    return redirect('/login')->with('error', 'Error al autenticar con Google.');
}

}
