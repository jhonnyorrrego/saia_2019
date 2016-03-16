<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
$retorno=new stdClass();
$retorno->exito=0;
$retorno->mensaje='Error al terminar la actividad';
if(@$_REQUEST["idactividad"] && @$_REQUEST["iddocumento"] && @$_REQUEST["idpaso_documento"]){
  $verificar=verificar_instancia_terminada($_REQUEST["idactividad"],$_REQUEST["iddocumento"],$_SESSION["usuario_actual"],2);
  if($verificar["numcampos"]){
    $retorno->exito=1;
    $retorno->idterminacion=$verificar[0]["idpaso_instancia"];
    $retorno->mensaje='La actividad ya se encuentra terminada';
  }else{
  	
    $terminacion=terminar_actividad_paso($_REQUEST["iddocumento"],'',2,$_REQUEST["idpaso_documento"],$_REQUEST["idactividad"]);
	
    if($terminacion){  
    	
      $idterminacion_manual=terminar_actividad_manual($_REQUEST["idpaso_documento"],$terminacion,$_REQUEST["observaciones"]);
      if($idterminacion_manual){
        $retorno->exito=1;
        $retorno->idterminacion=$terminacion;
        $retorno->mensaje='Actividad terminada de forma exitosa';
      }
      else{
        $retorno->mensaje='Error al terminar la actividad de forma manual';
      }    
    } 
  }
}  
echo(json_encode($retorno));
?>