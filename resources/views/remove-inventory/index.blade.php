@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

    @endsection
@section('title')
    Equipos retirados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Equipos retirados ') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('remove-inventory.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
										<th>Tipo</th>
										<th>Modelo</th>
										<th>Serial</th>
										<th>NoPlaca</th>
                                        <th>Motivo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($removeInventories as $removeInventory)
                                        <tr>
                                            <td>{{ ++$i }}</td>                   
											<td>{{ $removeInventory->inventories->typeproduct->name}}</td>
											<td>{{ $removeInventory->inventories->model}}</td>
											<td>{{ $removeInventory->inventories->serial}}</td>
											
                                            <td>{{ $removeInventory->inventories->noplaca}}</td>

                                            <td>{{ $removeInventory->withdrawallist->name}}</td>

                                            <td>
                                                <form action="{{ route('remove-inventory.destroy',$removeInventory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('remove-inventory.show',$removeInventory->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('remove-inventory.edit',$removeInventory->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
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
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tabla').DataTable({
            order: [[1, 'desc']],
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



