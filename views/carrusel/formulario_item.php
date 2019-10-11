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
    'itemId' => $_REQUEST['itemId'] ?? 0
]);

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Item carrusel</title>
</head>

<body>
    <div class="container-fluid">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="item_form" autocomplete='off'>
                    <p>Los campos con <span class="bold" style="font-size:15px">*</span> son obligatorios</p>

                    <input name="fk_carrusel" type="hidden" value="<?= $_REQUEST['carouselId'] ?>">
                    <div class="form-group form-group-default required">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Descripción:</label>
                        <input name="descripcion" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Imagen:</label>
                        <div id="file"></div>
                        <input type="hidden" name="image">
                    </div>
                    <div class="form-group form-group-default input-group required date">
                        <div class="form-input-group">
                            <label>Fecha inicial:</label>
                            <input name="fecha_inicial" type="text" class="form-control" id="fecha_inicial">
                        </div>
                        <div class="input-group-append ">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group form-group-default input-group required date">
                        <div class="form-input-group">
                            <label>Fecha final:</label>
                            <input name="fecha_final" type="text" class="form-control" id="fecha_final">
                        </div>
                        <div class="input-group-append ">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
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
    <?= dateTimePicker() ?>
    <?= dropzone() ?>
    <?= validate() ?>
    <script id="item_script" src="<?= $ruta_db_superior ?>views/carrusel/js/formulario_item.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>