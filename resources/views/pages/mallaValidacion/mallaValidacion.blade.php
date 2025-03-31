@extends('../layouts/' . $layout)

@section('subhead')
    <title>Malla de Validación</title>
@endsection

@section('subcontent')

@endsection
@once
    @push('vendors')
        @vite('resources/js/vendor/tabulator/index.js')
        @vite('resources/js/vendor/lucide/index.js')
        @vite('resources/js/vendor/xlsx/index.js')
    @endpush
@endonce