@extends('layouts.modulos')

@section('title', 'Otros Vehículos')

@section('content')
<div class="container">
    <h1>Otros Vehículos</h1>
    
    <div class="vehicle-grid">
        @foreach($otros as $otro)
            <div class="vehicle-card">
                @if($otro['imagen_vehiculo'])
                    <img src="data:image/jpeg;base64,{{ $otro['imagen_vehiculo'] }}" alt="Imagen del vehículo">
                @else
                    <img src="{{ asset('img/otros.webp') }}" alt="Imagen por defecto">
                @endif
                <div class="vehicle-plate">{{ $otro['placa'] }}</div>
                <div class="vehicle-info">
                    <p><strong>Marca:</strong> {{ $otro['marca_vehiculo'] }}</p>
                    <p><strong>Modelo:</strong> {{ $otro['modelo_vehiculo'] }}</p>
                    <p><strong>Estado:</strong> {{ $otro['estado'] }}</p>
                </div>
                <button 
                    class="btn-details" 
                    data-vehiculo='{"placa":"{{ $otro['placa'] }}","marca_vehiculo":"{{ $otro['marca_vehiculo'] }}","modelo_vehiculo":"{{ $otro['modelo_vehiculo'] }}","estado":"{{ $otro['estado'] }}","imagen_vehiculo":"{{ $otro['imagen_vehiculo'] }}"}'
                >
                    <i class="fas fa-info-circle"></i> Ver Detalles
                </button>
            </div>
        @endforeach
    </div>

    <!-- Modal para detalles del vehículo -->
    <div id="modalVehiculo" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <img id="modalImagen" src="" alt="Imagen del vehículo">
            <div id="modalDetalles"></div>
        </div>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    max-width: 800px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
}

.close {
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.detalles-vehiculo {
    margin-top: 20px;
}

.detalle-item {
    margin: 10px 0;
    padding: 5px 0;
    border-bottom: 1px solid #eee;
}

.btn-details {
    background-color: #136ea7;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.btn-details:hover {
    background-color: #0d4f7c;
}

#modalImagen {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 20px;
}

.vehicle-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 4px;
}
</style>

<script src="{{ asset('js/vehiculos.js') }}"></script>
@endsection
