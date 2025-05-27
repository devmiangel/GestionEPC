<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles/estilosModulos.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=two_wheeler" />
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

    <script src="{{ asset('js/modulos.js') }}"></script>
</body>
</html>
