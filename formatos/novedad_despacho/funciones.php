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
    $registros=busca_filtro_tabla("b.idft_destino_radicacion,b.numero_item","ft_radicacion_entrada a,ft_destino_radicacion b,ft_item_despacho_ingres c, documento d,ft_despacho_ingresados e","b.ft_radicacion_entrada=a.idft_radicacion_entrada AND c.ft_destino_radicacio=b.idft_destino_radicacion AND d.iddocumento=a.documento_iddocumento AND c.ft_despacho_ingresados=e.idft_despacho_ingresados AND e.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
    //$html="<td><select name='item_radicacion' id='item_radicacion'><option value=''>Seleccione</option>";
    /*for ($i=0; $i < $registros['numcampos']; $i++) { 
        $html.="<option value='".$registros[$i]['idft_destino_radicacion']."'>".$registros[$i]['numero_item']."</option>";
    }
    $html.="</select></td>";
    echo($html);
	*/
	
	$html='<td>';
	$salto=0;
    for ($i=0; $i < $registros['numcampos']; $i++) { 
        $html.="<input type='checkbox' name='item_radicacion[]' value='".$registros[$i]['idft_destino_radicacion']."' />".$registros[$i]['numero_item']."";
        if($salto==5){
        	$salto=0;
        	$html.="<br>";
        }else{
        	$salto++;
        }
    }	
    $html.='</td>';
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
			$select.='<option value="'.codifica_encabezado(html_entity_decode($vector_novedades[$i])).'">'.codifica_encabezado(html_entity_decode($vector_novedades[$i])).'</option>';
		}
	}
	$select.='</select></td>';	
	echo($select);
}
?>