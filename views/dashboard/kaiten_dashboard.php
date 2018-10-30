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
    <title>Document</title>

    <?= kaiten() ?>
</head>
<body>
    <div id="container"></div>

    <script>
        $(function(){
            var baseUrl = '<?= $ruta_db_superior ?>';

            $('#container').kaiten({
                columnWidth : '100%',
                startup : function(dataFromURL){
                    this.kaiten('load', {
                        kConnector:'html.page',
                        url: baseUrl + 'views/dashboard/index_dashboard.php?idbusqueda_componente=<?=$_REQUEST['idbusqueda_componente']?>',
                        kTitle :'titulo kaiten dashboard'
                    });
                }
            });  
        });
    </script>
</body>
</html>