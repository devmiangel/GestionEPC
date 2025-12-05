@extends('layouts.app')

@section('title', '403 - Acceso denegado')

@section('content')
<div style="max-width:800px;margin:60px auto;text-align:center;">
    <h1 style="font-size:48px;margin-bottom:10px;color:#e74c3c;">403</h1>
    <h2 style="margin-bottom:20px;">Acceso denegado</h2>
    <p style="color:#666;margin-bottom:30px;">No tienes permisos suficientes para ver esta página. Si crees que es un error, contacta al administrador.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al tablero</a>
</div>
@endsection
