<?php
include_once("db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 


function numero_cambio($iddocumento){
	
	$radicado=busca_filtro_tabla("numero","documento","iddocumento=".$iddocumento,"",$conn);
	$numero=$radicado[0]["numero"];
	
	if($numero!=0 || $numero!='numero'){
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.$numero.'</span></center></div>');
	}else{
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado 0"><center><span class="badge">0</span></center></div>');
	}
}

function funcionario_nombre($codigo){	
	$nombref=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$codigo,"",$conn);
	return($nombref[0]["nombres"]." ".$nombref[0]["apellidos"]);
}

function etiqueta_formato($formato){	
	$nombre=str_replace("ft_","",$formato);
	$etiqueta=busca_filtro_tabla("etiqueta","formato","nombre='".$nombre."'","",$conn);
	return($etiqueta[0]["etiqueta"]);
	
}


function fecha_completa($fecha){
	return($fecha);
}


function proceso_documento($codigosql){
	
	$codigosql=strtolower($codigosql);
	$iddoc=explode("documento_iddocumento=",$codigosql);
	$iddoc=str_replace("'", "", $iddoc);
	$iddoc=str_replace(";", ",", $iddoc);
	$iddoc=explode(",",$iddoc[1]);
	
	$tabla=explode("update ",$codigosql);//no quitar los espacios en blanco
	$tabla=explode(" set",$tabla[1]);	
		
	if($tabla[0]=="ft_riesgos_proceso"){
		$proceso=busca_filtro_tabla("a.nombre","ft_proceso a,ft_riesgos_proceso b","a.idft_proceso=b.ft_proceso and b.documento_iddocumento=".$iddoc[0],"",$conn);
		
		return($proceso[0]["nombre"]);
	}
	else{
	$proceso=busca_filtro_tabla("a.nombre","ft_proceso a,ft_riesgos_proceso b,".$tabla[0]." c","c.ft_riesgos_proceso=b.idft_riesgos_proceso and a.idft_proceso=b.ft_proceso and c.documento_iddocumento=".$iddoc[0],"",$conn);
	
	return($proceso[0]["nombre"]);
	}
	
}

?>