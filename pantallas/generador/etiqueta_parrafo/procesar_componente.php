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

function procesar_etiqueta($idcampo = '', $seleccionado = '', $accion = '', $campo = '') {
    global $conn, $ruta_db_superior;
    if ($idcampo == '') {
        return ("<div class='alert alert-error'>No existe campo para procesar</div>");
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }
    if ($seleccionado != '') {
        $predeterminado = $seleccionado;
    } else {
        $predeterminado = $campo["predeterminado"];
    }
    $datos = "<b>Texto informativo:</b> no se almacena en base de datos, por favor llenar sobre el campo valor de llenado";
    if(!empty($campo["valor"])) {
        $datos = $campo["valor"];
    }

    $texto = '<div class="control-group element" idpantalla_componente="' . $campo["idpantalla_componente"]. '"';
    $texto .= '" idpantalla_campo="' . $idcampo . '" id="pc_' . $idcampo . '" nombre="' . $campo["etiqueta_html"] . '">';
    $texto .= clase_eliminar_pantalla_componente($idcampo);
    $texto .= "<p>$datos</p>";
    $texto .= "\n</div>";

    return ($texto);
}
?>