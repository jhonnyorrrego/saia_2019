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

$lista_series_funcionario = '';
$lista_dependencias_total = array();
$idfuncionario = usuario_actual("idfuncionario");
$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
$lista_dependencias_total = array_merge((array)$lista_dependencias_total, (array)$datos_admin_funcionario["dependencias"]);
busca_dependencias_papas($datos_admin_funcionario["dependencias"]);
$lista_series_funcionario = implode(",", $datos_admin_funcionario["series"]);
global $lista_series_funcionario;

function busca_dependencias_papas($dependencias) {
	global $lista_dependencias_total;
	if (count($dependencias)) {
		$dependencia_principal = busca_filtro_tabla("cod_padre", "dependencia", "iddependencia IN(" . implode(",", $dependencias) . ") AND cod_padre IS NOT NULL AND cod_padre<>0", "", "", $conn);
		if ($dependencia_principal["numcampos"]) {
			$dependencias_temp = extrae_campo($dependencia_principal, "cod_padre", "U");
			$lista_dependencias_total = array_merge((array)$lista_dependencias_total, (array)$dependencias_temp);
			busca_dependencias_papas($dependencias_temp);
		}
	}
	return;
}
$info = array();
$dependencias = busca_filtro_tabla("iddependencia","vdependencia_serie","lower(dependencia) LIKE ('%".strtolower(@$_REQUEST['nombre'])."%') AND iddependencia IN(".implode(",",$lista_dependencias_total).") GROUP BY iddependencia","",$conn);
$info['num_dependencias']=$dependencias['numcampos'];

for ($i=0; $i < $dependencias['numcampos']; $i++) {
	
	$info[$i]['dependencia']=elemento_papa($dependencias[$i]['iddependencia'],'dependencia',0);
	
}
function elemento_papa($idelemento,$tabla,$pos){
	$lista_elementos=array();
	$dato_elemento=busca_filtro_tabla("id".$tabla." AS id, cod_padre",$tabla,"id".$tabla."=".$idelemento,"",$conn);
	$lista_elementos[$pos]=$dato_elemento[0]['id'];
	if ($dato_elemento[0]['cod_padre']!='') {
		$padre=elemento_papa($dato_elemento[0]['cod_padre'],$tabla,$pos+1);
		$lista_elementos=array_merge($lista_elementos,$padre);
	}
	return $lista_elementos;
}

$series=busca_filtro_tabla("iddependencia, idserie","vdependencia_serie","lower(nombre) LIKE ('%".strtolower(@$_REQUEST['nombre'])."%') AND iddependencia IN (".implode(",", $lista_dependencias_total).") AND idserie IN (".$lista_series_funcionario.")","",$conn);
$info['num_series']=$series['numcampos'];

$series_papas=elemento_papa($series[0]['idserie'],'serie',0);

for ($j=0; $j < $series['numcampos']; $j++) { 
	$info[$j]['serie']=elemento_papa($series[$j]['idserie'],'serie',0);
	$info[$j]['iddependencia_serie']=$series[$j]['iddependencia'];
}
echo(json_encode($info));/*
print_r($info);die();

$manual = busca_filtro_tabla("a.plantilla,a.ft_proceso", "categorias_calidad a", "lower(a.nombre) like '%" . strtolower($_REQUEST['nombre'] . "%'"), "", $conn);

$info["numcampos"] = $manual["numcampos"];

if ($manual["numcampos"]) {

	$macros = busca_filtro_tabla("a.macroproceso", "ft_proceso a, documento b", "a.documento_iddocumento=b.iddocumento and b.estado not in ('ELIMINADO','ANULADO') and a.idft_proceso=" . $manual[$i]["ft_proceso"], "", $conn);
	if ($macros[0]["macroproceso"] != "") {
		$info["cant_macro"] = ($info["cant_macro"] + 1);
		$info[$i]["macro"] = $macros[0]["macroproceso"];
	}

	for ($i = 0; $i < $manual["numcampos"]; $i++) {

		$plantilla = busca_filtro_tabla("idformato", "formato", "lower(nombre)='" . strtolower($manual[$i]["plantilla"]) . "'", "", $conn);

		$info[$i]["primero"] = "9-idft_proceso-" . $manual[$i]["ft_proceso"];

		$info[$i]["segundo"] = $plantilla[0]['idformato'] . "-ft_proceso-r" . $manual[$i]["ft_proceso"];

	}
	echo(json_encode($info));
} else {
	echo(json_encode($info));
}*/
?>