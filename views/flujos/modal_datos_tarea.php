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

include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

$tabs = [
    [
        "url" => "flow_info.php", "href" => "descripcion", "icon" => "fa fa-cog",
    ],
    [
        "url" => "flow_info.php", "href" => "actividades", "icon" => "fa fa-tasks",
    ],
    [
        "url" => "flow_info.php", "href" => "", "icon" => "fa fa-sign-in",
    ],
    [
        "url" => "flow_info.php", "href" => "", "icon" => "fa fa-sign-out",
    ],
    [
        "url" => "{$ruta_db_superior}views/tareas/anexos.php", "href" => "anexos", "icon" => "fa fa-paperclip",
    ],
    [
        "url" => "flow_info.php", "href" => "", "icon" => "fa fa-users",
    ],
    [
        "url" => "flow_info.php", "href" => "", "icon" => "fa fa-exclamation-triangle",
    ],
    [
        "url" => "flow_view.php", "href" => "", "icon" => "fa fa-thumbs-up",
    ]
];
//TODO: Procesar los params


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>SAIA - SGDEA</title>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>css/selectize.css" />
<link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css" rel="stylesheet" type="text/css">

    <?= jquery() ?>
    <?= validate() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= librerias_UI("1.12") ?>
    <?= librerias_arboles_ft("2.24")?>

<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/selectize.js"></script>

<style type="text/css">

</style>
</head>
<body>
    <div class="container-fluid px-0 mx-0">
        <div class="row mx-0">
            <div class="col-12">
                <ul class="nav nav-pills nav-fill" id="tab_flujos">
                  <?php foreach($tabs as $tab): ?>
                    <li class="nav-item">
                    <a class="nav-link element_tabs" id="pills-<?= $tab["href"]?>" data-url="<?= $tab["url"]?>" data-toggle="pill" href="#<?= $tab["href"]?>" role="tab" style="min-width:auto"><i class="f-12 <?= $tab['icon'] ?>"></i></a>
                    </li>
                  <?php endforeach;?>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <?php foreach($tabs as $tab): ?>
                    <div class="tab-pane fade" id="flow_info" role="tabpanel" aria-labelledby="pills-<?= $tab['href'] ?>">...</div>
                  <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

<script src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script>

<script type="text/javascript" id="smain" data-params="<?php //TODO: echo json_encode de los params que receibio ?>">
var lista_archivos = new Object();
$(document).ready(function() {
	var idflujo = $("script[data-idflujo]").data("idflujo");
	console.log("main", "idflujo", idflujo);

    $('.element_tabs').on('shown.bs.tab', function (e) {
        let tab = $(e.target);
        let container = $(tab.attr('href'))

        container.load(tab.data('url'));
    });

    $('.element_tabs:first').trigger('click');


    /*if(!idflujo){
        $('.nav-link:not(:first)').addClass('disabled');
    }*/

    /*let alto = $(window).height() - $("#tab_flujos").height();
    $('.nav-link:first').trigger('click');
    $("#flow_info").height(alto);
    $("#flow_diagram").height(alto);
    $("#flow_notification").height(alto);*/


});
</script>
</body>
</html>