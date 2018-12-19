$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#calendar').fullCalendar({
        header:{
            left:   'title',
            center: '',
            right:  'prev,next month,agendaWeek,agendaDay,today'
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
                dataType: 'xml',
                data: {
                    start: start.unix(),
                    end: end.unix(),
                    key: localStorage.getItem('key')
                },
                success: function(response) {
                    console.log(response);
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