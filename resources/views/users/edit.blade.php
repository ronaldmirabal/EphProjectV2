@extends('layouts.app')

@section('title')
Crear Nuevo Usuario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nuevo Usuario</span>
                    </div>
                    <div class="card-body">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        {{ Form::label('Nombre Completo') }}
                                        {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                            
                                    <div class="form-group">
                                        {{ Form::label('Username') }}
                                        {{ Form::text('username', $user->username, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de Usuario']) }}
                                        {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                            
                                    <div class="form-group">
                                        {{ Form::label('Correo Electronico') }}
                                        {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
                                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                            
                                    <div class="form-group">
                                        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
                                        @foreach ($roles as $role)
                                            <div>
                                                <label>
                                                {!! Form::checkbox('roles[]', $role->id, null, ['class'=> 'mr-1'])!!}
                                                {{$role->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                       {!! Form::close() !!}
                                    </div>
                            
                                </div>
                                <div class="box-footer mt20">
                                </br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
