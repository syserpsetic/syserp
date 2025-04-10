@extends('../layouts/' . $layout)

@section('subhead')
    <title>Viáticos</title>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Info -->
        <div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                <lord-icon
                            src="https://cdn.lordicon.com/kzagefqq.json"
                            trigger="in"
                            delay="1000"
                            state="in-reveal"
                            colors="primary:#3a3347,secondary:#ffffff,tertiary:#0a5c15,quaternary:#ffffff,quinary:#f24c00,senary:#646e78"
                            style="width:180px;height:180px">
                        </lord-icon>
                    
                    <div class="ml-5">
                        <div class="w-580 truncate text-lg font-medium sm:w-100 sm:whitespace-normal">
                            <h1 class="text-5xl font-medium leading-none">ORDENES DE VIAJE</h1>
                        </div>
                        <div class="text-slate-500">Pantalla de registro y edición de ordenes de viaje.</div>
                    </div>

                    <!-- Este div será movido a la derecha -->
                    <div class="ml-auto"> <!-- Cambia ml-5 por ml-auto para empujar el contenido hacia la derecha -->
                        <div class="w-full sm:w-100 text-right truncate text-lg font-medium">
                            @if($detalle_viatico['estado'] != null)
                                <x-base.form-switch class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto">
                                    <x-base.preview>
                                        <div class="text-2xl text-primary font-sm leading-none">
                                            <strong>{{$detalle_viatico['estado']}}</strong>
                                        </div>
                                        @if($cambiar_estado == 1)
                                        <div class="flex flex-wrap justify-center mt-4">
                                            <x-base.button
                                                class="mb-2 mr-2 w-32"
                                                variant="danger"
                                                size="sm"
                                                id="btn_rechazar"
                                            >
                                                <x-base.lucide
                                                    class="mr-2 h-4 w-4"
                                                    icon="ArrowLeft"
                                                /> Rechazar
                                            </x-base.button>
                                            <x-base.button
                                                class="mb-2 mr-2 w-32"
                                                variant="primary"
                                                size="sm"
                                                id="btn_enviar"
                                            > 
                                                &nbsp;&nbsp;Enviar &nbsp;
                                                <x-base.lucide
                                                    class="mr-2 h-4 w-4"
                                                    icon="ArrowRight"
                                                />
                                            </x-base.button>
                                        </div>
                                        @endif
                                    </x-base.preview>
                                </x-base.form-switch>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Profile Info -->
<div class="intro-y mt-8 flex items-center">
    <x-base.preview-component class="intro-y box mt-5">
        <!-- BEGIN: Multiple Select -->
        <div class="p-5">
            <x-base.form-label class="font-extrabold" for="crud-form-2">Empleados</x-base.form-label>
            <x-base.tom-select id="input_empleados" class="w-full" data-placeholder="Selección de empleados" multiple>
                @foreach($empleados as $row)
                @if ($row['numero_empleado'] == 0) 
                            @continue
                @endif
                <option value="{{$row['numero_empleado']}}" {{$row['selected']}}>{{$row['empleado']}} ({{$row['numero_empleado']}})</option>
                @endforeach
            </x-base.tom-select>
        </div>
        <!-- END: Multiple Select -->

        <!-- BEGIN: Basic Select -->
        <!-- <div class="p-5">
            <label>Departamentos</label>
            <div class="mt-2">
                <x-base.tom-select id="input_departamentos" class="w-full" data-placeholder="Selección de departamentos">
                    @foreach($departamentos as $row)
                    <option value="{{$row['id_departamento']}}">{{$row['descripcion']}}</option>
                    @endforeach
                </x-base.tom-select>
            </div>
        </div> -->
        <!-- Inicia sección de dos columnas -->
        <div class="mt-5 grid grid-cols-12 gap-6">
            <!-- <div class="intro-y col-span-12 lg:col-span-4">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Asignación por día</x-base.form-label>
                    <x-base.input-group class="mt-2" inputGroup>
                        <x-base.form-input id="input_asignacion" type="number" aria-label="Price" aria-describedby="input-group-price" placeholder="Ingrese la cantidad" />
                        <x-base.input-group.text id="input-group-price" class="z-30 -mr-1 flex w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-600 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                            Lps
                        </x-base.input-group.text>
                    </x-base.input-group>
                </div>
            </div> -->
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Fecha y hora de salida</x-base.form-label>
                    <x-base.input-group class="mt-2" inputGroup>
                        <x-base.form-input id="input_fecha_salida" type="date" aria-label="Price" aria-describedby="input-group-price"/>
                        <x-base.form-input id="input_hora_salida" type="time" aria-label="Price" aria-describedby="input-group-price"/>
                        <x-base.input-group.text id="input-group-price" class="z-30 -mr-1 flex w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-600 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                        <x-base.lucide
                            icon="Calendar"
                            />
                        </x-base.input-group.text>
                    </x-base.input-group>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
            <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Fecha y hora de regreso</x-base.form-label>
                    <x-base.input-group class="mt-2" inputGroup>
                        <x-base.form-input id="input_fecha_regreso" type="date" aria-label="Price" aria-describedby="input-group-price"/>
                        <x-base.form-input id="input_hora_regreso" type="time" aria-label="Price" aria-describedby="input-group-price"/>
                        <x-base.input-group.text id="input-group-price" class="z-30 -mr-1 flex w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-600 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                        <x-base.lucide
                            icon="Calendar"
                            />
                        </x-base.input-group.text>
                    </x-base.input-group>
                </div>
            </div>
        </div>
        <!-- Finaliza sección de dos columnas -->
        <!-- Inicia sección de dos columnas -->
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Vehículo placa No.</x-base.form-label>
                    <x-base.input-group class="mt-2" inputGroup>
                        <x-base.form-input id="input_vehiculo_placa" type="text" aria-label="Price" aria-describedby="input-group-price" placeholder="Ingrese la placa" />
                        <x-base.input-group.text id="input-group-price" class="z-30 -mr-1 flex w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-600 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                        <x-base.lucide
                            icon="Hash"
                            />
                        </x-base.input-group.text>
                    </x-base.input-group>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Tipo de Vehículo</x-base.form-label>
                    <x-base.input-group class="mt-2" inputGroup>
                        <x-base.form-input id="input_vehiculo_tipo" type="text" aria-label="Price" aria-describedby="input-group-price" placeholder="Ingrese el tipo de vehículo" />
                        <x-base.input-group.text id="input-group-price" class="z-30 -mr-1 flex w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-600 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                        <x-base.lucide
                            icon="Truck"
                            />
                        </x-base.input-group.text>
                    </x-base.input-group>
                </div>
            </div>
        </div>
        <!-- Finaliza sección de dos columnas -->
        <!-- Inicia sección de dos columnas -->
  
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="regular-form-4">Conductor</x-base.form-label>
                    <x-base.tom-select id="input_numero_empleado_conductor" class="w-full" data-placeholder="Selección de empleados">
                        @foreach($empleado_conductor as $row)
                        <option value="{{$row['numero_empleado']}}" {{$row['selected']}}>{{$row['empleado']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
        
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="p-5">
                <div class="input-form mt-3">
                        <div>
                        <x-base.form-label class="font-extrabold" for="crud-form-2">Itinerario de viaje</x-base.form-label>
                            <x-base.form-input
                                id="autocomplete-input"
                                type="text"
                                list="itinerario_opciones"
                                placeholder="Seleccione los destinos"
                                multiple
                            />
                        </div>
                        
                        <datalist id="itinerario_opciones">
                        @foreach($ciudades as $row)
                            <option value="{{$row['id_ciudad']}}">{{$row['ciudad']}}</option>
                        @endforeach
                        </datalist>
                        
                     
                        </div>
            <x-base.preview-component class="intro-y box mt-5">
                <div
                    class="flex flex-col items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400 sm:flex-row">
                    
                    <h3 class="mr-auto text-base font-small">
                    <lord-icon
                        src="https://cdn.lordicon.com/iikoxwld.json"
                        trigger="loop"
                        delay="1500"
                        state="in-roll-calm"
                        style="width:40px;height:40px">
                    </lord-icon>
                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">
                            Si desea eliminar un destino haga click sobre el.
                        </span><br>
                        <div id="contenedorSelecciones"></div>
                    </h3>
                    
                </div>
                
                            
                       
            </x-base.preview-component>

                </div>
            </div>
        </div>
        <!-- END: Multiple Select -->
        <div class="mt-5 grid grid-cols-12 gap-6">
            <!-- Sección de Propósito del Viaje -->
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row font-extrabold" htmlFor="input_proposito_viajeros">
                        Propósito del viaje (viajeros)
                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">Espacio para redactar con libertad</span>
                    </x-base.form-label>
                    <x-base.form-textarea rows="5" class="form-control" id="input_proposito_viajeros" placeholder="Describa el propósito del viaje para los viajeros"></x-base.form-textarea>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="flex w-full flex-col sm:flex-row font-extrabold" htmlFor="input_proposito_conductor">
                        Propósito del viaje (conductor)
                        <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0">Espacio para redactar con libertad</span>
                    </x-base.form-label>
                    <x-base.form-textarea rows="5" class="form-control" id="input_proposito_conductor" placeholder="Describa el propósito del viaje para el conductor"></x-base.form-textarea>
                </div>
            </div>
        </div>

        <!-- Sección de Selección -->
        <div class="mt-5 grid grid-cols-12 gap-6">
            <div class="intro-y col-span-12 lg:col-span-2">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_fuente">Fuente</x-base.form-label>
                    <x-base.tom-select id="input_fuente" class="w-full">
                        @foreach($fuentes as $row)
                            <option value="{{$row['id']}}" {{$row['selected']}}>{{$row['fuente']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-2">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_ga">GA</x-base.form-label>
                    <x-base.tom-select id="input_ga" class="w-full" disabled>
                        @foreach($gerencia_administrativa as $row)
                            <option value="{{$row['id']}}" {{$row['seleccion']}}>{{$row['gerencia']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-2">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_programa">Programa</x-base.form-label>
                    <x-base.tom-select id="input_programa" class="w-full">
                        @foreach($programas as $row)
                            <option value="{{$row['id']}}" {{$row['selected']}}>{{$row['programa']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-2">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_ue">UE</x-base.form-label>
                    <x-base.tom-select id="input_ue" class="w-full">
                        @foreach($ue as $row)
                            <option value="{{$row['id']}}" {{$row['selected']}}>{{$row['ue']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-4">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_actividad">Actividad</x-base.form-label>
                    <x-base.form-select id="input_actividad" 
                        class="sm:mt-2 sm:mr-2"
                        aria-label=".form-select-lg example"
                        class="w-full" 
                        data-placeholder="Seleccione una Actividad">
                        
                    </x-base.form-select>
                </div>
            </div>
 
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_articulos">Artículos aplicados</x-base.form-label>
                    <x-base.tom-select id="input_articulos" class="w-full" data-placeholder="Selección de artículos" multiple>
                        @foreach($articulos as $row)
                            <option value="{{$row['id']}}" {{$row['selected']}}>{{$row['nombre']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="p-5">
                    <x-base.form-label class="font-extrabold" for="input_firma_jefatura">Firma de jefatura</x-base.form-label>
                    <x-base.tom-select id="input_firma_jefatura" class="w-full" data-placeholder="Selección de firma de jefatura">
                        @foreach($firmas_jefaturas as $row)
                            <option value="{{$row['id']}}" {{$row['selected']}}>{{$row['nombre']}}</option>
                        @endforeach
                    </x-base.tom-select>
                </div>
            </div>
        </div>



        <div class="p-5">
            <div class="mt-3">
                <label>Notificar</label>
                <div class="mt-2">
                    <x-base.form-switch>
                         <x-base.form-switch.input id="checkbox_enviar_correo" type="checkbox"/>
                        <x-base.form-switch.label for="checkbox_enviar_correo">
                            Enviar correo de notificación a los viajeros
                        </x-base.form-switch.label>
                    </x-base.form-switch>
                </div>
            </div>
        </div>

        <div class="p-5">
            <x-base.button id="btn_guardar" class="w-40" type="button" variant="primary">
            
            <x-base.loading-icon
                id="icon_guardando"
                class="w-0 h-0"
                icon="oval"
                color="white"
            />&nbsp;
            <x-base.lucide icon="Save" />
            </x-base.button>
        </div>
        
    </x-base.preview-component>

</div>

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

        <!-- BEGIN: Modal Content -->
        <x-base.dialog id="modal_estado">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide id="modal_icono_rechazar" class="mx-auto mt-3 h-0 w-0 text-danger" icon="ArrowLeftCircle"/>
                    <x-base.lucide id="modal_icono_enviar" class="mx-auto mt-3 h-0 w-0 text-primary" icon="ArrowRightCircle"/>
                    <div class="mt-5 text-3xl" id="modal_encabezado_texto"></div>
                    <div class="mt-2 text-slate-500">
                        ¿A dónde desea enviar esta solicitud?<br/><br/>
                        <div class="text-2xl text-primary lg:text-center font-sm leading-none">
                            Estado Actual: 
                            <strong>
                                {{$detalle_viatico['estado']}}
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
                                    <span class="mt-1 text-xs text-slate-500 sm:ml-auto sm:mt-0" id="text_observacion">
                                        
                                    </span>
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
        <!-- END: Modal Content -->

@endsection
@once
    @push('scripts')
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/js/pages/modal/index.js')
        @vite('resources/js/vendor/toastify/index.js')
        @vite('resources/js/pages/notification/index.js')
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <script type="module">
            var accion_guardar = false;   
            var accion_guardar_estado = false;            
            var accion = null;
            var id_solicitud = "{{$id_solicitud}}";
            var id = (id_solicitud.length != 0) ? "{{$id_solicitud}}" : null;
            var estado = null
            var observacion_estado = null;
            var id_solicitud_estado = "{{$detalle_viatico['id_solicitud_estado']}}";
            var numero_empleado = null;
            var vehiculo_placa = null;
            var vehiculo_tipo = null;
            var fecha_salida = null;
            var hora_salida = null;
            var fecha_retorno = null;
            var hora_retorno = null;
            var numero_empleado_conductor = null;
            var itinerario = null;
            var proposito_viajeros = null;
            var proposito_conductor = null;
            var id_institucion = 1;
            var id_fuente = null;
            var id_gerencia_administrativa = null;
            var id_programa = null;
            var id_unidad_ejecutora = null;
            var id_actividad_obra = null;
            var id_articulo = null;
            var id_firma_jefatura = null;
            var enviar_correo = null;
            var url_guardar_viaticos = "{{url('/viaticos/guardar')}}";
            var url_guardar_cambiar_estados = "{{url('/cambiar_estados')}}";
            var url_cambiar_actividades_obras = "{{url('/viaticos/cargar/actividades_obras')}}";
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;
            var datos = [];
            var objeto = {};
            var orden_pos = 0;
            var n = 0;
            var estado_enviar = null;

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	  

                
               /// $('#input_numero_empleado_conductor').addItem('1004');
                //$("#input_numero_empleado_conductor").val('1004');
                //$('#input_empleados option:contains('+1004+')').prop('selected', true);
                //Inicia Itinerario
                    const input = document.getElementById("autocomplete-input");
                    const datalist = document.getElementById("itinerario_opciones");
                    var opciones = null;

                    input.addEventListener("input", function () {
                        const inputValue = input.value.toLowerCase();
                        const options = datalist.querySelectorAll("option");
                        for (const option of options) {
                            const optionValue = option.value.toLowerCase();
                            opciones = optionValue;
                            if (optionValue === inputValue) {
                                input.value = option.textContent; // Muestra la descripción
                                //alert("Valor seleccionado: " + optionValue); // Muestra el valor
                                break;
                            }
                        }
                    });

                    id_programa = $("#input_programa").val();
                    cargar_actividades_obras();

                    //Iterar itinerario para editar
                    if(id_solicitud.length != 0){
                        @foreach($ciudades_elegidas as $row)
                            agregarSeleccion("{{$row['ciudad']}}", "{{$row['id_ciudad']}}", "{{$row['orden']}}");
                        @endforeach
                    }
                    //Finaliza Iterar itinerario para editar
                   
                    input.addEventListener("keydown", function (event) {
                        if (event.key === "Enter" && input.value.trim() !== "") {
                            orden_pos = parseInt(orden_pos) + 1;
                            agregarSeleccion(input.value, opciones, orden_pos);
                            input.value = ""; // Borra el campo de entrada
                        }
                    });

                    function agregarSeleccion(valor_input, valor_datalist, orden) {
                        itinerario = null;
                        // Crea un elemento span para mostrar la selección
                        const seleccion = document.createElement("button");
                        orden_pos = (orden == null) ? n++ : orden;
                        seleccion.value = orden_pos;
                        //alert(seleccion.textContent)
                        seleccion.textContent = "➜"+valor_input;
                        datos.push({ 
                            "id_ciudad"    : valor_datalist,
                            "pos" : seleccion.value
                        });

                        seleccion.addEventListener("click", function () {
                            seleccion.remove();
                            datos = datos.filter(function (elemento) {
                                return elemento.pos !== seleccion.value;
                            });
                            //console.log(datos)
                            objeto.datos = datos;
                        itinerario = JSON.stringify(objeto.datos);
                        });
                        
                        objeto.datos = datos;
                        itinerario = JSON.stringify(objeto.datos);
                        // Agrega la selección al contenedor
                        const contenedorSelecciones = document.getElementById("contenedorSelecciones");
                        contenedorSelecciones.appendChild(seleccion);
                        //contenedorSelecciones.appendChild(botonEliminar);
                    }
                //Finaliza Itinerario

                $("#input_programa").change(function(selectElement){
                    $("#input_actividad").val('');
                    $("#input_actividad").prop("disabled", true);
                    id_programa = $("#input_programa").val();
                    cargar_actividades_obras()
                });

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

            //Llenar los inputs para editar
            $("#input_fecha_salida").val("{{$detalle_viatico['fecha_salida']}}");
            $("#input_hora_salida").val("{{$detalle_viatico['hora_salida']}}");
            $("#input_fecha_regreso").val("{{$detalle_viatico['fecha_retorno']}}");
            $("#input_hora_regreso").val("{{$detalle_viatico['hora_retorno']}}");
            $("#input_vehiculo_placa").val("{{$detalle_viatico['vehiculo_placa']}}");
            $("#input_vehiculo_tipo").val("{{$detalle_viatico['vehiculo_tipo']}}");
            $("#input_proposito_viajeros").val("{{$detalle_viatico['proposito_viajeros']}}");
            $("#input_proposito_conductor").val("{{$detalle_viatico['proposito_conductor']}}");
            //Finaliza Llenar los inputs para editar
                        
            $("#btn_guardar").on("click", function () {
                numero_empleado = $("#input_empleados").val();
                fecha_salida = $("#input_fecha_salida").val();
                hora_salida = $("#input_hora_salida").val();
                fecha_retorno = $("#input_fecha_regreso").val();
                hora_retorno = $("#input_hora_regreso").val();
                vehiculo_placa = $("#input_vehiculo_placa").val();
                vehiculo_tipo = $("#input_vehiculo_tipo").val();
                numero_empleado_conductor = $("#input_numero_empleado_conductor").val();
                proposito_viajeros = $("#input_proposito_viajeros").val();
                proposito_conductor = $("#input_proposito_conductor").val();
                id_fuente = $("#input_fuente").val();
                id_gerencia_administrativa = $("#input_ga").val();
                id_programa = $("#input_programa").val();
                id_unidad_ejecutora = $("#input_ue").val();
                id_actividad_obra = $("#input_actividad").val();
                id_articulo = $("#input_articulos").val();
                id_firma_jefatura = $("#input_firma_jefatura").val();
                enviar_correo = $("#checkbox_enviar_correo").is(':checked') ? 1 : null;
                accion = 1;
                if(id_solicitud.length != 0){
                    accion = 2;
                }
                
                if(numero_empleado == null || numero_empleado == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Empleados.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(fecha_salida == null || fecha_salida == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Fecha de Salida.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(hora_salida == null || hora_salida == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Hora de Salida.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(fecha_retorno == null || fecha_retorno == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Fecha de Regreso.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(hora_retorno == null || hora_retorno == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Hora de Regreso.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                fecha_salida = fecha_salida+" "+hora_salida+":00.000000-00";
                fecha_retorno = fecha_retorno+" "+hora_retorno+":00.000000-00";

                // if(vehiculo_placa == null || vehiculo_placa == ''){
                //     titleMsg = 'Valor Requerido'
                //     textMsg = 'Debe especificar un valor para Vehículo placa No.';
                //     typeMsg = 'error';
                //     notificacion()
                //     return false;
                // }

                // if(vehiculo_tipo == null || vehiculo_tipo == ''){
                //     titleMsg = 'Valor Requerido'
                //     textMsg = 'Debe especificar un valor para Tipo de Vehículo.';
                //     typeMsg = 'error';
                //     notificacion()
                //     return false;
                // }

                // if(numero_empleado_conductor == null || numero_empleado_conductor == ''){
                //     titleMsg = 'Valor Requerido'
                //     textMsg = 'Debe especificar un valor para Conductor';
                //     typeMsg = 'error';
                //     notificacion()
                //     return false;
                // }

                if(proposito_viajeros == null || proposito_viajeros == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Propósito del viaje de los viajeros';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(proposito_conductor == null || proposito_conductor == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Propósito del viaje del conductor';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(itinerario == null || itinerario == '' || itinerario == [] || itinerario == '[]'){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Itinerario';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(id_firma_jefatura == null || id_firma_jefatura == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Firma de jefatura';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                // if(id_articulo == null || id_articulo == ''){
                //     titleMsg = 'Valor Requerido'
                //     textMsg = 'Debe especificar un valor para Artículos aplicados';
                //     typeMsg = 'error';
                //     notificacion()
                //     return false;
                // }
                
                //alert(id);
                if(!accion_guardar){
                    guardar_viaticos()
                }

                // console.log(itinerario)
                
                
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

            function modal_estado_accion(){
                $("#"+typeMsg+"-notification").html('<div class="font-medium">' + titleMsg + "</div>" + '<div class="mt-1 text-slate-500">' + textMsg + "</div>");
                const el = document.querySelector("#modal_estado");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            }

            function guardar_viaticos() {
                accion_guardar = true;
                $("#icon_guardando").addClass('w-8 h-8')
                $("#btn_guardar").prop("disabled", true);
                $("#btn_guardar_estado").prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: url_guardar_viaticos,
                    data: {
                        'accion': accion,
                        'id': id,
                        'numero_empleado': JSON.stringify(numero_empleado),
                        'vehiculo_placa': vehiculo_placa,
                        'vehiculo_tipo': vehiculo_tipo,
                        'fecha_salida': fecha_salida,
                        'hora_salida': hora_salida,
                        'fecha_retorno': fecha_retorno,
                        'hora_retorno': hora_retorno,
                        'numero_empleado_conductor': numero_empleado_conductor,
                        'itinerario': itinerario,
                        'proposito_viajeros': proposito_viajeros,
                        'proposito_conductor': proposito_conductor,
                        'id_institucion': id_institucion,
                        'id_fuente': id_fuente,
                        'id_gerencia_administrativa': id_gerencia_administrativa,
                        'id_programa': id_programa,
                        'id_unidad_ejecutora': id_unidad_ejecutora,
                        'id_actividad_obra': id_actividad_obra,
                        'id_articulo': JSON.stringify(id_articulo),
                        'id_firma_jefatura': id_firma_jefatura,
                        'enviar_correo': enviar_correo,
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
                            accion_guardar = false;
                            $("#btn_guardar").prop("disabled", false);
                            $("#icon_guardando").removeClass('w-8 h-8')
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

            function cargar_actividades_obras() {
                $.ajax({
                    type: "post",
                    url: url_cambiar_actividades_obras,
                    data: {
                        'id_programa': id_programa,
                        'id_solicitud': id_solicitud
                    },
                    success: function (data) {
                        var act_list = data.act_list;
                        $('#input_actividad').html('');

                        for (let i = 0; i < act_list.length; i++) {
                            $('#input_actividad').append('<option value="'+act_list[i].id+'" '+act_list[i].selected+'>'+act_list[i].act+'</option>');
                        }
                        $("#input_actividad").prop("disabled", false);
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