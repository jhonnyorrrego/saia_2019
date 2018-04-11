<?php
include_once("../db.php");
$lasignaciones=busca_filtro_tabla("","asignacion","(estado='PENDIENTE' OR estado='VENCIDO') AND (fecha_actualizacion IS NULL OR fecha_actualizacion <= CURRENT_DATE) AND tarea_idtarea <> 'NULL'","",$conn);
//print_r($lasignaciones);
if($lasignaciones["numcampos"]){
$asignaciones=extrae_campo($lasignaciones,"tarea_idtarea","U");
//print_r($asiganciones);
$lcontroles=busca_filtro_tabla("","control_tarea","estado='PENDIENTE' AND tarea_idtarea IN('".implode("','",$asignaciones)."')","",$conn);
}
else $lcontroles["numcampos"]=0;
//print_r($lcontroles);
if($lcontroles["numcampos"]>0)
{

    for($i=0;$i<$lcontroles["numcampos"];$i++){
    $accion='c:\xampp\php\php '.$lcontroles[$i]["accion"];
    echo("<br />".$accion."<br />");
    if(exec($accion)!==false)
      actualizar_tareas($lcontroles[$i]["idcontrol_tarea"]);
    //else alerta("PROBLEMA EN TAREA ".$accion);
    }

}
else{
    // TODO CONTROL POR DEFECTO  
}

function actualizar_tareas($idcontrol_tarea){
global $conn;
$lcontroles=busca_filtro_tabla("","control_tarea","idcontrol_tarea=".$idcontrol_tarea,"",$conn);
 print_r($lcontroles);

if(!$lcontroles[0]["fecha_actualizacion"]){
  $fecha=$lcontroles[0]["fecha_inicial"];
}
else {
  $fecha=$lcontroles[0]["fecha_actualizacion"];
}
$fecha_inicial=date_parse ($fecha);
//print_r($fecha_inicial);
if($lcontroles[0]["periocidad"]){
  $fecha_inicial[$lcontroles[0]["tipo_periocidad"]]+=$lcontroles[0]["periocidad"];
  $actualiza="";
}
else
  $actualiza=", estado='terminado'";
$fecha_actualiza=date("Y-m-d H:i:s",mktime($fecha_inicial["hour"],$fecha_inicial["minute"],$fecha_inicial["second"],$fecha_inicial["month"],$fecha_inicial["day"],$fecha_inicial["year"]));
$sql="Update control_tarea SET fecha_actualizacion='".$fecha_actualiza."'".$actualiza." WHERE idcontrol_tarea=".$idcontrol_tarea;
phpmkr_query($sql,$conn);
//fecha_actualizacion es la fecha en la que se realiza la ejecucion de la tarea en caso de requerirse la programacion de la tarea.
$sql="UPDATE asignacion SET fecha_actualizacion='".suma_fechas("",$lcontroles[0]["periocidad"],$lcontroles[0]["tipo_periocidad"])."' WHERE tarea_idtarea=".$lcontroles[0]["tarea_idtarea"];
phpmkr_query($sql,$conn);
}
?>
