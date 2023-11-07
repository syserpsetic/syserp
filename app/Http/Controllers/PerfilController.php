<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Traits\ZetaTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PerfilController extends Controller
{
    /**
     * Show specified view.
     *
     */
    public function cambiar_clave(Request $request)
    {
        $msgError = null;
        $msgSuccess = null;
        $clave_actual = $request->clave_actual;
        $clave_nueva = $request->clave_nueva;
        $clave_nueva = Hash::make($clave_nueva);
        $username = Auth::user()->username;

        ////crear permiso
        //$permission = Permission::create(['name' => 'edit articles']);
        $role = Role::where('id', 1)->first();
        $permission = Permission::where('id', 3)->first();
        $role->givePermissionTo($permission);
        throw New Exception('Permiso asignado');

        try {

        //     $variable = null;
        // $probemos = ZetaTrait::cargarPermisosYLogs($username);
        // foreach($probemos as $permisos){
        //     $variable = $permisos->permiso;
        // }

        // throw New Exception($variable);

            if (password_verify($clave_actual, Auth::user()->password)) {
                DB::select("update users set password = :clave_nueva where username = :username",
                ["clave_nueva" => $clave_nueva, "username" => $username]);
            } else {
                throw New Exception('La contraseña actual no es válida.');
            }
            
            $msgSuccess = 'Contraseña cambiada con éxito.';

        } catch (Exception $e) {
            $msgError = $e->getMessage();
        }

        return response()->json(["msgSuccess" => $msgSuccess, "msgError" => $msgError]);
    }

}
