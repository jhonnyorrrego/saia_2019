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
    'idserie' => $_REQUEST['idserie'],
    'iddependencia' => $_REQUEST['iddependencia']
]);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TRD</title>
</head>

<body>
    <div class="container-fluid">

        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="trd_form" autocomplete='off'>

                    <p>Los campos con <span class="bold" style="font-size:15px;color:red">*</span> son obligatorios</p>

                    <div id="viewContentForm"></div>

                    <input name="idserie" id="idserie" type="hidden" value="<?= $_REQUEST['idserie']; ?>" class="form-control required">
                    <input name="iddependencia" id="iddependencia" type="hidden" value="<?= $_REQUEST['iddependencia']; ?>" class="form-control required">
                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <?= validate() ?>
    <script id="editar_script" src="<?= $ruta_db_superior ?>views/serie/js/editar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>