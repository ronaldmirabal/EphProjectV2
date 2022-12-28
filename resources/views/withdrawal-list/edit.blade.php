@extends('layouts.app')

@section('title')
    Actualizar Detalle de Motivo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Detalle de Motivo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('withdrawal-list.update', $withdrawalList->id) }}">
                            @csrf
                            @method('PUT')
                            @include('withdrawal-list.form')
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
