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
    public function ver_viaticos(Request $request){

        $response = Http::withHeaders([
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

        return view('pages.solicitudes.solicitudes')->with('empleados', $empleados)->with('departamentos', $departamentos)
                                                    ->with('ciudades', $ciudades)->with('fuentes', $fuentes)
                                                    ->with('gerencia_administrativa', $gerencia_administrativa)
                                                    ->with('programas', $programas)->with('ue', $ue)->with('act', $act)
                                                    ->with('articulos', $articulos);
    }

    public function guardar_viaticos(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/token/viaticos/guardar', [
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
                'id_articulo' => $request->id_articulo
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
