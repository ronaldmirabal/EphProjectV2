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
                            <a class="btn btn-primary" href="{{ route('inventories.index') }}"> Regresar</a>
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
@endsection
