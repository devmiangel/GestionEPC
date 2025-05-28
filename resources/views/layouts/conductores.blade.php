@extends('layouts.modulos')

@section('content')
    @yield('content')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles/estiloDashboard.css') }}">
@endpush