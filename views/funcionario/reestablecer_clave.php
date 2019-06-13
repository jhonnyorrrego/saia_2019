<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";

$userId = base64_decode(base64_decode($_REQUEST['token']));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container d-flex align-items-center h-100">
        <div class="col-5 card mx-auto">
            <div class="card-header">
                <h5>Cambio de contraseña</h5>
            </div>
            <div class="card-body">
                <form id="form_password">
                    <input type="hidden" name="token" value="<?= $_REQUEST['token'] ?>">
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
                            <i class="change_type fa fa-eye cursor"></i>
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
                            <i class="change_type fa fa-eye cursor"></i>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right bg-white">
                <button class="btn btn-success" id="change_btn">Guardar</button>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <script data-baseurl="<?= $ruta_db_superior ?>" src="<?= $ruta_db_superior ?>assets/theme/assets/js/cerok_libraries/notifications/topNotification.js" type="text/javascript"></script>
    <script src="<?= $ruta_db_superior ?>views/funcionario/js/reestablecer_clave.js"></script>
    <?php if (!Funcionario::isValidToken($_REQUEST['token'], $userId)) : ?>
        <script>
            top.notification({
                type: 'info',
                message: 'Enlace caducado'
            });

            setTimeout(() => {
                window.location = '../../';
            }, 800);
        </script>
    <?php endif; ?>
</body>

</html>