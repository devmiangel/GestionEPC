@extends('layouts.herramientas')

@section('content')
<div class="container">
    <h1>Eliminar Herramienta</h1>
    
    @if(count($herramientas) > 0)
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($herramientas as $herramienta)
                    <tr>
                        <td>{{ $herramienta->especificacion_herramienta }}</td>
                        <td>{{ $herramienta->tipoHerramienta->tipo_herramienta ?? 'No especificado' }}</td>
                        <td>{{ $herramienta->estado->estado ?? 'No especificado' }}</td>
                        <td>
                            <form action="{{ route('herramientas.destroy', $herramienta->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar esta herramienta?')">
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
            No hay herramientas disponibles para eliminar.
        </div>
    @endif

    <a href="{{ route('herramientas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
