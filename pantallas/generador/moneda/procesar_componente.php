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
include_once $ruta_db_superior . 'core/autoload.php';
include_once ($ruta_db_superior . "pantallas/lib/librerias_componentes.php");

function procesar_moneda($idcampo = '', $seleccionado = '', $accion = '', $campo = '') {
    global $conn;
    $campo = '';
    if ($idcampo == '') {
        return ("<div class='alert alert-error'>No existe campo para procesar</div>");
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }
    if ($seleccionado != '') {
        $valor = $seleccionado;
    } else {
        $valor = $campo["predeterminado"];
    }

    $obligatorio = "";
    if(!empty($campo["obligatoriedad"])) {
        $obligatorio = " *";
    }
    $eliminarPantalla = clase_eliminar_pantalla_componente($idcampo);
    
    $texto = "<li class='ui-state-default element' idpantalla_componente='{$campo["idpantalla_componente"]}' idpantalla_campo='{$idcampo}' id='pc_{$idcampo}' nombre='{$campo["nombre"]}'>{$eliminarPantalla}
    <span style='font-size:12px;'><b>{$campo["etiqueta"]} {$obligatorio}</b></span>";
    $texto .= '<div class="controls"><div class="input-prepend"><span class="add-on" style="">$</span>';
    $texto .= '<input id="' . $campo["nombre"] . '" type="number" value="' . $valor . '" name="' . $campo["nombre"] . '" class="span5">';
    $texto .= '</div></div></li>';
    return ($texto);
}
