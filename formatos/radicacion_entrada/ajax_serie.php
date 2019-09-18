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

include_once($ruta_db_superior."core/autoload.php");
$retorno[]=array();
if($_REQUEST['iddependencia']){
    $retorno[]= $_REQUEST['iddependencia'];
    buscar_dependencias_principal($_REQUEST['iddependencia']);
    $retorno=array_filter($retorno);
    echo(json_encode(array_reverse($retorno)));
}elseif ($_REQUEST['rol']) {
    busca_primeros_hijos($_REQUEST['rol']);
    echo(json_encode($retorno));
}
function buscar_dependencias_principal($iddependencia){
    global $retorno;
	$cod_dep=busca_filtro_tabla("cod_padre","dependencia","iddependencia=".$iddependencia,"");

	if(!$cod_dep['numcampos']){
		return(true);
	}else{
	    $retorno[]=$cod_dep[0]["cod_padre"];
		$dep=buscar_dependencias_principal($cod_dep[0]["cod_padre"]);
		return($dep);
	}
}
function busca_primeros_hijos($rol){
    global $retorno;
    $busca_hijos=busca_filtro_tabla("iddependencia ","vfuncionario_dc","a.iddependencia_cargo=".$rol,"");
    for ($i = 0; $i < $busca_hijos['numcampos']; $i++) {
         $retorno[]=$busca_hijos[$i]['iddependencia'];
    }
}
?>