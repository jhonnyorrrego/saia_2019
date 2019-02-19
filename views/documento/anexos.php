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
    <div class="col-12">
        <div class="card card-borderless">
            <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                    <a class="active" data-toggle="tab" role="tab" data-target="#document_files" href="#">Anexos</a>
                </li>
                <li class="nav-item" id="show_pages">
                    <a href="#" data-toggle="tab" role="tab" data-target="#document_pages">Páginas</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="document_files">
                    <div class="row">
                        <div class="col-12" id="files_table"></div>
                    </div>
                </div>
                <div class="tab-pane " id="document_pages">
                    <div class="row">
                        <div class="col-12" id="pages_container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= dropzone() ?>
<?= bootstrapTable() ?>
<?= bootstrapTableEditable() ?>
<script src="<?= $ruta_db_superior ?>views/documento/js/anexos.js" data-fileparams='<?= json_encode($_REQUEST) ?>'></script>