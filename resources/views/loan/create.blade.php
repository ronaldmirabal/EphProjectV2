@extends('layouts.app')

@section('title')
    Crear Nuevo Prestamo
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
                        <span class="card-title">Crear Nuevo Prestamo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('loan.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="box box-info padding-1">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm">
                                              
                                              <div classs="form-group">
                                                  {{ Form::label('people_id',__('Asignar Persona')) }}
                                                  <input class="typeahead form-control" id="autocompletePeople" type="text" placeholder="Asignar a una Persona">
                                                  {{ Form::hidden('people_id', $loan->people_id, ['class' => 'form-control' . ($errors->has('people_id') ? ' is-invalid' : ''), 'placeholder' => 'people_id']) }}
                                                  {!! $errors->first('people_id', '<div class="invalid-feedback">:message</div>') !!}
                                              </div>
          
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    {{ Form::label('Fecha Estimada de Entrega') }}
                                                    {{ Form::date('estimated_date', $loan->estimated_date, ['class' => 'form-control' . ($errors->has('estimated_date') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Estimanda']) }}
                                                    {!! $errors->first('estimated_date', '<div class="invalid-feedback">:message</div>') !!}
                                                </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            {{ Form::label('Descripción') }}
                                            {{ Form::textarea('description', $loan->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción del prestamo', 'rows' => 4]) }}
                                            {!! $errors->first('estimated_date', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::hidden('user_id', $loan->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'user_id']) }}
                                        </div>

                                        <table class="table" id="products_table">
                                            <thead>
                                                <tr>
                                                    <th>Articulo de Inventario</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="product0">
                                                    <td>
                                                        <select name="products[]" class="form-control">
                                                            <option value="">-- choose product --</option>
                                                            @foreach ($inventories as $product)
                                                                <option value="{{ $product->id }}">
                                                                    {{ $product->noplaca }} ({{ $product->description }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="descriptions[]" class="form-control"/>
                                                    </td>
                                                </tr>
                                                <tr id="product1"></tr>
                                            </tbody>
                                        </table>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                                <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                            </div>
                                        </div>




                                    </div>
                                </div>

                               
                              </div>
                           
                              <div>
                                <input class="btn btn-success btn-lg float-right" type="submit" value="Guardar">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $('#autocompletePeople').autocomplete({
    source: function(request, response){
        $.ajax({
            url: "{{ route('autocompletePeople') }}",
            datatype: 'json',
            data: {
                term: request.term
            },
            success: function(data){
                response(data)
            }
        });
    },
    // Ejecutar cuando se seleccione un cliente
    
    select: function (event, ui) {
          // Set selection
          $('#autocompletePeople').val(ui.item.label); // display the selected text
          $('#people_id').val(ui.item.value); // save selected id to input
          return false;
        }
});


$(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });


  </script>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" ></script>




