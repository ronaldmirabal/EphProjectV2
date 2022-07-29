<div class="box box-info padding-1">
    <div class="box-body">
        
    
            <div classs="form-group">
                {{ Form::label('people_id') }}
                <input class="typeahead form-control" id="autocompletePeople" type="text" placeholder="Asignar a una Persona">
                {{ Form::hidden('people_id', $inventory->people_id, ['class' => 'form-control' . ($errors->has('people_id') ? ' is-invalid' : ''), 'placeholder' => 'people_id']) }}
                {!! $errors->first('people_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </br>
           
        <div class="form-group">
            {{ Form::hidden('user_id', $inventory->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'user_id']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::number('stock', $inventory->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Tipo de Producto') }}
            {{ Form::select('type_product_id',$typeproducts, $inventory->type_product_id, ['class' => 'form-control' . ($errors->has('type_product_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Tipo']) }}
            {!! $errors->first('type_product_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
        <div class="form-group">
            {{ Form::label('Marca') }}
            {{ Form::select('brand_id',$brands, $inventory->brand_id, ['class' => 'form-control' . ($errors->has('brand_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Marca']) }}
            {!! $errors->first('brand_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Modelo') }}
            {{ Form::text('model', $inventory->model, ['class' => 'form-control' . ($errors->has('model') ? ' is-invalid' : ''), 'placeholder' => 'Modelo','maxlength'=> '100']) }}
            {!! $errors->first('model', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('serial') }}
            {{ Form::text('serial', $inventory->serial, ['class' => 'form-control' . ($errors->has('serial') ? ' is-invalid' : ''), 'placeholder' => 'Serial', 'maxlength'=> '20']) }}
            {!! $errors->first('serial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripción') }}
            {{ Form::text('description', $inventory->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('noplaca') }}
            {{ Form::text('noplaca', $inventory->noplaca, ['class' => 'form-control' . ($errors->has('noplaca') ? ' is-invalid' : ''), 'placeholder' => 'Noplaca','maxlength'=> '20']) }}
            {!! $errors->first('noplaca', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('color') }}
            {{ Form::text('color', $inventory->color, ['class' => 'form-control' . ($errors->has('color') ? ' is-invalid' : ''), 'placeholder' => 'Color','maxlength'=> '20']) }}
            {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tamaño') }}
            {{ Form::text('size', $inventory->size, ['class' => 'form-control' . ($errors->has('size') ? ' is-invalid' : ''), 'placeholder' => 'Tamaño','maxlength'=> '20']) }}
            {!! $errors->first('size', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
    
        <div class="form-group">
            {{ Form::label('Area') }}
            {{ Form::select('area_id',$areas, $inventory->area_id, ['class' => 'form-control' . ($errors->has('area_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Área']) }}
            {!! $errors->first('area_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       

    </div>
    <div class="box-footer mt20">
        <br/>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>


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
  </script>



