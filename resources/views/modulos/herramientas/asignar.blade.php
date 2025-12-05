@extends('layouts.app')

@section('content')
<style>
    .form-control {
        height: auto;
        overflow-y: auto;
    }
</style>
<div class="container">
    <h1>Asignar Herramienta</h1>
    @auth
        @if(auth()->user()->tieneRol('Coordinador') || auth()->user()->tieneRol('Administrador'))
            <form action="{{ route('herramientas.asignar') }}" method="POST">
                @csrf
        <div class="mb-3">
            <label for="herramienta_id" class="form-label">Herramienta</label>
            @if($herramienta)
                {{-- Si viene de un botón específico, mostrar como campo de solo lectura --}}
                <input type="text" class="form-control" value="{{ $herramienta->nombre }}" readonly>
                <input type="hidden" id="herramienta_id" name="herramienta_id" value="{{ $herramienta->id }}" required>
            @else
                {{-- Si viene de la página general, mostrar select --}}
                <select class="form-control" id="herramienta_id" name="herramienta_id" required>
                    <option value="">Seleccione una herramienta</option>
                    @foreach($herramientas as $h)
                        <option value="{{ $h->id }}">{{ $h->nombre }}</option>
                    @endforeach
                </select>
            @endif
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
                <a href="{{ route('herramientas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        @else
            <div class="alert alert-warning">No tienes permisos para asignar herramientas.</div>
        @endif
    @endauth
    @guest
        <div class="alert alert-warning">Inicia sesión para asignar herramientas.</div>
    @endguest
</div>
<footer class="footer mt-5 py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; {{ date('Y') }} EPC - Todos los derechos reservados.</span>
    </div>
</footer>
@endsection
