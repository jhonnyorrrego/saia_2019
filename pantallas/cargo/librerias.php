<?php
function barra_superior_cargo($idcargo){

$texto='<div class="btn-group barra_superior">

<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" enlace="cargo.php?key='.$idcargo.'" titulo="Datos cargo" conector="iframe"><i class="icon-signal"></i></button>

<button type="button" class="btn btn-mini tooltip_saia" titulo="Seleccionar cargo"><i class="adicionar_seleccionados icon-download" idregistro="'.$idcargo.'" ></i></button>

<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idcargo.'" titulo="Deseleccionar cargo"><i class="icon-edit"></i></button>

<button type="button" class="btn btn-mini tooltip_saia" titulo="Configurar cargo"><i class="icon-wrench"></i></button></div>';

return(($texto));

}

?>