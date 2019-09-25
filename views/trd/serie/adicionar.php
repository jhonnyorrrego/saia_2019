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
    'sourceTemp' => (int) $_REQUEST['sourceTemp']
]);
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

        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="trd_form" autocomplete='off'>

                    <p>Los campos con <span class="bold" style="font-size:15px;color:red">*</span> son obligatorios</p>
                    <div class="form-group form-group-default form-group-default-select2 required">
                        <label>Serie</label>
                        <select class="full-width required selectSerie" id="serie-0" name="serie[idserie]" data-key="0">
                            <option value="">Seleccione ...</option>
                            <option value="-1">NUEVA SERIE</option>
                        </select>
                    </div>

                    <div class="form-group form-group-default form-group-default-select2 required" style="display:none">
                        <label>Dependencia</label>
                        <select class="full-width" id="dependencia-0" name="serie[dependencia]">
                            <option value="">Seleccione ...</option>
                        </select>
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Código de la serie:</label>
                        <input name="serie[codigo]" id="codigo_serie-0" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Nombre de la serie:</label>
                        <input name="serie[nombre]" id="nombre_serie-0" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Retención gestión:</label>
                        <input name="serie[gestion]" id="ret_gestionSerie-0" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default required" style="display:none">
                        <label>Retención central:</label>
                        <input name="serie[central]" id="ret_centralSerie-0" type="text" class="form-control">
                    </div>

                    <div class="form-group form-group-default" style="display:none">
                        <label>Procedimiento:</label>
                        <textarea name="serie[procedimiento]" id="procedimientoSerie-0" class="form-control"></textarea>
                    </div>

                    <div class="form-group form-group-default required" id="divDisposicionSerie-0" style="display:none">
                        <label class="pl-1 mb-0 mt-1">Disposición</label>

                        <div class="radio radio-success input-group my-0">
                            <input type="radio" value="E" name="serie[disposicion]" data-key="0" data-type="serie" id="ESerie-0">
                            <label for="ESerie-0">E</label>

                            <input type="radio" value="S" name="serie[disposicion]" data-key="0" data-type="serie" id="SSerie-0">
                            <label for="SSerie-0">S</label>

                            <input type="radio" value="CT" name="serie[disposicion]" data-key="0" data-type="serie" id="CTSerie-0">
                            <label for="CTSerie-0">CT</label>
                        </div>

                        <div style="display:none" class="checkbox check-success input-group my-0" id="divMicrofilmaSerie-0">
                            <input type="checkbox" value="1" name="serie[microfilma]" id="microfilmaSerie-0">
                            <label for="microfilmaSerie-0">M/D</label>
                        </div>
                    </div>

                    <p id="pAddSubserie-0">
                        <button type="button" class="btn btn-complete btn-xs addSubserie" style="display:none" id="addSubserie-0" data-name="serie" data-key="0" title="Adicionar Subserie">
                            <i class="fa fa-plus"></i>
                            <span class="d-none d-sm-inline">Subserie</span>
                        </button>

                        <button type="button" class="btn btn-complete btn-xs addTipo" style="display:none" id="addTipoSerie-0" data-key="0" data-name="serie" data-type="serie" data-div="divTipoSerie-0" title="Adicionar Tipo">
                            <i class="fa fa-plus"></i>
                            <span class="d-none d-sm-inline">Tipo</span>
                        </button>
                        <input type="hidden" id="hiddenSubTipo-0">
                    </p>
                    <div id="divSubserie-0"></div>
                    <div id="divTipoSerie-0"></div>

                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <?= validate() ?>
    <script id="adicionar_script" src="<?= $ruta_db_superior ?>views/trd/serie/js/adicionar.js" data-params='<?= $params ?>'>
    </script>
</body>

</html>