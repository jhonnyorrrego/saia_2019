
<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
 if(is_file($ruta."db.php")){
   $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
 }
 $ruta.="../";
 $max_salida--;
}    
include_once($ruta_db_superior."db.php");
if($_REQUEST['tabla']){
	$tabla=$_REQUEST['tabla'];
	$campos_dep = array();
	$campos = array();
	$campos_serie=array();
	$resultados_serie=array();
	$resultados_entidad_serie=array();
	$resultados_dependencia=array();
	/*$busca_dependencias=busca_filtro_tabla("iddependencia,nombre,cod_padre","dependencia","lower(nombre) like(lower('%".$_REQUEST['nombre']."%'))","",$conn);
	if($busca_dependencias["numcampos"]){
		for ($i=0; $i < $busca_dependencias['numcampos']; $i++) {
			lista_papas($busca_dependencias[$i]['iddependencia'],"dependencia");
			$resultados_dependencia[]=array_reverse(array_unique($campos_dep));
		}
	}*/
	$buscar_series=busca_filtro_tabla("idserie ,nombre,cod_padre","serie","lower(nombre) like(lower('%".$_REQUEST['nombre']."%'))","",$conn);
	if($buscar_series["numcampos"]){
		for ($i=0; $i < $buscar_series['numcampos']; $i++){
			$campos = array();
			lista_papas($buscar_series[$i]['idserie'],"serie");
			$resultados_serie[]=array_reverse(($campos));
		}
	}
	foreach($resultados_serie AS $key=>$value){
		$dependencia_serie=busca_filtro_tabla("","entidad_serie","entidad_identidad=2 AND serie_idserie IN('".implode(",",$value)."')","",$conn);
		for($i=0;$i<$dependencia_serie["numcampos"];$i++){
			$campos_dep = array();
			$campos_serie = array();
			lista_papas($dependencia_serie[$i]["llave_entidad"],"dependencia");
			$resultados_dependencia=array_merge((array)$resultados_dependencia,(array)array_reverse(($campos_dep)));
			lista_papas($dependencia_serie[$i]["serie_idserie"],"serie",$dependencia_serie[$i]["llave_entidad"]);
			
			$resultados_entidad_serie=array_merge((array)$resultados_entidad_serie,(array)(($campos_serie)));
		}
	}
	 
	$resultado=array();
	$resultado=implode(",",array_unique(array_merge((array)$resultados_dependencia,(array)$resultados_entidad_serie)));
	//$resultado["entidad_serie"]=$resultados_entidad_serie;
	//$resultado["series"]=$resultados_serie;
	echo(json_encode($resultado));
}
function lista_papas($id,$tabla,$dependencia=0){
	global $conn,$campos,$campos_dep,$campos_serie;
	if($id){
		if($tabla=="dependencia"){
			array_push($campos_dep,$id.".0.0");
		}
		else if($tabla=="serie"){
			if($dependencia){
				array_push($campos_serie,$dependencia.".".$id.".0");
			}
			else{
				array_push($campos,$id);
			}
		}
		$buscar_campo=busca_filtro_tabla("cod_padre",$tabla,"id".$tabla."=".$id,"",$conn);
		if($buscar_campo["numcampos"]){
			lista_papas($buscar_campo[0]["cod_padre"], $tabla,$dependencia);
		}
	}
	return;
} 
?>