class Ui {    
    static showUserInfo(user) {
        $("#profile_image").attr("src", user.image);
        $("#user_name").text(user.name);
    }

    static putLogo() {
        var logo = localStorage.getItem('logo');

        if (!logo) {
            $.get(Session.getBaseUrl() + 'app/configuracion/consulta_configuraciones.php',{
                configurations : ['logo']
            }, function (response) {
                if (response.success) {
                    localStorage.setItem('logo', response.data);
                    Ui.putLogo();
                }
            }, 'json');
        } else {
            $('#client_image').attr('src', logo);
        }
    }

    static putColor(){
        const color = localStorage.getItem('color');

        if(color){
            $(".bg-institutional").css({
                background: color,
                color: '#ffff'
            });
        }else{
            $.get(Session.getBaseUrl() + 'app/configuracion/consulta_configuraciones.php',{
                configurations: ['color_institucional']
            }, function (response) {
                if (response.success) {
                    localStorage.setItem('color', response.data[0].value);
                    Ui.putColor();
                }
            }, 'json');
        }
    }

    static close() {
        Session.close();
        window.location = Session.getBaseUrl() + 'logout.php';
    }
}