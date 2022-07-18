@extends('layouts.app')

@section('template_title')
    {{ $inventory->name ?? 'Show Inventory' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Inventory</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventories.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $inventory->stock }}
                        </div>
                        <div class="form-group">
                            <strong>Model:</strong>
                            {{ $inventory->model }}
                        </div>
                        <div class="form-group">
                            <strong>Serial:</strong>
                            {{ $inventory->serial }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
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
                            <strong>Size:</strong>
                            {{ $inventory->size }}
                        </div>
                        <div class="form-group">
                            <strong>Active:</strong>
                            {{ $inventory->active }}
                        </div>
                        <div class="form-group">
                            <strong>People Id:</strong>
                            {{ $inventory->people_id }}
                        </div>
                        <div class="form-group">
                            <strong>Brand Id:</strong>
                            {{ $inventory->brand_id }}
                        </div>
                        <div class="form-group">
                            <strong>Area Id:</strong>
                            {{ $inventory->area_id }}
                        </div>
                        <div class="form-group">
                            <strong>Type Product Id:</strong>
                            {{ $inventory->type_product_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
