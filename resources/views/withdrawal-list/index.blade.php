@extends('layouts.app')

@section('title')
    Detalles de motivos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles de motivos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('withdrawal-list.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo') }}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawalLists as $withdrawalList)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $withdrawalList->name }}</td>

                                            <td>
                                                <form action="{{ route('withdrawal-list.destroy',$withdrawalList->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('withdrawal-list.edit',$withdrawalList->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    
                                                    @method('DELETE')
                                                    @can('Anular Documento')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $withdrawalLists->links() !!}
            </div>
        </div>
    </div>
@endsection
