@extends('layouts.app')

@section('title', 'Dashboard - EPC')

@section('content')
<div class="dashboard-page">
    <h1 style="text-align: center; margin-top: 50px; font-size: 50px;"><strong>Sistema de Gestión EPC</strong></h1>
    <p style="text-align: center; color: #666; margin-bottom: 50px;">Selecciona una categoría para continuar</p>

    <div style="text-align: center; margin-bottom: 50px; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; padding: 0 40px;">
        <a href="{{ route('vehiculos.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #136ea7; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-car" style="margin-right: 8px;"></i>
            Vehículos
        </a>

        <a href="{{ route('herramientas.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #6c757d; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-wrench" style="margin-right: 8px;"></i>
            Herramientas
        </a>

        <a href="{{ route('conductores.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #28a745; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-id-card" style="margin-right: 8px;"></i>
            Conductores
        </a>

        @auth
            @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
                <a href="{{ route('historial.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #ff7f50; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
                    <i class="fas fa-history" style="margin-right: 8px;"></i>
                    Historial
                </a>
            @endif
        @endauth
    </div>

    {{-- Estadísticas del dashboard eliminadas --}}
</div>

<style>
    .dashboard-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3) !important;
    }
</style>
@endsection

{{-- Scripts de estadísticas eliminados --}}
