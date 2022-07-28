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
                                <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm " >
                                    {{ __('Crear Nuevo') }}
                                  </a>
                                <a href="{{ route('inventories.create') }}" class="btn btn-danger btn-sm ">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="{{ route('export') }}" class="btn btn-success btn-sm ">
                                    <i class="fa-solid fa-file-csv"></i>
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
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $inventory->typeproduct->name }}</td>
											<td>{{ $inventory->model }}</td>
											<td>{{ $inventory->serial }}</td>
											<td>{{ $inventory->description }}</td>
											<td>{{ $inventory->noplaca }}</td>
											<td>{{ $inventory->people->first_name. " ".$inventory->people->last_name}}</td>
											<td>{{ $inventory->brand->name }}</td>
											<td>{{ $inventory->area->name}}</td>
											

                                            <td>
                                                <form action="{{ route('inventories.destroy',$inventory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('inventories.show',$inventory->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('inventories.edit',$inventory->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $inventories->links() !!}
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