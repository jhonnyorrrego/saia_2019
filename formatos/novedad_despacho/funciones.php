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
function cargar_items_radicacion($idformato,$iddoc){
    global $conn;

	$items_seleccionados=busca_filtro_tabla("iddestino_radicacion","ft_despacho_ingresados","documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	$cadena_items_seleccionados=$items_seleccionados[0]['iddestino_radicacion'];
	
	$registros=busca_filtro_tabla("b.idft_destino_radicacion,b.numero_item,b.estado_recogida,d.iddocumento,d.plantilla,b.numero_item,b.nombre_destino,b.destino_externo,b.origen_externo,b.tipo_origen,b.tipo_destino,b.nombre_origen,a.documento_iddocumento,a.descripcion,a.tipo_mensajeria","ft_destino_radicacion b, ft_radicacion_entrada a, documento d","a.idft_radicacion_entrada=b.ft_radicacion_entrada AND a.documento_iddocumento=d.iddocumento AND b.idft_destino_radicacion in(".$cadena_items_seleccionados.")","",$conn);
	
	$html="<td>
		<table style='width:100%;border-collapse:collapse;'  border='1px'>
		<tr style='font-weight:bold;text-align:center;'>
			<td>
				
			</td>
			<td>
				TR&Aacute;MITE
			</td>
			<td>
				TIPO
			</td>
			<td>
				Rad. Item
			</td>
			<td>
				FECHA DE RECIBO
			</td>	
			<td>
				ORIGEN	
			</td>
			<td>
				DESTINO	
			</td>	
			<td>
				ASUNTO
			</td>																			
		</tr>
	";
    for ($i=0; $i < $registros['numcampos']; $i++) {
			
	    $array_concat=array("nombres","' '","apellidos");
		$cadena_concat=concatenar_cadena_sql($array_concat);
		$origen=busca_filtro_tabla($cadena_concat." AS nombre","vfuncionario_dc","funcionario_codigo=".$registros[$i]['nombre_origen'],"",$conn);

			if($registros[$i]['tipo_origen']==1){
				$origen=busca_filtro_tabla("nombre,ciudad,direccion","vejecutor a","a.iddatos_ejecutor=".$registros[$i]['nombre_origen'],"",$conn);
				if(!$origen['numcampos']){
					$origen=busca_filtro_tabla("nombre,ciudad,direccion","vejecutor a","a.iddatos_ejecutor=".$registros[$i]['origen_externo'],"",$conn);
				}
				$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$origen[0]['ciudad'],"",$conn);
            	$ubicacion_origen=$ciudad[0]['nombre'].' '.$origen[0]['direccion'];
				
			}else{
				if($registros[$i]['tipo_origen']==2 && ($registros[$i]['tipo_mensajeria']==2 || $registros[$i]['tipo_mensajeria']==1)){
	    			$array_concat=array("nombres","' '","apellidos");
					$cadena_concat=concatenar_cadena_sql($array_concat);					
					$origen=busca_filtro_tabla($cadena_concat." AS nombre,dependencia","vfuncionario_dc a","a.iddependencia_cargo=".$registros[$i]['nombre_origen'],"",$conn);
					$ubicacion_origen=$origen[0]['dependencia'];
				}
			}		
				
		
        $ubicacion="";
		if($registros[$i]["tipo_destino"]==1){
		    $destino=busca_filtro_tabla("b.nombre,a.direccion,a.ciudad","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$registros[$i]['nombre_destino'],"",$conn);
	        if(!$destino['numcampos']){
	        	$destino=busca_filtro_tabla("b.nombre,a.direccion,a.ciudad","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$registros[$i]['destino_externo'],"",$conn);
	        }			
			$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$destino[0]['ciudad'],"",$conn);
            $ubicacion=$ciudad[0]['nombre'].' '.$destino[0]['direccion'];
		}elseif($registros[$i]["tipo_destino"]==2){
	    	$array_concat=array("nombres","' '","apellidos");
			$cadena_concat=concatenar_cadena_sql($array_concat);			
		    $destino=busca_filtro_tabla($cadena_concat." AS nombre,dependencia","vfuncionario_dc","iddependencia_cargo=".$registros[$i]['nombre_destino'],"",$conn);
		    $ubicacion=$destino[0]['dependencia'];
		}
		$texto.='<tr>';
		$fecha_radicacion=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d")." as fecha,tipo_radicado","documento","iddocumento=".$registros[$i]["documento_iddocumento"],"",$conn);
        
        $tipo_radicado="";
        if($fecha_radicacion[0]['tipo_radicado']==1){
            $tipo_radicado="E";
        }else{
            $tipo_radicado="I";
        }
        
    	$tipo_tramite='ENTREGA';
    	if(($registros[$i]['tipo_mensajeria']==2 || $registros[$i]['tipo_mensajeria']==1) && ($registros[$i]['estado_recogida']==0 || $registros[$i]['estado_recogida']=='estado_recogida') ){
    		$tipo_tramite='RECOGIDA';
    	}    	
		
    	 $html.="
    	 
    	 <tr>
    	 	<td style='text-align:center; width:5%'>
    	 		<input type='checkbox' name='item_radicacion[]' value='".$registros[$i]['idft_destino_radicacion']."' />
    	 	</td>
    	 	<td style='text-align:center; width:5%'>
    	 		".$tipo_radicado."
    	 	</td>    	 
    	 	<td style='text-align:center; width:10%'>
    	 		".$tipo_tramite."
    	 	</td>
    	 	<td style='text-align:center; width:5%'>
    	 		".$registros[$i]['numero_item']."
    	 	</td>
    	 	<td style='text-align:center; width:10%'>
    	 		".$fecha_radicacion[0]["fecha"]."
    	 	</td>
    	 	<td style='text-align:left; width:21,66%;'>
    	 		".$origen[0]['nombre'].'<br><b>Ubicacion:</b>'.$ubicacion_origen."
    	 	</td>
    	 	<td style='text-align:left; width:21,66%;'>
    	 		".$destino[0]["nombre"].'<br><b>Ubicacion:</b>'.$ubicacion."
    	 	</td>
    	 	<td style='text-align:left; width:21,66%;'>
    	 		".$registros[$i]["descripcion"]."
    	 	</td>
		</tr>
		
		";
		

		
		
		
		
    }	
    $html.="
    </table>
    </td>
    ";
    echo($html);
}
function mostrar_numero_item_novedad($idformato,$iddoc){
	global $conn;			
	$items_seleccionados=busca_filtro_tabla("item_radicacion","ft_novedad_despacho","documento_iddocumento=".$iddoc,"",$conn);	
    $registros=busca_filtro_tabla("b.numero_item","ft_destino_radicacion b","b.idft_destino_radicacion in(".$items_seleccionados[0]['item_radicacion'].")","",$conn);
	$cadena='';
	for($i=0;$i<$registros['numcampos'];$i++){
		$cadena.=$registros[$i]['numero_item'];
		if( ($i+1) != $registros['numcampos'] ){
			$cadena.=', ';
		}
	}
    echo($cadena);
}
function mostrar_novedad_despacho_anexo_soporte($idformato,$iddoc){
	global $ruta_db_superior,$conn;

	$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
	if($anexos['numcampos']){
		$tabla='<ul>';
	    for($j=0;$j<$anexos['numcampos'];$j++){
	        if($anexos[$j]['tipo']=='jpg' || $anexos[$j]['tipo']=='JPG' || $anexos[$j]['tipo']=='pdf' || $anexos[$j]['tipo']=='PDF' || $anexos[$j]['tipo']=='png'){
	            $tabla.="<li><a href='".$ruta_db_superior.$anexos[$j]['ruta']."' target='_blank'>".$anexos[$j]['etiqueta']."</a></li>";
	        }
	        else{
	            $tabla.='<li><a title="Descargar" href="'.$ruta_db_superior.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$anexos[$j]['idanexos'].'&amp;accion=descargar" border="0px">'.$anexos[$j]['etiqueta'].'</a></li>';
	        }
							
	    }
		$tabla.='</ul>';
		echo($tabla);
	}	
}
function generar_select_novedad($idformato,$iddoc){
	global $ruta_db_superior,$conn;
	
	$configuracion_tipo_novedad=busca_filtro_tabla("valor","configuracion","nombre='novedad_despacho' AND tipo='tipo_novedad'","",$conn);
	$select='<td><select name="novedad" id="novedad"><option value="">Por favor seleccione...</option>';
	if($configuracion_tipo_novedad['numcampos']){
		$vector_novedades=explode(',',$configuracion_tipo_novedad[0]['valor']);
		for($i=0;$i<count($vector_novedades);$i++){
			$select.='<option value="'.htmlspecialchars($vector_novedades[$i]).'">'.codifica_encabezado(html_entity_decode($vector_novedades[$i])).'</option>';
		}
	}
	$select.='</select></td>';	
	echo($select);
}
?>