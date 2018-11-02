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
</head>
<body>
    <div class="container-fluid px-1 py-0">
        <div class="row">
            <div class="col-12 col-md-4">
                <iframe id="mailbox" frameborder="0" width="100%"></iframe>
            </div>
            <div class="d-none d-md-block col-md-8 ">
                CALENDARIO
            </div>
        </div>
    </div>
    <script>
        $(function(){
            var baseUrl = '<?= $ruta_db_superior ?>';
            let route = baseUrl + 'pantallas/busquedas/listado.php?idbusqueda_componente=<?= $_REQUEST['idbusqueda_componente'] ?>';
            $("#mailbox").attr('src', route).height($(window).height() - $("#k-topbar").height() - 5);
        });
    </script>
</body>
</html>