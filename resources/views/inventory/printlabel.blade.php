<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrintLabel</title>
    <style type="text/css">


    </style>
</head>
<body>
    
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:50pt;">
            <img src="data:image/png;base64, {!! $qrcode !!}"/>
        </div>
        <div style="margin-left:50pt;">

            <strong>NoPlaca:</strong>
                {{ $inventory->noplaca }}
        </br>
                <strong>Área:</strong>
                {{ $inventory->area->name }}
            </br>
         
                <strong>Tipo:</strong>
                {{ $inventory->typeproduct->name }}
            
        </div>
    </div>

    
   
</body>
</html>