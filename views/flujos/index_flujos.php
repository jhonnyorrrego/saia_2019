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
    <div class="container m-0 p-0 mw-100 mx-100">
        <div class="row mx-0">
            <div class="col-12 col-md-4 d-md-block px-1" id="acciones"><a href="<?= $ruta_db_superior ?>/views/flujos/flujo.php" class="btn btn-primary btn-sm py-2">Adicionar</a></div>
            <div class="col-12 col-md-8 d-md-block d-none px-1" id="espacio_vacio"></div>
        </div>
        <div class="row mx-0">
            <div class="col-12 col-md-4 d-md-block px-1" id="listado"></div>
            <div class="col-12 col-md-8 d-md-block d-none px-1" id="right_workspace"></div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>">
        $(function(){
            //let baseUrl = $('script[data-baseurl]').data('baseurl');
            let baseUrl = "<?= $ruta_db_superior ?>";
            let rutaReporte = baseUrl + 'views/buzones/listado.php?idbusqueda_componente=<?= $_REQUEST['idbusqueda_componente'] ?>';

            $("#listado").load(rutaReporte, function(){
                setTimeout(function() {
                    window.resizeIframe();
                }, 1500);
            });

            if($('#right_workspace').is(':visible')){
                /*let rutaFlujos = baseUrl + 'views/flujos/flujo.php';
                $('#right_workspace').load(rutaFlujos);*/
            }

            window.addEventListener("orientationchange", function () {
                setTimeout(function() {
                    window.resizeIframe();
                }, 500);
            }, false);

            $(window).resize(function() {
                window.resizeIframe();
            });

            window.resizeIframe = function (){
                let frameH = $(window).height();
                let paginationH = $('.fixed-table-pagination').height();
                let headerH = $('#header_list').height();
                $(".fixed-table-container").height(frameH - paginationH - headerH);
                $('#right_workspace').height(frameH);
            }

            $
        	$("#listado").on("click", ".kenlace_saia", function() {
        		var enlace = baseUrl + "views/flujos/flujo.php?idflujo=";
        		var idflujo = $(this).data("idflujo");

        		enlace = enlace + idflujo;
        		window.open(enlace, "_self");
        	});

        });
    </script>
</body>
</html>