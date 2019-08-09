$(function() {
    let baseUrl = Session.getBaseUrl();
    let params = JSON.parse($('script[data-params]').attr('data-params'));

    (function init() {
        defineButtonLabel();
        createDatePicker();

        if (!params.id) {
            checkName();
            defaultUser(localStorage.getItem('key'));
        } else {
            findFormData(params.id);
        }
    })();

    $('#manager').select2({
        minimumInputLength: 3,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                };
            },
            processResults: function(response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $('#manager').on('select2:unselect', function(e) {
        let id = e.params.data.id;
        $(this)
            .find(`[value="${id}"]`)
            .remove();
    });

    $(document).on('keyup', '#name', function() {
        checkName();
    });

    $('#save_task').on('click', function() {
        params = JSON.parse($('script[data-params]').attr('data-params'));
        let momentDate = moment($('#final_date').val(), 'DD/MM/YYYY hh:mm a');

        if (momentDate.hour() == 0 && momentDate.minute() == 0) {
            momentDate.set({
                hour: moment().hour(),
                minute: moment().minute(),
                second: moment().second(),
                millisecond: moment().milliseconds()
            });
        }

        let final = momentDate.format('YYYY-MM-DD HH:mm:ss');
        let initial = momentDate
            .subtract(30, 'minutes')
            .format('YYYY-MM-DD HH:mm:ss');

        data = {
            task: params.id || 0,
            key: localStorage.getItem('key'),
            name: $('#name').val(),
            managers: $('#manager').val(),
            notification: $('#send_notification').is(':checked') ? 1 : 0,
            initialDate: initial,
            finalDate: final,
            description: $('#description').val(),
            documentId: params.documentId
        };

        $('#save_task,#spiner').toggle();
        $.post(
            `${baseUrl}app/tareas/guardar.php`,
            data,
            function(response) {
                $('#save_task,#spiner').toggle();

                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });

                    let newParams = JSON.stringify({ id: response.data });
                    $('script[data-params]').attr('data-params', newParams);
                    $('.tasktab.disabled').removeClass('disabled');
                    top.successModalEvent();
                    defineButtonLabel();
                    bindDeleteEvent(0);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    });

    function findFormData(id) {
        $.post(
            `${baseUrl}app/tareas/consulta.php`,
            {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                task: id
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    function fillForm(data) {
        $('#name').val(data.task.nombre);
        let finaldate = moment(
            data.task.fecha_final,
            'YYYY-MM-DD HH:mm:ss'
        ).format('DD/MM/YYYY hh:mm a');
        $('#final_date').val(finaldate);
        $('#description').val(data.task.descripcion);

        data.users.forEach(e => {
            defaultUser(e);
        });
        bindDeleteEvent(data.task.recurrence);
    }

    function defaultUser(userId) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            data: {
                defaultUser: userId,
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            success: function(response) {
                response.data.forEach(u => {
                    var option = new Option(u.text, u.id, true, true);
                    $('#manager')
                        .append(option)
                        .trigger('change');
                });
            }
        });
    }

    function checkName() {
        $('#save_task').attr(
            'disabled',
            $('#name').val().length ? false : true
        );
    }

    function createDatePicker() {
        let time = params.finalTime
            ? moment(params.finalTime, 'YYYY-MM-DD HH:mm:ss')
            : moment();

        $('#final_date').datetimepicker({
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            },
            defaultDate: time,
            widgetParent: $('#modal_body'),
            keepOpen: true,
            locale: 'es',
            format: 'DD/MM/YYYY hh:mm a'
        });

        $('#final_date').on('dp.change', function(e) {
            $(this).trigger('click');
        });
    }

    function defineButtonLabel() {
        params = JSON.parse($('script[data-params]').attr('data-params'));

        if (params.id) {
            $('#delete_task').removeClass('d-none');
            $('#save_task').text('Guardar');
        } else {
            $('#save_task').text('Crear Tarea');
        }
    }

    function bindDeleteEvent(recurrence) {
        $('#delete_task')
            .off('click')
            .on('click', function() {
                var buttons = [];
                if (+recurrence) {
                    buttons = [
                        [
                            '<button>Eliminar Todas las tareas</button>',
                            function(instance, toast) {
                                instance.hide(
                                    { transitionOut: 'fadeOut' },
                                    toast,
                                    'button'
                                );
                                deleteTask(1);
                            }
                        ]
                    ];
                }

                buttons.push(
                    [
                        '<button>Eliminar esta tarea</button>',
                        function(instance, toast) {
                            instance.hide(
                                { transitionOut: 'fadeOut' },
                                toast,
                                'button'
                            );
                            deleteTask(0);
                        },
                        true
                    ],
                    [
                        '<button>Cancelar</button>',
                        function(instance, toast) {
                            instance.hide(
                                { transitionOut: 'fadeOut' },
                                toast,
                                'button'
                            );
                        }
                    ]
                );
                top.confirm({
                    id: 'question',
                    type: 'error',
                    title: 'Eliminando!',
                    position: 'center',
                    timeout: 0,
                    overlay: true,
                    overlayClose: true,
                    closeOnEscape: true,
                    closeOnClick: true,
                    buttons: buttons
                });
            });
    }

    function deleteTask(all) {
        $.post(
            `${baseUrl}app/tareas/eliminar.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                taskId: params.id,
                all: all
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    top.successModalEvent();
                    top.closeTopModal();
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }
});
