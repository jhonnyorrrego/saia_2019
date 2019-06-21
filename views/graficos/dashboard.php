<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

$params = json_encode($_REQUEST + ['baseUrl' => $ruta_db_superior]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
</head>

<body>
    <div class="container mw-100 mx-100 h-100" style="overflow-y:auto">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <div class="card card-borderless">
                    <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item graph_tab">
                            <a class="active" data-toggle="tab" role="tab" data-target="#graphs" href="#">Indicadores</a>
                        </li>
                        <li class="nav-item graph_tab" id="show_list">
                            <a href="#" data-toggle="tab" role="tab" data-target="#list">Listado de Reportes</a>
                        </li>
                        <li class="nav-item graph_tab">
                            <a href="#" data-toggle="tab" role="tab" data-target="#report">Reporte</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="graphs">
                            <div class="row" id="graph_list"></div>
                        </div>
                        <div class="tab-pane" id="list"></div>
                        <div class="tab-pane" id="report"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/echarts/echarts.min.js"></script>
    <script id="graph_script" src="<?= $ruta_db_superior ?>views/graficos/js/dashboard.js" data-params='<?= $params ?>'></script>
</body>

</html>