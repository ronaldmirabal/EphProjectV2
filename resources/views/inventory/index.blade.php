@extends('layouts.app')

@section('template_title')
    Inventory
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inventory') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        
										<th>Stock</th>
										<th>Model</th>
										<th>Serial</th>
										<th>Description</th>
										<th>Noplaca</th>
										<th>Color</th>
										<th>Size</th>
										<th>Active</th>
										<th>People Id</th>
										<th>Brand Id</th>
										<th>Area Id</th>
										<th>Type Product Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $inventory->stock }}</td>
											<td>{{ $inventory->model }}</td>
											<td>{{ $inventory->serial }}</td>
											<td>{{ $inventory->description }}</td>
											<td>{{ $inventory->noplaca }}</td>
											<td>{{ $inventory->color }}</td>
											<td>{{ $inventory->size }}</td>
											<td>{{ $inventory->active }}</td>
											<td>{{ $inventory->people_id }}</td>
											<td>{{ $inventory->brand_id }}</td>
											<td>{{ $inventory->area_id }}</td>
											<td>{{ $inventory->type_product_id }}</td>

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
