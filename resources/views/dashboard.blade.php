@extends('layouts.app')

@section('title', 'Dashboard - EPC')

@section('content')
<div class="dashboard-page">
    <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Bienvenido</strong></h1><br><br>

    <div class="dashboard-buttons">
        <div>
            <a href="{{ route('vehiculos.index') }}" class="dashboard-button">
                Vehículos
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
                @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">Modificar</a>
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
            @endauth
        </div>

        <div>
            <a href="#" class="dashboard-button">
                Herramientas
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
                @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">Modificar</a>
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
            @endauth
        </div>

        <div>
            <a href="#" class="dashboard-button">
                Conductores
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
                @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">Modificar</a>
                    <a href="#" class="dashboard-buttondos">Asignar</a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush

@push('scripts')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endpush
