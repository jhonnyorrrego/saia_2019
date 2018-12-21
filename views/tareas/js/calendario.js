$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#calendar').fullCalendar({
        longPressDelay:300,
        selectLongPressDelay: 500,
        editable: true,
        customButtons: {
            refresh: {
                icon: 'clockwise-arrow',
                click: function() {
                    $('#calendar').fullCalendar('refetchEvents');
                }
            }
        },
        header:{
            left:   'title',
            center: '',
            right:  'prev,next,refresh month,agendaWeek,agendaDay,today'
        },
        defaultView: 'agendaWeek',
        height:'parent',
        selectable: true,        
        select: function( start, end){
            addTask(arguments);
        },
        eventDrop: function( event ) {
            updateTask(event);
        },
        eventResize: function( event ) {
            updateTask(event);
        },
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: `${baseUrl}app/tareas/funcionario.php`,
                dataType: 'json',
                data: {
                    initialDate: start.format('YYYY-MM-DD HH:mm:ss'),
                    finalDate: end.format('YYYY-MM-DD HH:mm:ss'),
                    key: localStorage.getItem('key')
                },
                success: function(response) {                    
                    callback(response.data);
                }
            });
        }
    });

    function addTask(times){
        let initialTime = times[0].format('YYYY-MM-DD HH:mm:ss');
        let finalTime = times[1].format('YYYY-MM-DD HH:mm:ss');
        
        let options = {
            url: `${baseUrl}views/tareas/crear.php`,
            params: {
                initialTime: initialTime,
                finalTime: finalTime
            },
            centerAlign:false,
            size: "modal-lg",
            title: "Crear una tarea o recordatorio",
        };

        top.topModal(options);
    }

    function updateTask(event){
        let initialTime = event.start.format('YYYY-MM-DD HH:mm:ss');
        let finalTime = event.end.format('YYYY-MM-DD HH:mm:ss');
        
        $.post(`${baseUrl}app/tareas/guardar.php`,{
            initialDate: initialTime,
            finalDate: finalTime,
            key: localStorage.getItem('key'),
            task: event.id
        }, function(response){
            if(!response.success){
                top.notification({
                    type: 'error',
                    message: response.message
                })
            }
        }, 'json')
    }
});