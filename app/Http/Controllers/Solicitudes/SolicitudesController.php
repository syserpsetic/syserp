<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\Request;
use DB;
Use Session;
use Exception;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use App\Http\Controllers\ControladorPermisos;

class SolicitudesController extends Controller
{
    public function view_solicitudes(Request $request){
        $scopes = new ControladorPermisos();
        $scopes = $scopes->ver_permisos();
        return view('pages.solicitudes.solicitudes')->with('scopes', $scopes);
    }

    public function data_solicitudes(Request $request){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/solicitudes');

        $ordenes_viajes = $response['data'];
        //throw new \Exception($ordenes_viajes);

        return $ordenes_viajes;
    }

    public function imprimir_solicitudes($id_solicitud, $id_empleado){

       // throw new Exception($id_solicitud.' '. $id_empleado);
      
        $response = Http::withHeaders([
            'Authorization' => session('token'),
            'Content-Type' => 'application/json',
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/solicitudes/empleado/imprimir', [
            'id_solicitud' => $id_solicitud,
            'id_empleado' => $id_empleado
        ]);

        $data = $response['solicitud'];

        //throw new Exception($data['nombre_viajero']);

        
        $file = public_path('/documentos/orden_viaje.docx');

        $template = new \PhpOffice\PhpWord\TemplateProcessor( $file ); 
            $template->setValue('nombre', $data['nombre_viajero']);
            $template->setValue('cargo', $data['cargo']);
            $template->setValue('departamento', $data['departamento']);
            $template->setValue('vehiculo_placa', $data['vehiculo_placa']);
            $template->setValue('vehiculo_tipo', $data['vehiculo_tipo']);
            $template->setValue('monto_diario_asignado_formato', $data['monto_diario_asignado_formato']);
            $template->setValue('fecha_salida', $data['fecha_salida']);
            $template->setValue('hora_salida', $data['hora_salida']);
            $template->setValue('fecha_retorno', $data['fecha_retorno']);
            $template->setValue('hora_retorno', $data['hora_retorno']);
            $template->setValue('itinerario', $data['itinerario']);
            $template->setValue('nombre_conductor', $data['nombre_conductor']);
            $template->setValue('proposito', $data['proposito']);
            $template->setValue('identidad', $data['identidad']);
            $template->setValue('fuente', $data['fuente']);
            $template->setValue('ga', $data['ga']);
            $template->setValue('programa', $data['programa']);
            $template->setValue('ue', $data['ue']);
            $template->setValue('ao', $data['ao']);
            $template->setValue('articulos', $data['articulos']);
            $template->setValue('firma_jefatura', $data['firma_jefatura']);
            $template->setValue('fecha_actual', $data['fecha_actual']);
            
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            // // Crea un objeto PhpWord para leer el archivo de Word
            // $phpWord = IOFactory::load($tempFile);

            // // Crea un objeto Dompdf
            // $dompdf = new Dompdf();

            // // Convierte el contenido de PhpWord a HTML
            // $html = IOFactory::createWriter($phpWord, 'HTML')->save('php://output');
            
            // // Carga el HTML en Dompdf
            // $dompdf->loadHtml($html);
            
            // // Renderiza el PDF
            // $dompdf->render();
            
            // // Guarda el PDF en el sistema de archivos (en la carpeta storage)
            // $pdfPath = storage_path('app/documento.pdf');
            // file_put_contents($pdfPath, $dompdf->output());
            
            // // Descarga el PDF
            // return response()->download($pdfPath, 'documento.pdf')->deleteFileAfterSend(true);

            //dd(sys_get_temp_dir());
            $headers = [
                "Content-Type: application/octet-stream",
            ];
            
            return response()->download($tempFile, 'Orden de viaje de '.$data['nombre_viajero'].'.docx', $headers)->deleteFileAfterSend(true);
    }

    public function imprimir_viaticos_view($id_solicitud){
        $scopes = new ControladorPermisos();
        $scopes = $scopes->ver_permisos();

        if(!in_array('zeta_leer_viaticos', $scopes)){
            return view('pages.error-page-403')->with('scopes', $scopes = array());
        }

        $response = Http::withHeaders([
            'Authorization' => session('token'),
            'Content-Type' => 'application/json',
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/solicitudes/viaticos/imprimir', [
            'id_solicitud' => $id_solicitud
        ]);

        $orden_viaje = $response['orden_viaje'];
        $cambiar_estado = $response['cambiar_estado'];
        $estados_disponibles = $response['estados_disponibles'];
        $estados_disponibles_rechazar = $response['estados_disponibles_rechazar'];
        return view('pages.solicitudes.reportesviaticos')->with("orden_viaje", $orden_viaje)
                                                        ->with("cambiar_estado", $cambiar_estado)
                                                        ->with("estados_disponibles", $estados_disponibles)
                                                        ->with("estados_disponibles_rechazar", $estados_disponibles_rechazar)
                                                        ->with('scopes', $scopes);
    }

    public function imprimir_viaticos_view_viajeros($id_solicitud){

        $response = Http::withHeaders([
            'Authorization' => session('token'),
            'Content-Type' => 'application/json',
        ])->get(env('API_BASE_URL_ZETA').'/api/auth/solicitudes/viaticos/imprimir/viajeros', [
            'id_solicitud' => $id_solicitud
        ]);

        $viajeros = $response['viajeros'];
        //throw new \Exception($viajeros);

        return $viajeros;
    }
}
