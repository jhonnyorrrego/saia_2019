<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
include_once($ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php");
echo(librerias_jquery('1.7'));
echo(estilo_bootstrap());
	global $raiz_saia;
	$raiz_saia=$ruta_db_superior;
echo(librerias_notificaciones());

if(@$_REQUEST['exportar']){
	$idfuncionario_fecha_registro_idtareas=explode('|',@$_REQUEST['variable_busqueda']);
	$condicion=fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$idfuncionario_fecha_registro_idtareas[1]."' AND a.generica=0 AND  a.idtareas_listado IN(".$idfuncionario_fecha_registro_idtareas[2].")";	
	$datos_tarea=busca_filtro_tabla("b.funcionario_idfuncionario AS idfuncionario_cierre,a.nombre_tarea,a.descripcion_tarea,a.idtareas_listado,a.tiempo_estimado","tareas_listado a left join tareas_listado_tiempo b on a.idtareas_listado=b.fk_tareas_listado",$condicion,"group by b.funcionario_idfuncionario,a.nombre_tarea,a.descripcion_tarea,a.idtareas_listado,a.tiempo_estimado ORDER BY a.fecha_creacion DESC",$conn);
	$fun_cierre=busca_filtro_tabla("nombres,apellidos,login","funcionario","idfuncionario=".$datos_tarea[0]['idfuncionario_cierre'],"",$conn);
	
	$nombre_fun_cierre=ucwords(strtolower($fun_cierre[0]['nombres'].' '.$fun_cierre[0]['apellidos']));
	$vector_fecha_cierre=explode('-',$idfuncionario_fecha_registro_idtareas[1]);
	setlocale(LC_TIME, 'spanish');  
	$mes=ucwords(strftime("%B",mktime(0, 0, 0, intval($vector_fecha_cierre[1]), 1, 2000))); 
	$fecha_cierre=$vector_fecha_cierre[ count($vector_fecha_cierre)-1 ].' de '.$mes.' del '.$vector_fecha_cierre[0];
	$login=busca_filtro_tabla(fecha_db_obtener('fecha','H:i:s')." AS hora_primer_login,".fecha_db_obtener('fecha_cierre','H:i:s')." AS hora_ultimo_logout","log_acceso","login='".$fun_cierre[0]['login']."' AND ".fecha_db_obtener('fecha','Y-m-d')."='".$idfuncionario_fecha_registro_idtareas[1]."'","idlog_acceso ASC",$conn);
	$logo_empresa=logo_empresa();
	
	$datos_usuario_actual=busca_filtro_tabla("b.cod_padre","vfuncionario_dc a, cargo b ","a.idcargo=b.idcargo AND a.estado_dc=1 AND a.idfuncionario=".$idfuncionario_fecha_registro_idtareas[0],"",$conn);			
	$datos_jefe_usuario_actual=busca_filtro_tabla("a.email,a.funcionario_codigo","vfuncionario_dc a, cargo b ","b.idcargo=".$datos_usuario_actual[0]['cod_padre']."  AND a.idcargo=b.idcargo AND a.estado_dc=1","",$conn);	
	
	$color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado'","",$conn);
	$color_celdas=$color_saia[0]['valor'];
	
	
	$html='
<table style="width:100%;border-collapse:collapse; font-size:10pt;border-color:#DBDBDB;" border="1">
	<tr>
		<td colspan="2" class="encabezado_list" style="color:white;text-align:center;font-weight:bold;width:80%;background-color:'.$color_celdas.';" >
			REPORTE CIERRE DEL D&Iacute;A
		</td>
		<td rowspan="3" style="width:20%;text-align:center;">
			'.$logo_empresa.'
		</td>
	</tr>
	<tr>
		<td colspan="2" class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:80%;background-color:'.$color_celdas.';">
			USUARIO Y FECHA
		</td>
	</tr>	
	<tr>
		<td colspan="2"  style="text-align:left;width:80%;">
			'.$nombre_fun_cierre.' '.$fecha_cierre.'
		</td>
	</tr>		
</table>
<table style="width:100%;border-collapse:collapse; border-top:0px;font-size:10pt;border-color:#DBDBDB;" border="1">
	<tr>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:33%;background-color:'.$color_celdas.';">MARCAR ENTRADA</td>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:34%;background-color:'.$color_celdas.';">PAUSA</td>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:33%;background-color:'.$color_celdas.';">MARCAR SALIDA</td>
	</tr>
	<tr>
		<td  style="text-align:left; width:33%;">'.$login[0]['hora_primer_login'].'</td>
		<td  style="text-align:left; width:34%;"></td>
		<td  style="text-align:left; width:33%;">'.$login[ $login['numcampos']-1 ]['hora_ultimo_logout'].'</td>
	</tr>	
</table>	
<table style="width:100%;border-collapse:collapse; border-top:0px;font-size:10pt;border-color:#DBDBDB;" border="1">
	<tr>
		<td colspan="4" class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:100%;background-color:'.$color_celdas.';">TAREAS DEL D&Iacute;A</td>
	</tr>
	<tr>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:25%;background-color:'.$color_celdas.';">NOMBRE DE LA TAREA</td>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:25%;background-color:'.$color_celdas.';">DESCRIPCI&Oacute;N</td>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:25%;background-color:'.$color_celdas.';">TIEMPO EJEC</td>
		<td class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:25%;background-color:'.$color_celdas.';">TIEMPO PLAN</td>		
	</tr>
	';
	
	$total_avances=0;
	$total_tiempo_estimado=0;
	for($i=0;$i<$datos_tarea['numcampos'];$i++){	
		$tiempo_tarea=busca_filtro_tabla("","tareas_listado_tiempo","fecha_inicio='".$idfuncionario_fecha_registro_idtareas[1]."' AND funcionario_idfuncionario=".$idfuncionario_fecha_registro_idtareas[0]." AND fk_tareas_listado=".$datos_tarea[$i]['idtareas_listado'],"",$conn);
		$vector_tiempo_registrado=extrae_campo($tiempo_tarea,'tiempo_registrado','D');
		$tiempo_registrado=array_sum($vector_tiempo_registrado);	
		$total_avances=$total_avances+$tiempo_registrado;
		$tiempo_convertido=conversor_segundos_hm($tiempo_registrado);

		$hora = $datos_tarea[$i]['tiempo_estimado'];
		list($horas, $minutos, $segundos) = explode(':', $hora);
		$hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;		
		$total_tiempo_estimado=$total_tiempo_estimado+$hora_en_segundos;	
		$html.='
		<tr>
			<td  style="text-align:left; width:25%;">'.codifica_encabezado(html_entity_decode($datos_tarea[$i]['nombre_tarea'])).'</td>
			<td  style="text-align:left; width:25%;">'.codifica_encabezado(html_entity_decode($datos_tarea[$i]['descripcion_tarea'])).'</td>
			<td  style="text-align:center; width:25%;">'.$tiempo_convertido.'</td>
			<td  style="text-align:center; width:25%;">'.$hora_en_segundos.'</td>	
		</tr>
		';		
	}
	$tiempo_total_tiempo_estimado=conversor_segundos_hm($total_tiempo_estimado);
	$tiempo_total_avances=conversor_segundos_hm($total_avances);
	$html.='
		<tr>
			<td  style="color:white;text-align:left; width:25%;font-weight:bold;background-color:'.$color_celdas.';">TOTAL</td>
			<td  style="text-align:left; width:25%;"></td>
			<td  style="text-align:center; width:25%;">'.$tiempo_total_avances.'</td>
			<td  style="text-align:center; width:25%;">'.$tiempo_total_tiempo_estimado.'</td>	
		</tr>
	';	
	$html.='
	<tr>
		<td colspan="4" class="encabezado_list" style="color:white;text-align:center; font-weight:bold;width:100%;background-color:'.$color_celdas.';">OBSERVACIONES</td>
	</tr>
	<tr>
		<td colspan="4" style="text-align:justify;width:100%;">'.codifica_encabezado(html_entity_decode(@$_REQUEST['observaciones'])).'</td>
	</tr>		
</table>';


    if($_SESSION['LOGIN'.LLAVE_SAIA]=='cerok'){
        enviar_mensaje("","codigo",array(1),"Reporte Cierre Dia",$html);
    }else{

    	if($datos_jefe_usuario_actual['numcampos']){
    		enviar_mensaje("","codigo",array($datos_jefe_usuario_actual[0]['funcionario_codigo']),"Reporte Cierre Dia",$html);
    	}
        
    }


	
	echo'
	<script>
		window.parent.top.hs.close();
		notificacion_saia("Reporte Enviado Satisfactoriamente","success","",4000);
	</script>';
	die();
}

?>
<form action="exportar_reporte_cierre_dia.php" method="POST"> 
<textarea name="observaciones" placeholder="Observaciones" style="width:450; height:100px;" ></textarea>
<input type="hidden" name="exportar" value="1" />
<input type="hidden" name="variable_busqueda" value="<?php echo(@$_REQUEST['variable_busqueda']); ?>" />
<br/>
   <input type="submit" class="btn btn-mini btn-primary" value="Enviar Reporte">
</form>
