<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = @$_REQUEST["tabla"];
$id = @$_REQUEST["id"];
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!=""){
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array();  

if(stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")){ 
  header("Content-type: application/xhtml+xml"); 
} 
else{
  header("Content-type: text/xml"); 
}
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}

include_once($ruta_db_superior."db.php");

echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($id and $id<>"" && @$_REQUEST["uid"] && $id!=-1){
	$parseo=explode("-",$id);
	$dep=str_replace("d","",$parseo[0]);
	
	$series_disponibles=busca_filtro_tabla("serie_idserie","entidad_serie a","a.entidad_identidad='2' and a.llave_entidad='".$dep."' and a.estado='1'","",$conn);
	if(!$series_disponibles['numcampos']){
		$series_dispon=array();
		$dep=0;
	}else{
		$series_dispon=extrae_campo($series_disponibles,"serie_idserie");		
	}
	
  echo("<tree id=\"".$id."\">\n");
	llenar_hijos_series($parseo[1],$dep,$series_dispon);
	echo("</tree>\n");
	die();
}else if($id==-1){
	echo("<tree id=\"".$id."\">\n");
	series_sin_asignar();
	echo("</tree>\n");
	die();
}
else
  echo("<tree id=\"0\">\n");




if($_REQUEST['dependencia']){
    //$condicion="O iddependencia=".$_REQUEST['dependencia'];
    llena_serie("NULL");
}else{
    
llena_serie("NULL");

echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Series sin asignar\" id=\"-1\" child=\"1\">");
//series_sin_asignar();
echo("</item>");



$tabla_otra = 'serie';
echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
       llena_serie_otras("NULL"," and categoria=3 ");
echo "</item>\n";	
}
echo("</tree>\n");
$activo = "";
?>
<?php

function llena_serie($serie,$condicion=""){
global $conn,$tabla,$seleccionado,$activo;
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="nombre";
if($serie=="NULL"){
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion","$orden ASC",$conn);
  
}else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion,"$orden ASC",$conn); 

if($papas["numcampos"]){
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    print_r($hijos);
    echo("<item style=\"font-family:verdana; font-size:7pt;color:blue\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
    
	if($tabla=="serie"){
		echo("text=\"".htmlspecialchars($papas[$i]["nombre"]).$cadena_codigo." \" id=\"d".$papas[$i]["id$tabla"].'-'.$papas[$i]["id$tabla"]."\"");
	}else{
		echo("text=\"".htmlspecialchars($papas[$i]["nombre"]).$cadena_codigo." \" id=\"d".$papas[$i]["id$tabla"]."\"");
	}    
    
    if($hijos[0]["cant"]!=0 && ($tabla=="serie" || @$_REQUEST["sin_padre"]))
      echo(" nocheckbox=\"1\" "); 
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
      echo " checked=\"1\" ";  
    if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
    if(!$_REQUEST["id"] && $tabla!='dependencia'){
    	llena_serie($papas[$i]["id$tabla"]);
		}else{
			//if(!$_REQUEST["admin"]){
				llena_series_asignadas($papas[$i]["id$tabla"]);
			//}
		}
    echo("</item>\n");
  }     
}
return;
}
function llena_series_asignadas($id){
	global $conn;
	$series_disponibles=busca_filtro_tabla("serie_idserie","entidad_serie a","a.entidad_identidad='2' and a.llave_entidad='".$id."' and a.estado='1'","",$conn);
	$series_dispon=extrae_campo($series_disponibles,"serie_idserie");
	
	$series=busca_filtro_tabla("","entidad_serie a, serie b","a.entidad_identidad='2' and a.llave_entidad='".$id."' and a.serie_idserie=b.idserie and (b.cod_padre is null or b.cod_padre=0) and a.estado='1'","",$conn);
	
	if($series["numcampos"]){
		for($i=0;$i<$series["numcampos"];$i++){
			$hijos = busca_filtro_tabla("count(*) AS cant","serie","cod_padre=".$series[$i]["idserie"],"",$conn);
			echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"d".$id."-".$series[$i]["idserie"]."\"");
			if($hijos[0][0])
	      echo(" child=\"1\">\n");
	    else
	      echo(" child=\"0\">\n");
			if($hijos[0][0]){
				//llenar_hijos_series($series[$i]["idserie"],$id,$series_dispon);
			}
			echo("</item>\n");
		}
	}
}
function llenar_hijos_series($id,$dep,$series_dispon){
	global $conn;
	if(count($series_dispon)){
		$series=busca_filtro_tabla("","serie a","a.cod_padre=".$id." and a.idserie in(".implode(",",$series_dispon).")","",$conn);		
	}else{
		$series=busca_filtro_tabla("","serie a","a.cod_padre=".$id."","",$conn);	
	}

	for($i=0;$i<$series["numcampos"];$i++){
		$hijos = busca_filtro_tabla("count(*) AS cant","serie","cod_padre=".$series[$i]["idserie"],"",$conn);
		
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"d".$dep."-".$series[$i]["idserie"]."\"");
		if($hijos[0][0])
      echo(" child=\"1\">\n");
    else
      echo(" child=\"0\">\n");
		if($hijos[0][0]){
			llenar_hijos_series($series[$i]["idserie"],$dep,$series_dispon);
		}
		echo("</item>\n");
	}
}
function series_sin_asignar(){
	global $conn;
	$series=busca_filtro_tabla("","serie a left join entidad_serie b ON a.idserie=b.serie_idserie AND b.entidad_identidad =2","b.serie_idserie IS NULL","nombre asc",$conn);
	for($i=0;$i<$series["numcampos"];$i++){
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"d"."-".$series[$i]["idserie"]."\" child=\"0\">\n");
		echo("</item>\n");
	}
} 

function llena_serie_otras($serie,$condicion=""){
global $conn,$tabla_otra,$seleccionado,$activo,$excluidos;
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