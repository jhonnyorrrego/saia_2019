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

<div class="row mx-0">
    <div class="col-12" id="task_files"></div>
</div>

<?= dropzone() ?>
<?= bootstrapTable() ?>
<script src="<?= $ruta_db_superior ?>views/tareas/js/anexos.js"></script> 