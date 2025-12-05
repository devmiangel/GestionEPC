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
            <div style="text-align: center; margin-bottom: 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; padding: 0 20px;">
                <a href="{{ route('herramientas.mecanicas') }}" class="dashboard-button" style="display: block; padding: 15px 10px; background: #3498db; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; text-align: center;">
                    <i class="fas fa-wrench"></i> Mecánicas
                </a>
                <a href="{{ route('herramientas.electricas') }}" class="dashboard-button" style="display: block; padding: 15px 10px; background: #f39c12; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; text-align: center;">
                    <i class="fas fa-bolt"></i> Eléctricas
                </a>
                <a href="{{ route('herramientas.medicion') }}" class="dashboard-button" style="display: block; padding: 15px 10px; background: #2ecc71; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; text-align: center;">
                    <i class="fas fa-ruler"></i> Medición
                </a>
                <a href="{{ route('herramientas.otros') }}" class="dashboard-button" style="display: block; padding: 15px 10px; background: #9b59b6; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; text-align: center;">
                    <i class="fas fa-cube"></i> Otros
                </a>
            </div>
            <br>
            <div class="actions-herramientas">
                <div class="action-buttons">
                    @auth
                        @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
                            <a href="{{ route('herramientas.create') }}" class="btn-agregar-vehiculo">
                                <i class="fas fa-plus"></i> Añadir Herramienta
                            </a>
                            <a href="{{ route('herramientas.eliminate') }}" class="btn-eliminar-vehiculo">
                                <i class="fas fa-trash-alt"></i> Eliminar Herramienta
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Asignado A</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($herramientas as $herramienta)
                        <tr>
                            <td>{{ $herramienta->nombre }}</td>
                            <td>{{ $herramienta->tipoHerramienta->tipo_herramienta ?? 'N/A' }}</td>
                            <td>{{ $herramienta->descripcion ?? $herramienta->especificacion_herramienta ?? 'N/A' }}</td>
                            <td>
                                @if($herramienta->persona)
                                    <span class="badge bg-danger">Prestada</span>
                                @else
                                    <span class="badge bg-success">Disponible</span>
                                @endif
                            </td>
                            <td>
                                @if($herramienta->persona)
                                    {{ $herramienta->persona->nombre ?? 'N/A' }}
                                @else
                                    Sin asignar
                                @endif
                            </td>
                            <td>
                                @auth
                                    @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
                                        @if($herramienta->persona)
                                            <form action="{{ route('herramientas.devolver', $herramienta->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Desasignar esta herramienta?');">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-undo"></i> Devolver
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('herramientas.asignar.form.id', $herramienta->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-user-plus"></i> Asignar
                                            </a>
                                        @endif
                                        <a href="{{ route('herramientas.edit', $herramienta->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Modificar
                                        </a>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    {{-- <script src="{{ asset('js/modulos.js') }}"></script> --}}
</body>
@endsection
