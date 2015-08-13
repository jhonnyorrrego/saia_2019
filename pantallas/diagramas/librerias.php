<?php
function barra_superior_diagramas($id){
global $conn;
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar flujo" enlace="workflow/index.php?diagramId='.$id.'" conector="iframe"><i class="icon-wrench"></i></button>

<button type="button" class="btn btn-mini eliminar_modulo tooltip_saia" titulo="Eliminar flujo" id="'.$id.'"><i class="icon-trash"></i></button>

</div>';
return(($texto));
}
?>