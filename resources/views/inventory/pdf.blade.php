<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <!-- Styles -->
     <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
<style>
    h2,h3,h4{
        text-align: center;
    }
    input{
        border: none;
        margin: 0;
    }
    #current_date{
        text-align: right;
    }
    table, td {
        border: 1px solid #ddd;
}


html {
  min-height: 100%;
  position: relative;
}


th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.columna {
  width:33%;
  float:left;
}

.linea {
  border-top: 1px solid black;
  height: 2px;
  max-width: 200px;
  padding: 0;
  margin: 0px auto 0 auto;
}
.firmante{
    display: block;
    text-align: center;
}

.cargo{
    font-size: 10px;
    display: block;
    text-align: center;
}

@media (max-width: 500px) {
  
  .columna {
    width:auto;
    float:none;
  }
  
}


footer {
    position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
}





</style>

    </head>
<body>

    <img src="https://www.isfodosu.edu.do/images/Logos/Logo-instituciona-500x110.png" alt="" width="350px">

    <h2>{{ $universities->name }}</h2>
    <h4>{{ $universities->address }}</h4>
    
    <div id="current_date"></p>
        <label>Fecha de Impresión:</label>
        <input name="fecha" type="text" id="fecha" value="<?php echo date("d/m/Y"); ?>" size="10" />
    </div>

    <h3>Lista de Inventario</h3>

    <table class="table table-striped table-hover" id="tabla">
        <thead class="thead">
            <tr>
                <th>#Id</th>
                <th>Tipo</th>
                <th>Serial</th>
                <th>Noplaca</th>
                <th>Descripcion</th>
                <th>Asignada</th>
                <th>Marca</th>
                <th>Model</th>
                <th>Area</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->typeproduct->name }}</td>
                    <td>{{ $inventory->serial }}</td>
                    <td>{{ $inventory->noplaca }}</td>
                    <td>{{ $inventory->description }}</td>
                    <td>{{ $inventory->people->first_name. " ".$inventory->people->last_name}}</td>
                    <td>{{ $inventory->brand->name }}</td>
                    <td>{{ $inventory->model }}</td>
                    <td>{{ $inventory->area->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



   
    <footer>
      


        <div class="columna">
            <label class="firmante">Ronald Mirabal Gomez</label>
            <div class="linea"></div>
            <label class="cargo">Soporte Tecnico</label>
            
        </div>
        <div class="columna">
            <label class="firmante">Enrique Jimenez</label>
            <div class="linea"></div>
            <label class="cargo">Soporte Tecnico</label>
        </div>
        <div class="columna">
            <label class="firmante">Sor. Ana Julia Suriel</label>
            <div class="linea"></div>
            <label class="cargo">Vicerrectora</label>
        </div>
    



      </footer>
</body>

</html>