<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");

function procesar_etiqueta_linea($idcampo = '', $seleccionado = '', $accion = '', $campo = '') {
    global $conn, $ruta_db_superior;
    if ($idcampo == '') {
        return ("<div class='alert alert-error'>No existe campo para procesar</div>");
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }


    $eliminarComponente = clase_eliminar_pantalla_componente($idcampo);
    $texto = "<li class='ui-state-default element' idpantalla_componente='{$campo["idpantalla_componente"]}' idpantalla_campo='{$idcampo}' id='pc_{$idcampo}' nombre='{$campo["etiqueta_html"]}'>
        <span class='ui-icon ui-icon-arrowthick-2-n-s' style='font-size:12px;'> {$datos}</span> {$eliminarComponente}<hr style='background - color : brown;
    ' width='90 %' size='1'>
    </li>";

    return ($texto);
}
?>