@extends('layouts.herramientas')

@section('title', 'Herramientas - EPC')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Herramientas EPC</title>

    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="content-wrapper">
        <div class="main-content-area"> <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Herramientas</strong></h1><br><br>
            <div class="dashboard-buttons">
            </div>
            <br>
            <div class="actions-herramientas">
                <div class="action-buttons">
                    <a href="{{ route('herramientas.create') }}" class="btn-agregar-vehiculo">
                        <i class="fas fa-plus"></i> Añadir Herramienta
                    </a>
                    <a href="{{ route('herramientas.eliminate') }}" class="btn-eliminar-vehiculo">
                        <i class="fas fa-trash-alt"></i> Eliminar Herramienta
                    </a>
                </div>
            </div>

            <div id="modalvehiculo" onclick="cerrarModal()">
                <div class="contenido-modal" onclick="event.stopPropagation()">
                    <span class="cerrar" onclick="cerrarModal()">&times;</span>
                    <img id="modalImagen" src="" alt="Imagen de la herramienta">
                    <div id="modalDetalles"></div>
                </div>
            </div>
        </div> <br>
    </div> 
    <script src="{{ asset('js/vehiculos.js') }}"></script>
    <script src="{{ asset('js/modulos.js') }}"></script>
</body>
@endsection
