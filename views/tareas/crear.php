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

$tabs = [
    [
        'href' => 'information',
        'url' => "{$ruta_db_superior}views/tareas/informacion.php",
        'icon' => 'fa fa-calendar',
        'tooltip' => 'Tarea'
    ], [
        'href' => 'priority',
        'url' => "{$ruta_db_superior}views/tareas/prioridad.php",
        'icon' => 'fa fa-flag',
        'tooltip' => 'Prioridad'
    ], [
        'href' => 'files',
        'url' => "{$ruta_db_superior}views/tareas/anexos.php",
        'icon' => 'fa fa-paperclip',
        'tooltip' => 'Anexos'
    ], [
        'href' => 'followers',
        'url' => "{$ruta_db_superior}views/tareas/seguidores.php",
        'icon' => 'fa fa-users',
        'tooltip' => 'Seguidores'
    ], [
        'href' => 'concurrence',
        'url' => "{$ruta_db_superior}views/tareas/recurrencia.php",
        'icon' => 'fa fa-history',
        'tooltip' => 'Recurrencia'
    ], [
        'href' => 'tags',
        'url' => "{$ruta_db_superior}views/tareas/etiquetas.php",
        'icon' => 'fa fa-tags',
        'tooltip' => 'Etiquetas'
    ], [
        'href' => 'comments',
        'url' => "{$ruta_db_superior}views/tareas/comentarios.php",
        'icon' => 'fa fa-comments',
        'tooltip' => 'Comentarios'
    ], [
        'href' => 'state',
        'url' => "{$ruta_db_superior}views/tareas/estado.php",
        'icon' => 'fa fa-thumbs-up',
        'tooltip' => 'Estado'
    ]
];
?>
<nav class="navbar navbar-expand-lg navbar-light px-0">
    <a class="navbar-brand d-lg-none" href="#">Opciones</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#task_navbar" aria-controls="task_navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="task_navbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 d-flex justify-content-around">
            <?php foreach ($tabs as $tab) : ?>
                <li class="nav-item btn btn-sm py-0 px-2">
                    <a class="nav-link tasktab p-2" data-toggle="tab" href="#<?= $tab['href'] ?>" data-url="<?= $tab['url'] ?>" role="tab" style="min-width:auto" title="<?= $tab['tooltip'] ?>">
                        <i class="f-20 <?= $tab['icon'] ?>"></i>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
<div class="tab-content" id="taskTabContent">
    <?php foreach ($tabs as $tab) : ?>
        <div class="tab-pane fade" id="<?= $tab['href'] ?>" role="tabpanel" aria-labelledby="<?= $tab['href'] ?>-tab"></div>
    <?php endforeach; ?>
</div>
<script data-params='<?= json_encode($_REQUEST) ?>'>
    $(function() {
        let taskId = "<?= !empty($_REQUEST['id']) ? $_REQUEST['id'] : 0 ?>";

        $('.tasktab').on('shown.bs.tab', function(e) {
            let tab = $(e.target);
            let container = $(tab.attr('href'));
            container.load(tab.data('url'));

            if ($(':button[aria-expanded="true"]').length) {
                $(':button[data-target="#task_navbar"]').trigger('click');
            }
            $('.tasktab').removeClass('active');
            $(this).addClass('active');
        });

        $('.tasktab:first').trigger('click');
        if (!+taskId) {
            $('.tasktab:not(:first)').addClass('disabled');
        }
    });
</script>