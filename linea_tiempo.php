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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."funciones.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");

//---------Saco la fecha actual ----------------
$fecha_actual = date("Y-m-d");
//---------Saco la fecha futura un dia mas para ponerla en el encabezado --------------
$ayer = calculo_tiempo($fecha_actual,-1);
$hoy = calculo_tiempo($fecha_actual,1);
$semana1 = calculo_tiempo($fecha_actual,2);
$semana2 = calculo_tiempo($fecha_actual,7);
$mes1 = calculo_tiempo($fecha_actual,8);
$mes2 = calculo_tiempo($fecha_actual,30);
$mayor = calculo_tiempo($fecha_actual,31);;


$cantidad_pendientes="";
$cantidad_pendientes1="";
$cantidad_pendientes2="";
$cantidad_pendientes3="";
$cantidad_pendientes4="";

$cant_pendientes="";
$cant_pendientes1="";
$cant_pendientes2="";
$cant_pendientes3="";
$cant_pendientes4="";

//---------Saco el funcionario codigo para que en la siguiente consulta sacar sus pendientes -----------------
$funcionario = usuario_actual("funcionario_codigo");
//---------Consulta para sacar los pendientes del funcionario----------------------
$fluj = busca_filtro_tabla("distinct a.idpaso_documento AS id, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial","paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f, asignacion g","a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso AND  a.documento_iddocumento=g.documento_iddocumento AND g.llave_entidad=".$funcionario." AND estado_diagram_instance in(4)","GROUP BY d.iddiagram_instance,a.idpaso_documento,e.title, b.descripcion, a.fecha_asignacion ORDER BY fecha_inicial DESC",$conn);


$datos = null;
for($i=0;$i<$fluj["numcampos"];$i++){
  $flujo=estado_flujo_instancia($fluj[$i]["id"]);
	$fecha_final_diagram=$flujo["fecha_final_paso"];
	$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_final_diagram,'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias","DUAL","","",$conn);
  $valor[0] = $dia[0]["dias"];
  
  if($valor[0] < 0 ){
  	$cant_pendientes=$cant_pendientes+1;
    $datos = true;
  } 
  else if($valor[0] == 0 || $valor[0] == 1){
   $cant_pendientes1=$cant_pendientes1+1;
    $datos = true;
  } 
  else if($valor[0] >= 2 && $valor[0] < 8){
    $cant_pendientes2=$cant_pendientes2+1;
    $datos = true;
  }
  else if($valor[0] >= 8){
    $cant_pendientes3=$cant_pendientes3+1;
    $datos = true;
  }
  /*else if($valor[0] >= 8 && $valor[0] < 31){
    $cant_pendientes3=$cant_pendientes3+1;
    $datos = true;
  }*/  
  /*else if($valor[0] >= 31){
    $cant_pendientes4=$cant_pendientes4+1;
    $datos = true;
  }*/
}
if($datos == null){
  $cantidad_pendientes="0 Pendientes";
	$cantidad_pendientes1="0 Pendientes";
	$cantidad_pendientes2="0 Pendientes";
	$cantidad_pendientes3="0 Pendientes";
	$cantidad_pendientes4="0 Pendientes";
}else{
  $cantidad_pendientes=intval($cant_pendientes)." Pendientes";		
  $cantidad_pendientes1=intval($cant_pendientes1)." Pendientes";
  $cantidad_pendientes2=intval($cant_pendientes2)." Pendientes";
  $cantidad_pendientes3=intval($cant_pendientes3)." Pendientes";
  //$cantidad_pendientes4=intval($cant_pendientes4)." Pendientes";
}

?>
<script type="text/javascript" src="js/jquery/1.4.2/jquery.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script type="text/javascript">
$(document).ready(function(){     
  $('.div_borde').corner("7px");   
  $("#aparecer").height(($(document).height())-150);
});
function carga_archivo(id){

} 
</script>
<?php
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
$configuracion=busca_filtro_tabla("","configuracion","nombre='color_atrasado'","",$conn);
$configuracion1=busca_filtro_tabla("","configuracion","nombre='color_pendiente'","",$conn);
$configuracion2=busca_filtro_tabla("","configuracion","nombre='color_terminado'","",$conn);
$texto='';

$texto .= '<table style="border-collapse:collapse;border:0px solid;width:80%" align="right">';
$texto .= '<tr>
<td style="text-align:left" width="15%">'.$cantidad_pendientes.'</td>
<td style="text-align:left" width="15%">'.$cantidad_pendientes1.'</td>
<td style="text-align:left" width="15%">'.$cantidad_pendientes2.'</td>
<td style="text-align:left" width="15%">'.$cantidad_pendientes3.'</td>
<!--td style="text-align:left" width="15%">'.$cantidad_pendientes4.'</td-->
<td width="2%"></td>
</tr>
<tr>
<td style="text-align:left">
  <div class="div_borde" style="background-color:'.$configuracion[0]["valor"].';height:9px">&nbsp;</div>
</td>
<td style="text-align:left">
  <div class="div_borde" style="background-color:'.$configuracion1[0]["valor"].';height:9px">&nbsp;</div>
</td>
<td style="text-align:left">
  <div class="div_borde" style="background-color:'.$configuracion2[0]["valor"].';height:9px">&nbsp;</div>
</td>
<td style="text-align:left">
  <div class="div_borde" style="background-color:'.$configuracion2[0]["valor"].';height:9px">&nbsp;</div>
</td>
<!--td style="text-align:left">
  <div class="div_borde" style="background-color:'.$configuracion2[0]["valor"].';height:9px">&nbsp;</div>
</td-->

</tr>';
$texto .= '<tr><td  style="text-align:right"
 title="Pendientes los cuales se vencieron su tiempo de respuesta" >
 Vencidos<br>'.$ayer.'</td>
 <td style="text-align:right"
 title="Los siguientes son los pendientes h&aacute;biles de hoy y ma&ntilde;ana" >
 Hoy y Ma&ntilde;ana<br>'.$fecha_actual.' hasta '.$hoy.'</td>
 <td style="text-align:right" title="Los siguientes son los pendientes h&aacute;biles de 2 dias hasta 7 dias despues" >
Transcurso de la semana<br>'.$semana1.' hasta '.$semana2.'</strong></td>

<td style="text-align:right" title="Los siguientes son los pendientes h&aacute;biles de 8 dias hasta 30 dias despues" >
Transcurso del mes<br>Mayor a '.$mes1.'</td>

<!--td style="text-align:right" title="Los siguientes son los pendientes h&aacute;biles de 8 dias hasta 30 dias despues" >
Transcurso del mes<br>'.$mes1.' hasta '.$mes2.'</td-->
<!--td style="text-align:right" title="Los siguientes son los pendientes h&aacute;biles mas de 31 dias">
Mayor a '.$mayor.'</td-->
</tr>

<tr>
<td style="text-align:right"><a href="pendientesflujolist.php?tipo=1" target="aparecer">VER</a></td>
<td style="text-align:right"><a href="pendientesflujolist.php?tipo=2" target="aparecer">VER</a></td>
<td style="text-align:right"><a href="pendientesflujolist.php?tipo=3" target="aparecer">VER</a></td>
<td style="text-align:right"><a href="pendientesflujolist.php?tipo=4" target="aparecer">VER</a></td>
<!--td style="text-align:right"><a href="pendientesflujolist.php?tipo=5" target="aparecer">VER</a></td-->
</tr>
';
$texto.='</table><br/><br><br><br>
<a href="pendientesflujolist.php" target="aparecer">
Todos mis pendientes</a><br>
<a href="verificar_flujoslist.php?administrar_flujo=1" target="aparecer">Mostrar Todos </a><br>
<a href="verificar_flujoslist.php?administrar_mis_flujo=1" target="aparecer">Mostrar Todos Mis Flujos</a>
<br/>
<iframe id="aparecer" name="aparecer" width="100%"  frameborder="0" src="pendientesflujolist.php"></iframe>';
 echo $texto;

//style="text-align:right; vertical-align:top; text-decoration: underline;" 

function calculo_tiempo($fecha,$dias){
	global $conn;
	if(MOTOR == 'MySql'){
		$retorno = busca_filtro_tabla(suma_fechas(fecha_db_almacenar($fecha,'Y-m-d'),$dias,'DAY')."as fecha_futura");
		return $retorno[0]["fecha_futura"];
	}
	else if(MOTOR == 'Oracle'){
		$fecha = busca_filtro_tabla("SYSDATE + ".$dias,"DUAL","","",$conn);
		$fecha_ = explode("/",$fecha[0][0]);
//$hoy = "20".$hoy[2]."-".$hoy[1]."-".$hoy[0];
		return ($fecha_[0]."-".$fecha_[1]."- 20".$fecha_[2]);
	}
} 
?>