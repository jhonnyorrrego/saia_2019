<?php
function acciones_anulaciones($iddoc){
	global $conn;
	$texto='';
	$texto.='<div class="btn-group" >';
	$texto.='<button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" onClick=" " enlace="solicitar_anulacion.php?accion=anular&key='.$iddoc.'" titulo="" conector="iframe" idregistro="'.$iddoc.'"ancho_columna="470" eliminar_hijos_kaiten="1">
    Anular
  </button>';
  $texto.='<button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" onClick=" " enlace="solicitar_anulacion.php?accion=rechazar&key='.$iddoc.'" titulo="" conector="iframe" idregistro="'.$iddoc.'"ancho_columna="470" eliminar_hijos_kaiten="1">
    Rechazar
  </button>';
  $texto.='</div>';
  return($texto);
}
function estado_anulacion($iddoc){
	global $conn;
	$estado=busca_filtro_tabla("","documento_anulacion a","documento_iddocumento=".$iddoc,"",$conn);
	$texto='';
	if($estado[0]["estado"]=='ANULADO'){
		$texto.=' <span style="color:#C33B34">('.$estado[0]["estado"].')</span>';
	}
	else if($estado[0]["estado"]=='RECHAZADO'){
		$texto.=' <span style="color:#52A552">('.$estado[0]["estado"].')</span>';
	}
	return($texto);
}
?>