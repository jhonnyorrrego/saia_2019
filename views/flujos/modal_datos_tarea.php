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
include_once $ruta_db_superior . 'controllers/autoload.php';

$params = $_REQUEST;
$idflujo = $params['idflujo'];
$bpmn_id = null;
$idactividad = null;
if(!empty($_REQUEST["bpmn_id"])) {
    $bpmn_id = $_REQUEST["bpmn_id"];
    $actividad = Elemento::findByBpmnId($idflujo, $bpmn_id);
    $idactividad = $actividad->getPk();
    $params["idactividad"] = $idactividad;
}

$tabs = [
    [
        "url" => "tab_desc_tarea.php", "href" => "descripcion", "icon" => "fa fa-cog",
    ],
    [
        "url" => "tab_tareas_actividad.php", "href" => "tareas", "icon" => "fa fa-tasks",
    ],
    [
        "url" => "tab_req_in.php", "href" => "entrada", "icon" => "fa fa-sign-in",
    ],
    [
        "url" => "tab_req_out.php", "href" => "salida", "icon" => "fa fa-sign-out",
    ],
    [
        "url" => "tab5.php", "href" => "anexos", "icon" => "fa fa-paperclip",
    ],
    [
        "url" => "tab6.php", "href" => "participantes", "icon" => "fa fa-users",
    ],
    [
        "url" => "tab7.php", "href" => "riesgos", "icon" => "fa fa-exclamation-triangle",
    ],
    [
        "url" => "tab8.php", "href" => "decision", "icon" => "fa fa-thumbs-up",
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SAIA - SGDEA</title>

        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">

	    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jspanel4/jspanel.css">

        <?= estilo_tabla_bootstrap("1.13") ?>

        <?= jquery() ?>
        <?= validate() ?>
        <?= bootstrap() ?>
        <?= icons() ?>
        <?= theme() ?>
        <?= librerias_UI("1.12") ?>

        <?= librerias_tabla_bootstrap("1.13", false, false) ?>

	    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jspanel4/jspanel.js"></script>
        <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jspanel4/extensions/hint/jspanel.hint.js"></script>

    </head>
    <body>

        <ul class="nav nav-tabs" id="tabsActividad" role="tablist">
            <?php foreach ($tabs as $tab): ?>
                <li class="nav-item">
                    <a class="nav-link tab_actividad" data-toggle="tab" href="#<?= $tab['href'] ?>" data-url="<?= $tab['url'] ?>" role="tab" style="min-width:auto">
                        <i class="f-12 <?= $tab['icon'] ?>"></i>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="contenidoTabsActividad">
            <?php foreach ($tabs as $tab): ?>
                <div class="tab-pane fade" id="<?= $tab['href'] ?>" role="tabpanel" aria-labelledby="<?= $tab['href'] ?>-tab"></div>
            <?php endforeach; ?>
        </div>

        <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
        <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>

        <script data-params='<?= json_encode($params) ?>'>
            var idflujo = "<?= $_REQUEST['idflujo'] ?>";

            $(function () {

                var params = $("script[data-params]").data("params");
                $('.tab_actividad').on('shown.bs.tab', function (e) {
                    let tab = $(e.target);
                    let container = $(tab.attr('href'))
                    console.log("params", params);
                    let url = tab.data('url');
                    let strParam = jQuery.param(params);
                    url += "?" + strParam;
                    container.load(url);
                });

                $('.tab_actividad:first').trigger('click');

                /*if(idflujo.length > 0){
                 $('.tab_actividad:not(:first)').addClass('disabled');
                 }*/
            });
        </script>
    </body>
</html>
