@extends('../layouts/' . $layout)

@section('head')
    <title>Error 403</title>
@endsection

@section('content')
    <div class="py-2">
        <x-dark-mode-switcher />
        <x-main-color-switcher />
        <div class="container">
            <!-- BEGIN: Error Page -->
            <div class="error-page flex h-screen flex-col items-center justify-center text-center lg:flex-row lg:text-left">
                <div class="-intro-x lg:mr-20">
                    <img
                        class="h-48 w-[450px] lg:h-auto"
                        src="{{ Vite::asset('resources/images/error-permiso-denegado.png') }}"
                        alt="Midone Tailwind HTML Admin Template"
                    />
                </div>
                <div class="mt-10 text-white lg:mt-0">
                    <div class="intro-x text-8xl font-medium">403</div>
                    <div class="intro-x mt-5 text-xl font-medium lg:text-3xl">
                        ¡Acceso Denegado!
                    </div>
                    <div class="intro-x mt-3 text-lg">
                        Necesita un permiso adecudado para ingresar a esta pantalla.
                    </div>
                    <x-base.button
                        class="intro-x mt-10 border-white px-4 py-3 text-white dark:border-darkmode-400 dark:text-slate-200"
                        id="btn_regresar"
                        variant="dark"
                    >
                    <x-base.loading-icon
                                class="ml-2 h-6 w-6"
                                icon="puff"
                                color="white"
                            />
                            &nbsp;&nbsp;&nbsp;
                                Regresar a la página de incio
                            &nbsp;&nbsp;
                    <x-base.loading-icon
                                class="ml-2 h-6 w-6"
                                icon="puff"
                                color="white"
                            />
                    </x-base.button>
                </div>
            </div>
            <!-- END: Error Page -->
        </div>
    </div>
@endsection
@once
    @push('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script type="module">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                    
                });	  
                $("#btn_regresar").on("click", function () {
                        window.location.href = ("{{url('/')}}");
                    });
            });
        </script>   
    @endpush
@endonce