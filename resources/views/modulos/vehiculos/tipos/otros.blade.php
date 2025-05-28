@extends('layouts.vehiculos')

@section('content')
<div class="vehicle-grid">

    @foreach ($otros as $otros)
        @foreach ($otros->detalleVehiculo as $detalle)
            <div class="vehicle-card">
                
                @if ($detalle->imagen_vehiculo)
                    <img src="data:image/jpeg;base64,{{ base64_encode($detalle->imagen_vehiculo) }}" alt="Vehículo {{ $detalle->placa }}">
                @else
                    <img src="{{ asset('img/vectorepc.webp') }}" alt="Vehículo {{ $detalle->placa }}">
                @endif

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
}}">
    {{ $detalle->placa }}
</div>nombre
                        <p><strong>Modelo:</strong> {{ $detalle->nombre }}</p>
                        <p><strong>Modelo:</strong> {{ $otros->modelo_vehiculo }}</p>
                        <p><strong>Marca:</strong> {{ $otros->marca_vehiculo }}</p>
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
@endsection
