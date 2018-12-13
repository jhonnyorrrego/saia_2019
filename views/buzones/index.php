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
    <?= theme() ?>
    <?= toastr() ?>
</head>
<body>
    <div class="container m-0 p-0 mw-100 mx-100">
        <div class="row mx-0">
            <div class="col-12 col-md-4 d-md-block px-1" id="mailbox"></div>
            <div class="col-12 col-md-8 d-md-block d-none px-1" id="right_workspace">
                <iframe id="iframe_right_workspace" width="100%" frameBorder="0"></iframe>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            var baseUrl = '<?= $ruta_db_superior ?>';
            var component = '<?= $_REQUEST['idbusqueda_componente'] ?>';
            var param = '<?= $_REQUEST['variable_busqueda'] ?>';

            let route = `${baseUrl}views/buzones/listado.php?idbusqueda_componente=${component}&variable_busqueda=${param}`;
            $("#mailbox").load(route, function(){
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

            $('#iframe_right_workspace').on('load', function(){
                $(this).height($(window).height());
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
                $('#iframe_right_workspace').height($(window).height());
            }
        });
    </script>
</body>
</html>