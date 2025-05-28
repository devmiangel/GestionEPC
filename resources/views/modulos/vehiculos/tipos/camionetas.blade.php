@extends('layouts.vehiculos')

@section('content')
<h2 class="mb-4">Camionetas</h2>
<div class="vehicle-grid">
    @foreach ($camionetas as $camioneta)
        @php
            $detalleVehiculos = [];
            if (is_array($camioneta) && isset($camioneta['detalleVehiculo'])) {
                $detalleVehiculos = $camioneta['detalleVehiculo'];
            } elseif (is_object($camioneta) && isset($camioneta->detalleVehiculo)) {
                $detalleVehiculos = $camioneta->detalleVehiculo;
            }
        @endphp
        @foreach ($detalleVehiculos as $detalle)
            <div class="vehicle-card">
                @if ($detalle->imagen_vehiculo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="Vehículo {{ $detalle->placa }}">
                @else
                    <img src="{{ asset('img/car.webp') }}" alt="Vehículo {{ $detalle->placa }}">
                @endif
                <div class="vehicle-plate {{
                    match(strtolower($detalle->estadoVehiculo->estado ?? '')) {
                        'disponible' => 'estado-disponible',
                        'prestado' => 'estado-prestado',
                        'fuera de servicio' => 'estado-fuera-servicio',
                        'inactivo' => 'estado-inactivo',
                        default => ''
                    }
                }}">
                    {{ $detalle->placa }}
                </div>
                <div class="tarjeta" onclick="expandirTarjetaModal(this)">
                    <div class="resumen">DETALLES</div>
                    <div class="detalle">
                        <div class="vehicle-plate {{
                    match(strtolower($detalle->estadoVehiculo->estado ?? '')) {
                        'disponible' => 'estado-disponible',
                        'prestado' => 'estado-prestado',
                        'fuera de servicio' => 'estado-fuera-servicio',
                        'inactivo' => 'estado-inactivo',
                        default => ''
                    }
                }}">{{ $detalle->placa }}</div>
                        <p><strong>Modelo:</strong> {{ is_array($camioneta) ? ($camioneta['modelo_vehiculo'] ?? '') : $camioneta->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ is_array($camioneta) ? ($camioneta['marca_vehiculo'] ?? '') : $camioneta->marca_vehiculo }}</p>
                        <p><strong>Año:</strong> {{ $detalle->año ?? 'No registrado' }}</p>
                        <p><strong>Capacidad:</strong> {{ $detalle->capacidad ?? '2' }} pasajeros</p>
                        <p><strong>Conductor:</strong> {{ $detalle->conductor ?? 'No asignado' }}</p>
                        <p><strong>Soat:</strong> {{ $detalle->soat_estado ?? 'No registrado' }}</p>
                        <p><strong>Tecnomecánica:</strong> {{ $detalle->tecno_estado ?? 'No registrada' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<div id="modalVehiculo" onclick="cerrarModal()">
    <div class="contenido-modal" onclick="event.stopPropagation()">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <img id="modalImagen" src="" alt="Imagen del vehículo">
        <div id="modalDetalles"></div>
    </div>
</div>
@endsection
