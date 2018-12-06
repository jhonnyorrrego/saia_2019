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

require_once $ruta_db_superior . 'db.php';
require_once $ruta_db_superior . 'models/pagina.php';

$html = '';
if (isset($_SESSION["idfuncionario"])) {
    $html = '<ul id="sortable">';
    $paginas = Pagina::getAllResultDocument($_REQUEST["iddoc"], "pagina asc");
    for ($i = 0; $i < $paginas["numcampos"]; $i++) {
        $fileMin = $paginas["data"][$i] -> getUrlImagenTemp();
        $fileMax = $paginas["data"][$i] -> getUrlRutaTemp();
        if ($fileMin !== false && $fileMax !== false) {
            $html .= '<li id="' . $paginas["data"][$i] -> getPK() . '">' . $paginas["data"][$i] -> getPagina() . '<img src="' . $fileMin . '" data-toggle="tooltip" data-placement="bottom" title="Pagina No ' . $paginas["data"][$i] -> getPagina() . '" data-id="' . $paginas["data"][$i] -> getPK() . '" class="img-thumbnail img" /></li>';
        }
    }
    $html .= '</ul>';
}
echo $html;
