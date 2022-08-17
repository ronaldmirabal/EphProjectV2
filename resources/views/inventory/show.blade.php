@extends('layouts.app')

@section('title')
    Detalle de Inventario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalle de Inventario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventory.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $inventory->stock }}
                        </div>
                        <div class="form-group">
                            <strong>Modelo:</strong>
                            {{ $inventory->model }}
                        </div>
                        <div class="form-group">
                            <strong>Serial:</strong>
                            {{ $inventory->serial }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $inventory->description }}
                        </div>
                        <div class="form-group">
                            <strong>Noplaca:</strong>
                            {{ $inventory->noplaca }}
                        </div>
                        <div class="form-group">
                            <strong>Color:</strong>
                            {{ $inventory->color }}
                        </div>
                        <div class="form-group">
                            <strong>Tamaño:</strong>
                            {{ $inventory->size }}
                        </div>
                        <div class="form-group">
                            <strong>Active:</strong>
                            {{ $inventory->active }}
                        </div>
                        <div class="form-group">
                            <strong>Persona Asignada:</strong>
                            {{ $inventory->people->first_name. " ".$inventory->people->last_name }}
                        </div>
                        <div class="form-group">
                            <strong>Marca:</strong>
                            {{ $inventory->brand->name }}
                        </div>
                        <div class="form-group">
                            <strong>Area:</strong>
                            {{ $inventory->area->name }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de Producto:</strong>
                            {{ $inventory->typeproduct->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Historial de Inventario</span>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->description }}</td>
                                            <td>{{ $history->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        
                        
                    
             
            </div>
        </div>
    </section>
@endsection
