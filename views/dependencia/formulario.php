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
    'id' => $_REQUEST['id'],
    'parent' => $_REQUEST['parent']
]);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dependencia</title>
</head>

<body>
    <div class="container-fluid">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="area_form">
                    <p>los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="form-group form-group-default required">
                        <label>Código:</label>
                        <input name="codigo" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default required">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div id="areas_tree">Area superior</div>
                            <input type="hidden" name="cod_padre" class="required">
                        </div>
                    </div>
                    <div class="form-group form-group-default form-group-default-select2 required">
                        <label class="">Tipo</label>
                        <select class="full-width" name="tipo" id="type_select">
                            <option value="1">Area</option>
                            <option value="2">Grupo</option>
                        </select>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Logo:</label>
                        <div id="file"></div>
                        <input type="hidden" name="logo">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Extensión:</label>
                        <input name="extension" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Ubicación:</label>
                        <input name="ubicacion_dependencia" type="text" class="form-control">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Descripción:</label>
                        <textarea name="descripcion" id="" class="form-control"></textarea>
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
    <?= select2() ?>
    <?= fancyTree() ?>
    <?= dropzone() ?>
    <?= validate() ?>
    <script id="area_script" src="<?= $ruta_db_superior ?>views/dependencia/js/formulario.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>