$(function() {
    let params = $('[data-headerparams]').data('headerparams');
    let baseUrl = params.baseUrl;
    let documentId = params.documentId;
    let number = params.number;
    let owner = undefined;
    let fabActions = new Object();
    $('[data-headerparams]').removeAttr('data-headerparams');

    (function init() {
        toggleGoBack();
        showFlag();
        findActions();
        findCounters();
        findMenu();
        checkRouteNotification();

        setTimeout(() => {
            $('[data-toggle="tooltip"]').tooltip();
        }, 2000);
    })();

    $('#go_back').on('click', function() {
        $('#mailbox,#right_workspace').toggleClass('d-none');
    });

    $(document)
        .off('click', '#show_comments,#discutir_documento')
        .on('click', '#show_comments,#discutir_documento', function() {
            let options = {
                url: `${baseUrl}views/documento/comentarios.php`,
                params: {
                    documentId: documentId
                },
                title: 'Comentarios',
                size: 'modal-lg',
                buttons: {}
            };
            top.topModal(options);
        });

    $(document)
        .off('click', '#show_documents,#vincular_otro_documento')
        .on('click', '#show_documents,#vincular_otro_documento', function() {
            let iframe = $('<iframe>', {
                src: `${baseUrl}views/documento/vinculados.php?documentId=${documentId}`
            }).css({
                width: '100%',
                height: '100%',
                border: 'none'
            });

            top.topJsPanel({
                headerTitle: 'Documentos vinculados',
                contentSize: {
                    width: $(window).width() * 0.8,
                    height: $(window).height() * 0.9
                },
                content: iframe.prop('outerHTML')
            });
        });

    $(document)
        .off('click', '#resend,#reenviar')
        .on('click', '#resend,#reenviar', function() {
            transferModal('Reenviar', 1);
        });

    $(document)
        .off('click', '#reply,#responder')
        .on('click', '#reply,#responder', function() {
            let userInfo = $('#userInfo').data('info');
            transferModal('Responder', 2, userInfo);
        });

    $(document)
        .off('click', '#responder_todos')
        .on('click', '#responder_todos', function() {
            transferModal('Responder a todos', 3);
        });

    ///////////// fab buttons
    $(document)
        .off('click', '#confirmButton,#rejectButton')
        .on('click', '#confirmButton,#rejectButton', function() {
            confirmDocument($(this).data('info').action);
        });

    $(document)
        .off('click', '#editButton')
        .on('click', '#editButton', function() {
            window.open($(this).data('info').route, '_self');
        });

    $(document)
        .off('click', '#managersButton')
        .on('click', '#managersButton', function() {
            seeManagers();
        });

    $(document)
        .off('click', '#returnButton')
        .on('click', '#returnButton', function() {
            returnDocument();
        });
    //////////// fin fab buttons

    $('#show_tree').on('click', function() {
        let options = {
            url: `${baseUrl}views/arbol/proceso_formato.php`,
            params: {
                documentId: documentId
            },
            title: 'Proceso',
            size: 'modal-sm',
            buttons: {
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            }
        };
        top.topModal(options);
    });

    $('#show_task').on('click', function() {
        let options = {
            url: `${baseUrl}views/tareas/lista_documento.php`,
            params: {
                documentId: documentId
            },
            title: 'Tareas',
            buttons: {
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            }
        };
        top.topModal(options);
    });

    $('#priority_flag').on('click', function() {
        let flag = $('#priority_flag i'),
            priority = flag.hasClass('text-danger') ? 0 : 1,
            key = localStorage.getItem('key');

        $.post(
            `${baseUrl}app/documento/asignar_prioridad.php`,
            {
                priority: priority,
                selections: documentId,
                key: key
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });

                    if (priority) {
                        flag.addClass('text-danger');
                        $(
                            `#table .priority_flag[data-key=${documentId}]`
                        ).removeClass('d-none');
                    } else {
                        flag.removeClass('text-danger');
                        $(
                            `#table .priority_flag[data-key=${documentId}]`
                        ).addClass('d-none');
                    }
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            },
            'json'
        );
    });

    window.addEventListener(
        'orientationchange',
        function() {
            setTimeout(() => {
                toggleGoBack();
            }, 500);
        },
        false
    );

    $(window).resize(function() {
        toggleGoBack();
    });

    /////// MENU INTERMEDIO ////////
    $(document)
        .off('click', '#crear_tarea')
        .on('click', '#crear_tarea', function() {
            let route = $(this).data('url');
            top.topModal({
                url: `${baseUrl + route}`,
                title: $(this).text(),
                centerAlign: false,
                size: 'modal-lg',
                params: {
                    documentId: documentId
                },
                buttons: {}
            });
        });

    $(document)
        .off('click', '#etiquetar,#asignar_responsable')
        .on('click', '#etiquetar,#asignar_responsable', function() {
            let route = $(this).data('url');
            top.topModal({
                url: `${baseUrl + route}`,
                title: $(this).text(),
                centerAlign: false,
                params: {
                    documentId: documentId
                },
                buttons: {}
            });
        });

    $(document)
        .off('click', '#solicitar_aprobacion')
        .on('click', '#solicitar_aprobacion', function() {
            seeManagers();
        });

    $(document)
        .off('click', '#crear_nueva_version')
        .on('click', '#crear_nueva_version', function() {
            $.post(
                `${baseUrl}app/documento/autorizacion_versionamiento.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    documentId: documentId,
                    userId: localStorage.getItem('key')
                },
                function(response) {
                    if (response.success) {
                        showVersionConfirm();
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

    $(document)
        .off('click', '#privacidad')
        .on('click', '#privacidad', function() {
            let route = $(this).data('url');
            top.topModal({
                url: baseUrl + route,
                title: $(this).text(),
                size: 'modal-lg',
                params: {
                    type: 'TIPO_DOCUMENTO',
                    typeId: documentId
                },
                buttons: {}
            });
        });

    $(document)
        .off('click', '#actualizar_pdf')
        .on('click', '#actualizar_pdf', function() {
            let route = $('#acordeon_container').attr('data-location');
            route += '&actualizar_pdf=1';

            $('#view_document').load(baseUrl + route);
        });

    $(document)
        .off('click', '#imprimir')
        .on('click', '#imprimir', function() {
            let route = $('#acordeon_container').attr('data-location');
            route += '&mostrar_pdf=1';

            $('#view_document').load(baseUrl + route);
        });

    $(document)
        .off('click', '#anexos')
        .on('click', '#anexos', function() {
            $('#show_files').click();
        });

    $(document)
        .off('click', '#anular_documento')
        .on('click', '#anular_documento', function() {
            cancelNotification();
        });
    /////// FIN MENU INTERMEDIO /////

    function toggleGoBack() {
        if ($('#mailbox').is(':hidden')) {
            $('#go_back').show();
        } else {
            $('#go_back').hide();
        }
    }

    function showFlag() {
        if ($('#document_information .priority').is(':hidden')) {
            $('#document_information .priority')
                .removeClass('text-danger')
                .show();
        }
    }

    function transferModal(title, type, userInfo) {
        let options = {
            url: `${baseUrl}views/documento/reenviar.php`,
            params: {
                documentId: documentId,
                userInfo: userInfo,
                type: type
            },
            title: title,
            size: 'modal-lg',
            buttons: {
                success: {
                    label: 'Enviar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            }
        };
        top.topModal(options);
    }

    function findActions() {
        $.post(
            `${baseUrl}app/documento/eventos_fab.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: documentId
            },
            function(response) {
                if (response.success) {
                    fabActions = response.data;
                    showFab();
                } else {
                    console.error('error al mostrar las acciones');
                }
            },
            'json'
        );
    }

    function showFab() {
        $('#fab').empty();

        if (Object.values(fabActions).find(b => b.button.visible == 1)) {
            new Fab({
                selector: '#fab',
                button: {
                    style: 'blue',
                    html: ''
                },
                icon: {
                    style: 'fa fa-arrow-left',
                    html: ''
                },
                // "top-left" || "top-right" || "bottom-left" || "bottom-right"
                position: 'bottom-right',
                // "horizontal" || "vertical"
                direction: 'horizontal',
                buttons: fabActions
            });
        }
    }

    function confirmDocument(accept) {
        $.post(
            `${baseUrl}app/documento/confirmar.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: documentId,
                reject: !accept ? 1 : 0
            },
            function(response) {
                if (response.success) {
                    let route = baseUrl + 'views/documento/acordeon.php';
                    $('#acordeon_container')
                        .parent()
                        .load(route, {
                            documentId: documentId
                        });
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

    function seeManagers() {
        top.topModal({
            url: baseUrl + fabActions.managers.button.data.route,
            params: {
                documentId: documentId,
                number: number
            },
            size: 'modal-xl',
            title: 'Ruta actual asignada al documento',
            buttons: {},
            onSuccess: function() {
                findActions();
            },
            beforeShow: function(event) {
                if (!isOwner()) {
                    event.preventDefault();
                    top.notification({
                        type: 'error',
                        message: 'No es posible realizar esta acción'
                    });
                }
            }
        });
    }

    function isOwner() {
        if (typeof owner == 'undefined') {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                async: false,
                url: `${baseUrl}app/documento/verificar_responsabilidad.php`,
                data: {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    documentId: documentId,
                    userId: localStorage.getItem('key')
                },
                success: function(response) {
                    if (response.success) {
                        owner = response.data;
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                }
            });
        }

        return owner;
    }

    function findMenu() {
        $.post(
            `${baseUrl}app/documento/menu_intermedio.php`,
            {
                key: localStorage.getItem('key'),
                documentId: documentId
            },
            function(response) {
                if (response.success) {
                    createMenu(response.data);
                } else {
                    console.error('error al crear el menu');
                }
            },
            'json'
        );
    }

    function createMenu(data) {
        data.forEach(m => {
            $('#module_items').append(
                $('<span>', {
                    id: m.nombre,
                    class: 'dropdown-item menu_options text-truncate cursor',
                    style: 'line-height:28px;',
                    'data-url': m.enlace
                })
                    .append(
                        $('<i>', {
                            class: `${m.imagen} px-1`
                        })
                    )
                    .append(m.etiqueta)
            );
        });
    }

    function findCounters() {
        $.post(
            `${baseUrl}app/documento/contadores_encabezado.php`,
            {
                key: localStorage.getItem('key'),
                documentId: documentId
            },
            function(response) {
                if (response.success) {
                    showCounters(response.data);
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

    function showCounters(data) {
        if (data.comments) {
            $('#comments_counter').text(data.comments);
        }

        if (data.tasks) {
            $('#tasks_counter').text(data.tasks);
        }

        if (data.documents) {
            $('#documents_counter').text(data.documents);
        }
    }

    function storage() {
        $.post(
            `${baseUrl}app/documento/versionar.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: documentId
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
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

    function showVersionConfirm() {
        top.confirm({
            id: 'question',
            type: 'warning',
            title: 'Versionar!',
            message: 'Está seguro de versionar este documento?',
            position: 'center',
            timeout: 0,
            buttons: [
                [
                    '<button><b>Si</b></button>',
                    function(instance, toast) {
                        storage();
                        top.notification({
                            type: 'info',
                            message: 'Esto puede tardar un momento'
                        });
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    }
                ]
            ]
        });
    }

    function checkRouteNotification() {
        if (!+number && isOwner()) {
            $.post(
                `${baseUrl}app/documento/alerta_ruta.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    documentId: documentId,
                    userId: localStorage.getItem('key')
                },
                function(response) {
                    if (response.success) {
                        if (response.data.show) {
                            showRouteAlert(response.message);
                        }
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
    }

    function showRouteAlert(message) {
        top.confirm({
            id: 'question',
            type: 'info',
            message: message,
            position: 'topRight',
            timeout: 5000,
            buttons: [
                [
                    '<button><b>No volver a mostrar esta alerta en este documento</b></button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                        removeRouteAlerts();
                    },
                    true
                ]
            ]
        });
    }

    function removeRouteAlerts() {
        $.post(
            `${baseUrl}app/documento/omitir_alertas_ruta.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: localStorage.getItem('key'),
                documentId: documentId
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

    function returnDocument() {
        top.topModal({
            url: `${baseUrl}views/documento/devolver.php`,
            params: {
                documentId: documentId
            },
            size: 'modal-xl',
            title: 'Devolver documento',
            onSuccess: function() {
                findActions();
            }
        });
    }

    function cancelNotification() {
        if (!isOwner()) {
            top.notification({
                type: 'error',
                message: 'No puedes realizar esta acción'
            });

            return;
        }

        top.confirm({
            timeout: 20000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 9999,
            title: 'Anular documento',
            message:
                'Debe indicar una observación. Recuerde, esta acción no se podrá revertir',
            position: 'center',
            drag: false,
            type: 'warning',
            inputs: [
                [
                    '<input type="text" id="cancel_observation">',
                    'keyup',
                    () => {
                        return true;
                    },
                    true
                ]
            ],
            buttons: [
                [
                    '<button>Cancelar</button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    }
                ],
                [
                    '<button><b>Anular</b></button>',
                    function(instance, toast) {
                        var input = $(toast).find('#cancel_observation');
                        let observation = input.val();
                        cancelDocument(observation);
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    },
                    true
                ]
            ]
        });
    }

    function cancelDocument(observation) {
        $.post(
            `${baseUrl}app/documento/anular.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: documentId,
                observation: observation
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
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
