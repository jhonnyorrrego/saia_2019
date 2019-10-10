$(function() {
    let key = localStorage.getItem('key');
    var userInformation = new UserInformation(key);

    $('#btn_success').on('click', function() {
        $('#profile_form').submit();
    });

    $('#show_image_modal').on('click', function() {
        top.topModal({
            url: 'views/funcionario/recortar_foto.php',
            params: {
                userId: localStorage.getItem('key')
            },
            buttons: {},
            beforeHide: function(event) {
                window.hideImgAreaSelect();
            }
        });
    });
});

$('#profile_form').validate({
    rules: {
        email: {
            email: true
        }
    },
    messages: {
        email: {
            email: 'Ingrese un correo válido'
        }
    },
    submitHandler: function(form) {
        var baseUrl = Session.getBaseUrl();

        $.ajax({
            type: 'POST',
            data: $('#profile_form').serialize(),
            dataType: 'json',
            url: `${baseUrl}app/funcionario/actualiza_funcionario.php`,
            success: function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.closeTopModal();
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            }
        });
    }
});
