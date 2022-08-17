@extends('layouts.app')

@section('template_title')
    {{ $inventoryTransfer->name ?? 'Show Inventory Transfer' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Inventory Transfer</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventory-transfer.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $inventoryTransfer->description }}
                        </div>
                        <div class="form-group">
                            <strong>Person Old:</strong>
                            {{ $inventoryTransfer->person_old }}
                        </div>
                        <div class="form-group">
                            <strong>Person New:</strong>
                            {{ $inventoryTransfer->person_new }}
                        </div>
                        <div class="form-group">
                            <strong>Inventory Id:</strong>
                            {{ $inventoryTransfer->inventory_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
