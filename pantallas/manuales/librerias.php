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

if (isset($_REQUEST["variable_busqueda"])) {
	$datos = explode(",", $_REQUEST["variable_busqueda"]);
	foreach ($datos as $fila) {
		$request = explode("-", $fila);
		$_REQUEST[$request[0]] = $request[1];
	}
}

function listar_manuales($idmanual, $agrupador, $ruta, $etiqueta, $estado, $descripcion, $idcomp) {
	global $ruta_db_superior;
	$botones = '<a class="btn btn-mini tooltip_saia pull-right" title="Editar ' . $nombre . '" href="' . $ruta_db_superior . 'pantallas/manuales/?idmanual=' . $idmanual . '"><i class="icon-pencil"></i></a>';
	if ($agrupador == 1) {
		if($estado==1){
			$etiqueta = '<div class="link kenlace_saia" enlace="pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=' . $idcomp . '&amp;variable_busqueda=idmanual-' . $idmanual . '" conector="iframe" titulo="' . $etiqueta . '">' . $etiqueta . '</div>';
		}
		$html = '<table style="width:100%">
			<tr>
			<td>' . $etiqueta . '</td>
			<td align="right">' . $botones . '</td>
			</tr>
		</table>';
	} else {
		$ruta_pdf = json_decode($ruta);
		if (is_object($ruta_pdf)) {
			$tipo_almacenamiento = new SaiaStorage("ayuda");
			if ($tipo_almacenamiento -> get_filesystem() -> has($ruta_pdf -> ruta)) {
				$ruta64 = base64_encode($ruta);
				$href = "filesystem/mostrar_binario.php?ruta=" . $ruta64;
			}
		}
		if($estado==1){
			$botones .= '<a class="btn btn-mini tooltip_saia pull-right" title="Editar ' . $nombre . '" href="' . $ruta_db_superior . $href . '"><i class="icon-folder-open"></i></a>';
		}
		$html = '<table style="width:100%">
			<tr>			
				<td><strong>' . $etiqueta . '</strong></td>
			</tr>
			<tr>
				<td>' . $descripcion . '</td>
			</tr>
			<tr>
				<td align="right">' . $botones . '</td>
			</tr>
		</table>';
	}
	return $html;
}

function where_manual() {
	$html = "estado=1";
	if (isset($_REQUEST["idmanual"])) {
		$html .= " and cod_padre=" . $_REQUEST["idmanual"];
	} else {
		$html .= " and agrupador=1 and cod_padre=0";
	}
	return $html;
}

function ver_hijos_manual($idmanual, $etiqueta) {
	$html('<div class="link kenlace_saia" enlace="ordenar.php?key=' . $iddocumento . '&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado ' . $numero . '"><span class="badge">' . $numero . '</span></div>');
	return $html;
}

function crear_modulo_manual() {
	global $conn;
	$retorno = array(
		"exito" => 0,
		"msn" => "El Modulo del manual NO existe"
	);
	$modulo_manual = busca_filtro_tabla("idmodulo", "modulo", "nombre = 'manuales'", "", $conn);
	if ($modulo_manual["numcampos"]) {
		$idmodulo_papa = $modulo_manual[0]["idmodulo"];
	} else {
		$sql_papa = "INSERT INTO modulo (pertenece_nucleo, nombre, tipo, imagen, etiqueta, enlace, destino, cod_padre, orden, ayuda, parametros, busqueda_idbusqueda, permiso_admin, busqueda, enlace_pantalla) VALUES (1, 'manuales', 'secundario', 'botones/principal/calidad_sgc.png', 'Manuales', 'pantallas/buscador_principal.php?idbusqueda=128', 'centro', 4, 8, 'Permite ver todos los Manuales', '', 1, 0, '0', 0)";
		phpmkr_query($sql_papa) or die("Error al crear el modulo padre");
		$idmodulo_papa = phpmkr_insert_id();
	}
	if (!$idmodulo_papa) {
		return $retorno;
	} else {
		$nombre = str_replace(" ", "_", $_REQUEST["nombre"]);
		if ($_REQUEST["cod_padre"] != 0) {
			$modulo = busca_filtro_tabla("modulo_idmodulo", "manual", "cod_padre=" . $_REQUEST["cod_padre"], "", $conn);
			if ($modulo["numcampos"]) {
				$idmodulo_papa = $modulo[0]["modulo_idmodulo"];
			}
		}
		$exis = busca_filtro_tabla("idmodulo", "manual", "nombre='" . trim(htmlentities($nombre)) . "'", "", $conn);
		if ($exis["numcampos"]) {
			$retorno["msn"] = "La etiqueta ya existe";
		} else {
			$sql_mod = "INSERT INTO modulo(permiso_admin,pertenece_nucleo,busqueda,nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES (0,0,'0','" . htmlentities($nombre) . "','secundario','-','" . htmlentities($_REQUEST["nombre"]) . "','#','centro','" . $idmodulo_papa . "','1','Manual')";
			phpmkr_query($sql_mod) or die("Error al crear el modulo");
			$modulo_idmodulo = phpmkr_insert_id();
			if ($modulo_idmodulo) {
				$retorno["exito"] = 1;
				$retorno["idmodulo"] = $modulo_idmodulo;
			}
		}
	}
	return $retorno;
}
