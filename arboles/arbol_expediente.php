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
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

$objetoJson = array(
    "key" => 0
);

$exp_doc = array();
$id = @$_REQUEST["inicia"];
$excluidos = array();

if (@$_REQUEST["excluidos"]) {
	$excluidos = explode(",", $_REQUEST["excluidos"]);
}

$estado_cierre = '';
if (@$_REQUEST['estado_cierre']) {
	$estado_cierre = " AND (a.estado_cierre IN(" . $_REQUEST['estado_cierre'] . "))";
}
$estado_archivo = '';
if (@$_REQUEST['estado_archivo']) {
	$estado_archivo = " AND (a.estado_archivo IN(" . $_REQUEST['estado_archivo'] . "))";
}
if (isset($_REQUEST["incluir_series"])) {
    $estado_archivo .= " and serie_idserie  in (" . $_REQUEST["incluir_series"] . ")";
}

if (@$_REQUEST["seleccionado"]) {
	$_REQUEST["seleccionado"] = explode(",", $_REQUEST["seleccionado"]);
}

if (@$_REQUEST["doc"]) {
	$varios = 1;
	$varios_docs = explode(",", $_REQUEST["doc"]);
	$documento = busca_filtro_tabla("expediente_idexpediente", "expediente_doc", "documento_iddocumento in(" . $_REQUEST["doc"] . ")", "", $conn);
	$exp_doc = array();
	if (count($varios_docs) == 1) {
		$exp_doc = extrae_campo($documento, "expediente_idexpediente", "U");
		$varios = 0;
	}
}
if (@$_REQUEST["checkbox"]) {
	$checkbox = $_REQUEST["checkbox"];
}


$funcionarios = array();
$idfunc = usuario_actual("idfuncionario");

$lista2 = expedientes_asignados();
/*if (@$_REQUEST["id"] && @$_REQUEST["uid"]) {
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
	echo("<tree id=\"" . $_REQUEST["id"] . "\">\n");
	llena_expediente($_REQUEST["id"]);
	echo("</tree>\n");
	die();
}

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
echo("<tree id=\"0\">\n");
echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Expedientes\" nocheckbox=\"1\" id=\"exp\">");
llena_expediente($id);
echo("</item>\n");
echo("</tree>\n");
*/
if (isset($_REQUEST["id"])) {
	
	$objetoJson["key"] = $_REQUEST["id"];
	$id =  $_REQUEST["id"];	
    if ($id[0] == 0) {
    	$hijos_exp = llena_expediente($id);
		
        if (!empty($hijos_exp)) {
            $hijos[] = $hijos_exp;
        }
    }	
	$objetoJson["children"] = $hijos;
}
else{
    $objetoJson["key"] = 0;
   	$hijos_exp = llena_expediente($id);
    if (!empty($hijos_exp)) {
        $hijos = $hijos_exp;
    }
    $objetoJson["children"] = $hijos;
}

header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_expediente($id) {
	global $conn, $sql, $exp_doc, $funcionarios, $excluidos, $dependencias, $varios, $lista2, $estado_cierre, $estado_archivo, $checkbox;
	$objetoJson = array();
	if ($id == 0) {
		$papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre, permiso_serie, permiso_exp", "vexpediente_serie a", $lista2 . " and (a.cod_padre=0 OR a.cod_padre IS NULL)" . $estado_cierre . $estado_archivo, "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $conn);
	} else {
		$papas = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre, permiso_serie, permiso_exp", "vexpediente_serie a", $lista2 . " and (a.cod_padre=" . $id . ")" . $estado_cierre . $estado_archivo, "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc", $conn);
	}
	if ($papas["numcampos"]) {
		for ($i = 0; $i < $papas["numcampos"]; $i++) {
			$permitido = 0;
			if (!in_array($papas[$i]["idexpediente"], $excluidos)) {
				$texto_item = "";
				$texto_item = ($papas[$i]["nombre"]);
				if ($papas[$i]["estado_cierre"] == 2) {
					$texto_item .= " <span style=\"color:red\">(CERRADO)</span>";
				}

				$cantidad_tomos = cantidad_tomos($papas[$i]["idexpediente"]);
				$cadena_tomos = '';
				if ($cantidad_tomos['cantidad'] > 1) {
					$cadena_tomos = '&nbsp;&nbsp;<b>(' . $cantidad_tomos['tomo_no'] . ' de ' . $cantidad_tomos['cantidad'] . ')</b>';
				}
				$item = array();
				$item["extraClasses"] = "estilo-dependencia";
				if(preg_match("/a/",$papas[$i]["permiso_serie"])==1 || preg_match("/m/",$papas[$i]["permiso_exp"])==1){					
					$item["checkbox"] = $checkbox;
				}
				else{
					$texto_item.=" - (Sin permiso)";
				}				
	            $item["title"] = htmlspecialchars($texto_item . $cadena_tomos);
				$item["key"] = $papas[$i]["idexpediente"];
				
				if (@$_REQUEST["doc"]) {
					if ($_REQUEST["accion"] == 1 && in_array($papas[$i]["idexpediente"], $exp_doc)) {
						if (!$varios) {
							//echo(" checked=\"1\" ");
							$item["selected"]=true;
						} else {
							//echo(" nocheckbox=\"1\" ");
							$item["folder"] = 1;
						}
					} elseif ($_REQUEST["accion"] == 0 && !in_array($papas[$i]["idexpediente"], $exp_doc)) {
						$item["folder"] = 1;
					}
				} elseif (@$_REQUEST["seleccionado"] && in_array($papas[$i]["idexpediente"], $_REQUEST["seleccionado"]))
					//echo " checked=\"1\" ";
					$item["selected"]=true;
				if ($papas[$i]["estado_cierre"] == 2) {
					//echo(" nocheckbox=\"1\" ");
					$item["folder"] = 1;
				}

				$hijos = busca_filtro_tabla("idexpediente", "vexpediente_serie a", $lista2 . " AND cod_padre=" . $papas[$i]["idexpediente"], "", $conn);
				//print_r($hijos["sql"]);
				if ($hijos['numcampos']) {
					//echo(" child=\"1\" ");					
					
					$item["children"] = llena_expediente($papas[$i]["idexpediente"]);
				}
				if (@$_REQUEST["uid"] || @$_REQUEST["carga_total"]) {
						//$item["checkbox"] = $checkbox;
					//$item["children"] = llena_expediente($papas[$i]["idexpediente"]);
					
				}
				$objetoJson[] = $item;
			}
		}
	}
	return $objetoJson;
}

function cantidad_tomos($idexpediente) {
	global $conn;

	$expediente_actual = busca_filtro_tabla("tomo_padre,tomo_no", "expediente", "idexpediente=" . $idexpediente, "", $conn);
	$ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $expediente_actual[0]['tomo_padre'], "", $conn);
	$cantidad_tomos = array();
	$cantidad_tomos['cantidad'] = $ccantidad_tomos['numcampos'] + 1;
	//tomos + el padre
	$cantidad_tomos['tomo_no'] = $expediente_actual[0]['tomo_no'];
	return ($cantidad_tomos);
}
?>