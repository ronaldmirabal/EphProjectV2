@extends('layouts.app')

@section('title')
    Inventario
@endsection
@section('content')

    <div style="width: 800px; height: 500px;" class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
       document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart').getContext('2d');
        const chartData = @json($chartData);
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
    });
    </script>
@endsection
