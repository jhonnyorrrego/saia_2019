<?php
function mostrar_fecha_fin_reemplazo($fecha){
	if($fecha!='fecha_fin' &&$fecha!='' && $fecha!='0000-00-00'){
	  return($fecha);
	}else{
	  return(" N/A ");
	}
}
function mostrar_tipo_reemplazo($tipo){
	if($tipo==1){
	  return("Temporal");
	}
	else if($tipo==2){
	  return("Definitivo");
	}
}
function ver_estado_reem($estado){
	if($estado==1){
		$html="ACTIVO";
	}else{
		$html="INACTIVO";
	}
	return($html);
}

function barra_acciones_reemplazos($idreemplazo,$estado){
$idbusqueda_componente=213; //reemplazo_detalle
  $texto.='<div class="btn-group" >';      
  if($idreemplazo){              
    $equivalencia=busca_filtro_tabla("","reemplazo_equivalencia","fk_idreemplazo_saia=".$idreemplazo,"",$conn);
    if($equivalencia["numcampos"] && $estado==1){ //se realiza el reemplazo y esta activo 
      //$texto.='<button type="button" class="btn btn-mini tooltip_saia kenlace_saia" conector="iframe" title="Inactivar Reemplazo"  enlace="pantallas/reemplazos/procesar_reemplazo.php?idreemplazo_saia='.$idreemplazo.'&accion=inactivar_reemplazo&idbusqueda_componente='.$_REQUEST['idbusqueda_componente'].'"><i class="icon-refresh"></i></button>';
      $texto.='<button type="button" class="btn btn-mini tooltip_saia" titulo="Inactivar Reemplazo" onclick="window.open(\'../reemplazos/procesar_reemplazo.php?idreemplazo_saia='.$idreemplazo.'&accion=inactivar_reemplazo&idbusqueda_componente='.$_REQUEST['idbusqueda_componente'].'\',\'_self\')"><i class="icon-refresh"></i></button>';
			
			$texto.='<button type="button" class="btn btn-mini tooltip_saia kenlace_saia" conector="iframe" title="Informaci&oacute;n reemplazo" titulo="Informaci&oacute;n reemplazo" enlace="pantallas/busquedas/consulta_busqueda_reemplazo.php?idbusqueda_componente='.$idbusqueda_componente."&idreemplazo=".$idreemplazo.'"><i class="icon-info-sign"></i></button>';    
    }else if($equivalencia["numcampos"] && $estado==0){ //se realiza el reemplazo y NO esta activo 
    	$texto.='<button type="button" class="btn btn-mini tooltip_saia kenlace_saia" conector="iframe" title="Informaci&oacute;n reemplazo" titulo="Informaci&oacute;n reemplazo" enlace="pantallas/busquedas/consulta_busqueda_reemplazo.php?idbusqueda_componente='.$idbusqueda_componente."&idreemplazo=".$idreemplazo.'"><i class="icon-info-sign"></i></button>';
    }else{
      $texto.='<button type="button" class="btn btn-mini tooltip_saia kenlace_saia" conector="iframe" title="Reemplazar Funcionario" titulo="Reemplazar Funcionario" enlace="pantallas/reemplazos/procesar_reemplazo.php?idreemplazo_saia='.$idreemplazo.'&accion=procesar_reemplazo&idbusqueda_componente='.$idbusqueda_componente.'"><i class="icon-repeat"></i></button>';          
    } 
  } 
  $texto.='</div>';  
	return($texto);
}
function request_reemplazo_saia(){
if($_REQUEST["idreemplazo"]){
  return($_REQUEST["idreemplazo"]);
}
else{
  return(0);
}
}
?>