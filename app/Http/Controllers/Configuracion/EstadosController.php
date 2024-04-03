<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class EstadosController extends Controller
{
    public function view_estados(Request $request){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/estados');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $estados = $response['estados'];
        $scopes = $response['scopes'];

        return view('pages.configuracion.estados')->with('estados', $estados)->with('scopes', $scopes);
    }
 
    public function data_estados(Request $request){
 
         $response = Http::withHeaders([
             'Authorization' => session('token'),
         ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/estados');
 
         $estados = $response['estados'];
         
          $recordsTotal = count($estados);
        $recordsFiltered = $recordsTotal;
    
        return response()->json([
            "draw" => intval($request->input('draw', 0)),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $estados
        ]);  //*/
    }

    public function guardar_estados(Request $request){
        $estados_list = null;
        $msgSuccess = null;
        $msgError = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/configuracion/estados/guardar', [
                'id' => $request->id,
                'accion' => $request->accion,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
                $estados_list = $data["estados_list"];
                //throw New Exception($estados_list, true);
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError, 'estados_list' => $estados_list]);
   }

   public function cambiar_estados(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/cambiar_estados', [
                'id' => $request->id,
                'id_solicitud_estado' => $request->id_solicitud_estado,
                'estado' => $request->estado,
                'observacion_estado' => $request->observacion_estado,
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
