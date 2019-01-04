class Ui {    
    static showUserInfo(user) {
        $("#profile_image").attr("src", Session.getBaseUrl() + user.cutedPhoto);
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
                minHeight: 40,
                x1: 0,
                y1: 0,
                x2: 70,
                y2: 70,
                persistent: true,
            });
        }, 500);
    }

    static hideImgAreaSelect(){
        let ias = $("#img_edit_photo").imgAreaSelect({ instance: true });
        ias.setOptions({ hide: true });
        ias.update();
    }

    static resizeIframe() {
        let headerHeight = Math.ceil($("#header").height());
        let windowHeight = Math.ceil($(window).height());
        $("#iframe_workspace").height(windowHeight - headerHeight - 5);

        if (!$("#new_action_mobile_container").is(':hidden')) {
            $("#new_action_mobile_container").css({
                top: $("#iframe_workspace").height() - 80,
                left: $("#iframe_workspace").width() - 80
            });
        }
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
            t = setTimeout(logout, 3600000)
        }
    }
}