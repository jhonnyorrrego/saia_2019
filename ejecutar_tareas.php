<?php
$_SESSION["LOGIN".LLAVE_SAIA]="0k";
include_once('db.php');
include_once("asignaciones/funciones.php");
$archivo=fopen("resultado.res","a+");
fwrite($archivo,"INICIO proceso de Tareas ".date('Y-m-d H:i:s')."\n");
if(@$_REQUEST["idasignacion"]){
  ejecutar_tareas($_REQUEST["idasignacion"]);
 if(isset($_REQUEST["modo"]))
  $modo=$_REQUEST["modo"];
 else
  $modo="usuario";
  abrir_url("asignaciones/asignaciones.php?modo=".$modo,"centro");
}
else if(isset($argv) || @$_REQUEST["modo"] == "admin" || @$_REQUEST["ejecucion"]=='total'){

  ejecutar_tareas();
}
function ejecutar_tareas($idasignacion=""){
global $conn,$archivo;
$salida=false;
$accion='enviar_correo.php -- asignacion='.$idasignacion;
if($idasignacion!=""){

  $lcontroles=busca_filtro_tabla("","control_asignacion","asignacion_idasignacion=".$idasignacion,"",$conn);

}
else{
  $lcontroles=busca_filtro_tabla("","control_asignacion","(fecha_actualizacion < ".fecha_actual()." OR fecha_actualizacion IS NULL) AND ((ejecutar_hasta >".fecha_actual().") OR ejecutar_hasta IS NULL)","",$conn);

}
if($lcontroles["numcampos"] && $archivo){

  for($j=0;$j<$lcontroles["numcampos"];$j++){
    if(@$lcontroles[$j]["accion"] && $lcontroles[$j]["accion"]!=""){
      $url=$lcontroles[$j]["accion"];
      $contenido=ejecutar_accion($url);
      if($contenido!==false){
        $log='Accion realizada existosamente Fecha:'.date("Y-m-d H:i:s")." ".$url."\n";
        fwrite($archivo,$log);
        actualizar_tareas($lcontroles[$j]["idcontrol_asignacion"]);
        $salida=true;
      }
      else {
        fwrite($archivo,"No se ha podido realizar la accion: ".$accion." idcontrol=".$lcontroles[$j]["idcontrol_asignacion"]." -->Fecha:".date("Y-m-d H:i:s").$url."\n");
      }
    }
    else{
      fwrite($archivo,"No se ha podido realizar la accion: ".$accion." idcontrol=".$lcontroles[$j]["idcontrol_asignacion"]." -->Fecha:".date("Y-m-d H:i:s").$url."\n");
    }
  }
}
else if($archivo){
  fwrite($archivo,"No se ha podido realizar la accion -->Fecha:".date("Y-m-d H:i:s")." Fecha de actualizacion no valida o control no encontrado".$url."\n" );
}

return($salida);
}
function actualizar_tareas($idcontrol_asignacion){
global $conn;
$lcontroles=busca_filtro_tabla("","control_asignacion A","idcontrol_asignacion=".$idcontrol_asignacion,"",$conn);
if($lcontroles["numcampos"]){
  $asignacion=busca_filtro_tabla("","asignacion","asignacion_idasignacion=".$lcontroles[0]["asignacion_idasignacion"],"",$conn);
  if($asignacion["numcampos"]){
    $fecha=$lcontroles[0]["fecha_inicial"];
  }
  else
    $fecha=date('Y-m-d H:i:s');
  if($lcontroles[0]["fecha_actualizacion"]){
    $fecha_actual=date("Y-m-d H:i:s");
    $fecha_actualizada=actualiza_fechas_tareas($fecha,$lcontroles[0]["periocidad"],$lcontroles[0]["tipo_periocidad"]);
    if($fecha_actualizada > $fecha){
      while($fecha_actualizada < $fecha_actual){
        $fecha=$fecha_actualizada;
        $fecha_actualizada=actualiza_fechas_tareas($fecha,$lcontroles[0]["periocidad"],$lcontroles[0]["tipo_periocidad"]);
      }
    }
  }
  else {
    $fecha=date("Y-m-d H:i:s");
    //$fecha=$lcontroles[0]["fecha_actualizacion"];
    $fecha_actualizada=actualiza_fechas_tareas($fecha,$lcontroles[0]["periocidad"],$lcontroles[0]["tipo_periocidad"]);
  }
  $sql="Update control_asignacion SET fecha_actualizacion=".fecha_db_almacenar($fecha_actualizada, "Y-m-d H:i:s")." WHERE idcontrol_asignacion=".$idcontrol_asignacion;
  phpmkr_query($sql,$conn);
  return(true);
}
return(false);
}
/*function fecha_actual(){
return(fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s"));
} */
function ejecutar_accion($url){
//$ruta="".PROTOCOLO_CONEXION.RUTA_PDF."/".$url;
$salida=false;
$retorno=0;
//$salida=exec('curl '.$ruta.' && exit',$salida,$retorno);
$ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
}
curl_setopt($ch, CURLOPT_URL,PROTOCOLO_CONEXION.RUTA_PDF."/".$url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$salida=curl_exec($ch);
curl_close ($ch);
return($salida);
}
fwrite($archivo,"FINAL proceso de Tareas ".date('Y-m-d H:i:s')."\n");
?>
