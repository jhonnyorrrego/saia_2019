<?php
/*
<Clase>
<Nombre>week_schedule_getItems
<Parametros>
<Responsabilidades>Buscar los registros en la tabla de reservas para la semana que llega como parámetro
                  y retornar el xml para mostrarlo en pantalla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
include_once("db.php");
global $conn;
echo '<?xml version="1.0" ?'.'>';

$startOfWeek = date("Y-m-d H:i:s",mktime(0,0,0,$_GET['month'],$_GET['day'],$_GET['year']));
$endOfWeek = Date("Y-m-d", mktime(0, 0, 0, $_GET['month'], $_GET['day'] + 7, $_GET['year']));


//$res = busca_filtro_tabla("B.documento_iddocumento, to_char(A.fecha_inicial, 'YYYY-MM-DD HH24:Mi:SS') AS fecha_inicial, to_char(A.fecha_final, 'YYYY-MM-DD HH24:Mi:SS') AS fecha_final, B.investigador_idinvestigador, B.estado","reserva A, solicitud B","A.fecha_inicial >= to_date('".$startOfWeek."','YYYY-MM-DD HH24:MI:SS') and A.fecha_final < to_date('".$endOfWeek."','YYYY-MM-DD') AND B.documento_iddocumento=".$_GET['documento']." AND A.solicitud_idsolicitud=B.idsolicitud AND B.estado <> 'DEVUELTO' AND B.estado <> 'DESCARTADO'", "", $conn);
$res = busca_filtro_tabla("B.documento_iddocumento, to_char(A.fecha_inicial, 'YYYY-MM-DD HH24:Mi:SS') AS fecha_inicial, to_char(A.fecha_final, 'YYYY-MM-DD HH24:Mi:SS') AS fecha_final, B.investigador_idinvestigador, B.estado","reserva A, solicitud B","((A.fecha_inicial >= to_date('".$startOfWeek."','YYYY-MM-DD HH24:MI:SS') AND A.fecha_inicial <= to_date('".$endOfWeek."','YYYY-MM-DD')) 
OR (A.fecha_final < to_date('".$endOfWeek."','YYYY-MM-DD') AND A.fecha_final >= to_date('".$startOfWeek."','YYYY-MM-DD HH24:MI:SS')) OR
(A.fecha_inicial <= to_date('".$startOfWeek."','YYYY-MM-DD HH24:MI:SS') AND A.FECHA_FINAL >= to_date('".$endOfWeek."','YYYY-MM-DD'))) 
AND B.documento_iddocumento=".$_GET['documento']." AND A.solicitud_idsolicitud=B.idsolicitud AND B.estado <> 'DEVUELTO' AND B.estado <> 'DESCARTADO'", "", $conn);
for($i=0; $i<$res["numcampos"]; $i++)
{
  $inf=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A", "A.funcionario_codigo=".$res[$i]["investigador_idinvestigador"], "", $conn);
  $fecha1 = $res[$i]["fecha_inicial"];
  $fecha2 = substr($res[$i]["fecha_inicial"],0,10)." 22:00:00";
  $uno = 0;
  $compara = comparaFecha($fecha1,$res[$i]["fecha_final"]); 
  $estado = "";
  switch($res[$i]["estado"])
  {
    case "INICIADO": 
      $estado = "SOLICITADO POR: "; 
      break; 
    case "PENDIENTE": 
      $estado = "RESERVADO POR: ";
      break; 
    case "APROBADO": 
      $estado = "PRESTADO POR: "; 
      break;
  }
  while($compara != 2)
  {
    if(comparaFecha($fecha1,$startOfWeek)<>1 AND comparaFecha($fecha2,$endOfWeek)==1)
    {
      if($compara==0)
      {
        ?>
	       <item>
		      <id><?php echo $i.$uno; ?></id>
		      <description><?php  echo $estado.strtoupper($inf[0]["nombres"]." ".$inf[0]["apellidos"]) ?></description>
		      <eventStartDate><?php echo gmdate('D, d M Y H:i',strtotime($fecha1)) . ' GMT'; ?></eventStartDate>
		      <eventEndDate><?php echo gmdate('D, d M Y H:i',strtotime($res[$i]["fecha_final"])) . ' GMT'; ?></eventEndDate>
		      <bgColorCode></bgColorCode>
	       </item>
	    <?php }
      else
      {
        ?>
	       <item>
		      <id><?php echo $i.$uno; ?></id>
		      <description><?php echo $estado.strtoupper($inf[0]["nombres"]." ".$inf[0]["apellidos"]) ?></description>
		      <eventStartDate><?php echo gmdate('D, d M Y H:i',strtotime($fecha1)) . ' GMT'; ?></eventStartDate>
		      <eventEndDate><?php echo gmdate('D, d M Y H:i',strtotime($fecha2)) . ' GMT'; ?></eventEndDate>
		      <bgColorCode></bgColorCode>
	       </item>
	      <?php }
	  }
	  $fecha1 = date("Y-m-d",strtotime($fecha1." + 1 day"));
	  $fecha1 = substr($fecha1,0,10)." 08:00";
	  $compara = comparaFecha($fecha1,$res[$i]["fecha_final"]);
	  $fecha2 = substr($fecha1,0,10)." 22:00";
	  $uno++;
	}
}


/*
<Clase>
<Nombre>comparafecha
<Parametros>$fecha1, $fecha2: fechas a comparar
<Responsabilidades>comparar las dos fechas para determinar cual es mayor o si son iguales
<Notas>retorna 0 si fecha1=fecha2
       retorna 1 si fecha1<fecha2
       retorna 2 si fecha1>fecha2
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function comparaFecha($fecha1, $fecha2)
{
  $an1=substr($fecha1,0,4);
  $an2=substr($fecha2,0,4);
  if($an1>$an2)
    return 2;
  if($an1<$an2)
    return 1;
  $mes1=substr($fecha1,5,2);
  $mes2=substr($fecha2,5,2);
  if($mes1>$mes2)
    return 2;
  if($mes1<$mes2)
    return 1;
  $dia1=substr($fecha1,8,2);
  $dia2=substr($fecha2,8,2);
  if($dia1>$dia2)
    return 2;
  if($dia1<$dia2)
    return 1;
  return 0;
}
?>



