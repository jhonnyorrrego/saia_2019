<?php
$max_salida=6; 
$ruta_db_superior=$ruta=""; 
while($max_salida>0){ 
    if(is_file($ruta."db.php")){ 
        $ruta_db_superior=$ruta;
    } 
    $ruta.="../"; 
    $max_salida--; 
}
include_once($ruta_db_superior.'pantallas/documento/class_documento_adicionales.php');
//Ejemplo de uso de la clase
$d2j=new documento();
ini_set("display_errors",true);
if($_REQUEST["id"]){
	switch($_REQUEST["accion"]){
		case "indexar":
			$d2j->asignar_iddocumento($_REQUEST["id"]);
			$exportado=$d2j->exportar_informacion();
			if($exportado){
				print_r($d2j->indexar_elasticsearch($_REQUEST["id"]));	
			}
			else{
				die("Error al tomar los datos del registro");
			}
		break;
		case "buscar":
			if(@$_REQUEST["tabla"] && @$_REQUEST["campo"] && @$_REQUEST["criterio"]){
				$busqueda=array($_REQUEST["tabla"].".".$_REQUEST["campo"]=>$_REQUEST["criterio"]);
				$retorno=$d2j->buscar_elasticsearch($busqueda);
				print_r($retorno);
			}			
			else{
				die("No es posible realizar la busqueda con los criterios indicados ");
			}
		break;
		case "buscar_all":
			if(!is_object($d2j->cliente_elasticsearch)){
				$d2j->cliente_elasticsearch=new elasticsearch_saia();
			}
			$param='';
			$retorno=$d2j->buscar_elasticsearch_all($param);
			print_r($retorno);
		break;
		case "verificar_indice":
			if(@$_REQUEST["indice"] && @$_REQUEST["id"] && @$_REQUEST["tipo_dato"]){
				if(!is_object($d2j->cliente_elasticsearch)){
					$d2j->cliente_elasticsearch=new elasticsearch_saia();
				}
				$retorno=$d2j->cliente_elasticsearch->verificar_indice($_REQUEST["indice"],$_REQUEST["id"],$_REQUEST["tipo_dato"]);
				print_r($retorno);
			}
			else{
				die("No es posible verificar los datos con los registros enviados");
			}
		break;
		case "borrar_all":
			$retorno=$d2j->borrar_elasticsearch_all();
			print_r($retorno);
		break;
				
	}
}
else{
	die("Por favor ingrese el id");
	
}
?>