<?php

namespace App\Http\Controllers\MallaValidacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class MallaValidacionController extends Controller
{
    public function malla_validaciones(){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $scopes = $response['scopes'];

        return view("pages.mallaValidacion.mallaValidacion")
        ->with('scopes', $scopes);
    }
}
