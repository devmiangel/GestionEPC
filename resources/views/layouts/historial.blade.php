@extends('layouts.modulos')

@section('content')
<div class="container">
    <h1>Historial de Elementos y Vehículos</h1>
    <p>En esta sección puedes consultar y gestionar las hojas de vida de todos los elementos del almacén y los vehículos registrados, incluyendo información relevante como fecha de adquisición, historial de mantenimiento y estado actual.</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nombre/Descripción</th>
                <th>Fecha de Adquisición</th>
                <th>Historial de Mantenimiento</th>
                <th>Estado Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->nombre ?? $item->descripcion }}</td>
                <td>{{ $item->fecha_adquisicion }}</td>
                <td>
                    <a href="{{ route('historial.mantenimientos', $item->id) }}" class="btn btn-info btn-sm">Ver Historial</a>
                </td>
                <td>{{ $item->estado }}</td>
                <td>
                    <a href="{{ route('historial.editar', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
