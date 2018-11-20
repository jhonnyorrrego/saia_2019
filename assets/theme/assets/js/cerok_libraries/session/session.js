class Session {
    constructor() {
        this.baseUrl = Session.getBaseUrl();
        this.init();
    }

    init() {
        let session = this;
        
        $.ajax({
            type:'GET',
            dataType:'json',
            url: this.baseUrl + 'app/funcionario/consulta_funcionario.php',
            data:{
                type: 'session'
            },
            async:false,
            success: function (response) {
                if (response.success) {
                    session.user = response.data;
                }else{
                    Session.violation('Debe iniciar sessión');
                }
            }
        })
    }

    set baseUrl(route) {
        this._baseUrl = route;
    }

    get baseUrl() {
        return this._baseUrl;
    }

    set user(data) {
        this._user = data;

        if(data.iduser){
            localStorage.setItem('key', data.iduser);
        }else{
            localStorage.setItem('key', 0);
        }
    }

    get user() {
        return this._user;
    }

    static check(baseUrl){
        var access = false;

        if(localStorage.getItem('key') > 0){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: baseUrl + 'app/funcionario/verificar_session.php',
                data:{
                    key : localStorage.getItem('key')
                },
                async: false,
                success: function (response) {
                    if (response.success) {
                        access = response.data;
                    }
                }
            });
        }

        return access;
    }

    static violation(message) {
        toastr.error(message, 'Error!');

        setTimeout(() => {
            Session.close();
            window.location = Session.getBaseUrl() + 'views/login/login.php';
        }, 1500);
    }

    static close(){
        localStorage.clear();
    }

    static getBaseUrl() {
        return $("#baseUrl").data('baseurl');
    }

}