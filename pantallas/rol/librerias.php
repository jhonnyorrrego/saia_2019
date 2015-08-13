<?php 
function barra_superior_rol($iddependencia_cargo){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" enlace="dependencia_cargoview.php?key='.$iddependencia_cargo.'" titulo="Ver informaci&oacute;n del rol" conector="iframe"><i class="icon-signal"></i></button>

<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar rol" enlace="dependencia_cargoedit.php?key='.$iddependencia_cargo.'" conector="iframe"><i class="icon-wrench"></i></button>

<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Eliminar rol" enlace="dependencia_cargodelete.php?key='.$iddependencia_cargo.'" conector="iframe"><i class="icon-trash"></i></button>

<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar rol" idregistro="'.$iddependencia_cargo.'"><i class="icon-download"></i></button>

<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$iddependencia_cargo.'" titulo="Quitar seleccion rol"><i class="icon-edit"></i></button>

</div>
';

return($texto); 
}
?>