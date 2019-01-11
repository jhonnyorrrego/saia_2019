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
</head>
<body>
    <div class="container m-0 p-0 mw-100 mx-100">
        <div class="row mx-0">
            <div class="col-12 col-md-4 d-md-block px-1" id="mailbox"></div>
            <div class="col-12 col-md-8 d-md-block d-none px-1" id="right_workspace" style="overflow: auto;"></div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>">
        $(function(){
            let baseUrl = $('script[data-baseurl]').data('baseurl');
            let mailRoute = baseUrl + 'views/buzones/listado.php?idbusqueda_componente=<?= $_REQUEST['idbusqueda_componente'] ?>';

            $("#mailbox").load(mailRoute, function(){
                if($("#right_workspace").is(':visible')){
                    let interval = setInterval(() => {
                        if($(".show_document").length){
                            $(".show_document").first().trigger('click');
                            clearInterval(interval);
                        }
                    }, 50);
                }
                
                setTimeout(() => {
                    window.resizeIframe();
                }, 1000);
            });

            window.addEventListener("orientationchange", function () {
                setTimeout(() => {
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
        });
    </script>
</body>
</html>