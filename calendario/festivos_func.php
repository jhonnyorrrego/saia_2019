<?php
include_once("../db.php");
 $accion= $_REQUEST['func'];
 $dia = $_REQUEST['dia'];
 $mes = $_REQUEST['mes'];
 $anio= $_REQUEST['anio'];

switch ($accion) {
case 0:
         $id_asignacion= @$_REQUEST['key'];
         eliminar_festivo($id_asignacion) or alerta("No se pudo Eliminar  el Dia");
         break;
case 1:
        adicionar_festivo($dia,$mes,$anio) or alerta("No se pudo Ingresar el Dia");
        break;
default:

	break;

}
$d=rand(1, 10000); // Truco para obligar a redibujar y evitar cache
abrir_url("festivos_list.php?anio=".$anio."&aleatorio=".$d,"centro");

function adicionar_festivo($dia,$mes,$anio,$formato = NULL)
{ global $conn;
  if(!$formato)
     $formato="Y-m-d";
  $fecha_inicial= date($formato, mktime( 0, 0, 0,$mes, $dia ,$anio));
  $fecha_final=  date($formato, mktime( 0, 0, 0,$mes, $dia + 1 ,$anio));
  $datos= busca_filtro_tabla("idasignacion","asignacion","asignacion.documento_iddocumento='-1'  AND ".fecha_db_obtener("fecha_inicial",'Y-m-d')."='$fecha_inicial' ","",$conn);

 if($datos["numcampos"])
  {
    alerta("Existe otro Festivo o Dia no Laboral Asignado este dia");
    return(FALSE);
   }
 else
  {   // Busco la tarea de dias festivos para asignara
      // Al momento no hay interface se debe crear manualmente en la tabla tarea
   $datos= busca_filtro_tabla("idtarea","tarea","tarea.nombre='FESTIVO' ","",$conn);

   if($datos["numcampos"])
    {
      $idtarea=$datos[0]["idtarea"];

      $sql= "INSERT INTO asignacion ( tarea_idtarea , fecha_inicial , fecha_final , documento_iddocumento ) VALUES ('$idtarea',".fecha_db_almacenar($fecha_inicial,$formato).",".fecha_db_almacenar($fecha_final,$formato).",'-1')";
    
      phpmkr_query($sql);
    }
   //$sql= "INSERT INTO ASIGNACION "
  }

return(TRUE);
}

function eliminar_festivo($id_asignacion)
{ global $conn;
  if(!$id_asignacion)
  {
    alerta("Existe otro Festivo o Dia no Laboral Asignado este dia");
    return(FALSE);
   }
 else
  {
      $sql= "DELETE FROM asignacion WHERE asignacion.idasignacion='$id_asignacion'";

      phpmkr_query($sql,$conn) or  die("Falló insercion del dia " . phpmkr_error() . ' SQL:' . $sql);
    }
   //$sql= "INSERT INTO ASIGNACION "
return(TRUE);
}


?>
