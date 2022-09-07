<html>
  <head>
    <title>A4 Page Using CSS</title>
    <style>
        body {
  width: 216mm;
  height: 100%;
  margin: 0 auto;
  padding: 0;
  background: rgb(204,204,204); 
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
.main-page {
  width: 216mm;
  min-height: 279mm;
  background: white;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
.sub-page {
    padding: 15px;
  height: 279mm;
}
@page {
  size: letter;
  margin: 0;
}
@media print {
  html, body {
    width: 216mm;
    height: 279mm;        
  }
  .main-page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}



div.minimalistBlack {
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
.divTable.minimalistBlack .divTableCell, .divTable.minimalistBlack .divTableHead {
  border: 1px solid #000000;
  padding: 5px 4px;
}
.divTable.minimalistBlack .divTableBody .divTableCell {

}
/* DivTable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 5px;
  padding-bottom: 5px;
  text-align: left;
  background-color: #619926;
  color: white;
}
    </style>
  </head>
  <body>
    <div class="main-page">
      <div class="sub-page">
        <img src="https://www.isfodosu.edu.do/images/Logos/Logo-instituciona-500x110.png" alt=""/>
        
        <div style="background: #92D050">
            <h3 style="color: white; text-align: center; padding: 5px;">Traspaso de Equipo</h3>
        </div>
<div class="divTable minimalistBlack">
    <div class="divTableBody">
        <div class="divTableRow">
        <div class="divTableCell">Equipo asignado anteriormente a:</div>
        <div class="divTableCell">{{$transfer->person_old}}</div>
        <div class="divTableCell">Fecha</div>
        <div class="divTableCell">{{$transfer->created_at}}</div>
        </div>
    </div>
</div>
        

<div class="divTable minimalistBlack">
    <div class="divTableBody">
        <div class="divTableRow">
        <div class="divTableCell">Equipo traspasado a:</div>
        <div class="divTableCell">{{$transfer->person_new}}</div>
        </div>
    </div>
</div>
        
        <br>
Descripción
<div style="border: 1px solid #000000; padding:5px">
    {{$transfer->description}}
</div>
<br><br>
<table id="customers">
    <thead>
       <tr>
      <th>Articulo</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Serial</th>
      <th>No.Placa</th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$inventory->typeproduct->name}}</td>
        <td>{{$inventory->brand->name}}</td>
        <td>{{$inventory->model}}</td>
        <td>{{$inventory->serial}}</td>
        <td>{{$inventory->noplaca}}</td>
      </tr>
    </tbody>
   
  </table>
  <footer>
    Copyright &copy; <?php echo date("Y");?> 
</footer>
      </div>    

      
    </div>

   
  </body>
</html>