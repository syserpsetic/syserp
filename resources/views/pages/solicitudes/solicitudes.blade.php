@extends('../layouts/' . $layout)

@section('subhead')
    <title>Solicitudes</title>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Info -->
<div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                   
                   
                        <lord-icon
                            src="https://cdn.lordicon.com/yqiuuheo.json"
                            trigger="in"
                            delay="1000"
                            state="in-reveal"
                            style="width:180px;height:180px">
                        </lord-icon>
                        
                
                    <div class="ml-5">
                        <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                            
                            <h1 class="text-5xl font-medium leading-none">SOLICITUDES</h1>
                        </div>
                        <div class="text-slate-500">Pantalla de administración de solicitudes.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Info -->

    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box mt-5 p-5">
    <div class="grid grid-cols-12 gap-6">
            <div class="intro-y col-span-6 lg:col-span-6">
                <div class="p-5">
                    <h3 class="text-2xl font-medium leading-none"><div class="flex items-center">
                        <i data-lucide="List" class="w-6 h-6 mr-1"></i>
                            <span class="text-white-700"> Lista de Solicitudes</span>
                        </div></h3>
                </div>
            </div>
            <div class="intro-y col-span-6 lg:col-span-6 text-right">
                <div class="p-5">

                            <x-base.menu class="ml-auto sm:ml-0">
                                <x-base.menu.button
                                    class="mr-2 shadow-md"
                                    as="x-base.button"
                                    variant="primary"
                                ><x-base.lucide
                                            class="h-4 w-4"
                                            icon="FilePlus"
                                        />&nbsp; Registrar Nueva Solicitud
                                    
                                </x-base.menu.button>
                                <x-base.menu.items class="w-60">
                                    <x-base.menu.item
                                            id="btn_registrar"
                                            href="{{url('/viaticos/agregar')}}">
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="Truck"
                                        /> Nueva Orden de Viaje
                                    </x-base.menu.item>
                                    <!-- <x-base.menu.item>
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="Plus"
                                        /> Nueva Licitación
                                    </x-base.menu.item> -->
                                </x-base.menu.items>
                            </x-base.menu>
                     
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form
                class="sm:mr-auto xl:flex"
                id="tabulator-html-filter-form"
            >
                <!-- <div class="items-center sm:mr-4 sm:flex">
                    <label class="mr-2 w-12 flex-none xl:w-auto xl:flex-initial">
                        Field
                    </label>
                    <x-base.form-select
                        class="mt-2 w-full sm:mt-0 sm:w-auto 2xl:w-full"
                        id="tabulator-html-filter-field"
                    >
                        <option value="id">id</option>
                        <option value="viajeros">Viajeros</option>
                        <option value="remaining_stock">Remaining Stock</option>
                    </x-base.form-select>
                </div>
                <div class="mt-2 items-center sm:mr-4 sm:flex xl:mt-0">
                    <label class="mr-2 w-12 flex-none xl:w-auto xl:flex-initial">
                        Type
                    </label>
                    <x-base.form-select
                        class="mt-2 w-full sm:mt-0 sm:w-auto"
                        id="tabulator-html-filter-type"
                    >
                        <option value="like">like</option>
                        <option value="=">=</option>
                        <option value="<">&lt;</option>
                        <option value="<=">&lt;=</option>
                        <option value=">">&gt;</option>
                        <option value=">=">&gt;=</option>
                        <option value="!=">!=</option>
                    </x-base.form-select>
                </div>
                <div class="mt-2 items-center sm:mr-4 sm:flex xl:mt-0">
                    <label class="mr-2 w-12 flex-none xl:w-auto xl:flex-initial">
                        Value
                    </label>
                    <x-base.form-input
                        class="mt-2 sm:mt-0 sm:w-40 2xl:w-full"
                        id="tabulator-html-filter-value"
                        type="text"
                        placeholder="Search..."
                    />
                </div>
                <div class="mt-2 xl:mt-0">
                    <x-base.button
                        class="w-full sm:w-16"
                        id="tabulator-html-filter-go"
                        type="button"
                        variant="primary"
                    >
                        Go
                    </x-base.button>
                    <x-base.button
                        class="mt-2 w-full sm:mt-0 sm:ml-1 sm:w-16"
                        id="tabulator-html-filter-reset"
                        type="button"
                        variant="secondary"
                    >
                        Reset
                    </x-base.button>
                </div> -->
            </form> 
            <!-- <div class="mt-5 flex sm:mt-0">
                <x-base.button
                    class="mr-2 w-1/2 sm:w-auto"
                    id="tabulator-print"
                    variant="outline-secondary"
                >
                    <x-base.lucide
                        class="mr-2 h-4 w-4"
                        icon="Printer"
                    /> Print
                </x-base.button>
                <x-base.menu class="w-1/2 sm:w-auto">
                    <x-base.menu.button
                        class="w-full sm:w-auto"
                        as="x-base.button"
                        variant="outline-secondary"
                    >
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="FileText"
                        /> Export
                        <x-base.lucide
                            class="ml-auto h-4 w-4 sm:ml-2"
                            icon="ChevronDown"
                        />
                    </x-base.menu.button>
                    <x-base.menu.items class="w-40">
                        <x-base.menu.item id="tabulator-export-csv">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="FileText"
                            /> Export CSV
                        </x-base.menu.item>
                        <x-base.menu.item id="tabulator-export-json">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="FileText"
                            /> Export
                            JSON
                        </x-base.menu.item>
                        <x-base.menu.item id="tabulator-export-xlsx">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="FileText"
                            /> Export
                            XLSX
                        </x-base.menu.item>
                        <x-base.menu.item id="tabulator-export-html">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="FileText"
                            /> Export
                            HTML
                        </x-base.menu.item>
                    </x-base.menu.items>
                </x-base.menu>
            </div> -->
        </div>
        <div class="scrollbar-hidden overflow-x-auto">
            <!-- <div
                class="mt-5"
                id="tabulator"
            ></div> -->
            <table id="sdatatable" class="display datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Solicitud</th>
                        <th>Usuario Registró</th>
                        <th>Etapa</th>
                        <th>Fecha Registró</th>
                        <th>Viajeros</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td>{{$row['solicitud']}}</td>
                        <td>{{$row['username']}}</td>
                        <td><div class="text-xs text-slate-500 whitespace-nowrap"><span class="mr-1 rounded-full bg-primary px-1 text-xs text-white">{{$row['etapa']}}</span></div></td>
                        <td>{{$row['fechas_registro']}}</td>
                        <td>{{$row['viajeros']}}</td>
                        <td>
                            <x-base.button
                                class="mb-2 mr-1 opciones"
                                variant="primary"
                                size="sm"
                                data-id="{{$row['id']}}"
                            >
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="Settings"
                                />
                            </x-base.button>
                        
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- BEGIN: Modal Content -->
        <x-base.dialog id="modal_eliminar">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
                    <div class="mt-5 text-3xl">¡Advertencia!</div>
                    <div class="mt-2 text-slate-500">
                        ¿Realmente desea eliminar este registro?<br />
                        <div id="id_registro"></div>
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancelar
                    </x-base.button>
                    <x-base.button class="w-24" type="button" variant="danger" id="btn_eliminar">
                        Eliminar
                    </x-base.button>
                </div>
            </x-base.dialog.panel>
        </x-base.dialog>
        <!-- END: Modal Content -->
     
                   
        <x-base.dialog id="modal_opciones">
            <x-base.dialog.panel>
                <x-base.dialog.title class="bg-primary">
                    <h2 class="mr-auto text-white font-medium">
                        <div class="flex items-center">
                            <i data-lucide="Settings" class="w-4 h-4 mr-1"></i>
                            <span class="text-white-700"> Opciones</span>
                        </div>
                    </h2>
                </x-base.dialog.title>
                <x-base.tab.list class="flex-col justify-center sm:flex-row p-10 text-center" variant="boxed-tabs">
                    <x-base.tab id="btn_id_solicitud" :fullWidth="false">
                        <x-base.tab.button class="mb-2 w-full cursor-pointer px-0 py-2 text-center text-primary sm:mx-2 sm:mb-0 sm:w-20">
                            <x-base.lucide class="mx-auto mb-2 block h-6 w-6" icon="Users" />
                            <strong>Viajeros</strong>
                        </x-base.tab.button>
                    </x-base.tab>
                    <x-base.tab :fullWidth="false">
                        <x-base.tab.button id="btn_editar"  href="" class="mb-2 w-full cursor-pointer px-0 py-2 text-center text-warning sm:mx-2 sm:mb-0 sm:w-20">
                            <x-base.lucide class="mx-auto mb-2 block h-6 w-6" icon="CheckSquare" />
                            <strong>Editar</strong>
                        </x-base.tab.button>
                    </x-base.tab>
                    <x-base.tab id="btn_modal_eliminar" :fullWidth="false">
                        <x-base.tab.button class="mb-2 w-full cursor-pointer px-0 py-2 text-center text-danger sm:mx-2 sm:mb-0 sm:w-20">
                            <x-base.lucide class="mx-auto mb-2 block h-6 w-6" icon="Trash" />
                            <strong>Eliminar</strong>
                        </x-base.tab.button>
                    </x-base.tab>
                </x-base.tab.list>
                <x-base.dialog.footer class="bg-dark">
                    <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                </x-base.dialog.footer>
            </x-base.dialog.panel>
        </x-base.dialog>

    </div>
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
    <x-base.preview>
        <x-base.slideover id="modal_imprimir_ordenes" size="lg">
            <x-base.slideover.panel>
                <x-base.slideover.title class="p-5">
                    <h2 class="mr-auto text-base font-medium">
                        Imprimir Ordenes de Viaje
                    </h2>
                </x-base.slideover.title>
                    
                    <x-base.tab.group class="intro-y box col-span-12 lg:col-span-6" id="lista_empleados">
                    </x-base.tab.group>
                
            </x-base.slideover.panel>
        </x-base.slideover>
        <!-- END: Slide Over Content -->
    </x-base.preview>

    
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
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <script type="module">
            var accion_guardar = false;
            var accion = null;
            var id = null;
            var numero_empleado = null;
            var vehiculo_placa = null;
            var vehiculo_tipo = null;
            var fecha_salida = null;
            var hora_salida = null;
            var fecha_retorno = null;
            var hora_retorno = null;
            var numero_empleado_conductor = null;
            var itinerario = null;
            var proposito = null;
            var id_institucion = 1;
            var id_fuente = null;
            var id_gerencia_administrativa = null;
            var id_programa = null;
            var id_unidad_ejecutora = null;
            var id_actividad_obra = null;
            var id_articulo = null;
            var tabulator_id_solicitud = null;
            var tabulator_id_viajeros = null;
            var tabulator_viajeros = null;
            var tabulator_editar = null;
            var enviar_correo = null;
            var tabulator = null;
            var url_solicitudes_data = "{{url('/solicitudes/data')}}";
            var url_guardar_viaticos = "{{url('/viaticos/guardar')}}";
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	  

                $("#div_imprimir_orden_viaje").hide();

                //console.log(navigator.userAgent)

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
                        serverSide: false,
                    });
            });

            $('#sdatatable tbody').on('click', '.opciones', function() {
                id = $(this).data('id');
                $("#btn_editar").attr("href", ("{{url('/viaticos/editar/')}}/"+id));
                const el = document.querySelector("#modal_opciones");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });
            
            $("#btn_id_solicitud").on("click", function (event) {
                window.location.href = (`{{url('/solicitudes/${id}/viaticos/imprimir')}}`);
                /*$("#lista_empleados").html("");
                var id_viajeros = tabulator_id_viajeros;
                var arreglo_id_viajeros = id_viajeros.split(",");
                var viajeros = tabulator_viajeros;
                var arreglo_viajeros = viajeros.split(",");
                $.each(arreglo_id_viajeros, function (index, value) {
                    var url_imprimir = `{{url('/solicitudes/${tabulator_id_solicitud}/empleado/${arreglo_id_viajeros[index]}/imprimir')}}`;
                    $("#lista_empleados").append(`<div class="p-5">
                                                    <x-base.tab.panels>
                                                        <x-base.tab.panel id="latest-tasks-new" selected>
                                                            <div class="flex items-center">
                                                                <div class="border-l-2 border-primary pl-4 dark:border-primary">
                                                                    <a class="font-medium" href="${url_imprimir}">
                                                                        ${arreglo_viajeros[index]}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </x-base.tab.panel>
                                                    </x-base.tab.panels>
                                                </div>`);
                    });
                    const el = document.querySelector("#modal_imprimir_ordenes");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();*/

            });

            $("#btn_modal_eliminar").on("click", function (event) {
                $("#id_registro").html("Registro: " + id);
                accion = 3;
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

            });

            // $("#btn_registrar").on("click", function () {
            //     // var nuevaVentana = window.open("{{url('/viaticos/agregar')}}", "_blank");
            //     // nuevaVentana.focus();
            //     window.location.href = ("{{url('/viaticos/agregar')}}");
            // });

            $("#btn_eliminar").on("click", function () {
                guardar_viaticos();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();

                const el2 = document.querySelector("#modal_opciones");
                const modal2 = tailwind.Modal.getOrCreateInstance(el2);
                modal2.hide();
            });

            function guardar_viaticos() {
                accion_guardar = true;
                //alert(accion+' '+id)
                $.ajax({
                    type: "post",
                    url: url_guardar_viaticos,
                    data: {
                        'accion': accion,
                        'id': id,
                        'numero_empleado': numero_empleado,
                        'vehiculo_placa': vehiculo_placa,
                        'vehiculo_tipo': vehiculo_tipo,
                        'fecha_salida': fecha_salida,
                        'hora_salida': hora_salida,
                        'fecha_retorno': fecha_retorno,
                        'hora_retorno': hora_retorno,
                        'numero_empleado_conductor': numero_empleado_conductor,
                        'itinerario': itinerario,
                        'proposito': proposito,
                        'id_institucion': id_institucion,
                        'id_fuente': id_fuente,
                        'id_gerencia_administrativa': id_gerencia_administrativa,
                        'id_programa': id_programa,
                        'id_unidad_ejecutora': id_unidad_ejecutora,
                        'id_actividad_obra': id_actividad_obra,
                        'id_articulo': id_articulo,
                        'enviar_correo': enviar_correo
                    },
                    success: function (data) {
                        if (data.msgError != null) {
                            titleMsg = "Error al Guardar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                            notificacion()
                            accion_guardar = false;
                        } else {
                            titleMsg = "Datos Guardados";
                            textMsg = data.msgSuccess;
                            typeMsg = "success";
                            notificacion()
                            accion_guardar = false;
                            tabulator.replaceData()
                            $('#tabulator-html-filter-reset').trigger("click");
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