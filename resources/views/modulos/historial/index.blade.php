@extends('layouts.historial')

@section('content')
<div class="container">
    <h1>Historial de Elementos y Vehículos</h1>
    <p>Consulta y gestiona las hojas de vida de todos los elementos del almacén y vehículos registrados, incluyendo fecha de adquisición, historial de mantenimiento y estado actual.</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Tipo de Vehículo</th>
                <th>Placa</th>
                <th>Usuario Asignado</th>
                <th>Historial de Mantenimiento</th>
                <th>Estado Actual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->marca }}</td>
                <td>{{ $item->modelo }}</td>
                <td>{{ $item->tipo_vehiculo }}</td>
                <td>{{ $item->placa }}</td>
                <td>{{ $item->usuario }}</td>
                <td>
                    <a href="{{ route('historial.mantenimientos', $item->id) }}" class="btn btn-info btn-sm">Ver Historial</a>
                </td>
                <td>{{ $item->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection