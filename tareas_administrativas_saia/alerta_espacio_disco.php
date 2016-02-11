<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
$_SESSION["LOGIN".LLAVE_SAIA]='cerok';
include_once($ruta_db_superior."db.php");
$cliente=busca_filtro_tabla("valor","configuracion","nombre='nombre'","",$conn);
$resultado=array();
$particiones=array();
$mensaje="";
$alerta=0;
exec("df -h",$resultado);
unset($resultado[0]);
for ($i=1; $i < count($resultado); $i++) {
	$parti=explode("%", $resultado[$i]);
  	$particiones[]=trim($parti[1]);
}
for ($i=0; $i < count($particiones); $i++) { 
	$dev = $particiones[$i];
	$freespace = disk_free_space($dev);
	$totalspace = disk_total_space($dev);
	$freespace_mb = $freespace/1024/1024;
	$totalspace_mb = $totalspace/1024/1024;
	$freespace_percent = ($freespace/$totalspace)*100;
	$used_percent = (1-($freespace/$totalspace))*100;
	if($used_percent >= $_REQUEST['porcentaje']){ // cuando sea mayor de 85% de uso
	    
	    $mensaje .= "<b>Espacio en Disco de la partici&oacute;n ('$dev')</b><br>";
	    $mensaje .= sprintf("<b>Espacio Total:</b> %8d MB<br>", $totalspace_mb);
	    $mensaje .= sprintf("<b>Espacio Libre:</b> %8d MB<br>", $freespace_mb);
	    $mensaje .= sprintf("<b>Porcentaje de Uso:</b>  %.2f%%<br>", $used_percent);
	    $mensaje .= sprintf("<b>Porcentaje Libre:</b>   %.2f%%<br><br>", $freespace_percent);
		if($alerta==0) $alerta=1;
	    /*$headers = "MIME-Version: 1.0\r\n";
	    $headers .= "Content-type: text/html; charset=utf-8\r\n";
	    $headers .= "From: info@miservidor.com \r\n";
		$to = "alejandro.carvajal@cerok.com";
	    $subject = "Espacio Libre en Disco en el Servidor ('$dev')";
	    mail($to, $subject, $text, $headers);
		*/
	}
}
if($alerta==1){
	$envio_correo=enviar_mensaje("",'email',array("soporte@cerok.com"),"ALERTA ESPACIO EN DISCO CLIENTE ".$cliente[0]['valor'],$mensaje,"",0);
}
@session_unset();
@session_destroy();
?> 