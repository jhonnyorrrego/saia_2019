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
include_once ($ruta_db_superior . "class.funcionarios.php");

global $serie_base, $dependencia_base, $ind_dependencia, $puntero_array;

if ($_REQUEST['tabla']) {
	$tabla = $_REQUEST['tabla'];
	if ($_REQUEST["valores_serie"]) {
		$idfuncionario = usuario_actual("idfuncionario");
		$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);

		$lista_dependencias_total = array();
		$lista_dependencias_total = array_merge((array)$datos_admin_funcionario["series_dependencia"], (array)$datos_admin_funcionario["series_funcionario"]);
		$lista_dependencias_total = array_merge((array)$datos_admin_funcionario["series_cargo"], (array)$lista_dependencias_total);
		$busca_papas = busca_filtro_tabla("id" . $tabla . ",nombre,categoria,cod_padre", $tabla, "id" . $tabla . " in (" . implode(',', $lista_dependencias_total) . ")", "", $conn);

	} else {
		$busca_papas = busca_filtro_tabla("id" . $tabla . ",nombre,categoria,cod_padre", $tabla, "lower(nombre) like(lower('%" . $_REQUEST['nombre'] . "%'))", "", $conn);
	}

	$puntero_array = 0;
	$otras_cat = '';
	$serie_base = array();
	$resultados = array();
	$resultado = array();
	$final = array();
	$idserie = array();
	for ($i = 0; $i < $busca_papas['numcampos']; $i++) {
		$ind_dependencia = '';
		$campos = array();
		
		lista_papas($busca_papas[$i]['id' . $tabla], $campos, $tabla, $puntero_array,$busca_papas[$i]['id' . $tabla],$idserie);
		if ($ind_dependencia != '') {
			$serie_base[$puntero_array] = (array_unique($serie_base[$puntero_array]));
		}

		if ($busca_papas[$i]['categoria'] == 3) {
			$serie_base[0][] = 'otras_categorias-' . $busca_papas[$i]['idserie'];
			$otras_cat = "3-categoria-Otras categorias,";
		}
	}
	$final["idserie"]=array_unique($idserie);	
	$resultado = (array_unique($serie_base, SORT_REGULAR));
	if (count($dependencia_base) > 0) {
		$dependencia_base = array_unique(array_reverse($dependencia_base));
		$resultados = array_merge(($dependencia_base), ($resultado[0]));
	} else {
		$resultados = array_merge($resultado[0]);
	}
	$final['datos'] = $otras_cat . "series_sin_asignar," . implode(',', $resultados);
	echo(json_encode($final));
}

function lista_papas($id, &$campos, $tabla, $idserie_base,$idserie_real,&$idserie) {
	global $conn, $serie_base, $ind_dependencia, $puntero_array;
	$campos[] = $id;
	$buscar_campo = busca_filtro_tabla("cod_padre,categoria", $tabla, "cod_padre IS NOT NULL AND id" . $tabla . "=" . $id, "", $conn);

	if ($buscar_campo["numcampos"]) {
		lista_papas($buscar_campo[0]["cod_padre"], $campos, $tabla, $idserie_base);
		listar_entidad($id, 'entidad_serie');
		if ($ind_dependencia != '') {
			if($id==$idserie_real){
				$idserie[] =  $ind_dependencia . 'sub' . $buscar_campo[0]['cod_padre'];;
			}
			$serie_base[$idserie_base][] = $ind_dependencia . 'sub' . $buscar_campo[0]['cod_padre'];
		}
		if ($busca_papas[$i]['categoria'] == 3) {
			$serie_base[0][] = 'otras_categorias-' . $buscar_campo[0]['cod_padre'];
		}
	} else {
		listar_entidad($id, 'entidad_serie',$idserie_real,$idserie);
	}
}

function listar_entidad($id, $tabla,$idserie_real,&$idserie) {
	global $conn, $serie_base, $dependencia_base, $ind_dependencia, $puntero_array;
	$buscar_campo = busca_filtro_tabla("", $tabla, "entidad_identidad=2 and serie_idserie=" . $id, "", $conn);
	for ($i = 0; $i < $buscar_campo['numcampos']; $i++) {
		$ind_dependencia = $buscar_campo[$i]['llave_entidad'];
		if($id==$idserie_real){
			$idserie[]=$buscar_campo[$i]['llave_entidad'] . 'sub' . $buscar_campo[$i]['serie_idserie'];
		}
		$serie_base[$puntero_array][] = $buscar_campo[$i]['llave_entidad'] . 'sub' . $buscar_campo[$i]['serie_idserie'];
		$buscar_dependencia = busca_filtro_tabla("cod_padre", 'dependencia', "cod_padre IS NOT NULL and iddependencia=" . $buscar_campo[$i]['llave_entidad'], "", $conn);
		if ($buscar_dependencia["numcampos"]) {
			$dependencia_base[] = 'd' . $buscar_campo[$i]['llave_entidad'];
			listar_dependencia($buscar_dependencia[0]['cod_padre'], $i);
		} else {
			$dependencia_base[] = 'd' . $buscar_campo[$i]['llave_entidad'];
		}
		$serie_base[$puntero_array] = ($serie_base[$puntero_array]);
	}
}

function listar_dependencia($iddependencia, $iddep_base) {
	global $conn, $serie_base, $dependencia_base, $puntero_array;
	$buscar_dependencia = busca_filtro_tabla("cod_padre", 'dependencia', "cod_padre IS NOT NULL and iddependencia=" . $iddependencia, "", $conn);
	$dependencia_base[] = 'd' . $iddependencia;
	if ($buscar_dependencia["numcampos"]) {
		listar_dependencia($buscar_dependencia[0]['cod_padre'], $iddep_base);
	}
}
?>