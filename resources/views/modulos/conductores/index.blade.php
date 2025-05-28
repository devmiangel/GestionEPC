@extends('layouts.conductores')

@section('content')
<div class="container">
    <h1>Conductores</h1>
    <a href="{{ route('conductores.create') }}" class="btn btn-primary mb-3">Agregar Conductor</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Licencia</th>
                <th>Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conductores as $conductor)
            <tr>
                <td>{{ $conductor->nombre }}</td>
                <td>{{ $conductor->apellido }}</td>
                <td>{{ $conductor->licencia }}</td>
                <td>{{ $conductor->vencimiento_licencia }}</td>
                <td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
