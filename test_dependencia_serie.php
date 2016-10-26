<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
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
$tabla = @$_REQUEST["tabla"];
$id = @$_REQUEST["id"];
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array();
if(@$_REQUEST["excluidos"]){
	$excluidos=" and id".$tabla." not in(".$_REQUEST["excluidos"].") ";
}
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>"" && @$_REQUEST["uid"]){
  echo("<tree id=\"".$id."\">\n");
	llena_serie($id);
	echo("</tree>\n");
	die();
  $dato_papa=busca_filtro_tabla("",$tabla,"id".$tabla."=".$id,"",$conn);

  if(@$_REQUEST["cargar_dato_padre"]){
    if($dato_papa["numcampos"]){
       echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
      $cadena_codigo='';
      if(@$dato_papa[0]["codigo"]){
        $cadena_codigo="(".$dato_papa[0]["codigo"].")";
      }
      echo("text=\"".htmlspecialchars($dato_papa[0]["nombre"]).$cadena_codigo." \" id=\"".$dato_papa[0]["id".$tabla]."\">");
    }
  }
} 
else
  echo("<tree id=\"0\">\n");  

 
if($id and $id<>""){ 
  llena_serie($id); 
  if(@$_REQUEST["cargar_dato_padre"] && $dato_papa["numcampos"]){
    echo("</item>\n");
  } 
}
else{
    llena_serie("NULL");
}
  

echo("</tree>\n");
$activo = "";
?>
<?php

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo,$excluidos;
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="nombre";
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion $excluidos","$orden ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion.$excluidos,"$orden ASC",$conn); 

if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$papas[$i]["id$tabla"],"",$conn);
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
	
		if($tabla=="serie"){
			if(@$papas[$i]["estado"]==1){
				$estado_serie=' - ACTIVA';	
			}else{
				$estado_serie=' - INACTIVA';				
			}
		}	
	
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"".$papas[$i]["id$tabla"]."\"");
		if(@$_REQUEST["arbol_series"]){		
				
	}		
	else if($hijos[0]["cant"]!=0 && ($tabla=="serie" || @$_REQUEST["sin_padre"])){		
      echo(" nocheckbox=\"1\" ");		
	}
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false){
        echo " checked=\"1\" ";  
    }
      
    if($hijos[0][0]){
        echo(" child=\"1\">\n");
    }elseif($hijos_entidad_serie['numcampos']){
        echo(" child=\"1\">\n");
    }else{
        echo(" child=\"0\">\n");
    }
    
    if($hijos_entidad_serie['numcampos']){
        llena_entidad_serie(implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie')));
    }
    
      
	if(!$_REQUEST["id"] && $tabla!='serie'){
	    llena_serie($papas[$i]["id$tabla"]);
	}else{
		if(!$_REQUEST["admin"]){
			llena_serie($papas[$i]["id$tabla"]);
		}
	}
    echo("</item>\n");
  }     
}
return;
}


function llena_entidad_serie($series){
    global $conn;
    
    $series=busca_filtro_tabla("nombre,idserie","serie","idserie IN(".$series.")","",$conn);
    for($i=0;$i<$series['numcampos'];$i++){
         echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
          echo("text=\"".htmlspecialchars(($series[$i]["nombre"])).' (SERIE) '." \" id=\"".$series[$i]['idserie']."\"");
           echo(" nocheckbox=\"1\" ");	
            echo(" child=\"0\">\n");
             echo("</item>\n");
    }
}
?>
