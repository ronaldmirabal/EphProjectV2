@extends('layouts.app')

@section('title')
Transferencia de Inventario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Transferencia de Inventario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inventory-transfer.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva') }}
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
                                        
										<th>Descripción</th>
										<th>Person Antigua</th>
										<th>Persona Nueva</th>
										<th>Id Inventario</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventoryTransfers as $inventoryTransfer)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $inventoryTransfer->description }}</td>
											<td>{{ $inventoryTransfer->person_old }}</td>
											<td>{{ $inventoryTransfer->person_new }}</td>
											<td>{{ $inventoryTransfer->inventory_id }}</td>

                                            <td>
                                                <form action="{{ route('inventory-transfer.destroy',$inventoryTransfer->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('inventory-transfer.show',$inventoryTransfer->id) }}"><i class="fa fa-fw fa-print"></i> Imprimir</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('inventory-transfer.edit',$inventoryTransfer->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $inventoryTransfers->links() !!}
            </div>
        </div>
    </div>
@endsection
