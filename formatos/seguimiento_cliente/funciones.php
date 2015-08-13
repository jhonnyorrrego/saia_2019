<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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

function fecha_actual_editable($idformato,$iddoc){
	global $conn;
	
	$resultado=busca_filtro_tabla("fecha","ft_seguimiento_registro_cliente","documento_iddocumento=$iddoc","",$conn);
	if($resultado['numcampos']<=0 ){
     	$fecha_actual = date("Y-m-d");
	}
	else{
		$fecha_actual=fecha_db_obtener($resultado[0][0],'Y-m-d');
	}
	$selector_fecha="<a href="."javascript:showcalendar('fecha','formulario_formatos','Y-m-d','../../calendario/selec_fecha.php?nombre_campo=fecha&nombre_form=formulario_formatos&formato=Y-m-d&anio=2014&mes=04&css=default.css&adicionales_tarea=AD:VALOR',220,225)"."><img src="."../../calendario/activecalendar/data/img/calendar.gif "."border='0' alt='Elija Fecha'></a>";
	$fecha='<td colspan="2" bgcolor="#F5F5F5"><span><input  tabindex="3"  type="text" readonly="true"  class="required dateISO"  name="fecha" id="fecha" tipo="fecha" value="'.$fecha_actual.'">'.$selector_fecha.'</span></td></tr>';
	echo($fecha);
		
}
function estado_cliente($idformato,$iddoc){
	global $conn;
	$estado=busca_filtro_tabla("B.estado_cliente","ft_seguimiento_cliente A, ft_registro_cliente B","B.idft_registro_cliente=A.ft_registro_cliente","",$conn);
	
	
	switch($estado[0][0]){
		case 0:
			echo('<td bgcolor="#F5F5F5"><table border="0"><tbody><tr><td><label for="estado_cliente0"><input type="radio" name="estado_cliente" id="estado_cliente0" value="0" checked="checked">Contacto</label></td><td><label for="estado_cliente1"><input type="radio" name="estado_cliente" id="estado_cliente1" value="1">Potencial</label></td><td><label for="estado_cliente2"><input type="radio" name="estado_cliente" id="estado_cliente2" value="2">Cliente</label></td></tr><tr><td colspan="3"><label style="display:none" for="estado_cliente" class="error">Campo obligatorio</label></td></tr></tbody></table></td>');
			break;
		case 1:
			echo('<td bgcolor="#F5F5F5"><table border="0"><tbody><tr><td><label for="estado_cliente0"><input type="radio" name="estado_cliente" id="estado_cliente0" value="0">Contacto</label></td><td><label for="estado_cliente1"><input type="radio" name="estado_cliente" id="estado_cliente1" value="1" checked="checked">Potencial</label></td><td><label for="estado_cliente2"><input type="radio" name="estado_cliente" id="estado_cliente2" value="2">Cliente</label></td></tr><tr><td colspan="3"><label style="display:none" for="estado_cliente" class="error">Campo obligatorio</label></td></tr></tbody></table></td>');
			break;
		case 2:
			echo('<td bgcolor="#F5F5F5"><table border="0"><tbody><tr><td><label for="estado_cliente0"><input type="radio" name="estado_cliente" id="estado_cliente0" value="0">Contacto</label></td><td><label for="estado_cliente1"><input type="radio" name="estado_cliente" id="estado_cliente1" value="1">Potencial</label></td><td><label for="estado_cliente2"><input type="radio" name="estado_cliente" id="estado_cliente2" value="2" checked="checked">Cliente</label></td></tr><tr><td colspan="3"><label style="display:none" for="estado_cliente" class="error">Campo obligatorio</label></td></tr></tbody></table></td>');
			break;
	}
}
function mostrar_estado_cliente($idformato,$iddoc){
	global $conn;
	$estado=busca_filtro_tabla("B.estado_cliente","ft_seguimiento_cliente A, ft_registro_cliente B","B.idft_registro_cliente=A.ft_registro_cliente","",$conn);

	switch($estado[0][0]){
		case 0:
			echo("Contacto");
			break;
		case 1:
			echo("Potencial");
			break;
		case 2:
			echo("Cliente");
			break;
	}
}
function mostrar_anexos_proyecto($idformato,$iddoc){
    global $conn,$ruta_db_superior;
   
    $anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);

    if($anexos["numcampos"]>0){
    	//$srt_anexos= 'Anexos: '; 
        for ($i=0;$i<$anexos["numcampos"];$i++) {
            $srt_anexos .= "<a href=../../".$anexos[$i]["ruta"].">".preg_replace('/\.\w*/','',$anexos[$i]["etiqueta"])."</a>,";
        }
    }
	echo html_entity_decode(substr($srt_anexos,0,-1));
}
function actualizar_estado_cliente($idformato,$iddoc){
	global $conn;
	$estado=busca_filtro_tabla("estado_cliente","ft_seguimiento_cliente","documento_iddocumento=".$iddoc,"",$conn);
	$idpapa=busca_filtro_tabla("B.documento_iddocumento","ft_seguimiento_cliente A, ft_registro_cliente B","B.idft_registro_cliente=A.ft_registro_cliente AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$actualiza_estado="UPDATE ft_registro_cliente SET estado_cliente=".$estado[0][0]." where documento_iddocumento=".$idpapa[0][0];
	phpmkr_query($actualiza_estado);
}
?>