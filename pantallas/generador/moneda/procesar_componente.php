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

    $texto = "<div class=\"control-group element\" idpantalla_componente=\"{$campo["idpantalla_componente"]}\" idpantalla_campo=\"$idcampo\"";
    $texto .= " id=\"pc_{$idcampo}\" nombre=\"{$campo["nombre"]}\">\n";
    $texto .= clase_eliminar_pantalla_componente($idcampo);
    $texto .= "\n  <label class=\"control-label\" for=\"{$campo["nombre"]}\"><b>{{$campo["etiqueta"]}{{$campo["obligatoriedad"]}<\/b>\n  <\/label>\n";
    $texto .= "<div class=\"controls\"> \n\t\t<div id=\"\" class=\"input-append\">\n\t\t\t";
    $texto .= "<input id=\"{$campo["nombre"]}\" type=\"text\" value=\"{$valor}\" class=\"\" style=\"width:70px\" name=\"{$campo["nombre"]}\">\n";
    $texto .= "<button class=\"btn\" type=\"button\" style=\"height:27px\" id=\"up_{$campo["nombre"]}\">+<\/button>\n";
    $texto .= "<button class=\"btn\" type=\"button\" style=\"height:27px\" id=\"down_{$campo["nombre"]}\">-<\/button>\n\t\t<\/div>\n  <\/div>\n<\/div>\n";
    $texto .= "<script>\n$(document).ready(function(){\n    $(\"#up_{$campo["nombre"]}\").click(function(){\nvar campo=$(\"#{$campo["nombre"]}\").val();\n";
    $texto .= "if(parseInt(campo)||campo==0)$(\"#{$campo["nombre"]}\").val(parseInt(campo)+1);\nelse $(\"#{$campo["nombre"]}\").val(0);\n    });\n";
    $texto .= "$(\"#down_{$campo["nombre"]}\").click(function(){\nvar campo=$(\"#{$campo["nombre"]}\").val();\n";
    $texto .= "if(parseInt(campo)||campo==0)$(\"#{$campo["nombre"]}\").val(parseInt(campo)-1);\nelse $(\"#{$campo["nombre"]}\").val(0);\n    });\n});\n<\/script>";

    return ($texto);
}
?>