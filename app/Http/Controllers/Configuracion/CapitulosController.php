<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class CapitulosController extends Controller
{
    public function view_capitulos(Request $request){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/capitulos');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $capitulos = $response['capitulos'];
        $scopes = $response['scopes'];

        return view('pages.configuracion.capitulos')->with('capitulos', $capitulos)->with('scopes', $scopes);
    }
 
    public function data_capitulos(Request $request){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/capitulos');
    
        $capitulos = $response->json()['capitulos'];
    
        $recordsTotal = count($capitulos);
        $recordsFiltered = $recordsTotal;
    
        return response()->json([
            "draw" => intval($request->input('draw', 0)),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $capitulos
        ]);  //*/
    }

    public function guardar_capitulos(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $capitulo_list = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/configuracion/capitulos/guardar', [
                'id' => $request->id,
                'accion' => $request->accion,
                'nombre' => $request->nombre,
            ]);
            
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
                $capitulo_list = $data["capitulo_list"];
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError, 'capitulo_list' => $capitulo_list]);
   }
}
