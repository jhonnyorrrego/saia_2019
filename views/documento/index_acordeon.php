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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= icons() ?>
    <?= theme() ?>
    <?= moment() ?>
</head>
<body>
    <div class="container m-0 p-0 mw-100 mx-100">
        <div class="row mx-0">
            <div class="col-12" id="content" style="overflow: auto;"></div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>" data-params='<?= json_encode($_REQUEST) ?>'>
        $(function(){
            let baseUrl = $('script[data-baseurl]').data('baseurl');
            let params = $('script[data-params]').data('params');

            let acordeonRoute = baseUrl + 'views/documento/acordeon.php';
            $('#content').load(acordeonRoute, params);

            window.addEventListener("orientationchange", function () {
                setTimeout(() => {
                    window.resizeIframe();
                }, 500);
            }, false);

            $(window).resize(function() {
                window.resizeIframe();
            });
            
            window.resizeIframe = function (){
                $('#content').height($(window).height());
            }
        });
    </script>
</body>
</html>