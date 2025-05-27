<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/estilosVehiculos.css') }}">
    <title>Módulo - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- O tu método de assets --}}
</head>
<body>
    {{-- Navbar superior --}}
    @include('partials.nav-superior')

    <div class="d-flex">
        {{-- Sidebar lateral --}}
        @include('partials.nav-modulos')

        {{-- Contenido principal --}}
        <div class="main-content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
