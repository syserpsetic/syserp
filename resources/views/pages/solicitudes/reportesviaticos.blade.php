@extends('../layouts/' . $layout)

@section('subhead')
    <title>Viáticos</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    </div>
    <!-- BEGIN: Invoice -->
    <div class="intro-y box mt-5 overflow-hidden">
        <div class="flex flex-col px-5 pt-10 text-center sm:px-20 sm:pt-20 sm:text-left lg:flex-row lg:pb-10">
            <div class="text-3xl font-semibold text-primary">{{$orden_viaje['solicitud']}}</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-xl font-medium text-primary">{{$orden_viaje['etapa']}}</div>
                <div class="mt-1">{{$orden_viaje['usuario_registro']}}</div>
                <div class="mt-1">{{$orden_viaje['fechas_registro']}}</div>
            </div>
        </div>
        <div class="flex flex-col border-b px-5 pt-0 pb-10 text-center sm:px-20 sm:pb-20 sm:text-left lg:flex-row">
            <div class="w-8/12">
                <div class="text-base text-slate-500">Detalles de viaje</div>
                <div class="mt-2 text-lg font-medium text-primary">
                    {{$orden_viaje['fecha_viaje']}}
                </div>
                <br>
                <div class="mt-1 text-justify"><strong>Propósito del viaje:</strong> {{$orden_viaje['proposito']}}</div>
                <br>
                <div class="mt-1 text-justify"><strong>Itinerario de viaje:</strong> {{$orden_viaje['itinerario']}}</div>
            </div>
            <div class="w-4/12">
                <div class="mt-10 lg:mt-0 lg:ml-20 lg:text-right">
                    <div class="text-base text-slate-500">Vehículo</div>
                    <div class="mt-2 text-lg font-medium text-primary">
                        # {{$orden_viaje['vehiculo_placa']}}
                    </div>
                    <div class="mt-1">{{$orden_viaje['vehiculo_tipo']}}</div>
                </div>
            </div>
        </div>
        <div class="px-5 py-10 sm:px-16 sm:py-20">
        <div class="text-2xl font-semibold text-primary">Lista de viajeros</div>
            <div class="overflow-x-auto">
                <div class="scrollbar-hidden overflow-x-auto">
                    <div
                        class="mt-5"
                        id="tabulator"
                    ></div>
                </div>
            </div>
        </div>
    </div>


    <x-base.dialog id="modal_asignar_monto">
        <x-base.dialog.panel>
            <x-base.dialog.title class="bg-primary">
                <h2 class="mr-auto text-white font-medium">
                    <div class="flex items-center">
                        <i data-lucide="dollar-sign" class="w-4 h-4 mr-1"></i>
                        <span class="text-white-700"> Asignar Monto</span>
                    </div>
                </h2>
            </x-base.dialog.title>
            <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12">
                <div class="text-3x1" id="modal_text_viajero"></div>
                <div class="text-3x1" id="modal_text_tipo"></div><br>
                    <x-base.form-label class="font-extrabold" for="modal_input_monto">
                        Monto
                    </x-base.form-label>
                    <x-base.form-input id="modal_input_monto" type="number" placeholder="1234.56" />
                </div>
            </x-base.dialog.description>
            <x-base.dialog.footer class="bg-dark">
                <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                    Cancelar
                </x-base.button>
                <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_monto">
                    Guardar
                </x-base.button>
            </x-base.dialog.footer>
        </x-base.dialog.panel>
    </x-base.dialog>
<!-- END: Invoice -->

<div class="text-center">
    <!-- BEGIN: Notification Content -->
    <div id="success-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex flex flex">
        <i data-lucide="check-circle" width="24" height="24" class="stroke-1.5 text-success text-success"></i>
        <div id="success-notification" class="ml-4 mr-4"></div>
    </div>

    <div id="danger-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex flex flex">
        <i data-lucide="x-circle" width="24" height="24" class="stroke-1.5 text-danger text-danger"></i>
        <div id="danger-notification" class="ml-4 mr-4"></div>
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
            var id = null;
            var id_solicitud = "{{$orden_viaje['id']}}";
            var id_ove = null;
            var monto = null;
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
            var url_solicitud_viaticos_data = "{{url('/solicitudes/')}}/{{$orden_viaje['id']}}/viaticos/imprimir/viajeros";
            var url_guardar_viaticos = "{{url('/viaticos/guardar')}}";
            var url_guardar_monto = "{{url('/viaticos/guardar_monto')}}";
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

                (function () {
                "use strict";


                // Tabulator
                if ($("#tabulator").length) {
                    // Setup Tabulator
                    tabulator = new Tabulator("#tabulator", {
                        ajaxURL: url_solicitud_viaticos_data,
                        paginationMode: "local",
                        filterMode: "local",
                        sortMode: "local",
                        fitColumns:true,
                        printAsHtml: true,
                        printStyled: true,
                        pagination: true,
                        paginationSize: 10,
                        paginationSizeSelector: [10, 20, 30, 40],
                        layout: "fitColumns",
                        responsiveLayout: "collapse",
                        placeholder: "No matching records found",
                        columns: [
                            {
                                title: "",
                                formatter: "responsiveCollapse",
                                width: 40,
                                minWidth: 30,
                                hozAlign: "center",
                                resizable: false,
                                headerSort: false,
                            },

                            // For HTML table
                            {
                                title: "NUMERO EMPLEADO",
                                width: 100,
                                minWidth: 30,
                                field: "numero_empleado",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"number",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.numero_empleado}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "VIAJERO",
                                minWidth: 400,
                                responsive: 0,
                                field: "viajeros",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"input",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.viajeros}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "TIPO",
                                minWidth: 50,
                                responsive: 0,
                                field: "tipo",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"input",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.tipo}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "MONTO ASIGNADO",
                                minWidth: 80,
                                responsive: 0,
                                field: "monto_diario_asignado_formato",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"input",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.monto_diario_asignado_formato}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "ACCIONES",
                                minWidth: 120,
                                field: "actions",
                                responsive: 1,
                                hozAlign: "center",
                                headerHozAlign: "center",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                formatter(cell) {
                                    const response = cell.getData();
                                    let a =
                                        $(`<div class="flex items-center lg:justify-center">
                                            <a class="flex items-center mr-3 opciones href="javascript:;">
                                                <i data-lucide="file" class="w-4 h-4 mr-1"></i> <strong>Imprimir </strong>
                                            </a>
                                            <a class="flex text-success items-center mr-3 asignar_monto href="javascript:;">
                                                <i data-lucide="dollar-sign" class="w-4 h-4 mr-1"></i> <strong>Asignar Monto </strong>
                                            </a>
                                        </div>`);
                                    $(a)
                                        .find(".opciones")
                                        .on("click", function () {
                                            window.location.href = (`{{url('/solicitudes/${id_solicitud}/empleado/${response.numero_empleado}/imprimir')}}`);
                                    });
                                    $(a)
                                        .find(".asignar_monto")
                                        .on("click", function () {
                                            id_ove = response.id_ove;
                                            $("#modal_input_monto").val(response.monto_diario_asignado);
                                            $("#modal_text_viajero").html(`<strong>Asignar monto diario a:</strong> ${response.viajeros}`)
                                            $("#modal_text_tipo").html(`<strong>Tipo:</strong> ${response.tipo}`)
                                            const el = document.querySelector("#modal_asignar_monto");
                                            const modal = tailwind.Modal.getOrCreateInstance(el);
                                            modal.show();
                                    });
                                    return a[0];
                                },
                            },
                            

                            // For print format
                            {
                                title: "ID",
                                field: "id",
                                visible: false,
                                print: true,
                                download: true,
                            },
                            {
                                title: "VIAJEROS",
                                field: "viajeros",
                                visible: false,
                                print: true,
                                download: true,
                            },
                        
                        ],
                    });

                    tabulator.on("renderComplete", () => {
                        createIcons({
                            icons,
                            attrs: {
                                "stroke-width": 1.5,
                            },
                            nameAttr: "data-lucide",
                        });
                    });

                    // Filter function
                    function filterHTMLForm() {
                        let field = $("#tabulator-html-filter-field").val();
                        let type = $("#tabulator-html-filter-type").val();
                        let value = $("#tabulator-html-filter-value").val();
                        tabulator.setFilter(field, type, value);
                    }

                    // On click go button
                    $("#tabulator-html-filter-go").on("click", function (event) {
                        filterHTMLForm();
                    });

                    // On reset filter form
                    $("#tabulator-html-filter-reset").on("click", function (event) {
                        $("#tabulator-html-filter-field").val("id");
                        $("#tabulator-html-filter-type").val("like");
                        $("#tabulator-html-filter-value").val("");
                        filterHTMLForm();
                    });

                    // Export
                    $("#tabulator-export-csv").on("click", function (event) {
                        tabulator.download("csv", "data.csv");
                    });

                    $("#tabulator-export-json").on("click", function (event) {
                        tabulator.download("json", "data.json");
                    });

                    $("#tabulator-export-xlsx").on("click", function (event) {
                        tabulator.download("xlsx", "data.xlsx", {
                            sheetName: "Products",
                        });
                    });

                    $("#tabulator-export-html").on("click", function (event) {
                        tabulator.download("html", "data.html", {
                            style: true,
                        });
                    });

                    // Print
                    $("#tabulator-print").on("click", function (event) {
                        tabulator.print();
                    });
                }
            })();

            });

            $("#modal_btn_guardar_monto").on("click", function () {
                monto = $("#modal_input_monto").val();
                
                if(monto == null || monto == '' || monto <= 0){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor adecuado para Monto.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(!accion_guardar){
                    guardar_monto();
                }
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

            function guardar_monto() {
                accion_guardar = true;
                $.ajax({
                    type: "post",
                    url: url_guardar_monto,
                    data: {
                        'monto': monto,
                        'id': id_ove
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
                            const el = document.querySelector("#modal_asignar_monto");
                            const modal = tailwind.Modal.getOrCreateInstance(el);
                            modal.hide();
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