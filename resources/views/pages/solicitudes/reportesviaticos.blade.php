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
            <div class="w-10/12">
                <div class="text-base text-slate-500">Detalles de viaje</div>
                <div class="mt-2 text-lg font-medium text-primary">
                    {{$orden_viaje['fecha_viaje']}}
                </div>
                <br>
                <div class="mt-1 text-justify"><strong>Propósito del viaje:</strong> {{$orden_viaje['proposito']}}</div>
                <br>
                <div class="mt-1 text-justify"><strong>Itinerario de viaje:</strong> {{$orden_viaje['itinerario']}}</div>
            </div>
            <div class="w-2/12">
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
    <!-- END: Invoice -->

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
                                width: 150,
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
                                minWidth: 500,
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
                                minWidth: 100,
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
                                title: "ACCIONES",
                                minWidth: 100,
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
                                        $(`<div class="flex text-primary items-center lg:justify-center">
                                            <a class="flex items-center mr-3 opciones href="javascript:;">
                                                <i data-lucide="file" class="w-4 h-4 mr-1"></i> <strong>Imprimir </strong>
                                            </a>
                                        </div>`);
                                    $(a)
                                        .find(".opciones")
                                        .on("click", function () {
                                            window.location.href = (`{{url('/solicitudes/${id_solicitud}/empleado/${response.numero_empleado}/imprimir')}}`);
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

            
            $("#btn_id_solicitud").on("click", function (event) {
                $("#lista_empleados").html("");
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
                    modal.show();

            });

            $("#btn_modal_eliminar").on("click", function (event) {
                $("#id_registro").html("Regsitro: " + tabulator_id_solicitud);
                accion = 3;
                id = tabulator_id_solicitud;
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