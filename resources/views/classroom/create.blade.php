@extends('layouts.app')

@section('title')
    Crear nueva aula
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear nueva aula</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('classroom.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('classroom.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
