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

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

$source = array(
    "url" => "app/arbol/proceso_formato.php",
    "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
        "iddocumento" => $_REQUEST['iddocumento']
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
<html>
<head>
    <style type="text/css">
        .estilo-arbol {
            font-family: verdana;
            font-size: 7pt;
        }

        ul.fancytree-container {
            width: 100%;
            height: 80%;
            overflow: auto;
            position: relative;
            border: none;
        }
    </style>
</head>
<body>
    <?= librariesForTopModal($libraries) ?>
    <script type="text/javascript">
        function evento_click(event, data) {
            var nodeId = data.node.key;
            
            if(data.node.isFolder()) {
                data.tree.activateKey(nodeId);
            }
        }
    </script>
    <?= $Tree->generar_html() ?>
</body>
</html>
