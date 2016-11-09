<?php
include_once("db.php");
$tabla=@$_REQUEST["tabla"];
$campo_codpadre=@$_REQUEST["campo_codpadre"];
$campo_id=@$_REQUEST["campo_id"];
$dato_padre=@$_REQUEST["dato_padre"];
$campo_actualizar=@$_REQUEST["campo_actualizar"];

if(!$tabla)$tabla='serie';
if(!$campo_codpadre)$campo_codpadre='cod_padre';
if(!$campo_id)$campo_id='idserie';
if(!$dato_padre)$dato_padre="null";
if(!$campo_actualizar)$campo_actualizar='orden';

generar_codigo_arbol($tabla,$campo_codpadre,$campo_id,$dato_padre,$campo_actualizar);
/*
<Clase>
<Nombre>generar_codigo_arbol</Nombre>
<Parametros>
$tabla=nombre de la tabla
$campo_codpadre=Nombre del campo en la base de datos donde guarda el codigo del padre
$campo_id=Nombre del campo en la base de datos donde guarda el identificador de la tabla
$dato_padre=Valor del id guardado en el campo donde guarda el codigo del padre
$campo_actualizar=Nombre del campo donde se guardaran los indices
$indice=Utilizado para prevenir un ciclo infinito sobre la funcion
</Parametros>
<Responsabilidades>Se encarga de actualizar el campo mencionado en la variable $campo_actualizar de acuerdo a una nomenclatura establecida</Responsabilidades>
<Notas>La estructura de a guardar en el campo tiene las siguientes caracteristicas:
1. El registro a actualizar debe estar conformado por el codigo del papa mas .id registro
2. Los registros que no sean hijos de nadie no llevan "."
</Notas>
</Clase>
 */
function generar_codigo_arbol($tabla,$campo_codpadre,$campo_id,$dato_padre,$campo_actualizar,$indice=1){
	global $conn;
	if($indice>1000)return false;
	
	if($dato_padre>=0&&$dato_padre!="null"){
		$datos=busca_filtro_tabla("",$tabla." a",$campo_codpadre."=".$dato_padre,"",$conn);
	}
	else if($dato_padre=="null"){
		$datos=busca_filtro_tabla("",$tabla." a","orden is ".$dato_padre." AND tipo<>0","",$conn);
		//print_r($datos);die();
	}
	else{
		$datos=busca_filtro_tabla("",$tabla." a","","",$conn);
	} 
	
	if($datos["numcampos"]){
		for($i=0;$i<$datos["numcampos"];$i++){ 
			if($datos[$i]['tipo']==1){
				$sql1="update ".$tabla." set ".$campo_actualizar."='".($datos[$i][$campo_id]*100000)."' where ".$campo_id."=".$datos[$i][$campo_id];
			}
			elseif($datos[$i]['tipo']==2){
				$padre=busca_filtro_tabla("",$tabla." a",$campo_id."=".$datos[$i][$campo_codpadre],"",$conn);
				
				$sql1="update ".$tabla." set ".$campo_actualizar."='".($padre[0][$campo_actualizar]+($datos[$i][$campo_id]*1000))."' where ".$campo_id."=".$datos[$i][$campo_id];
			}elseif($datos[$i]['tipo']==3){
			    $padre=busca_filtro_tabla("",$tabla." a",$campo_id."=".$datos[$i][$campo_codpadre],"",$conn);
				
				$sql1="update ".$tabla." set ".$campo_actualizar."='".($padre[0][$campo_actualizar]+($datos[$i][$campo_id]*100))."' where ".$campo_id."=".$datos[$i][$campo_id];
			}
			phpmkr_query($sql1);
			$hijos=busca_filtro_tabla("",$tabla,$campo_codpadre."='".$datos[$i][$campo_id]."'","",$conn);
			if($hijos["numcampos"]){
				$indice++;
				generar_codigo_arbol($tabla,$campo_codpadre,$campo_id,$datos[$i][$campo_id],$campo_actualizar,$indice);
			}
		}
	}
}/*
?>