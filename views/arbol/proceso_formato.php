<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

$source = array(
    "url" => "app/arbol/proceso_formato.php",
    "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
        "documentId" => $_REQUEST['documentId']
    )
);
$treeOptions = array(
    "keyboard" => true,
    "onNodeClick" => "evento_click",
    "busqueda_item" => 0
);

$Tree = new ArbolFt("tree_process", $source, $treeOptions);

$libraries = [
    librerias_UI("1.12"),
    librerias_arboles_ft("2.24", 'filtro')
];
?>
<link href="<?= $ruta_db_superior ?>views/arbol/css/arbol.css" rel="stylesheet" type="text/css">
<div class="container">
    <div class="row px-0">
        <div class="col-12 px-0">
            <?= $Tree->generar_html() ?>
        </div>
    </div>
</div>
<?= librariesForTopModal($libraries) ?>
<script type="text/javascript">
    function evento_click(event, data) {
        var nodeId = data.node.key;
        
        if(data.node.isFolder()) {
            data.tree.activateKey(nodeId);
        }
        console.log(nodeId);
    }
</script>