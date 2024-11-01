@extends('../layouts/' . $layout)

@section('subhead')
    <title>Viáticos</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row"></div>
<!-- BEGIN: Invoice -->
<div class="intro-y box mt-5 overflow-hidden">
    <div class="flex flex-col px-5 pt-10 text-center sm:px-20 sm:pt-20 sm:text-left lg:flex-row lg:pb-10">
        <div class="text-3xl font-semibold text-primary">{{$orden_viaje['solicitud']}}</div>
        <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
            <!-- <div class="text-xl font-medium text-primary">{{$orden_viaje['etapa']}}</div> -->
            <x-base.form-switch class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto">
                <x-base.preview>
                    <div class="text-2xl text-primary lg:text-center font-sm leading-none">
                        <strong>
                            {{$orden_viaje['etapa']}}
                        </strong>
                    </div>
                    @if($cambiar_estado == 1)
                    <div class="flex flex-wrap justify-center mt-4">
                        <x-base.button class="mb-2 mr-2 w-32" variant="danger" size="sm" id="btn_rechazar"> <x-base.lucide class="mr-2 h-4 w-4" icon="ArrowLeft" /> Rechazar </x-base.button>
                        <x-base.button class="mb-2 mr-2 w-32" variant="primary" size="sm" id="btn_enviar">
                            &nbsp;&nbsp;Enviar &nbsp;
                            <x-base.lucide class="mr-2 h-4 w-4" icon="ArrowRight" />
                        </x-base.button>
                    </div>
                    @endif
                </x-base.preview>
            </x-base.form-switch>
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
            <br />
            <div class="mt-1 text-justify"><strong>Propósito del viaje (Viajeros):</strong> {{$orden_viaje['proposito']}}</div>
            <br />
            <div class="mt-1 text-justify"><strong>Propósito del viaje (Conductor):</strong> {{$orden_viaje['proposito_2']}}</div>
            <br />
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
    <!-- <div class="px-5 py-10 sm:px-16 sm:py-20">
        <div class="text-2xl font-semibold text-primary">Lista de viajeros</div>
        <div class="overflow-x-auto">
            <div class="scrollbar-hidden overflow-x-auto">
                <div class="mt-5" id="tabulator"></div>
            </div>
        </div>
    </div> -->
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box mt-5 p-5">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y col-span-6 lg:col-span-6">
                <div class="p-5">
                    <h3 class="text-2xl font-medium leading-none"><div class="flex items-center">
                        <i data-lucide="Users" class="w-6 h-6 mr-1"></i>
                            <span class="text-white-700"> Lista de Viajeros</span>
                        </div></h3>
                </div>
            </div>
            <div class="intro-y col-span-6 lg:col-span-6 text-right">
                <div class="p-5">
                    @if(in_array('zeta_escribir_calculo_viaticos', $scopes))
                        <x-base.button
                            class="mb-2 mr-1"
                            variant="primary"
                            id="btn_nueva_zona"
                        ><i data-lucide="percent" class="w-4 h-4 mr-1"></i>
                            Calcular Viáticos General
                        </x-base.button>
                    @endif
                </div>
            </div>
        </div>
        <div class="scrollbar-hidden overflow-x-auto">
            <table id="sdatatable" class="display datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>Número Empleado</th>
                        <th>Viajero</th>
                        <th>Tipo</th>
                        <th>Monto Asignado</th>
                        <th>Viaje</th>
                        <th>Observación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viajeros as $row)
                    <tr>
                        <td>{{$row['numero_empleado']}}</td>
                        <td>{{$row['viajeros']}}</td>
                        <td>{{$row['tipo']}}</td>
                        <td>{{$row['monto_diario_asignado_formato']}}</td>
                        <td><lord-icon
                                @if($row['activo_viaje']) src="https://cdn.lordicon.com/guqkthkk.json" @else src="https://cdn.lordicon.com/ramibnzh.json" @endif
                                trigger="loop"
                                delay="1000"
                                @if(!$row['activo_viaje']) colors="primary:#e83a30,secondary:#e4e4e4" state="in-reveal" @else state="in-reveal" @endif
                                style="width:14px;height:14px">
                            </lord-icon> {{$row['estado']}}
                        </td>
                        <td>{{$row['observacion']}}</td>
                        <td>
                        @if($row['activo_viaje'])
                                <x-base.button
                                    href="{{url('/solicitudes/')}}/{{$orden_viaje['id_solicitud']}}/empleado/{{$row['numero_empleado']}}/imprimir"
                                    as="a"
                                    class="mb-2 mr-1 text-dark"
                                    variant="pending"
                                    size="sm"
                                ><i data-lucide="Printer" class="w-4 h-4 mr-1"></i> Imprimir Orden Viaje
                                </x-base.button>
                            @if(in_array('zeta_escribir_calculo_viaticos', $scopes))
                                <x-base.button
                                    href="{{url('/solicitud_viaticos/')}}/{{$orden_viaje['id_solicitud']}}/ver_calculos/viajero/{{$row['numero_empleado']}}"
                                    as="a"
                                    class="mb-2 mr-1 text-white"
                                    variant="success"
                                    size="sm"
                                ><i data-lucide="percent" class="w-4 h-4 mr-1"></i> Calcular Viáticos
                                </x-base.button>
                                <x-base.button
                                    class="mb-2 mr-1 btn_anular_viaje"
                                    variant="danger"
                                    size="sm"
                                    data-id_ove="{{$row['id_ove']}}" 
                                    data-viajeros="{{$row['viajeros']}}" 
                                    data-tipo="{{$row['tipo']}}"
                                    data-monto_diario_asignado="{{$row['monto_diario_asignado']}}" 
                                    data-viajero="{{$row['viajeros']}}"
                                ><i data-lucide="minus-circle" class="w-4 h-4 mr-1"></i> Anular Viaje
                                </x-base.button>
                            @endif
                            @if(in_array('zeta_escribir_viaticos_asignar_monto', $scopes))
                                <x-base.button
                                    class="mb-2 mr-1 text-white btn_asignar_monto"
                                    variant="primary"
                                    size="sm"
                                    data-id_ove="{{$row['id_ove']}}" 
                                    data-viajeros="{{$row['viajeros']}}" 
                                    data-tipo="{{$row['tipo']}}"
                                    data-monto_diario_asignado="{{$row['monto_diario_asignado']}}" 
                                ><i data-lucide="dollar-sign" class="w-4 h-4 mr-1"></i> Asignar Monto
                                </x-base.button>
                            @endif
                        @else
                            @if(in_array('zeta_escribir_calculo_viaticos', $scopes))
                                <x-base.button
                                    class="mb-2 mr-1 btn_anular_viaje"
                                    variant="facebook"
                                    size="sm"
                                    data-id_ove="{{$row['id_ove']}}" 
                                    data-viajeros="{{$row['viajeros']}}" 
                                    data-tipo="{{$row['tipo']}}"
                                    data-monto_diario_asignado="{{$row['monto_diario_asignado']}}" 
                                    data-viajero="{{$row['viajeros']}}"
                                ><i data-lucide="check-circle" class="w-4 h-4 mr-1"></i> Reactivar Viaje
                                </x-base.button>
                            @endif
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                <div class="text-3x1" id="modal_text_tipo"></div>
                <br />
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

<!-- BEGIN: Modal Content -->
<x-base.dialog id="modal_anular_viaje">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <lord-icon
                        src="https://cdn.lordicon.com/akqsdstj.json"
                        trigger="loop"
                        delay="1000"
                        style="width:150px;height:150px">
                    </lord-icon>
                    <div class="mt-5 text-3xl">¡Advertencia!</div>
                    <div class="mt-2 text-slate-500">
                        ¿Realmente desea modificar el viaje de este empleado?<br />
                        <div id="viajero"></div>
                    </div>
                    <div class="input-form mt-3">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="input_observacion_anulacion">
                            Observación
                            <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0" id="text_observacion"> </span>
                        </x-base.form-label>
                        <x-base.form-textarea rows="5" class="form-control" id="input_observacion_anulacion" name="comment" placeholder="Escriba sus observaciones..."></x-base.form-textarea>
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancelar
                    </x-base.button>
                    <x-base.button class="w-24" type="button" variant="primary" id="btn_guardar_anular_viaje">
                        Aceptar
                    </x-base.button>
                </div>
            </x-base.dialog.panel>
        </x-base.dialog>
        <!-- END: Modal Content -->

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

<x-base.dialog id="modal_estado">
    <x-base.dialog.panel>
        <div class="p-5 text-center">
            <x-base.lucide id="modal_icono_rechazar" class="mx-auto mt-3 h-0 w-0 text-danger" icon="ArrowLeftCircle" />
            <x-base.lucide id="modal_icono_enviar" class="mx-auto mt-3 h-0 w-0 text-primary" icon="ArrowRightCircle" />
            <div class="mt-5 text-3xl" id="modal_encabezado_texto"></div>
            <div class="mt-2 text-slate-500">
                ¿A dónde desea enviar esta solicitud?<br />
                <br />
                <div class="text-2xl text-primary lg:text-center font-sm leading-none">
                    Estado Actual:
                    <strong>
                        {{$orden_viaje['etapa']}}
                    </strong>
                </div>
                <div class="p-5 text-left" id="div_estados_disponibles">
                    <center><x-base.form-label for="regular-form-4">Siguientes Estados Disponibles</x-base.form-label></center>
                    <x-base.tom-select id="input_estado_enviar" class="w-full" data-placeholder="Selección de estado">
                        @foreach($estados_disponibles as $row)
                        <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
                <div class="p-5 text-left" id="estados_disponibles_rechazar">
                    <center><x-base.form-label for="regular-form-4">Siguientes Estados Disponibles</x-base.form-label></center>
                    <x-base.tom-select id="input_estado_rechazar" class="w-full" data-placeholder="Selección de estado">
                        @foreach($estados_disponibles_rechazar as $row)
                        <option value="{{$row['id']}}">{{$row['nombre']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
                <div class="p-5">
                    <div class="input-form mt-3">
                        <x-base.form-label class="flex w-full flex-col sm:flex-row" htmlFor="input_observacion_estado">
                            Observación
                            <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0" id="text_observacion"> </span>
                        </x-base.form-label>
                        <x-base.form-textarea rows="5" class="form-control" id="input_observacion_estado" name="comment" placeholder="Escriba sus observaciones..."></x-base.form-textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                Cancelar
            </x-base.button>
            <x-base.button class="w-24" type="button" variant="primary" id="btn_guardar_estado">
                Guardar
            </x-base.button>
        </div>
    </x-base.dialog.panel>
</x-base.dialog>

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
            var accion_guardar_estado = false;  
            var accion_guardar_anulacion = false;  
            var id_solicitud_estado = "{{$orden_viaje['id_solicitud_estado']}}";
            var accion = null;
            var id = null;
            var id_orden_viaje = "{{$orden_viaje['id_orden_viaje']}}";
            var id_solicitud = "{{$orden_viaje['id_solicitud']}}";
            var id = (id_solicitud.length != 0) ? "{{$orden_viaje['id_solicitud']}}" : null;
            var estado = null
            var observacion_estado = null;
            var observacion_anulacion = null;
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
            var app_url = "{{ env('APP_URL') }}";
            var url_solicitud_viaticos_data = "{{url('/solicitudes/')}}/{{$orden_viaje['id_solicitud']}}/viaticos/imprimir/viajeros";
            var url_guardar_viaticos = "{{url('/viaticos/guardar')}}";
            var url_guardar_monto = "{{url('/viaticos/guardar_monto')}}";
            var url_anular_viaje = "{{url('/viaticos/anular_viaje')}}";
            var url_guardar_cambiar_estados = "{{url('/cambiar_estados')}}";
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;
            var estado_enviar = null;
            var table = null;
            var rowNumber = null;
            var numerofila = null;
            var fila = null;
            var id_seleccionar = localStorage.getItem("sdatatable_id_seleccionar");

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	  

                $("#div_imprimir_orden_viaje").hide();

                table = $('#sdatatable').DataTable({
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

            $("#sdatatable tbody").on( "click", "tr", function () { 
                                     rowNumber=parseInt(table.row( this ).index()); 
                                     table.$('tr.selected').removeClass('selected'); 
                                     $(this).addClass('selected'); 
                                     localStorage.setItem("sdatatable_id_seleccionar",table.row( this ).data()[0]); 
                                     });

            $("#sdatatable tbody").on("click", ".btn_asignar_monto", function () {
                id_ove = $(this).data('id_ove');
                monto = $(this).data('monto_diario_asignado');
                $("#modal_input_monto").val(monto);
                $("#modal_text_viajero").html('<strong>EMPLEADO: </strong>'+$(this).data('viajeros'));
                $("#modal_text_tipo").html('<strong>TIPO: </strong>'+$(this).data('tipo'));
                const el = document.querySelector("#modal_asignar_monto");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });

            $("#btn_rechazar").on("click", function (event) {
                estado_enviar = false;
                $("#div_estados_disponibles").hide();
                $("#estados_disponibles_rechazar").show();
                $("#modal_icono_rechazar").addClass('h-16 w-16')
                $("#modal_icono_enviar").removeClass('h-16 w-16')
                $("#modal_encabezado_texto").html('¡Rechazar Solicitud!');
                $("#text_observacion").html('Requerido');
                modal_estado_accion();
            });

            $("#btn_enviar").on("click", function (event) {
                estado_enviar = true;
                $("#div_estados_disponibles").show();
                $("#estados_disponibles_rechazar").hide();
                $("#modal_icono_rechazar").removeClass('h-16 w-16')
                $("#modal_icono_enviar").addClass('h-16 w-16')
                $("#modal_encabezado_texto").html('¡Enviar Solicitud!');
                $("#text_observacion").html('Opcional');
                modal_estado_accion();
            });

            $('#sdatatable tbody').on('click', '.btn_anular_viaje', function() {
                    accion = 3;
                    id = $(this).data('id_ove');
                    $('#viajero').html($(this).data('viajero'));
                    $("#input_observacion_anulacion").val('');
                    const el = document.querySelector("#modal_anular_viaje");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
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

            $("#btn_guardar_estado").on("click", function () {
                estado = (estado_enviar) ? $("#input_estado_enviar").val() : $("#input_estado_rechazar").val();;
                observacion_estado = $("#input_observacion_estado").val();

                if(estado == null || estado == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Estado.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if((observacion_estado == null || observacion_estado == '') && estado_enviar != true){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Observación.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                //alert(id_solicitud_estado+' '+estado+' '+observacion_estado)
                if(!accion_guardar_estado){
                    cambiar_estados()
                }
            });

            $("#btn_guardar_anular_viaje").on("click", function () {
                observacion_anulacion = $("#input_observacion_anulacion").val();
                
                if(observacion_anulacion == null || observacion_anulacion == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Observación.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }
                
                if(!accion_guardar_anulacion){
                    anular_viaje();
                }
                
            });

            function modal_estado_accion(){
                $("#"+typeMsg+"-notification").html('<div class="font-medium">' + titleMsg + "</div>" + '<div class="mt-1 text-slate-500">' + textMsg + "</div>");
                const el = document.querySelector("#modal_estado");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            }

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
                            var row = data.viajerosList;
                            var nuevoFila = [
                                row.numero_empleado, row.viajeros, row.tipo, row.monto_diario_asignado_formato, 
                                '<a href="https://granja.porcina.unag.edu.hn/solicitudes/'+id_solicitud+'/empleado/'+row.numero_empleado+'/imprimir" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-pending border-pending dark:border-pending mb-2 mr-1 text-dark">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="Printer" data-lucide="Printer" class="lucide lucide-Printer w-4 h-4 mr-1">'+
                                    '<polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Imprimir Orden Viaje'+
                                '</a>'
                                @if(in_array('zeta_escribir_calculo_viaticos', $scopes))
                                +'<a href="https://granja.porcina.unag.edu.hn/solicitud_viaticos/'+id_solicitud+'/ver_calculos/viajero/'+row.numero_empleado+'" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-success border-success dark:border-success mb-2 mr-1 text-white">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="percent" data-lucide="percent" class="lucide lucide-percent w-4 h-4 mr-1">'+
                                    '<line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg> Calcular Viáticos'+
                                '</a>'
                                @endif
                                @if(in_array('zeta_escribir_viaticos_asignar_monto', $scopes))
                                +'<button '+
                                    'data-id_ove="' + row.id_ove + '" '+
                                    'data-viajeros="' + row.viajeros + '" '+
                                    'data-tipo="' + row.tipo + '" '+
                                    'data-monto_diario_asignado="' + row.monto_diario_asignado + '" '+
                                    'class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-primary border-primary dark:border-primary btn_asignar_monto mb-2 mr-1 text-white btn_asignar_monto">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="dollar-sign" data-lucide="dollar-sign" class="lucide lucide-dollar-sign w-4 h-4 mr-1">'+
                                        '<line x1="12" y1="2" x2="12" y2="22"></line>'+
                                        '<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>'+
                                    '</svg> Asignar Monto'+
                                '</button>'
                                @endif
                            ]; 
                            $('#sdatatable').DataTable().row(rowNumber).data(nuevoFila);
                            notificacion()
                            accion_guardar = false;
                            const el = document.querySelector("#modal_asignar_monto");
                            const modal = tailwind.Modal.getOrCreateInstance(el);
                            modal.hide();
                        }
                    },
                });
            }

            function anular_viaje() {
                accion_guardar_anulacion = true;
                $.ajax({
                    type: "post",
                    url: url_anular_viaje,
                    data: {
                        'id': id,
                        'observacion': observacion_anulacion
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
                            var row = data.viajero;
                            var nuevoFila = [
                                row.numero_empleado, row.viajeros, row.tipo, row.monto_diario_asignado_formato, (row.activo_viaje) ? '<lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="loop" delay="1000" state="in-reveal" style="width:14px;height:14px"> ' + row.estado : '<lord-icon src="https://cdn.lordicon.com/ramibnzh.json" trigger="loop" delay="1000" colors="primary:#e83a30,secondary:#e4e4e4" state="in-reveal" style="width:14px;height:14px"> ' + row.estado, row.observacion, 
                                (row.activo_viaje) ?
                                '<a href="'+app_url+'/solicitudes/'+id_solicitud+'/empleado/'+row.numero_empleado+'/imprimir" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-pending border-pending dark:border-pending mb-2 mr-1 text-dark">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="Printer" data-lucide="Printer" class="lucide lucide-Printer w-4 h-4 mr-1">'+
                                    '<polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Imprimir Orden Viaje'+
                                '</a>'
                                @if(in_array('zeta_escribir_calculo_viaticos', $scopes))
                                +'<a href="'+app_url+'/solicitud_viaticos/'+id_solicitud+'/ver_calculos/viajero/'+row.numero_empleado+'" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-success border-success dark:border-success mb-2 mr-1 text-white">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="percent" data-lucide="percent" class="lucide lucide-percent w-4 h-4 mr-1">'+
                                    '<line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg> Calcular Viáticos'+
                                '</a>'
                                @endif
                                @if(in_array('zeta_escribir_viaticos_asignar_monto', $scopes))
                                +'<button '+
                                    'data-id_ove="' + row.id_ove + '" '+
                                    'data-viajeros="' + row.viajeros + '" '+
                                    'data-tipo="' + row.tipo + '" '+
                                    'data-monto_diario_asignado="' + row.monto_diario_asignado + '" '+
                                    'class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-primary border-primary dark:border-primary btn_asignar_monto mb-2 mr-1 text-white btn_asignar_monto">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="dollar-sign" data-lucide="dollar-sign" class="lucide lucide-dollar-sign w-4 h-4 mr-1">'+
                                        '<line x1="12" y1="2" x2="12" y2="22"></line>'+
                                        '<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>'+
                                    '</svg> Asignar Monto'+
                                '</button>'
                                @endif
                                +'<button '+
                                    'data-id_ove="' + row.id_ove + '" '+
                                    'data-viajeros="' + row.viajeros + '" '+
                                    'data-tipo="' + row.tipo + '" '+
                                    'data-monto_diario_asignado="' + row.monto_diario_asignado + '" '+
                                    'data-viajero="' + row.viajeros + '"'+
                                    'class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-danger border-danger text-white dark:border-danger btn_anular_viaje mb-2 mr-1 btn_anular_viaje">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="minus-circle" data-lucide="minus-circle" class="lucide lucide-minus-circle w-4 h-4 mr-1"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg> Anular Viaje'+
                                '</button>'
                                : '<button '+
                                    'data-id_ove="' + row.id_ove + '"'+
                                    'data-viajeros="' + row.viajeros + '"'+
                                    'data-tipo="' + row.tipo + '"'+
                                    'data-monto_diario_asignado="' + row.monto_diario_asignado + '"'+
                                    'data-viajero="' + row.viajeros + '"'+
                                    'class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-[#3b5998] border-[#3b5998] text-white dark:border-[#3b5998] btn_anular_viaje mb-2 mr-1 btn_anular_viaje">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-circle" data-lucide="check-circle" class="lucide lucide-check-circle w-4 h-4 mr-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>'+
                                        '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>'+
                                        '<polyline points="22 4 12 14.01 9 11.01"></polyline>'+
                                    '</svg>'+
                                    'Reactivar Viaje'+
                                '</button>'
                            ]; 
                            $('#sdatatable').DataTable().row(rowNumber).data(nuevoFila);
                            notificacion()
                            accion_guardar_anulacion = false;
                            const el = document.querySelector("#modal_anular_viaje");
                            const modal = tailwind.Modal.getOrCreateInstance(el);
                            modal.hide();
                        }
                    },
                });
            }

            function cambiar_estados() {
                accion_guardar_estado = true;
                $("#btn_guardar_estado").prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: url_guardar_cambiar_estados,
                    data: {
                        'id': id,
                        'id_solicitud_estado': id_solicitud_estado,
                        'estado': estado,
                        'observacion_estado': observacion_estado,
                    },
                    success: function (data) {
                        if (data.msgError != null) {
                            titleMsg = "Error al Guardar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                            notificacion()
                            accion_guardar_estado = false;
                        } else {
                            titleMsg = "Datos Guardados";
                            textMsg = data.msgSuccess;
                            typeMsg = "success";
                            notificacion()
                            setTimeout(function() {
                                window.location.href = ("{{url('/solicitudes')}}");
                            }, 1000);
                            // accion_guardar = false;
                            // $("#btn_guardar").prop("disabled", false);
                            // $("#icon_guardando").removeClass('w-8 h-8')
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