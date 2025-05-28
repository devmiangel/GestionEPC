@extends('layouts.modulos')

@section('title', 'Vehiculos - EPC')

@section('link')
<link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
<link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endsection

@section('content')

<body>

    <div class="content-wrapper">
        <div class="main-content-area"> <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong></strong></h1><br><br>
            <div class="dashboard-buttons">
                <div><a href="#" class="dashboard-button">Compactadores</a></div>
                <div><a href="#" class="dashboard-button">Camionetas</a></div>
                <div><a href="#" class="dashboard-button">Motos</a></div>
                <div><a href="#" class="dashboard-button">Otros</a></div>
            </div>
            <br>
            <div class="actions-vehiculos">
                <div class="action-buttons">
                    <a href="{{ route('vehiculos.create') }}" class="btn-agregar-vehiculo">
                        <i class="fas fa-plus"></i> Añadir Vehículo
                    </a>
                    <a href="eliminarvehiculo.html" class="btn-eliminar-vehiculo">
                        <i class="fas fa-trash-alt"></i> Eliminar Vehículo
                    </a>
                </div>
            </div>

            <div id="modalVehiculo" onclick="cerrarModal()">
                <div class="contenido-modal" onclick="event.stopPropagation()">
                    <span class="cerrar" onclick="cerrarModal()">&times;</span>
                    <img id="modalImagen" src="" alt="Imagen del vehículo">
                    <div id="modalDetalles"></div>
                </div>
            </div>
            <button id="backButton" onclick="showAll()" class="hidden">Volver</button>
        </div> <br> <footer class="site-footer">
        </footer>
    </div> 
    <script src="{{ asset('js/vehiculos.js') }}"></script>
    <script src="{{ asset('js/modulos.js') }}"></script>
</body>
@endsection