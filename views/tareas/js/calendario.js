$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $('#calendar').fullCalendar({
        longPressDelay: 300,
        selectLongPressDelay: 500,
        eventDurationEditable: false,
        editable: true,
        defaultView: 'agendaWeek',
        eventTextColor: 'white',
        height: $(window).height() - 20,
        selectable: true,
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
        header: {
            left: 'title',
            right: 'select prev,next,refresh month,agendaWeek,agendaDay,today'
        },
        select: function(start, end) {
            let params = {
                initialTime: start.format('YYYY-MM-DD HH:mm:ss'),
                finalTime: start.format('YYYY-MM-DD HH:mm:ss')
            };
            modalTask(params);
        },
        eventDrop: function(event) {
            updateTask(event);
        },
        eventResize: function(event) {
            updateTask(event);
        },
        eventClick: function(event) {
            modalTask({ id: event.id });
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

    $(document).on('change', '#changeCalendarParams', function(event) {
        $('#calendar').fullCalendar('refetchEvents');
    });

    function getSearchType() {
        if ($('#changeCalendarParams').length) {
            var type = $('#changeCalendarParams').val();
        } else {
            var type = 1;
        }

        return type;
    }

    function modalTask(params) {
        let options = {
            url: `views/tareas/crear.php`,
            params: params,
            title: 'Tarea o Recordatorio',
            centerAlign: false,
            size: 'modal-lg',
            buttons: {},
            onSuccess: function() {
                $('.fc-refresh-button').trigger('click');
            }
        };

        top.topModal(options);
    }

    function updateTask(event) {
        let initialTime = event.start.format('YYYY-MM-DD HH:mm:ss');
        let finalTime = event.end.format('YYYY-MM-DD HH:mm:ss');

        $.post(
            `${baseUrl}app/tareas/guardar.php`,
            {
                initialDate: initialTime,
                finalDate: finalTime,
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                task: event.id
            },
            function(response) {
                if (!response.success) {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    (function defaultOptions() {
        $('<select>', {
            id: 'changeCalendarParams',
            class: 'form-control py-0'
        })
            .css({
                minHeight: '2.1em',
                maxHeight: '2.1em',
                fontSize: '13px',
                width: 'auto'
            })
            .append(
                $('<option>', {
                    value: 1,
                    text: 'Soy Responsable'
                }),
                $('<option>', {
                    value: 2,
                    text: 'Soy Seguidor'
                }),
                $('<option>', {
                    value: 3,
                    text: 'Soy Planeador'
                })
            )
            .insertAfter('.fc-select-button');
        $('.fc-select-button').remove();
        $('.fc-toolbar')
            .find('button')
            .addClass('btn bg-white');

        setTimeout(() => {
            let heightHeader = $('.fc-header-toolbar').height();
            $('.fc-header-toolbar .fc-right')
                .height(heightHeader)
                .addClass('d-flex align-items-center');
        }, 300);
    })();

    (function createPicker() {
        $('#picker').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD',
            defaultDate: new Date()
        });

        $('#picker').on('dp.change', function(e) {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
            $('#calendar').fullCalendar('gotoDate', $(this).val());
        });

        $('.fc-left')
            .on('click', function() {
                $('#picker')
                    .data('DateTimePicker')
                    .show();
            })
            .addClass('cursor');

        $('*:not(.fc-left)').on('click', function(e) {
            if (
                $('.fc-left').length &&
                !$(e.target).parents('.fc-left').length
            ) {
                $('#picker')
                    .data('DateTimePicker')
                    .hide();
            }
        });
    })();
});
