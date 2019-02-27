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
$idcaja = $_REQUEST['idcaja'];
if (!$idcaja) {
	return;
}
require_once $ruta_db_superior . "controllers/autoload.php";
include_once $ruta_db_superior . 'assets/librerias.php';
echo validate();
echo select2();

$Caja = new Caja($idcaja);
$tabs = [
    [
        'href' => 'information',
        'url' => "{$ruta_db_superior}views/caja/detalle_caja.php?idcaja={$idcaja}",
        'icon' => 'fa fa-info-circle'
    ]
];
    
if($Caja->isResponsable()){
    $tabs[]=[
        'href' => 'responsable',
        'url' => "{$ruta_db_superior}views/caja/cambiar_responsable.php?idcaja={$idcaja}",
        'icon' => 'fa fa-user'
    ];

    $tabs[]=[
        'href' => 'link',
        'url' => "{$ruta_db_superior}views/caja/asignar_entidadserie.php?idcaja={$idcaja}",
        'icon' => 'fa fa-link'
    ];
}
?>
<ul class="nav nav-tabs" id="cajaTab" role="tablist">
    <?php foreach($tabs as $tab): ?>
        <li class="nav-item">
            <a class="nav-link cajaTab" data-toggle="tab" href="#<?= $tab['href'] ?>" data-url="<?= $tab['url'] ?>" role="tab" style="min-width:auto">
                <i class="f-12 <?= $tab['icon'] ?>"></i>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<div class="tab-content" id="cajaTabContent">
    <?php foreach($tabs as $tab): ?>
        <div class="tab-pane fade" id="<?= $tab['href'] ?>" role="tabpanel" aria-labelledby="<?= $tab['href'] ?>-tab"></div>
    <?php endforeach; ?>
</div>   
<script>
    $(function(){
        $('.cajaTab').on('shown.bs.tab', function (e) {
            let tab = $(e.target);
            let container = $(tab.attr('href'))

            container.empty().load(tab.data('url'));
        });
        $('.cajaTab:first').trigger('click');
    });
</script>