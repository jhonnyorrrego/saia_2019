<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."asignaciones/funciones.php");
if(@$_REQUEST["idasignacion"]){
  ejecutar_tareas($_REQUEST["idasignacion"]);
}
else if(isset($argv)){
  ejecutar_tareas();
}
function ejecutar_tareas($idasignacion=""){
global $conn;
$ejecutado=false;
if($idasignacion!=""){
  $lcontroles=busca_filtro_tabla("","control_asignacion","asignacion_idasignacion=".$idasignacion,"",$conn);
}
else
  $lcontroles=busca_filtro_tabla("","control_asignacion","(fecha_actualizacion < ".fecha_actual().") AND ejecutar_hasta > ".fecha_actual() ,"",$conn);
  if($lcontroles["numcampos"]){
    $accion='c:\xampp\php\php -f enviar_correo.php -- asignacion='.$idasignacion;
    for($j=0;$j<$lcontroles["numcampos"];$j++){
      if(@$lcontroles[$j]["accion"] && $lcontroles[$j]["accion"]!=""){
        $accion='c:\xampp\php\php -f '.$lcontroles[$j]["accion"].' -- asignacion='.$lcontroles[$j]["asignacion_idasignacion"];
      }
      $salida=exec($accion,$salida);
      if($salida!==false){
      actualizar_tareas($lcontroles[$j]["idcontrol_asignacion"]);
      }
      die($accion."<br />".$salida);
    }
  }
  else{
    alerta("Error de Envio",'error',4000);
    enviar_mensaje_administrador();
  }
return($salida);
}
function actualizar_tareas($idcontrol_asignacion){
global $conn;
$lcontroles=busca_filtro_tabla("","control_asignacion A, asignacion B","A.asignacion_idasignacion=B.idasignacion AND idcontrol_asignacion=".$idcontrol_asignacion,"",$conn);
if($lcontroles["numcampos"]){
  /*if(!$lcontroles[0]["fecha_actualizacion"]){
    $fecha=$lcontroles[0]["fecha_inicial"];
  }
  else {
    $fecha=$lcontroles[0]["fecha_actualizacion"];
  }*/
  //TODO Se debe verificar que la periocidad no sea menor que la anticipacion
  $fecha=date("Y-m-d H:i:s");
  //echo($fecha."<br />".$lcontroles[0]["tipo_periocidad"]."<br />".$lcontroles[0]["periocidad"]);
  $fecha_actualizada=actualiza_fechas_tareas($fecha,$lcontroles[0]["periocidad"],$lcontroles[0]["tipo_periocidad"]);

$sql="Update control_asignacion SET fecha_actualizacion='".fecha_db_almacenar($fecha_actualizada)."' WHERE idcontrol_asignacion=".$idcontrol_asignacion;
phpmkr_query($sql,$conn);
return(true);
}
return(false);
}
?>
