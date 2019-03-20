<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");

if (isset($_REQUEST['idnoticia_index'])) {
    
    $datos = busca_filtro_tabla('', 'noticia_index', 'idnoticia_index=' . $_REQUEST['idnoticia_index'], '', '', $conn);
    
    unlink($ruta_db_superior . $datos[0]['imagen']);
    $sql = "UPDATE noticia_index SET estado=0 WHERE idnoticia_index='" . $_REQUEST['idnoticia_index'] . "'";
    phpmkr_query($sql);
}

?>