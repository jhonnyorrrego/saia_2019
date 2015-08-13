<?php
function barra_superior_modulo($idmodulo){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar modulo" enlace="moduloadd.php?key='.$idmodulo.'&accion=editar" conector="iframe"><i class="icon-wrench"></i></button>

<!--button type="button" class="btn btn-mini eliminar_modulo tooltip_saia" titulo="Eliminar modulo" id="'.$idmodulo.'"><i class="icon-trash"></i></button-->

<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar modulo" idregistro="'.$idmodulo.'"><i class="icon-download"></i></button>

<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idmodulo.'" titulo="Deseleccionar modulo"><i class="icon-edit"></i></button>

</div>';
return(($texto));
}
function nombre_padre($idpadre){
	global $conn;
	$nombre=busca_filtro_tabla("","modulo","idmodulo=".$idpadre,"",$conn);
	return ($nombre[0]["nombre"]);
}
?>