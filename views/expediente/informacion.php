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
$idexpediente = $_REQUEST['idexpediente'];
if (!$idexpediente) {
	return;
}
require_once $ruta_db_superior . "controllers/autoload.php";

$Expediente = new Expediente($idexpediente);
$tabs = [[
        'href' => 'information',
        'url' => "{$ruta_db_superior}views/expediente/detalle_expediente.php?idexpediente={$idexpediente}",
        'icon' => 'fa fa-info-circle'
]
];

if(!$Expediente->nucleo){
    $tabs[]=[
        'href' => 'history',
        'url' => "{$ruta_db_superior}views/expediente/historial_cierre.php?idexpediente={$idexpediente}",
        'icon' => 'fa fa-history'
    ];
    
    if($Expediente->isResponsable()){
        $tabs[]=[
            'href' => 'responsable',
            'url' => "{$ruta_db_superior}views/expediente/cambiar_responsable.php?idexpediente={$idexpediente}",
            'icon' => 'fa fa-user'
        ];
    }

    if ($Expediente->getAccessUser('c')) {
        $tabs[]=[
            'href' => 'share',
            'url' => "{$ruta_db_superior}views/expediente/compartir_expediente.php?opcion=1&idexpediente={$idexpediente}",
            'icon' => 'fa fa-share-alt'
        ];
    }
}
?>
<ul class="nav nav-tabs" id="ExpTab" role="tablist">
    <?php foreach($tabs as $tab): ?>
        <li class="nav-item">
            <a class="nav-link ExpTab" data-toggle="tab" href="#<?= $tab['href'] ?>" data-url="<?= $tab['url'] ?>" role="tab" style="min-width:auto">
                <i class="f-12 <?= $tab['icon'] ?>"></i>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<div class="tab-content" id="ExpTabContent">
    <?php foreach($tabs as $tab): ?>
        <div class="tab-pane fade" id="<?= $tab['href'] ?>" role="tabpanel" aria-labelledby="<?= $tab['href'] ?>-tab"></div>
    <?php endforeach; ?>
</div>   
<script>
    $(function(){
        $('.ExpTab').on('shown.bs.tab', function (e) {
            let tab = $(e.target);
            let container = $(tab.attr('href'))

            container.load(tab.data('url'));
        });
        $('.ExpTab:first').trigger('click');
    });
</script>