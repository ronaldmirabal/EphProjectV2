<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Solicitud de Préstamo de Equipos</title>

    <style>
        @page {
            margin: 40px 50px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .header td {
            vertical-align: middle;
        }

        .logo {
            width: 190px;
        }

        .titulo {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .subtitulo {
            text-align: right;
            font-size: 14px;
        }

        .row {
            margin-top: 10px;
        }

        .label {
            font-weight: bold;
        }

        .texto {
            margin-top: 15px;
            line-height: 1.6;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .firmas {
            max-width: 100%;
            margin-top: 70px;
        }

        .firmas td {
            border: none;
            text-align: center;
            padding-top: 40px;
        }

        .linea {
            border-top: 1px solid #000;
            width: 250px;
            margin: 40px auto 5px auto;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-weight: bold;
        }

        .watermark {
    position: fixed;
    top: 70%;
    left: 80%;
    transform: translate(-50%, -50%);

    z-index: -1;
}

.watermark img {
    width: 300px; /* ajusta tamaño */
}
    </style>
</head>

<body>

    <div class="watermark">
        <img src="{{ public_path('image/sello-tecnologia.png') }}">
    </div>

    <table class="header">
        <tr>
            <td style="width:350px">
                <img src="{{ public_path('image/logo2.png') }}" class="logo">
            </td>
            <td>
                <div class="titulo">Formulario</div>
                <div class="subtitulo">Solicitud de Préstamo de Equipos</div>
            </td>
        </tr>
    </table>

    <div class="row">
        <span class="label">Fecha:</span> {{ $loan->created_at->format('d/m/Y') }}
    </div>

    <div class="row">
        <span class="label">Recinto:</span> Emilio Prud’Homme
    </div>

    <div class="texto">
        El equipo entregado a la colaborador@
        <strong>{{$loan->people->first_name }} {{$loan->people->last_name }}</strong>, en calidad de préstamo:
        {{$loan->description}}
    </div>

    <div class="row">
        <span class="label">Nota:</span>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:40px">No</th>
                <th>Descripción Artículo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan->inventories as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->description ?? '' }}</strong><br>
                    {{ $item->brand->name }} {{ $item->model }}<br>
                    SERIAL: {{ $item->serial ?? '' }}<br>
                    COD. DE INVENTARIO: {{ $item->noplaca ?? '' }} <br>
                    COD. BIENES NACIONALES: {{ $item->bienesnacionales ?? '' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="firmas">
        <tr>
            <td style="text-align:center; width:50%;">

                <div style="margin-bottom:60px;"></div>

                <div style="border-top:1px solid #000; width:260px; margin:0 auto 6px auto;"></div>

                <div style="font-weight:bold;">
                    Nombre y firma del solicitante
                </div>

                <div style="margin-top:4px;">
                    {{$loan->people->first_name }} {{$loan->people->last_name }}
                </div>

                <div style="margin-top:8px; font-size:11px;">
                    Fecha: {{ $loan->created_at->format('d/m/Y') }}
                </div>

            </td>
            <td style="text-align:center; width:50%;">

                <div style="margin-bottom:60px;"></div>

                <div style="border-top:1px solid #000; width:260px; margin:0 auto 6px auto;"></div>

                <div style="font-weight:bold;">
                    Nombre y firma de quien autoriza
                </div>

                <div style="margin-top:4px;">
                    {{$loan->user->name}}
                </div>

                <div style="margin-top:8px; font-size:11px;">
                    Fecha: {{ $loan->created_at->format('d/m/Y') }}
                </div>

            </td>

        </tr>

        <tr>
            <td>
                Firma de recepción
                <div class="linea"></div>
                Fecha:
            </td>
        </tr>
    </table>

    <div class="footer">
    </div>

</body>

</html>
