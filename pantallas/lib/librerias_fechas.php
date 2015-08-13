<?php
function dias_habiles_listado($dias,$formato=NULL,$fecha_inicial=NULL){ 
  global $conn; 
   if(!$formato)
     $formato="d-m-Y"; 
   $formato_bd= "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
   if(!$fecha_inicial)
     $fecha_inicial =date($formato);
 
   $ar_fechaini=date_parse($fecha_inicial);
   $anioinicial=$ar_fechaini["year"];
   $mesinicial=$ar_fechaini["month"];
   $diainicial=$ar_fechaini["day"];
   
   $fecha_final=date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial));
    $asignaciones=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.documento_iddocumento='-1'  AND asignacion.fecha_inicial < ".fecha_db_almacenar($fecha_final,$formato)." AND asignacion.fecha_final > ".fecha_db_almacenar($fecha_inicial,$formato),"",$conn); 

  if($asignaciones["numcampos"]){  
    $no_laborales=$asignaciones["numcampos"]; 
	  $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial)); 
    return(dias_habiles_listado($no_laborales,$formato,$fecha_legal));    
   }
 $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias - 1 ,$anioinicial));   
 return($fecha_legal);
}
function mostrar_fecha_saia($fecha){
$fecha1=date_parse($fecha);
$year=($fecha1["year"]);
$mes=mes_saia($fecha1["month"]);
if(strpbrk(":",$fecha)){
  return($fecha1["day"]."-".$mes."-".$year." ".poner_ceros($fecha1["hour"],'1','1').":".poner_ceros($fecha1["minute"],'1','1').":".poner_ceros($fecha1["second"],'1','1'));  
}
else{
  return($fecha1["day"]."-".$mes."-".$year);
}
}
function mes_saia($mes){
  switch ($mes){
    case 1:return "Ene";
    case 2:return "Feb";
    case 3:return "Mar";
    case 4:return "Abr";
    case 5:return "May";
    case 6:return "Jun";
    case 7:return "Jul";
    case 8:return "Ago";
    case 9:return "Sep";
    case 10:return "Oct";
    case 11:return "Nov";
    case 12:return "Dic";
  }
}

function poner_ceros($str,$numero,$cantidad){
  if(strlen($str) == $numero ){
    return str_repeat('0', $cantidad).$str;
  }
  else{
    return $str;
  }
}
?>