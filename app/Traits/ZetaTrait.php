<?php
namespace App\Traits;
use DB;
use Session;
use Exception;
use Illuminate\Support\Facades\Config;
use Auth;

trait ZetaTrait {
    
    public static function cargarPermisosYLogs($username){
        //Esta funcion debe limitarse a cargar permisos en sesion
            
        $username = Auth::user()->username;

        $permisos_list = array();

        $permisos_list = DB::select("
            select p.descripcion_permiso permiso
            from permisos p
                join permisos_usuarios pu on p.id = pu.id_permiso and pu.deleted_at is null 
                and pu.username = :username
                and now() between fecha_inicio and fecha_fin
            where p.deleted_at is null
            ", ['username' => $username]);

        return $permisos_list;
    }    
}
