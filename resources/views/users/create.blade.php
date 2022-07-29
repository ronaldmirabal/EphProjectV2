@extends('layouts.app')

@section('title')
    Crear Usuario
@endsection

@section('content')

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Crear Usuario</span>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                         @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                         @endforeach
                      </ul>
                    </div>
                  @endif

                  {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
 
        <div class="form-group">
            <strong>Nombre Completo:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>Nombre de Usuario:</strong>
            {!! Form::text('username', null, array('placeholder' => 'Nombre de Usuario','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>


        <div class="form-group">
            <strong>Contraseña:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>


        <div class="form-group">
            <strong>Confirmar Contraseña:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>


        <div class="form-group">
            <strong>Asignar un Rol:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>


        <button type="submit" class="btn btn-primary">Guardar</button>

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@endsection