<div class="box box-info padding-1">
    <div class="box-body">
        
    
            <div classs="form-group">
                <input type="text" name="search" placeholder="Search" class="typeahead form-control" />
                <input type="hidden" id="people_id" name="people_id" value="">
            </div>

        

        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::number('stock', $inventory->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Marca') }}
            {{ Form::select('brand_id',$brands, $inventory->brand_id, ['class' => 'form-control' . ($errors->has('brand_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Marca']) }}
            {!! $errors->first('brand_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Modelo') }}
            {{ Form::text('model', $inventory->model, ['class' => 'form-control' . ($errors->has('model') ? ' is-invalid' : ''), 'placeholder' => 'Modelo']) }}
            {!! $errors->first('model', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('serial') }}
            {{ Form::text('serial', $inventory->serial, ['class' => 'form-control' . ($errors->has('serial') ? ' is-invalid' : ''), 'placeholder' => 'Serial']) }}
            {!! $errors->first('serial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripción') }}
            {{ Form::text('description', $inventory->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('noplaca') }}
            {{ Form::text('noplaca', $inventory->noplaca, ['class' => 'form-control' . ($errors->has('noplaca') ? ' is-invalid' : ''), 'placeholder' => 'Noplaca']) }}
            {!! $errors->first('noplaca', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('color') }}
            {{ Form::text('color', $inventory->color, ['class' => 'form-control' . ($errors->has('color') ? ' is-invalid' : ''), 'placeholder' => 'Color']) }}
            {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tamaño') }}
            {{ Form::text('size', $inventory->size, ['class' => 'form-control' . ($errors->has('size') ? ' is-invalid' : ''), 'placeholder' => 'Tamaño']) }}
            {!! $errors->first('size', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
     
        
       
        <div class="form-group">
            {{ Form::label('Area') }}
            {{ Form::select('area_id',$areas, $inventory->area_id, ['class' => 'form-control' . ($errors->has('area_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Área']) }}
            {!! $errors->first('area_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de Producto') }}
            {{ Form::select('type_product_id',$typeproducts, $inventory->type_product_id, ['class' => 'form-control' . ($errors->has('type_product_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Tipo']) }}
            {!! $errors->first('type_product_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <br/>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>


  <script>
    var path = "{{ route('autocompletePeople')  }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { term: query }, function (data) {
                return process(data);
            });
        }
    });
    $('input.typeahead').bind('typeahead:select', function(ev, suggestion) {
            $('#people_id').val(suggestion.id);
        });
  </script>



