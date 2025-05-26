{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard - EPC') {{-- Título de la página --}}

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login EPC</title>
    <link rel="stylesheet" href="{{ asset('styles/Estiloslogin.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<div class="dashboard-page">
    <header class="dashboard-header">
        <div class="logo-container">
            {{-- <img src="{{ asset('img/logo_epc.webp') }}" alt="Logo EPC" class="logo" /> --}}
            <span class="user-name">Bienvenido, {{ Auth::user()->persona->primer_nombre }} {{ Auth::user()->persona->primer_apellido }}</span>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-secondary">Cerrar Sesión</a>
    </header>

    @auth
        @if (auth()->user()->tieneRol('Administrador'))
            <p>Bienvenido, Admin</p>
        @endif
    @endauth


    <div class="dashboard-buttons">
        <a href="#" class="dashboard-button">Vehículos</a>
        <a href="#" class="dashboard-button">Herramientas</a>
        <a href="#" class="dashboard-button">Conductores</a>
    </div>
</div>
@endsection