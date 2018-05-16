<?php
function menu_principal_formatos($idformato) {
	global $ruta_db_superior;
	$href='formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar';
	$texto = '<li class="divider-vertical"></li> <li><button class="btn btn-mini btn-info kenlace_saia" titulo="Generar Formatos" conector="iframe" enlace="'.$href.'" >Publicar Todos</button></li>';
	return ($texto);
}
?>