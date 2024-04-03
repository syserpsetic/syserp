<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControladorPermisos extends Controller
{
    public function ver_permisos(){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->post(env('API_BASE_URL_ZETA').'/api/auth/ver_permisos');

        $scopes = $response['scopes'];

        return $scopes;
    }
}
