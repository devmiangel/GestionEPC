@extends('layouts.herramientas')

@section('title', 'Herramientas Mecánicas - EPC')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Herramientas Mecánicas - EPC</title>

    <link rel="stylesheet" href="{{ asset('styles/vehiculo.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="content-wrapper">
        <div class="main-content-area">
            <h1 style="text-align: center; margin-top: 20px; font-size: 50px;"><strong>Herramientas Mecánicas</strong></h1><br><br>
            
            <div class="actions-herramientas">
                <div class="action-buttons">
                    @auth
                        @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
                            <a href="{{ route('herramientas.create') }}" class="btn-agregar-vehiculo">
                                <i class="fas fa-plus"></i> Añadir Herramienta
                            </a>
                        @endif
                    @endauth
                    <a href="{{ route('herramientas.index') }}" class="btn-volver-vehiculo">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mecanicas as $herramienta)
                        <tr>
                            <td>{{ $herramienta->nombre ?? 'N/A' }}</td>
                            <td>{{ $herramienta->tipoHerramienta->tipo_herramienta ?? 'N/A' }}</td>
                            <td>{{ $herramienta->descripcion ?? $herramienta->especificacion_herramienta ?? 'N/A' }}</td>
                            <td>{{ $herramienta->estado->estado ?? 'N/A' }}</td>
                            <td>
                                    @auth
                                        @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
                                            <a href="{{ route('herramientas.edit', $herramienta->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Modificar
                                            </a>
                                            <a href="{{ route('herramientas.asignar.form') }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-user-plus"></i> Asignar
                                            </a>
                                        @endif
                                    @endauth
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay herramientas mecánicas disponibles</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/vehiculos.js') }}"></script>
</body>
@endsection
