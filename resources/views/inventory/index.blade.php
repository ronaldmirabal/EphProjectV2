@extends('layouts.app')

@section('title')
    Inventario
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inventario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inventory.create') }}" class="btn btn-primary btn-sm " >
                                    {{ __('Crear Nuevo') }}
                                </a>
                                <a href="{{ route('inventory.pdf') }}" class="btn btn-danger btn-sm ">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="{{ route('export') }}" class="btn btn-success btn-sm ">
                                    <i class="fa-solid fa-file-csv"></i>
                                </a>

                                <a id="printlabels" class="btn btn-primary btn-sm " >
                                    <i class="fa-solid fa-qrcode"></i>
                                </a>
                               
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <form id="frm-example" method="POST">
                                <table class="table table-striped table-hover" id="tabla" class="display">
                                    <thead class="thead">
                                        <tr>
                                            <th>#Id</th>
                                            <th>Tipo</th>
                                            <th>Model</th>
                                            <th>Serial</th>
                                            <th>Descripcion</th>
                                            <th>Noplaca</th>
                                            <th>Asignada</th>
                                            <th>Marca</th>
                                            <th>Area</th>
                                            
    
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $inventory->id }}</td>
                                                <td>{{ $inventory->typeproduct->name }}</td>
                                                <td>{{ $inventory->model }}</td>
                                                <td>{{ $inventory->serial }}</td>
                                                <td>{{ $inventory->description }}</td>
                                                <td>{{ $inventory->noplaca }}</td>
                                                <td>{{ $inventory->people->first_name. " ".$inventory->people->last_name}}</td>
                                                <td>{{ $inventory->brand->name }}</td>
                                                <td>{{ $inventory->area->name}}</td>
                                                
    
                                                <td>
                                                    
                                                                               
    
                                                        
                                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                                ...
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                                <a class="dropdown-item" href="{{ route('inventory.show',$inventory->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                                <a class="dropdown-item" href="{{ route('inventory.edit',$inventory->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                                <a href="/inventory/delete/{{$inventory->id}}" class="dropdown-item"><i class="fa fa-fw fa-trash"></i>Delete</a>
            
                                       
                                                                <a class="dropdown-item" href="{{ route('printlabel.pdf', $inventory->id) }}"><i class="fa fa-fw fa-print"></i>{{ __('Imprimir Label') }}</a>
                                                                
                                                            </div>
                                                        
              
                                                        
    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>

$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: '¿Está seguro que desea eliminar?',
        text: 'El articulo de inventario pasara a estar desactivado!',
        icon: 'warning',
        buttons: ["No", "Si!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});




    $(document).ready(function () {
        var table = $('#tabla').DataTable({
            'select': {
            style: 'multi'
        },
            order: [[0, 'desc']],
            "language": {
            "lengthMenu": "Mostrar _MENU_ cantidad por pagina",
            "zeroRecords": "Nothing found - sorry",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Buscar",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            }
        }
        });


    $('#tabla tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
 
    $('#printlabels').click(function () {
        alert(table.rows('.selected').data().length + ' row(s) selected');
        for (var i = 0; i < table.rows('.selected').data().length; i++) {
            var selectArray = table.rows('.selected').data()[i][0];
            console.log(selectArray);
            
        }
    });


    });





</script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
@endsection