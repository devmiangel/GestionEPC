<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Estilos --}}
    <link rel="stylesheet" href="{{ asset('styles/estilosModulos.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    
    <title>Módulo - @yield('title')</title>


    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- O el método de assets que uses --}}
</head>
<body>
    {{-- Navbar superior --}}
    @include('partials.nav-superior')

    <div class="d-flex">
        {{-- Sidebar lateral --}}
        <div class="sidebar position-fixed">
            @include('partials.nav-modulos')
        </div>

        {{-- Contenido principal --}}
        <div class="main-content flex-grow-1 p-4 margin-left-sidebar">
            @yield('content')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/modulos.js') }}"></script>

    {{-- Scripts adicionales desde las vistas --}}
    @stack('scripts')
</body>
</html>
