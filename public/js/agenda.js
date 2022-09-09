

document.addEventListener('DOMContentLoaded', function() {
  let formulario = document.querySelector("form");
    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:"es",
      displayEventTime:true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      
      eventDidMount: function(info) {
        var tooltip = new Tooltip(info.el, {
          title: info.event.extendedProps.description,
          placement: 'top',
          trigger: 'hover',
          container: 'body'
        });
      },
      eventTimeFormat: { // like '14:30:00'
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
      },
     
      
      events: baseURL+"/event/show",
  
      dateClick: function(info) {
        resetForm();
        $('#start').val(moment(info.date).format("YYYY-MM-DDTHH:mm"));
        $('#end').val(moment(info.date).format("YYYY-MM-DDTHH:mm"));
        $("#event").modal("show");
    },

    eventClick:function (info){
      var event = info.event;
      newUrl = baseURL+"/event/edit/";
      axios.post(newUrl+info.event.id).
      then(
        (respuesta)=>{
          $('#id').val(respuesta.data.id);
          $('#title').val(respuesta.data.title);
          $('#description').val(respuesta.data.description);
          $('#classroom_id').val(respuesta.data.classroom_id);
          $('#people_id').val(respuesta.data.people_id);
          $('#start').val(respuesta.data.start);
          $('#end').val(respuesta.data.end);
          $('#autocompletePeople').val(respuesta.data.people.first_name + " "+ respuesta.data.people.last_name);
        $("#event").modal("show");
      }).catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      )



    }

    });
    calendar.render();

    document.getElementById("btnSave").addEventListener("click", function(){
      let register = {
        id: $('#id').val(),
        title: $('#title').val(),
        description: $('#description').val(),
        start: $('#start').val(),
        end: $('#end').val(),
        classroom_id: $('#classroom_id').val(),
        people_id: $('#people_id').val(),
      }
      sendData("/event/add", register);

    });

    document.getElementById("btnDelete").addEventListener("click", function(){
      let register = {
        id: $('#id').val()
      }
      sendData("/event/delete/"+ register.id, register);
    });


    document.getElementById("filter").addEventListener("click", function(){
     var fil = $('#classroom_id2').val();
      if(fil == ''){
        fil = 0;
      }
      var calendarEl = document.getElementById('agenda');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",
        displayEventTime:false,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        eventTimeFormat: { // like '14:30:00'
          hour: '2-digit',
          minute: '2-digit',
          hour12: true
        },
        eventDidMount: function(info) {
          var tooltip = new Tooltip(info.el, {
            title: info.event.extendedProps.description,
            placement: 'top',
            trigger: 'hover',
            container: 'body'
          });
        },
        
        events: baseURL+"/event/filter/"+ fil,
    
        dateClick: function(info) {
          resetForm();
          $('#start').val(moment(info.date).format("YYYY-MM-DDTHH:mm"));
          $('#end').val(moment(info.date).format("YYYY-MM-DDTHH:mm"));
          $("#event").modal("show");
      },
  
      eventClick:function (info){
        var event = info.event;
        newUrl = baseURL+"/event/edit/";
        axios.post(newUrl+info.event.id).
        then(
          (respuesta)=>{
            $('#id').val(respuesta.data.id);
            $('#title').val(respuesta.data.title);
            $('#description').val(respuesta.data.description);
            $('#classroom_id').val(respuesta.data.classroom_id);
            $('#people_id').val(respuesta.data.people_id);
            $('#start').val(respuesta.data.start);
            $('#end').val(respuesta.data.end);
            $('#autocompletePeople').val(respuesta.data.people.first_name + " "+ respuesta.data.people.last_name);
          $("#event").modal("show");
        }).catch(
          error=>{
            if(error.response){
              console.log(error.response.data);
            }
          }
        )
  
  
  
      }
  
      });
      calendar.render();
    });


    document.getElementById("btnMod").addEventListener("click", function(){
      let register = {
        id: $('#id').val(),
        title: $('#title').val(),
        description: $('#description').val(),
        start: $('#start').val(),
        end: $('#end').val(),
        classroom_id: $('#classroom_id').val(),
        people_id: $('#people_id').val(),
      }
      sendData("/event/update/"+ register.id, register);
    });


     function sendData(url, dat){
      newUrl = baseURL+url;
      axios.post(newUrl, dat).
      then(
        (respuesta)=>{
          calendar.refetchEvents();
        $("#event").modal("hide");
      }).catch(
        error=>{
          if(error.response){
            console.log(error.response.data);
          }
        }
      )
     }


    $('.close').click(function() {
      $("#event").modal('hide');
    });
    $('#btnclose').click(function() {
      $("#event").modal('hide');
    });


    function resetForm() {
      $('#id').val('');
      $('#autocompletePeople').val('');
      $('#classroom_id').val('');
      $('#title').val('');
      $('#description').val('');
    }
  

  });


     
