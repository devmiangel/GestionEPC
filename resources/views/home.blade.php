@extends('layouts.app')

@section('title', 'Home - EPC')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Gestión EPC</strong></h1>
    <p style="text-align: center; color: #666; margin-bottom: 40px; font-size: 18px;">Selecciona una opción para continuar</p>

    <div class="dashboard-buttons" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 20px;">
        <div style="text-align: center;">
            <a href="{{ route('vehiculos.camionetas') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                🚚 Camionetas
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar camionetas</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('vehiculos.compactadores') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                🏗️ Compactadores
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar compactadores</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('vehiculos.motos') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                🏍️ Motos
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar motos</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('vehiculos.otros') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                🚗 Otros
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar otros vehículos</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('herramientas.index') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #f5af19 0%, #f12711 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                🔧 Herramientas
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar herramientas</p>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('conductores.index') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                👥 Conductores
            </a>
            <p style="color: #666; margin-top: 10px;">Gestionar conductores</p>
        </div>

        @auth
            @if (auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
            <div style="text-align: center;">
                <a href="{{ route('historial.index') }}" class="dashboard-button" style="display: inline-block; width: 100%; padding: 40px 20px; background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%); color: white; text-decoration: none; border-radius: 10px; font-size: 18px; font-weight: bold; transition: transform 0.3s ease;">
                    📋 Historial
                </a>
                <p style="color: #666; margin-top: 10px;">Ver historial de movimientos</p>
            </div>
            @endif
        @endauth
    </div>
</div>

<style>
    .dashboard-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
</style>
@endsection
