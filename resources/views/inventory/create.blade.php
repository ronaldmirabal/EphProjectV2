@extends('layouts.app')

@section('title')
    Crear Nuevo Inventario
@endsection

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nuevo Inventario</span>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>


                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ route('inventory.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('inventory.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

