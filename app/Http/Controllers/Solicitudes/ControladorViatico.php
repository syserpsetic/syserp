<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;
use App\Http\Controllers\ControladorPermisos;

class ControladorViatico extends Controller
{
    public function agregar_viaticos(Request $request){
        $id_viatico = null;

        /*$response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/viaticos');

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
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/viaticos');

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

        $scopes = new ControladorPermisos();
        $scopes = $scopes->ver_permisos();

        if(!empty($id_solicitud)){
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/viaticos/editar', [
                'id_solicitud' => $id_solicitud
            ]);

            if($response->status() === 200){
                $data = $response->json();
                $estatus = $data['estatus'];
                //throw new Exception($data['empleados']);
            }
        }
        
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/viaticos');

        //throw new Exception($data['estatus']);
        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }
        if(!$estatus){
            return view('pages.error-page-404')->with('scopes', $scopes = array());
        }
        
        $cambiar_estado = ($id_solicitud == null || $id_solicitud == '') ? $response['cambiar_estado'] : $data['cambiar_estado'];
        $estados_disponibles = ($id_solicitud == null || $id_solicitud == '') ? $response['estados_disponibles'] : $data['estados_disponibles'];
        $estados_disponibles_rechazar = ($id_solicitud == null || $id_solicitud == '') ? $response['estados_disponibles_rechazar'] : $data['estados_disponibles_rechazar'];
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
                ->with('cambiar_estado', $cambiar_estado)
                ->with('estados_disponibles', $estados_disponibles)
                ->with('estados_disponibles_rechazar', $estados_disponibles_rechazar)
                ->with('empleados', $empleados)->with('empleado_conductor', $empleado_conductor)
                ->with('departamentos', $departamentos)->with('ciudades_elegidas', $ciudades_elegidas)
                ->with('ciudades', $ciudades)->with('fuentes', $fuentes)
                ->with('gerencia_administrativa', $gerencia_administrativa)
                ->with('programas', $programas)->with('ue', $ue)->with('act', $act)
                ->with('articulos', $articulos)->with('firmas_jefaturas', $firmas_jefaturas)
                ->with('detalle_viatico', $detalle_viatico)->with("id_solicitud", $id_solicitud)
                ->with('scopes', $scopes);
        
    }
    

    public function guardar_viaticos(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/viaticos/guardar', [
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

        
        // //return response()->json($data);
        //throw new \Exception($data);
        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError]);
    }

    public function guardar_viaticos_monto(Request $request){
        $viajerosList = null;
        $msgSuccess = null;
        $msgError = null;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/viaticos/asignar_monto', [
                'id' => $request->id,
                'monto' => $request->monto,
            ]);
            
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
                $viajerosList = $data["viajerosList"];
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        
        // //return response()->json($data);
        //throw new \Exception($data);
        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError,"viajerosList" => $viajerosList]);
    }

    public function verCalculos($id_solicitud, $numero_empleado){
        $msgSuccess = null;
        $msgError = null;

        //throw New Exception($numero_empleado);

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->post(env('API_BASE_URL_ZETA').'/api/auth/solicitud_viaticos/ver_calculos/viajero', [
            'id_solicitud' => $id_solicitud,
            'numero_empleado' => $numero_empleado,
        ]);

        if($response->status() === 403 || $response['estatus'] == false){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $diasJornadas = $response['diasJornadas'];
        $detalleViaje = $response['detalleViaje'];
        $viajerosLista = $response['viajerosLista'];
        $zonasDisponibles = $response['zonasDisponibles'];
        $categorias = $response['categorias'];
        $zonasCalculadas = $response['zonasCalculadas'];
        $tasaCambioAsignada = $response['tasaCambioAsignada'];
        $detalleCalculo = $response['detalleCalculo'];
        $tasaCambio = $response['tasaCambio'];
        $tasaCambioFormato = $response['tasaCambioFormato'];
        $scopes = $response['scopes'];

        return view('pages.solicitudes.viaticos.calculo-viatico')
                ->with('diasJornadas', $diasJornadas)
                ->with('detalleViaje', $detalleViaje)
                ->with('viajerosLista', $viajerosLista)
                ->with('zonasDisponibles', $zonasDisponibles)
                ->with('categorias', $categorias)
                ->with('zonasCalculadas', $zonasCalculadas)
                ->with('tasaCambioAsignada', $tasaCambioAsignada)
                ->with('detalleCalculo', $detalleCalculo)
                ->with('tasaCambio', $tasaCambio)
                ->with('tasaCambioFormato', $tasaCambioFormato)
                ->with('scopes', $scopes);
    }

    public function guardarCalculos(Request $request){
        $zonaId = $request->zonaId;
        $categoriaId = $request->categoriaId;
        $solicitudId = $request->solicitudId;
        $numeroEmpleado = $request->numeroEmpleado;
        $calculos = $request->calculos;
        $accion = $request->accion;
        $msgSuccess = null;
        $msgError = null;

        //throw New Exception($numeroEmpleado);
        try {
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/solicitud_viaticos/guardar_calculos/viajero', [
                'accion' => $accion,
                'zonaId' => $zonaId,
                'categoriaId' => $categoriaId,
                'solicitudId' => $solicitudId,
                'numeroEmpleado' => $numeroEmpleado,
                'calculos' => $calculos,
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
