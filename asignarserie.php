<?php
include_once ("db.php");
include_once ("header.php");
include_once ("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

if ($_REQUEST["opt"] == 1 && $_REQUEST["iddependencia"] && $_REQUEST["serie_idserie"]) {
	//VINCULACION DE DEPENDENCIAS VS SERIES
	$series = array_unique(explode(",", $_REQUEST["serie_idserie"]));
	$dependencias = array_unique(explode(",", $_REQUEST["iddependencia"]));

	if ($_REQUEST["accion"] == "eliminar") {
		foreach ($series as $idserie) {
			foreach ($dependencias as $id) {
				$delete = "UPDATE entidad_serie SET estado=0 WHERE serie_idserie=" . $idserie . " and llave_entidad=" . $id;
				phpmkr_query($delete) or die("Error al eliminar la vinculacion de la serie con la dependencia");
			}
		}
	} else {
		$cons_serie = busca_filtro_tabla("cod_arbol", "serie", "idserie in (" . implode(",", $series) . ")", "", $conn);
		if ($cons_serie["numcampos"]) {
			$cod_arboles = array();
			for ($i = 0; $i < $cons_serie["numcampos"]; $i++) {
				$cod_arboles = array_merge($cod_arboles, explode(".", $cons_serie[$i]["cod_arbol"]));
			}
			$ids = array_unique($cod_arboles);
			foreach ($ids as $idserie) {
				$temp_dep = $dependencias;
				$exis = busca_filtro_tabla("llave_entidad", "entidad_serie", "estado=1 and serie_idserie=" . $idserie . " and llave_entidad in (" . implode(",", $temp_dep) . ")", "", $conn);
				if ($exis["numcampos"]) {
					$ids_insert = extrae_campo($exis, "llave_entidad");
					$temp_dep = array_diff($temp_dep, $ids_insert);
				}
				foreach ($temp_dep as $iddepe) {
					$insert = "INSERT INTO entidad_serie (entidad_identidad,serie_idserie,llave_entidad,estado,fecha) VALUES (2," . $idserie . "," . $iddepe . ",1," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
					phpmkr_query($insert) or die("Error al guardar la informacion");

				}
			}
		}
	}
	notificaciones("Datos Guardados!", "success", 5000);
	if ($_REQUEST["idnode"] != "") {
		$info_node=explode(".", $_REQUEST["idnode"]);
		if(trim($_REQUEST["iddependencia"])==$info_node[0]){
		?>
		<script>
			var idnode='<?php echo $_REQUEST["idnode"];?>';
			window.parent.frames['arbol'].tree2.deleteChildItems(idnode);
			window.parent.frames['arbol'].tree2.refreshItem(idnode);
		</script>
		<?php
		}else{
			$dep_papa = busca_filtro_tabla("iddependencia", "dependencia", "(cod_padre=0 or cod_padre is null)", "nombre ASC", $conn);
			?>
			<script>
				var idnode='<?php echo $dep_papa[0]["iddependencia"];?>.0.<?php echo $info_node[2];?>';
				window.parent.frames['arbol'].tree2.deleteChildItems(idnode);
				window.parent.frames['arbol'].tree2.refreshItem(idnode);
			</script>
			<?php
		}
	} else {
		$idmodulo = busca_filtro_tabla("idmodulo", "modulo", "nombre='serie'", "", $conn);
		if ($idmodulo["numcampos"]) {
			abrir_url("pantallas/pantallas_kaiten/principal.php?idmodulo=" . $idmodulo[0]["idmodulo"] . "&cmd=resetall", "centro");
		} else {
			die();
		}
	}
}

if ($_REQUEST["opt"] == 2 && $_REQUEST["tipo_entidad"] && $_REQUEST["serie_idserie"]) {
	//PERMISOS DE SERIES VS (CARGO,DEPENDENCIA,FUNCIONARIO)
	$series = array_unique(explode(",", $_REQUEST["serie_idserie"]));
	$entidad = array_unique(explode(",", $_REQUEST["identidad"]));
	$entidad_identidad = $_REQUEST["tipo_entidad"];

	switch ($entidad_identidad) {
		case '1' :
			//funcionario
			$idfuncionarios = array();
			foreach ($entidad as $rol) {
				if (strpos($rol, "#") === false) {
					$func = busca_filtro_tabla("idfuncionario", "vfuncionario_dc", "iddependencia_cargo=" . $rol, "", $conn);
					if ($func["numcampos"]) {
						$idfuncionarios[] = $func[0]["idfuncionario"];
					}
				}
			}
			$idllave_entidad = array_unique($idfuncionarios);
			break;
		case '2' :
			//dependencia
			$idllave_entidad = $entidad;
			break;
		case '4' :
			//cargo
			$idllave_entidad = $entidad;
			break;
	}
	if ($_REQUEST["accion"] == "eliminar") {
		foreach ($series as $idserie) {
			foreach ($idllave_entidad as $id) {
				$delete = "UPDATE permiso_serie SET estado=0 WHERE entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $idserie . " and llave_entidad=" . $id;
				phpmkr_query($delete) or die("Error al eliminar el permiso");
			}
		}

	} else {
		$cons_serie = busca_filtro_tabla("cod_arbol", "serie", "idserie in (" . implode(",", $series) . ")", "", $conn);
		if ($cons_serie["numcampos"]) {
			$cod_arboles = array();
			for ($i = 0; $i < $cons_serie["numcampos"]; $i++) {
				$cod_arboles = array_merge($cod_arboles, explode(".", $cons_serie[$i]["cod_arbol"]));
			}
			$ids = array_unique($cod_arboles);
			foreach ($ids as $idserie) {
				$array_temp = $idllave_entidad;
				$exis = busca_filtro_tabla("llave_entidad", "permiso_serie", "estado=1 and entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $idserie . " and llave_entidad in (" . implode(",", $array_temp) . ")", "", $conn);
				if ($exis["numcampos"]) {
					$ids_insert = extrae_campo($exis, "llave_entidad");
					$array_temp = array_diff($array_temp, $ids_insert);
				}
				foreach ($array_temp as $id) {
					$insert = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado) VALUES (" . $entidad_identidad . "," . $idserie . "," . $id . ",1)";
					phpmkr_query($insert) or die("Error al guardar la informacion");
				}
			}
		}
	}
	notificaciones("Datos actualizados!", "success", 5000);
	abrir_url("permiso_serie.php","_self");
	die();
}

include_once ("footer.php");
?>