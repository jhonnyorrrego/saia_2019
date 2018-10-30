<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>SAIA - SGDEA</title>
        <?= jquery() ?>
        <?= bootstrap() ?>
        <?= icons() ?>
        <?= bootstrapTable() ?>
        <?= moment() ?>
    </head>
    <body>
        <div class="container">
            <div class="row" id="header_list">ESPACIO PARA ACCIONES</div>
            <div class="row" id="content">
                <table id="table"></table>
            </div>
        </div>
        <script>
            $(function(){
                $('#table').bootstrapTable({
                    url: '<?= $ruta_db_superior ?>app/busquedas/datosBootstrapTable.php?idbusqueda_componente=<?= $_REQUEST['idbusqueda_componente'] ?>',
                    sidePagination: 'server',
                    queryParamsType: 'other',
                    columns: [{
                        field: 'info',
                        formatter: function(value, row, index){
                            let node = $(value);
                            node.find('#checkbox_location').html(`<input data-index="${index}" name="btSelectItem" type="checkbox">`);
                            return node.prop('outerHTML');
                        }
                    }],
                    cardView : true,
                    pagination: true
                });
            });
        </script>
    </body>
</html>