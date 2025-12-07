@extends('layouts.herramientas')

@section('content')
<div class="container">
    <h1>Eliminar Herramienta</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if($herramientas->isEmpty())
        <div class="alert alert-info">
            No hay herramientas disponibles para eliminar.
        </div>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Volver</a>
    @else
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
                @foreach($herramientas as $herramienta)
                <tr>
                    <td>{{ $herramienta->nombre }}</td>
                    <td>{{ $herramienta->tipoHerramienta->tipo_herramienta ?? 'N/A' }}</td>
                    <td>{{ $herramienta->descripcion ?? $herramienta->especificacion_herramienta ?? 'N/A' }}</td>
                    <td>{{ $herramienta->estado->estado ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('herramientas.destroy', $herramienta->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta herramienta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Volver</a>
    @endif
</div>
@endsection
