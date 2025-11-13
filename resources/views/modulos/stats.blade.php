@extends('layouts.app')

@section('content')
<div class="dashboard-stats-container">
    <h1 class="dashboard-title">Estadísticas</h1>
    
    <!-- Botón Volver al Menú Principal -->
    <div style="text-align: center; margin-bottom: 30px;">
        @if(\Illuminate\Support\Facades\Route::has('dashboard'))
            <a href="{{ route('dashboard') }}" class="dashboard-button" style="display: inline-block; padding: 10px 30px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                ← Volver al Menú Principal
            </a>
        @else
            <a href="/dashboard" class="dashboard-button" style="display: inline-block; padding: 10px 30px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                ← Volver al Menú Principal
            </a>
        @endif
    </div>
    
    <!-- Tarjetas de Resumen -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #3498db;">
                <i class="fas fa-car"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Total de Vehículos</p>
                <p class="stat-value">{{ $totalVehiculos }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #2ecc71;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Disponibles</p>
                <p class="stat-value">{{ $estadoDisponible }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #f39c12;">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Prestados</p>
                <p class="stat-value">{{ $estadoPrestado }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e74c3c;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Fuera de Servicio</p>
                <p class="stat-value">{{ $estadoFueraServicio }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #9b59b6;">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">En Mantenimiento</p>
                <p class="stat-value">{{ $estadoMantenimiento }}</p>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="charts-container">
        <!-- Gráfico Vehículos por Tipo -->
        <div class="chart-box">
            <h3>Vehículos por Tipo</h3>
            <canvas id="tipoChart"></canvas>
        </div>

        <!-- Gráfico Vehículos por Estado -->
        <div class="chart-box">
            <h3>Vehículos por Estado</h3>
            <canvas id="estadoChart"></canvas>
        </div>
    </div>

    <!-- Gráfico de Distribución General -->
    <div class="chart-box full-width">
        <h3>Distribución de Estados</h3>
        <canvas id="distributionChart"></canvas>
    </div>
</div>

@push('styles')
<style>
    .dashboard-stats-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .dashboard-title {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #2c3e50;
        font-weight: 700;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0.5rem 0 0 0;
    }

    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .chart-box {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .chart-box h3 {
        margin-top: 0;
        margin-bottom: 1.5rem;
        color: #2c3e50;
        font-size: 1.3rem;
    }

    .chart-box canvas {
        max-height: 300px;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .full-width canvas {
        max-height: 350px;
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .charts-container {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .dashboard-stats-container {
            padding: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Colores consistentes
        const colors = {
            primary: '#3498db',
            success: '#2ecc71',
            warning: '#f39c12',
            danger: '#e74c3c',
            purple: '#9b59b6',
            cyan: '#1abc9c'
        };

        // Gráfico Vehículos por Tipo (Doughnut)
        const tipoCtx = document.getElementById('tipoChart');
        if (tipoCtx) {
            const tipoData = @json($vehiculosPorTipo);
            const tipoLabels = Object.keys(tipoData);
            const tipoValues = Object.values(tipoData);

            new Chart(tipoCtx, {
                type: 'doughnut',
                data: {
                    labels: tipoLabels,
                    datasets: [{
                        data: tipoValues,
                        backgroundColor: [
                            colors.primary,
                            colors.success,
                            colors.warning,
                            colors.danger,
                            colors.purple,
                            colors.cyan
                        ],
                        borderColor: '#fff',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 12 },
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // Gráfico Vehículos por Estado (Bar)
        const estadoCtx = document.getElementById('estadoChart');
        if (estadoCtx) {
            const estadoData = @json($vehiculosPorEstado);
            const estadoLabels = Object.keys(estadoData);
            const estadoValues = Object.values(estadoData);

            new Chart(estadoCtx, {
                type: 'bar',
                data: {
                    labels: estadoLabels,
                    datasets: [{
                        label: 'Cantidad',
                        data: estadoValues,
                        backgroundColor: [
                            colors.success,
                            colors.warning,
                            colors.purple,
                            colors.danger
                        ],
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        }

        // Gráfico de Distribución General (Pie)
        const distributionCtx = document.getElementById('distributionChart');
        if (distributionCtx) {
            const disponible = {{ $estadoDisponible }};
            const prestado = {{ $estadoPrestado }};
            const mantenimiento = {{ $estadoMantenimiento }};
            const fueraServicio = {{ $estadoFueraServicio }};

            new Chart(distributionCtx, {
                type: 'pie',
                data: {
                    labels: ['Disponible', 'Prestado', 'En Mantenimiento', 'Fuera de Servicio'],
                    datasets: [{
                        data: [disponible, prestado, mantenimiento, fueraServicio],
                        backgroundColor: [
                            colors.success,
                            colors.warning,
                            colors.purple,
                            colors.danger
                        ],
                        borderColor: '#fff',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 13 },
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection
