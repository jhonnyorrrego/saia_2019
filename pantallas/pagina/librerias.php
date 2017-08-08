<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");

require_once($ruta_db_superior . 'StorageUtils.php');
require_once($ruta_db_superior . 'filesystem/SaiaStorage.php');
require($ruta_db_superior . 'vendor/autoload.php');

if($_REQUEST['funcion'] == 'ordenar_paginas_documento'){
	ordenar_paginas_documento($_REQUEST['iddocumento'],$_REQUEST['orden']);	
}

function imagen_pagina_documento($imagen){
    global $ruta_db_superior;
	return StorageUtils::get_binary_file($imagen);
	//return ($ruta_db_superior . $imagen);
}

function ordenar_paginas_documento($iddocumento,$nuevo_orden = ''){
global $conn;		
	if($nuevo_orden!=''){
		$idpaginas = explode(',',$nuevo_orden);	
	}else{
		$nuevas_paginas = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$iddocumento,"pagina ASC",$conn);		
		if($nuevas_paginas['numcampos']){
			$idpaginas = extrae_campo($nuevas_paginas, 'consecutivo');			
		}					
	}	
	for($i=0; $i < sizeof($idpaginas); $i++){
		$sql_updata = "UPDATE pagina SET pagina=".($i+1)." WHERE consecutivo=".$idpaginas[$i]." AND id_documento=".$iddocumento;
		phpmkr_query($sql_updata);					
	}			
}

function eliminar_paginas_documento($paginas){
	global $conn;	
	$idpaginas = explode(',',$paginas);
	$iddocumento = busca_filtro_tabla("id_documento","pagina","consecutivo=".$idpaginas[0],"",$conn);			
	if($iddocumento['numcampos']){
		for($i=0; $i < sizeof($idpaginas); $i++){
			if($idpaginas[$i]){
				$sql_delete = "DELETE FROM pagina WHERE consecutivo=".$idpaginas[$i];						
				phpmkr_query($sql_delete);
			}							
		}		
		ordenar_paginas_documento($iddocumento[0]['id_documento']);		
	}			
}
?>
