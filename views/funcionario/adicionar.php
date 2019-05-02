<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "assets/librerias.php";

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'userId' => $_REQUEST['userId']
]);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Funcionario</title>
</head>

<body>
    <div class="container container-fixed-lg col-12">
        <!-- START card -->
        <div class="card card-default">
            <div class="card-body">
                <div class="col-12">
                    <p>los campos con <span class="text-danger">*</span> son obligatorios</p>
                </div>
                <div class="col-12">
                    <form id="user_form">
                        <div class="form-group form-group-default required">
                            <label>Identificacion:</label>
                            <input name="nit" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default required">
                            <label>Nombres:</label>
                            <input name="nombres" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default required">
                            <label>Apellidos:</label>
                            <input name="apellidos" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Usuario:</label>
                            <input name="login" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default required">
                            <label>Contraseña:</label>
                            <input name="clave" type="password" class="form-control" id="password">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="bold">Seguridad de la contraseña:<label id="password_validation"></label></span>
                            </div>
                            <p>
                                Usa al menos 8 caracteres. Se recomienda combinar caracteres alfanuméricos (letras y
                                números) con símbolos:<br><br>
                                - Letras mayúsculas como: A, E, R.<br>
                                - Letras minúsculas como: a, e, r.<br>
                                - Números como: 2, 6, 7.<br>
                                - Símbolos y caracteres especiales como: !, @, &, *.<br>
                            </p>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Dirección:</label>
                            <input name="direccion" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Telefono:</label>
                            <input name="telefono" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Correo:</label>
                            <input name="email" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Firma:</label>
                            <div id="file"></div>
                            <input type="hidden" name="firma">
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 required">
                            <label class="">Perfil</label>
                            <select class="full-width" id="profile" name="perfil[]" multiple="multiple">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 required">
                            <label class="">Ventanilla radicación</label>
                            <select class="full-width" id="window_radication" name="ventanilla_radicacion">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="pl-1 mb-0 mt-1">Estado</label>
                            <div class="radio radio-success my-0">
                                <input type="radio" value="1" name="estado" id="activo" checked>
                                <label for="activo">Activo</label>
                                <input type="radio" value="0" name="estado" id="inactivo">
                                <label for="inactivo">Inactivo</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <?= dropzone() ?>
    <?= validate() ?>
    <script id="user_script" src="<?= $ruta_db_superior ?>views/funcionario/js/adicionar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html> 