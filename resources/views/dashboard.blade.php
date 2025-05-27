@extends('layouts.app')

@section('title', 'Dashboard - EPC')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard EPC</title>
    
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<div class="dashboard-page">
    <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Bienvenido</strong></h1><br><br>
    <div class="dashboard-buttons">
        <div>
            <a href="{{ route('vehiculos.index') }}" class="dashboard-button">
                Vehículos
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
            @auth
                    @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">
                        Modificar
                    </a>
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
        </div>

        <div>
            <a href="#" class="dashboard-button">
                Herramientas
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
            @auth
                    @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">
                        Modificar
                    </a>
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
        </div>

        <div>
            <a href="#" class="dashboard-button">
                Conductores
            </a>
            @auth
                @if (auth()->user()->tieneRol('Coordinador'))
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
            @auth
                    @if (auth()->user()->tieneRol('Administrador'))
                    <a href="#" class="dashboard-buttondos">
                        Modificar
                    </a>
                    <a href="#" class="dashboard-buttondos">
                        
                        Asignar
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>
<br>
@endsection