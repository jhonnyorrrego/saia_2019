<?php
include_once ("db.php");
include_once ("asignacion.php");
include_once ("calendario/calendario.php");

function pendientes($func, $tiempo) {
	global $conn;
	$texto = array();
	$texto[0] = "";
	$texto[1] = "";
	$texto[2] = "";
	$doc = busca_filtro_tabla("iddocumento,numero,documento.descripcion,plantilla," . fecha_db_obtener("fecha", 'Y-m-d') . " as fecha,numero," . case_fecha('dias', "''", 'dias_entrega', 'dias') . " as dias_r", "asignacion a,documento left join serie on serie=idserie", "documento_iddocumento=iddocumento and a.entidad_identidad=1 and a.llave_entidad=$func and tarea_idtarea=2", "", $conn);
	$texto[0] .= $doc["numcampos"] . "\n\r ";
	if ($doc["numcampos"] > 0)
		for ($i = 0; $i < $doc["numcampos"]; $i++) {
			if ($doc[$i]["dias_r"] <> "") {
				$fecha_f = dias_habiles($doc[$i]["dias_r"], 'Y-m-d', $doc[$i]["fecha"]);
				$dias2 = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_f, 'Y-m-d'), "") . " as respuesta", "", "", "", $conn);
				if (isset($dias2) && $dias2["numcampos"]) {
					$dias = intval(ceil($dias2[0]["respuesta"]));
					if ($dias == $tiempo[0])
						$texto[0] .= "Documento: " . $doc[$i]["numero"] . " " . $doc[$i]["plantilla"] . "\nDescripcion: " . $doc[$i]["descripcion"] . "\n\r";
					elseif ($dias == $tiempo[1])
						$texto[1] .= "Documento: " . $doc[$i]["numero"] . " " . $doc[$i]["plantilla"] . "\nDescripcion: " . $doc[$i]["descripcion"] . "\n\r";
					elseif ($tiempo[2] > 0 && $dias < ($tiempo[2] * -1))
						$texto[2] .= "Documento: " . $doc[$i]["numero"] . " " . $doc[$i]["plantilla"] . "\nDescripcion: " . $doc[$i]["descripcion"] . "\n\r";
				}
			}
		}
	return $texto;
}

function envio_mensaje() {
	global $conn;
	$tipo = array("e-interno");
	$dias_pend = array(2, -1, 7);
	$fecha = date("y-m-d");
	$destino = array();
	$texto = "";
	$valores_pendientes = busca_filtro_tabla("*", "configuracion", "tipo ='pendientes'", "", $conn);
	for ($j = 0; $j < $valores_pendientes["numcampos"]; $j++)
		switch($valores_pendientes[$j]["nombre"]) {
			case "dias_correo_pendientes" :
				$dias = $valores_pendientes[$j]["valor"];
				break;
			case "fecha_correo_pendientes" :
				$fecha_correo = $valores_pendientes[$j]["valor"];
				break;
			case "enviar_correo_pendientes" :
				$envio_correo = $valores_pendientes[$j]["valor"];
				break;
		}
	$fecha_envio = ejecuta_filtro("Select ADDDATE('$fecha_correo',INTERVAL $dias DAY) AS dias", $conn);
	if ($fecha_envio["numcampos"] && $fecha_envio["dias"] <= date('Y-m-d')) {  $dias_pend[2] = 7;
		//phpmkr_query("UPDATE configuracion SET  valor='".date("Y-m-d")."' WHERE nombre='fecha_correo_pendientes'",$conn);
	} else
		$dias_pend[2] = 0;

	$func = busca_filtro_tabla("funcionario_codigo AS cod,idfuncionario,nombres,apellidos,cargo_idcargo,dependencia_iddependencia", "funcionario,dependencia_cargo", "funcionario_idfuncionario=idfuncionario and funcionario.estado=1 and dependencia_cargo.estado=1", "", $conn);
	for ($j = 3; $j < $func["numcampos"]; $j++) {
		$hijos = busca_filtro_tabla("funcionario_codigo as cod,nombres,apellidos", "funcionario,dependencia_cargo,cargo", "funcionario_idfuncionario=idfuncionario and dependencia_iddependencia=" . $func[$j]["dependencia_iddependencia"] . " and cargo_idcargo=idcargo and cod_padre=" . $func[$j]["cargo_idcargo"], "", $conn);
		if ($hijos["numcampos"] > 0)
			for ($x = 0; $x < $hijos["numcampos"]; $x++) {
				$destino[0] = $func[$j]["cod"];
				$mensaje = pendientes($hijos[$x]["cod"], $dias_pend);
				if ($mensaje[0] != "")
					$texto .= "El funcionario " . $hijos[$x]["nombres"] . " " . $hijos[$x]["apellidos"] . " a la fecha de $fecha tiene los siguientes documentos pendientes con dos d&iacute;as para cumplir el plazo de vencimiento. \n\r " . $mensaje[0];
				if ($mensaje[1] != "")
					$texto .= "El funcionario " . $hijos[$x]["nombres"] . " " . $hijos[$x]["apellidos"] . " a la fecha de $fecha tiene los siguientes documentos pendientes con 1 d&iacute;as de vencimiento. \n\r " . $mensaje[1];
				if ($mensaje[2] != "")
					$texto .= "El funcionario " . $hijos[$x]["nombres"] . " " . $hijos[$x]["apellidos"] . " a la fecha de $fecha tiene los siguientes documentos pendientes con mas de 7 d&iacute;as de vencimiento. \n\r " . $mensaje[2];
			}
		if ($texto != "") {
			$texto = $func[$j]["nombres"] . " " . $func[$j]["apellidos"] . " A continuacion tiene la relacion de los  funcionarios a su cargo con los documentos que tienen pendientes y/o vencidos en SAIA: \n\r $texto";
		}
		$destino[0] = 1;
		$texto = "";
	}
}

function hoja_vida() {
	global $conn;
	$formato_hv = 72;
	$hojas = busca_filtro_tabla("idft_hoja_vida,documento_iddocumento,CONCAT(nombres,' ',apellidos) as nombre", "ft_hoja_vida,documento", "iddocumento=documento_iddocumento and numero>0", "documento_iddocumento", $conn);
	$texto_final = "";
	if ($hojas["numcampos"] > 0)
		for ($i = 0; $i < $hojas["numcampos"]; $i++) { $texto = "";
			$anexos = busca_filtro_tabla("idft_anexos_hoja_vida as id,nombre,fecha_vigencia AS vigencia", "ft_anexos_hoja_vida,ft_estructura_hoja_vida", "idft_estructura_hoja_vida = estructura and ft_hoja_vida=" . $hojas[$i]["idft_hoja_vida"] . " and fecha_vigencia < '" . date("Y-m-d") . "' AND fecha_vigencia <> '0000-00-00'", "", $conn);
			if ($anexos["numcampos"] > 0) { $texto .= "<br />1.Documentos Vencidos:<br /><ul>";
				for ($j = 0; $j < $anexos["numcampos"]; $j++)
					$texto .= "<li>" . $anexos[$j]["nombre"] . "->Fecha de vencimiento: " . $anexos[$j]["vigencia"] . "</li>";
				$texto .= "</ul>";
			}

			$estructura = busca_filtro_tabla("idft_estructura_hoja_vida,nombre", "ft_estructura_hoja_vida LEFT JOIN ft_anexos_hoja_vida ON idft_estructura_hoja_vida = estructura and obligatoriedad=1 and ft_hoja_vida=" . $hojas[$i]["idft_hoja_vida"], "", "", $conn);
			if ($estructura["numcampos"] > 0) { $texto .= "<br />2.Documentos Pendientes:<br /><ul>";
				for ($x = 0; $x < $estructura["numcampos"]; $x++)
					$texto .= "<li>" . $estructura[$x]["nombre"] . "</li>";
				$texto .= "</ul>";
			}
			if ($texto != "")
				$texto_final .= "<ul>La hoja de vida de <b><a href='" . PROTOCOLO_CONEXION . RUTA_PDF . "/formatos/hoja_vida/mostrar_hoja_vida.php?idformato=" . $format_hv . "&iddoc=" . $hojas[$i]["documento_iddocumento"] . "' target='centro'>" . $hojas[$i]["nombre"] . "</a></b>  posee los siguientes documentos vencidos o pendientes por entregar:<br />" . $texto . "<hr></ul>";
		}
	if ($texto_final != "")
		echo $texto_final;
	else
		echo "No hay documentos de hojas de vida vencidos ni pendientes.";
}

include_once ("header.php");
echo("<br /><br /><br />");
hoja_vida();
include_once ("footer.php");
?>
