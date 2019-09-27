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

$_REQUEST['baseUrl'] = $ruta_db_superior;
$params = json_encode($_REQUEST);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TRD</title>
    <link href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-fluid">

        <div class="card card-default" id="card-editar">

            <div class="card-header">
                <div class="card-title">EDITAR INFORMACIÓN</div>
                <div class="card-controls">
                    <ul>
                        <li>
                            <a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">

                <form id="trd_form" autocomplete='off'>
                    <p>Los campos con <span class="bold" style="font-size:15px;color:red">*</span> son obligatorios</p>

                    <div id="viewContentForm"></div>

                    <input name="idserie" id="idserie" type="hidden" value="<?= $_REQUEST['idserie']; ?>" class="form-control required">
                    <input name="old_dependencia" type="hidden" value="<?= $_REQUEST['iddependencia']; ?>" class="form-control required">
                    <input name="onlytype" type="hidden" value="<?= $_REQUEST['onlytype']; ?>" class="form-control required">
                </form>

            </div>
        </div>


        <div class="card card-default" id="card-eliminar">

            <div class="card-header">
                <div class="card-title" style="color:red">ELIMINAR</div>
                <div class="card-controls">
                    <ul>
                        <li>
                            <a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <p>Tenga en cuenta que al eliminar el registro se eliminarán tambien los registros asociados a este,
                    como las subseries, los tipos documentales y las relaciones que ellas tengan.
                    Esta acción es irreversible.
                </p>
                <p class="card-text text-right">
                    <button type="button" id="btn_delete" class="btn btn-danger">ELIMINAR</button>
                </p>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <?= validate() ?>
    <script id="editar_script" src="<?= $ruta_db_superior ?>views/serie_temp/js/editar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>