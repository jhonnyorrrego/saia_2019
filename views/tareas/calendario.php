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
<link rel='stylesheet' href='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.css'>

<input type="hidden" id="picker">
<div id="calendar"></div>

<script src='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/fullcalendar.min.js'></script>
<script src='<?= $ruta_db_superior ?>assets/theme/assets/plugins/fullcalendar-3.9.0/locale/es.js'></script>
<?= dateTimePicker() ?>
<script src='<?= $ruta_db_superior ?>views/tareas/js/calendario.js'></script>