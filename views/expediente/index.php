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
include_once $ruta_db_superior . 'librerias_saia.php';

$params = (!empty($_REQUEST)) ? $_REQUEST : [];
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
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>">
        $(function(){
            let baseUrl = $('script[data-baseurl]').data('baseurl');
            let params = <?= json_encode($params); ?>;
            let mailRoute = baseUrl + 'views/buzones/grid.php';

            $("#mailbox").load(mailRoute,params);

            $(window).resize(function() {
                window.resizeIframe();
            });
            
            window.resizeIframe = function (){
                let frameH = $(window).height();
                let paginationH = $('.fixed-table-pagination').height();
                let headerH = $('#header_list').height();
                $(".fixed-table-container").height(frameH - paginationH - headerH);
            }
        });
    </script>
</body>
</html>