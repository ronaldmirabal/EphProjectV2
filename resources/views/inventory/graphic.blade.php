<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding-bottom: 60px; /* Espacio para el footer */
        }
        .header {
            text-align: left;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            width: 300px;
            opacity: 0.3;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
        }
        .content {
            font-size: 14px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: left;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 10px;
            background: #fff;
            display: flex;
            align-items: center;
        }
        .footer .rectoria {
            font-weight: bold;
            color: #2A5DB0;
            margin-right: 10px;
        }
        .footer .separator {
            border-left: 1px solid #A0A0A0;
            height: 30px;
            margin: 0 10px;
        }
        .footer .info {
            display: flex;
            flex-direction: column;
        }
        .footer img {
            vertical-align: middle;
            width: 15px;
            margin-right: 5px;
        }
        .chart-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('image/logo2.png') }}" class="logo">
    </div>
    <div class="title">
        Asunto: Bloqueo de Acceso a Aplicaciones y Servicios
    </div>
    <div class="content">
        <p>Estimados colaboradores,</p>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="footer">
        <p class="rectoria">RECTORÍA</p>
        <div class="separator"></div>
        <div class="info">
            <p>
                <img src="phone_icon.png"> 809.482.3797 &nbsp;
                <img src="fax_icon.png"> 809.482.5119 &nbsp;
                <img src="email_icon.png"> rectoria@isfodosu.edu.do &nbsp;
                <img src="web_icon.png"> www.isfodosu.edu.do
            </p>
            <p>C/ Caonabo, esq. C/ Leonardo Da Vinci, Urb. Renacimiento, Sector Mirador Sur, Sto. Dgo., Rep. Dom.</p>
        </div>
    </div>


</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const chartData = @json($chartData);

            // Validación profunda de los datos
            if (!chartData || !chartData.datasets || !Array.isArray(chartData.datasets)) {
                throw new Error('Estructura de datos inválida: falta propiedad datasets');
            }

            // Asegurar que cada dataset tenga data como array
            chartData.datasets.forEach((dataset, index) => {
                if (!dataset.data || !Array.isArray(dataset.data)) {
                    console.error('Dataset inválido en posición', index, ':', dataset);
                    throw new Error(`El dataset en posición ${index} no tiene propiedad data o no es un array`);
                }

                // Convertir datos a números por si acaso
                dataset.data = dataset.data.map(item => Number(item));
            });

            // Crear el gráfico
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'right' },
                        title: {
                            display: true,
                            text: 'Distribución de Inventario'
                        }
                    }
                }
            });

        } catch (error) {
            // Mostrar error detallado
            const errorDiv = document.createElement('div');
            errorDiv.style.cssText = `
                color: red;
                padding: 20px;
                margin: 20px 0;
                border: 2px solid red;
                background: #ffeeee;
                font-family: sans-serif;
            `;

            errorDiv.innerHTML = `
                <h3 style="margin-top:0">Error al crear el gráfico</h3>
                <p><strong>Tipo:</strong> ${error.name}</p>
                <p><strong>Mensaje:</strong> ${error.message}</p>
                <h4>Datos recibidos:</h4>
                <pre style="overflow-x: auto">${JSON.stringify(@json($chartData), null, 2)}</pre>
                <p>Revise la consola para más detalles (F12 > Console)</p>
            `;

            document.body.prepend(errorDiv);
            console.error('Error completo:', error);
            console.log('Datos recibidos:', @json($chartData));
        }
    });
    </script>
</html>
