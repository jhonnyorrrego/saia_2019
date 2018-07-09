<?php
include_once ("../../formatos/librerias/funciones_acciones.php");

$retorno = array();

if (@$_REQUEST["accion_form"] == "consultar") {
    $accion_formato = 0;
    if (@$_REQUEST["accion_funcion"]) {
        $accion_formato = $_REQUEST["accion_funcion"];
    }
    $retorno["exito"] = 0;
    $accion_funcion = busca_filtro_tabla("", "funciones_formato_accion", "idfunciones_formato_accion=" . $accion_formato, "", $conn);
    if ($accion_funcion["numcampos"]) {
        $retorno["datos"]["idfunciones_formato_accion"] = $accion_funcion[0]["idfunciones_formato_accion"];
        $retorno["datos"]["idfunciones_formato"] = $accion_funcion[0]["idfunciones_formato"];
        $retorno["datos"]["accion_idaccion"] = $accion_funcion[0]["accion_idaccion"];
        $retorno["datos"]["formato_idformato"] = $accion_funcion[0]["formato_idformato"];
        $retorno["datos"]["momento"] = $accion_funcion[0]["momento"];
        $retorno["datos"]["estado"] = $accion_funcion[0]["estado"];
        $retorno["datos"]["orden"] = $accion_funcion[0]["orden"];

        $retorno["exito"] = 1;
    } else {
        $retorno["sql"] = $accion_funcion["sql"];
    }
    echo (json_encode($retorno));
    die();
} else if(@$_REQUEST["accion_form"] == "eliminar") {
    if (eliminar_funciones_accion(null, null, null, null, null, @$_REQUEST["accion_funcion"])) {
        $retorno["exito"] = 1;
        $retorno["asignadas"] = obtener_asignadas(@$_REQUEST["idformato"]);
        //alerta("Asignacion eliminada Correctamente");
    } else {
        $retorno["exito"] = 0;
        //alerta("Problemas al eliminar la funcion");
    }
    echo (json_encode($retorno));
    die();
} else if (@$_REQUEST["accion_form"] == "adicionar") {
    if (adicionar_funciones_accion(@$_REQUEST["acciones"], @$_REQUEST["idformato"], @$_REQUEST["funciones"], @$_REQUEST["momento"], @$_REQUEST["estado"])) {
        $retorno["asignadas"] = obtener_asignadas(@$_REQUEST["idformato"]);
        $retorno["exito"] = 1;
        //alerta("Asignacion realizada Correctamente");
    } else {
        $retorno["exito"] = 0;
        //alerta("Problemas al realizar la asignacion");
    }
    echo (json_encode($retorno));
    die();
} else if (@$_REQUEST["accion_form"] == "editar" && @$_REQUEST["idformato"]) {
    if (modificar_funciones_accion(@$_REQUEST["acciones"], @$_REQUEST["idformato"], @$_REQUEST["funciones"], @$_REQUEST["momento"], @$_REQUEST["estado"], @$_REQUEST["accion_funcion"])) {
        $retorno["asignadas"] = obtener_asignadas(@$_REQUEST["idformato"]);
        $retorno["exito"] = 1;
        //alerta("Asignacion Editada Correctamente");
    } else {
        $retorno["exito"] = 0;
        //alerta("Problemas al editar la asignacion");
    }
    echo (json_encode($retorno));
    die();

}

if (empty($idpantalla)) {
    $idpantalla = $_REQUEST["idformato"];
}

if ($idpantalla) {
    $texto = '<br /><br /><div>';
    if (@$_REQUEST["accion_ejecutar"] == 1) {
        $texto .= "<p id='titulo'><b>EDITANDO ASIGNACION</b></p>";
    } else if (@$_REQUEST["accion_ejecutar"] == 2) {
        $texto .= "<p id='titulo'><b>ELIMINANDO ASIGNACION</b></p>";
    } else {
        $texto .= "<p id='titulo'><b>ASIGNANDO</b></p>";
    }
    $texto .= '<form class="form-horizontal" method="POST" name="asignar_funcion_formato" id="asignar_funcion_formato">';
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
            if ($accion_funcion["numcampos"] && $accion_funcion[0]["idfunciones_formato"] == $lfunciones[$i]["idfunciones_formato"]) {
                $texto .= " SELECTED ";
            }
            $texto .= '>' . delimita($lfunciones[$i]["etiqueta"] . " (" . $lfunciones[$i]["nombre_funcion"], 50) . ')</option>';
        }
        $texto .= '</select></div></div>';
        $texto .= '<div class="control-group"><label class="control-label" for="momento" title="momento en que se debe realizar la accion">Momento *: </label>';
        $texto .= '<div class="controls"><label class="radio inline"><input type="radio" name="momento" id="momento1" value="ANTERIOR" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["momento"] == "ANTERIOR") {
            $texto .= " CHECKED ";
        }
        $texto .= '> ANTERIOR A</label>';
        $texto .= '<label class="radio inline"><input type="radio" name="momento" id="momento2" value="POSTERIOR" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["momento"] == "POSTERIOR") {
            $texto .= " CHECKED ";
        }
        $texto .= '> POSTERIOR A</label></div></div>';
        $texto .= '<div class="control-group"><label class="control-label" for="acciones" title="accion que se debe tener en cuenta a la hora de realizar la consulta por ejemplo: editar, adicionar, aprobar en las acciones de los scripts sse deben adicionar estas acciones, la ruta es relativa a la carpeta formato">Acci&oacute;n a validar: </label>';
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
        $texto .= '<div class="controls"><label class="radio inline"><input type="radio" name="estado" id="estado1" value="1" ';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["estado"] == 1) {
            $texto .= " CHECKED ";
        }
        $texto .= '> ACTIVO</label>';
        $texto .= '<label class="radio inline"><input type="radio" name="estado" id="estado2" value="0"';
        if ($accion_funcion["numcampos"] && $accion_funcion[0]["estado"] == 0) {
            $texto .= " CHECKED ";
        }
        $texto .= '> INACTIVO</label>';

        $texto .= '<input type="hidden" id="accion_form" name="accion_form" value="adicionar">';

        $texto .= '<input type="hidden" id="accion_funcion" name="accion_funcion" value="">';

        $texto .= '<input type="hidden" id="idformato_fa" name="idformato" value="' . $_REQUEST["idformato"] . '">';
        $texto .= '</div></div>';
        $texto .= '<div class="control-group"><div class="controls"><input type="submit"><input type="button" id="btn_limpiar_fa" value="Limpiar" /></div></div>';
    }
    $texto .= '</form>';
}

$cuerpo_tabla = obtener_asignadas($idpantalla);

if(!empty($cuerpo_tabla)) {
    $texto_tabla .= '<table id="lista_asignadas" class="table table-condensed" style="border:1px; width:80%;">';
    $texto_tabla .= '<thead><tr><th>Acci&oacute;n</th><th>Ruta<br />Acci&oacute;n</th><th>Funci&oacute;n</th><th>Ruta<br />Funci&oacute;n</th><th>Ejecutar?</th><th>&nbsp</th><th>&nbsp;</th></tr></thead>';
    $texto_tabla .= '<tbody>';
    $texto_tabla .= $cuerpo_tabla;
    $texto_tabla .= '</tbody></table>';
    $texto .= $texto_tabla;
}

echo ($texto . "</div>");

?>

<script type="text/javascript">
var idpantalla = <?php echo intval($idpantalla);?>;

(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        //console.log(a);
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

$(document).ready(function() {
	$(document).on("click", ".lnk_editar_accion", function(e) {
		var datos = {idformato : idpantalla, accion_ejecutar: 1,
				accion_funcion: $(this).data("accion_funcion"), accion_form: "consultar"};
		e.handled = true;
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/asignar_funciones.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
                	//console.log(data.datos);
            		$('#funciones option[value="' + data.datos.idfunciones_formato + '"]').attr('selected', 'selected');
            		$('#acciones option[value="' + data.datos.accion_idaccion + '"]').attr('selected', 'selected');
            		$("input[name=momento][value=" + data.datos.momento + "]").attr('checked', 'checked');
            		$("input[name=estado][value=" + data.datos.estado + "]").attr('checked', 'checked');
            		$("#titulo").html("<b>EDITANDO ASIGNACION</b>");
            		$("#accion_funcion").val(data.datos.idfunciones_formato_accion);
            		$("#accion_form").val("editar");
            		notificacion_saia("Accion consultada","success","",3000);
            	}
            }
        });

	});
	$(document).on("click", ".lnk_eliminar_accion", function(e) {
		var resp = confirm("Desea eliminar la asignación seleccionada?");
		if(!resp) {
			return false;
		}
		var datos = {idformato : idpantalla, accion_ejecutar: 2,
				accion_funcion: $(this).data("accion_funcion"), accion_form: "eliminar"};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/asignar_funciones.php",
            data: datos,
            success: function(data) {
                console.log(data);
            	if(data.exito == 1) {
            		$(':input','#asignar_funcion_formato')
                    .not(':button, :submit, :reset')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
            		$("#titulo").html("<b>ASIGNANDO</b>");
            		$("#accion_form").val("adicionar");
            		$('#idformato_fa').val(idpantalla);
            		$('#lista_asignadas tbody').html(data.asignadas);
            		notificacion_saia("Asignacion eliminada Correctamente","success","",3000);
            	} else {
            		notificacion_saia("Problemas al eliminar la funcion","error","",3000);

            	}
            }
        });

	});

	$(document).on("click", "#btn_limpiar_fa", function(e) {
		$(':input','#asignar_funcion_formato')
        .not(':button, :submit, :reset')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
		$("#titulo").html("<b>ASIGNANDO</b>");
		$("#accion_form").val("adicionar");
		$('#idformato_fa').val(idpantalla);
	});

	$('#asignar_funcion_formato').submit(function (e) {
	    e.preventDefault();
	    var datos = $(this).serializeFormJSON();
	    //console.log(datos);

		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/asignar_funciones.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
            		$('#asignar_funcion_formato')[0].reset();
            		$('#lista_asignadas tbody').html(data.asignadas);
            		$("#titulo").html("<b>ASIGNANDO</b>");
            		$("#accion_form").val("adicionar");
            		$("#accion_funcion").val("");
            		$('#lista_asignadas tbody').html(data.asignadas);

            		if($('#lista_asignadas').length == 0) {
            			crear_tabla_asignadas(data.asignadas, '#asignar_funcion_formato');
            		}

            		notificacion_saia("Asignacion creada Correctamente","success","",3000);
            	} else {
            		notificacion_saia("Problemas al crear la funcion","error","",3000);

            	}
            }
        });
	});

	function crear_tabla_asignadas(cuerpo, donde) {
	    var texto_tabla = ['<table id="lista_asignadas" class="table table-condensed" style="border:1px; width:80%;">',
	    '<thead><tr><th>Acci&oacute;n</th>', '<th>Ruta<br/>Acci&oacute;n</th>','<th>Funci&oacute;n</th>',
	    '<th>Ruta<br/>Funci&oacute;n</th>', '<th>Ejecutar?</th>', '<th>&nbsp</th>', '<th>&nbsp;</th>', '</tr></thead>',
	    '<tbody>', cuerpo, '</tbody></table>'];
	    $(donde).after(texto_tabla.join(""));
	}
});
</script>

<?php

/**
 * @param idpantalla
 * @param texto
 */

function obtener_asignadas($idpantalla) {
    $texto = "";
    $lasignadas = busca_filtro_tabla("A.nombre AS accion, A.ruta AS ruta_accion,B.etiqueta AS funcion, B.ruta AS ruta_funcion, C.estado AS estado_af, B.parametros,C.idfunciones_formato_accion", "funciones_formato_accion C,accion A,funciones_formato B", "C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato AND C.formato_idformato=" . $idpantalla, "", $conn);
    if ($lasignadas["numcampos"]) {
        for ($j = 0; $j < $lasignadas["numcampos"]; $j++) {
            if ($lasignadas[$j]["estado_af"] == 1) {
                $estado = '<i class="icon-plus"></i>';
            } else {
                $estado = '<i class="icon-minus"></i>';
            }
            $texto .= '<tr ><td>' . $lasignadas[$j]["accion"] . '&nbsp;</td><td>' . $lasignadas[$j]["ruta_accion"] . '&nbsp;</td>';
            $texto .= '<td>' . $lasignadas[$j]["funcion"] . '&nbsp;</td>';
            $texto .= '<td>' . $lasignadas[$j]["ruta_funcion"] . '&nbsp;</td>';
            $texto .= '<td align="center">' . $estado . '</td><td>';
            if ($lasignadas[$j]["funcion"] != "transferencia_automatica") {
                $texto .= '<a class="lnk_editar_accion" data-accion_funcion="' . $lasignadas[$j]["idfunciones_formato_accion"] . '"><i class="icon-edit"></i></a></td>';
                $texto .= '<td><a class="lnk_eliminar_accion" data-accion_funcion="' . $lasignadas[$j]["idfunciones_formato_accion"] . '"><i class="icon-remove"></i></a>';
            } else {
                $texto .= '</td><td>';
            }
            $texto .= '</td></tr>';
        }
    }
    return $texto;
}

?>