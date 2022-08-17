@extends('layouts.app')

@section('template_title')
    Update Inventory Transfer
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Inventory Transfer</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inventory-transfers.update', $inventoryTransfer->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('inventory-transfer.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
