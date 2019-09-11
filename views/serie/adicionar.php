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
    'request' => $_REQUEST,
]);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Serie</title>
</head>

<body>
    <div class="container-fluid">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="trd_form" autocomplete='off'>

                    <p>Los campos con <span class="bold" style="font-size:15px;color:red">*</span> son obligatorios</p>
                    <div class="form-group form-group-default form-group-default-select2 required">
                        <label>Dependencia</label>
                        <select class="full-width" id="dependencia" name="dependencia">
                            <option value="">Seleccione ...</option>
                        </select>
                    </div>

                    <div class="form-group form-group-default form-group-default-select2 required">
                        <label>Serie</label>
                        <select class="full-width" id="serie" name="serie">
                            <option value="">Seleccione dependencia</option>
                        </select>
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Código de la serie:</label>
                        <input name="codigo_serie" id="codigo_serie" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Nombre de la serie:</label>
                        <input name="nombre_serie" id="nombre_serie" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default form-group-default-select2">
                        <label>Subserie</label>
                        <select class="full-width" id="subserie" name="subserie">
                            <option value="">Seleccione ...</option>
                        </select>
                    </div>

                    <div class="form-group form-group-default" style="display:none">
                        <label>Código de la subserie:</label>
                        <input name="codigo_subserie" id="codigo_subserie" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default" style="display:none">
                        <label>Nombre de la subserie:</label>
                        <input name="nombre_subserie" id="nombre_subserie" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required">
                        <label>Retención gestión:</label>
                        <input name="ret_gestion" id="ret_gestion" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required">
                        <label>Retención central:</label>
                        <input name="ret_central" id="ret_central" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default">
                        <label>Procedimiento:</label>
                        <textarea name="procedimiento" id="procedimiento" class="form-control"></textarea>
                    </div>

                    <div class="form-group form-group-default required">
                        <label>Tipo documental:</label>
                        <input name="tipo_documental" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required">
                        <label>Dias para responder:</label>
                        <input name="dias_respuesta" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">Soporte</label>
                        <div class="checkbox check-success input-group my-0" id="divSoporte">

                            <input type="checkbox" value="P" name="soporte[]" id="P">
                            <label for="P">P</label>

                            <input type="checkbox" value="EL" name="soporte[]" id="EL">
                            <label for="EL">EL</label>
                        </div>
                    </div>

                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">Disposición</label>

                        <div class="radio radio-success input-group my-0">
                            <input type="radio" value="E" name="disposicion" id="E">
                            <label for="E">E</label>

                            <input type="radio" value="S" name="disposicion" id="S">
                            <label for="S">S</label>

                            <input type="radio" value="CT" name="disposicion" id="CT">
                            <label for="CT">CT</label>
                        </div>

                        <div style="display:none" class="checkbox check-success input-group my-0" id="divMicrofilma">
                            <input type="checkbox" value="M/D" name="disposicion2" id="microfilma">
                            <label for="microfilma">M/D</label>
                        </div>
                    </div>

                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">¿ Adicionar otro ?</label>
                        <div class="radio radio-success input-group my-0">

                            <input type="radio" value="1" name="addother" id="other1" checked>
                            <label for="other1">SI</label>

                            <input type="radio" value="2" name="addother" id="other0">
                            <label for="other0">NO</label>
                        </div>
                    </div>

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