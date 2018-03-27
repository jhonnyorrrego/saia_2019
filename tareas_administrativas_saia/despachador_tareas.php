<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0){
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
@set_time_limit(0);
$tarea=array();
$tarea[0]["ruta_ejecucion"]='tareas_administrativas_saia/desactivar_reemplazos.php';
$tarea[1]["ruta_ejecucion"]='tareas_administrativas_saia/activar_funcionario_inactivos.php';
$tarea[2]["ruta_ejecucion"]='pantallas/funcionario/inactivar_roles_funcionario.php';
//$tarea[1]["ruta_ejecucion"]='terminar_solicitudes.php';
$tarea["numcampos"]=3;
if($tarea["numcampos"]){
  //$mh = curl_multi_init();
  $ch = curl_init();
	$abrir=fopen("log_despachador_tarea.txt","a+");
	
  for($i=0;$i<$tarea["numcampos"];$i++){
    if($tarea[$i]["ruta_ejecucion"]){
     $fila=PROTOCOLO_CONEXION.RUTA_PDF."/".$tarea[$i]["ruta_ejecucion"];
		 fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." se ejecutaron las siguientes tareas ".$fila." \n");
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {		
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	}		
     curl_setopt($ch, CURLOPT_URL,$fila); 
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		 
		 curl_setopt($ch, CURLOPT_VERBOSE, true);  //1.Necesaria 
   	 curl_setopt($ch, CURLOPT_STDERR, $abrir); //2.Guarda informacion de conexion en $abrir
		   
     $contenido=curl_exec($ch);
	 		
		 fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." Termina el proceso ".$fila." =>  ".$contenido." \n \n");
     //sleep(480);
    }
  } 
}
curl_close ($ch);
fclose($abrir);
?>
