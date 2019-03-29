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

require_once $ruta_db_superior . "controllers/autoload.php";
require_once $ruta_db_superior . 'assets/librerias.php';
require_once $ruta_db_superior . 'librerias_saia.php';

$params = (!empty($_REQUEST)) ? $_REQUEST : [];
$params2 = $params;
if (!empty($params['showDocuments']) && !empty($params['idexpediente'])) {
    $Expediente = new Expediente($params['idexpediente']);
    if ($Expediente->getAccessUser('c')) {
        $component = BusquedaComponente::findColumn('idbusqueda_componente', ['nombre' => 'expediente_documento']);
        $params2['idbusqueda_componente'] = $component[0];
        $params2['idtable'] ='tableDocs';
    } else {
        $params['showDocuments'] = 0;
    }
}
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
    <?= librerias_acciones_kaiten() ?>

</head>

<body>
    <div class="container m-0 p-0 mw-100 mx-100">
        <div class="row mx-0">
            <div class="col-12 px-1" id="mailbox"></div>
        </div>
        <div class="row mx-0">
            <div class="col-12 px-1" id="mailboxDocs"></div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>">
        $(function() {
            let baseUrl = $('script[data-baseurl]').data('baseurl');
            let params = <?= json_encode($params); ?>;
            let mailRoute = baseUrl + 'views/buzones/grid.php';

            $("#mailbox").load(mailRoute, params);

            if (params.showDocuments) {
                let params2 = <?= json_encode($params2); ?>;
                $("#mailboxDocs").load(mailRoute, params2);
            }

            /*$(window).resize(function() {
                window.resizeIframe();
            });

            window.resizeIframe = function() {
                let frameH = $(window).height();
                let paginationH = $('.fixed-table-pagination').height();
                let headerH = $('#header_list').height();
                $(".fixed-table-container").height(frameH - paginationH - headerH);
            }*/
        });
    </script>
</body>

</ html> 