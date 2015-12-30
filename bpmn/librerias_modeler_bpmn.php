<?php 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');
$max_salida=6; $ruta_db_superior=$ruta=""; 
while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
header('Access-Control-Allow-Origin: '.RUTA_BPMN);
@$nombre=$_REQUEST["file_name"];
if($_REQUEST["almacenar_bpmn"] && @$_REQUEST["nombre"]){
	include_once($ruta_db_superior."bpmn/bpmn/class_bpmn.php");
	include_once($ruta_db_superior."librerias_saia.php");
	include_once($ruta_db_superior."pantallas/generador/file/librerias.php");
	echo(librerias_jquery());
	$pantalla_campos=busca_filtro_tabla("A.pantalla_idpantalla, A.idpantalla_campos,B.nombre AS nombre_pantalla","pantalla_campos A, pantalla B","A.pantalla_idpantalla=B.idpantalla AND A.nombre LIKE 'archivo_bpmn'","",$conn);
	$sql="INSERT INTO anexos_temp_pantalla(idsesion,ruta,etiqueta,tipo,pantalla_idpantalla, fk_idpantalla_campos) values('".$_REQUEST["sesion_key"]."','"."../temporal_bpmn/".$nombre.".bpmn','".$_REQUEST["nombre"].".bpmn','bpmn', ".$pantalla_campos[0]["pantalla_idpantalla"].", ".$pantalla_campos[0]["idpantalla_campos"].")";
	phpmkr_query($sql);
	$datos=array();
	$bpmn=new bpmn();
	$datos["nombre"]=$_REQUEST["nombre"];
	$datos["pantalla"]=$pantalla_campos[0]["nombre_pantalla"];
	$_REQUEST["pantalla"]=$pantalla_campos[0]["nombre_pantalla"];
	$retorno_tmp=$bpmn->set_bpmn(0,"json",json_encode($datos));
	$idbpmn=$bpmn->get_valor_bpmn("bpmn","idbpmn");
	$retorno=sincronizar_anexos_temporales($bpmn->get_valor_bpmn("bpmn","idbpmn"),$pantalla_campos[0]["nombre_pantalla"]);
	if($retorno->exito || 1){
		?>
		<script>
			//Recarga la informacion del kaiten actual con los datos enviados en datos
			datos={ kConnector:'iframe', url:"<?php echo($ruta_db_superior);?>bpmn/procesar_bpmn.php?vista_bpmn=1&idbpmn=<?php echo($idbpmn);?>", kTitle:"Administrar <?php echo($_REQUEST["nombre"]);?>"} 
			parent.$(".k-focus").closest("#contenedor_busqueda").kaiten("reload",parent.$(".k-focus"),datos);
			// Remueve la pestana kaiten del frame actual 
			//parent.$(".k-focus").find(".remove").click();
		</script>
		<?php
	}
	else {
		alerta("Error al cargar los anexos o crear el flujo por favor verifique");
		?>
		<script>
			// Remueve la pestana kaiten del frame actual 
			parent.$(".k-focus").find(".remove").click();
		</script>
		<?php
	}
}
else{
	if( @$_REQUEST["datos"]){
		$ruta_destino=$ruta_db_superior."../temporal_bpmn/";
		crear_destino($ruta_destino);
		if(file_put_contents($ruta_destino.$_REQUEST["nombre"], $_REQUEST["datos"])){
			echo("Archivo ".$_REQUEST["nombre"]." almacenado con exito");
		}
		else{
			echo("Error al guardar el archivo ".$_REQUEST["nombre"]);
		}
	}	
	else {
		echo("Error el nombre del archivo no encontrado o con errores: ".$_REQUEST["nombre"]);	
	}
}
?>