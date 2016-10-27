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
  
    if($id[0]=='d'){
        $ids=explode('d',$id);
        llena_serie($ids[1]);
    }else{
        $ids=explode('-',$id);
        llena_serie_otras($ids[0]," and categoria=3 ");
    }
    echo("</tree>\n");
    die();
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



echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Series sin asignar\" id=\"-1\" child=\"1\">");
series_sin_asignar();
echo("</item>");



echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie_otras("NULL"," and categoria=3 ");
echo "</item>\n";	  

echo("</tree>\n");
$activo = "";
?>
<?php

function series_sin_asignar(){
	global $conn;
	$series=busca_filtro_tabla("","serie a left join entidad_serie b ON a.idserie=b.serie_idserie AND b.entidad_identidad =2","b.serie_idserie IS NULL AND a.categoria<>3","nombre asc",$conn);
	for($i=0;$i<$series["numcampos"];$i++){
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"d"."-".$series[$i]["idserie"]."\" child=\"0\">\n");
		echo("</item>\n");
	}
} 

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


if(@$_REQUEST['uid']){
$hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$serie,"",$conn);
if($hijos_entidad_serie['numcampos']){
    llena_entidad_serie($serie,implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie')));
}
}

if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$papas[$i]["id$tabla"],"",$conn);
    
    echo("<item style=\"font-family:verdana; font-size:7pt;color:blue;\" ");
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
	
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"d".$papas[$i]["id$tabla"]."\"");
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
    
    if(@$_REQUEST['uid']){
    	if(!$_REQUEST["id"]){
    	    llena_serie($papas[$i]["id$tabla"]);
    	}else{
    		if(!$_REQUEST["admin"]){
    			llena_serie($papas[$i]["id$tabla"]);
    		}
    	}        
    }
    
    echo("</item>\n");
  }     
}
return;
}


function llena_entidad_serie($iddependencia,$series){
    global $conn;
    
    $series=busca_filtro_tabla("nombre,idserie,codigo","serie","idserie IN(".$series.")","",$conn);
    for($i=0;$i<$series['numcampos'];$i++){
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".htmlspecialchars(($series[$i]["nombre"])).' ('.$series[$i]['codigo'].') '." \" id=\"d".$iddependencia."-".$series[$i]['idserie']."\"");
        echo(" nocheckbox=\"1\" ");	
        echo(" child=\"0\">\n");
        echo("</item>\n");
    }
}


function llena_serie_otras($serie,$condicion=""){
global $conn,$seleccionado,$activo,$excluidos;

$tabla_otra = 'serie';
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="nombre";
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla_otra,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion $excluidos","$orden ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla_otra,"cod_padre=".$serie.$activo.$condicion.$excluidos,"$orden ASC",$conn); 




if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla_otra,"cod_padre=".$papas[$i]["id$tabla_otra"].$activo.$condicion,"",$conn);
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
	
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"".$papas[$i]["id$tabla_otra"]."-".$papas[$i]["id$tabla_otra"]."\"");
		if(@$_REQUEST["arbol_series"]){		
				
	}		
	else if($hijos[0]["cant"]!=0 && ($tabla_otra=="serie" || @$_REQUEST["sin_padre"])){		
      echo(" nocheckbox=\"1\" ");		
	}
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
		if(!$_REQUEST["id_otra"] && $tabla_otra!='serie')
    	llena_serie_otras($papas[$i]["id$tabla_otra"]);
		else{
			if(!$_REQUEST["admin"]){
				llena_serie_otras($papas[$i]["id$tabla_otra"]);
			}
		}
    echo("</item>\n");
  }     
}
return;
}

?>
