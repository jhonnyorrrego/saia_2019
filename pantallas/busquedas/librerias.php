<?php
function barra_superior_componente($idcomponente){
$texto='<div class="btn-group barra_superior">

<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar configuracion" idregistro="'.$idcomponente.'"><i class="icon-download"></i></button>

<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idcomponente.'" titulo="Deseleccionar configuracion"><i class="icon-edit"></i></button>

</div>';
return(addslashes($texto));
}
function mostrar_consulta($campos,$llave,$tablas,$campos_adicionales,$tablas_adicionales,$ordenado_por,$agrupado_por,$idcomponente,$idbusqueda){
	global $conn;
	$where=busca_filtro_tabla("","busqueda_condicion A","fk_busqueda_componente=".$idcomponente." OR busqueda_idbusqueda=".$idbusqueda,"",$conn);
	if($where["numcampos"]){
		$wher='<b>WHERE</b><br>'.$where[0]["codigo_where"].'<br>';
	}
	if($ordenado_por!='ordenado_por'){
		$ordenador_po='<b>ORDER BY</b><br>'.$ordenado_por.'<br>';
	}
	if($agrupado_por!='agrupado_por'){
		$agrupado_po='<b>GROUP BY</b><br>'.$agrupado_por.'<br>';
	}
	$texto=('<b>SELECT</b><br>'.$campos.','.$llave.'<br><b>FROM</b><br>'.$tablas.','.$tablas_adicionales.'<br>'.$wher.$ordenador_po.$agrupado_po);
	
	return str_replace(",tablas_adicionales","",$texto);
}
?>