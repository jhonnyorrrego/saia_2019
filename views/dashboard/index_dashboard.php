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
    <?= breakpoint() ?>
    <?= toastr() ?>
    <?= icons() ?>
    <?= theme() ?>
</head>
<body>
    <div class="container-fluid mx-2 px-1">
        <div class="row">
            <div class="col-12 col-md-4 px-1 ">
                <div id="mailbox"></div>
            </div>
            <div class="d-none d-md-block col-md-8 ">
                CALENDARIO
            </div>
        </div>
    </div>
    <script>
        $(function(){
            var baseUrl = '<?= $ruta_db_superior ?>';

            (function loadMailbox(){
                let route = baseUrl + 'pantallas/busquedas/listado.php';
                let data = {
                    idbusqueda_componente : '<?= $_REQUEST['idbusqueda_componente'] ?>'
                }

                $("#mailbox").load(route, data, function(response, status, xhr){
                    $('#table').on('load-success.bs.table', function (data) {
                        $(".pagination-detail").html('<span id="total_items"></span>');
                        $("#total_items").text('Registros '+ $('#table').bootstrapTable('getOptions').totalRows);
                    });
                });
            })();
        });
    </script>
</body>
</html>