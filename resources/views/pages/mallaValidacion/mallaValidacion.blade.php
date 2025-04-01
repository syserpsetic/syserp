@extends('../layouts/' . $layout)

@section('subhead')
    <title>Malla de Validación</title>
@endsection

@section('subcontent')
<br>
@if(in_array('malla_validacion_leer_cinta_noticias', $scopes))
    <div class="w-full bg-gradient-to-r from-blue-900 to-black text-white py-4 px-6 rounded-2xl flex items-center overflow-hidden border-4 border-blue-500 shadow-lg">
        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center">
            <img src="{{ asset('img/LOGO_SETIC.png') }}" alt="Logo" class="w-14 h-14 object-contain rounded-full">
        </div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="w-full flex overflow-hidden relative" id="news-container">
            <div class="flex space-x-10 whitespace-nowrap" id="news-list">
                @foreach ($noticias as $item)
                    <div class="flex items-center space-x-2 news-item">
                        <img src="https://portal.unag.edu.hn/matricula/documentos/fotos/{{$item['foto']}}" alt="News Icon" class="w-10 h-10 object-cover rounded-full" onerror="this.onerror=null; this.src='{{ Vite::asset('resources/images/fakers/user2.png') }}';">
                        <span class="font-medium">{{$item['name'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

<!-- <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Chat</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <x-base.button
                class="mr-2 shadow-md"
                variant="primary"
            >
                Start New Chat
            </x-base.button>
            <x-base.menu class="ml-auto sm:ml-0">
                <x-base.menu.button
                    class="!box px-2 text-slate-500"
                    as="x-base.button"
                >
                    <span class="flex h-5 w-5 items-center justify-center">
                        <x-base.lucide
                            class="h-4 w-4"
                            icon="Plus"
                        />
                    </span>
                </x-base.menu.button>
                <x-base.menu.items class="w-40">
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="Users"
                        /> Create Group
                    </x-base.menu.item>
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="Settings"
                        /> Settings
                    </x-base.menu.item>
                </x-base.menu.items>
            </x-base.menu>
        </div>
    </div> -->

    <div class="intro-y mt-5 grid grid-cols-12 gap-5">
        <!-- BEGIN: Chat Side Menu -->
        @if(in_array('malla_validacion_leer_lista_pendientes', $scopes))
        <x-base.tab.group class="col-span-12 lg:col-span-4 2xl:col-span-3">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <x-base.tab.list variant="pills">
                        <x-base.tab
                            id="chats-tab"
                            selected
                        >
                            <x-base.tab.button
                                class="w-full py-2"
                                as="button"
                                id="boton"
                            >
                                Nexus
                            </x-base.tab.button>
                        </x-base.tab>
                       <!--  <x-base.tab id="friends-tab">
                            <x-base.tab.button
                                class="w-full py-2"
                                as="button"
                            >
                                Ir  Nexus
                            </x-base.tab.button>
                        </x-base.tab>
                        <x-base.tab id="profile-tab">
                            <x-base.tab.button
                                class="w-full py-2"
                                as="button"
                            >
                                Profile
                            </x-base.tab.button>
                        </x-base.tab> -->
                    </x-base.tab.list>
                </div>
            </div>
            <x-base.tab.panels>
                <x-base.tab.panel
                    id="chats"
                    selected
                >
                    <!-- <div class="pr-1">
                        <div class="box mt-5 px-5 pt-5 pb-5 lg:pb-0">
                            <div class="relative text-slate-500">
                                <x-base.form-input
                                    class="border-transparent bg-slate-100 px-4 py-3 pr-10"
                                    type="text"
                                    placeholder="Search for messages or users..."
                                />
                                <x-base.lucide
                                    class="inset-y-0 right-0 my-auto mr-3 hidden h-4 w-4 sm:absolute"
                                    icon="Search"
                                />
                            </div>
                            <div class="scrollbar-hidden overflow-x-auto">
                                <div class="mt-5 flex">
                                    @foreach (array_slice($fakers, 0, 10) as $faker)
                                        <a
                                            class="mr-4 w-10 cursor-pointer"
                                            href=""
                                        >
                                            <div class="image-fit h-10 w-10 flex-none rounded-full">
                                                <img
                                                    class="rounded-full"
                                                    src="{{ Vite::asset($faker['photos'][0]) }}"
                                                    alt="Midone Tailwind HTML Admin Template"
                                                />
                                                <div
                                                    class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                                                </div>
                                            </div>
                                            <div class="mt-2 truncate text-center text-xs text-slate-500">
                                                {{ $faker['users'][0]['name'] }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="chat-list scrollbar-hidden mt-4 h-[725px] overflow-y-auto pt-1 pr-1">
                        @foreach ($personas as $row)
                            <div @class([
                                'intro-x cursor-pointer box relative flex items-center p-5',
                                'mt-5' => $row['id_member'] ,
                            ])>
                                <div class="image-fit mr-1 h-12 w-12 flex-none">
                                    <img
                                        class="rounded-full"
                                        src="https://portal.unag.edu.hn/matricula/documentos/fotos/{{$row['foto']}}"
                                        alt="Midone Tailwind HTML Admin Template"
                                        onerror="this.onerror=null; this.src='{{ Vite::asset('resources/images/fakers/user2.png') }}';"
                                    />
                                    <div
                                        class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a
                                            class="font-medium"
                                            href="#"
                                        >
                                            {{ $row['member'] }}
                                        </a>
                                        <div class="ml-auto text-xs text-slate-400">
                                          <!-- saa -->
                                        </div>
                                    </div>
                                    <div class="mt-0.5 w-full truncate text-slate-500">
                                        <!-- s -->
                                    </div>
                                </div>
                            
                                    <div
                                        class="absolute top-0 right-0 -mt-1 -mr-1 flex h-5 w-5 items-center justify-center rounded-full bg-primary text-xs font-medium text-white">
                                        {{ $row['tareas'] }}
                                    </div>
                            
                            </div>
                        @endforeach
                    </div>
                </x-base.tab.panel>
            </x-base.tab.panels>
        </x-base.tab.group>
        @endif
        <!-- END: Chat Side Menu -->
        <!-- BEGIN: Chat Content -->
        <div class="intro-y col-span-12 lg:col-span-8 2xl:col-span-9">
            <div class="h-auto">
                <!-- BEGIN: Chat Active -->
                <!-- END: Chat Active -->
                <!-- BEGIN: Chat Default -->
                <div class="flex h-full items-left">
                    <div class="mx-auto text-left">
                        <div class="col-span-12">
                            <div class="mt-5 grid grid-cols-12 gap-6">
                                @foreach($indicadoresMallaValidaciones as $row)
                                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-2">
                                        <div @class([
                                            'relative zoom-in',
                                            'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                        ])>
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <x-base.lucide
                                                        class="h-[28px] w-[28px] text-primary"
                                                        icon="AlertCircle"
                                                    />
                                                    <div class="ml-auto">
                                                    @if($row['estudiantes'] != 0)
                                                        <x-base.tippy
                                                            class="flex cursor-pointer items-center rounded-full bg-danger py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                                            as="div"
                                                            content="{{$row['indicador_descripcion']}}"
                                                        >
                                                        Detalle
                                                            <x-base.lucide
                                                                class="ml-0.5 h-4 w-4"
                                                                icon="X"
                                                            />
                                                        </x-base.tippy>
                                                    @else
                                                        <x-base.tippy
                                                            class="flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                                            as="div"
                                                            content="{{$row['indicador_descripcion']}}"
                                                        >
                                                        Detalle
                                                            <x-base.lucide
                                                                class="ml-0.5 h-4 w-4"
                                                                icon="Check"
                                                            />
                                                        </x-base.tippy>
                                                    @endif
                                                           
                                                    </div>
                                                </div>
                                                <div class="mt-6 text-3xl font-medium leading-8">{{$row['estudiantes']}}</div>
                                                <div class="mt-1 text-base text-slate-500">{{$row['indicador_titulo']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
                <!-- END: Chat Default -->
            </div>
        </div>
        <!-- END: Chat Content -->
    </div>


<style>
#news-container {
    display: flex;
    overflow: hidden;
    width: 100%;
}

#news-list {
    display: flex;
    white-space: nowrap;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const newsContainer = document.getElementById("news-container");
        const newsList = document.getElementById("news-list");

        let position = window.innerWidth; // Inicializa la posición fuera de la pantalla
        let speed = 3; // Velocidad de desplazamiento

        function scrollNews() {
            position -= speed; // Mueve las noticias a la izquierda
            newsList.style.transform = `translateX(${position}px)`; // Aplica el desplazamiento

            // Si todas las noticias se han desplazado fuera de la pantalla, reiniciar
            if (position < -newsList.scrollWidth) {
                position = window.innerWidth; // Reinicia la posición
            }

            requestAnimationFrame(scrollNews); // Continuar el desplazamiento
        }

        scrollNews(); // Inicia la animación de inmediato
    });
</script>


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
        
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js?key=mzutkZDE"></script>
        <script type="module">
           $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	 

                $('#boton').trigger("click");
        
                    @if(in_array('malla_validacion_reproducir_narrador', $scopes) && ($narracion['narracion'] != null || $narracion['narracion'] != ''))
                    var mensaje = "SE HAN ASIGNADO NUEVAS TAREAS A: {{$narracion['narracion']}}";
                    console.log(mensaje);
                    responsiveVoice.speak(mensaje, "Spanish Latin American Female", {
                        rate: 1.2,   // Aumenta la velocidad al 180%
                        pitch: 1,  // Un poco más agudo
                        volume: 1    // Máximo volumen
                    });
                @endif
      
                
                

                setTimeout(function () {
                    location.reload();
                }, 300000);
                    
                });
        </script>
    @endpush
@endonce