$(function() {
    $(".change_type").on("click", function() {
        let row = $(this)
            .parent()
            .parent();
        let input = row.find(":input");

        if (input.attr("type") == "text") {
            input.attr("type", "password");
        } else {
            input.attr("type", "text");
        }
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    $("#change_btn").on("click", function() {
        $("#form_password").submit();
    });

    $("#new_password").keyup(function() {
        checkStrength("#password_validation", $(this).val());
    });

    function checkStrength(selector, password) {
        var strength = 0;

        if (password.length < 9) {
            $(selector)[0].className = "label label-danger";
            $(selector).html("Demasiado Corta");
            return true;
        }

        if (password.length > 7) strength += 1;
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
            strength += 1;
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        // If it has two special characters, increase strength value.
        if (
            password.match(
                /(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/
            )
        )
            strength += 1;
        // Calculated strength value, we can return messages

        if (strength < 2) {
            $(selector)[0].className = "label label-warning";
            $(selector).html("Débil");
            return true;
        } else if (strength == 2) {
            $(selector)[0].className = "label label-info";
            $(selector).html("Buena");
            return true;
        } else {
            $(selector)[0].className = "label label-success";
            $(selector).html("Optima");
            return true;
        }
    }
});

$("#form_password").validate({
    rules: {
        new_password: {
            required: true,
            minlength: 8
        },
        confirm_password: {
            required: true,
            equalTo: "#new_password"
        }
    },
    messages: {
        new_password: {
            required: "Campo requerido",
            minlength: "Ingrese minimo 8 caracteres"
        },
        confirm_password: {
            required: "Campo requerido",
            equalTo: "Las contraseñas no coinciden"
        }
    },
    submitHandler: function(form) {
        let baseUrl = $('script[data-baseurl]').data('baseurl');
        $.post(
            `${baseUrl}/app/funcionario/restaurar_contrasena.php`,
            {
                token: $("[name='token'").val(),
                new: $("[name='new_password']").val()
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        message: "Datos Actualizados",
                        type: "success"
                    });

                    setTimeout(() => {
                        window.location = response.data;
                    }, 1500);
                } else {
                    top.notification({
                        message: response.message,
                        type: "error",
                        title: "Error!"
                    });
                }
            },
            "json"
        );
    }
});
