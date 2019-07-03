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
    <title>Roles</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row pb-2">
            <div class="col-12">
                <button class="btn btn-complete btn-sm float-right" id="add_role" title="Crear rol">
                    <span class="fa fa-plus"></span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="role_table"></table>
            </div>
        </div>
    </div>
    <?= bootstrapTable() ?>
    <script id="role_script" src="<?= $ruta_db_superior ?>views/dependencia_cargo/js/listado.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>