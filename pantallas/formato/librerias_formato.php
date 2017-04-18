<?php
function menu_principal_formatos($idformato){
	global $ruta_db_superior;
	$texto='';
	$texto.='<div class="btn btn-mini btn-info kenlace_saia_propio" enlace="'.$ruta_db_superior.'formatos/formatoadd.php" conector="iframe" titulo="Adicionar formato" id="fomatoadd">Adicionar</div>';
	return($texto);
}
?>