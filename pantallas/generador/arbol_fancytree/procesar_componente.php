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
include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";

function procesar_fancytree($idcampo = '', $seleccionado = '', $accion = '', $campo = '')
{
    global $conn, $ruta_db_superior;
    if ($idcampo == '') {
        return "<div class='alert alert-error'>No existe campo para procesar</div>";
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }
    $texto = '';
    $encabezado_fancy = '';
    $pie_fancy = '';
    $adicionales_fancy = '';

    $parametros = json_decode($campo["valor"], true);
    if (json_last_error() === JSON_ERROR_NONE) {
        //procesar parametros;
    }

    /*$encabezado_fancy = '<div class="control-group element" idpantalla_componente="' . $campo["idpantalla_componente"] . '" 
    idpantalla_campo="' . $idcampo . '" id="pc_' . $idcampo . '" nombre="' . $campo["etiqueta_html"] . '">' 
    . clase_eliminar_pantalla_componente($idcampo) . '<label class="control-label" for="' . $campo["nombre"] . '">
    <b>' . $campo["etiqueta"];
    if ($campo["obligatoriedad"]) {
        $encabezado_fancy .= '*';
    }
    $encabezado_fancy .= '</b></label><div class="controls">';
    $pie_fancy = '</div></div>';*/

    $eliminarComponente = clase_eliminar_pantalla_componente($idcampo);
    $texto = "<li class='ui-state-default element' idpantalla_componente='{$campo["idpantalla_componente"]}' 
    idpantalla_campo='{$idcampo}' id='pc_{$idcampo}' nombre='{$campo["etiqueta_html"]}'>
        <span class='fa fa-sitemap fa-fw' style='font-size:12px;'></span> {$eliminarComponente} <b>{$campo["etiqueta"]}</b>    </li>";


    return ($texto);
}
    /*$origen = array();
    $opciones_arbol = array(
        "keyboard" => true, "debugLevel" => 4
    );
    $extensiones = array();
    $arbol = new ArbolFt($campo["nombre"], $origen, $opciones_arbol, $extensiones);
    $componente = $arbol->generar_html();

    $texto .= $encabezado_fancy . $componente . $pie_fancy;
    return ($texto);
}*/