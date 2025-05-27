<div class="vehicle-card">
    <img src="{{ asset('img/truck.png') }}" alt="Vehículo" />
    <div class="vehicle-plate">{{ $placa }}</div>
    <div class="tarjeta" onclick="expandirTarjetaModal(this)">
        <div class="resumen">DETALLES</div>
        <div class="detalle">
            <div class="vehicle-plate">{{ $placa }}</div>
            <p><strong>Marca:</strong> {{ $marca }}</p>
            <p><strong>Año:</strong> {{ $año }}</p>
            <p><strong>Capacidad:</strong> {{ $capacidad }}</p>
            <p><strong>Conductor:</strong> {{ $conductor }}</p>
            <p><strong>Último mantenimiento:</strong> {{ $mantenimiento }}</p>
            <p><strong>Soat:</strong> {{ $soat }}</p>
            <p><strong>Tecnomecánica:</strong> {{ $tecnomecanica }}</p>
        </div>
    </div>
</div>
