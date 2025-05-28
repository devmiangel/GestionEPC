@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modificar Conductor</h1>
    <form action="{{ route('conductores.update', $conductor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $conductor->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $conductor->apellido) }}" required>
        </div>
        <div class="mb-3">
            <label for="licencia" class="form-label">Licencia</label>
            <input type="text" class="form-control" id="licencia" name="licencia" value="{{ old('licencia', $conductor->licencia) }}" required>
        </div>
        <div class="mb-3">
            <label for="vencimiento_licencia" class="form-label">Vencimiento Licencia</label>
            <input type="date" class="form-control" id="vencimiento_licencia" name="vencimiento_licencia" value="{{ old('vencimiento_licencia', $conductor->vencimiento_licencia) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush
