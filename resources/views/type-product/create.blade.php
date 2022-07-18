@extends('layouts.app')

@section('title')
Crear Nuevo Tipo de Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nuevo Tipo de Producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('type-products.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('type-product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
