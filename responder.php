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

if (@$_REQUEST["iddoc"] || @$_REQUEST["key"]) {
	if (!@$_REQUEST["iddoc"])
		$_REQUEST["iddoc"] = @$_REQUEST["key"];
	include_once ("pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
$formato = 0;
$documento = 0;
$error = 0;
$complemento = "?rand=" . rand(0, 1000);
if (@$_REQUEST["idpaso_documento"]) {
	$complemento .= '&idpaso_documento=' . $_REQUEST["idpaso_documento"];
}
if (@$_REQUEST["idformato"]) {
	$idformato = $_REQUEST["idformato"];
}
if (@$_REQUEST["iddoc"]) {
	$iddoc = $_REQUEST["iddoc"];
}
if (@$_REQUEST["key"]) {
	$iddoc = $_REQUEST["key"];
}
if (@$idformato) {
	$formato = busca_filtro_tabla("imagen,ruta_adicionar,nombre,etiqueta,cod_padre", "formato A", "idformato=" . $idformato, "", $conn);
}
if (@$iddoc && !@$idformato) {
	$documento = busca_filtro_tabla("numero", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
	if ($documento["numcampos"]) {
		if (!$documento[0]["numero"]) {
			alerta("<b>ATENCI&Oacute;N</b><br>No se puede responder el documento porque no ha terminado su proceso.", 'warning', 4000);
			volver(1);
		} else {
			$paso_documento = busca_filtro_tabla("", "paso_documento", "documento_iddocumento=" . $iddoc, "GROUP BY diagram_iddiagram_instance", $conn);
			if ($paso_documento["numcampos"]) {
				$complemento .= '&idpaso_documento=' . $paso_documento[0]["idpaso_documento"];
			}
		}
	}
	if (!$formato["numcampos"]) {
		$complemento .= "&anterior=" . $iddoc;
	}
}
if ($formato["numcampos"]) {
	if (is_file("formatos/" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"])) {
		$padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
		$idpadre = busca_filtro_tabla("documento_iddocumento", $padre[0][0], "id" . $padre[0][0] . "=" . $iddoc, "", $conn);
		redirecciona("formatos/" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"] . "?anterior=" . $idpadre[0][0] . "&padre=" . $iddoc . "&idformato=" . $idformato);
	} else {
		alerta("El formato " . $formato[0]["nombre"] . " No ha sido encontrado!", 'error', 4000);
	}
}
?>
<html>
	<head>
		<style type="text/css">
			#tabla_respuesta {
				width: 100%;
			}
			#tabla_respuesta tr th {
				text-align: center;
			}
			#tabla_respuesta tr td {
				text-align: center;
			}
		</style>
	</head>
	
	<body>
		<table class="table table-bordered table-hover" id="tabla_respuesta">
			<?php
			$paso = false;
			if (isset($_REQUEST["idpaso_actividad"])) {
				$complemento .= '&idpaso_actividad=' . $_REQUEST["idpaso_actividad"];
				$propios = buscar_formatos_paso($_REQUEST["idpaso_actividad"]);
				$paso = true;
			} else {
				if (@$paso_documento[0]["paso_idpaso"]) {
					$actividad = busca_filtro_tabla("distinct(diagram_iddiagram)", "paso", "idpaso=" . @$paso_documento[0]["paso_idpaso"], "", $conn);
					$pasos = busca_filtro_tabla("", "paso,paso_actividad", "estado=1 AND diagram_iddiagram=" . $actividad[0]["diagram_iddiagram"] . " and paso_idpaso=idpaso and accion_idaccion=6", "", $conn);
					if ($pasos["numcampos"] > 0) {
						$complemento .= '&idpaso_actividad=' . $pasos[0]["idpaso_actividad"];
						$propios = buscar_formatos_paso($pasos[0]["idpaso_actividad"]);
						$paso = true;
					}
				}
			}
			$categorias = busca_filtro_tabla("", "categoria_formato a", "lower(nombre)<>'radicacion' and lower(nombre)<>'formatos'", "idcategoria_formato asc", $conn);
			for ($j = 0; $j < $categorias["numcampos"]; $j++) {
				echo lista_formatos($categorias[$j]["idcategoria_formato"], $categorias[$j]["nombre"]);
			}
			?>
		</table>
	</body>
</html>
<?php
function buscar_formatos_paso($idactividad) {
	global $complemento, $conn;
	$activi = busca_filtro_tabla("", "paso_actividad", "estado=1 AND idpaso_actividad=" . $idactividad, "", $conn);
	if ($activi[0]["formato_idformato"] != NULL) {
		$formatos = explode(",", $activi[0]["formato_idformato"]);
		$cantidad = count($formatos);
		if ($cantidad == 1) {
			$formato = busca_filtro_tabla("", "formato", "idformato=" . $activi[0]["formato_idformato"], "", $conn);
			abrir_url("formatos/" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"] . $complemento, "centro");
		}
	}
	return $formatos;
}

function lista_formatos($idcategoria, $nombre) {
	global $complemento;
	$permiso = new PERMISO();
	$adicional = " and fk_categoria_formato is null";
	if ($idcategoria) {
		$adicional = " and (fk_categoria_formato like'" . $idcategoria . "'  or  fk_categoria_formato like'%," . $idcategoria . "' or fk_categoria_formato like'" . $idcategoria . ",%' or fk_categoria_formato like'%," . $idcategoria . ",%') ";
	}
	$lformatos = busca_filtro_tabla("imagen,ruta_adicionar,nombre,etiqueta,cod_padre,idformato", "formato A", "mostrar=1 AND detalle=0" . $adicional, "etiqueta", $conn);
	$retorno = '';
	if ($lformatos["numcampos"] && $nombre) {
		$retorno .= "<tr><th class='encabezado'>" . mayusculas($nombre) . "</th></tr>";
	}
	$mostrar_formatos = false;
	for ($i = 0; $i < $lformatos["numcampos"]; $i++) {
		$ok = $permiso -> acceso_modulo_perfil('crear_' . $lformatos[$i]['nombre']);
		if ($ok && is_file("formatos/" . $lformatos[$i]["nombre"] . "/" . $lformatos[$i]["ruta_adicionar"]) && $lformatos[$i]["nombre"] != "mensaje") {
			$mostrar_formatos = true;
			if ($paso == true) {
				if (in_array($lformatos[$i]["idformato"], $propios)) {
					$retorno .= "<tr>";
					$retorno .= "<td >";
					$retorno .= "<a href='formatos/" . $lformatos[$i]["nombre"] . "/" . $lformatos[$i]["ruta_adicionar"] . $complemento . "' target='_self' >" . mayusculas($lformatos[$i]["etiqueta"]) . "</a>";
					$retorno .= "</td>";
					$retorno .= "</tr>";
				}

			} else {
				$retorno .= "<tr>";
				$retorno .= "<td>";
				$retorno .= "<a class='kenlace_saia' style='cursor:pointer' conector='iframe' titulo='" . $lformatos[$i]["etiqueta"] . "' title='" . $lformatos[$i]["etiqueta"] . "' enlace='formatos/" . $lformatos[$i]["nombre"] . "/" . $lformatos[$i]["ruta_adicionar"] . $complemento . "' target='_self' >" . mayusculas($lformatos[$i]["etiqueta"]) . "</a>";
				$retorno .= "</td>";
				$retorno .= "</tr>";
			}
		}
	}
	if ($mostrar_formatos) {
		return $retorno;
	}
}
