@extends('layouts.app')

@section('title', 'Asignar Vehículo')

@section('content')
<div class="container">
    <h1>Asignar Vehículo</h1>
    <form action="{{ route('vehiculos.asignar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="vehiculo_id" class="form-label">Vehículo</label>
            <select class="form-control" id="vehiculo_id" name="vehiculo_id" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa }} - {{ $vehiculo->modelo }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="persona_id" class="form-label">Persona</label>
            <select class="form-control" id="persona_id" name="persona_id" required>
                <option value="">Seleccione una persona</option>
                @foreach($personas as $persona)
                    <option value="{{ $persona->id }}">{{ $persona->nombre }} {{ $persona->apellido }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Asignar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush