@extends('layouts.app')

@section('title')
Actualizar Tipo de Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Tipo de Producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('type-products.update', $typeProduct->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('type-product.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
