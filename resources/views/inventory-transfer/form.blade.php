<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $inventoryTransfer->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('person_old') }}
            {{ Form::text('person_old', $inventoryTransfer->person_old, ['class' => 'form-control' . ($errors->has('person_old') ? ' is-invalid' : ''), 'placeholder' => 'Person Old']) }}
            {!! $errors->first('person_old', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('person_new') }}
            {{ Form::text('person_new', $inventoryTransfer->person_new, ['class' => 'form-control' . ($errors->has('person_new') ? ' is-invalid' : ''), 'placeholder' => 'Person New']) }}
            {!! $errors->first('person_new', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('inventory_id') }}
            {{ Form::text('inventory_id', $inventoryTransfer->inventory_id, ['class' => 'form-control' . ($errors->has('inventory_id') ? ' is-invalid' : ''), 'placeholder' => 'Inventory Id']) }}
            {!! $errors->first('inventory_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>