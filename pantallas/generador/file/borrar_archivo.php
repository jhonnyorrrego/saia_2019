<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/generador/file/librerias.php");

function eliminar_anexo_temp(){
	global $ruta_db_superior,$conn;
	$pantalla=$_REQUEST["nombre_pantalla"];
	$nombre_campo=$_REQUEST["campo"];
	$anexo=$_REQUEST["anexo"];
	//$ruta=ruta_archivos_pantalla();
	$idsesion=session_id();
	
	$campos_pantalla=busca_filtro_tabla("a.idpantalla, b.idpantalla_campos","pantalla a, pantalla_campos b","a.nombre='".$pantalla."' and a.idpantalla=b.pantalla_idpantalla and b.nombre='".$nombre_campo."'","",$conn);
	
	$buscar_temp=busca_filtro_tabla("","anexos_temp_pantalla a","a.pantalla_idpantalla=".$campos_pantalla[0]["idpantalla"]." and fk_idpantalla_campos=".$campos_pantalla[0]["idpantalla_campos"]." and etiqueta='".$anexo."'","",$conn);
	
	if($buscar_temp["numcampos"]){
		$sql1="delete from anexos_temp_pantalla where idanexos_temp_pantalla=".$buscar_temp[0]["idanexos_temp_pantalla"];
		phpmkr_query($sql1);
		unlink($ruta_db_superior.$buscar_temp[0]["ruta"]);
		echo "1";
	}
	else echo "0";
}
function eliminar_anexo(){
	global $ruta_db_superior,$conn;
	$idanexos=$_REQUEST["idanexos"];
	$idregistro=$_REQUEST["idregistro"];
	$pantalla=$_REQUEST["pantalla"];
	$nombre_campo=$_REQUEST["nombre_campo"];
	$buscar=busca_filtro_tabla("","anexos a","idanexos=".$idanexos,"",$conn);
	if($buscar["numcampos"]){
		$sql1="delete from anexos where idanexos=".$buscar[0]["idanexos"];
		phpmkr_query($sql1);
		if(is_file($ruta_db_superior.$buscar[0]["ruta"])){
			unlink($ruta_db_superior.$buscar[0]["ruta"]);
		}
		
		$pantalla_registro=busca_filtro_tabla($nombre_campo,$pantalla,"id".$pantalla."='".$idregistro."'","",$conn);
		$ids_anexos=explode(",",$pantalla_registro[0][$nombre_campo]);
		$cant=count($ids_anexos);
		$nuevo=array();
		for($i=0;$i<$cant;$i++){
			if($idanexos!=$ids_anexos[$i])$nuevo[]=$ids_anexos[$i];
		}
		$sql2="update ".$pantalla." set ".$nombre_campo."='".implode(",",$nuevo)."' where id".$pantalla."=".$idregistro;
		phpmkr_query($sql2);
		
		echo "1";
	}
	else echo "0";
}
if(@$_REQUEST["ejecutar_borrado"])$_REQUEST["ejecutar_borrado"]();
else eliminar_anexo_temp();
?>