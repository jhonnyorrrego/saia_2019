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
$GLOBALS["idfun_actual"] = usuario_actual('idfuncionario');

function idfunc_actual_caja() {
	return $GLOBALS["idfun_actual"];
}

function barra_superior_busqueda() {
	$cadena = '
	<li class="divider-vertical"></li>                          
	<li>            
	 <div class="btn-group">                    
	    <button class="btn btn-mini" id="adicionar_caja" title="Adicionar caja" enlace="pantallas/caja/adicionar_caja.php">Adicionar Caja</button>
	  </div>
	</li>';
	return ($cadena);
}

function asignar_caja($idcaja, $tipo_entidad, $llave_entidad, $permiso = "", $indice = 1) {
	global $conn;
	$indice++;
	if ($indice > 100) {
		return false;
	}
	$busqueda = busca_filtro_tabla("identidad_caja", "entidad_caja a", "entidad_identidad=" . $tipo_entidad . " and llave_entidad=" . $llave_entidad . " and caja_idcaja=" . $idcaja, "", $conn);
	if (!$busqueda["numcampos"]) {
		$sql1 = "insert into entidad_caja(entidad_identidad, caja_idcaja, llave_entidad, estado, permiso, fecha) values (" . $tipo_entidad . "," . $idcaja . "," . $llave_entidad . ",'1', '" . $permiso . "', " . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
	} else {
		$sql1 = "update entidad_caja set entidad_identidad=" . $tipo_entidad . ", caja_idcaja=" . $idcaja . ", llave_entidad=" . $llave_entidad . ", permiso='" . $permiso . "' where identidad_caja=" . $busqueda[0]["identidad_caja"];
	}
	phpmkr_query($sql1) or die("Error al actualizar los permisos de la caja");
	return true;
}

function enlaces_adicionales_caja($idcaja, $propietario) {
	$m = 0;
	$e = 0;
	$p = 0;
	if ($propietario == $GLOBALS["idfun_actual"]) {
		$m = 1;
		$e = 1;
		$p = 1;
	} else {
		$permiso = busca_filtro_tabla("permiso", "entidad_caja", "caja_idcaja=" . $idcaja . " AND entidad_identidad=1 and estado=1 and llave_entidad=" . $GLOBALS["idfun_actual"], "", $conn);
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
		$texto = '<div class="btn btn-mini eliminar_caja tooltip_saia pull-right" idregistro="' . $idcaja . '" title="Eliminar"><i class="icon-remove"></i></div>';
	}
	if ($m) {
		$texto .= '<div class="btn btn-mini enlace_caja tooltip_saia pull-right" idregistro="' . $idcaja . '" title="Editar" enlace="pantallas/caja/editar_caja.php?idcaja=' . $idcaja . '"><i class="icon-pencil"></i></div>';
	}
	$texto .= '<div class="btn btn-mini link kenlace_saia tooltip_saia pull-right" title="Imprimir rotulo" titulo="Imprimir rotulo" enlace="pantallas/caja/rotulo.php?idcaja=' . $idcaja . '" conector="iframe" onclick=" "><i class="icon-print"></i></div>';
	if ($p) {
		$texto .= '<div class="btn btn-mini enlace_caja tooltip_saia pull-right" idregistro="' . $idcaja . '" title="Asignar" enlace="pantallas/caja/asignar_caja.php?idcaja='.$idcaja.'"><i class="icon-lock"></i></div>';
	}
	return ($texto);
}

function enlace_caja($idcaja, $dependencia, $serie, $numero) {
	global $conn;
	$componente_exp = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente a", "a.nombre='expediente'", "", $conn);
	return ("<div class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_expediente.php?idbusqueda_componente=" . $componente_exp[0]["idbusqueda_componente"] . "&idcaja=" . $idcaja . "&variable_busqueda=from_caja' conector='iframe' titulo='Caja No.  " . $dependencia . "-" . $serie . "-" . $numero . "'><b>" . $dependencia . "-" . $serie . "-" . $numero . "</b></div>");
}



function obtener_descripcion_caja($fondo, $seccion, $subseccion, $codigo) {
	if ($fondo == 'fondo') {
		$fondo = '';
	}
	if ($seccion == 'seccion') {
		$seccion = '';
	}
	if ($subseccion == 'subseccion') {
		$subseccion = '';
	}
	if ($codigo == 'codigo') {
		$codigo = '';
	}
	$texto = '<b>Fondo:</b> ' . $fondo . '<br /><b>Seccion:</b> ' . $seccion . '<br /><b>Subseccion:</b> ' . $subseccion;
	return ($texto);
}

function dependencia_actual_codigos_caja() {
	global $dependencia;
	$dependencias = busca_filtro_tabla("dependencia_iddependencia", "dependencia_cargo a", "a.estado='1' and funcionario_idfuncionario=" . usuario_actual('idfuncionario'), "", $conn);
	$dependencia = extrae_campo($dependencias, "dependencia_iddependencia");
	return implode(",", $dependencia);
}

function cargo_actual_codigos_caja() {
	global $dependencia;
	$cargos = busca_filtro_tabla("cargo_idcargo", "dependencia_cargo a", "a.estado='1' and funcionario_idfuncionario=" . $GLOBALS["idfun_actual"], "", $conn);
	$cargo = extrae_campo($cargos, "cargo_idcargo");
	return implode(",", $cargo);
}

function consultar_numero_carpetas_caja($idcaja) {
	global $conn;
	$expedientes = busca_filtro_tabla("count(*) as cantidad", "expediente", "fk_idcaja = " . $idcaja, "", $conn);
	return $expedientes[0]["cantidad"];
}

function calcular_fecha_extrema_inicial($idcaja) {
	global $conn;
	$expedientes = busca_filtro_tabla("MIN(date(fecha)) as fecha", "expediente", "fk_idcaja = " . $idcaja, "", $conn);
	return $expedientes[0]["fecha"];
}

function calcular_fecha_extrema_final($idcaja) {
	global $conn;
	$expedientes = busca_filtro_tabla("MAX(date(fecha)) as fecha", "expediente", "fk_idcaja = " . $idcaja, "", $conn);
	return $expedientes[0]["fecha"];
}

function consulta_material_caja($idcaja) {
	global $conn;
	$caja = busca_filtro_tabla('nombre', 'cf_material', "valor=" . $idcaja, "idcf_material", $conn);
	return $caja[0]["nombre"];
}
?>