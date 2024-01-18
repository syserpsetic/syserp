<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class ViaticosController extends Controller
{
    public function agregar_viaticos(Request $request){
        $id_viatico = null;

        /*$response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/viaticos');

        $empleados = $response['empleados'];
        $departamentos = $response['departamentos'];
        $ciudades = $response['ciudades'];
        $fuentes = $response['fuentes'];
        $gerencia_administrativa = $response['gerencia_administrativa'];
        $programas = $response['programas'];
        $ue = $response['ue'];
        $act = $response['act'];
        $articulos = $response['articulos'];

        return view('pages.solicitudes.viaticos')->with('empleados', $empleados)->with('departamentos', $departamentos)
                                                    ->with('ciudades', $ciudades)->with('fuentes', $fuentes)
                                                    ->with('gerencia_administrativa', $gerencia_administrativa)
                                                    ->with('programas', $programas)->with('ue', $ue)->with('act', $act)
                                                    ->with('articulos', $articulos);*/
            return $this->ver_viaticos($request, $id_viatico);                                           
    }

    public function editar_viaticos(Request $request, $id_viatico){
        $id_viatico = $request->id_viatico;
       /* $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/viaticos');

        $empleados = $response['empleados'];
        $departamentos = $response['departamentos'];
        $ciudades = $response['ciudades'];
        $fuentes = $response['fuentes'];
        $gerencia_administrativa = $response['gerencia_administrativa'];
        $programas = $response['programas'];
        $ue = $response['ue'];
        $act = $response['act'];
        $articulos = $response['articulos'];

        return view('pages.solicitudes.viaticos')->with('empleados', $empleados)->with('departamentos', $departamentos)
                                                    ->with('ciudades', $ciudades)->with('fuentes', $fuentes)
                                                    ->with('gerencia_administrativa', $gerencia_administrativa)
                                                    ->with('programas', $programas)->with('ue', $ue)->with('act', $act)
                                                    ->with('articulos', $articulos);   */

     
            return $this->ver_viaticos($request, $id_viatico);                                        
    }

    private function ver_viaticos(Request $request, $id_solicitud){
        $data = [];
        $estatus = True;

        if(!empty($id_solicitud)){
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/token/viaticos/editar', [
                'id_solicitud' => $id_solicitud
            ]);

            $data = $response->json();
            $estatus = $data['estatus'];
            //throw new Exception($data['empleados']);
        }
        
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/viaticos');

        //throw new Exception($data['estatus']);
        if($response->status() === 403){
            return view('pages.error-page-403');
        }
        if(!$estatus){
            return view('pages.error-page-404');
        }
        
        $estados_disponibles = ($id_solicitud == null || $id_solicitud == '') ? $response['estados_disponibles'] : $data['estados_disponibles'];
        $empleados = ($id_solicitud == null || $id_solicitud == '') ? $response['empleados'] : $data['empleados'];
        $empleado_conductor = ($id_solicitud == null || $id_solicitud == '') ? $response['empleados'] : $data['empleado_conductor'];
        $departamentos = $response['departamentos'];
        $ciudades = $response['ciudades'];
        $ciudades_elegidas = ($id_solicitud == null || $id_solicitud == '') ? [] : $data['ciudades_elegidas'];
        $fuentes = ($id_solicitud == null || $id_solicitud == '') ? $response['fuentes'] : $data['fuentes'];
        $gerencia_administrativa = $response['gerencia_administrativa'];
        $programas = ($id_solicitud == null || $id_solicitud == '') ? $response['programas'] : $data['programas'];
        $ue = ($id_solicitud == null || $id_solicitud == '') ? $response['ue'] : $data['ue'];
        $act = ($id_solicitud == null || $id_solicitud == '') ? $response['act'] : $data['act'];
        $articulos = ($id_solicitud == null || $id_solicitud == '') ? $response['articulos'] : $data['articulos'];
        $firmas_jefaturas = ($id_solicitud == null || $id_solicitud == '') ? $response['firmas_jefaturas'] : $data['firmas_jefaturas'];
        $detalle_viatico = ($id_solicitud == null || $id_solicitud == '') ? $response['detalle_viatico'] : $data['detalle_viatico'];
        //throw new Exception($detalle_viatico['vehiculo_placa']);

        return view('pages.solicitudes.viaticos')
                ->with('estados_disponibles', $estados_disponibles)
                ->with('empleados', $empleados)->with('empleado_conductor', $empleado_conductor)
                ->with('departamentos', $departamentos)->with('ciudades_elegidas', $ciudades_elegidas)
                ->with('ciudades', $ciudades)->with('fuentes', $fuentes)
                ->with('gerencia_administrativa', $gerencia_administrativa)
                ->with('programas', $programas)->with('ue', $ue)->with('act', $act)
                ->with('articulos', $articulos)->with('firmas_jefaturas', $firmas_jefaturas)
                ->with('detalle_viatico', $detalle_viatico)->with("id_solicitud", $id_solicitud);
        
    }
    

    public function guardar_viaticos(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/token/viaticos/guardar', [
                'id' => $request->id,
                'accion' => $request->accion,
                'numero_empleado' => $request->numero_empleado,
                'vehiculo_placa' => $request->vehiculo_placa,
                'vehiculo_tipo' => $request->vehiculo_tipo,
                'fecha_salida' => $request->fecha_salida,
                'fecha_retorno' => $request->fecha_retorno,
                'itinerario' => $request->itinerario,
                'numero_empleado_conductor' => $request->numero_empleado_conductor,
                'proposito' => $request->proposito,
                'id_institucion' => $request->id_institucion,
                'id_fuente' => $request->id_fuente,
                'id_gerencia_administrativa' => $request->id_gerencia_administrativa,
                'id_programa' => $request->id_programa,
                'id_unidad_ejecutora' => $request->id_unidad_ejecutora,
                'id_actividad_obra' => $request->id_actividad_obra,
                'id_articulo' => $request->id_articulo,
                'id_firma_jefatura' => $request->id_firma_jefatura,
                'enviar_correo' => $request->enviar_correo,
                'id_solicitud_estado' => $request->id_solicitud_estado,
                'estado' => $request->estado,
                'observacion_estado' => $request->observacion_estado
            ]);
            
            $data = $response->json();
            if(!$data["estatus"]){
                $msgError = "Desde backend: ".$data["msgError"];
            }
            $msgSuccess = $data["msgSuccess"];
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        
        // //return response()->json($data);
        //throw new \Exception($data);
        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }
}
