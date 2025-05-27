@extends('layouts.modulos')

@section('title', 'Vehículos')

@section('content')
    <h1 class="title">VEHICULOS</h1>

    {{-- CAMIONES --}}
    <h2 class="subtitle">CAMIONES</h2>
    <section id="camiones">
        <div class="vehicle-grid">
            @include('modulos.vehiculos.partials.tarjeta', [
                'tipo' => 'camion',
                'placa' => 'ABC-123',
                'marca' => 'Volvo',
                'año' => 2022,
                'capacidad' => '10 toneladas',
                'conductor' => 'Nombre Conductor',
                'mantenimiento' => '26/05/24',
                'soat' => 'Activo',
                'tecnomecanica' => 'Activa'
            ])

            {{-- Puedes duplicar este include para más camiones o hacer un loop --}}
        </div>
    </section>

    {{-- CAMIONETAS --}}
    <h2 class="subtitle">CAMIONETAS</h2>
    <section id="camionetas">
        <div class="vehicle-grid">
            @include('modulos.vehiculos.partials.tarjeta', [
                'tipo' => 'car',
                'placa' => 'DEF-456',
                'marca' => 'Toyota',
                'año' => 2021,
                'capacidad' => '5 pasajeros',
                'conductor' => 'Conductor 2',
                'mantenimiento' => '24/05/24',
                'soat' => 'Activo',
                'tecnomecanica' => 'Activa'
            ])

            {{-- Botón de añadir --}}
            @include('modulos.vehiculos.partials.añadir')
        </div>
    </section>

    {{-- MOTOS --}}
    <h2 class="subtitle">MOTOS</h2>
    <section id="Motos">
        <div class="vehicle-grid">
            @include('modulos.vehiculos.partials.tarjeta', [
                'tipo' => 'moto2',
                'placa' => 'GHI-789',
                'marca' => 'Bajaj',
                'año' => 2023,
                'capacidad' => '2 pasajeros',
                'conductor' => 'Conductor 3',
                'mantenimiento' => '23/05/24',
                'soat' => 'Activo',
                'tecnomecanica' => 'Activa'
            ])

            @include('modulos.vehiculos.partials.añadir')
        </div>
    </section>

    {{-- Modal --}}
    @include('modulos.vehiculos.partials.modal')

    {{-- Botón Volver --}}
    <button id="backButton" onclick="showAll()" class="hidden">Volver</button>
@endsection

@push('scripts')
    <script src="{{ asset('js/vehiculos.js') }}"></script>
    <script src="{{ asset('js/CVehiculos.js') }}"></script>
@endpush
