@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Alertas</h2>
    @if($alertas->count())
        <div class="list-group">
            @foreach($alertas as $alerta)
                <div class="list-group-item list-group-item-action mb-2">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $alerta->titulo ?? 'Alerta' }}</h5>
                        <small>{{ $alerta->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <p class="mb-1">{{ $alerta->mensaje ?? '' }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $alertas->links() }}
        </div>
    @else
        <div class="alert alert-info">No tienes alertas.</div>
    @endif
</div>
@endsection
