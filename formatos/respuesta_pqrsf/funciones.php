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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 
ini_set('display_errors',true);
/*ADICIONAR*/

function adicionar_asunto(){
global $conn;
	if(@$_REQUEST['iddoc']){
		$asunto=busca_filtro_tabla("asunto","ft_respuesta_pqrsf","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
		echo "<td><input type='text' name='asunto' id='asunto' value='".$asunto[0][0]."' size='100'></td>";
	}else{
		$idformato_papa=busca_filtro_tabla("idformato","formato","nombre='pqrsf'","",$conn);
		$radicado_papa=buscar_papa_formato_campo($idformato_papa[0][0],$_REQUEST['anterior'],'ft_pqrsf','numero');
		$doc_papa=buscar_papa_formato_campo($idformato_papa[0][0],$_REQUEST['anterior'],'ft_pqrsf','documento_iddocumento');
		$tipo=mostrar_valor_campo('tipo',$idformato_papa[0][0],$doc_papa,1);
		echo "<td><input type='text' name='asunto' id='asunto' value='Respuesta Solicitud #".$radicado_papa." (".$tipo.")' size='100'></td>";
	}
}

function email_papa(){
global $conn;	
	if(@$_REQUEST['iddoc']){
		$email=busca_filtro_tabla("para","ft_respuesta_pqrsf","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
		echo "<td><input type='text' name='para' class='required email' id='para' value='".$email[0][0]."' size='100'></td>";	
	}else{
		$idformato_papa=busca_filtro_tabla("idformato","formato","nombre='pqrsf'","",$conn);
		$doc_papa=buscar_papa_formato_campo($idformato_papa[0][0],$_REQUEST['anterior'],'ft_pqrsf','documento_iddocumento');
		$email=mostrar_valor_campo('email',$idformato_papa[0][0],$doc_papa,1);
		echo "<td><input type='text' name='para' class='required email' id='para' value='".$email."' size='100'></td>";
	}
}

/*MOSTRAR*/
function creador_documento($idformato,$iddoc){
global $conn;
	$partesql="select ejecutor from documento where iddocumento=".$iddoc;
	$creador=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=(".$partesql.")","",$conn);
	echo $creador[0]['nombres']." ".$creador[0]['apellidos']; 
}
function ver_comentario($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_respuesta_pqrsf ft,documento d","d.iddocumento=ft.documento_iddocumento and d.iddocumento=".$iddoc,"",$conn);
	//echo str_replace("<p>","",str_replace("</p>","<br>",$datos[0]['comentario']));
	echo($datos[0]['comentario']);
}
/*POSTERIOR ADICIONAR -EDITAR*/
//enviar_correo_pqr(307,834);
function enviar_correo_pqr($idformato,$iddoc){
	global $conn;
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
	}
	if(!@$_REQUEST['para']){
		$correo_destino=busca_filtro_tabla("","ft_respuesta_pqrsf","documento_iddocumento=".$iddoc,"",$conn);
	}
	
	$iddoc_papa=buscar_papa_formato_campo($idformato,$iddoc,"ft_pqrsf","documento_iddocumento");
	$update_estado="UPDATE ft_pqrsf SET estado_reporte=3,funcionario_reporte=".usuario_actual("idfuncionario").",fecha_reporte=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$iddoc_papa;//Cambio a Entregado
	phpmkr_query($update_estado);
	
	$documento=busca_filtro_tabla("","documento a","a.iddocumento=".$iddoc,"",$conn);
	$ruta=generar_pdf_pqrsf($documento);

	$anexos=array();
	$anexos[]=$ruta;
	
	$usuarios=array();
	
	$asunto='';
	$comentario='';
	if(@$_REQUEST['para']){
		$usuarios[]=$_REQUEST['para'];
		$asunto=$_REQUEST['asunto'];
		$comentario=$_REQUEST['comentario'];
	}else{
		$usuarios[]=$correo_destino[0]['para'];
		$asunto=$correo_destino[0]['asunto'];
		$comentario=$correo_destino[0]['comentario'];
	}

	$correo="comunicaciones@ucm.edu.co";
	$retorno=enviar_mensaje('','email',$usuarios,$asunto,$comentario,$anexos);
	
	$documento_mns = busca_filtro_tabla("descripcion,plantilla,ejecutor,numero", "documento", "iddocumento=".$iddoc, "", $conn);
	$funcionario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$datos["origen"] = usuario_actual("funcionario_codigo");
	$datos["archivo_idarchivo"] = $iddoc;
	$datos["tipo_destino"] =1;
	$datos["ver_notas"]=1;
	$datos["tipo_origen"]=1;    
	$datos["tipo"] = "";
	$datos["nombre"] = "DISTRIBUCION"; 
	$otros["notas"] = "'Envio de correo ".$_REQUEST['asunto']."'";
	transferir_archivo_prueba($datos, array($documento_mns[0]["ejecutor"]), $otros);
	
	if($retorno===true){
		//alerta("Correo Enviado!");
	}else{
		//alerta("Correo NO Enviado");
	}
}
function generar_pdf_pqrsf($documento){
		global $conn,$ruta_db_superior;
    $iddoc=$documento[0]["iddocumento"];
    $exportar_pdf=busca_filtro_tabla("valor","configuracion A","A.nombre='exportar_pdf'","",$conn);
    if($exportar_pdf[0]["valor"]=='html2ps'){
	    $export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
    }
    else if($exportar_pdf[0]["valor"]=='class_impresion'){
    	$export="class_impresion.php?iddoc=".$iddoc;
    }
    else{
    	$export="exportar_impresion.php?iddoc=".$iddoc."&plantilla=".strtolower($documento[0]["plantilla"]);
    }
    
    $ch = curl_init();
	$fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/".$export."&conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA;
	
	curl_setopt($ch, CURLOPT_URL,$fila); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	
	curl_setopt($ch, CURLOPT_VERBOSE, true); 
	curl_setopt($ch, CURLOPT_STDERR, $abrir);
	
	$contenido=curl_exec($ch);
	
	curl_close ($ch);
	
	/*$datos_documento=busca_filtro_tabla(fecha_db_obtener('A.fecha','Y-m-d')." as x_fecha, A.*","documento A","A.iddocumento=".$iddoc,"",$conn);
	
	$fecha=explode("-", $datos_documento[0]["x_fecha"]);
	$ruta=RUTA_PDFS.$datos_documento[0]["estado"]."/".$fecha[0]."-".$fecha[1]."/".$datos_documento[0]["iddocumento"]."/pdf/";
	$ruta.=($datos_documento[0]["plantilla"])."_".$datos_documento[0]["numero"]."_".str_replace("-","_",$datos_documento[0]["x_fecha"]).".pdf";*/
	$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	if($consulta[0]['pdf']!=""){
    $ruta=$ruta_db_superior.$consulta[0]['pdf'];
  }
	return($ruta);
}



function actualizar_tipo_radicado_respuesta($idformato,$iddoc){
	global $ruta_db_superior,$conn;
	
	$sql="UPDATE documento SET tipo_radicado=2 WHERE iddocumento=".$iddoc;
	phpmkr_query($sql);
	//redirecciona($ruta_db_superior.'ordenar.php?accion=mostrar&mostrar_formato=1&key='.$iddoc,'_parent');

}

function mostrar_informacion_pqrsf_padre($idformato,$iddoc){
	
	$datos_respuesta=busca_filtro_tabla("","ft_respuesta_pqrsf a, documento b","a.documento_iddocumento=b.iddocumento AND a.documento_iddocumento=".$iddoc,"",$conn);
	$datos_padre=busca_filtro_tabla("","ft_pqrsf a, documento b, formato c","lower(b.plantilla)=c.nombre AND a.documento_iddocumento=b.iddocumento AND  a.idft_pqrsf=".$datos_respuesta[0]['ft_pqrsf'],"",$conn);
	
	
	$cadena='

		<table style="border-collapse: collapse; width: 100%;" border="0">
		<tbody>
		<tr>
		<td style=" border-left-width:1px;border-right-width:1px;border-right-style:solid;border-left-style:solid;border-top-style:solid; border-color:black; border-top-width:1px;font-size:10pt; border-bottom-style:solid; border-bottom-width:1px;" class="encabezado_list" colspan="2">INFORMACIÓN GENERAL PQRS	</td>
		</tr>
		<tr>
		<td style="border-left-style:solid;border-left-width:1px; "></td><td style="text-align:right; border-right-style:solid;border-right-width:1px;;"><b>Radicado PQRS:</b> '.$datos_padre[0]['numero'].'&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td style="border-left-style:solid;border-left-width:1px; "></td><td style="text-align:right;border-right-width:1px;; border-right-style:solid;"><b>Fecha:</b> '.$datos_padre[0]['fecha'].'&nbsp;&nbsp;</td>
		</tr>	
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px;; ">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td style="border-left-style:solid;border-left-width:1px; "><b>&nbsp;&nbsp;Nombre Completo: </b> '.$datos_padre[0]['nombre'].'&nbsp;&nbsp;</td><td style="border-right-style:solid;border-right-width:1px;;"><b>Documento: </b>'.$datos_padre[0]['documento'].'</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>
		<tr>
		<td style="border-left-style:solid; border-left-width:1px;"><b>Tipo de comentario:</b> '.mostrar_valor_campo('tipo',$datos_padre[0]['idformato'],$datos_padre[0]['iddocumento'],1).'</td><td style="border-right-style:solid;border-right-width:1px;;"> </td>
		</tr>	
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; "><b>Comentario:</b> </td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; ">&nbsp;</td>
		</tr>			
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid; border-right-width:1px;;border-bottom-style:solid; border-bottom-width:1px;">'.$datos_padre[0]['comentarios'].' </td>
		</tr>
		</tbody>
		</table>
	';

	echo($cadena);	

	$partesql="select ejecutor from documento where iddocumento=".$iddoc;
	$creador=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=(".$partesql.")","",$conn);
	$creador_doc= $creador[0]['nombres']." ".$creador[0]['apellidos']; 
		
	$cadena2='
		<table style="border-collapse: collapse; width: 100%;" border="0">
		<tbody>
		<tr>
		<td style=" border-left-width:1px;border-right-width:1px;border-right-style:solid;border-left-style:solid;border-top-style:solid; border-color:black; border-top-width:1px;font-size:10pt; border-bottom-style:solid; border-bottom-width:1px;" class="encabezado_list" colspan="2">RESPUESTA A PQRSF	</td>
		</tr>
		<tr>
		<td style="border-left-style:solid;border-left-width:1px; "></td><td style="text-align:right; border-right-style:solid;border-right-width:1px;;"><b>Radicado respuesta:</b> '.$datos_respuesta[0]['numero'].'</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td style="border-left-style:solid;border-left-width:1px; "></td><td style="text-align:right;border-right-width:1px;; border-right-style:solid;"><b>Fecha y Hora Respuesta:</b> '.$datos_respuesta[0]['fecha'].'</td>
		</tr>	
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px;; ">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; "><b>De:</b> '.$creador_doc.' </td>
		</tr>	
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; "><b>Para:</b> '.$datos_respuesta[0]['para'].' </td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; "><b>Asunto:</b> '.$datos_respuesta[0]['asunto'].' </td>
		</tr>									
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;;">&nbsp;</td>
		</tr>		
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; "><b>Respuesta:</b> </td>
		</tr>
		<tr>
			<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid;border-right-width:1px;; ">&nbsp;</td>
		</tr>			
		<tr>
		<td colspan="2" style="border-left-style:solid;border-left-width:1px; border-right-style:solid; border-right-width:1px;border-bottom-style:solid; border-bottom-width:1px;">'.$datos_respuesta[0]['comentario'].' </td>
		</tr>
		</tbody>
		</table>	
	
	
	
	';
	echo($cadena2);
	
}


?>