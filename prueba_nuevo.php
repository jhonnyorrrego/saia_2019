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


function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$id;

if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion",limpiar_cadena_sql("etiqueta").",nombre",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"nombre ASC",$conn);

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {$hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
   $hijos_seleccionados = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"]." and idmodulo in(".implode(',',$seleccionado).")","",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    echo "text=\"".htmlspecialchars(($papas[$i]["etiqueta"]))." (".$papas[$i]["nombre"].") \" ";
    if(isset($_REQUEST["filtro_perfil"]))
      {
       if(in_array($papas[$i]["idmodulo"],$seleccionado)!==false)
          {if(!$hijos[0][0]) //si no tiene hijos
             echo ' opcion="quitar" im0="green.gif" im1="green.gif" im2="green.gif " ';         
           elseif($hijos_seleccionados[0][0]==$hijos[0][0]) //si todos los hijos estan seleccionados
              echo ' opcion="quitar" im0="green.gif" im1="green.gif" im2="green.gif " ';
           elseif($hijos_seleccionados[0][0])  //si solo algunos est�n seleccionados
             echo ' opcion="adicionar" im0="blue.gif" im1="blue.gif" im2="blue.gif " ';
           else //si no hay hijos seleccionados
             echo ' opcion="adicionar" im0="red.gif" im1="red.gif" im2="red.gif " ';           
          } 
       elseif($hijos_seleccionados[0][0])  //si solo algunos est�n seleccionados
         echo ' opcion="adicionar" im0="blue.gif" im1="blue.gif" im2="blue.gif " ';
       else
         echo ' opcion="adicionar" im0="red.gif" im1="red.gif" im2="red.gif " '; 
      }

    echo " id=\"".$papas[$i]["idmodulo"]."\"";
    if(in_array($papas[$i]["idmodulo"],$seleccionado)!==false)
      echo " checked=\"1\" ";
        
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    llena_serie($papas[$i]["id$tabla"]);
    echo("</item>\n");
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