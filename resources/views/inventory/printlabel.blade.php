<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrintLabel</title>
    <style type="text/css">
.container {
    background: gray;
    display: grid; 
  grid-template-columns: auto 1fr; 
  grid-template-rows: 1fr; 
  gap: 0px 0px; 
  grid-template-areas: 
    "col1 col2"; 
}

.col1 { grid-area: col1;}

.col2 { grid-area: col2; }

    </style>
</head>
<body>
    
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:192pt;">
            <strong>NoPlaca:</strong>
                {{ $inventory->noplaca }}
        </br>
                <strong>Área:</strong>
                {{ $inventory->area->name }}
            </br>
         
                <strong>Tipo:</strong>
                {{ $inventory->typeproduct->name }}
        </div>
        <div style="margin-left:100pt;">
            <img src="data:image/png;base64, {!! $qrcode !!}"/>
        </div>
    </div>

    
   
</body>
</html>