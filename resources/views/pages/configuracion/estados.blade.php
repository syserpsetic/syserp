@extends('../layouts/' . $layout)

@section('subhead')
    <title>Estados</title>
@endsection

@section('subcontent')

        <!-- BEGIN: Profile Info -->
        <div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                   
                   
                            <x-base.lucide
                                class="h-40 w-40"
                                icon="crosshair"
                            />
                        
                
                    <div class="ml-5">
                        <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                            
                            <h1 class="text-5xl font-medium leading-none">ESTADOS</h1>
                        </div>
                        <div class="text-slate-500">Pantalla de administración de estados.</div>
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
                            <span class="text-white-700"> Lista de Estados</span>
                        </div></h3>
                </div>
            </div>
            <div class="intro-y col-span-6 lg:col-span-6 text-right">
                <div class="p-5">
                <x-base.button
                            class="mb-2 mr-1"
                            variant="primary"
                            id="btn_nuevo_estado"
                        ><i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                             Nuevo Estado
                        </x-base.button>
                </div>
            </div>
        </div>
        <div class="scrollbar-hidden overflow-x-auto">
            <div
                class="mt-5"
                id="tabulator"
            ></div>
        </div>
        <!-- BEGIN: Modal Content -->
        <x-base.dialog id="modal_nuevo_estado">
            <x-base.dialog.panel>
                <x-base.dialog.title class="bg-primary">
                    <h2 class="mr-auto text-white font-medium">
                        <div class="flex items-center">
                        <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                            <span class="text-white-700"> Nuevo Estado</span>
                        </div>
                    </h2>
                </x-base.dialog.title>
                <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12">
                        <x-base.form-label class="font-extrabold" for="modal_input_nombre_estado">
                            Nombre
                        </x-base.form-label>
                        <x-base.form-input id="modal_input_nombre_estado" type="text" placeholder="Nombre del estado" />
                    </div>
                    <div class="col-span-12 sm:col-span-12">
                        <x-base.form-label class="font-extrabold" for="modal_input_descripcion_estado">
                            Descripción
                        </x-base.form-label>
                        <x-base.form-input id="modal_input_descripcion_estado" type="text" placeholder="Describa el estado" />
                    </div>
                </x-base.dialog.description>
                <x-base.dialog.footer class="bg-dark">
                    <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                    <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_estado">
                        Guardar
                    </x-base.button>
                </x-base.dialog.footer>
            </x-base.dialog.panel>
        </x-base.dialog>
        <!-- END: Modal Content -->

     
                   
        <x-base.dialog id="modal_opciones">
            <x-base.dialog.panel>
                <x-base.dialog.title>
                    <h2 class="mr-auto text-base font-medium">
                        <strong>Opciones</strong>
                    </h2>
                </x-base.dialog.title>

                <x-base.tab.list class="flex-col justify-center sm:flex-row p-10 text-center" variant="boxed-tabs">
                    <x-base.tab id="btn_id_solicitud" :fullWidth="false">
                        <x-base.tab.button class="mb-2 w-full cursor-pointer px-0 py-2 text-center text-primary sm:mx-2 sm:mb-0 sm:w-20">
                            <x-base.lucide class="mx-auto mb-2 block h-6 w-6" icon="Printer" />
                            <strong>Imprimir</strong>
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
            </x-base.dialog.panel>
        </x-base.dialog>
    
    <!-- BEGIN: Modal Content -->
        <x-base.dialog id="modal_eliminar">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
                    <div class="mt-5 text-3xl">¡Advertencia!</div>
                    <div class="mt-2 text-slate-500">
                        ¿Realmente desea eliminar este estado?<br />
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
            var nombre = null;
            var descripcion = null;
            var tabulator_id_solicitud = null;
            var tabulator_id_viajeros = null;
            var tabulator_viajeros = null;
            var tabulator_editar = null;
            var enviar_correo = null;
            var tabulator = null;
            var url_estados_data = "{{url('configuracion/estados/data')}}";
            var url_guardar_estados = "{{url('/configuracion/estados/guardar')}}";
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
                        ajaxURL: url_estados_data,
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
                                title: "ID",
                                width: 100,
                                minWidth: 30,
                                field: "id",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"number",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.id}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "ESTADO",
                                minWidth: 200,
                                responsive: 0,
                                field: "nombre",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"input",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="font-medium whitespace-nowrap">${response.nombre}</div>
                                </div>`;
                                },
                            },
                            {
                                title: "DESCRIPCIÓN",
                                minWidth: 250,
                                responsive: 0,
                                field: "descripcion",
                                vertAlign: "middle",
                                print: false,
                                download: false,
                                headerFilter:"input",
                                headerFilterPlaceholder:"Buscar",
                                formatter(cell) {
                                    const response = cell.getData();
                                    return `<div>
                                    <div class="text-xs text-slate-500 whitespace-nowrap">${response.descripcion}</div>
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
                                        $(`<div class="flex items-center lg:justify-center">
                                            <a class="flex items-center mr-3 editar text-pending" href="javascript:;">
                                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                                            </a>
                                            <a class="flex items-center eliminar text-danger" href="javascript:;">
                                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                                            </a>
                                        </div>`);
                                    $(a)
                                        .find(".editar")
                                        .on("click", function () {
                                            accion = 2;
                                            id = response.id;
                                            $("#modal_input_nombre_estado").val(response.nombre);
                                            $("#modal_input_descripcion_estado").val(response.descripcion);
                                            const el = document.querySelector("#modal_nuevo_estado");
                                            const modal = tailwind.Modal.getOrCreateInstance(el);
                                            modal.show();
                                        });
                                        $(a)
                                        .find(".eliminar")
                                        .on("click", function () {
                                            $("#id_registro").html("Estado: " + response.nombre);
                                            accion = 3;
                                            id = response.id;
                                            const el = document.querySelector("#modal_eliminar");
                                            const modal = tailwind.Modal.getOrCreateInstance(el);
                                            modal.show();
                                        });
                                    return a[0];
                                },
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


            $("#btn_nuevo_estado").on("click", function (event) {
                $("#modal_input_nombre_estado").val('');
                $("#modal_input_descripcion_estado").val('');
                accion = 1;
                const el = document.querySelector("#modal_nuevo_estado");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

            });

            $("#modal_btn_guardar_estado").on("click", function () {
                nombre = $("#modal_input_nombre_estado").val();
                descripcion = $("#modal_input_descripcion_estado").val();
                
                if(nombre == null || nombre == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Nombre.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(descripcion == null || descripcion == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Fecha de Descripción.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }
                
                if(!accion_guardar){
                    guardar_estados()
                }
                
            });

            $("#btn_eliminar").on("click", function () {
                guardar_estados();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();
            });

            function guardar_estados() {
                accion_guardar = true;
                //alert(accion+' '+id)
                $.ajax({
                    type: "post",
                    url: url_guardar_estados,
                    data: {
                        'accion': accion,
                        'id': id,
                        'nombre' : nombre,
                        'descripcion' : descripcion,
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
                            const el = document.querySelector("#modal_nuevo_estado");
                            const modal = tailwind.Modal.getOrCreateInstance(el);
                            modal.hide()
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