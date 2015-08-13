<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/num2letras.php");


function solicitud($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","ft_solicitud_soporte","documento_iddocumento=".$iddoc,"",$conn);
$permisos=busca_filtro_tabla("B.nombre","ft_solicitud_soporte A,serie B","B.cod_padre=".$consulta[0]["serie_idserie"]." and A.documento_iddocumento=".$iddoc,"",$conn);
//print_r($permisos);

echo $permisos[0]["nombre"]."";



}
function fecha_solsoporte($idformato,$iddoc){
  global $conn;
  $fechaf=busca_filtro_tabla(fecha_db_obtener("fecha_soporte","d")." as dia,"
  .fecha_db_obtener("fecha_soporte","m")."as mes,".fecha_db_obtener("fecha_soporte","Y")."as ano, documento_iddocumento as doc","ft_solicitud_soporte","documento_iddocumento=".$iddoc,"",$conn);
  echo $fechaf[0]["dia"]." ".mes_letras($fechaf[0]["mes"]);
	echo " ".$fechaf[0]["ano"];
}
function mes_letras($mes){
 switch($mes){
  case 1:
   $valor= "enero";
   break;
  case 2:
   $valor= "febrero";
   break;
  case 3:
   $valor= "marzo";
   break;
  case 4:
   $valor= "abril";
   break;
  case 5:
   $valor= "mayo";
   break;
  case 6:
   $valor= "junio";
   break;
  case 7:
   $valor= "julio";
   break;
  case 8:
   $valor= "agosto";
   break;
  case 9:
   $valor= "septiembre";
   break;
  case 10:
   $valor= "octubre";
   break;
  case 11:
   $valor= "noviembre";
   break;
  case 12:
   $valor= "diciembre";
   break;          
 }
return $valor;
}
function mostrar_categoria($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_solicitud_soporte","documento_iddocumento=".$iddoc,"",$conn);
$permisos=busca_filtro_tabla("A.nombre","serie A,ft_solicitud_soporte B","A.cod_padre=884 AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($permisos);
$condiciones=explode(",",$consulta[0]["tipo_solitud"]);

///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro 
$v1="&nbsp";
$v2="&nbsp";

for($i=0;$i<count($condiciones);$i++){

if($condiciones[$i]==885){
$v1="X";
}

if($condiciones[$i]==886){
$v2="X";
}



}
///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro

$texto='<table style="width: 100%;" border="0">
<tbody>
<tr>
<td style=font-size:13px >'.$permisos[0]['nombre'].'</td>
<td id="" style="text-align: center; border: 1px solid #000000; width: 3%;" lang="" dir="" scope="" align="" valign="">'.$v1.'</td>
</tr>
<tr>
<td style=font-size:13px>'.$permisos[1]['nombre'].'</td>
<td id="" style="text-align: center; border: 1px solid #000000; width: 3%;" lang="" dir="" scope="" align="" valign="">'.$v2.'</td>
</tr>

</tr>


</tbody>
</table>';
echo $texto;


}
 
function mostrar_prioridad($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_solicitud_soporte","documento_iddocumento=".$iddoc,"",$conn);
//print_r($permisos);
$condiciones=explode(",",$consulta[0]["prioridad"]);

///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro 
$v1="&nbsp";
$v2="&nbsp";
$v3="&nbsp";


for($i=0;$i<count($condiciones);$i++){

if($condiciones[$i]==1){
$v1="X";
}

if($condiciones[$i]==2){
$v2="X";
}
if($condiciones[$i]==3){
$v3="X";
}


}
///1,Cita medica;2,Permiso educativo;3,Permiso para ir al banco;4,Permiso compensatorio;5,Enfermedad general;6,Cita Odontologica;7,Acto funebre;8,Permiso matrimonial;9,Retiro de cesantias;10,Urgencia medica;11,Reclamar examen medico;12,Tramite compra de casa;13,Otro

$texto='<table style="width: 100%;" border="0">
<tbody>
<tr>
<td style=font-size:12px; >Alta</td><td id="" style="text-align: center; border: 1px solid #000000; width: 3%;" lang="" dir="" scope="" align="" valign="">'.$v1.'</td>
</tr>
<tr>
<td style=font-size:12px>Media</td>
<td id="" style="text-align: center; border: 1px solid #000000; width: 3%;" lang="" dir="" scope="" align="" valign="">'.$v2.'</td>
</tr>
<tr>
<td style=font-size:12px>baja</td>
<td id="" style="text-align: center; border: 1px solid #000000;" lang="" dir="" scope="" align="" valign="">'.$v3.'</td>
</tr>
</tbody>
</table>';
echo $texto;

}

function hijo_soporte($idformato,$iddoc){
	global $conn;
	$d=busca_filtro_tabla(fecha_db_obtener("A.fecha","y")." as ano,".fecha_db_obtener("A.fecha","m")." as mes,"
	.fecha_db_obtener("A.fecha","d")." as dia,".fecha_db_obtener("A.fecha","H")." as hora,"
	.fecha_db_obtener("A.fecha","i")." as min, B.estado_proceso,B.descripcion","documento A,ft_reporte_avance B,ft_solicitud_soporte C","C.idft_solicitud_soporte=B.ft_solicitud_soporte and C.documento_iddocumento=A.iddocumento and A.estado not in ('ELIMINADO','ANULADO') and A.iddocumento=".$iddoc,"",$conn);
      //print_r($d);  
    //$descripcion_hijo=busca_filtro_tabla("","","","");
	$tabla = '';
	$tabla .= '<table style="width:100%;font-family:arial" border="0px">';
	
	if($d["numcampos"] > 0){
		$tabla .= '<tr><td colspan="6" style="text-align: center; border-color: #000000; border-style: solid; border-width: 1px;"><b>Reporte avances</b></td></tr>';
		$avance=0;
		
		 $texto="";
		  
		for($i=0;$i<$d["numcampos"];$i++){
			//echo ("Estado".$anexos[0]['estado_avance']."a<br/>");
			 $tabla.= '
		    <td align=left>'.html_entity_decode($d[$i]["descripcion"]).'</td>
			<td align=left>Avance '.($i+1).': '.$d[$i]["estado_proceso"].'%</td>
			<td align center>'.$d[$i]["dia"].'-'.$d[$i]["mes"].'-'.$d[$i]["ano"].'</td></tr>';	
			
			$avance=$avance+$d[$i]["estado_proceso"];
		}
		
		//<tr><td>'.mostrar_valor_campo("descripcion",165,$d[$i]["documento_iddocumento"],1).'</td>--->averiguar 
	}
	$tabla .= '</table>';
	
	$tabla.="<br><b>AVANCE ACUMULATIVO</b>: ".$avance."%";
	echo ($tabla);
	}
?> 