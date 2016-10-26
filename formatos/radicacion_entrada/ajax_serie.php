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
$retorno[]= $_REQUEST['iddependencia'];
buscar_dependencias_principal($_REQUEST['iddependencia']);
echo(json_encode($retorno));
echo(json_encode(array_reverse($retorno)));
function buscar_dependencias_principal($iddependencia){
    global $retorno;
	$cod_dep=busca_filtro_tabla("cod_padre","dependencia","iddependencia=".$iddependencia,"",$conn);

	if(!$cod_dep['numcampos']){
		return(true);
	}else{
	    $retorno[]=$cod_dep[0]["cod_padre"];
		$dep=buscar_dependencias_principal($cod_dep[0]["cod_padre"]);
		return($dep);
	}
}
?>