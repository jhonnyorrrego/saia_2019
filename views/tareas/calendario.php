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

    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>

    <link rel='stylesheet' href='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.css'>
</head>
<body>
    <div id='calendar' class="container-fluid"></div>

    <?= moment() ?>
    
    <script src='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.js'></script>
    <script src='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/locale/es.js'></script>
    <script src='<?= $ruta_db_superior ?>views/tareas/js/calendario.js' data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>
</html>