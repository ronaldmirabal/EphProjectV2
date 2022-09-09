@extends('layouts.app')

@section('title')
Agenda
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>

.popper,
.tooltip {
  position: absolute;
  z-index: 9999;
  background: #FFC107;
  color: black;
  width: 150px;
  border-radius: 3px;
  box-shadow: 0 0 2px rgba(0,0,0,0.5);
  padding: 10px;
  text-align: center;
}
.style5 .tooltip {
  background: #1E252B;
  color: #FFFFFF;
  max-width: 200px;
  width: auto;
  font-size: .8rem;
  padding: .5em 1em;
}
.popper .popper__arrow,
.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
}

.tooltip .tooltip-arrow,
.popper .popper__arrow {
  border-color: #FFC107;
}
.style5 .tooltip .tooltip-arrow {
  border-color: #1E252B;
}
.popper[x-placement^="top"],
.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}
.popper[x-placement^="top"] .popper__arrow,
.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.popper[x-placement^="bottom"],
.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}
.tooltip[x-placement^="bottom"] .tooltip-arrow,
.popper[x-placement^="bottom"] .popper__arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent;
  border-right-color: transparent;
  border-top-color: transparent;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}
.tooltip[x-placement^="right"],
.popper[x-placement^="right"] {
  margin-left: 5px;
}
.popper[x-placement^="right"] .popper__arrow,
.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent;
  border-top-color: transparent;
  border-bottom-color: transparent;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}
.popper[x-placement^="left"],
.tooltip[x-placement^="left"] {
  margin-right: 5px;
}
.popper[x-placement^="left"] .popper__arrow,
.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}





.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1051 !important;
  float: left;
  display: none;
  min-width: 160px;
  _width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}

</style>
@endsection

@section('content')

    <div class="container">


      <div class="input-group mb-3">
        {{ Form::select('classroom_id',$classrooms, $event->classroom_id, ['class' => 'form-control' . ($errors->has('classroom_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Aula', 'id' =>'classroom_id2']) }}
        <div class="input-group-append">
          <button id="filter" class="input-group-text">Filtrar</button>
        </div>
      </div>

     
        <div id="agenda">
        </div>    
    </div>


    <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="close" aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        {!! csrf_field() !!}
                        

                        <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" class="form-control" name="title" id="title"  placeholder="Escribe el titulo del evento">
                          </div>
  
                          <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                          </div>

                        <div class="form-group">
                            {{ Form::label('Aula') }}
                            {{ Form::select('classroom_id',$classrooms, $event->classroom_id, ['class' => 'form-control' . ($errors->has('classroom_id') ? ' is-invalid' : ''), 'placeholder' => 'Asignar Aula', 'id' =>'classroom_id']) }}
                            {!! $errors->first('classroom_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div classs="form-group">
                            {{ Form::label('people_id',__('Asignar Persona')) }}
                            <input class="typeahead form-control" id="autocompletePeople" type="text" placeholder="Asignar a una Persona">
                            {{ Form::hidden('people_id', $event->people_id, ['class' => 'form-control' . ($errors->has('people_id') ? ' is-invalid' : ''), 'placeholder' => 'people_id']) }}
                            {!! $errors->first('people_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>


                       
                        <div class="form-group">
                          <label for="start">Inicio</label>
                          <input type="datetime-local" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="end">Fin</label>
                            <input type="datetime-local" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnclose" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnDelete" class="btn btn-danger">Eliminar</button>
                    <button type="button" id="btnMod" class="btn btn-warning">Modificar</button>
                    <button type="button" id="btnSave" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/agenda.js') }}" ></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
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


@endsection




