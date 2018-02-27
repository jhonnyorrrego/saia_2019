<?php 
function menu_principal_formatos($idformato){
	global $ruta_db_superior;
	$texto='';
	$texto.='<div class="btn btn-mini btn-info kenlace_saia_propio" enlace="'.$ruta_db_superior.'formatos/formatoadd.php" conector="iframe" titulo="Adicionar formato" id="fomatoadd">Adicionar</div>';
	$texto.='<div class="btn btn-mini btn-info kenlace_saia" enlace="webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1" conector="iframe" titulo="Exportar/Importar formato" id="fomatoadd">Exp/Imp</div>';
	return($texto);
}
?>