@extends('layouts.conductores')

@section('content')
<div class="container">
    <h1>Eliminar Conductor</h1>
    
    @if(count($conductores) > 0)
        <div class="table-responsive mt-4">
            <table class="table table-striped">
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
                            <form action="{{ route('conductores.destroy', $conductor->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar este conductor?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            No hay conductores disponibles para eliminar.
        </div>
    @endif

    <a href="{{ route('conductores.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
