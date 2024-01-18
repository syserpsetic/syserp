<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Exception;

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
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // if ($request->coordenadas){
            $response = Http::post(env('API_BASE_URL_ZETA').'/api/auth/login', [
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'coordenadas' => $request->coordenadas
            ]);
        // } else {
        //     throw new Exception('¡Acceso al sistema denegado! Debe Permitir la Ubicación.');
        // }

        if ($response->status() === 200) {
            $userData = $response->json();
            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user = User::firstOrNew([$fieldType => $request->input('email')]);
            $user->name = $userData['name'];
            $user->password = '0';
            $user->save();
            Session::put('token', $userData['token']);
            auth()->login($user);
            return redirect('/');
        } elseif($response->status() === 403) {
            throw new Exception('¡Acceso al sistema denegado!');
        } else {
            throw new Exception('¡Usuario o contraseña incorrectos!');
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
