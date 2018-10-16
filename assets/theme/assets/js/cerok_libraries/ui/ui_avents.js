$(function () {
    var session = new Session();
    
    Ui.putLogo();
    Ui.showUserInfo(session.user);
    
    $("#iframe_workspace").height($(window).height() - $("#header").height() - 9);

    $("#btn_logout").on('click', function (event) {
        event.preventDefault();
        Ui.close();
    });

    $("#profile_form").on('submit', function (event) {
        event.preventDefault();

        var data = new FormData();
        data.append('email', $("[name='email']").val());
        data.append('email_contrasena', $("[name='email_contrasena']").val());
        data.append('direccion', $("[name='direccion']").val());
        data.append('telefono', $("[name='telefono']").val());

        jQuery.each($('#image')[0].files, function (i, file) {
            data.append('image', file);
        });

        $.ajax({
            type: 'POST',
            data: data,
            dataType: 'json',
            url: Session.getBaseUrl() + 'app/funcionario/actualiza_funcionario.php',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $("#edit_profile").modal('toggle');
                } else {
                    toastr.error(response.message, 'Error!');
                }
            }
        });
    });
});