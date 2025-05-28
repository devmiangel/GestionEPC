@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center; margin-top: 20px; font-size: 40px;">Conductores</h1>
    <div class="dashboard-buttons" style="margin-top: 40px;">
        @foreach($conductores as $conductor)
            <div class="conductor-card">
                <div class="conductor-title">{{ $conductor->primer_nombre }} {{ $conductor->primer_apellido }}</div>
                <div class="conductor-info">Documento: <strong>{{ $conductor->num_documento }}</strong></div>
                <div class="conductor-info">Tipo: <strong>{{ $conductor->tipoDocumento->tipo_documento ?? '' }}</strong></div>
                <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn btn-light btn-sm" style="margin-top: 10px;">Editar</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/conductor.css') }}">
@endpush