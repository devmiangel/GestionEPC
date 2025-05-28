@extends('layouts.modulos')

@section('title', 'Eliminar Vehículos')

@section('content')
<div class="container">
    <h1>Eliminar Vehículos</h1>
    
    <div class="vehicle-grid">
        @foreach($vehiculos as $vehiculo)
            @if($vehiculo->detalleVehiculo->first())
                <div class="vehicle-card" id="vehiculo-{{ $vehiculo->id }}">
                    @if($vehiculo->detalleVehiculo->first()->imagen_vehiculo)
                        <img src="data:image/jpeg;base64,{{ base64_encode($vehiculo->detalleVehiculo->first()->imagen_vehiculo) }}" alt="Imagen del vehículo">
                    @else
                        <img src="{{ asset('img/car.webp') }}" alt="Imagen por defecto">
                    @endif
                    <div class="vehicle-plate">{{ $vehiculo->detalleVehiculo->first()->placa }}</div>
                    <div class="vehicle-info">
                        <p><strong>Marca:</strong> {{ $vehiculo->marca_vehiculo }}</p>
                        <p><strong>Modelo:</strong> {{ $vehiculo->modelo_vehiculo }}</p>
                        <p><strong>Estado:</strong> {{ $vehiculo->detalleVehiculo->first()->estado->estado ?? 'No registrado' }}</p>
                    </div>
                    <button onclick="eliminarVehiculo({{ $vehiculo->id }})" class="btn-delete">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            @endif
        @endforeach
    </div>
</div>

<style>
.vehicle-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

.vehicle-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 15px;
    transition: transform 0.2s;
}

.vehicle-card:hover {
    transform: translateY(-5px);
}

.vehicle-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 4px;
}

.vehicle-plate {
    font-size: 1.2em;
    font-weight: bold;
    margin: 10px 0;
    color: #136ea7;
}

.vehicle-info {
    margin: 10px 0;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.btn-delete:hover {
    background-color: #c82333;
}
</style>

<script>
function eliminarVehiculo(id) {
    if (confirm('¿Está seguro de que desea eliminar este vehículo?')) {
        fetch(`/vehiculos/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Eliminar la tarjeta del vehículo del DOM
                document.getElementById(`vehiculo-${id}`).remove();
                alert('Vehículo eliminado correctamente');
            } else {
                alert('Error al eliminar el vehículo');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar el vehículo');
        });
    }
}
</script>
@endsection