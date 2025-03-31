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

        // Preparar datos para el gráfico
        const labels = quarters.map(q => q.quarter);
        const data = quarters.map(q => q.total_items);
        const inventoryChart = new Chart(ctx, {
            type: 'pie', // o 'doughnut' para gráfico de dona
            data: {
                labels: chartData.labels,
                datasets: chartData.datasets
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true, // Asegúrate de que esté en true
                        text: 'Distribución de Inventario por Categoría', // Texto personalizado
                        font: {
                            size: 18, // Tamaño de fuente
                            weight: 'bold' // Opcional: negrita
                        },
                        padding: {
                            top: 10,
                            bottom: 20 // Espaciado
                        }
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
                    },
                    title: {
                    display: true,
                    text: 'Distribución de Stock por Tipo',
                    font: { size: 16 }
                }
                }
            }
        });


// Crear gráfico
const ctx2 = document.getElementById('quarterlyChart').getContext('2d');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Artículos en Inventario',
            data: data,
            backgroundColor: quarters.map((q, i) =>
                `hsl(${i * 360 / quarters.length}, 70%, 50%)`),
            borderColor: quarters.map((q, i) =>
                `hsl(${i * 360 / quarters.length}, 70%, 30%)`),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `Artículos: ${context.raw.toLocaleString()}`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString();
                    }
                }
            }
        }
    }
});






    });
    </script>

@endsection
