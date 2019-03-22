class Session {
    constructor() {
        this.baseUrl = Session.getBaseUrl();
        this.init();
    }

    init() {
        let session = this;

        if (!localStorage.getItem('user')) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: this.baseUrl + 'app/funcionario/consulta_funcionario.php',
                data: {
                    type: 'session'
                },
                async: false,
                success: function (response) {
                    if (response.success) {
                        session.user = response.data;
                    } else {
                        Session.violation('Debe iniciar sessión');
                    }
                }
            })
        } else {
            if (Session.check(Session.getBaseUrl())) {
                let data = localStorage.getItem('user');
                session.user = JSON.parse(data);
            } else {
                Session.violation('Debe iniciar sesión');
            }
        }

        Session.defineGlobalChecker();
    }

    set baseUrl(route) {
        this._baseUrl = route;
    }

    get baseUrl() {
        return this._baseUrl;
    }

    set user(data) {
        this._user = data;

        if (data.iduser) {
            localStorage.setItem('user', JSON.stringify(data));
            localStorage.setItem('key', data.iduser);
        } else {
            localStorage.setItem('key', 0);
            localStorage.setItem('userImage', '');
        }
    }

    get user() {
        return this._user;
    }

    static check(baseUrl) {
        var access = false;

        if (localStorage.getItem('key') > 0) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: `${baseUrl}app/funcionario/verificar_session.php`,
                data: {
                    key: localStorage.getItem('key')
                },
                async: false,
                success: function (response) {
                    if (response.success) {
                        if (!response.data) {
                            Session.close();
                        }
                        access = response.data;
                    }
                }
            });
        }

        return access;
    }

    static violation(message) {
        top.notification({
            message: message,
            type: 'error',
            title: 'Error!'
        });

        setTimeout(() => {
            Session.close();
            window.location = Session.getBaseUrl() + 'views/login/login.php';
        }, 1000);
    }

    static close() {
        localStorage.clear();
    }

    static getBaseUrl() {
        return $("#baseUrl").data('baseurl');
    }

    static defineGlobalChecker() {
        top.window.checkSession = function () {
            if (!localStorage.getItem('key')) {
                window.location = Session.getBaseUrl() + 'views/login/login.php';
            }
        }
    }
}