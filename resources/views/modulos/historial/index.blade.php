@extends('layouts.historial')

@section('content')
<style>
    .historial-page { padding-bottom: 160px; }
    .historial-table-wrapper { max-height: calc(100vh - 320px); overflow: auto; }
    @media (max-width: 768px) {
        .historial-page { padding-bottom: 220px; }
        .historial-table-wrapper { max-height: calc(100vh - 380px); }
    }
</style>
<div class="container historial-page">
    <h1>Historial de Elementos y Vehículos</h1>
    <p>Consulta y gestiona las hojas de vida de todos los elementos del almacén y vehículos registrados, incluyendo fecha de adquisición, historial de mantenimiento y estado actual.</p>
    
    <div class="mb-5">
        <h2 style="color: #136ea7; border-bottom: 3px solid #136ea7; padding-bottom: 10px;">
            <i class="fas fa-car"></i> Vehículos
        </h2>
        @php
            $vehiculos = $items->filter(function($item) {
                return (is_array($item) ? ($item['tipo'] ?? '') : $item->tipo) === 'Vehículo';
            });
        @endphp

        @if($vehiculos->isEmpty())
            <div class="alert alert-info">No hay vehículos registrados en el historial.</div>
        @else
            <div class="historial-table-wrapper">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Placa</th>
                        <th>Usuario Asignado</th>
                        <th>Estado Actual</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculos as $item)
                    <tr>
                        <td>{{ is_array($item) ? ($item['marca'] ?? '') : $item->marca }}</td>
                        <td>{{ is_array($item) ? ($item['modelo'] ?? '') : $item->modelo }}</td>
                        <td>{{ is_array($item) ? ($item['tipo_vehiculo'] ?? '') : $item->tipo_vehiculo }}</td>
                        <td><strong>{{ is_array($item) ? ($item['placa'] ?? '') : $item->placa }}</strong></td>
                        <td>{{ is_array($item) ? ($item['usuario'] ?? '') : $item->usuario }}</td>
                        <td>{{ is_array($item) ? ($item['estado'] ?? '') : $item->estado }}</td>
                        <td>
                            <a href="{{ route('historial.vehiculo', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-file-alt"></i> Ver Hoja de Vida
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        @endif
    </div>

    <div class="mb-5">
        <h2 style="color: #6c757d; border-bottom: 3px solid #6c757d; padding-bottom: 10px;">
            <i class="fas fa-wrench"></i> Herramientas
        </h2>
        @php
            $herramientas = $items->filter(function($item) {
                return (is_array($item) ? ($item['tipo'] ?? '') : $item->tipo) === 'Herramienta';
            });
        @endphp
        
        @if($herramientas->isEmpty())
            <div class="alert alert-info">No hay herramientas registradas en el historial.</div>
        @else
            <table class="table table-striped table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Usuario Asignado</th>
                        <th>Estado Actual</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($herramientas as $item)
                    <tr>
                        <td><strong>{{ is_array($item) ? ($item['nombre'] ?? '') : $item->nombre }}</strong></td>
                        <td>{{ is_array($item) ? ($item['modelo'] ?? '') : $item->modelo }}</td>
                        <td>{{ is_array($item) ? ($item['usuario'] ?? '') : $item->usuario }}</td>
                        <td>
                            @php
                                $estado = is_array($item) ? ($item['estado'] ?? '') : $item->estado;
                            @endphp
                            @if($estado === 'Disponible')
                                <span class="badge bg-success">{{ $estado }}</span>
                            @elseif($estado === 'Prestada')
                                <span class="badge bg-warning text-dark">{{ $estado }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $estado }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('historial.herramienta', is_array($item) ? ($item['id'] ?? '') : $item->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-file-alt"></i> Ver Hoja de Vida
                            </a>
                        </td>
                    </tr>
                    @endforeach
    </table>
</div>
        @endif
    </div>
@endsection