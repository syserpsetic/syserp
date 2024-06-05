@extends('../layouts/' . $layout)

@section('subhead')
    <title>Cáculo De Viáticos</title>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Info -->
<div class="intro-y box mt-5 px-5 pt-5">
    <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
        <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
            <x-base.lucide class="h-40 w-40" icon="percent" />
            <div class="lg:ml-5 mt-5 lg:mt-0">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl font-medium leading-none">CÁLCULO DE VIÁTICOS</h1>
                </div>
                <div class="text-center lg:text-left text-slate-500">
                    Pantalla de cálculo de viáticos por viajero.
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row justify-center lg:justify-start mt-5">
        <div class="flex flex-col md:flex-row justify-center lg:justify-start gap-4 w-full max-w-lg">
            <x-base.button
                class="w-full md:w-44"
                href="{{ url('/solicitudes/') }}/{{ $detalleViaje['id_solicitud'] }}/viaticos/imprimir"
                as="a"
                variant="primary"
            >
                <x-base.lucide class="mr-2 h-6 w-6" icon="ArrowLeftCircle" />
                Regresar
            </x-base.button>
            
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <x-base.input-group inputGroup>
                        <x-base.input-group.text><x-base.lucide class="mr-2 h-6 w-6" icon="User" /></x-base.input-group.text>
                        <x-base.form-select class="w-full md:w-56" aria-label="Default select example" id="input_viajero">
                            @foreach($viajerosLista as $row)
                                <option value="{{ $row['numero_empleado'] }}">{{ $row['nombre_viajero'] }}</option>
                            @endforeach
                        </x-base.form-select>
                    </x-base.input-group>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<!-- END: Profile Info -->
<!-- BEGIN: Profile Info -->
<div class="intro-y box mt-5 px-5 pt-5">
    <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
        <div class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
            <div class="text-center font-medium lg:mt-3 lg:text-left">
                Detalles del Viaje
            </div>
            <div class="mt-2 flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="User" />
                    <strong>Nombre del Empleado:&nbsp; </strong> {{$detalleViaje['nombre_viajero']}}
                </div>
            </div>
            <div class="mt flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="Target" />
                    <strong>Categoría del Empleado:&nbsp; </strong> {{$detalleViaje['categoria']}}
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="Hash" />
                    <strong>Orden de viaje No.:&nbsp; </strong>
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="ArrowUp" />
                    <strong>Fecha de inicio del viaje:&nbsp; </strong> {{$detalleViaje['fecha_salida']}}
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="ArrowDown" />
                    <strong>Fecha de final del viaje:&nbsp; </strong> {{$detalleViaje['fecha_retorno']}}
                </div>
            </div>
            <!-- <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="DollarSign" />
                    <strong>Tasa de cambio del día:&nbsp; </strong> {{$tasaCambioFormato}}
                </div>
            </div>
            <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="MapPin" />
                    <strong>Itinerario:&nbsp; </strong> {{$detalleViaje['itinerario']}}
                </div>
            </div> -->
        </div>
        <div class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
            <div class="p-5 mt-6 box intro-x bg-primary">
                <div class="flex flex-wrap gap-3">
                    <div class="mr-auto">
                        <div class="flex items-center leading-3 text-white text-opacity-70 dark:text-slate-300">
                            PRECIO DEL DOLAR SEGÚN BCH
                            <x-base.tippy
                                as="div"
                                content="El total equivale a: $1.00"
                            >
                                <x-base.lucide
                                    class="ml-1.5 h-4 w-4"
                                    icon="AlertCircle"
                                />
                            </x-base.tippy>
                        </div>
                        <div class="relative mt-3.5 pl-4 text-2xl font-medium leading-5 text-white">
                            {{$tasaCambioFormato}}
                        </div>
                    </div>
                    <a
                        class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-full bg-opacity-20 hover:bg-opacity-30 dark:bg-darkmode-300"
                        href="https://www.bancatlan.hn"
                        target="_blank"
                        data-placement="top" title="Consultar Precio del Dolar en Banco Atlantida"
                    >
                    <img class="w-6 h-6" src="{{ Vite::asset('resources/images/logo_atlantida.png') }}" alt="Nombre de la imagen">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="flex items-center justify-center lg:justify-start">
                <div class="flex items-center truncate sm:whitespace-normal">
                    <x-base.lucide class="mr-2 h-4 w-4" icon="MapPin" />
                    <strong>Itinerario:&nbsp; </strong> {{$detalleViaje['itinerario']}}
                </div>
            </div>
            <br>
</div>

<!-- END: Profile Info -->
<!-- BEGIN: Product Variant (Details) -->
<div class="intro-y box mt-5 p-5">
    <div class="rounded-md border border-slate-200/60 p-5 dark:border-darkmode-400">
        <div class="flex items-center flex-col md:flex-row border-b border-slate-200/60 pb-5 text-base font-medium dark:border-darkmode-400">
            <strong>Detalles del Cálculo</strong>
            <div class="mt-3 md:mt-0 md:ml-auto">
                <div class="flex items-center">
                    <div class="mr-4">
                        <span class="mr-2 text-sm">Asignar tasa de cambio</span>
                    </div>
                    <div class="flex-shrink-0">
                        <x-base.input-group inputGroup>
                            <x-base.input-group.text>L.</x-base.input-group.text>
                            <x-base.form-input
                                type="number"
                                placeholder="12.3456"
                                value="{{$tasaCambioAsignada}}"
                                id="input_tasa_cambio"
                            />
                        </x-base.input-group>
                    </div>
                    <div class="ml-4">
                        <x-base.button id="btn_ejecutar_calculo" class="w-full md:w-44" variant="primary">
                            <x-base.lucide class="mr-2 h-4 w-4" icon="Activity" />
                            Ejecutar
                        </x-base.button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <x-base.form-inline class="mt-5 flex-col items-start pt-5 first:mt-0 first:pt-0 xl:flex-row" formInline>
                <div class="mt-3 w-full flex-1 xl:mt-0">
                    <div class="overflow-x-auto">
                        <x-base.table class="border">
                            <x-base.table.thead>
                                <x-base.table.tr>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 text-slate-500 dark:bg-darkmode-800">
                                        <div class="flex items-center">
                                            Viáticos
                                            <div class="mt-3 flex w-15 text-slate-500 lg:mt-0">
                                                <a href="#" class="ml-3 lg:ml-5" id="agregar_nueva_zona" data-placement="top" title="Agregar Nueva Zona">
                                                    <x-base.lucide class="h-5 w-5" icon="PlusCircle" />
                                                </a>
                                                <a href="#" class="ml-3 lg:ml-5" id="eliminar_zona" data-placement="top" title="Eliminar Zona">
                                                    <x-base.lucide class="h-5 w-5" icon="Trash" />
                                                </a>
                                                <a href="#" class="ml-3 lg:ml-5" id="cambiar_categoria" data-placement="top" title="Cambiar Categoría">
                                                    <x-base.lucide class="h-5 w-5" icon="Shuffle" />
                                                </a>
                                            </div>
                                        </div>
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 text-slate-500 dark:bg-darkmode-800">
                                        <div class="flex items-center">
                                            Movimientos
                                        </div>
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !px-2 text-slate-500 dark:bg-darkmode-800">
                                        Liquidable
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !px-2 text-slate-500 dark:bg-darkmode-800">
                                        Asignación Diaria
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !px-2 text-slate-500 dark:bg-darkmode-800">
                                        Tipo Cambio
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !pl-2 text-slate-500 dark:bg-darkmode-800">
                                        NO
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !pl-2 text-slate-500 dark:bg-darkmode-800">
                                        DÍA/NOCHE
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !pl-2 text-slate-500 dark:bg-darkmode-800">
                                        SUB TOTAL $
                                    </x-base.table.th>
                                    <x-base.table.th class="whitespace-nowrap bg-slate-50 !pl-2 text-slate-500 dark:bg-darkmode-800">
                                        SUB TOTAL LPS
                                    </x-base.table.th>
                                </x-base.table.tr>
                            </x-base.table.thead>
                            <x-base.table.tbody>
                                @foreach($zonasCalculadas as $row)
                                <x-base.table.tr>
                                    <x-base.table.td class="border-r" rowspan="5">
                                        @if($row['id'] == 99999999999999) <h5 class="mt-3 text-lg text-center font-medium leading-none"><strong> {{$row['zona']}} </strong></h5> @else {{$row['zona']}} @endif
                                    </x-base.table.td>
                                </x-base.table.tr>
                                @foreach($detalleCalculo as $row2) @if($row['id'] == $row2['id_zona'])
                                <x-base.table.tr>
                                    <x-base.table.td>
                                        {{$row2['movimientos']}}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        @if($row2['id'] != null)
                                            <x-base.form-check class="mt-2">
                                                <x-base.form-check.input id="liquidable_{{$row2['id']}}" type="checkbox" value="true" checked="{{$row2['class_es_liquidable']}}"/>
                                            </x-base.form-check>
                                        @endif
                                    </x-base.table.td>
                                    <x-base.table.td class="!px-2">
                                        {{$row2['monto_formato']}}
                                    </x-base.table.td>
                                    <x-base.table.td class="!px-2" id="td_tipo_cambio_{{$row2['id']}}">
                                        {{$row2['tasa_cambio']}}
                                    </x-base.table.td>
                                    <x-base.table.td class="!pl-2">
                                        @if($row2['id'] != null)
                                            <x-base.form-input class="min-w-[6rem]" type="text" placeholder="Días" value="{{$row2['numero_jornadas']}}" id="input_dias_{{$row2['id']}}" />
                                        @endif
                                    </x-base.table.td>
                                    <x-base.table.td class="!pl-2">
                                        @if($row2['id'] != null)
                                            <x-base.form-select class="mt-2 sm:mr-2" aria-label="Default select example" id="input_dia-noche_{{$row2['id']}}">
                                                @foreach($diasJornadas as $row3)
                                                    @if ($row3['id'] == 1 && $row2['movimiento_id'] == 1) 
                                                        @continue
                                                    @endif
                                                <option value="{{$row3['id']}}">{{$row3['nombre']}}</option>
                                                @endforeach
                                            </x-base.form-select>
                                        @endif
                                    </x-base.table.td>
                                    <x-base.table.td class="!px-2" id="sub_total_usd_{{$row2['id']}}"> @if($row2['id'] != null) {{$row2['subtotal_dolares']}} @endif</x-base.table.td>
                                    <x-base.table.td class="!px-2" id="sub_total_lps_{{$row2['id']}}_{{$row2['id_zona']}}"> @if($row2['id'] == 0 && $row2['id_zona'] != 99999999999999) <strong>{{$row2['subtotal_lempiras']}}</strong>@elseif($row2['id'] == 0 && $row2['id_zona'] == 99999999999999) <h5 class="mt-3 text-lg font-medium leading-none"><strong> {{$row2['subtotal_lempiras']}} </strong></h5> @else {{$row2['subtotal_lempiras']}} @endif </x-base.table.td>
                                </x-base.table.tr>
                                @endif @endforeach @endforeach
                            </x-base.table.tbody>
                        </x-base.table>
                    </div>
                </div>
            </x-base.form-inline>
        </div>
    </div>
</div>
<!-- END: Product Variant (Details) -->

<!-- BEGIN: Modal Content -->
<x-base.dialog id="modal_agregar_nueva_zona">
    <x-base.dialog.panel>
        <x-base.dialog.title class="bg-primary">
            <h2 class="mr-auto text-white font-medium">
                <div class="flex items-center">
                    <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                    <span class="text-white-700"> Nueva Zona</span>
                </div>
            </h2>
        </x-base.dialog.title>
        <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
            <div class="col-span-12 sm:col-span-12">
                <x-base.form-label class="font-extrabold" for="modal_select_zona">
                    Zona
                </x-base.form-label>
                <x-base.form-select class="mt-2 sm:mr-2" aria-label="Default select example" id="modal_select_zona">
                    @foreach($zonasDisponibles as $row)
                    <option value="{{$row['id']}}">{{$row['zona']}}</option>
                    @endforeach
                </x-base.form-select>
            </div>
            <div class="col-span-12 sm:col-span-12">
                <x-base.form-label class="font-extrabold" for="modal_select_categoria">
                    Categoría
                </x-base.form-label>
                <x-base.form-select class="mt-2 sm:mr-2" aria-label="Default select example" id="modal_select_categoria">
                    @foreach($categorias as $row)
                    <option value="{{$row['id']}}">{{$row['descripcion']}}</option>
                    @endforeach
                </x-base.form-select>
            </div>
        </x-base.dialog.description>
        <x-base.dialog.footer class="bg-dark">
            <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                Cancelar
            </x-base.button>
            <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_zona">
                Guardar
            </x-base.button>
        </x-base.dialog.footer>
    </x-base.dialog.panel>
</x-base.dialog>

<x-base.dialog id="modal_eliminar">
    <x-base.dialog.panel>
        <div class="p-5 text-center">
            <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
            <div class="mt-5 text-3xl">¡Advertencia!</div>
            <div class="mt-2 text-slate-500">
                Elija cuidadosamente la zona que desea eliminar.<br />
                <div class="col-span-12 sm:col-span-12">
                    <x-base.form-select class="mt-2 sm:mr-2" aria-label="Default select example" id="modal_select_zona_eliminar">
                        @foreach($zonasCalculadas as $row)
                            @if ($row['id'] == 99999999999999) 
                                @continue
                            @endif
                        <option value="{{$row['id']}}">{{$row['zona']}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
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

<!-- BEGIN: Modal Content -->
<x-base.dialog id="modal_asignar_categoria" staticBackdrop>
    <x-base.dialog.panel>
        <div class="p-5 text-center">
            <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-warning" icon="AlertTriangle" />
            <div class="mt-5 text-3xl">¡Advertencia!</div>
            <div class="mt-2 text-slate-500">
                Por favor asigne una categoría al empleado:
                <p><strong>{{$detalleViaje['nombre_viajero']}}</strong></p>
                <div class="col-span-12 sm:col-span-12">
                    <x-base.form-select class="mt-2 sm:mr-2" aria-label="Default select example" id="modal_select_asignar_categoria">
                        @foreach($categorias as $row)
                        <option @if($row['id'] == 5) selected @endif value="{{$row['id']}}">{{$row['descripcion']}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
                <div class="mt-2 text-slate-500">
                    <x-base.form-check class="mr-2">
                                    <x-base.form-check.input
                                        id="checkbox_categoria_general"
                                        type="checkbox"
                                        value=""
                                    />
                                    <x-base.form-check.label for="checkbox_categoria_general">
                                        ¿Aplicar la misma categoría para todos los empleados de este viaje?
                                    </x-base.form-check.label>
                                </x-base.form-check>
                                </div>
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <i id="i_modal_categoria_cerrar"> </i>
            <x-base.button class="w-24" type="button" variant="primary" id="btn_asignar_categoria">
                Asignar
            </x-base.button>
        </div>
    </x-base.dialog.panel>
</x-base.dialog>
<!-- END: Modal Content -->

<!-- END: HTML Table Data -->
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
            var nombre = null;
            var descripcion = null;
            var zonaId = null;
            var categoriaId = null;
            var aplicarCategoriaGeneral = null;
            var numeroEmpleado = {{$detalleViaje['numero_empleado']}};
            var solicitudId = {{$detalleViaje['id_solicitud']}};
            var enviar_correo = null;
            var tabulator = null;
            var url_zonas_data = "{{url('/configuracion/zonas/data')}}";
            var url_guardarCalculo = "{{url('/solicitud_viaticos/guardar_calculos/viajero')}}";
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;
            var numerofila = null;
            var nuevafila = null;
            var array = [];
            var objeto = {};
            var calculos = null;
            var subTotalLPS = null;

            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	 
                    
            });

                $("#input_viajero").val(numeroEmpleado);

                $("#input_viajero").change(function(){
                    var empleadoSeleccionado = $("#input_viajero").val();
                    window.location.href = ("{{url('/solicitud_viaticos/')}}/"+solicitudId+"/ver_calculos/viajero/"+empleadoSeleccionado);
                });

                if({{$detalleViaje['categoria_id']}} == 0){
                    const el = document.querySelector("#modal_asignar_categoria");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
                }
                    
                //Inicia calculo de viaticos
                @foreach($detalleCalculo as $row)
                $("#input_dia-noche_{{$row['id']}}").val({{$row['tipo_jornada_id']}});
                array.push({ 
                    "id"    : {{$row['id']}},
                    "id_zona" : {{$row['id_zona']}},
                    "numero_jornadas"    : ({{$row['id']}} === 0) ? 0 : $("#input_dias_{{$row['id']}}").val(),
                    "tipo_jornada_id" : ({{$row['id']}} === 0) ? 0 : $("#input_dia-noche_{{$row['id']}}").val(),
                    "liquidable": ("{{$row['es_liquidable']}}" === '') ? false : true,
                    "tipo_cambio": ({{$row['id']}} === 0) ? 0 : $("#input_tasa_cambio").val(),
                    "sub_total": {{$row['subtotal']}},
                    "tipo_moneda_id" : {{$row['tipo_moneda_id']}},
                });

                    $("#input_dias_{{$row['id']}}, #input_dia-noche_{{$row['id']}}, #liquidable_{{$row['id']}}, #input_tasa_cambio").change(function(){
                        // if($("#input_tasa_cambio").val() == null || $("#input_tasa_cambio").val() == ''){
                        //     titleMsg = 'Valor Requerido'
                        //     textMsg = 'Debe asinar un valor para tasa de cambio.';
                        //     typeMsg = 'error';
                        //     notificacion()
                        //     return false;
                        // }
                        var dias = 0;
                        var tipo_jornada = null;
                        var monto = null;
                        var subTotalUSD = null;
                        var tipoCambio = 0;
                        var subTotal = null;
                        var valorCheckbox = false;
                        dias = ({{$row['id']}} == 0) ? 0 : $("#input_dias_{{$row['id']}}").val();
                        tipo_jornada = ({{$row['id']}} == 0) ? 0 : $("#input_dia-noche_{{$row['id']}}").val();
                        valorCheckbox = ({{$row['id']}} === 0) ? false : $("#liquidable_{{$row['id']}}").prop('checked');
                        monto = {{$row['monto']}};
                        subTotal= monto*dias;
                        if({{$row['tipo_moneda_id']}} == 2){
                            subTotalUSD = subTotal.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                            $("#sub_total_usd_{{$row['id']}}").html(subTotalUSD);
                            tipoCambio = parseFloat($("#input_tasa_cambio").val());
                            var tipoCambioFormato = tipoCambio.toLocaleString('es-HN', { style: 'currency', currency: 'HNL' });
                            $("#td_tipo_cambio_{{$row['id']}}").html(tipoCambioFormato);
                            //console.log(tipoCambioFormato)
                            subTotal = subTotal*tipoCambio;
                        }
                        subTotalLPS = subTotal.toLocaleString('es-HN', { style: 'currency', currency: 'HNL' });
                        $("#sub_total_lps_{{$row['id']}}_{{$row['id_zona']}}").html(subTotalLPS);

                        for (var i = 0; i < array.length; i++) {
                            if (array[i].id === {{$row['id']}}) {
                                array[i].numero_jornadas = dias;
                                array[i].tipo_jornada_id = tipo_jornada;
                                array[i].liquidable = valorCheckbox;
                                array[i].sub_total = subTotal;
                            }
                        }
                        
                        for (var i = 0; i < array.length; i++) {
                            if(array[i].tipo_moneda_id === {{$row['tipo_moneda_id']}}) {
                                array[i].tipo_cambio = tipoCambio;
                            }
                        }

                        var sumaSubTotal = 0;
                        for (var i = 0; i < array.length; i++) {
                            if(array[i].id_zona === {{$row['id_zona']}}) {
                                sumaSubTotal += array[i].sub_total;
                            }
                        }

                        var sumaTotal = 0;
                        for (var i = 0; i < array.length; i++) {
                            if(array[i].id_zona != 0) {
                                sumaTotal += array[i].sub_total;
                            }
                        }
                        $("#sub_total_lps_0_{{$row['id_zona']}}").html('<strong>'+sumaSubTotal.toLocaleString('es-HN', { style: 'currency', currency: 'HNL' })+'</strong>');
                        $("#sub_total_lps_0_99999999999999").html('<h5 class="mt-3 text-lg font-medium leading-none"><strong>'+sumaTotal.toLocaleString('es-HN', { style: 'currency', currency: 'HNL' })+'</strong</h5>');
                        //console.log(sumaTotal);
                    });

                @endforeach
                //Finaliza calculo de viaticos

                $('#eliminar_zona').on('click', function(event) {
                    accion = 3;
                    const el = document.querySelector("#modal_eliminar");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
                });



            $("#agregar_nueva_zona").on("click", function (event) {
                // $("#modal_input_nombre_zona").val('');
                // $("#modal_input_descripcion_zona").val('');
                accion = 1;
                const el = document.querySelector("#modal_agregar_nueva_zona");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();

            });

            $("#modal_btn_guardar_zona").on("click", function () {
                zonaId = $("#modal_select_zona").val();
                categoriaId = $("#modal_select_categoria").val();

                //alert(zonaId+' '+categoriaId+' '+numeroEmpleado+' '+solicitudId)
                
                if(!accion_guardar){
                    guardarCalculo();
                }
                
            });

            $("#btn_eliminar").on("click", function () {
                zonaId = $("#modal_select_zona_eliminar").val();
                guardarCalculo();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();
            });

            $("#cambiar_categoria").on("click", function () {
                $("#i_modal_categoria_cerrar").html('<button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger w-24">Cancelar</button>');
                const el = document.querySelector("#modal_asignar_categoria");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show(); 
            });

            $("#i_modal_categoria_cerrar").on("click", function () {
                const el = document.querySelector("#modal_asignar_categoria");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide(); 
            });

            $("#btn_asignar_categoria").on("click", function () {
                accion = 2;
                categoriaId = $("#modal_select_asignar_categoria").val();
                aplicarCategoriaGeneral = $("#checkbox_categoria_general").prop('checked');
                //alert(aplicarCategoriaGeneral)
                if(!accion_guardar){
                    guardarCalculo();
                }
            });

            $("#btn_ejecutar_calculo").on("click", function () {
                accion = 4;
                objeto.array = array;
                calculos = JSON.stringify(objeto.array);
                console.log(calculos);
                if(!accion_guardar){
                    guardarCalculo();
                }
            });

            function guardarCalculo() {
                accion_guardar = true;
                $.ajax({
                    type: "POST",
                    url: url_guardarCalculo,
                    data: {
                        'accion': accion,
                        'id': id,
                        'zonaId' : zonaId,
                        'aplicarCategoriaGeneral' : aplicarCategoriaGeneral,
                        'categoriaId' : categoriaId,
                        'solicitudId' : solicitudId,
                        'numeroEmpleado' : numeroEmpleado,
                        'calculos' : calculos
                    },
                    success: function(data) {
                        if (data.msgError) {
                            titleMsg = "Error al Guardar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                        } else {
                            titleMsg = "Datos Guardados";
                            textMsg = data.msgSuccess;
                            typeMsg = "success";
                            location.reload();
                        }
                        notificacion(); 
                        accion_guardar = false;
                        const el = document.querySelector("#modal_agregar_nueva_zona");
                        const modal = tailwind.Modal.getOrCreateInstance(el);
                        modal.hide();
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