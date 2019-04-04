<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . "assets/librerias.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= jquery() ?>
    <?= jqueryUi() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row pt-3">
            <div class="col-3">
                <div class="input-group transparent">
                    <input id="search" type="text" class="form-control" placeholder="Buscar..." autocomplete="off">
                    <div class="input-group-append ">
                        <span class="input-group-text transparent">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="treegrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Logo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?= fancyTree(true) ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-fancytree/2.30.0/modules/jquery.fancytree.table.js"></script>
    <script src="<?= $ruta_db_superior ?>views/dependencia/js/listado.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html> 