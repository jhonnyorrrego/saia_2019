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
<html lang="es">

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
    <div class="container-fluid mw-100 px-3">
        <div class="row pt-3">
            <div class="col col-md-3">
                <div class="form-group form-group-default form-group-default-select2 required">
                    <label class="">Perfil</label>
                    <select class="full-width" id="profile" name="perfil[]">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
            </div>
            <div class="col-auto col-md-auto pl-0">
                <div class="form-group">
                    <button class="btn btn-complete" id="profile_settings">
                        <span><i class="fa fa-cog"></i></span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-3 ml-auto">
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
        <div class="row mx-0" id="table_container" style="overflow-y:auto">
            <div class="col-12 px-0">
                <table id="treegrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bold text-dark">Nombre del Módulo</th>
                            <th class="text-center bold text-dark">Acceso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-dark"></td>
                            <td class="text-center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= fancyTree(true) ?>
    <?= select2() ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-fancytree/2.30.0/modules/jquery.fancytree.table.js"></script>
    <script src="<?= $ruta_db_superior ?>views/permisos/js/modulo_perfil.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>