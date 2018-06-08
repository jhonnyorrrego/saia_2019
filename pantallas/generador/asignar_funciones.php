<?php
include_once ("../../formatos/librerias/funciones_acciones.php");

if (@$_REQUEST["adicionar"] == 1) {
    if (adicionar_funciones_accion(@$_REQUEST["acciones"], @$_REQUEST["idformato"], @$_REQUEST["funciones"], @$_REQUEST["momento"], @$_REQUEST["estado"])) {
        alerta("Asignacion realizada Correctamente");
    } else
        alerta("Problemas al realizar la asignacion");
} else if (@$_REQUEST["editar"] == 1 && @$_REQUEST["idformato"]) {
    if (modificar_funciones_accion(@$_REQUEST["acciones"], @$_REQUEST["idformato"], @$_REQUEST["funciones"], @$_REQUEST["momento"], @$_REQUEST["estado"], @$_REQUEST["accion_funcion"])) {
        alerta("Asignacion Editada Correctamente");
    } else
        alerta("Problemas al editar la asignacion");
} else if (@$_REQUEST["eliminar"] == 1 && @$_REQUEST["idformato"]) {
    if (eliminar_funciones_accion(@$_REQUEST["acciones"], @$_REQUEST["idformato"], @$_REQUEST["funciones"], @$_REQUEST["momento"], @$_REQUEST["estado"], @$_REQUEST["accion_funcion"])) {
        alerta("Asignacion eliminada Correctamente");
        redirecciona("asignar_funciones.php?idformato=" . $_REQUEST["idformato"]);
    } else
        alerta("Problemas al eliminar la funcion");
}

if ($idpantalla) {
    $texto = '<br /><br /><div align="center">';
    if (@$_REQUEST["accion_ejecutar"] == 1) {
        $texto .= "<b>EDITANDO ASIGNACION<br /><br /></b>";
    } else if (@$_REQUEST["accion_ejecutar"] == 2) {
        $texto .= "<b>ELIMINANDO ASIGNACION<br /><br /></b>";
    } else {
        $texto .= "<b>ASIGNANDO<br /><br /></b>";
    }
    $texto .= '<form class="form-horizontal" method="POST" name="asignar_funcion_formato">';
    $idformato = $idpantalla;
    $lacciones = busca_filtro_tabla("", "accion", "", "", $conn);

    $lfunciones = busca_filtro_tabla("", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $idformato . " AND nombre_funcion<>'transferencia_automatica'", "", $conn);
    $accion_formato = 0;
    if (@$_REQUEST["accion_funcion"]) {
        $accion_formato = $_REQUEST["accion_funcion"];
    }
    $accion_funcion = busca_filtro_tabla("", "funciones_formato_accion", "idfunciones_formato_accion=" . $accion_formato, "", $conn);
    // print_r($lfunciones["numcampos"]."#".$lacciones["numcampos"]);die();
    if ($lfunciones["numcampos"] && $lacciones["numcampos"]) {
        $texto .= '<div class="control-group"><label class="control-label" for="funciones" title="Listado de funciones que se encuentran disponibles para el formato, si desea agregar una función debe adicionarla al formato directamente" >Funciones disponibles para el formato *: </label>';
        $texto .= '<div class="controls"><select name="funciones" id="funciones"><option value="">Seleccione...</option>';
        for ($i = 0; $i < $lfunciones["numcampos"]; $i++) {
            $texto .= '<option value="' . $lfunciones[$i]["idfunciones_formato"] . '"';
            if ($accion_funcion["numcampos"] && $accion_funcion[0]["idfunciones_formato"] == $lfunciones[$i]["idfunciones_formato"])
                $texto .= " SELECTED ";
            $texto .= '>' . delimita($lfunciones[$i]["etiqueta"] . " (" . $lfunciones[$i]["nombre_funcion"], 50) . ')</option>';
        }
        $texto .= '</select></div></div>';
        $texto .= '<div class="control-group"><label class="control-label" for="momento" title="momento en que se debe realizar la accion">Momento *: </label>';
        $texto .= '<div class="controls"><label class="radio inline"><input type="radio" name="momento" id="momento" value="ANTERIOR" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["momento"] == "ANTERIOR") {
            $texto .= " CHECKED ";
        }
        $texto .= '> ANTERIOR A</label>';
        $texto .= '<label class="radio inline"><input type="radio" name="momento" id="momento" value="POSTERIOR" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["momento"] == "POSTERIOR") {
            $texto .= " CHECKED ";
        }
        $texto .= '> POSTERIOR A</label></div></div>';
        $texto .= '<div class="control-group"><label class="control-label" for="acciones" title="accion que se debe tener en cuenta a la hora de realizar la consulta por ejemplo: editar, adicionar, aprobar en las acciones de los scripts sse deben adicionar estas acciones, la ruta es relativa a la carpeta formato">Accion a validar: </label>';
        $texto .= '<div class="controls"><select name="acciones" id="acciones">';
        for ($i = 0; $i < $lacciones["numcampos"]; $i++) {
            $texto .= '<option value="' . $lacciones[$i]["idaccion"] . '"';
            if ($accion_funcion["numcampos"] && $accion_funcion[0]["accion_idaccion"] == $lfunciones[$i]["idaccion"]) {
                $texto .= " SELECTED ";
            }
            $texto .= '>' . $lacciones[$i]["nombre"] . " (" . $lacciones[$i]["ruta"] . ')</option>';
        }
        $texto .= '</select></div></div>';
        $texto .= '<div class="control-group"><label class="control-label" for="estado" title="Estado Actual de la asignacion que define si se debe realizar la accion o no">Estado: </label>';
        $texto .= '<div class="controls"><label class="radio inline"><input type="radio" name="estado" id="estado" value="1" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["estado"] == 1) {
            $texto .= " CHECKED ";
        }
        $texto .= '> ACTIVO</label>';
        $texto .= '<label class="radio inline"><input type="radio" name="estado" id="estado" value="0"';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["estado"] == 0) {
            $texto .= " CHECKED ";
        }
        $texto .= '> INACTIVO</label>';
        if (@$_REQUEST["accion_ejecutar"] == 1) {
            $texto .= '<input type="hidden" name="editar" value="1">';
            $texto .= '<input type="hidden" name="idaccion_funcion" value="' . $_REQUEST["accion_funcion"] . '">';
        } else if (@$_REQUEST["accion_ejecutar"] == 2) {
            $texto .= '<input type="hidden" name="eliminar" value="1">';
            $texto .= '<input type="hidden" name="idaccion_funcion" value="' . $_REQUEST["accion_funcion"] . '">';
        } else {
            $texto .= '<input type="hidden" name="adicionar" value="1">';
        }
        $texto .= '<input type="hidden" name="idformato" value="' . $_REQUEST["idformato"] . '">';
        $texto .= '</div></div>';
        $texto .= '<div class="control-group"><div class="controls"><input type="submit"></div></div>';
    }
    $texto .= '</form>';
}
$lasignadas = busca_filtro_tabla("A.nombre AS accion, A.ruta AS ruta_accion,B.etiqueta AS funcion, B.ruta AS ruta_funcion, C.estado AS estado_af, B.parametros,C.idfunciones_formato_accion", "funciones_formato_accion C,accion A,funciones_formato B", "C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato AND C.formato_idformato=" . $_REQUEST["idformato"], "", $conn);
if ($lasignadas["numcampos"]) {
    $texto .= '<table style="border-collapse:collapse;" border="1px" width="80%">';
    $texto .= '<thead><tr><th>Acci&oacute;n</th><th>Ruta<br />Acci&oacute;n</th><th>Funci&oacute;n</th><th>Ruta<br />Funci&oacute;n</th><th>Ejecutar?</th><th>&nbsp</th><th>&nbsp;</th></tr></thead>';
    for ($j = 0; $j < $lasignadas["numcampos"]; $j++) {
        if ($lasignadas[$j]["estado_af"] == 1) {
            $estado = '<i class="icon-plus"></i>';
        } else
            $estado = '<i class="icon-minus"></i>';
        $texto .= '<tr ><td>' . $lasignadas[$j]["accion"] . '&nbsp;</td><td>' . $lasignadas[$j]["ruta_accion"] . '&nbsp;</td><td>' . $lasignadas[$j]["funcion"] . '&nbsp;</td><td>' . $lasignadas[$j]["ruta_funcion"] . '&nbsp;</td><td align="center">' . $estado . '</td><td>';
        if ($lasignadas[$j]["funcion"] != "transferencia_automatica") {
            $texto .= '<a href="asignar_funciones.php?idformato=' . $idpantalla . '&accion_ejecutar=1&accion_funcion=' . $lasignadas[$j]["idfunciones_formato_accion"] . '"><i class="icon-edit"></i></a></td>';
            $texto .= '<td><a href="asignar_funciones.php?idformato=' . $idpantalla . '&accion_ejecutar=2&accion_funcion=' . $lasignadas[$j]["idfunciones_formato_accion"] . '"><i class="icon-remove"></i></a>';
        } else {
            $texto .= '</td><td>';
        }
        $texto .= '</td></tr>';
    }
    $texto .= '</table>';
}
echo ($texto . "</div>");

include_once ("../footer.php");
?>
