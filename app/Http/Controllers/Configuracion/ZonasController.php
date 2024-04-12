<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class ZonasController extends Controller
{
    public function view_zonas(Request $request){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/zonas');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $zonas = $response['zonas'];
        $scopes = $response['scopes'];

        return view('pages.configuracion.zonas')->with('zonas', $zonas)->with('scopes', $scopes);
    }
 
    public function data_zonas(Request $request){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/zonas');
    
        $zonas = $response->json()['zonas'];
    
        $recordsTotal = count($zonas);
        $recordsFiltered = $recordsTotal;
    
        return response()->json([
            "draw" => intval($request->input('draw', 0)),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $zonas
        ]);  //*/
    }

    public function guardar_zonas(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $zona_list = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/configuracion/zonas/guardar', [
                'id' => $request->id,
                'accion' => $request->accion,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            //throw new Exception($response->status(), true);
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
                $zona_list = $data["zona_list"];
                //throw New Exception($estados_list, true);
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError, 'zona_list' => $zona_list]);
   }
}
