@extends('layouts.modulos')

@section('links')
    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endsection

@section('content')
<main class="main-content">
    <div class="vehicle-grid">
        <div class="vehicle-card">
            {{-- Contenido de vehículos --}}
        </div>
    </div>

    <div class="vehicle-category">
        <div class="cuadroVehiculos">
            <div class="actions-vehiculos">
                <div class="action-buttons">
                    <a href="agregarvehiculo.html" class="btn-agregar-vehiculo">
                        <i class="fas fa-plus"></i> Añadir Vehículo
                    </a>
                    <a href="eliminarvehiculo.html" class="btn-eliminar-vehiculo">
                        <i class="fas fa-trash-alt"></i> Eliminar Vehículo
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection