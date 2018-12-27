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
            },
            select: {
                icon: 'clockwise-arrow',
                click: function() {
                    console.log(1);
                }
            }
        },
        header:{
            left:   'title',
            center: 'select',
            right:  'prev,next,refresh month,agendaWeek,agendaDay,today'
        },
        defaultView: 'agendaWeek',
        height:'parent',
        selectable: true,        
        select: function( start, end){
            let params = {
                initialTime: start.format('YYYY-MM-DD HH:mm:ss'),
                finalTime: end.format('YYYY-MM-DD HH:mm:ss')
            };
            modalTask(params);
        },
        eventDrop: function( event ) {
            updateTask(event);
        },
        eventResize: function( event ) {
            updateTask(event);
        },
        eventClick: function( event ) {
            modalTask({id: event.id});
        },
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: `${baseUrl}app/tareas/funcionario.php`,
                dataType: 'json',
                data: {
                    serachtype: getSearchType(),
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

    $(document).on("change", "#changeCalendarParams", function(event) {
        $('#calendar').fullCalendar('refetchEvents'); 
    });

    function getSearchType(){
        if($("#changeCalendarParams").length){
            var type = $("#changeCalendarParams").val();
        }else{
            var type = 1;
        }

        return type;
    }

    function modalTask(params){
        let options = {
            url: `${baseUrl}views/tareas/crear.php`,
            params: params,
            centerAlign:false,
            size: "modal-lg",
            buttons: {}
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

    (function defaultOptions(){
        $('.fc-select-button').parent().append(
            $('<select>', {
                id: 'changeCalendarParams',
                class: 'btn py-1'
            }).append(
                $('<option>',{
                    value: 1,
                    text: 'Soy Responsable'
                }),
                $('<option>',{
                    value: 2,
                    text: 'Soy Seguidor'
                }),
                $('<option>',{
                    value: 3,
                    text: 'Soy Planeador'
                })
            )
        );
        $('.fc-select-button').remove();
        $('.fc-toolbar').find('button').addClass('btn');
    })();
});