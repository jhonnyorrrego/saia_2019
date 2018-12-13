<?php $ruta_db_superior = $_REQUEST['baseUrl']?>
<?php include_once $ruta_db_superior . 'assets/librerias.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="container">
        <div class="col-12">
            <form id="form_password">
                <form id="form_login" role="form">
                <div class="row">
                    <div class="col-10 col-md-11">
                            <div class="form-group form-group-default required">
                                <label>Contraseña actual</label>
                                <div class="controls">
                                    <input type="password" placeholder="****" class="form-control" name="actual_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <i class="change_type fa fa-eye"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 col-md-11">
                            <div class="form-group form-group-default required">
                                <label>Nueva Contraseña</label>
                                <div class="controls">
                                    <input type="password" placeholder="****" class="form-control" name="new_password" id="new_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <i class="change_type fa fa-eye"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="bold">Seguridad de la contraseña:<label id="password_validation"></label></span>
                        </div>
                    </div>
                    <div>
                        <p>
                            Usa al menos 8 caracteres. Se recomienda combinar caracteres alfanuméricos (letras y números) con símbolos:<br><br>
                            - Letras mayúsculas como: A, E, R.<br>
                            - Letras minúsculas como: a, e, r.<br>
                            - Números como: 2, 6, 7.<br>
                            - Símbolos y caracteres especiales como: !, @, &, *.<br>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-10 col-md-11">
                            <div class="form-group form-group-default required">
                                <label>Confirmar la nueva Contraseña</label>
                                <div class="controls">
                                    <input type="password" placeholder="****" class="form-control" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <i class="change_type fa fa-eye"></i>
                        </div>
                    </div>
                </form>
            </form>
        </div>
    </div>
    <?=validate()?>
    <script>
        $(function(){
            $('.change_type').on('click', function(){
                let row = $(this).parent().parent();
                let input = row.find(':input');

                if(input.attr('type') == 'text'){
                    input.attr('type', 'password');
                }else{
                    input.attr('type', 'text');
                }
                $(this).toggleClass('fa-eye fa-eye-slash')
            });

            $("#btn_success").on('click', function(){
                $("#form_password").submit();
            });

            $("#new_password").keyup(function() {
                checkStrength("#password_validation", $(this).val());
            });

            function checkStrength(selector, password) {
                var strength = 0;

                if (password.length < 9) {
                    $(selector)[0].className = 'label label-danger';
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
                if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/))
                strength += 1;
                // Calculated strength value, we can return messages

                if (strength < 2) {
                    $(selector)[0].className = 'label label-warning';
                    $(selector).html("Débil");
                    return true;
                } else if (strength == 2) {
                    $(selector)[0].className = 'label label-info';
                    $(selector).html("Buena");
                    return true;
                } else {
                    $(selector)[0].className = 'label label-success';
                    $(selector).html("Optima");
                    return true;
                }
            }
        });

        $("#form_password").validate({
            rules: {
                actual_password: {
                    required: true
                },
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
                actual_password: {
                    required: "Campo requerido",
                },
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
                let baseUrl = Session.getBaseUrl();
                $.post(`${baseUrl}/app/funcionario/actualiza_contrasena.php`,{
                    key: localStorage.getItem('key'),
                    actual: $("[name='actual_password']").val(),
                    new: $("[name='new_password']").val()
                }, function(response){
                    if(response.success){
                        top.notification({
                            message: 'Datos Actualizados',
                            type: 'success'
                        });
                        $("#close_modal").trigger('click');
                    }else{
                        top.notification({
                            message: response.message,
                            type: 'error',
                            title: 'Error!'
                        });
                    }
                }, 'json')
            }
        });
    </script>
</body>
</html>