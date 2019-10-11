<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <div class="container">
        <div class="row pb-2">
            <div class="col-3 text-center">
                <span class="thumbnail-wrapper circular inline w-100">
                    <img id="image" class="cuted_photo">
                </span>
                <a style="cursor:pointer" href="#" id="show_image_modal">
                    <small>Cambiar</small>
                </a>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12">
                        <span id="name"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="email"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="direction"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="phoneNumber"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-12">
                <form role="form" id="profile_form">
                    <div class="form-group form-group-default">
                        <label>Email</label>
                        <div class="controls">
                            <input type="email" class="form-control" placeholder="Correo electrónico" name="email">
                        </div>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Contraseña del email</label>
                        <div class="controls">
                            <input type="password" class="form-control" placeholder="****" name="email_contrasena">
                        </div>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Dirección</label>
                        <div class="controls">
                            <input type="text" class="form-control" placeholder="Dirección de Residencia" name="direccion">

                        </div>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Teléfono</label>
                        <div class="controls">
                            <input type="text" class="form-control" placeholder="Teléfono de Contacto" name="telefono">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <script>
        $(function() {
            if (typeof UserInformation == 'undefined') {
                $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/userInformation.js`, function() {
                    $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/information_events.js`);
                });
            } else {
                $.getScript(`${Session.getBaseUrl()}assets/theme/assets/js/cerok_libraries/userInformation/information_events.js`);
            }
        });
    </script>
</body>

</html>