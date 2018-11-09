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
    <?= icons() ?>
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
                    var panels = JSON.parse('<?= $_REQUEST["panels"] ?>');
                    
                    for(panel of panels){
                        panel.url = baseUrl + panel.url;
                        this.kaiten('load', panel);
                    }
                    
                }
            });

            window.crear_pantalla_busqueda = function(datos,elimina){
                var panel = $('#container').kaiten("getPanel",1);

                if(elimina){
                    if(typeof(panel) != 'undefined'){
                        $('#container').kaiten("removeChildren", panel);
                    }
                }
                
                datos.url = baseUrl + datos.url;
                $('#container').kaiten("load",datos);                                                  
            }
        });
    </script>
</body>
</html>