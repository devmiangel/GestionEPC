@extends('layouts.herramientas')

@section('content')
<div class="container">
    <h1>Agregar Herramienta</h1>
    <form action="{{ route('herramientas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="tipo_herramienta_id" class="form-label">Tipo de Herramienta</label>
            <select class="form-control" id="tipo_herramienta_id" name="tipo_herramienta_id" required>
                <option value="">-- Seleccionar tipo --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->tipo_herramienta }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_estado" class="form-label">Estado</label>
            <select class="form-control" id="id_estado" name="id_estado">
                <option value="">-- Seleccionar estado --</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" {{ $estado->id == 1 ? 'selected' : '' }}>{{ $estado->estado }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <input type="hidden" name="id_estadoregistro" value="1">
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
