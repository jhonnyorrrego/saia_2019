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
include_once $ruta_db_superior . "librerias_saia.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?= cssBootstrap() ?>
    <?= icons() ?>
    <?= kaiten() ?>
    <?= librerias_acciones_kaiten() ?>
</head>

<body>
    <div id="container"></div>

    <script>
        $(function() {
            var baseUrl = '<?= $ruta_db_superior ?>';
            var kaiten = $('#container');

            kaiten.kaiten({
                columnWidth: '100%',
                startup: function(dataFromURL) {
                    var panels = JSON.parse('<?= $_REQUEST["panels"] ?>');

                    for (panel of panels) {
                        panel.url = baseUrl + panel.url;
                        this.kaiten('load', panel);
                    }

                }
            });

            window.refresKaitenDashboard = function(panelId) {
                let panel = kaiten.kaiten("getPanel", panelId);
                kaiten.kaiten('reload', panel);
            }
            window.crear_pantalla_busqueda = function(datos, elimina) {
                var panel = kaiten.kaiten("getPanel", 1);

                if (elimina) {
                    if (typeof(panel) != 'undefined') {
                        kaiten.kaiten("removeChildren", panel);
                    }
                }

                datos.url = baseUrl + datos.url;
                kaiten.kaiten("load", datos);
            }
        });
    </script>
</body>

</html> 