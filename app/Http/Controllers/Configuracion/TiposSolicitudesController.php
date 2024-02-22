<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class TiposSolicitudesController extends Controller
{
    public function view_tipos_solicitudes(Request $request){

        return view('pages.configuracion.tipos_solicitudes');
    }

    public function data_tipos_solicitudes(Request $request){
 
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/tipos_solicitudes');

        $tipos_solicitudes = $response['tipos_solicitudes'];

        return $tipos_solicitudes;
   }

   public function guardar_tipos_solicitudes(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/token/configuracion/tipos_solicitudes/guardar', [
                'id' => $request->id,
                'accion' => $request->accion,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            
            $data = $response->json();
            if(!$data["estatus"]){
                $msgError = "Desde backend: ".$data["msgError"];
            }
            $msgSuccess = $data["msgSuccess"];
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }

    public function view_tipos_solicitudes_asignar_estados(Request $request, $id_tipo_solicitud){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/tipos_solicitudes', [
            'id' => $id_tipo_solicitud,
        ]);

        $tipos_solicitudes = $response['tipos_solicitudes'];

        return view('pages.configuracion.tipos_solicitudes_asignar_estados')
                ->with("tipos_solicitudes", $tipos_solicitudes)
                ->with("id_tipo_solicitud", $id_tipo_solicitud);
    }

    public function data_tipos_solicitudes_asignar_estados(Request $request, $id_tipo_solicitud){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/tipos_solicitudes_asignar_estados', [
            'id' => $id_tipo_solicitud,
        ]);

        $tipos_solicitudes_asignar_estados = $response['tipos_solicitudes_asignar_estados'];

        return $tipos_solicitudes_asignar_estados;
    }
}
