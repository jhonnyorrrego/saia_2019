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
    'userId' => $_REQUEST['userId'],
    'roleId' => $_REQUEST['roleId']
]);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Roles</title>
</head>

<body>
    <div class="container-fluid" id="add_role_container">
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="role_form">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-default required">
                                <label class="pl-1 mb-0 mt-1">Dependencia</label>
                                <div id="dependency_tree"></div>
                                <input type="hidden" name="dependency" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-default required">
                                <label class="pl-1 mb-0 mt-1">Cargo</label>
                                <div id="role_tree"></div>
                                <input type="hidden" name="position" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group required">
                                <div class="form-input-group">
                                    <label>Fecha inicial:</label>
                                    <input type="text" id="initial_date" class="form-control" name="initial_date" required>
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group required">
                                <div class="form-input-group">
                                    <label>Fecha final:</label>
                                    <input type="text" id="final_date" class="form-control" name="final_date" required>
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="state_container">
                        <div class="col-12">
                            <div class="form-group form-group-default required">
                                <label class="pl-1 mb-0 mt-1">Estado</label>
                                <div class="radio radio-success mt-0 mb-2">
                                    <input id="active" type="radio" name="state" value="1" checked required>
                                    <label for="active">Activo</label>
                                    <input id="inactive" type="radio" name="state" value="0">
                                    <label for="inactive">Inactivo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= validate() ?>
    <?= fancyTree() ?>
    <?= dateTimePicker() ?>
    <script id="add_role_script" src="<?= $ruta_db_superior ?>views/dependencia_cargo/js/adicionar_rol.js" data-params='<?= $params ?>'></script>
</body>

</html>