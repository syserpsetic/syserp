@extends('../layouts/' . $layout)

@section('subhead')
    <title>Mi Perfil</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex items-center">
    <h2 class="mr-auto text-lg font-medium">Mi Perfil</h2>
</div>
<x-base.tab.group>
    <!-- BEGIN: Profile Info -->
    <div class="intro-y box mt-5 px-5 pt-5">
        <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
            <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                    <img class="rounded-full" src="{{ Vite::asset($fakers[0]['photos'][0]) }}" onerror="this.src='{{ Vite::asset('resources/images/fakers/user2.png') }}'" alt="Midone Tailwind HTML Admin Template" />
                    <x-base.button class="absolute bottom-0 right-0 mb-1 mr-1 flex items-center justify-center rounded-full bg-primary p-2">
                        <x-base.lucide class="h-4 w-4 text-white" icon="Camera" />
                    </x-base.button>
                </div>
                <div class="ml-5">
                    <div class="w-240 truncate text-lg font-medium sm:w-400 sm:whitespace-normal">
                        {{ $perfil->name}}
                    </div>
                    <!-- <div class="text-slate-500">{{ $perfil->username}}</div> -->
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <x-base.lucide class="mr-2 h-4 w-4" icon="User" />
                        {{ $perfil->username}}
                    </div>
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <x-base.lucide class="mr-2 h-4 w-4" icon="Mail" />
                        {{ $perfil->email}}
                    </div>
                    <br />
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <x-base.button
                            data-tw-toggle="modal"
                            data-tw-target="#modal_cambio_clave"
                            as="a"
                            variant="primary"
                            class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-primary border-primary text-white dark:border-primary mb-2 mr-1 w-24 mb-2 mr-1 w-50"
                        >
                            Cambiar Contraseña
                        </x-base.button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base.tab.group>
<x-base.preview-component class="intro-y box">
    <x-base.dialog id="modal_cambio_clave">
        <x-base.dialog.panel>
            <x-base.dialog.title>
                <h2 class="mr-auto text-base font-medium">
                    Cambiar Contraseña
                </h2>
            </x-base.dialog.title>
            <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12">
                    <x-base.form-label for="input-clave_actual">Contraseña Actual</x-base.form-label>
                    <x-base.form-input id="input-clave_actual" type="password" placeholder="Escribe tu contraseña actual" />
                    <div class="login__input-error mt-2 text-danger" id="error-clave_actual"></div>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <x-base.form-label for="input-clave_nueva">Nueva Contraseña</x-base.form-label>
                    <x-base.form-input id="input-clave_nueva" type="password" placeholder="Escribe tu nueva contraseña" />
                    <div class="login__input-error mt-2 text-danger" id="error-clave_nueva"></div>
                </div>

                <div class="col-span-12 sm:col-span-12">
                    <x-base.form-label for="input-verificar_clave">
                        Verificar Contraseña
                    </x-base.form-label>
                    <x-base.form-input id="input-verificar_clave" type="password" placeholder="Vuelve a escribir tu nueva contraseña" />
                    <div class="login__input-error mt-2 text-danger" id="error-verificar_clave"></div>
                </div>
            </x-base.dialog.description>
            <x-base.dialog.footer>
                <x-base.button id="btn_cerrar_modal" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                    Cancelar
                </x-base.button>
                <x-base.button id="btn_cambiar_clave" class="w-20" type="button" variant="primary">
                    Cambiar
                </x-base.button>
            </x-base.dialog.footer>
        </x-base.dialog.panel>
    </x-base.dialog>
</x-base.preview-component>

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
    @push('scripts')
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/js/pages/modal/index.js')
        @vite('resources/js/vendor/toastify/index.js')
        @vite('resources/js/pages/notification/index.js')
        <script type="module">
            var clave_actual = null;
            var clave_nueva = null;
            var verificar_clave = null;
            var url_guardar_cambio_clave = "{{url('mi-perfil-cambiar-clave')}}"; 

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });	  

            });

            $("#btn_cambiar_clave").click(function(){
                clave_actual = $("#input-clave_actual").val(); 
                clave_nueva = $("#input-clave_nueva").val(); 
                verificar_clave = $("#input-verificar_clave").val(); 
                $("#error-clave_actual").html('');
                $("#error-clave_nueva").html('');
                $("#error-verificar_clave").html('');
                if(clave_actual== null || clave_actual == ''){
                    $("#error-clave_actual").html('Debe especificar un valor para Contraseña Actual.');
                    return false;
                }

                if(clave_nueva== null || clave_nueva == ''){
                    $("#error-clave_nueva").html('Debe especificar un valor para Nueva Contraseña.');
                    return false;
                }

                if(verificar_clave== null || verificar_clave == ''){
                    $("#error-verificar_clave").html('Debe especificar un valor para Verificar Contraseña.');
                    return false;
                }

                if(clave_nueva != verificar_clave){
                    $("#error-verificar_clave").html('La nueva contraseña no coincide.');
                    return false;
                }
                
                preguardar_cambio_clave();
            });

            function preguardar_cambio_clave() {
              var indexUploadCoincidence=0;
                    $.when().done(function (){
                  guardar_cambio_clave();
                } )
                ;
              }

              function guardar_cambio_clave(){ 
                $.ajax({
                    type: "post",
                    url: url_guardar_cambio_clave,
                    data: {
                        clave_actual: clave_actual,
                        clave_nueva: clave_nueva,
                        verificar_clave: verificar_clave,
                    },
                    success: function (data) {
                        var typeMsg = null;
                        if (data.msgError != null) {
                            $('#danger-notification').html(
                                '<div class="font-medium">Error al Guardar</div>'+
                                '<div class="mt-1 text-slate-500">'+data.msgError+'</div>'
                                );
                            typeMsg = "#danger-notification-content";
                            
                        } else {
                            $('#success-notification').html(
                                '<div class="font-medium">Datos Guardados</div>'+
                                '<div class="mt-1 text-slate-500">'+data.msgSuccess+'</div>'
                                );
                            typeMsg = "#success-notification-content";
                            $('#btn_cerrar_modal').trigger("click");
                            $("#input-clave_actual").val(null);
                            $("#input-clave_nueva").val(null);
                            $("#input-verificar_clave").val(null);
                        }
                      
                            Toastify({
                                node: $(typeMsg).clone().removeClass("hidden")[0],
                                duration: 5000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    },
                });
              }

        </script>
    @endpush
@endonce