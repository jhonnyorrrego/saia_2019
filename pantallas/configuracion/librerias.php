<?php
function barra_superior_configuracion($idconfiguracion){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar configuracion" enlace="configuracionedit.php?key='.$idconfiguracion.'&accion=editar" conector="iframe"><i class="icon-wrench"></i></button>

<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Eliminar configuracion" enlace="configuraciondelete.php?key='.$idconfiguracion.'" conector="iframe"><i class="icon-trash"></i></button>

<!-- button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar configuracion" idregistro="'.$idconfiguracion.'"><i class="icon-download"></i></button>

<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idconfiguracion.'" titulo="Deseleccionar configuracion"><i class="icon-edit"></i></button -->

</div>';
return(($texto));
}
function mostrar_valor_configuracion_encrypt($valor,$encrypt){
	
	if($encrypt=='encrypt'){
		$encrypt=0;
	}
	if($encrypt){
		return('Valor encriptado!');
	}else{
		return($valor);
	}
}
?>