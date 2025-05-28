@extends('layouts.app')

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
                    <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('conductores.update', $conductor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success" type="submit">Actualizar</button>
                    </form>
                    <form action="{{ route('conductores.eliminate') }}" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="{{ $conductor->id }}">
                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
