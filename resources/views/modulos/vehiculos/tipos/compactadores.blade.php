@extends('layouts.vehiculos')

@section('content')
<div class="vehicle-grid">

    @foreach ($compactadores as $compactadores)
        @foreach ($compactadores->detalleVehiculo as $detalle)
            <div class="vehicle-card">

                @if ($detalle->imagen_vehiculo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="Vehículo {{ $detalle->placa }}">
                @else
                    <img src="{{ asset('img/camion.webp') }}" alt="Vehículo {{ $detalle->placa }}">
                @endif
                
                <div class="vehicle-plate">{{ $detalle->placa }}</div>

                <div class="tarjeta" onclick="expandirTarjetaModal(this)">
                    <div class="resumen">DETALLES</div>
                    <div class="detalle">
                        <div class="vehicle-plate">{{ $detalle->placa }}</div>
                        <p><strong>Modelo:</strong> {{ $compactadores->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ $compactadores->marca_vehiculo }}</p>
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
