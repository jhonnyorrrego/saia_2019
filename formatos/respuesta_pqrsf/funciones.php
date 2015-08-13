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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 

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
	echo str_replace("<p>","",str_replace("</p>","<br>",$datos[0]['comentario']));
}
/*POSTERIOR ADICIONAR -EDITAR*/
//enviar_correo_pqr(307,834);
function enviar_correo_pqr($idformato,$iddoc){
	global $conn;
	$iddoc_papa=buscar_papa_formato_campo($idformato,$iddoc,"ft_pqrsf","documento_iddocumento");
	$update_estado="UPDATE ft_pqrsf SET estado_reporte=3,funcionario_reporte=".usuario_actual("idfuncionario").",fecha_reporte=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$iddoc_papa;//Cambio a Entregado
	phpmkr_query($update_estado);
	
	 /*$abrir=fopen("log_curl.txt","a+"); 
	 $ch = curl_init();
	 $fila = "http://".RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddoc."&conexion_remota=1";
	 fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." se ejecutaron las siguientes tareas \n");
	 curl_setopt($ch, CURLOPT_URL,$fila); 
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	 curl_setopt($ch, CURLOPT_VERBOSE, true); 
	 curl_setopt($ch, CURLOPT_STDERR, $abrir);
	 $contenido=curl_exec($ch);    
	 fwrite($abrir,"En la fecha ".date('Y-m-d H:i:s')." Termina el proceso =>  ".$contenido." \n \n");
	 curl_close ($ch); 
	 fclose($abrir);*/

	$anexos=array();
	$enviar_pdf=busca_filtro_tabla("pdf","documento","iddocumento=".$iddoc,"",$conn);
	if($enviar_pdf[0]['pdf']!=""){
		$anexos[]=$enviar_pdf[0]['pdf'];
	}
	$usuarios=array();
	$usuarios[]=$_REQUEST['para'];
	$correo="comunicaciones@ucm.edu.co";
	$retorno=enviar_mensaje($correo,'email',$usuarios,$_REQUEST['asunto'],$_REQUEST['comentario'],$anexos);
	if($retorno===true){
		alerta("Correo Enviado!");
	}else{
		alerta("Correo NO Enviado");
	}
}

?>