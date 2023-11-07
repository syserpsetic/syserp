<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.main', [
            'layout' => 'base'
        ]);
        //return view('auth.login');
    }

    public function login(Request $request)
    {

        
        // Validar las credenciales del formulario
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Realizar una solicitud a la API externa para autenticar al usuario
        $response = Http::post(env('API_BASE_URL_ZETA').'/api/auth/login', [
            'username' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($response->status() === 200) {
            // Autenticación exitosa con la API externa
            // Obtener los datos del usuario de la respuesta de la API
            $userData = $response->json();

            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $user = User::firstOrNew([$fieldType => $request->input('email')]);
            $user->name = $userData['name'];
            $user->password = '0';
            $user->save();
            Session::put('token', $userData['token']);
            auth()->login($user);

            return redirect('/');
        } else {
            // Autenticación fallida
            throw new \Exception('Usuario o contraseña invalidos.');
            //return redirect()->route('login')->withErrors(['email' => 'Credenciales incorrectas']);
        }
    }

    public function logout()
    {
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->post(env('API_BASE_URL_ZETA').'/api/token/logout');


        if($response->status() === 200){
            session()->flush();
            Auth::logout();
            return redirect('login');
        }
        
    }
}
