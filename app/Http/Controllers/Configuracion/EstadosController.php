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

        return view('pages.configuracion.estados');
    }
 
    public function data_estados(Request $request){
 
         $response = Http::withHeaders([
             'Authorization' => session('token'),
         ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/estados');
 
         $estados = $response['estados'];
         //throw new \Exception($estados);
 
         return $estados;
    }

    public function guardar_estados(Request $request){
        $msgSuccess = null;
        $msgError = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/token/configuracion/estados/guardar', [
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
}
