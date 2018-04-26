<?php
function menu_principal_formatos($idformato) {
	global $ruta_db_superior;
	$texto = '<li class="divider-vertical"></li> <li><button class="btn btn-mini btn-info" href="' . $ruta_db_superior . 'formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar">Publicar Todos</button></li>';
	return ($texto);
}
?>