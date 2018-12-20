$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#calendar').fullCalendar({
        customButtons: {
            refresh: {
                text: 'custom!',
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
});