@extends('../layouts/' . $layout)

@section('subhead')
    <title>Facturar</title>
@endsection

@section('subcontent')

        <!-- BEGIN: Profile Info -->
        <!-- <div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                   
                   
                            <x-base.lucide
                                class="h-40 w-40"
                                icon="credit-card"
                            />
                        
                
                    <div class="ml-5">
                        <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                            
                            <h1 class="text-5xl font-medium leading-none">FACTURAR</h1>
                        </div>
                        <div class="text-slate-500">Módulo de registro de facturas (Punto de Venta).</div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- END: Profile Info -->
        
        <div class="flex justify-center">
            <div class="mt-5 grid grid-cols-12 gap-5 w-full max-w-screen-lg">
                <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                </div>
                <div class="box zoom-in col-span-12 cursor-pointer p-5 sm:col-span-6 lg:col-span-3 bg-primary text-center text-white" id="btn_agregar_cliente">
                    <div class="flex justify-center items-center text-base font-medium">
                        <x-base.lucide class="h-5 w-5 mr-2" icon="UserPlus" />
                        Agregar Cliente
                    </div>
                    <!-- <div class="text-slate-500 text-white">5 Items</div> -->
                </div>
                <div class="box zoom-in col-span-12 cursor-pointer p-5 sm:col-span-6 lg:col-span-3 bg-primary text-center text-white" id="btn_agregar_producto">
                    <div class="flex justify-center items-center text-base font-medium">
                        <x-base.lucide class="h-5 w-5 mr-2" icon="Package" />
                        Agregar Producto
                    </div>
                    <!-- <div class="text-slate-500 text-white"> Artículos en existencia</div> -->
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                </div>
            </div>
        </div>

        <div class="intro-y box mt-5 px-5 pt-5">
            <div class="flex justify-center text-center">
                <div class="mt-5 grid grid-cols-12 gap-5 w-full max-w-screen-lg items-center">
                    <div class="col-span-12 sm:col-span-12 lg:col-span-3 flex justify-center">
                        <img src="{{ Vite::asset('resources/images/unag_oficial_color.png') }}" width="160px"/>
                    </div>
                    <div class="col-span-12 sm:col-span-12 lg:col-span-6 flex justify-center">
                        <h2 class="text-4xl font-medium leading-none text-center"><strong> UNIVERSIDAD NACIONAL DE AGRICULTURA </strong> </h2>
                    </div>
                    <div class="col-span-12 sm:col-span-12 lg:col-span-3 flex justify-center">
                        <img src="{{ Vite::asset('resources/images/logoTiendaUniversitaria.png') }}" width="100px"/>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-3 lg:text-left">
                        
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                        <div class="flex items-center truncate sm:whitespace-normal">
                            <strong> RTN: </strong> &nbsp;
                            12341234123456
                        </div>
                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                             <strong> Centro de Venta: </strong> &nbsp;
                            Tienda Universitaria
                        </div>
                    </div>
                </div>
                <div
                    class="mt-6 flex-1 border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-5 lg:text-left">
                        
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                        <div class="flex items-center truncate sm:whitespace-normal">
                            <strong> Fecha Recepción: </strong> &nbsp;
                            {{$hora_fecha_actual['fecha']}}
                        </div>
                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                             <strong> Fecha Límite de Emisión: </strong> &nbsp;
                            {{$configuracion_factura['fecha']}}
                        </div>
                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                            <strong> CAI: </strong> &nbsp;
                            {{$configuracion_factura['cai']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-3 lg:text-left">
                        
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                        <div class="flex items-center truncate sm:whitespace-normal">
                            <strong> Cliente: </strong> &nbsp;
                        </div>
                        <div class="mt-3 flex flex-wrap sm:flex-nowrap items-center">
                            <div class="flex items-center sm:mr-5 mb-2 sm:mb-0">
                                <strong>Código:</strong> &nbsp; <p id="p_codigo">{{$configuracion_factura['num_empleado']}}</p>
                            </div>
                            <div class="flex items-center sm:mr-5 mb-2 sm:mb-0">
                                <strong>Nombre Completo:</strong> &nbsp; <p id="p_nombre_completo">{{$configuracion_factura['nombre_completo']}}</p>
                            </div>
                            <div class="flex items-center">
                                <strong>Dirección:</strong> &nbsp; <p id="p_direccion">{{$configuracion_factura['dependecnia']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-3 lg:text-left"> </div>
                    <div class="col-span-12 overflow-x-auto">
                        <table id="sdatatableFactura" class="display datatable w-full">
                            <thead data-tw-merge class="bg-dark text-white dark:bg-black/30">
                                <tr>
                                    <th><x-base.lucide class="h-4 w-4 mr-2" icon="ChevronsDown" /></th>
                                    <th style="width:6px">Código</th>
                                    <th style="width:750px">Descripción</th>
                                    <th>Empaque</th>
                                    <th>ISV</th>
                                    <th>Cantidad</th>
                                    <th class="text-right">P. Unitario</th>
                                    <th class="text-right">Importe Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($factura_products_list as $row)
                                <tr>
                                    <th>
                                        <x-base.lucide 
                                            class="h-4 w-4 mr-2 cursor-pointer btn_eliminar_producto_factura" 
                                            icon="XCircle"
                                            data-id="{{$row['id']}}"
                                            data-id-producto="{{$row['id_producto']}}"
                                            data-descripcion="{{$row['descripcion']}}"/>
                                    </th>
                                    <th style="text-align: left;">{{$row['codigo']}}</th>
                                    <th style="text-align: left;">{{$row['descripcion']}}</th>
                                    <th style="text-align: left;">{{$row['empaque']}}</th>
                                    <th style="text-align: right;">{{$row['impuesto']}}%</th>
                                    <th style="text-align: right;" class="flex">
                                        {{$row['cantidad']}} &nbsp; 
                                        <x-base.lucide class="h-4 w-4 mr-2 cursor-pointer btn_editar_cantidad_producto_factura" 
                                        icon="Edit"
                                        data-id="{{$row['id']}}"
                                        data-id-producto="{{$row['id_producto']}}"
                                        data-descripcion="{{$row['descripcion']}}"/>
                                    </th>
                                    <th style="text-align: right;">{{$row['precio_venta']}}</th>
                                    <th style="text-align: right;">{{$row['valor']}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 grid grid-cols-12 w-full max-w-screen-lg">
                        <div class="col-span-12 sm:col-span-12 lg:col-span-8">
                        </div>
                        <div class="col-span-12 sm:col-span-12 lg:col-span-4">
                            <div class="flex justify-end">
                                <div class="mr-auto">Total Artículos:</div>
                                <div class="font-medium">{{$total_articulos['total_articulos']}} {{$total_articulos['descripcion_unidad']}}</div>
                            </div>
                            <hr>
                            <div class="mt-2 flex justify-end">
                                <div class="mr-auto">Descuentos y Rebajas Otorgados:</div>
                                <div class="font-medium">L 0.00</div>
                            </div>
                            <div class="mt-2 flex justify-end">
                                <div class="mr-auto">Subtotal:</div>
                                <div class="font-medium" id="td_subtotal">{{$totales['sub_total']}}</div>
                            </div>
                            <div class="mt-2 flex justify-end">
                                <div class="mr-auto">Importe Exonerado:</div>
                                <div class="font-medium">L 0.00</div>
                            </div>
                            @foreach($tnd_impuestos_list as $row_impuesto)
                                <div class="mt-2 flex justify-end">
                                    <div class="mr-auto">Importe  @if($row_impuesto['impuesto'] == 0) Exento: @else Gravado {{$row_impuesto['impuesto']}}%: @endif</div>
                                    <div class="font-medium" id="td_gravado_{{$row_impuesto['impuesto']}}">L 0.00</div>
                                </div>
                            @endforeach
                            @foreach($tnd_impuestos_list as $row_impuesto)
                                @if($row_impuesto['impuesto'] != 0)
                                    <div class="mt-2 flex justify-end">
                                        <div class="mr-auto">I.S.V. {{$row_impuesto['impuesto']}}%:</div>
                                        <div class="font-medium" id="td_{{$row_impuesto['impuesto']}}">L 0.00</div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="mt-2 flex justify-end border-t border-slate-200/60 pt-2 dark:border-darkmode-400">
                                <div class="mr-auto text-base font-medium">
                                Total a Pagar:
                                </div>
                                <div class="text-base font-medium" id="td_total_pagar">{{$totales['total_pagar']}}</div>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="flex justify-end flex-wrap">
                        <x-base.button
                            class="mb-2 mr-2 w-42"
                            variant="pending"
                            size="lg"
                            id="btn_enviar_caja"
                        >
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="Inbox"
                            />
                            Enviar a Caja
                        </x-base.button>
                        <x-base.button
                            class="mb-2 mr-2 w-42"
                            variant="primary"
                            size="lg"
                            id="btn_guardar_venta"
                        >
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="Save"
                            />
                            Guardar Venta
                        </x-base.button>
                    </div>
                </div>
            </div>


        <x-base.dialog id="modal_clientes" size="xl">
            <x-base.dialog.panel>
                <x-base.dialog.title class="bg-primary">
                    <h2 class="mr-auto text-white font-medium">
                        <div class="flex items-center">
                        <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                            <span class="text-white-700"> Agregar Cliente</span>
                        </div>
                    </h2>
                </x-base.dialog.title>
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 overflow-x-auto">
                        <table id="sdatatable" class="display datatable w-full">
                            <thead>
                                <tr>
                                    <th>Identidad</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer class="bg-dark">
                    <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                </x-base.dialog.footer>
            </x-base.dialog.panel>
        </x-base.dialog>

        <x-base.dialog id="modal_productos" size="xl">
            <x-base.dialog.panel>
                <x-base.dialog.title class="bg-primary">
                    <h2 class="mr-auto text-white font-medium">
                        <div class="flex items-center">
                        <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                            <span class="text-white-700"> Agregar Productos</span>
                        </div>
                    </h2>
                </x-base.dialog.title>
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 overflow-x-auto">
                        <table id="sdatatableProductos" class="display datatable w-full">
                            <thead>
                                <tr>
                                    <th>Cantidad Disponible</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Impuesto</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer class="bg-dark">
                    <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                </x-base.dialog.footer>
            </x-base.dialog.panel>
        </x-base.dialog>

        <x-base.dialog id="modal_editar_cantidad_producto" size="xl">
            <x-base.dialog.panel>
                <x-base.dialog.title class="bg-primary">
                    <h2 class="mr-auto text-white font-medium">
                        <div class="flex items-center">
                        <i data-lucide="Edit" class="w-4 h-4 mr-1"></i>
                            <span class="text-white-700"> Editar Cantidad</span>
                        </div>
                    </h2>
                </x-base.dialog.title>
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12 lg:col-span-8">
                        <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                            <x-base.form-label class="font-extrabold" for="modal_input_nombre_zona">
                                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                                    <x-base.lucide class="h-20 w-20" icon="Box" />
                                    <div class="ml-5">
                                        <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                                            <h2 class="text-5xl font-medium leading-none" id="h2_nombre_producto"></h2>
                                        </div>
                                    </div>
                                </div>
                            </x-base.form-label>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-12 lg:col-span-4">
                        <x-base.form-label class="font-extrabold" for="modal_input_nombre_zona">
                            <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                                <div class="ml-5">
                                    <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                                        <h4 class="mt-3 text-xl font-medium leading-none text-primary" id="h4_disponible_producto"></h4>
                                    </div>
                                </div>
                            </div>
                        </x-base.form-label>
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <!-- <hr> 
                        <br>-->
                        <x-base.form-label class="font-extrabold" for="modal_input_editar_cantidad">
                            Cantidad
                        </x-base.form-label>
                        <x-base.form-input id="modal_input_editar_cantidad" type="number" placeholder="Escriba la cantidad" />
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer class="bg-dark">
                    <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                    <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_nueva_cantidad">
                        Guardar
                    </x-base.button>
                </x-base.dialog.footer>
            </x-base.dialog.panel>
        </x-base.dialog>

        <x-base.dialog id="modal_eliminar_prodcuto">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
                    <div class="mt-5 text-3xl">¡Advertencia!</div>
                    <div class="mt-2 text-slate-500">
                        ¿Realmente desea eliminar este Producto?<br />
                        <div>
                            <h3 id="h3_nombre_producto" class="mt-3 text-2xl font-medium leading-none">
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancelar
                    </x-base.button>
                    <x-base.button class="w-24" type="button" variant="danger" id="btn_eliminar_producto">
                        Eliminar
                    </x-base.button>
                </div>
            </x-base.dialog.panel>
        </x-base.dialog>
    
        <!-- END: HTML Table Data -->
        <div class="text-center">
            <!-- BEGIN: Notification Content -->
            <div id="success-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex flex flex">
                <i data-lucide="check-circle" width="24" height="24" class="stroke-1.5 text-success text-success"></i>
                <div id="success-notification" class="ml-4 mr-4">
                    
                </div>
            </div>

            <div id="danger-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex flex flex">
                <i data-lucide="x-circle" width="24" height="24" class="stroke-1.5 text-danger text-danger"></i>
                <div id="danger-notification" class="ml-4 mr-4">
                    
                </div>
            </div>
            <!-- END: Notification Content -->
        </div>

    
@endsection
@once
    @push('vendors')
        @vite('resources/js/vendor/tabulator/index.js')
        @vite('resources/js/vendor/lucide/index.js')
        @vite('resources/js/vendor/xlsx/index.js')
    @endpush
@endonce
@once
    @push('scripts')
        @vite('resources/js/pages/slideover/index.js')
        @vite('resources/js/pages/modal/index.js')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/js/pages/modal/index.js')
        @vite('resources/js/vendor/toastify/index.js')
        @vite('resources/js/pages/notification/index.js')
        <script type="module">
            var accion_guardar = false;
            var accion = null;
            var id_cai = "{{$configuracion_factura['id']}}";
            var id_factura = null;
            var id_factura_filas = null;
            var descripcion_producto = null;
            var total_pagar = null;
            var numero_empleado = null;
            var identidad = null;
            var nombre_completo = null;
            var direccion = null;
            var rowNumberFactura = null;
            var enviar_correo = null;
            var id_producto = null;
            var lista_productos = "{{$total_articulos['total_articulos']}}";
            var tabla_productos = null;
            var tabla_factura = null;
            var url_facturar_data_clientes = "{{url('punto-venta/facturar/data/clientes')}}";
            var url_facturar_data_productos = "{{url('punto-venta/facturar/data/productos')}}";
            var url_tnd_facturas_productos_reservar = "{{url('punto-venta/facturar/reservar/productos')}}";
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;
            var numerofila = null;
            var nuevafila = null;
            var nuevaFilaDTProductos = null;
            var metodo_pago = null;
            var guardar_factura = null;
            var estado_factura = null;
            @foreach($tnd_impuestos_list as $row_impuesto)
                var impuesto_de_{{$row_impuesto['impuesto']}} = null;                           
            @endforeach   
            var id_seleccionar_productos = localStorage.getItem("pre_productos_id_seleccionar");
            var id_seleccionar_factura = localStorage.getItem("pre_factura_id_seleccionar");
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	 
                    // Verifica si ya existe una instancia de DataTable y la destruye si es así
                    // $.fn.dataTable.isDataTable('#sdatatable')
                    // if ($.fn.dataTable.isDataTable('#sdatatable')) {
                    //     $('#sdatatable').DataTable().clear().destroy();
                    // }

                    // Inicializa el DataTable
                    $('#sdatatable').DataTable({
                        language: { 
                            "decimal": ",", 
                            "thousands": ".", 
                            "lengthMenu": "Mostrar _MENU_ registros", 
                            "zeroRecords": "No se encontraron resultados", 
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", 
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)", 
                            "sSearch": "Buscar:", 
                            "oPaginate": { 
                                "sFirst": "Primero", 
                                "sLast":"Último", 
                                "sNext":"Siguiente", 
                                "sPrevious": "Anterior" 
                            }, 
            
                            "oAria": { 
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente", 
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
                            }, 
            
                            "sProcessing":"Cargando..." 
                        },
                        "processing": true,
                        "serverSide": false,
                        "ajax": {
                            "url": url_facturar_data_clientes,
                            "type": "GET"
                        },
                        "columns": [
                            { "data": "identidad" },
                            { "data": "nombre_completo" },
                            { "data": "dependencia"},
                            {
                                "data": null,
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "render": function(data, type, row) {
                                    identidad = data.identidad;
                                    nombre_completo = data.nombre_completo;
                                    direccion = data.dependencia;
                                    numero_empleado = data.numero_empleado;
                                    return `<button data-numero_empleado="${numero_empleado}" data-identidad="${identidad}" data-nombre_completo="${nombre_completo}" data-direccion="${direccion}" class="transition agregar_caliente duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary shadow-md mb-2 mr-1 w-24">Agregar</button>`;
                                }
                            }
                        ]
                    });


                    tabla_factura = $('#sdatatableFactura').DataTable({
                        language: { 
                            "decimal": ",", 
                            "thousands": ".", 
                            "lengthMenu": "Mostrar _MENU_ registros", 
                            "zeroRecords": "No se encontraron resultados", 
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", 
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)", 
                            "sSearch": "Buscar:", 
                            "oPaginate": { 
                                "sFirst": "Primero", 
                                "sLast":"Último", 
                                "sNext":"Siguiente", 
                                "sPrevious": "Anterior" 
                            }, 
            
                            "oAria": { 
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente", 
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
                            }, 
            
                            "sProcessing":"Cargando..." 
                        },
                        "processing": false,
                        "serverSide": false,
                        bInfo: false,
                        searching: false,
                        bPaginate: false
                    });

                    $("#sdatatableFactura tbody").on( "click", "tr", function () { 
                        rowNumberFactura=parseInt(tabla_factura.row( this ).index()); 
                        tabla_factura.$('tr.selected').removeClass('selected'); 
                                     $(this).addClass('selected'); 
                                     localStorage.setItem("pre_factura_id_seleccionar",tabla_factura.row( this ).data()[0]); 
                                     });

                    @if($configuracion_factura['factura_activa'] == true)
                        $('#btn_activar_factura').hide();
                        $('#btn_agregar_productos').show();
                        $('#div_ver_factura').show();
                        id_factura = "{{$configuracion_factura['id_factura']}}";
                        numero_empleado = "{{$configuracion_factura['num_empleado']}}";
                        @foreach($impuestos as $row)
                            $("#td_"+{{$row['impuesto']}}).html("{{$row['total_impuesto_producto']}}");
                            $("#td_gravado_"+{{$row['impuesto']}}).html("{{$row['total_producto_importe']}}");
                        @endforeach
                        total_pagar = {{$totales['total_pagar_sin_formato']}};
                        $("#td_subtotal").html("{{$totales['sub_total']}}");
                        $("#td_total_pagar").html('<h2><strong>'+"{{$totales['total_pagar']}}"+'</h2></strong>');
                        $("#h1_cobrar_total_pagar").html("{{$totales['total_pagar']}}");
                    @endif
                });


                $('#sdatatable tbody').on('click', '.agregar_caliente', function() {
                    numero_empleado = $(this).data('numero_empleado');
                    identidad = $(this).data('identidad');
                    nombre_completo = $(this).data('nombre_completo');
                    direccion = $(this).data('direccion');
                    $("#p_codigo").html(numero_empleado);
                    $("#p_nombre_completo").html(nombre_completo);
                    $("#p_direccion").html(direccion);
                    const el = document.querySelector("#modal_clientes");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.hide(); 
                    //alert(direccion);
                });


                $('#sdatatable tbody').on('click', '.eliminar', function() {
                    var fila = $('#sdatatable').DataTable().row($(this).parents('tr'));
                    var data = fila.data();
                    accion = 3;
                    numerofila = fila.index();
                    id = data[0];
                    const el = document.querySelector("#modal_eliminar");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
                });

                $('#sdatatableFactura tbody').on('click', '.btn_eliminar_producto_factura', function() {
                    accion = 3;
                    id_factura_filas = $(this).data('id');
                    id_producto = $(this).data('id-producto');
                    descripcion_producto = $(this).data('descripcion');
                    $("#h3_nombre_producto").html('<strong>'+descripcion_producto+'</strong>');
                    const el = document.querySelector("#modal_eliminar_prodcuto");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
                });

                $('#sdatatableFactura tbody').on('click', '.btn_editar_cantidad_producto_factura', function() {
                    //accion = 3;
                    id_factura_filas = $(this).data('id');
                    id_producto = $(this).data('id-producto');
                    console.log(id_producto)
                    cargar_productos();
                    // descripcion_producto = $(this).data('descripcion');
                    // $("#h3_nombre_producto").html('<strong>'+descripcion_producto+'</strong>');
                    // const el = document.querySelector("#modal_eliminar_prodcuto");
                    // const modal = tailwind.Modal.getOrCreateInstance(el);
                    // modal.show(); 
                });

            $("#btn_agregar_cliente").on("click", function (event) {
                const el = document.querySelector("#modal_clientes");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

            });

            $("#btn_eliminar_producto").on("click", function () {
                reservar_productos(id_producto, 0);
            });

            tabla_productos = $("#sdatatableProductos").DataTable({
                language: { 
                            "decimal": ",", 
                            "thousands": ".", 
                            "lengthMenu": "Mostrar _MENU_ registros", 
                            "zeroRecords": "No se encontraron resultados", 
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", 
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)", 
                            "sSearch": "Buscar:", 
                            "oPaginate": { 
                                "sFirst": "Primero", 
                                "sLast":"Último", 
                                "sNext":"Siguiente", 
                                "sPrevious": "Anterior" 
                            }, 
            
                            "oAria": { 
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente", 
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
                            }, 
            
                            "sProcessing":"Cargando..." 
                        },
                        "processing": true,
                        "serverSide": false,
                        stateSave: true,

            });

            tabla_productos.rows().every(function (rowIdx, tableLoop, rowLoop) {
                if (this.data()[0] == id_seleccionar_productos) {
                    $(this.node()).addClass("selected");
                }
            });

            $("#btn_enviar_caja").on("click", function () {
                if (lista_productos == null || lista_productos == "" || lista_productos <= 0) {
                        titleMsg = 'Valor Requerido'
                        textMsg = 'Debe agregar productos a la factura';
                        typeMsg = 'error';
                        notificacion()
                        return false;
                }


                if (confirm('¿Desea enviar la factura a Caja?')){ 
                    guardar_factura = 1;
                    estado_factura = 2;
                    metodo_pago = $("input[type=radio][name=metodo_pago]:checked").map(function() {
                        return this.value;
                    }).get().splice(0);

                    //preguardar_tnd_factura();
                } else {

                };   
                
            });


            $("#btn_agregar_producto").on("click", function (event) {
                id_producto = null;
                cargar_productos();
            });

            $('#sdatatableProductos tbody').on('click', '.btn_agregar_producto_reservar', function() {
                var id = $(this).data('id');
                reservar_productos(id, 1)
            });

            $("#modal_btn_guardar_nueva_cantidad").on("click", function () {
                var nueva_cantidad = $("#modal_input_editar_cantidad").val();
                accion = 2;
                reservar_productos(id_producto, nueva_cantidad);
            });

            $("#btn_eliminar").on("click", function () {
                guardar_zonas();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();
            });

            function cargar_productos() {
                $.ajax({
                    type: "post",
                    url: url_facturar_data_productos,
                    data: {
                        'id_producto': id_producto,
                    },
                    success: function (data) {
                        if (data.msgError != null) {
                            titleMsg = "Error al Cargar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                        } else {
                            titleMsg = "Productos";
                            textMsg = data.msgSuccess;
                            typeMsg = "success";
                            if(id_producto == null || id_producto == ''){
                                tabla_productos.clear().draw();
                                lista_productos = data.tnd_productos_list.length;
                                for(var i = 0; i < lista_productos; i++) {
                                    var row = data.tnd_productos_list[i];
                                        nuevaFilaDTProductos = [
                                            '<p id="p_cantidad_disponible_'+row.id+'">'+row.cant_disponible+'</p>', row.producto, row.precio_venta_formato, row.impuesto == 0 ? 'Exento' : row.impuesto+'%',
                                            `<button id="btn_reservar_producto_${row.id}"
                                                data-id="${row.id}" 
                                                class="btn_agregar_producto_reservar ${row.boton} transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary shadow-md mb-2 mr-1 w-24">
                                                Agregar
                                            </button>`
                                        ];
                                    tabla_productos.row.add(nuevaFilaDTProductos).draw();
                                }
                                notificacion(); 
                                const el = document.querySelector("#modal_productos");
                                const modal = tailwind.Modal.getOrCreateInstance(el);
                                modal.show();
                            }else{
                                //$("#editar_cantidad").val(1);
                                $("#h2_nombre_producto").html(data.tnd_productos_list.producto)
                                $("#h4_disponible_producto").html("<strong>Cantidad disponible: "+data.tnd_productos_list.cant_disponible+"</strong>")
                                const el = document.querySelector("#modal_editar_cantidad_producto");
                                const modal = tailwind.Modal.getOrCreateInstance(el);
                                modal.show();
                            }
                            
                        }
                    },
                });
            }

            function reservar_productos(id_producto_cantidad, cantidad) {
                $("#btn_reservar_producto_"+id_producto_cantidad).prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: url_tnd_facturas_productos_reservar,
                    data: {
                        'id_producto_cantidad': id_producto_cantidad,
                        'id_factura': id_factura,
                        'id_factura_filas': id_factura_filas,
                        'cantidad': cantidad,
                        'accion': accion
                    },
                    success: function (data) {
                        if (data.msgError != null) {
                            titleMsg = "Error al Cargar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                            notificacion();
                        } else {
                            $("#btn_reservar_producto_"+id_producto_cantidad).prop("disabled", false);
                            if(data.accion == null || data.accion == 2){
                                var fila_producto = data.productos_list;
                                console.log(data.productos_list);
                                var nuevaFilaProdcutoDT = [
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x-circle" data-lucide="x-circle" data-id="'+fila_producto.id+'" data-id-producto="'+fila_producto.id_producto+'" data-descripcion="'+fila_producto.descripcion+'" class="lucide lucide-x-circle stroke-1.5 h-4 w-4 mr-2 cursor-pointer btn_eliminar_producto_factura"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>',
                                fila_producto.codigo, fila_producto.descripcion, fila_producto.empaque,
                                '<p class="text-right">'+fila_producto.impuesto+'%</p>', '<div class="flex items-center">'+fila_producto.cantidad+'&nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" data-id="'+fila_producto.id+'" data-id-producto="'+fila_producto.id_producto+'" data-descripcion="'+fila_producto.descripcion+'" class="lucide lucide-edit stroke-1.5 h-4 w-4 mr-2 cursor-pointer btn_editar_cantidad_producto_factura"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></div>', 
                                '<p class="text-right">'+fila_producto.precio_venta+'</p>',
                                '<p class="text-right">'+fila_producto.valor+'</p>'
                                ];
                                
                                if(data.accion == null){
                                    $("#p_cantidad_disponible_"+data.id_producto_cantidad).html(data.nueva_cantidad);
                                    tabla_factura.row.add(nuevaFilaProdcutoDT).draw();
                                }else if(data.$accion = 2){
                                    tabla_factura.row(rowNumberFactura).data(nuevaFilaProdcutoDT);
                                    const el = document.querySelector("#modal_editar_cantidad_producto");
                                    const modal = tailwind.Modal.getOrCreateInstance(el);
                                    modal.hide(); 
                                    $("#modal_input_editar_cantidad").val('');
                                }
                            }else if(data.accion == 3){
                                tabla_factura.row(rowNumberFactura).remove().draw();
                                const el = document.querySelector("#modal_eliminar_prodcuto");
                                const modal = tailwind.Modal.getOrCreateInstance(el);
                                modal.hide(); 
                            }

                            for(var i = 0; i < data.impuestos.length; i++){
                                var row = data.impuestos[i];
                                //console.log(row.total_impuesto_producto)
                                $("#td_"+row.impuesto).html(row.total_impuesto_producto);
                                $("#td_gravado_"+row.impuesto).html(row.total_producto_importe);   
                            }

                            var totales = data.totales;
                            total_pagar = totales.total_pagar_sin_formato;
                            $("#td_subtotal").html(totales.sub_total);
                            $("#td_total_pagar").html('<h2><strong>'+totales.total_pagar+'</h2></strong>');
                            $("#h1_cobrar_total_pagar").html(totales.total_pagar);
                            accion = null;
                        }
                    },
                });
            }


            function notificacion() {
                var type = null;

                if (typeMsg == "success") {
                    type = "#success-notification-content";
                }
                if (typeMsg == "error") {
                    typeMsg = "danger";
                    type = "#danger-notification-content";
                }
                
                $("#"+typeMsg+"-notification").html('<div class="font-medium">' + titleMsg + "</div>" + '<div class="mt-1 text-slate-500">' + textMsg + "</div>");

                Toastify({
                    node: $(type).clone().removeClass("hidden")[0],
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                }).showToast();
            }


        </script>
    @endpush
@endonce