class Ui {    
    static showUserInfo(user) {
        let img_complete = Session.getBaseUrl() + user.foto_original;
        let img_cut = Session.getBaseUrl() + user.foto_recorte;

        $("#img_edit_photo").attr('src', img_complete);
        $("#profile_image").attr("src", img_cut);
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
            $('head').append(
                $('<style>',{
                    id: 'instition_style',
                    rel: 'stylesheet',
                    type: 'text/css',
                    text: `.bg-institutional{background: ${color}!important;color: "#ffff"!important}`
                })
            );
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

    static imageAreaSelect(){
        setTimeout(() => {
            $("#img_edit_photo").imgAreaSelect({
                handles: "corners",
                aspectRatio: "1:1",
                minHeight: 80,
                x1: 25,
                y1: 25,
                x2: 230,
                y2: 230,
                persistent: true,
            });
        }, 500);
    }

    static hideImgAreaSelect(){
        let ias = $("#img_edit_photo").imgAreaSelect({ instance: true });
        ias.setOptions({ hide: true });
        ias.update();
    }

    static close() {
        Session.close();
        window.location = Session.getBaseUrl() + 'logout.php';
    }
}