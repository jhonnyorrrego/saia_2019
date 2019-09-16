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
    'baseUrl' => $ruta_db_superior
]);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Serie</title>
    <link href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-fluid">

        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="trd_form" autocomplete='off'>

                    <p>Los campos con <span class="bold" style="font-size:15px;color:red">*</span> son obligatorios</p>
                    <div class="form-group form-group-default form-group-default-select2 required">
                        <label>Dependencia</label>
                        <select class="full-width required" id="dependencia" name="dependencia">
                            <option value="">Seleccione ...</option>
                        </select>
                    </div>

                    <p id="pAddSerie" style="display:none">
                        <button type="button" class="btn btn-complete btn-xs" title="Adicionar Serie" id="addSerie">
                            <i class="fa fa-plus"></i>
                            <span class="d-none d-sm-inline">Serie</span>
                        </button>
                        <input type="hidden" id="hiddenSerie" class="required">
                    </p>

                    <div id="divSerie"></div>

                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <?= validate() ?>
    <script id="adicionar_script" src="<?= $ruta_db_superior ?>views/serie/js/adicionar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>