<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include('db.php');
include_once("librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

 llena_serie(64,'modulo');

function llena_serie($serie,$tabla){
global $conn;
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie,"nombre ASC",$conn);

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {$hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
   $hijos_seleccionados = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"]." and idmodulo in(".implode(',',$seleccionado).")","",$conn);
   
    echo htmlspecialchars(($papas[$i]["etiqueta"]))." (".$papas[$i]["nombre"].") (".$papas[$i]["idmodulo"].") ";

    if($hijos[0][0])
      echo("<br>&nbsp;&nbsp; -");
    else
      echo("<br>");
    llena_serie($papas[$i]["id$tabla"],'modulo');
  }     
}
return;
}




die();

$formatos=busca_filtro_tabla("idformato,etiqueta","formato","cod_padre IS NULL OR cod_padre='' ","etiqueta ASC",$conn);

for($i=0;$i<$formatos['numcampos'];$i++){
	echo('<p><strong>'.($i+1).') '.ucwords(strtolower($formatos[$i]['etiqueta'])).' ('.$formatos[$i]['idformato'].')</strong></p>');
	$hijos=tiene_hijos($formatos[$i]['idformato']);
	if($hijos['hijos']){
		$lista_hijos=lista_hijos($hijos['cuales']);
	}
	//print_r($hijos);
	
	
}
function tiene_hijos($idformato){
	global $conn;

	$hijos=busca_filtro_tabla("idformato","formato","cod_padre=".$idformato,"",$conn);
	
	$retorno=array();
	$retorno['hijos']=0;
	if($hijos['numcampos']){
		$retorno['hijos']=1;
		$retorno['cuales']=implode(',',extrae_campo($hijos,'idformato'));
	}
	return($retorno);
}
function lista_hijos($cuales){
	global $conn;
	
	$hijos=busca_filtro_tabla("etiqueta,idformato","formato","idformato IN(".$cuales.")","etiqueta ASC",$conn);
	if($hijos['numcampos']){
		for($i=0;$i<$hijos['numcampos'];$i++){
			echo('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - '.ucwords(strtolower($hijos[$i]['etiqueta'])).' ('.$hijos[$i]['idformato'].')<br/>');
		}
	}
}



?>