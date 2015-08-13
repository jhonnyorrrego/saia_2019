<?php
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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");


function mostrar_campo_otro($idformato,$iddoc){
	global $conn;
	
	echo (librerias_jquery(1.7));
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#otro").closest("tr").hide();
			
			$("#solicitud").change(function(){ 
				$("#solicitud option:selected").each(function () {
					var seleccionado = "";
					seleccionado = $(this).text();
					//alert(seleccionado);
					if(seleccionado=="Otro"){						
						$("#otro").closest("tr").show();
					}else{						
						$("#otro").attr("value","");
						$("#otro").closest("tr").hide();
					}					
				});
			});
		})
	</script>
<?php
}

function mostrar_formato_funcion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$tipo_forma = busca_filtro_tabla("*,".fecha_db_obtener("fecha_pqr","Y")." as ano, "
	.fecha_db_obtener("fecha_pqr","m")." as mes,".fecha_db_obtener("fecha_pqr","Y")." as ano,"
	.fecha_db_obtener("fecha_pqr","d")." as dia,".fecha_db_obtener("fecha_pqr","H")." as hora,"
	.fecha_db_obtener("fecha_pqr","i")." as min,nombres_apellidos AS nombre,identificacion,email,direccion,telefono","ft_pqr","documento_iddocumento=".$iddoc,"",$conn);
			
	/*$d = busca_filtro_tabla("","ejecutor A,datos_ejecutor B","B.ejecutor_idejecutor=A.idejecutor and A.idejecutor=".$tipo_forma[0]['remitente'],"",$conn);	
	$ciudad = busca_filtro_tabla("","municipio","idmunicipio=".$d[0]["ciudad"],"",$conn);*/	
	
	
	
	
	$tipo1="uncheck";
	$tipo2="uncheck";
	$tipo3="uncheck";
	$tipo4="uncheck";
	$tipo5="uncheck";
	$tipo6="uncheck";
	$tipo7="uncheck";
	$tipox1="uncheck";
	$tipox2="uncheck";
	$tipox3="uncheck";
	$tipox4="uncheck";
	$tipox5="uncheck";
	$tipox6="uncheck";
	$tipox7="uncheck";
	// sacando tipo del formato pqr
	if($tipo_forma[0]["tipo"] == 0 && $tipo_forma[0]["tipo"] != ''){
		$tipo1 = "check";
	}
	else if($tipo_forma[0]["tipo"] == 1){
		$tipo2 = "check";
	}
	else if($tipo_forma[0]["tipo"] == 2){
		$tipo3 = "check";
	}
	else if($tipo_forma[0]["tipo"] == 3){
		$tipo4 = "check";
	}
	else if($tipo_forma[0]["tipo"] == 4){
		$tipo5 = "check";
	}else if($tipo_forma[0]["tipo"] == 5){
		$tipo6 = "check";
	}else if($tipo_forma[0]["tipo"] == 6){
		$tipo7= "check";
	}
	
	
	//-------------------------------------------------------------------------------
	//sacando tipo de mensajeria     
	

	if($tipo_forma[0]["forma_envio"] == 0 && $tipo_forma[0]["forma_envio"] != ''){
		$tipox1 = "check";
	}
	else if($tipo_forma[0]["forma_envio"] == 1){
		$tipox2 = "check";
	}
	else if($tipo_forma[0]["forma_envio"] == 2){
		$tipox3 = "check";
	}
	else if($tipo_forma[0]["forma_envio"] == 3){
		$tipox4 = "check";
	}
	else if($tipo_forma[0]["forma_envio"] == 4){
		$tipox5 = "check";
	}
  	else if($tipo_forma[0]["forma_envio"] == 5){
		$tipox6 = "check";
	}
	
	//------------------------------------------------------------------------------------------
	
	
	if($consulta[0]["solicitud"]==0){
	  $solicitud="Instalaciones";
		
	}elseif($consulta[0]["solicitud"]==1){
	  $solicitud="Atencion";	
		
	}elseif($consulta[0]["solicitud"]==2){
	  $solicitud="Personal";
		
	}elseif($consulta[0]["solicitud"]==3){
	  $solicitud="Area Adminstrativa";
		
	}elseif($consulta[0]["solicitud"]==4){
	  $solicitud=$consulta[0]["otro"];
	}
	
	
	//-----------------------------------------------------------------------------------------
	
	 //0,PREGUNTAS;1,QUEJAS;2,RECLAMOS;3,SOLICITUD;4,RECONOCIMIENTO;5,SUGERENCIAS;6,INCONVENIENTES PSE
	 
	 //	0,TELEFÓNICO;1,PERSONAL;2,ESCRITO;3,FAX;4,E-MAIL
	 
	
    $primera=explode("<p>",$consulta[0]["descripcion"]);
    $segunda=explode("</p>",$primera[1]);  	
	$tabla = '';
	$tabla .= '
	<table style="width:100%;font-family:Verdana; font-size:8pt;" border="0px">
   <tr>
   <td  colspan="1" style="text-align:left"><b>PQR No '.formato_numero($idformato,$iddoc,1).'</b></td>
   
    <td colspan="4" style="text-align:right"><b>FECHA:</b> <u>'.$tipo_forma[0]["dia"].'-'.$tipo_forma[0]["mes"].'-'.$tipo_forma[0]["ano"].'</u></td> 
  	<td colspan="4" style="text-align:right"><b>HORA:</b> <u>'.$tipo_forma[0]["hora"].':'.$tipo_forma[0]["min"].'</u></td>
  	</tr> 
  <tr>
     <td style="text-align:left"><b>SOLICITUD: </b>'.$solicitud.'</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
	<tr>
	<td colspan="2" style="text-align:center"><b>TIPO</b></td> 
	<td colspan="1" style="text-align:center">&nbsp;</td>
	<td colspan="3" style="text-align:center"><b>FORMA DE ENV&Iacute;O</b></td>
	
	</tr>
	
	<tr>
	<td>PREGUNTAS</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo1.'.png"></td>
	<td colspan="2" style="text-align:center"></td>
	<td>TELEF&Oacute;NICO</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox1.'.png"></td>

	</tr>
	
	<tr>
	<td>QUEJAS</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo2.'.png"></td>
	<td colspan="2" style="text-align:center">&nbsp;</td>
	<td>PERSONAL</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox2.'.png"></td><td>&nbsp;</td>
	</tr>
	
	<tr>
	<td>RECLAMOS</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo3.'.png"></td>
	<td colspan="2" style="text-align:center">&nbsp;</td>
	<td>ESCRITO</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox3.'.png"></td><td>&nbsp;</td>
	</tr>
	
	<tr>
	<td>SOLICITUD</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo4.'.png"></td>
	<td colspan="2" style="text-align:center">&nbsp;</td>
	<td>FAX</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox4.'.png"></td><td>&nbsp;</td>
	</tr>
	
	<tr>
	<td>RECONOCIMIENTO</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo5.'.png"></td>
	<td colspan="2" style="text-align:center">&nbsp;</td>
	<td>E-MAIL</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox5.'.png"></td><td>&nbsp;</td>
	</tr>
	
	<tr>
	<td>SUGERENCIAS</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo6.'.png"></td>
  <td colspan="2" style="text-align:center">&nbsp;</td>
	<td>WEB</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipox6.'.png"></td><td>&nbsp;</td>
	</tr>
	
	<tr>
	<td>INCONVENIENTES PSE</td><td><img border="0" src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/botones/documentacion/'.$tipo7.'.png"></td>
	</tr>
	
	<tr>
	<td style="" ><br><b>NOMBRE:</b></td><td colspan="4"><br><u>'.ucfirst(strtolower($tipo_forma[0]["nombre"])).'</u></td>
	</tr>
	<tr>
	<td style="" >
	<b>IDENTIFICACI&Oacute;N:</b></td><td colspan="4"> <u>'.ucfirst(strtolower($tipo_forma[0]["identificacion"])).'</u></td>
	</tr>
	<tr>
	<td style="" >
	<b>DIRECCI&Oacute;N:</b></td><td colspan="4"> <u>'.ucfirst(strtolower($tipo_forma[0]["direccion"])).'</u></td>
	</tr>
	
	<tr>
	<td style="" >
	<b>TEL&Eacute;FONO:</b></td><td colspan="4"> <u>'.ucfirst(strtolower($tipo_forma[0]["telefono"])).'</u></td>
	</tr>
	
	<tr>
	<td style="" >
	<b>EMAIL:</b></td><td colspan="4"> <u> '.ucfirst(strtolower($tipo_forma[0]["email"])).'</u></td>
	</tr>
	
	<tr>

	<td>&nbsp;</td>

	</tr>
	
	</table>
	<table style="width:100%;font-family:arial">
	<tr><td colspan="4" style="text-align: center; border-color: #000000; border-style: solid; border-width: 1px;">
	<b>DESCRIPCI&Oacute;N DE LA PQR´s</b></td>
	</tr>
	
	<tr>
	<td colspan="2">'.mostrar_valor_campo("descripcion",$idformato,$iddoc,1).'</td>
	<td colspan="2" style="text-align:right">'.$tipo_forma[0]["dia"].'-'.$tipo_forma[0]["mes"].'-'.$tipo_forma[0]["ano"].'</td>
	</tr>
	</table>';
	$tabla .= datos_hijo1($idformato,$iddoc);
	$tabla .= datos_hijo2($idformato,$iddoc);
	
	
//	$tabla .= '</div>';
	echo $tabla;
	
	
}
function datos_hijo1($idformato,$iddoc){
	global $conn;
	$d = busca_filtro_tabla(fecha_db_obtener("fecha_visita","Y")." as ano,".fecha_db_obtener("fecha_visita","m")." as mes,"
	.fecha_db_obtener("fecha_visita","d")." as dia,".fecha_db_obtener("fecha_visita","H")." as hora,"
	.fecha_db_obtener("fecha_visita","i")." as min,b.documento_iddocumento","ft_pqr a,ft_visita_pqr b","ft_pqr=idft_pqr and a.documento_iddocumento=".$iddoc,"",$conn);
	$tabla = '';
	$tabla .= '<table style="width:100%;font-family:arial" border="0px">';
	if($d["numcampos"] > 0){
		$tabla .= '
			<tr>
			<td colspan="2" style="background:black;color:white;text-align:center"><b>VISITA DEL PQR´s</b></td>
			</tr>';
		for($i=0;$i<$d["numcampos"];$i++){
			$tabla .= '
			<tr>
			<td colspan="2"><table style="border-collapse:collapse;" border="1px" align="right">
							<tr>
							<td>D&iacute;a '.$d[$i]["dia"].'</td>
							<td>Mes '.$d[$i]["mes"].'</td>
							<td>A&ntilde;o '.$d[$i]["ano"].'</td>
							<td>Hora '.$d[$i]["hora"].':'.$d[$i]["min"].'</td>
							</tr>
							</table>
			</td>
			</tr>
			<tr>
			<td colspan="2" >'.mostrar_valor_campo("descripcion",164,$d[$i]["documento_iddocumento"],1).'</td>
			</tr>';
		}
	}
	$tabla .= '</table>';
	return ($tabla);
}
function datos_hijo2($idformato,$iddoc){
	global $conn;
	$d = busca_filtro_tabla(fecha_db_obtener("fecha_solucion","Y")." as ano,".fecha_db_obtener("fecha_solucion","m")." as mes,"
	.fecha_db_obtener("fecha_solucion","d")." as dia,".fecha_db_obtener("fecha_solucion","H")." as hora,"
	.fecha_db_obtener("fecha_solucion","i")." as min,b.documento_iddocumento,b.estado_avance","ft_pqr a,ft_solucion_pqr b","ft_pqr=idft_pqr and a.documento_iddocumento=".$iddoc,"",$conn);
	$tabla = '';
	$tabla .= '<table style="width:100%;font-family:arial" border="0px">';
	
	if($d["numcampos"] > 0){
		$tabla .= '<tr><td colspan="6" style="text-align: center; border-color: #000000; border-style: solid; border-width: 1px;"><b>SOLUCI&Oacute;N DE LA PQR´s</b></td></tr>';
		$avance=0;
		$responsable=busca_filtro_tabla('B.nombres','documento A,funcionario B,vfuncionario_dc C,ft_pqr
		 D','D.documento_iddocumento=A.iddocumento AND A.ejecutor=B.funcionario_codigo AND C.funcionario_codigo=B.funcionario_codigo');
		
		 //-->anexos
		 $texto="";
		  $soluciones_pqr=busca_filtro_tabla("B.*","ft_pqr A,ft_solucion_pqr B"," A.idft_pqr=B.ft_pqr  AND A.documento_iddocumento=".$iddoc,"",$conn);
		     $anexo=array();   
		 
		$tabla.='<tr><td align=center>Avance</td><td align=center>Fecha</td><td align=center>Responsable</td><td align=center>Anexo</td></tr>';
		  
		for($i=0;$i<$d["numcampos"];$i++){
			$anexos=busca_filtro_tabla("","anexos A ","A.documento_iddocumento=".$d[$i]["documento_iddocumento"],"",$conn);
			 	    $etiqueta=$anexos[0]['etiqueta'];
	array_push($anexo,'<a href="'.$ruta_db_superior.'../../almacenamiento/saia_nucleo/ACTIVO/2014-02/29/anexos/parsea_accion_archivo.php?idanexo='.$anexos[$i]["idanexos"].'&accion=descargar">'.html_entity_decode($etiqueta).'</a>');
			//echo ("Estado".$anexos[0]['estado_avance']."a<br/>");
			 $texto.=implode("<br/> ",$anexo);
			$tabla.= '
			<td align=center>Avance '.($i+1).': '.$d[$i]["estado_avance"].'%</td>
			
			<td align center>'.$d[$i]["dia"].'-'.$d[$i]["mes"].'-'.$d[$i]["ano"].'</td><td align=center>'.$responsable[$i]["nombres"].'</td><td>'.$texto.'</td></tr>";
			';	
			$avance=$avance+$d[$i]["estado_avance"];
		}
		
		//<tr><td>'.mostrar_valor_campo("descripcion",165,$d[$i]["documento_iddocumento"],1).'</td>--->averiguar 
	}
	$tabla .= '</table>';
	
	$tabla.="<br><b>AVANCE ACUMULATIVO</b>: ".$avance."%";
	return ($tabla);
}
function hora_funcion($idformato,$iddoc){
	global $conn;
	$d = busca_filtro_tabla(fecha_db_obtener('fecha_pqr','H')." as hora,".
	fecha_db_obtener('fecha_pqr','i')." as min","ft_pqr","documento_iddocumento=".$iddoc,"");
	echo $d[0]["hora"].':'.$d[0]["min"];
}
function fecha_funcion($idformato,$iddoc){
	global $conn;
	$d = busca_filtro_tabla(fecha_db_obtener('fecha_pqr','Y')." as ano,".fecha_db_obtener('fecha_pqr','m')." as mes,".
	fecha_db_obtener('fecha_pqr','d')." as dia","ft_pqr","documento_iddocumento=".$iddoc,"");
	echo $d[0]["dia"].'-'.$d[0]["mes"].'-'.$d[0]["ano"];
	
}
function enviar_responsables($idformato,$iddoc){
/*	global $conn;
	include_once("../librerias/funciones_generales.php");
	transferencia_automatica($idformato,$iddoc,'responsable',2);
*/	
}
function validar_digitalizacion($idformato,$iddoc)
{global $conn;
  if($_REQUEST["digitalizacion"]==1){
     redirecciona("paginaadd.php?radicacion=".$iddoc."&key=".$iddoc);
  }
}
function nombres_funcion($idformato,$iddoc){
/*	global $conn,$d;
	$d = busca_filtro_tabla("b.*,c.*","ft_pqr,ejecutor b,datos_ejecutor c","datos_persona=iddatos_ejecutor and ejecutor_idejecutor=idejecutor and documento_iddocumento=".$iddoc,"",$conn);
	echo ucfirst(strtolower($d[0]["nombre"])); */
}
function direccion_funcion($idformato,$iddoc){
	/*global $conn,$d;
	echo ucfirst(strtolower($d[0]["direccion"]));   */
}
function telefono_funcion($idformato,$iddoc){
	/*global $conn,$d;
	echo ucfirst(strtolower($d[0]["telefono"]));*/
}
function municipio_funcion($idformato,$iddoc){
	/*global $conn,$d;
	$mun = busca_filtro_tabla("","municipio","idmunicipio=".$d[0]["ciudad"],"",$conn);
  echo ucfirst(strtolower($mun[0]["nombre"]));  */
}
function codigo_nui_funcion($idformato,$iddoc){
	/*global $conn,$d;
	echo ucfirst(strtolower($d[0]["codigo"])); */
}
function peticion_funcion($idformato,$iddoc){
	/*global $conn,$d;
	echo '<u>'.ucfirst(strtolower(mostrar_valor_campo('tipo',$idformato,$iddoc,1))).'</u>'; */
}
function descripcion_funcion($idformato,$iddoc){
	/*global $conn,$d;
	echo mostrar_valor_campo('descripcion',$idformato,$iddoc,1);  */
}
function impirmir_recibo($idformato,$iddoc){
	global $conn;
	/*$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
	if($_REQUEST["tipo"] != 5)
		echo "<a href='".$ruta_db_superior."html2ps/public_html/demo/html2ps.php?plantilla=pqr&iddoc=".$iddoc."&vista=13' target='_blank'>Imprimir recibo</a>";   */
}

function cambiar_flujo($idformato,$iddoc){
global $conn;

?>
<script type="text/javascript">
$().ready(function(){
$("#tipo6").click(function(){ 
 if ($('#tipo6').attr('checked')) {
    tipo=$('[name=idflujo]').val('12');
    
  } 
});

$("#tipo0").click(function(){ 
 if ($('#tipo0').attr('checked')) {
   tipo=$('[name=idflujo]').val('9');
  } 
});
$("#tipo1").click(function(){ 
 if ($('#tipo1').attr('checked')) {
   $('[name=idflujo]').val('9');
  } 
});
$("#tipo2").click(function(){ 
 if ($('#tipo2').attr('checked')) {
   $('[name=idflujo]').val('9');
  } 
});
$("#tipo3").click(function(){ 
 if ($('#tipo3').attr('checked')) {
    $('[name=idflujo]').val('9');
  } 
});
$("#tipo4").click(function(){ 
 if ($('#tipo4').attr('checked')) {
    $('[name=idflujo]').val('9');
  } 
});
$("#tipo5").click(function(){ 
 if ($('#tipo5').attr('checked')) {
    $('[name=idflujo]').val('9');
  } 
}); 
});  

</script>

<?php
}


function insertar_otro_solicitud($idformato,$iddoc)
{global $conn;
?>  
<script>
$().ready(function() {
/*	
if($('#').attr('checked')){
  $("#tr_interno").show();
  $("#tr_externo").hide();
  $("#tr_externo").val("");
}else{
	$("#otro").hide();
	$("#otro").val();
}	
	
*/
 $("#solicitud").change(function() { 
	if($("#solicitud").val()==4){
	 $("#otro").show();
	
	}
	else {
		$("#otro").val('');
		$("#otro").hide();
	
	}
 });
});
</script>
<?php

}


function otra_pregunta($idformato,$iddoc)
{global $conn;
?>  
<script>
$().ready(function() {
//$("#otra_clase_muestra").hide();
var valor = $('#solicitud option:selected').val();
if(valor==4){
$("#otro").show();	
}else{
$("#otro").hide();	
	
}
 $("#solicitud").change(function() { 
	if($("#solicitud").val()==4){
	 $("#otro").show();
	  $("#otro").attr("class","required");  
	}
	else {
		$("#otro").val('');
		$("#otro").hide();
		$("#otro").attr("class","");
		
	}
 });
 });

</script>
<?php
}
function transferir_solicitud_pqr($idformato,$iddoc){
	global $conn;	
	global $ruta_db_superior;
	include_once($ruta_db_superior."class_transferncia.php");
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");	
	transferencia_automatica($idformato,$iddoc,'4@',3);
}

?>