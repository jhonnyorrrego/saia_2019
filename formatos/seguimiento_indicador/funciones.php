<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

/*ADICIONAR-EDITAR*/

function formulario_variables($idcampo, $idformato, $iddoc = NULL) {
	
	if ($_REQUEST["anterior"]) {
		$opt = 0;
		$formula = busca_filtro_tabla("nombre", "ft_formula_indicador", "documento_iddocumento=" . $_REQUEST["anterior"], "");
	} else {
		$opt = 1;
		$formula = busca_filtro_tabla("f.nombre", "ft_formula_indicador f,ft_seguimiento_indicador s", "f.idft_formula_indicador=s.ft_formula_indicador and documento_iddocumento=" . $_REQUEST["iddoc"], "");
		$variables = busca_filtro_tabla("resultado", "ft_seguimiento_indicador", "documento_iddocumento=" . $_REQUEST["iddoc"], "");
	}
	preg_match_all("([A-Za-z_]+[0-9]*)", $formula[0]["nombre"], $resultados);
	$lista = implode(";", $resultados[0]);

	$html .= "<td><input type='hidden' id='resultado' name='resultado' value='" . @$variables[0][0] . "'>
  <table width='100%' border=0>";
	if ($opt) {
		$valores = array();
		$vector = explode(";", $variables[0][0]);
		foreach ($vector as $fila) {
			$aux = explode(":", $fila);
			$valores[$aux[0]] = $aux[1];
		}
	}
	foreach ($resultados[0] as $var) {
		$html.= "<tr>
    <td>" . $var . "*</td>
    <td><input type='text' name='" . $var . "' id='" . $var . "' value='" . @$valores[$var] . "' onkeyup='validar_variables(\"$lista\")' class='required number'></td>
    </tr>";
	}
	$html.= "</table></td>";
	echo $html;
}


function add_edit_seg_indicador($idformato, $iddoc) {
	
	$adicion = 0;
	if ($_REQUEST["anterior"]) {
		$formula = busca_filtro_tabla("rango_colores", "ft_formula_indicador", "documento_iddocumento=" . $_REQUEST["anterior"], "");
		$adicion = 1;
		$limite = explode(",", $formula[0]["rango_colores"]);
	}
	?>
	<script>
		$(document).ready(function() {
			var adicion="<?php echo($adicion);?>";
			if(adicion==1){
				$("#linea_base").val("<?php echo($limite[0])?>");
				$("#meta_indicador_actual").val("<?php echo($limite[1])?>");
			}
			$("#linea_base,#meta_indicador_actual").attr('readonly', true);
		});
		function validar_variables(lista) {
			vector = lista.split(";");
			vacios = 0;
			valores = new Array;
			for ( i = 0; i < vector.length; i++) {
				if ($("#" + vector[i]).valid() == 0) {
					vacios++;
					break;
				} else
					valores[i] = vector[i] + ":" + $("#" + vector[i]).val();
			}
			if (vacios == 0) {
				$("#resultado").val(valores.join(";"));
			}
		}
	
		$('#formulario_formatos').validate({
			submitHandler : function(form) {
				var fecha = $("#fecha_seguimiento").val().split(" ");
				var f = new Date();
				var dia = f.getDate();
				var mes = (f.getMonth() + 1);
				if (dia < 10) {
					dia = '0' + dia;
				}
				if (mes < 10) {
					mes = '0' + mes;
				}
				var fecha2 = f.getFullYear() + "-" + mes + "-" + dia;
	
				if (fecha[0] > fecha2) {
					alert('La fecha no puede ser superior a la de hoy!');
					$("#fecha_seguimiento").focus();
					return false;
				}
				form.submit();
			}
		}); 
	</script>
	<?php
}

/*MOSTRAR*/
function mostrar_variables($idformato, $iddoc) {
	
	$html = "";
	$variables = busca_filtro_tabla("resultado", "ft_seguimiento_indicador", "documento_iddocumento=" . $iddoc, "");
	if ($variables["numcampos"]) {
		$html .= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">';
		for ($i = 0; $i <= count($resultados); $i++) {
			$valores = array();
			$vector = explode(";", $variables[0][0]);
			foreach ($vector as $fila) {
				$aux = explode(":", $fila);
				$html .= "<tr><td><b>" . $aux[0] . ":</b></td><td>" . $aux[1] . "</td></tr>";
			}
		}
		$html .= "</table>";
	}

	echo $html;
}
?>