@extends('layouts.app')

@section('title', 'Vehiculos - EPC')

@section('link')
    <link rel="stylesheet" href="{{ asset('styles/estilosModulos.css') }}">
@endsection

<body>

    @include('partials.nav-modulos')

    {{-- Scripts --}}
    <script src="{{ asset('js/modulos.js') }}"></script>
</body>
</html>
