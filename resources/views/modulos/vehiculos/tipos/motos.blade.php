@extends('layouts.vehiculos')

@section('content')
<div class="vehicle-grid">

    @foreach ($motos as $moto)
        @foreach ($moto->detalleVehiculo as $detalle)
            <div class="vehicle-card">
                @if ($detalle->imagen_vehiculo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="Vehículo {{ $detalle->placa }}">
                @else
                    <img src="{{ asset('img/moto2.webp') }}" alt="Vehículo {{ $detalle->placa }}">
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
                        <div class="vehicle-plate">{{ $detalle->placa }}</div>
                        <p><strong>Modelo:</strong> {{ $moto->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ $moto->marca_vehiculo }}</p>
                        <p><strong>Año:</strong> {{ $detalle->año ?? 'No registrado' }}</p>
                        <p><strong>Capacidad:</strong> {{ $detalle->capacidad ?? '2' }} pasajeros</p>
                        <p><strong>Conductor:</strong> {{ $detalle->conductor ?? 'No asignado' }}</p>
                        <p><strong>Último mantenimiento:</strong> {{ $detalle->ultimo_mantenimiento ?? 'No registrado' }}</p>
                        <p><strong>Soat:</strong> {{ $detalle->soat_estado ?? 'No registrado' }}</p>
                        <p><strong>Tecnomecánica:</strong> {{ $detalle->tecno_estado ?? 'No registrada' }}</p>
                        @if(strtolower($detalle->estadoVehiculo->estado ?? '') === 'prestado')
                            <form method="POST" action="{{ route('vehiculos.devolver') }}" style="margin-top:1rem;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Devolver</button>
                            </form>
                        @elseif(strtolower($detalle->estadoVehiculo->estado ?? '') === 'disponible')
                            <a href="{{ route('vehiculos.asignar') }}" class="btn btn-success" style="margin-top:1rem;">Asignar</a>
                        @endif
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

<br>

<div class="action-buttons" style="text-align: right; margin: 0 2rem 1rem 0; position: static;">
    <a href="{{ route('vehiculos.create', ['tipo_vehiculos' => 'Motos']) }}" class="btn-agregar-vehiculo btn-verde" title="Agregar moto">
        <i class="fas fa-plus"></i> Agregar Moto
    </a>
</div>

@endsection
