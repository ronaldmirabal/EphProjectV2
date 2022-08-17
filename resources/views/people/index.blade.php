@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">

    @endsection
@section('title')
    Personas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Personas ') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('people.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Nombre Completo</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Tipo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peoples as $people)
                                        <tr>
                                            <td>{{ ++$i }}</td>                   
											<td>{{ $people->first_name . " " . $people->last_name}}</td>
											<td>{{ $people->email }}</td>
											<td>{{ $people->phone }}</td>
											
											<td>
                                                {{ $people->typePeople->name }}
                                            </td>

                                            <td>
                                                <form action="{{ route('people.destroy',$people->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('people.show',$people->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('people.edit',$people->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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



