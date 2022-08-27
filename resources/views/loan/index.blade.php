@extends('layouts.app')

@section('title')
    Prestamos
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
                                {{ __('Prestamos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('loan.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva') }}
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
                            <table class="table table-striped table-hover" id="tabla">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Empleado</th>
                                        <th>Fecha Estimada de Entrega</th>
                                        <th>Articulos Prestados</th>
                                        <th>Entregado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ $loan->id }}</td>
                                            
											<td>{{ $loan->people->first_name. " ".$loan->people->last_name }}</td>
                                            <td>{{ $loan->estimated_date}}</td>
                                            <td>
                                                <ul>
                                                    @foreach($loan->inventories as $item)
                                                        <li>{{ $item->noplaca}} ({{$item->description}})</li>
                                                    @endforeach
                                                    </ul>
                                            </td>
                                            <td>
                                                @if($loan->condition == true)
                                                    <span class="badge badge-success">Entregado</span>
                                                @else
                                                    <span class="badge badge-danger">No Entregado</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('loan.destroy',$loan->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('loan.edit',$loan->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    <a href="{{ route('loan.deliver',$loan->id) }}" class="btn btn-info btn-sm"><i class="fa fa-fw fa-handshake"></i> Entregar</a>
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $('#tabla').DataTable({
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
    });
</script>
@endsection