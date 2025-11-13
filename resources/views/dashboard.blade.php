@extends('layouts.app')

@section('title', 'Dashboard - EPC')

@section('content')
<div class="dashboard-page">
    <h1 style="text-align: center; margin-top: 50px; font-size: 50px;"><strong>Sistema de Gestión EPC</strong></h1>
    <p style="text-align: center; color: #666; margin-bottom: 50px;">Selecciona una categoría para continuar</p>

    <!-- Vehicle subcategory buttons removed; only main module buttons are shown below -->

    <!-- Botones principales del sistema -->
    <div style="text-align: center; margin-bottom: 50px; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; padding: 0 40px;">
        <a href="{{ route('vehiculos.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #136ea7; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-car" style="margin-right: 8px;"></i>
            Vehículos
        </a>

        <a href="{{ route('herramientas.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #6c757d; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-wrench" style="margin-right: 8px;"></i>
            Herramientas
        </a>

        <a href="{{ route('conductores.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #28a745; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-id-card" style="margin-right: 8px;"></i>
            Conductores
        </a>

        <a href="{{ route('historial.index') }}" class="dashboard-button" style="display: block; padding: 20px 10px; background: #ff7f50; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px; text-align: center;">
            <i class="fas fa-history" style="margin-right: 8px;"></i>
            Historial
        </a>
    </div>
    <!-- Botón Estadísticas (debajo de los botones principales) como desplegable inline -->
    <div style="text-align: center; margin-top: 30px; padding: 0 40px;">
        <button id="toggle-stats-btn" class="dashboard-button" style="display: inline-block; padding: 14px 28px; background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color: white; border: none; border-radius: 8px; font-weight: 700; font-size: 16px; cursor: pointer;">
            📊 Mostrar Estadísticas
        </button>
    </div>

    <!-- Panel oculto de estadísticas -->
    <div id="dashboard-stats-panel" style="display: none; max-width: 1200px; margin: 30px auto 0; padding: 20px;">
        <div class="stats-grid" style="margin-bottom: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem;">
            <div class="stat-card" style="background:white; border-radius:12px; padding:1rem; display:flex; align-items:center; gap:1rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <div class="stat-icon" style="width:60px;height:60px;border-radius:50%;background:#3498db;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;"></div>
                <div class="stat-content">
                    <p class="stat-label" style="margin:0; text-transform:uppercase; color:#7f8c8d; font-size:0.9rem;">Total de Vehículos</p>
                    <p class="stat-value" style="margin:6px 0 0; font-size:1.6rem; font-weight:700; color:#2c3e50;">{{ $totalVehiculos ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card" style="background:white; border-radius:12px; padding:1rem; display:flex; align-items:center; gap:1rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <div class="stat-icon" style="width:60px;height:60px;border-radius:50%;background:#2ecc71;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;"></div>
                <div class="stat-content">
                    <p class="stat-label" style="margin:0; text-transform:uppercase; color:#7f8c8d; font-size:0.9rem;">Disponibles</p>
                    <p class="stat-value" style="margin:6px 0 0; font-size:1.6rem; font-weight:700; color:#2c3e50;">{{ $estadoDisponible ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card" style="background:white; border-radius:12px; padding:1rem; display:flex; align-items:center; gap:1rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <div class="stat-icon" style="width:60px;height:60px;border-radius:50%;background:#f39c12;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;"></div>
                <div class="stat-content">
                    <p class="stat-label" style="margin:0; text-transform:uppercase; color:#7f8c8d; font-size:0.9rem;">Prestados</p>
                    <p class="stat-value" style="margin:6px 0 0; font-size:1.6rem; font-weight:700; color:#2c3e50;">{{ $estadoPrestado ?? 0 }}</p>
                </div>
            </div>

            <div class="stat-card" style="background:white; border-radius:12px; padding:1rem; display:flex; align-items:center; gap:1rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <div class="stat-icon" style="width:60px;height:60px;border-radius:50%;background:#e74c3c;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;"></div>
                <div class="stat-content">
                    <p class="stat-label" style="margin:0; text-transform:uppercase; color:#7f8c8d; font-size:0.9rem;">Fuera de Servicio</p>
                    <p class="stat-value" style="margin:6px 0 0; font-size:1.6rem; font-weight:700; color:#2c3e50;">{{ $estadoFueraServicio ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            <div style="background:white; border-radius:12px; padding:1.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <h3 style="margin-top:0;">Vehículos por Tipo</h3>
                <canvas id="tipoChart"></canvas>
            </div>

            <div style="background:white; border-radius:12px; padding:1.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <h3 style="margin-top:0;">Vehículos por Estado</h3>
                <canvas id="estadoChart"></canvas>
            </div>
        </div>

        <div style="background:white; border-radius:12px; padding:1.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.08); margin-top:1.5rem;">
            <h3 style="margin-top:0;">Distribución de Estados</h3>
            <canvas id="distributionChart"></canvas>
        </div>
    </div>
</div>

<style>
    .dashboard-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3) !important;
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-stats-btn');
    const panel = document.getElementById('dashboard-stats-panel');
    if (toggleBtn && panel) {
        toggleBtn.addEventListener('click', function() {
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
            toggleBtn.textContent = panel.style.display === 'none' ? '📊 Mostrar Estadísticas' : '✖ Ocultar Estadísticas';
        });
    }

    // Prepare chart data safely
    const tipoData = @json($vehiculosPorTipo ?? []);
    const tipoLabels = Object.keys(tipoData);
    const tipoValues = Object.values(tipoData);

    const estadoData = @json($vehiculosPorEstado ?? []);
    const estadoLabels = Object.keys(estadoData);
    const estadoValues = Object.values(estadoData);

    const disponible = {{ $estadoDisponible ?? 0 }};
    const prestado = {{ $estadoPrestado ?? 0 }};
    const mantenimiento = {{ $estadoMantenimiento ?? 0 }};
    const fueraServicio = {{ $estadoFueraServicio ?? 0 }};

    // Tipo Chart
    const tipoCtx = document.getElementById('tipoChart');
    if (tipoCtx && tipoLabels.length) {
        new Chart(tipoCtx, {
            type: 'doughnut',
            data: {
                labels: tipoLabels,
                datasets: [{
                    data: tipoValues,
                    backgroundColor: ['#3498db','#2ecc71','#f39c12','#e74c3c','#9b59b6','#1abc9c'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    }

    // Estado Chart
    const estadoCtx = document.getElementById('estadoChart');
    if (estadoCtx && estadoLabels.length) {
        new Chart(estadoCtx, {
            type: 'bar',
            data: {
                labels: estadoLabels,
                datasets: [{
                    label: 'Cantidad',
                    data: estadoValues,
                    backgroundColor: ['#2ecc71','#f39c12','#9b59b6','#e74c3c']
                }]
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: true }
        });
    }

    // Distribution Chart
    const distributionCtx = document.getElementById('distributionChart');
    if (distributionCtx) {
        new Chart(distributionCtx, {
            type: 'pie',
            data: {
                labels: ['Disponible','Prestado','En Mantenimiento','Fuera de Servicio'],
                datasets: [{
                    data: [disponible, prestado, mantenimiento, fueraServicio],
                    backgroundColor: ['#2ecc71','#f39c12','#9b59b6','#e74c3c'],
                    borderColor: '#fff', borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    }
});
</script>
@endpush
