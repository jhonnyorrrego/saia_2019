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
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Funcionario</title>
</head>

<body>
    <div class="container-fluid">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="user_form">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">Tipo</label>
                        <div class="radio radio-success my-0 input-group">
                            <input type="radio" value="1" name="tipo_ejecutor" id="activo" checked>
                            <label for="activo">Persona natural</label>
                            <input type="radio" value="2" name="tipo_ejecutor" id="inactivo">
                            <label for="inactivo">Persona jurídica</label>
                        </div>
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Identificación:</label>
                        <input name="identificacion" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Titulo:</label>
                        <input name="titulo" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Cargo:</label>
                        <input name="cargo" type="text" class="form-control">
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
                        <label>Ciudad:</label>
                        <input name="ciudad" type="text" class="form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <script id="user_script" src="<?= $ruta_db_superior ?>views/remitente/js/adicionar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>