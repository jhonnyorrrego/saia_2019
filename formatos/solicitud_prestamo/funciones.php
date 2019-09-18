<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

include_once ($ruta_db_superior . "assets/librerias.php");

echo(librerias_notificaciones());

/*ADICIONAR*/
function guardar_expedientes_prestamos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$html = "<td>";
	if ($_REQUEST["iddoc"]) {
		$consul_ids = busca_filtro_tabla("transferencia_presta", "ft_solicitud_prestamo", "documento_iddocumento=" . $_REQUEST["iddoc"], "");
		if ($consul_ids["numcampos"] == 0 || $consul_ids[0]["transferencia_presta"] != "") {
			$ids = $consul_ids[0]["transferencia_presta"];
		}
	} else if ($_REQUEST["id"] != "") {
		$ids = @$_REQUEST["id"];
	} else {
		alerta("Por favor ingrese desde las opciones de expedientes");
		redirecciona($ruta_db_superior . "vacio.php");
	}
	if ($ids) {
		$expedientes = busca_filtro_tabla("nombre,idexpediente," . fecha_db_obtener('fecha', 'Y-m-d') . " AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie", "expediente A", "A.idexpediente in(" . $ids . ")", "");
		if ($expedientes["numcampos"]) {
			$html .= "<table style='width:100%;border-collapse:collapse;'  border='1'>
				<tr style='font-weight:bold;text-align:center;'>
					<td> <input type='checkbox' name='boton_todos' id='boton_todos' value='todos' checked> </td>
					<td> Nombre </td>
					<td> Fecha de creaci&oacute;n </td>
					<td> Indice uno </td>
					<td> Indice Dos </td>
					<td> Indice Tres </td>
					<td> Caja </td>
					<td> Serie asociada </td>
				</tr>";

			for ($i = 0; $i < $expedientes['numcampos']; $i++) {
				$caja = busca_filtro_tabla("fondo,codigo_dependencia,codigo_serie,no_consecutivo", "caja", "idcaja=" . $expedientes[$i]['fk_idcaja'], "");
				$cadena_caja = "";
				if ($caja["numcampos"]) {
					$cadena_caja = $caja[0]['codigo_dependencia'] . $caja[0]['codigo_serie'] . $caja[0]['no_consecutivo'] . "(" . $caja[0]['fondo'] . ")";
				}

				$cadena_serie = "";
				$serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $expedientes[$i]['serie_idserie'], "");
				if ($serie["numcampos"]) {
					$cadena_serie = $serie[0]['nombre'];
				}

				$html .= "<tr>
				<td style='text-align:center; width:5%'> <input type='checkbox' name='transferencia_presta[]' value='" . $expedientes[$i]['idexpediente'] . "' checked /> </td>
				<td> " . $expedientes[$i]['nombre'] . " </td>
				<td> " . $expedientes[$i]['fecha'] . " </td>
				<td> " . $expedientes[$i]['indice_uno'] . " </td>
				<td> " . $expedientes[$i]['indice_dos'] . " </td>
				<td> " . $expedientes[$i]['indice_tres'] . " </td>
				<td> " . $cadena_caja . " </td>
				<td> " . $cadena_serie . " </td>
			</tr>";
			}
			$html .= "</table>";
			$html .= "<script>
    	$(document).ready(function(){
    		$('#boton_todos').click(function(){
				if( $(this).is(':checked') ){ //check
					$('[name=\"transferencia_presta[]\"]').attr('checked',true);		
				}else{  //un-check	
					$('[name=\"transferencia_presta[]\"]').attr('checked',false);		
				}	
    		});
    	});
    </script>";
		} else {
			$html .= "No hay expedientes seleccionados";
		}
	} else {
		$html .= "No hay expedientes seleccionados";
	}
	$html .= "</td>";
	echo($html);
}

/*MOSTRAR*/
function ver_creador_prestamo($idformato, $iddoc) {
	
	$html = "";
	$solicitante = busca_filtro_tabla("A.nombres,A.apellidos", "vfuncionario_dc A,ft_solicitud_prestamo B", "A.iddependencia_cargo=B.dependencia and B.documento_iddocumento=" . $iddoc, "");
	if ($solicitante["numcampos"]) {
		$html = $solicitante[0]['nombres'] . "  " . $solicitante[0]['apellidos'];
	}
	echo $html;
}

function mostrar_expedientes_prestamos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$texto = '';
	$datos = busca_filtro_tabla("fk_expediente", "ft_solicitud_prestamo A, documento B, ft_item_prestamo_exp C", "A.idft_solicitud_prestamo=C.ft_solicitud_prestamo AND A.documento_iddocumento=" . $iddoc . " and A.documento_iddocumento=B.iddocumento", "");
	if ($datos["numcampos"]) {
		$lista_expedientes = implode(',', extrae_campo($datos, 'fk_expediente', 'U'));
		$expedientes = busca_filtro_tabla("", "expediente A", "A.idexpediente in(" . $lista_expedientes . ")", "");
		if ($expedientes["numcampos"]) {
			$vector_soportes = array(
				1 => 'CD-ROM',
				2 => 'DISKETE',
				3 => 'DVD',
				4 => 'DOCUMENTO',
				5 => 'FAX',
				6 => 'REVISTA O LIBRO',
				7 => 'VIDEO',
				8 => 'OTROS ANEXOS'
			);
			$vector_frecuencias = array(
				1 => 'Alta',
				2 => 'Media',
				3 => 'Baja'
			);

			$estilo_general = ' style="text-align:center;font-weight:bold;"';
			$texto .= '<table class="table table-bordered" style="width:100%" border="1">
			<tr>
				<th rowspan="2" ' . $estilo_general . '>N&Uacute;MERO DE ORDEN</th>
				<th rowspan="2" ' . $estilo_general . '>C&Oacute;DIGO</th>
				<th rowspan="2" ' . $estilo_general . '>NOMBRE</th>
				<th colspan="2" ' . $estilo_general . '>FECHAS EXTREMAS</th>
				<th colspan="4" ' . $estilo_general . '>UNIDAD DE CONSERVACI&Oacute;N</th>
				<th rowspan="2" ' . $estilo_general . '>N&Uacute;MERO DE FOLIOS</th>
				<th rowspan="2" ' . $estilo_general . '>SOPORTE</th>
				<th rowspan="2" ' . $estilo_general . '>FRECUENCIA DE CONSULTA</th>
				<th rowspan="2" ' . $estilo_general . '>NOTAS</th>
			</tr>
			<tr>
				<th ' . $estilo_general . '>INICIAL</th>
				<th ' . $estilo_general . '>FINAL</th>
				<th ' . $estilo_general . '>CAJA</th>
				<th ' . $estilo_general . '>CARPETA</th>
				<th ' . $estilo_general . '>TOMO</th>
				<th ' . $estilo_general . '>OTRO</th>
			</tr>';

			for ($i = 0; $i < $expedientes["numcampos"]; $i++) {
				$x_caja = '';
				if ($expedientes[$i]["fk_idcaja"]) {
					$x_caja = 'x';
				}

				$tomo_padre = $expedientes[$i]["idexpediente"];
				if ($expedientes[$i]['tomo_padre']) {
					$tomo_padre = $expedientes[$i]['tomo_padre'];
				}
				$ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $tomo_padre, "");
				$cantidad_tomos = $ccantidad_tomos['numcampos'] + 1;
				//tomos + el padre
				$cadena_tomos = $expedientes[$i]['tomo_no'] . " de " . $cantidad_tomos;

				if (is_object($expedientes[$i]["fecha_extrema_i"])) {
					$expedientes[$i]["fecha_extrema_i"] = $expedientes[$i]["fecha_extrema_i"] -> format('Y-m-d');
				}

				if (is_object($expedientes[$i]["fecha_extrema_f"])) {
					$expedientes[$i]["fecha_extrema_f"] = $expedientes[$i]["fecha_extrema_f"] -> format('Y-m-d');
				}

				$texto .= '<tr>
					<td style="text-align:center">' . ($i + 1) . '</td>
					<td>' . $expedientes[$i]["codigo_numero"] . '</td>
					<td>' . $expedientes[$i]["nombre"] . '</td>
					<td>' . $expedientes[$i]["fecha_extrema_i"] . '</td>
					<td>' . $expedientes[$i]["fecha_extrema_f"] . '</td>
					<td style="text-align:center;">' . $x_caja . '</td>
					<td style="text-align:center;">X</td>
					<td style="text-align:center">' . $cadena_tomos . '</td>
					<td style="text-align:center">' . $expedientes[$i]['no_unidad_conservacion'] . '</td>
					<td style="text-align:center">' . $expedientes[$i]["no_folios"] . '</td>
					<td>' . $vector_soportes[$expedientes[$i]['soporte']] . '</td>
					<td>' . $vector_frecuencias[$expedientes[$i]['frecuencia_consulta']] . '</td>
					<td>' . $expedientes[$i]['notas_transf'] . '</td>
				</tr>';
			}
			$texto .= "</table>";
		}
	}
	echo($texto);
}

/*POSTERIOR APROBAR*/
function insertar_item_prestamo_exp($idformato, $iddoc) {
	
	$prestamo_expedientes = busca_filtro_tabla("transferencia_presta,idft_solicitud_prestamo", "ft_solicitud_prestamo", "documento_iddocumento=" . $iddoc, "");
	if ($prestamo_expedientes["numcampos"]) {
		$vector_prestamo_expedientes = explode(',', $prestamo_expedientes[0]['transferencia_presta']);
		for ($i = 0; $i < count($vector_prestamo_expedientes); $i++) {
			$sql = " INSERT INTO ft_item_prestamo_exp (ft_solicitud_prestamo,fk_expediente)	VALUES (" . $prestamo_expedientes[0]['idft_solicitud_prestamo'] . "," . $vector_prestamo_expedientes[$i] . ")";
			phpmkr_query($sql);
		}
	}
	return;
}

/*ADICIONAR*/
function validar_fecha_prestamo($idformato, $iddoc) {
	?>
	<script>
    	$('#formulario_formatos').validate({
    		submitHandler : function(form) {
				var sfecha_prestamo = $("#fecha_prestamo_rep").val();
    			var sfecha_devolucion = $("#fecha_devolucion_rep").val();

           		var fecha_prestamo=new Date(sfecha_prestamo);
				fecha_prestamo=fecha_prestamo.setHours(0,0,0,0);
        
        		var fecha_devolucion=new Date(sfecha_devolucion);
        		fecha_devolucion=fecha_devolucion.setHours(0,0,0,0);

    			if(fecha_devolucion < fecha_prestamo) {
    				//$("#alerta_fecha_devolucion_rep").remove();
    				//$("#fecha_devolucion_rep").next("a").after("<font color='red' id='alerta_fecha_devolucion_rep'>La fecha devolucion debe ser mayor a la fecha prestamo</font>");
					notificacion_saia('La fecha devolucion debe ser mayor a la fecha prestamo.', 'error', '', 4000);
    				$("#fecha_devolucion_rep").focus();
    				$('#continuar').css('display', 'inherit');
    				$('#continuar').next('input').hide();
    				return false;
    			}
    			form.submit();
    		}
    	});
	</script>
	<?php
}
?>