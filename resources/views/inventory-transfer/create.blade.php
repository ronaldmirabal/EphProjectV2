@extends('layouts.app')

@section('template_title')
    Transferencia de Inventario
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
                        <span class="card-title">Nueva Transferencia</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inventory-transfer.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        {{ Form::label('inventory_id', __('Codigo de Inventario')) }}
                                        {{ Form::text('inventory_id', $inventoryTransfer->inventory_id, ['class' => 'typeahead form-control' . ($errors->has('inventory_id') ? ' is-invalid' : ''), 'placeholder' => 'Inventory Id', 'id' => 'autocompleteinventory']) }}
                                        {!! $errors->first('inventory_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::hidden('inventory_id', $inventoryTransfer->inventory_id, ['class' => 'form-control' . ($errors->has('inventory_id') ? ' is-invalid' : ''), 'placeholder' => 'inventory_id','id' => 'inventory_id' ]) }}
                                    </div>
                                    
                                    <div class="form-group">
                                        {{ Form::label('Descripción') }}
                                        {{ Form::text('description', $inventoryTransfer->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
                                        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                        
                                    <div class="form-group">
                                        {{ Form::label('Persona Antigua') }}
                                        {{ Form::text('person_old', $inventoryTransfer->person_old, ['class' => 'form-control' . ($errors->has('person_old') ? ' is-invalid' : ''), 'placeholder' => 'Person Old', 'id' => 'person_old']) }}
                                        {!! $errors->first('person_old', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div classs="form-group">
                                        {{ Form::label('person_new',__('Asignar a Persona')) }}
                                        {{ Form::text('person_new', $inventoryTransfer->person_new, ['class' => 'form-control' . ($errors->has('person_new') ? ' is-invalid' : ''), 'placeholder' => 'Person Old', 'id' => 'autocompletePeople']) }}
                                        {!! $errors->first('person_new', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::hidden('people_id', $inventoryTransfer->people_id, ['class' => 'form-control' . ($errors->has('people_id') ? ' is-invalid' : ''), 'placeholder' => 'people_id','id' => 'people_id' ]) }}
                                    </div>


                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')



<script >
        $('#autocompletePeople').autocomplete({
            source: function (request, response) {
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
            select: function (event, ui) {
          $('#autocompletePeople').val(ui.item.label); // display the selected text
          $('#people_id').val(ui.item.value); // display the selected text
          return false;
        }
        });




        $('#autocompleteinventory').autocomplete({
            source: function (request, response) {
            $.ajax({
            url: "{{ route('autocompleteInventory') }}",
            datatype: 'json',
            data: {
                term: request.term
            },
            success: function(data){
                response(data)
            }
        });
            },
            select: function (event, ui) {
          $('#autocompleteinventory').val(ui.item.label); // display the selected text
          $('#inventory_id').val(ui.item.value)
          getPerson(ui.item.people_id);
          return false;
        }
        });

        function getPerson(id){
            $.ajax({
                url: '{{ route('getPerson') }}?id='+id,
                method: "get",
                dataType: 'json',
                success: function(respuesta) {
                    $('#person_old').val(respuesta[0]['fullname'])
                }
            });


        }


    </script>

@endsection