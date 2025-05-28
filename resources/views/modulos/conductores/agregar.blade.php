@extends('layouts.conductores')

@section('content')
<div class="container">
    <h1>Agregar Conductor</h1>
    <form action="{{ route('conductores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="licencia" class="form-label">Licencia</label>
            <input type="text" class="form-control" id="licencia" name="licencia" required>
        </div>
        <div class="mb-3">
            <label for="vencimiento_licencia" class="form-label">Vencimiento Licencia</label>
            <input type="date" class="form-control" id="vencimiento_licencia" name="vencimiento_licencia" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('conductores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
