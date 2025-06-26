@extends('layouts.modulos')

@section('title', 'Vehiculos - EPC')

@section('content')
<head>
    <title>Eliminar</title>

    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloseliminarvehiculo.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<div class="actions-vehiculos">
            <a href="vehiculos.html" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a Vehículos
            </a>
        </div>
        
        <h1 class="title">Eliminar Vehículo</h1>
        
        <div class="delete-vehicle-container">
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar por placa...">
                </div>
                <select id="filterType">
                    <option value="all">Todos los vehículos</option>
                    <option value="camioneta">Camiones</option>
                    <option value="camioneta">Camionetas</option>
                    <option value="moto">Motos</option>
                </select>
            </div>
            
            <div class="vehicle-list" id="vehicleList">
                
            </div>
            
            <div class="delete-confirm-modal" id="deleteModal">
                <div class="modal-content">
                    <span class="close-modal" id="closeModal">&times;</span>
                    <h3>Confirmar Eliminación</h3>
                    <p id="modalMessage">¿Estás seguro que deseas eliminar este vehículo?</p>
                    <div class="modal-actions">
                        <button id="confirmDelete" class="btn-delete">Eliminar</button>
                        <button id="cancelDelete" class="btn-cancel">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
</div>
    <script src="{{ asset('js/agregarvehiculo.js') }}"></script>
@endsection