<?php
include_once("funciones.php");
if(isset($_REQUEST["modo"]))
 $modo=$_REQUEST["modo"];
else 
 $modo="usuario";
 
if(@$_REQUEST["accion"]){
  $accion=$_REQUEST["accion"];
}
else
  $accion="ver";
if(@$_REQUEST["key"]){
  $key=trim($_REQUEST["key"]);
}
else $key=0;
switch($accion){
  case "ejecutar":
    if($key){
      redirecciona("../ejecutar_tareas.php?modo=".$modo."&idasignacion=".$key);
    }
  break;
  case "terminar":
    if($key){
      redirecciona("asignaciondelete.php?key=".$key);
    }
    else
      alerta("Debe Seleccionar una Asignacion");
  break;
  case "completar":
    if($key){
	    // Se realiza la  reprogramacion o eliminacion de la asignacion si esta no es periodica
	    //elimina_asignacion($key,"REPROGRAMA");
	    redirecciona("asignacionterminar.php?modo=".$modo."&key=".$key);
	    //abrir_url("asignaciones.php?modo=".$modo,"centro");
      }
    else
      alerta("Debe Seleccionar una Asignacion");
     break;
    case "editar":
    if($key){
	    // Elimina la asignacion y sus controles asociados
	   abrir_url("asignacionedit.php?modo=".$modo."&idasignacion=".$key,"centro");
	    exit();
      }
    else
      alerta("Debe Seleccionar una Asignacion");
     break;   
     
    case "eliminar":
    if($key){
	    // Elimina la asignacion y sus controles asociados
	   // elimina_asignacion($key,"ELIMINA");
	    abrir_url("asignaciondelete.php?modo=".$modo."&key=".$key,"centro");
	    
      }
    else
      alerta("Debe Seleccionar una Asignacion");
     break;    
  default:
    if($key)
      redirecciona("asignacionview.php?key=".$key);
  break;
}

?>
