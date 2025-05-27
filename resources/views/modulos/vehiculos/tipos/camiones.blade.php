@extends('layouts.vehiculos')

@section('content')
<div class="vehicle-grid">

    @foreach ($camiones as $camiones)
        @foreach ($camiones->detalleVehiculo as $detalle)
            <div class="vehicle-card">
                
                <img src="{{ asset('img/moto2.webp') }}" alt="Vehículo {{ $detalle->placa }}">
                
                <div class="vehicle-plate">{{ $detalle->placa }}</div>

                <div class="tarjeta" onclick="expandirTarjetaModal(this)">
                    <div class="resumen">DETALLES</div>
                    <div class="detalle">
                        <div class="vehicle-plate">{{ $detalle->placa }}</div>
                        <p><strong>Modelo:</strong> {{ $camiones->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ $camiones->marca_vehiculo }}</p>
                        <p><strong>Año:</strong> {{ $detalle->año ?? 'No registrado' }}</p>
                        <p><strong>Capacidad:</strong> {{ $detalle->capacidad ?? '2' }} pasajeros</p>
                        <p><strong>Conductor:</strong> {{ $detalle->conductor ?? 'No asignado' }}</p>
                        <p><strong>Último mantenimiento:</strong> {{ $detalle->ultimo_mantenimiento ?? 'No registrado' }}</p>
                        <p><strong>Soat:</strong> {{ $detalle->soat_estado ?? 'No registrado' }}</p>
                        <p><strong>Tecnomecánica:</strong> {{ $detalle->tecno_estado ?? 'No registrada' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

</div>
@endsection
