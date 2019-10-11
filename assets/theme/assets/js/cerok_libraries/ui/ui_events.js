$(function() {
    var session = new Session();
    var baseUrl = Session.getBaseUrl();
    var xDown = null;
    var yDown = null;

    (function init() {
        if (session.user) {
            Ui.loadDashboard();
            Ui.putLogo('#client_image');
            Ui.showUserInfo(session.user);
            Ui.resizeIframe();
        }
    })();

    $('#btn_logout').on('click', function(event) {
        event.preventDefault();
        Ui.close();
    });

    $('#menu_user_info').mouseleave(function() {
        $('#user_info').trigger('click');
    });

    $('#config_profile').on('click', function() {
        let modal_options = {
            url: `views/funcionario/cambio_datos_personales.php`,
            size: 'modal-lg',
            title: 'Datos Personales'
        };
        topModal(modal_options);
    });

    $('#change_password').on('click', function() {
        let modal_options = {
            url: `views/funcionario/cambiar_clave.php`,
            params: {
                baseUrl: baseUrl
            },
            buttons: {
                success: {
                    label: 'Cambiar la Contraseña',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            },
            size: 'modal-lg',
            title: 'Cambiar Contraseña'
        };
        topModal(modal_options);
    });

    $('#new_action_mobile').on('click', function() {
        let html = `
            <a href="#" class="dropdown-item new_add" data-type="folder">
                <i class="fa fa-folder-open"></i> Expediente
            </a>
            <a href="#" class="dropdown-item new_add" data-type="task">
                <i class="fa fa-calendar-o"></i> Tarea o Recordatorio
            </a>
            <a href="#" class="dropdown-item new_add" data-type="comunication">
                <i class="fa fa-file-text-o"></i> Comunicaciones Oficiales
            </a>
            <a href="#" class="dropdown-item new_add" data-type="process">
                <i class="fa fa-share-alt"></i> Procesos Generales
            </a>
        `;

        let modal_options = {
            content: html,
            buttons: {
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            },
            size: 'modal-sm'
        };
        topModal(modal_options);
    });

    $('#toggle_right_navbar').on('click', function() {
        $('#note_tab').trigger('click');
    });

    $(document).on('click', '.new_add', function() {
        switch ($(this).data('type')) {
            case 'folder':
                newExpediente();
                break;
            case 'task':
                taskAction();
                break;
            case 'comunication':
                newDocument(5, 'Comunicaciones');

                break;
            case 'process':
                newDocument(3, 'Tramites generales');
                break;
        }
    });

    $('.tab-content').on('touchstart', function(evt) {
        xDown = getTouches(evt)[0].clientX;
        yDown = getTouches(evt)[0].clientY;
    });

    $('.tab-content').on('touchmove', function(evt) {
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            /*most significant*/
            if (xDiff > 0) {
                /** right swipe*/
            } else {
                $('#toggle_right_navbar').trigger('click');
            }
        } else {
            if (yDiff > 0) {
                /** up swipe*/
            } else {
                /** Dowsn swipe*/
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    });

    document
        .getElementById('note_content')
        .addEventListener('paste', function(e) {
            // cancel paste
            e.preventDefault();

            // get text representation of clipboard
            var text = (e.originalEvent || e).clipboardData.getData(
                'text/plain'
            );

            // insert text manually
            document.execCommand('insertHTML', false, text);
        });

    function getTouches(evt) {
        return evt.touches || evt.originalEvent.touches;
    }

    window.addEventListener(
        'orientationchange',
        function() {
            setTimeout(() => {
                Ui.resizeIframe();
            }, 500);
        },
        false
    );

    $(window).resize(function() {
        Ui.resizeIframe();
    });

    function newDocument(category, title) {
        var data = JSON.stringify([
            {
                kConnector: 'html.page',
                url: 'views/formatos/listar_proceso_formatos.php',
                kTitle: 'Procesos'
            },
            {
                kConnector: 'html.page',
                url: `views/formatos/listado_categoria.php?idcategoria_formato=${category}`,
                kTitle: title
            }
        ]);

        let route = `${baseUrl}views/dashboard/kaiten_dashboard.php?panels=${data}`;
        $('#iframe_workspace').attr('src', route);
        top.closeTopModal();
    }

    function taskAction() {
        let options = {
            url: `views/tareas/crear.php`,
            centerAlign: false,
            size: 'modal-lg',
            title: 'Tarea o Recordatorio',
            buttons: {}
        };

        top.topModal(options);
    }

    function newExpediente() {
        let options = {
            url: `views/expediente/seleccionar.php`,
            size: 'modal-lg',
            title: 'SELECCIONAR EXPEDIENTE SUPERIOR',
            centerAlign: false,
            buttons: {}
        };
        top.topModal(options);
    }
});
