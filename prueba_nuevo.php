<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");



$formatos=busca_filtro_tabla("nombre,etiqueta","formato","","",$conn);

$cod_padre_crear=1006;
$cod_padre_ver=236;

$vector_modulos_crear=array();
$vector_modulos_ver=array();
$cadena='';
for($i=0;$i<$formatos['numcampos'];$i++){
	
	//VALIDA CREAR
	$modulo_crear=busca_filtro_tabla("idmodulo","modulo","cod_padre=".$cod_padre_crear." AND nombre='crear_".$formatos[$i]['nombre']."'","",$conn);
	if($modulo_crear['numcampos']){
		$sql=" UPDATE modulo SET etiqueta='Crear ".$formatos[$i]['etiqueta']."' WHERE idmodulo=".$modulo_crear[0]['idmodulo'];
		$cadena.=($sql.";\n");
		$vector_modulos_crear[]=$modulo_crear[0]['idmodulo'];
	}
	
	//VALIDA VER
	$modulo_ver=busca_filtro_tabla("idmodulo","modulo","cod_padre=".$cod_padre_ver." AND nombre='".$formatos[$i]['nombre']."'","",$conn);
	if($modulo_ver['numcampos']){
		$sql=" UPDATE modulo SET etiqueta='".$formatos[$i]['etiqueta']."' WHERE idmodulo=".$modulo_ver[0]['idmodulo'];
		$cadena.=($sql.";\n");
		$vector_modulos_ver[]=$modulo_ver[0]['idmodulo'];
	}	
		
}

//ELIMINACION MODULOS CREAR BASURA
if(count($vector_modulos_crear)){
	$sql="DELETE FROM modulo WHERE cod_padre=".$cod_padre_crear." AND idmodulo NOT IN(".implode(',',$vector_modulos_crear).")";
	$cadena.=($sql.";\n");
}

//ELIMINACION MODULOS VER BASURA
if(count($vector_modulos_ver)){
	$sql="DELETE FROM modulo WHERE cod_padre=".$cod_padre_ver." AND idmodulo NOT IN(".implode(',',$vector_modulos_ver).")";
	$cadena.=($sql.";\n");
}
echo("<pre>".$cadena."</pre>");

?>