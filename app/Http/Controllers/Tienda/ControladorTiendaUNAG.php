<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class ControladorTiendaUNAG extends Controller
{
    public function view_facturar(Request $request){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $tndProductoExistencia = $response['tndProductoExistencia'];
        // $tnd_clientes_list = $response['tnd_clientes_list'];
        $tnd_productos_list = $response['tnd_productos_list'];
        $hora_fecha_actual = $response['hora_fecha_actual'];
        $tnd_empaque_list = $response['tnd_empaque_list'];
        $tnd_medida_list = $response['tnd_medida_list'];
        $configuracion_factura = $response['configuracion_factura'];
        $tnd_impuestos_list = $response['tnd_impuestos_list'];
        $metodos_pago = $response['metodos_pago'];
        $scopes = $response['scopes'];

        return view('pages.tienda.tnd-facturar')
            // ->with('tnd_clientes_list', $tnd_clientes_list)
            ->with('tnd_productos_list', $tnd_productos_list)
            ->with('tndProductoExistencia', $tndProductoExistencia)
            ->with('hora_fecha_actual', $hora_fecha_actual)
            ->with('tnd_empaque_list', $tnd_empaque_list)
            ->with('tnd_medida_list', $tnd_medida_list)
            ->with('configuracion_factura', $configuracion_factura)
            ->with('tnd_impuestos_list', $tnd_impuestos_list)
            ->with('metodos_pago', $metodos_pago)
            ->with('scopes', $scopes);
    }

    public function view_facturar_data_clientes(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar/data/clientes');


        $tnd_clientes_list = $response['tnd_clientes_list'];

        $recordsTotal = count($tnd_clientes_list);
        $recordsFiltered = $recordsTotal;

        return response()->json([
            "draw" => intval($request->input('draw', 0)),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $tnd_clientes_list
        ]);
    }

    public function view_facturar_data_productos(Request $request)
    {
        $id_producto = $request->id_producto;
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->post(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar/data/productos', [
            'id_producto' => $id_producto
        ]);


        $tnd_productos_list = $response['tnd_productos_list'];
        $msgSuccess = $response['msgSuccess'];

        $recordsTotal = count($tnd_productos_list);
        $recordsFiltered = $recordsTotal;

        return response()->json([
            //"draw" => intval($request->input('draw', 0)),
            //"recordsTotal" => $recordsTotal,
            //"recordsFiltered" => $recordsFiltered,
            "tnd_productos_list" => $tnd_productos_list,
            "msgSuccess" => $msgSuccess
        ]);
    }

    public function modificar_tnd_facturas_pendientes($id_factura){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->post(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar/pendientes/factura-modificar', [
            'id_factura' => $id_factura
        ]);

            $tnd_productos_list = $response['tnd_productos_list'];
            $tnd_clientes_list = $response['tnd_clientes_list'];
            $tnd_empaque_list = $response['tnd_empaque_list'];
            $tnd_medida_list = $response['tnd_medida_list'];
            $hora_fecha_actual = $response['hora_fecha_actual'];
            $configuracion_factura = $response['configuracion_factura'];
            $tnd_impuestos_list = $response['tnd_impuestos_list'];
            $metodos_pago = $response['metodos_pago'];
            $factura_products_list = $response['factura_products_list'];
            $impuestos = $response['impuestos'];
            $totales = $response['totales'];
            $total_articulos = $response['total_articulos'];
            $scopes = $response['scopes'];

            return view("pages.tienda.tnd-facturar")
            ->with("tnd_productos_list", $tnd_productos_list)
            ->with("tnd_clientes_list", $tnd_clientes_list)
            ->with("tnd_empaque_list", $tnd_empaque_list)
            ->with("tnd_medida_list", $tnd_medida_list)
            ->with("hora_fecha_actual", $hora_fecha_actual)
            ->with("configuracion_factura", $configuracion_factura)
            ->with("tnd_impuestos_list", $tnd_impuestos_list)
            ->with("metodos_pago", $metodos_pago)
            ->with("factura_products_list", $factura_products_list)
            ->with("impuestos", $impuestos)
            ->with("totales", $totales)
            ->with("total_articulos", $total_articulos)
            ->with('scopes', $scopes)
            ;
    }

    public function tnd_facturas_productos_reservar(Request $request){
        $id_producto_cantidad = $request->id_producto_cantidad;
        $id_factura  = $request->id_factura;
        $id_factura_filas = $request->id_factura_filas;
        $cantidad = $request->cantidad;
        $accion = $request->accion;
        $productos_list = null;
        $nueva_cantidad = null;
        $impuestos = null;
        $totales = null;
        $msgError = null;
        $msgSuccess = null;

        
        try {
            //throw new Exception($id_factura, 1);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/punto-venta/facturar/reservar/productos', [
                'id_producto_cantidad' => $id_producto_cantidad,
                'id_factura' => $id_factura,
                'id_factura_filas' => $id_factura_filas,
                'cantidad' => $cantidad,
                'accion' => $accion,
            ]);
            //throw new Exception($response->status(), true);
            $data = $response->json();
            if($response->status() === 200){
                if(!$data["estatus"]){
                    $msgError = "Desde backend: ".$data["msgError"];
                }

                $msgSuccess = $data["msgSuccess"];
                $nueva_cantidad = $data["nueva_cantidad"];
                $id_producto_cantidad = $data["id_producto_cantidad"];
                $productos_list = $data["productos_list"];
                $impuestos = $data["impuestos"];
                $totales = $data["totales"];
                $accion = $data["accion"];
                //throw New Exception($estados_list, true);
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json([
            "msgSuccess" => $msgSuccess, 
            "msgError" => $msgError, 
            "nueva_cantidad" => $nueva_cantidad, 
            "id_producto_cantidad" => $id_producto_cantidad, 
            "productos_list" => $productos_list, 
            "impuestos" => $impuestos,
            "totales" => $totales, 
            "accion" => $accion
        ]);
    }
}
