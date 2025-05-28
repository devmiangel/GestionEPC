@extends('layouts.modulos')

@section('content')

    <div class="vehicle-grid">
        <div class="vehicle-card">
            @yield('content')
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
    <script src="{{ asset('js/modulos.js') }}"></script>
    <script src="{{ asset('js/vehiculos.js') }}"></script>
@endsection