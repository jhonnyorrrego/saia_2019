<?php
function soporte_documental_funcion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos_documento=busca_filtro_tabla("","ft_acopio A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddoc,"",$conn);
	
	$formato_hijo=busca_filtro_tabla("","formato A","A.nombre='soporte_documental'","",$conn);
	
	$adicionar='<a href="'.$ruta_db_superior.'formatos/'.$formato_hijo[0]["nombre"].'/'.$formato_hijo[0]["ruta_adicionar"].'?pantalla=padre&idpadre='.$iddoc.'&idformato='.$formato_hijo[0]["idformato"].'&padre='.$datos_documento[0]["idft_acopio"].'">Adcionar '.$formato_hijo[0]["etiqueta"].'</a>';
	
	$hijos=busca_filtro_tabla("","ft_soporte_documental A","A.ft_acopio=".$datos_documento[0]["idft_acopio"],"",$conn);
	
	$estado=True;
	$tabla="";
	if($estado){
		$tabla.=$adicionar;
	}
	if($hijos["numcampos"]){
		$tabla.='<style>.titulos{text-align:center}</style>';
		$tabla.='<table style="width:100%;border-collapse:collapse" border="1px">';
		$tabla.='<tr>';
		$tabla.='<td class="titulos"><b>Soportes documentales</b></td>';
		$tabla.='<td class="titulos"><b>Tipo de soporte</b></td>';
		$tabla.='<td class="titulos"><b>Observaciones</b></td>';
		if($estado){
			$tabla.='<td class="titulos">&nbsp;</td>';
		}
		$tabla.='</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$tabla.='<tr>';
			$tabla.='<td>'.parsear_campos_valores_acopio2($hijos[$i]["soportes_documental"]).'</td>';
			$tabla.='<td>'.parsear_campos_valores_acopio($formato_hijo[0]["idformato"],'tipo_soporte',$hijos[$i]["tipo_soporte"]).'</td>';
			$tabla.='<td>'.strip_tags(utf8_encode(html_entity_decode($hijos[$i]["observaciones"]))).'</td>';
			if($estado){
				$tabla.="<td><a href='#' onclick='if(confirm(\"En realidad desea borrar este elemento?\")) window.location=\"../librerias/funciones_item.php?formato=".$formato_hijo[0]["idformato"]."&idpadre=".$iddocumento."&accion=eliminar_item&tabla=".$formato_hijo[0]["nombre_tabla"]."&id=".$hijos[$i]["idft_volumen_documental"]."\";'><img border=0 src='".$ruta_db_superior."images/eliminar_pagina.png' /></a></td>";
			}
			$tabla.='</tr>';
		}
		$tabla.='</table>';
	}
	echo($tabla);
}
function parsear_campos_valores_acopio($idformato,$nombre_campo,$valor){
	$campos_formatos=busca_filtro_tabla("valor","campos_formato A","A.formato_idformato=".$idformato." AND A.nombre='".$nombre_campo."'","",$conn);
	$datos=explode(";",$campos_formatos[0]["valor"]);
	$cant=count($datos);
	$arreglo=array();
	
	$seleccionados=explode(",",$valor);
	$cadena=array();
	for($i=0;$i<$cant;$i++){
		$datos2=explode(",",$datos[$i]);
		$arreglo[$datos2[0]]=$datos2[1];
		if(in_array($datos2[0],$seleccionados)){
			$cadena[]=$datos2[1];
		}
	}
	return(implode(", ",$cadena));
}
function tipo_acopio_funcion($idformato,$iddoc){
	global $ruta_db_superior;
	$datos_documento=busca_filtro_tabla("","ft_acopio A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddoc,"",$conn);
	echo(parsear_campos_valores_acopio2($datos_documento[0]["tipo_acopio"]));
}
function parsear_campos_valores_acopio2($valor){
	$datos=busca_filtro_tabla("","serie A","A.idserie in(".$valor.")","",$conn);
	$cadena_array=extrae_campo($datos,"nombre");
	return(ucwords(strtolower(implode(", ",$cadena_array))));
}
?>