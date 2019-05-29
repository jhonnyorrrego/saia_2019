class Notification {
    constructor(options) {
        this.options = options;
        this.init();
    }

    set options(data) {
        this._options = data;
    }

    get options() {
        return this._options;
    }

    set total(total) {
        this._total = total;
        $(this.options.counterSelector).text(this.total ? this.total : '');
    }

    get total() {
        return this._total || 0;
    }

    set notifications(data) {
        this._notifications = data;
    }

    get notifications() {
        return this._notifications || [];
    }

    init() {
        this.findNotifications();
        this.createWebSocket();
    }

    findNotifications() {
        let _this = this;
        $.post(
            `${
                _this.options.baseUrl
            }app/notificaciones/total_pendientes_leer.php`,
            {
                key: _this.options.key,
                token: _this.options.token,
                userId: _this.options.key
            },
            function(response) {
                if (response.success) {
                    _this.total = response.data.total;
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

    createWebSocket() {
        let _this = this;
        let url = this.getSocketRoute();
        //let url = 'wss://echo.websocket.org';
        window.socket = new WebSocket(url);

        window.socket.onopen = function(e) {
            //indico los datos del usuario al la conexion
            var data = {
                action: 'userData',
                userData: {
                    key: _this.options.key,
                    token: _this.options.token
                }
            };
            //convert and send data to server
            window.socket.send(JSON.stringify(data));
        };

        window.socket.onmessage = function(e) {
            let message = JSON.parse(e.data);
            _this.processMessage(message);
        };

        window.socket.onclose = function(e) {
            top.notification({
                type: 'error',
                message: 'Sincronización de notificaciones cancelada'
            });
        };

        window.socket.onerror = function(e) {
            top.notification({
                type: 'error',
                message: 'Error al sincronizar las notificaciones'
            });
        };
    }

    processMessage(message) {
        if (message.type == 'notification') {
            this.total = +this.total + message.total;
            this.notifications = [];
            top.notification({
                type: 'info',
                message: message.message
            });
        }
    }

    getSocketRoute() {
        let route = new String();
        $.ajax({
            url: `${this.options.baseUrl}app/websockets/consulta_ruta.php`,
            async: false,
            type: 'POST',
            dataType: 'json',
            data: {
                key: this.options.key,
                token: this.options.token,
                type: 'notifications'
            },
            success: function(response) {
                if (response.success) {
                    route = response.data.route;
                } else {
                    console.error(response.data);
                }
            }
        });

        return route;
    }

    showList() {
        let _this = this;

        if (!_this.notifications.length) {
            $.post(
                `${_this.options.baseUrl}app/notificaciones/funcionario.php`,
                {
                    key: _this.options.key,
                    token: _this.options.token,
                    userId: _this.options.key,
                    offset: 0,
                    more: 4
                },
                function(response) {
                    if (response.success) {
                        $(_this.options.listSelector).empty();
                        _this.notifications = response.data;
                        _this.createItems(0, 4);
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

    createItems(first, last) {
        let _this = this;
        let notifications = _this.notifications.slice(first, last + 1);

        notifications.forEach(element => {
            $(_this.options.listSelector).append(
                $('<a>', {
                    href: '#',
                    class: 'dropdown-item'
                }).text(
                    `
                        id: ${element.id}
                        fecha : ${element.fecha}
                        descripcion: ${element.descripcion}
                    `
                )
            );
        });

        $(_this.options.listSelector).append(
            $('<span>', {
                class: 'clearfix bg-master-lighter dropdown-item',
                id: 'more_notifications'
            }).append(
                $('<span>', {
                    class: 'fa fa-plus-circle pull-left btn btn-link',
                    text: ' Ver más'
                })
            )
        );
    }

    more() {
        let _this = this;
        let offset = +$(`${_this.options.listSelector}>.dropdown-item`).length;

        $.post(
            `${_this.options.baseUrl}app/notificaciones/funcionario.php`,
            {
                key: _this.options.key,
                token: _this.options.token,
                userId: _this.options.key,
                offset: offset,
                more: 4
            },
            function(response) {
                if (response.success) {
                    $('#more_notifications').remove();
                    _this.notifications = [
                        ..._this.notifications,
                        ...response.data
                    ];
                    _this.createItems(offset, offset + 4);
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
