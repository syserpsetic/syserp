<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;
use App\Http\Controllers\ControladorPermisos;

class TiposSolicitudesController extends Controller
{
    public function view_tipos_solicitudes(Request $request){
        $scopes = new ControladorPermisos();
        $scopes = $scopes->ver_permisos();
        
        if(!in_array('zeta_leer_tipos_solicitudes', $scopes)){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }
        return view('pages.configuracion.tipos_solicitudes')->with('scopes', $scopes);
    }

    public function data_tipos_solicitudes(Request $request){
 
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/tipos_solicitudes');

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
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/configuracion/tipos_solicitudes/guardar', [
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
        $scopes = new ControladorPermisos();
        $scopes = $scopes->ver_permisos();

        if(!in_array('zeta_leer_tipos_solicitudes_asignar_estados', $scopes)){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/tipos_solicitudes', [
            'id' => $id_tipo_solicitud,
        ]);

        $tipos_solicitudes = $response['tipos_solicitudes'];

        return view('pages.configuracion.tipos_solicitudes_asignar_estados')
                ->with("tipos_solicitudes", $tipos_solicitudes)
                ->with("id_tipo_solicitud", $id_tipo_solicitud)
                ->with('scopes', $scopes);
    }

    public function data_tipos_solicitudes_asignar_estados(Request $request, $id_tipo_solicitud){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/tipos_solicitudes_asignar_estados', [
            'id' => $id_tipo_solicitud,
        ]);

        $tipos_solicitudes_asignar_estados = $response['tipos_solicitudes_asignar_estados'];

        return $tipos_solicitudes_asignar_estados;
    }
}
