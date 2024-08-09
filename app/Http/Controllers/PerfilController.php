<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PerfilController extends Controller
{
    /**
     * Show specified view.
     *
     */

    public function perfil(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/ver_perfil');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $perfil = $response['perfil'];
        $scopes = $response['scopes'];

        return view('pages.perfil')->with('perfil', $perfil)->with('scopes', $scopes);
    }

    public function cambiar_clave(Request $request)
    {
        $msgSuccess = null;
        $msgError = null;
        $clave_actual = $request->clave_actual;
        $clave_nueva = $request->clave_nueva;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/cambiar-clave-perfil', [
                'clave_actual' => $clave_actual,
                'clave_nueva' => $clave_nueva
            ]);
            
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }

}
