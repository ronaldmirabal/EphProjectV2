@extends('layouts.app')

@section('title')
    Tipo de Personas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo de Personas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('type-people.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Name</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($typePeoples as $typePeople)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $typePeople->name }}</td>

                                            <td>
                                                <form action="{{ route('type-people.destroy',$typePeople->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('type-people.edit',$typePeople->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $typePeoples->links() !!}
            </div>
        </div>
    </div>
@endsection
