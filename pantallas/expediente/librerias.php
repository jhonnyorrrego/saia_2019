<?php
include_once (dirname(__FILE__) . "/../../db.php");
function mostrar_datos_expediente($iddoc) {
	$entidad = 1;
	$llave_entidad = array($_SESSION["usuario_actual"]);
	$expediente = datos_expediente($iddoc);
	$texto = '';
	if ($expediente["numcampos"]) {
		$texto .= '<table class="table table-bordered" style="max-width: 200px;">';
		for ($i = 0; $i < $expediente["numcampos"]; $i++) {
			$permiso = permiso_funcionario_expediente($expediente[$i], $entidad, $llave_entidad);
			$texto .= '<tr>';
			if (strpos($permiso, "l") !== false) {
				$texto .= '<td ><a href="#">' . $expediente[$i]["nombre"] . "</a></td>";
			} else {
				$texto .= '<td>' . $expediente[$i]["nombre"] . '</td>';
			}
			$texto .= '</tr>';
		}
		$texto .= '</table></div>';
	}
	return ($texto);
}

function datos_expediente($iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("", "vexpediente", "documento_iddocumento=" . $iddoc, "", $conn);
	return ($datos);
}

function permiso_funcionario_expediente($expediente, $entidad, $llave) {
	if (in_array($expediente["propietario"], $llave)) {
		return ("lame");
	} else {
		$permiso_expediente = busca_filtro_tabla("", "entidad_expediente", "entidad_identidad=" . $entidad . " AND expediente_idexpediente=" . $expediente["idexpediente"] . " AND llave_entidad=" . $llave, "", $conn);
		if ($permiso_expediente["numcampos"]) {
			return ($permiso_expediente["permiso"]);
		}
	}
	return ("");
}

function mostrar_informacion_adicional_expediente($idexpediente) {
	global $conn;
	$cadena = '';
	//EXPEDIENTE
	$expediente_actual = busca_filtro_tabla("serie_idserie", "expediente", "idexpediente=" . $idexpediente, "", $conn);
	//NOMBRE DE LA SERIE
	$serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $expediente_actual[0]['serie_idserie'], "", $conn);

	if ($serie['numcampos']) {
		$cadena .= $serie[0]['nombre'];
	}
	$cadena .= '<br>';
	return ($cadena);
}

function enlace_expediente($idexpediente, $nombre) {
	global $conn;

	$expediente_actual = busca_filtro_tabla("tomo_padre,tomo_no,serie_idserie,propietario,agrupador,cod_arbol", "expediente", "idexpediente=" . $idexpediente, "", $conn);
	$cadena_tomos = "";
	if (!$expediente_actual[0]['agrupador']) {
		$tomo_padre = $idexpediente;
		if ($expediente_actual[0]['tomo_padre']) {
			$tomo_padre = $expediente_actual[0]['tomo_padre'];
		}
		$ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $tomo_padre, "", $conn);
		$cantidad_tomos = $ccantidad_tomos['numcampos'] + 1;
		//tomos + el padre
		$cadena_tomos = ("&nbsp;&nbsp;&nbsp;<i><b style='font-size:10px;'>Tomo: </b></i><i style='font-size:10px;'>" . $expediente_actual[0]['tomo_no'] . " de " . $cantidad_tomos . "</i>");
	}
	$data = array(
		"idbusqueda_componente" => $_REQUEST["idbusqueda_componente"],
		"idexpediente" => $idexpediente,
		"variable_busqueda" => @$_REQUEST['variable_busqueda'],
		"cod_arbol" => $expediente_actual[0]["cod_arbol"]
	);
	$req_parms = http_build_query($data);
	return ("<div style='' class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_expediente.php?" . $req_parms . "' conector='iframe' titulo='" . $nombre . "'><table><tr><td style='font-size:12px;'> <i class=' icon-folder-open pull-left'></i>&nbsp;<b>" . $nombre . "</b>&nbsp;" . $cadena_tomos . "</td></tr></table></div>");
}

function request_expediente_padre() {
	$texto = '';
	if (@$_REQUEST["idexpediente"]) {
		$texto .= "cod_padre=" . $_REQUEST["idexpediente"];
	} else if (@$_REQUEST["idbusqueda_filtro_temp"]) {
		$texto .= "1=1";
	} else {
		$texto .= "(cod_padre=0 OR cod_padre IS NULL) ";
	}
	if (@$_REQUEST["idcaja"]) {
		$texto .= " AND fk_idcaja=" . @$_REQUEST["idcaja"];
	}
	if (@$_REQUEST["variable_busqueda"] == 2 || @$_REQUEST["variable_busqueda"] == 3) {
		if (@$_REQUEST["idexpediente"]) {
			$texto = "cod_padre=" . $_REQUEST["idexpediente"];
		} else {
			$texto = "1=1";
		}
	}
	return ($texto);
}

function request_expediente_actual() {
	$texto = '';
	if (@$_REQUEST["expediente_actual"]) {
		$texto .= " AND a.idexpediente=" . $_REQUEST["expediente_actual"];
	}
	$texto2 = obtener_expedientes_negados();
	if ($texto2) {
		$texto .= $texto2;
	}
	return ($texto);
}

function obtener_expedientes_negados() {
	global $conn;
	$negados = busca_filtro_tabla("expediente_idexpediente", "entidad_expediente A", "((A.entidad_identidad=1 AND llave_entidad=" . usuario_actual('idfuncionario') . ")or(A.entidad_identidad=2 AND llave_entidad in(" . dependencia_actual_codigos() . "))) AND A.estado=2", "", $conn);

	$no_incluidos = array();
	if ($negados["numcampos"]) {
		$no_incluidos = extrae_campo($negados, "expediente_idexpediente");
		$texto = implode(",", $no_incluidos);
		$texto = " AND a.idexpediente not in(" . implode(",", $no_incluidos) . ")";
	}
	return ($texto);
}

function request_expediente_documento() {
	if (@$_REQUEST["idexpediente"]) {
		return ($_REQUEST["idexpediente"]);
	} elseif (@$_REQUEST["variable_busqueda"]) {
		return ($_REQUEST["variable_busqueda"]);
	} else {
		return ("0");
	}
}

function barra_superior_busqueda() {
	global $conn;
	$permiso = new Permiso();

	$ok2 = $permiso -> acceso_modulo_perfil('transferencia_doc');
	$cadena = '';

	$reporte_inventario = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='reporte_expediente_grid_exp'", "", $conn);
	if ($reporte_inventario['numcampos']) {
		$inventario = $reporte_inventario[0]['idbusqueda_componente'];
	}

	$reporte_indice = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='reporte_docs_expediente_grid_exp'", "", $conn);
	if ($reporte_indice['numcampos']) {
		$indice = $reporte_indice[0]['idbusqueda_componente'];
	}

	$tipo_reporte_exp = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $_REQUEST['idbusqueda_componente'], "", $conn);
	$tipo = '';
	switch ($tipo_reporte_exp[0]['nombre']) {
		case 'expediente' :
			$tipo = '1';
			break;
		case 'documento_central' :
			$tipo = '2';
			break;
		case 'documento_historico' :
			$tipo = '3';
			break;
	}
	$registros_concatenados = "cod_arbol|" . @$_REQUEST["cod_arbol"] . "|-|tipo_expediente|" . $tipo;
	$cadena .= '<li><div class="btn-group">
                    <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Listar &nbsp;
	                   <span class="caret"></span>&nbsp;
                    </button>
                    <ul class="dropdown-menu" id="acciones_expedientes">';

	// INICIO NUEVO DESARROLLO REPORTE EXPEDIENTES 20171004
	$cadena .= '
	<li></li> 
	<li>
	    <a class="kenlace_saia" conector="iframe" idbusqueda_componente="' . $inventario . '" titulo="Inventario Documental" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?variable_busqueda=' . $registros_concatenados . '&idbusqueda_componente=' . $inventario . '">Inventario Documental</a>
	</li>';
	$cadena .= '
	<li></li>
	<li>
	    <a class="kenlace_saia" conector="iframe"  idbusqueda_componente="' . $indice . '" titulo="indice de Expediente" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?variable_busqueda=' . @$_REQUEST["idexpediente"] . '&idbusqueda_componente=' . $indice . '">Indice de Expediente</a>
	</li>';
	// FIN NUEVO DESARROLLO REPORTE EXPEDIENTES 20171004
	$cadena .= '</ul></div></li>';
	return ($cadena);
}

function listado_expedientes_documento($iddocumento) {
	$expedientes = busca_filtro_tabla("", "expediente A, expediente_doc B", "A.idexpediente=B.expediente_idexpediente AND B.documento_iddocumento=" . $iddocumento, "", $conn);
	if ($expedientes["numcampos"]) {
		$texto = '<ul>';
		for ($i = 0; $i < $expedientes["numcampos"]; $i++) {
			$texto .= '<li>' . $expedientes[$i]["nombre"] . '</li>';
		}
		$texto .= '</ul>';
	} else {
		$texto = 'No existen expedientes vinculados con el documento';
	}
	return ($texto);
}

function verificar_expediente($nombre, $padre) {
	global $conn, $usu;
	$exp = busca_filtro_tabla("idexpediente", "expediente", "lower(nombre) like lower('" . $nombre . "') and cod_padre='" . $padre . "'", "", $conn);
	if ($nombre == 'PROCESO RECLAMOS') {

	}
	if (!$exp["numcampos"]) {
		$sql2 = "insert into expediente(nombre,fecha,cod_padre) values('" . $nombre . "'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",'" . $padre . "')";
		$llave = ejecuta_sql($sql2);
		if ($llave)
			return ($llave);
		else {
			return (0);
		}
	}
	return ($exp[0][0]);
}

function vincular_documento_expediente($idexp, $iddoc) {
	global $conn;
	$existe = busca_filtro_tabla("idexpediente_doc", "expediente_doc", "expediente_idexpediente=" . $idexp . " and documento_iddocumento=" . $iddoc, "", $conn);
	if (!$existe['numcampos']) {
		$sql2 = "insert into expediente_doc(expediente_idexpediente,documento_iddocumento) values('" . $idexp . "','" . $iddoc . "')";
		phpmkr_query($sql2);
	}
}

function asignar_expediente($idexp, $tipo_entidad, $llave_entidad, $permiso = "", $indice = 1) {
	global $conn;
	$indice++;
	if ($indice > 100)
		return false;
	$busqueda = busca_filtro_tabla("", "entidad_expediente a", "entidad_identidad=" . $tipo_entidad . " and llave_entidad=" . $llave_entidad . " and expediente_idexpediente=" . $idexp, "", $conn);
	if (!$busqueda["numcampos"]) {
		$sql1 = "insert into entidad_expediente(entidad_identidad, expediente_idexpediente, llave_entidad, estado, permiso, fecha)values(" . $tipo_entidad . "," . $idexp . "," . $llave_entidad . ",'1', '" . $permiso . "', " . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
	} else {
		$sql1 = "update entidad_expediente set entidad_identidad=" . $tipo_entidad . ", expediente_idexpediente=" . $idexp . ", llave_entidad=" . $llave_entidad . ", permiso='" . $permiso . "' where identidad_expediente=" . $busqueda[0]["identidad_expediente"];
	}
	phpmkr_query($sql1);
	$padre = busca_filtro_tabla("", "expediente a", "a.idexpediente=" . $idexp, "", $conn);
	if ($padre[0]["cod_padre"] != '' && $padre[0]["cod_padre"] != 0) {
		return (asignar_expediente($padre[0]["cod_padre"], $tipo_entidad, $llave_entidad, $permiso = "", $indice));
	} else
		return true;
}

function insertar_expediente_automatico($idserie, $hijo = "", $indice = 1) {
	/*
	 $indice++;
	 if($indice>100)return false;
	 $serie=busca_filtro_tabla("","serie a","a.idserie=".$idserie,"",$conn);

	 if($serie["numcampos"]){
	 $busqueda=busca_filtro_tabla("","expediente a","a.serie_idserie=".$serie[0]["idserie"],"",$conn);
	 if(!$busqueda["numcampos"]){
	 $super_serie_padre=obtener_super_padre_serie($serie[0]["idserie"]);
	 $value_agrupador="0";
	 if(intval($serie[0]['tipo_expediente'])==2){
	 $value_agrupador="1";
	 }
	 $sql1="insert into expediente(nombre, fecha, serie_idserie,agrupador)values('".$serie[0]["nombre"]."', ".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').", '".$super_serie_padre."',".$value_agrupador.")";
	 phpmkr_query($sql1);
	 $id=phpmkr_insert_id();
	 }
	 else{
	 $sql1="update expediente set nombre='".$serie[0]["nombre"]."' where idexpediente=".$busqueda[0]["idexpediente"];
	 phpmkr_query($sql1);
	 $id=$busqueda[0]["idexpediente"];
	 }
	 if($hijo){
	 $sql2="update expediente set cod_padre='".$id."' where idexpediente=".$hijo;
	 phpmkr_query($sql2);
	 }
	 if($serie[0]["cod_padre"]!=0&&$serie[0]["cod_padre"]!=''){
	 insertar_expediente_automatico($serie[0]["cod_padre"],$id,$indice);
	 }
	 else return true;
	 }
	 else if($serie[0]["cod_padre"]!=0&&$serie[0]["cod_padre"]!=''){
	 insertar_expediente_automatico($serie[0]["cod_padre"],"",$indice);
	 }
	 else return true;
	 */
	return true;
}

function actualizar_codigo_arbol($idserie) {
	$idexpediente = busca_filtro_tabla("", "expediente A", "A.serie_idserie=" . $idserie, "", $conn);
	if ($idexpediente["numcampos"]) {
		if (!$idexpediente[0]["cod_arbol"]) {
			$codigo = "";
			$padre = busca_filtro_tabla("cod_arbol", "expediente A", "A.idexpediente=" . $idexpediente[0]["cod_padre"], "", $conn);
			if ($padre["numcampos"]) {
				$codigo .= $padre[0]["cod_arbol"] . ".";
			}
			$codigo .= $idexpediente[0]["idexpediente"];
			$sql1 = "update expediente set cod_arbol='" . $codigo . "' WHERE idexpediente=" . $idexpediente[0]["idexpediente"];
			phpmkr_query($sql1);
		}
	}
}

function usuario_actual_codigo() {
	return usuario_actual('idfuncionario');
}

function dependencia_actual_codigos() {
	global $dependencia;
	$dependencias = busca_filtro_tabla("dependencia_iddependencia", "dependencia_cargo a", "a.estado='1' and funcionario_idfuncionario=" . usuario_actual('idfuncionario'), "", $conn);
	$dependencia = extrae_campo($dependencias, "dependencia_iddependencia");
	return implode(",", $dependencia);
}

function cargo_actual_codigos() {
	global $dependencia;
	$cargos = busca_filtro_tabla("cargo_idcargo", "dependencia_cargo a", "a.estado='1' and funcionario_idfuncionario=" . usuario_actual('idfuncionario'), "", $conn);
	$cargo = extrae_campo($cargos, "cargo_idcargo");
	return implode(",", $cargo);
}

//Se encarga de generar el where de la consulta de los expedientes segun la serie.
function filtro_where_expediente_serie() {
	global $conn;
	$datos = @$_REQUEST["variable_busqueda"];
	$where = "";
	if ($datos) {
		$dato = explode("/**/", $datos);
		//$where=" cod_padre='".$dato[1]."' and (serie_idserie is null or serie_idserie='') ";
		$where = " cod_padre='" . $dato[1] . "' ";
	}
	return ($where);
}

//Etiqueta sin enlace del listado sobre los expedientes segun la serie
function enlace_expediente2($idexpediente, $nombre) {
	return ("<div style='' class='link' onclick=window.open('consulta_busqueda_expediente_serie.php?idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"] . "&variable_busqueda=idexpediente/**/" . $idexpediente . "','_self'); titulo='" . $nombre . "'><b>" . $nombre . "</b></div>");
}

//Muestra la descripciÃ³n del listado de documentos
function obtener_descripcion_expediente($descripcion) {
	return ($descripcion);
}

function obtener_expedientes_padre($idexpediente, $expedientes) {
	global $arreglo;
	$expediente = busca_filtro_tabla("", "expediente A", "A.cod_padre=" . $idexpediente . " AND A.estado_archivo=" . $_REQUEST['variable_busqueda'], "", $conn);
	if ($expediente["numcampos"]) {
		for ($i = 0; $i < $expediente["numcampos"]; $i++) {
			if (in_array($expediente[$i]["idexpediente"], $expedientes)) {
				array_push($arreglo, $expediente[$i]["idexpediente"]);
				$hijos = busca_filtro_tabla("", "expediente A", "A.cod_padre=" . $expediente[$i]["idexpediente"] . " AND A.estado_archivo=" . $_REQUEST['variable_busqueda'], "", $conn);
				if ($hijos["numcampos"]) {
					obtener_expedientes_padre($expediente[$i]["idexpediente"], $expedientes);
				}
			} else
				continue;
		}
	}
	return (true);
}

function eliminar_permiso_expediente($idexpediente, $tipo_entidad, $entidad) {
	$sql1 = "DELETE from entidad_expediente where expediente_idexpediente='$idexpediente' and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad'";
	phpmkr_query($sql1);
}

function negar_expediente($idexp, $tipo_entidad, $llave_entidad, $permiso = "", $indice = 1) {
	global $conn;
	$indice++;
	if ($indice > 100)
		return false;
	$busqueda = busca_filtro_tabla("", "entidad_expediente a", "entidad_identidad=" . $tipo_entidad . " and llave_entidad=" . $llave_entidad . " and expediente_idexpediente=" . $idexp . " and estado='2'", "", $conn);
	if (!$busqueda["numcampos"]) {
		$sql1 = "insert into entidad_expediente(entidad_identidad, expediente_idexpediente, llave_entidad, estado, permiso, fecha)values(" . $tipo_entidad . "," . $idexp . "," . $llave_entidad . ",'2', '" . $permiso . "', " . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
	} else {
		$sql1 = "update entidad_expediente set entidad_identidad=" . $tipo_entidad . ", expediente_idexpediente=" . $idexp . ", llave_entidad=" . $llave_entidad . ", permiso='" . $permiso . "', estado='2' where identidad_expediente=" . $busqueda[0]["identidad_expediente"];
	}
	phpmkr_query($sql1);
}

function enlaces_adicionales_expediente($idexpediente, $nombre, $estado_cierre, $propietario, $agrupador) {
	global $conn;
	if ($agrupador == "agrupador") {
		$agrupador = 0;
	}
	$m = 0;
	$e = 0;
	$p = 0;

	if ($propietario == $_SESSION["usuario_actual"]) {
		$m = 1;
		$e = 1;
		$p = 1;
	} else {
		$permiso = busca_filtro_tabla("permiso", "entidad_expediente", "expediente_idexpediente=" . $idexpediente . " AND entidad_identidad=1 and estado=1 and llave_entidad=" . usuario_actual("idfuncionario"), "", $conn);
		if ($permiso["numcampos"] && $permiso[0]["permiso"] != "") {
			if (strpos($permiso[0]["permiso"], "m") !== false) {
				$m = 1;
			}
			if (strpos($permiso[0]["permiso"], "e") !== false) {
				$e = 1;
			}
			if (strpos($permiso[0]["permiso"], "p") !== false) {
				$p = 1;
			}
		}
	}

	$texto = "";
	if ($e) {
		$texto .= '<div class=\'btn btn-mini eliminar_expediente tooltip_saia pull-right\' idregistro=\'' . $idexpediente . '\' title=\'Eliminar ' . $nombre . '\'><i class=\'icon-remove\'></i></div>';
	}
	if ($m) {
		$texto .= '<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\'' . $idexpediente . '\' title=\'Editar ' . $nombre . '\' enlace=\'pantallas/expediente/editar_expediente.php?idexpediente=' . $idexpediente . '&idbusqueda_componente=' . @$_REQUEST['idbusqueda_componente'] . '&div_actualiza=resultado_pantalla_' . $idexpediente . '\'><i class=\'icon-pencil\'></i></div>';
	}
	if (!$agrupador) {
		$texto .= '<div class=\'btn btn-mini link kenlace_saia tooltip_saia pull-right\' title=\'Imprimir rotulo\' titulo=\'Imprimir rotulo\' enlace=\'pantallas/caja/rotulo.php?idexpediente=' . $idexpediente . '\' conector=\'iframe\'><i class=\'icon-print\'></i></div>';
	}
	if ($p) {
		$texto .= '<div class=\'btn btn-mini enlace_expediente tooltip_saia pull-right\' idregistro=\'' . $idexpediente . '\' title=\'Asignar ' . $nombre . '\' enlace=\'pantallas/expediente/asignar_expediente.php?idexpediente=' . $idexpediente . '\'><i class=\'icon-lock\'></i></div>';
	}

	if ($propietario == $_SESSION["usuario_actual"] && !$agrupador) {
		$texto .= '<div class=\'btn btn-mini crear_tomo_expediente tooltip_saia pull-right\' idregistro=\'' . $idexpediente . '\' title=\'Crear Tomo ' . $nombre . '\'><i class=\'icon-folder-open\'></i></div>';
	}
	if (!$agrupador) {
		$texto .= '<div id="seleccionados_expediente_' . $idexpediente . '" idregistro=\'' . $idexpediente . '\' titulo=\'Seleccionar\' class=\'btn btn-mini tooltip_saia adicionar_seleccionados_expediente pull-right\'><i class=\'icon-uncheck\' ></i></div>';
	}
	return ($texto);
}

function valida_from_caja() {
	if (@$_REQUEST['variable_busqueda'] != 'from_caja') {
		return ('a.estado_archivo=1 and');
	}
}

function expedientes_asignados() {
	global $conn;
	$idfunc_actual = usuario_actual('idfuncionario');
	if (@$_REQUEST["idbusqueda_componente"]) {
		$busqueda_componente = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='expediente_admin' AND A.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "", $conn);
		if ($busqueda_componente["numcampos"]) {
			return ("1=1");
		}
		//INICIO SI TIENE PERMISO Administraci&oacute;n de Archivo & el reporte es Inventario documental
		$permiso = new Permiso();
		$ok = $permiso -> acceso_modulo_perfil('permiso_admin_archivo');
		$reporte_inventario_documental = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='reporte_expediente_grid_exp' AND A.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "", $conn);
		if ($reporte_inventario_documental["numcampos"] && $ok) {
			return ("1=1");
		}
		//FIN SI TIENE PERMISO Administraci&oacute;n de Archivo & el reporte es Inventario documental
	}

	$roles = busca_filtro_tabla("dependencia_iddependencia,cargo_idcargo", "dependencia_cargo a", "a.estado='1' and a.funcionario_idfuncionario=" . $idfunc_actual, "", $conn);
	$dependencias = extrae_campo($roles, "dependencia_iddependencia");
	$cargos = extrae_campo($roles, "cargo_idcargo");
	$cadena .= "";
	$cadena .= "((a.identidad_exp=1 AND a.llave_exp='" . $idfunc_actual . "') or (a.identidad_exp=2 AND a.llave_exp in ('" . implode("','", $dependencias) . "')) or (a.identidad_exp=4 AND a.llave_exp in('" . implode("','", $cargos) . "')))";
	return ($cadena);
}

function expedientes_asignados2() {
	$arreglo = arreglo_expedientes_asignados();
	if (count($arreglo)) {
		$texto = implode(",", $arreglo);
	} else {
		$texto = "''";
	}
	$cadena = "a.idexpediente in(" . $texto . ")";
	return ($cadena);
}

function arreglo_expedientes_asignados() {
	global $conn;
	$max_salida = 6;
	$ruta_db_superior = $ruta = "";
	while ($max_salida > 0) {
		if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
		} $ruta .= "../";
		$max_salida--;
	}
	include_once ($ruta_db_superior . "db.php");

	if (@$_REQUEST["idbusqueda_componente"]) {
		$busqueda_componente = busca_filtro_tabla("", "busqueda_componente A", "A.nombre='expediente_admin' AND A.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "", $conn);
		if ($busqueda_componente["numcampos"]) {
			$expedientes = busca_filtro_tabla("", "expediente A", "", "", $conn);
			$expediente = extrae_campo($expedientes, "idexpediente");
			return ($expediente);
		}
	}

	$roles = busca_filtro_tabla("", "dependencia_cargo a", "a.estado='1' and a.funcionario_idfuncionario=" . usuario_actual('idfuncionario'), "", $conn);
	$dependencias = extrae_campo($roles, "dependencia_iddependencia");
	$cargos = extrae_campo($roles, "cargo_idcargo");

	$asignacion_expediente = busca_filtro_tabla("A.expediente_idexpediente", "entidad_expediente A", "A.estado=1 AND((entidad_identidad=1 AND llave_entidad='" . usuario_actual("idfuncionario") . "') or (entidad_identidad=2 AND llave_entidad in ('" . implode("','", $dependencias) . "')) or (entidad_identidad=4 AND llave_entidad in('" . implode("','", $cargos) . "')))", "", $conn);

	$where_estado_archivo = " AND estado_archivo=" . $_REQUEST['variable_busqueda'];

	$expedientes_serie = busca_filtro_tabla("A.idexpediente", "expediente A, serie B, entidad_serie C", "A.serie_idserie=B.idserie AND B.idserie=C.serie_idserie AND B.estado=1 AND ((C.entidad_identidad=1 AND C.llave_entidad='" . usuario_actual("idfuncionario") . "') or (C.entidad_identidad=2 AND C.llave_entidad in ('" . implode("','", $dependencias) . "')) or (C.entidad_identidad=4 AND C.llave_entidad in('" . implode("','", $cargos) . "')))" . $where_estado_archivo, "", $conn);
	$array_expedientes_serie = extrae_campo($expedientes_serie, "idexpediente");

	$expedientes_serie_negado = busca_filtro_tabla("A.idexpediente", "expediente A, serie B, entidad_serie C", "A.serie_idserie=B.idserie AND B.idserie=C.serie_idserie AND B.estado=1 AND C.estado=2 AND ((C.entidad_identidad=1 AND C.llave_entidad='" . usuario_actual("idfuncionario") . "') or (C.entidad_identidad=2 AND C.llave_entidad in ('" . implode("','", $dependencias) . "')) or (C.entidad_identidad=4 AND C.llave_entidad in('" . implode("','", $cargos) . "')))" . $where_estado_archivo, "", $conn);
	$array_expedientes_serie_negado = extrae_campo($expedientes_serie_negado, "idexpediente");

	$series_asignadas = array_diff($array_expedientes_serie, $array_expedientes_serie_negado);

	$lista = extrae_campo($asignacion_expediente, "expediente_idexpediente");
	$lista = array_merge($lista, $series_asignadas);
	return ($lista);
}

function barra_inferior_documento_expediente($iddoc, $numero, $idexpediente) {
	global $conn, $ruta_db_superior;
	$dato_prioridad = busca_filtro_tabla("", "prioridad_documento", "documento_iddocumento=" . $iddoc, "fecha_asignacion DESC", $conn);

	$prioridad = "icon-flag";
	if ($dato_prioridad["numcampos"]) {
		switch ($dato_prioridad[0]["prioridad"]) {
			case 1 :
				$prioridad = 'icon-flag-rojo';
				break;
			case 2 :
				$prioridad = 'icon-flag-morado';
				break;
			case 3 :
				$prioridad = 'icon-flag-naranja';
				break;
			case 4 :
				$prioridad = 'icon-flag-amarillo';
				break;
			case 5 :
				$prioridad = 'icon-flag-verde';
				break;
			default :
				$prioridad = 'icon-flag';
				break;
		}
	}
	$texto .= '<div class="pull"><div class="btn-group pull-left" >
  <button type="button" class="btn btn-mini detalle_documento_saia tooltip_saia" enlace="ordenar.php?accion=mostrar&mostrar_formato=1&key=' . $iddoc . '" title="No.' . $numero . '" idregistro="' . $iddoc . '" id="expediente_' . $iddoc . '"><i class="icon-info-sign"></i></button>
  <button type="button" class="btn btn-mini dropdown-toggle tooltip_saia" data-toggle="dropdown" title="Prioridad">
    <i class="' . $prioridad . '" id="prioridad_' . $iddoc . '" prioridad="' . $prioridad . '"></i><span class="caret"></span>
  </button>
    <ul class="dropdown-menu">
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="1"><i class="icon-flag-rojo"></i> Rojo</a></li>
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="2"><i class="icon-flag-morado"></i> Morado</a></li>
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="3"><i class="icon-flag-naranja"></i> Naranja</a></li>
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="4"><i class="icon-flag-amarillo"></i> Amarillo</a></li>
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="5"><i class="icon-flag-verde"></i> Verde</a></li>
      <li><a href="#" idregistro="' . $iddoc . '" class="documento_prioridad" prioridad="0"><i class="icon-flag"></i>Sin indicador</a></li>
    </ul>';
	$permiso = new Permiso();
	$ok1 = $permiso -> acceso_modulo_perfil('eliminar_documento_expediente');
	if ($ok1) {
		$texto .= '<button type="button" id="sacar_expediente" class="btn btn-mini tooltip_saia sacar_expediente" iddocumento="' . $iddoc . '" idexpediente="' . $idexpediente . '" title="Sacar de este expediente">
    <i class="icon-remove"></i>
    </button>';
	}
	$texto .= '</div>' . mostrar_fecha_limite_documento($iddoc) . '</div><br><br>';
	//$texto.=barra_estandar_documento($iddoc,$funcionario);
	return ($texto);
}

//VALIDACION BLOQUEO DOCUMENTOS
function origen_documento_expediente($doc, $numero, $origen = "", $tipo_radicado = "", $estado = "", $serie = "", $tipo_ejecutor = "") {
	$enlace = origen_documento($doc, $numero, $origen, $tipo_radicado, $estado, $serie, $tipo_ejecutor);

	//SE VALIDA SI EL USUARIO ESTA INVOLUCRADO CON EL DOCUMENTO (TRANSFERENCIA,RUTA)
	$involucrado = validar_relacion_documento_expediente($doc);
	if (!$involucrado['numcampos']) {
		//$enlace = preg_replace("/class=[\"\'][^\'\"]*kenlace_saia[^\'\"]*[\"\']/", "class='link pull-left enlace_documento_bloqueado' iddoc=" . $doc, $enlace, 1);
	}
	return ($enlace);
}

function fecha_creacion_documento_expediente($fecha0, $plantilla = Null, $doc = Null) {
	$enlace = fecha_creacion_documento($fecha0, $plantilla, $doc);

	//SE VALIDA SI EL USUARIO ESTA INVOLUCRADO CON EL DOCUMENTO (TRANSFERENCIA,RUTA)
	$involucrado = validar_relacion_documento_expediente($doc);
	if (!$involucrado['numcampos']) {
		//$enlace = preg_replace("/class=[\"\'][^\'\"]*kenlace_saia[^\'\"]*[\"\']/", "class='link enlace_documento_bloqueado' iddoc=" . $doc, $enlace, 1);
	}

	return ($enlace);
}

function validar_relacion_documento_expediente($doc) {
	global $conn;
	$funcionario_codigo = usuario_actual('funcionario_codigo');
	$estados_validar = array(
		"'borrador'",
		"'transferido'",
		"'revisado'",
		"'aprobado'"
	);

	$consulta = busca_filtro_tabla("archivo_idarchivo", "buzon_salida", "archivo_idarchivo=" . $doc . " AND tipo_destino=1 AND lower(nombre) IN(" . implode(',', $estados_validar) . ") AND destino=" . $funcionario_codigo, "", $conn);
	return ($consulta);
}

function obtener_super_padre_serie($idserie) {
	global $conn;

	$serie = busca_filtro_tabla("cod_padre", "serie", "idserie=" . $idserie, "", $conn);
	if ($serie['numcampos']) {
		if ($serie[0]['cod_padre']) {
			return (obtener_super_padre_serie($serie[0]['cod_padre']));
		} else {
			return ($idserie);
		}
	}
}

function transferencia_documental() {
	$cadena = '<li><a href="#" id="transferencia_documental" titulo="Transferencia documental">Transferir a Archivo</a></li>
	<script>
		$("#transferencia_documental").click(function(){
			var seleccionados=$("#seleccionados_expediente").val();			
			$.ajax({
				type : "POST",
				url : "../expediente/validar_cierre_expedientes.php",
				data : {idexpedientes : seleccionados	},
				dataType:"json",
				success : function (response){
					if(response.exito == 1){
						enlace_katien_saia("formatos/transferencia_doc/adicionar_transferencia_doc.php?id="+seleccionados,"Transferencia documental","iframe","");
					}else{
						alert(response.msn);
					}
				},
				error : function (err){
					alert("Error al procesar la solicitud");
				}
			});	
					
		});
		</script>';
	echo $cadena;
}

function adicionar_expediente() {
	$permiso = new Permiso();
	$ok1 = $permiso -> acceso_modulo_perfil('adicionar_expediente');
	if ($ok1) {
		$cadena .= '
	<li></li>
	<li>
	    <a  href="#" id="adicionar_expediente" idbusqueda_componente="' . $_REQUEST["idbusqueda_componente"] . '" conector="iframe" titulo="Adicionar expediente hijo" enlace="pantallas/expediente/adicionar_expediente.php?cod_padre=' . @$_REQUEST["idexpediente"] . '&div_actualiza=resultado_busqueda' . $_REQUEST["idbusqueda_componente"] . '&target_actualiza=parent&idbusqueda_componente=' . $_REQUEST["idbusqueda_componente"] . '&cod_padre=' . $_REQUEST["idexpediente"] . '&estado_archivo=' . @$_REQUEST["variable_busqueda"] . '&fk_idcaja=' . $_REQUEST["idcaja"] . '">Adicionar Expediente/Agrupador</a>
	</li>';
		if ($_REQUEST["idexpediente"] != 0 && $_REQUEST["idexpediente"] != "") {
			$cadena .= '
		<li></li>
		<li>
		    <a id="adicionar_documento_exp" conector="iframe" titulo="Adicionar Documento" enlace="formatos/vincular_doc_expedie/adicionar_vincular_doc_expedie.php?idexpediente=' . @$_REQUEST["idexpediente"] . '">Adicionar Documento</a>
		</li>';
		}
	}
	echo($cadena);
}

function prestamo_documento() {
	$tipo = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $_REQUEST['idbusqueda_componente'], "", $conn);
	$estado = "";
	switch ($tipo[0]['nombre']) {
		case 'expediente' :
			$estado = 1;
			break;
		case 'documento_central' :
			$estado = 2;
			break;
		case 'documento_historico' :
			$estado = 3;
			break;
	}
	$cadena = '<li><a href="#" id="prestamo_documento" titulo="Solicitud de prestamo de documentos">Solicitar pr&eacute;stamo</a></li>
	<script>
		$("#prestamo_documento").click(function(){
			var seleccionados=$("#seleccionados_expediente").val();
			var estado_archivo=' . $estado . ';
			if(seleccionados){
				enlace_katien_saia("formatos/solicitud_prestamo/adicionar_solicitud_prestamo.php?id="+seleccionados+"&estado_archivo="+estado_archivo,"Solicitud de prestamo","iframe","");
			}else{
				alert("Seleccione por lo menos un expediente");
			}
		});
		</script>';
	echo $cadena;
}

function hallar_expedientes_hijos($idexpediente = 0) {
	global $conn;
	if ($idexpediente) {
		$matriz_expedientes = array($idexpediente);
		$hijos = busca_filtro_tabla("idexpediente", "expediente", "cod_padre=" . $idexpediente, "", $conn);
		if ($hijos['numcampos']) {
			for ($i = 0; $i < $hijos['numcampos']; $i++) {
				$matriz_expedientes = array_merge($matriz_expedientes, hallar_expedientes_hijos($hijos[$i]['idexpediente']));
			}
		}
		return ($matriz_expedientes);
	} //fin if idexpediente
}

function compartir_expediente() {
	$permiso = new Permiso();
	$ok1 = $permiso -> acceso_modulo_perfil('compartir_expediente');
	if ($ok1) {
		$cadena .= '
		<li></li>
		<li>
		    <a  href="#" id="compartir_expediente" idbusqueda_componente="' . $_REQUEST["idbusqueda_componente"] . '" conector="iframe" titulo="Compartir Expediente" enlace="pantallas/expediente/asignar_expediente.php?div_actualiza=resultado_busqueda' . $_REQUEST["idbusqueda_componente"] . '&target_actualiza=parent&idbusqueda_componente=' . $_REQUEST["idbusqueda_componente"] . '">Compartir Expediente</a>
		</li>';
	}
	echo($cadena);
}
?>