<div class="box box-info padding-1">
    <div class="form-row">
            <div classs="form-group col-md-6">
                {{ Form::label('inventory_id',__('Inventario')) }}
                <input class="typeahead form-control" id="autocompleteinventory" type="text" placeholder="Buscar Equipo">
                {{ Form::hidden('inventory_id', $removeInventory->inventory_id, ['class' => 'form-control' . ($errors->has('inventory_id') ? ' is-invalid' : ''), 'placeholder' => 'inventory_id']) }}
                {!! $errors->first('inventory_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('Fecha') }}
                {{ Form::date('date', $removeInventory->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
    </div>
           
        
            {{ Form::hidden('user_id', $removeInventory->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'user_id']) }}
        
            <div class="form-group">
            {{ Form::label('Motivo') }}
            {{ Form::select('withdrawallist_id',$withdrawallist, $removeInventory->withdrawallist_id, ['class' => 'form-control' . ($errors->has('withdrawallist_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Motivo']) }}
            {!! $errors->first('withdrawallist_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Detalle') }}
            {{ Form::textarea('description', $removeInventory->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Detalle', 'rows' => '2']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        
        
       
       

   
    <div class="box-footer mt20">
        <br/>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>


  <script>
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
          //getPerson(ui.item.people_id);
          return false;
        }
        });
  </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" ></script>
