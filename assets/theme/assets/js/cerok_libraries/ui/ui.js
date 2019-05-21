class Ui {
    static showUserInfo(user) {
        $('#profile_image').attr('src', Session.getBaseUrl() + user.cutedPhoto);
        $('#user_name').text(user.name);
    }

    static loadDashboard() {
        let url = localStorage.getItem('dashboard');

        if (url) {
            url = Session.getBaseUrl() + atob(url);
            $('#iframe_workspace').attr('src', url);
        }
    }

    static putLogo(selector) {
        var logo = localStorage.getItem('logo');

        if (!logo) {
            $.post(
                Session.getBaseUrl() +
                    'app/configuracion/consulta_configuraciones.php',
                {
                    configurations: ['logo']
                },
                function(response) {
                    if (response.success) {
                        localStorage.setItem('logo', response.data[0].value);
                        Ui.putLogo(selector);
                    }
                },
                'json'
            );
        } else {
            if (selector == '#client_image') {
                $(selector).on('load', function() {
                    $(selector).removeAttr('style');

                    if (
                        $(selector)
                            .height(47)
                            .width() > 130
                    ) {
                        $(selector).removeAttr('style');
                        $(selector).width(130);
                    }

                    $(this).removeClass('d-none');
                });
            }

            $(selector).attr('src', Session.getBaseUrl() + logo);
        }
    }

    static putColor() {
        const color = localStorage.getItem('color');

        if (color) {
            $('#instition_style').remove();
            $('head').append(
                $('<style>', {
                    id: 'instition_style',
                    rel: 'stylesheet',
                    type: 'text/css',
                    text: `
                        .btn.bg-institutional:hover{background: ${color} !important;color: #ffff !important; opacity:0.8; border:none}
                        .btn.bg-institutional{border:none}
                        .bg-institutional{background: ${color} !important;color: #ffff !important}
                        .text-institutional{color: ${color} !important;}
                    `
                })
            );
            $("[name='theme-color']").attr('content', color);
        } else {
            $.post(
                Session.getBaseUrl() +
                    'app/configuracion/consulta_configuraciones.php',
                {
                    configurations: ['color_institucional']
                },
                function(response) {
                    if (response.success) {
                        localStorage.setItem('color', response.data[0].value);
                        Ui.putColor();
                    }
                },
                'json'
            );
        }
    }

    static imageAreaSelect() {
        setTimeout(() => {
            $('#img_edit_photo').imgAreaSelect({
                handles: 'corners',
                aspectRatio: '1:1',
                minHeight: 40,
                x1: 0,
                y1: 0,
                x2: 70,
                y2: 70,
                persistent: true
            });
        }, 500);
    }

    static hideImgAreaSelect() {
        let ias = $('#img_edit_photo').imgAreaSelect({ instance: true });
        ias.setOptions({ hide: true });
        ias.update();
    }

    static resizeIframe() {
        let headerHeight = $('#iframe_workspace').offset().top;
        let windowHeight = $(window).height();
        $('#iframe_workspace').height(windowHeight - headerHeight);

        if (!$('#new_action_mobile_container').is(':hidden')) {
            $('#new_action_mobile_container').css({
                top: $('#iframe_workspace').height() - 80,
                left: $('#iframe_workspace').width() - 80
            });
        }

        Ui.setWorkspacePosition();
    }

    static close() {
        Session.close();
        window.location = Session.getBaseUrl() + 'logout.php';
    }

    static inactiveTime() {
        var t;
        document.onclick = resetTimer;

        function logout() {
            top.notification({
                type: 'error',
                message: 'Debe iniciar sesión'
            });

            window.setTimeout(x => Ui.close(), 1000);
        }

        function resetTimer() {
            clearTimeout(t);
            t = setTimeout(logout, 3600000);
        }
    }

    static setWorkspacePosition() {
        let breakpoint = localStorage.getItem('breakpoint');

        if ($.inArray(breakpoint, ['xs', 'sm', 'md']) != -1) {
            $('#workspace').css('position', 'absolute');
        } else {
            $('#workspace').css('position', 'relative');
        }
    }

    static bindServiceWorker() {
        if (navigator.serviceWorker) {
            let route = Session.getBaseUrl() + 'sw.js';
            navigator.serviceWorker
                .register(route)
                .then(function(registration) {
                    console.log(
                        'ServiceWorker registration successful with scope:',
                        registration.scope
                    );
                })
                .catch(function(error) {
                    console.log('ServiceWorker registration failed:', error);
                });
        }
    }

    static bindNotifications() {
        let host = window.location.host;
        let url = `ws://${host}:1000/saia_2019/saia/app/websockets/notificaciones.php`;
        //let url = 'wss://echo.websocket.org';
        let socket = new WebSocket(url);

        socket.onopen = function(e) {
            //indico los datos del usuario al la coneccion
            var msg = {
                userData: {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                }
            };
            //convert and send data to server
            socket.send(JSON.stringify(msg));
        };

        socket.onclose = function(e) {
            alert('close');
        };

        socket.onmessage = function(e) {
            alert('message' + e.data);
        };

        socket.onerror = function(e) {
            alert('error' + e.data);
        };

        $('#client_image').on('click', function() {
            var msg = {
                param1: 'param1',
                param2: 'param2',
                param3: 'param3'
            };
            //convert and send data to server
            socket.send(JSON.stringify(msg));
        });

        $('#profile_image').on('click', function() {
            socket.close();
        });
    }
}
