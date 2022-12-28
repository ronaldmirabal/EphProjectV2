@extends('layouts.app')

@section('title')
    Crear Detalle de Motivo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Detalle de Motivo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('withdrawal-list.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('withdrawal-list.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
