@extends('layouts.modulos')

@section('title', 'Vehiculos - EPC')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar</title>

    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
<main>
        <div class="actions-vehiculos">
            <a href="{{ route('vehiculos.index') }}" class="btn-agregar-vehiculo">
                <i class="fas fa-arrow-left"></i> Volver a Vehículos
            </a>
        </div>
    
        <h1 class="title">Añadir Vehículo</h1>
        
        <div class="add-vehicle-container">
            <form id="formAgregarVehiculo" class="add-vehicle-form">
                <h2><i class="fas fa-plus-circle"></i> Información del Vehículo</h2>
                
                <div class="form-group">
                    <label for="tipoVehiculo">Tipo de Vehículo:</label>
                    <select id="tipoVehiculo" name="tipoVehiculo" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="camion">Camión</option>
                        <option value="camioneta">Camioneta</option>
                        <option value="moto">Moto</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input type="text" id="placa" name="placa" required placeholder="Ej: ABC-123">
                </div>
                
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required placeholder="Ej: Ford F-150">
                </div>
                
                <div class="form-group">
                    <label for="anio">Año:</label>
                    <input type="number" id="anio" name="anio" min="1900" max="2025" required placeholder="Ej: 2020">
                </div>
                
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" required placeholder="Ej: Rojo">
                </div>
                
                <div class="form-group">
                    <label for="imagen">Imagen del Vehículo:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label for="observaciones">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" rows="3" placeholder="Detalles adicionales..."></textarea>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Guardar Vehículo
                </button>
            </form>
        </div>
    </main>
    <script src="{{ asset('js/vehiculos.js') }}"></script>
    <script src="{{ asset('js/agregarvehiculo.js') }}"></script>
</body>