@extends('layouts.app')

@section('title')
Inventario
@endsection
@section('content')

<div style="width: 800px; height: 500px;" class="chart-container">
    <canvas id="myChart"></canvas>
</div>
<div class="chart-container" style="position: relative; height:400px; width:100%">
    <canvas id="quarterlyChart"></canvas>
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const ctx = document.getElementById('myChart').getContext('2d');
    const chartData = @json($chartData);
    const quarters = @json($quarters);

    // ============================
    //  GRÁFICO PIE DE CATEGORÍAS
    // ============================
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: chartData.labels,
            datasets: chartData.datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Inventario por Categoría',
                    font: { size: 18, weight: 'bold' },
                    padding: { top: 10, bottom: 20 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            return `${label}: ${value} unidades`;
                        }
                    }
                },
                legend: {
                    position: 'right',
                    labels: {
                        padding: 15,
                        font: { size: 12 },
                        usePointStyle: true
                    }
                }
            }
        }
    });


    // ====================================
    //  GRÁFICO BARRAS POR TRIMESTRE / AÑO
    // ====================================

    // Agrupar años disponibles
    const years = [...new Set(quarters.map(q => q.year))].sort();

    // Obtener etiquetas dinámicas: Q1, Q2, Q3, Q4
    const etiquetasTrimestres = [...new Set(quarters.map(q => 'Q' + q.quarter_number))];

    // Crear datasets por año
    const datasets = years.map(year => {
        const yearQuarters = quarters.filter(q => q.year === year);

        // Ordenar por número de trimestre
        yearQuarters.sort((a,b) => a.quarter_number - b.quarter_number);

        return {
            label: year.toString(),
            data: yearQuarters.map(q => q.total_items),
            backgroundColor: `hsl(${(year * 40) % 360}, 70%, 55%)`,
            borderColor: `hsl(${(year * 40) % 360}, 70%, 35%)`,
            borderWidth: 1
        };
    });

    const ctx2 = document.getElementById('quarterlyChart').getContext('2d');

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: etiquetasTrimestres,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        title: (context) => {
                            return "Año " + datasets[context[0].datasetIndex].label;
                        },
                        label: (context) => {
                            return `Artículos: ${context.raw.toLocaleString()}`;
                        }
                    }
                },
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Trimestres'
                    }
                }
            }
        }
    });

});
</script>

@endsection
