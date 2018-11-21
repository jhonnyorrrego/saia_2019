<?php $ruta_db_superior = $_REQUEST['baseUrl'] ?>
<?php include_once $ruta_db_superior . 'assets/librerias.php' ?>
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
    <?= validate() ?>
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
                        toastr.success('Datos Actualizados');
                        $("#close_modal").trigger('click');
                    }else{
                        toastr.error(response.message, 'Error!');
                    }
                }, 'json') 
            }
        });
    </script>
</body>
</html>