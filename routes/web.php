<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\Solicitudes\SolicitudesController;
use App\Http\Controllers\Solicitudes\ControladorViatico;
use App\Http\Controllers\Configuracion\EstadosController;
use App\Http\Controllers\Configuracion\TiposSolicitudesController;
use App\Http\Controllers\Configuracion\ZonasController;
use App\Http\Controllers\Configuracion\CapitulosController;
use App\Http\Controllers\Configuracion\CategoriasController;
use App\Http\Controllers\Tienda\ControladorTiendaUNAG;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\googleController;
use App\Http\Controllers\MallaValidacion\MallaValidacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

// Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
//     Route::get('login', 'loginView')->name('login.index');
//     Route::post('login', 'login')->name('login.check');
// });

Route::get('/auth/google', function () {
    return redirect(env('API_BASE_URL_ZETA').'/api/auth/google/redirect');
});

Route::get('/sesion/{email}/{token}/{name}', [googleController::class, 'handleGoogleCallback']);

Route::get('/login', [ApiAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    //Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [ApiAuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        // Route::get('mi-perfil-page', 'perfil');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic-page', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline-page', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon-page', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block-page', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document-page', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
    Route::get('mi-perfil', [PerfilController::class, 'perfil']);
    Route::post('mi-perfil-cambiar-clave', [PerfilController::class, 'cambiar_clave']);
    Route::get('solicitudes', [SolicitudesController::class, 'view_solicitudes'])->name('solicitudes');
    Route::get('solicitudes/data', [SolicitudesController::class, 'data_solicitudes']);
    Route::get('/solicitudes/{id_solicitud}/viaticos/imprimir', [SolicitudesController::class, 'imprimir_viaticos_view']);
    Route::get('/solicitudes/{id_solicitud}/viaticos/imprimir/viajeros', [SolicitudesController::class, 'imprimir_viaticos_view_viajeros']);
    Route::get('/viaticos/agregar', [ControladorViatico::class, 'agregar_viaticos']);
    Route::get('/viaticos/editar/{id_viatico}', [ControladorViatico::class, 'editar_viaticos']);
    Route::post('/viaticos/guardar', [ControladorViatico::class, 'guardar_viaticos']);
    Route::post('/viaticos/cargar/actividades_obras', [ControladorViatico::class, 'cargar_actividades_obras']);
    Route::post('/viaticos/guardar_monto', [ControladorViatico::class, 'guardar_viaticos_monto']);
    Route::post('/viaticos/anular_viaje', [ControladorViatico::class, 'anular_viaje']);
    Route::get('/solicitud_viaticos/{id_viatico}/ver_calculos/viajero/{numero_empleado}', [ControladorViatico::class, 'verCalculos']);
    Route::post('/solicitud_viaticos/guardar_calculos/viajero', [ControladorViatico::class, 'guardarCalculos']);
    Route::post('/cambiar_estados', [EstadosController::class, 'cambiar_estados']);
    Route::get('configuracion/estados', [EstadosController::class, 'view_estados'])->name('configuracion_estados');
    Route::get('configuracion/estados/data', [EstadosController::class, 'data_estados']);
    Route::post('configuracion/estados/guardar', [EstadosController::class, 'guardar_estados']);
    Route::get('configuracion/tipos_solicitudes', [TiposSolicitudesController::class, 'view_tipos_solicitudes'])->name('configuracion_tipos_solicitudes');
    Route::get('configuracion/tipos_solicitudes/data', [TiposSolicitudesController::class, 'data_tipos_solicitudes']);
    Route::post('configuracion/tipos_solicitudes/guardar', [TiposSolicitudesController::class, 'guardar_tipos_solicitudes']);
    Route::get('configuracion/tipos_solicitudes/{id_tipo_solicitud}/asignar_estados', [TiposSolicitudesController::class, 'view_tipos_solicitudes_asignar_estados']);
    Route::get('configuracion/tipos_solicitudes/{id_tipo_solicitud}/asignar_estados/data', [TiposSolicitudesController::class, 'data_tipos_solicitudes_asignar_estados']);
    Route::get('configuracion/zonas', [ZonasController::class, 'view_zonas'])->name('configuracion_zonas');
    Route::post('configuracion/zonas/guardar', [ZonasController::class, 'guardar_zonas']);
    Route::get('configuracion/capitulos', [CapitulosController::class, 'view_capitulos'])->name('configuracion_capitulos');
    Route::post('configuracion/capitulos/guardar', [CapitulosController::class, 'guardar_capitulos']);
    Route::get('configuracion/categorias', [CategoriasController::class, 'view_categorias'])->name('configuracion_categorias');
    Route::post('configuracion/categorias/guardar', [CategoriasController::class, 'guardar_categorias']);
    Route::get('/reportes', [ReporteController::class, 'imprimir_reporte']);
    Route::get('/setic/malla_validacion', [MallaValidacionController::class, 'malla_validaciones'])->name('malla_validacion');
    Route::post("setic/malla_validacion/tareas_pendientes_personas", [MallaValidacionController::class, 'malla_validaciones_tareas_pendientes_personas']); 

    //Inicia Tienda UNAG
    Route::get('punto-venta/facturar', [ControladorTiendaUNAG::class, 'view_facturar'])->name('facturar');
    Route::get('punto-venta/facturar/data/clientes', [ControladorTiendaUNAG::class, 'view_facturar_data_clientes']);
    Route::post('punto-venta/facturar/data/productos', [ControladorTiendaUNAG::class, 'view_facturar_data_productos']);
    Route::post('punto-venta/facturar/reservar/productos', [ControladorTiendaUNAG::class, 'tnd_facturas_productos_reservar']);
    Route::get('punto-venta/facturar/pendientes/factura-modificar/{id_factura}', [ControladorTiendaUNAG::class, 'modificar_tnd_facturas_pendientes']);
    //Finaliza Tienda UNAG
});

Route::get('/auth/redirect/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/callback/google', [AuthController::class, 'handleGoogleCallback']);
Route::get('solicitudes/{id_solicitud}/empleado/{id_empleado}/imprimir', [SolicitudesController::class, 'imprimir_solicitudes']);
