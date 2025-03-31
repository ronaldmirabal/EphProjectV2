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

        const years = [...new Set(quarters.map(q => q.year))].sort();
        const datasets = years.map(year => {
            const yearQuarters = quarters.filter(q => q.year === year);
            return {
                label: year,
                data: yearQuarters.map(q => q.total_items),
                backgroundColor: `hsl(${year % 360}, 70%, 50%)`,
                borderColor: `hsl(${year % 360}, 70%, 30%)`,
                borderWidth: 1
            };
        });

        // Etiquetas (Q1, Q2, Q3, Q4)
        const etiqueta = ['Q1', 'Q2', 'Q3', 'Q4'];
// Crear gráfico
const ctx2 = document.getElementById('quarterlyChart').getContext('2d');
new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: etiqueta,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                return `Año ${datasets[context.datasetIndex].etiqueta}`;
                            },
                            label: function(context) {
                                return `Artículos: ${context.raw.toLocaleString()}`;
                            }
                        }
                    },
                    legend: {
                        position: 'top',
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
