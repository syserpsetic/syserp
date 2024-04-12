<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use DB;
Use Session;
use Exception;

class CategoriasController extends Controller
{
    public function view_categorias(Request $request){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/configuracion/categorias');

        if($response->status() === 403){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $categorias = $response['categorias'];
        $scopes = $response['scopes'];

        return view('pages.configuracion.categorias')->with('categorias', $categorias)->with('scopes', $scopes);
    }
 
    public function data_categorias(Request $request){
        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/token/configuracion/categorias');
    
        $categorias = $response->json()['categorias'];
    
        $recordsTotal = count($categorias);
        $recordsFiltered = $recordsTotal;
    
        return response()->json([
            "draw" => intval($request->input('draw', 0)),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $categorias
        ]);  //*/
    }

    public function guardar_categorias(Request $request){
        $msgSuccess = null;
        $msgError = null;
        $categoria_list = null;

        try {
            //throw new Exception('Epa', true);
            $response = Http::withHeaders([
                'Authorization' => session('token'),
                'Content-Type' => 'application/json',
            ])->post(env('API_BASE_URL_ZETA').'/api/auth/configuracion/categorias/guardar', [
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
                $categoria_list = $data["categoria_list"];
            }elseif($response->status() === 403){
                $msgError = "No tiene permisos para realizar esta acción";
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(['msgSuccess' => $msgSuccess, 'msgError' => $msgError, 'categoria_list' => $categoria_list]);
   }
}
