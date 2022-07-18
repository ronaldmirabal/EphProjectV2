@extends('layouts.app')

@section('title')
    Crear Nueva Marca
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nueva Marca</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('brands.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('brand.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
