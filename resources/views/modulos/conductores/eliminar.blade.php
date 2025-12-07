@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-top:20px;">Eliminar Conductores</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="list-group mt-4">
        @forelse($conductores as $conductor)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $conductor->primer_nombre }} {{ $conductor->primer_apellido }}</strong>
                    <div>Documento: {{ $conductor->num_documento ?? '-' }}</div>
                    <div>Tipo: {{ $conductor->tipoDocumento->tipo_documento ?? '-' }}</div>
                </div>
                <div>
                    <form action="{{ route('conductores.destroy', $conductor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este conductor?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No hay conductores para eliminar.</div>
        @endforelse
    </div>

    <div class="mt-3">
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
