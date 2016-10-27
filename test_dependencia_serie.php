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
include_once($ruta_db_superior . "class.funcionarios.php");

//captura request
$tabla ="dependencia";
$id = @$_REQUEST["id"];


//estado
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}

//seleccionado
if(isset($_REQUEST["seleccionado"])){
    $seleccionado=explode(",",$_REQUEST["seleccionado"]);
}else{
    $seleccionado=array();
}

//excluidos  
if(@$_REQUEST["excluidos"]){
	$excluidos=" and id".$tabla." not in(".$_REQUEST["excluidos"].") ";
}


//codificacion arbol
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");


$mostrar_nodos=array('dsa'=>1,'ssa'=>1,'soc'=>1); //dsa: dependencia serie asignadas - ssa: series sin asignar   - soc: series otras categorias  
if(@$_REQUEST['mostrar_nodos']){
    $mostrar_nodos=array('dsa'=>0,'ssa'=>0,'soc'=>0); 
    $request_nodos=explode(',',$_REQUEST['mostrar_nodos']);    
    
    for($i=0;$i<count($request_nodos);$i++){
        $mostrar_nodos[ $request_nodos[$i] ] = 1;
    }
}


//$_REQUEST['funcionario']=1   //muestra las series segun funcionario logueado
$lista_series_funcionario='';
if(@$_REQUEST['funcionario']){
    $idfuncionario=usuario_actual("idfuncionario"); 
    $datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
    $lista_series_funcionario= "'".implode("','",$datos_admin_funcionario["series"])."'"; 
    global $lista_series_funcionario;
}


//si llega el request para cargar por partes
if($id and $id<>"" && @$_REQUEST["uid"]){
    echo("<tree id=\"".$id."\">\n");
  
    if($id[0]=='d' && $mostrar_nodos['dsa']){ //si es dependencia
        $ids=explode('d',$id);
        llena_dependencia($ids[1]);
    }else if($mostrar_nodos['soc']){ //si es serie otras categorias
        $ids=explode('-',$id);
        llena_serie_otras($ids[0]," and categoria=3 ");
    }
    echo("</tree>\n");
    die();
} 



//carga inicial arbol
echo("<tree id=\"0\">\n");  
if($id and $id<>"" && $mostrar_nodos['dsa']){ //si se va a filtrar una dependencia especifica
    llena_dependencia($id); 
}
elseif($mostrar_nodos['dsa']){ //si se va a cargar todo el arbol dependencia/serie
    llena_dependencia("NULL");
}

//NODO:  ssa: series sin asignar 
if($mostrar_nodos['ssa']){
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Series sin asignar\" id=\"-1\" child=\"1\">");
    series_sin_asignar();
    echo("</item>");    
}

//NODO:   soc: series otras categorias 
if($mostrar_nodos['soc']){    
    echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" >\n"; 
    llena_serie_otras("NULL"," and categoria=3 ");
    echo "</item>\n";	  
}

echo("</tree>\n");
//FIN ARBOL


$activo = "";

 
//arbol de dependencias (dsa)
function llena_dependencia($serie,$condicion=""){
global $conn,$seleccionado,$activo,$excluidos,$lista_series_funcionario;

$tabla="dependencia";
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
    
    $condicion_series_funcionario='';
    if($lista_series_funcionario!=''){
        $condicion_series_funcionario=" AND llave_entidad NOT IN(".$lista_series_funcionario.")";
    }
    
    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$papas[$i]["id$tabla"].$condicion_series_funcionario,"",$conn);
    
    echo("<item style=\"font-family:verdana; font-size:7pt;color:blue;\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
	
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"d".$papas[$i]["id$tabla"]."\"");
	if(@$_REQUEST["arbol_series"]){		
				
	}		
	else if($hijos[0]["cant"]!=0 && (@$_REQUEST["sin_padre"]) ){		
      echo(" nocheckbox=\"1\" ");		
	}
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false){
        echo " checked=\"1\" ";  
    }
      
    if($hijos[0][0] || $hijos_entidad_serie['numcampos']){
        echo(" child=\"1\">\n");
    }else{
        echo(" child=\"0\">\n");
    }
    
    if(@$_REQUEST['uid']){
    	if(!$_REQUEST["id"]){
    	    llena_dependencia($papas[$i]["id$tabla"]);
    	}else{
    		if(!$_REQUEST["admin"]){
    			llena_dependencia($papas[$i]["id$tabla"]);
    		}
    	}        
    }
    
    echo("</item>\n");
  }     
}
if(@$_REQUEST['uid'] || @$_REQUEST['id']){
    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$serie,"",$conn);
    if($hijos_entidad_serie['numcampos']){
        llena_entidad_serie($serie,implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie')));
    }
}



return;
}

//llena series asignadas segun dependencia  (dsa)
function llena_entidad_serie($iddependencia,$series){
    global $conn,$lista_series_funcionario;
    
    
    
    $condicion_final="idserie IN(".$series.")";
    if($lista_series_funcionario!=''){
        $condicion_final=" AND idserie NOT IN(".$lista_series_funcionario.")";
    }
    
    $series=busca_filtro_tabla("nombre,idserie,codigo","serie",$condicion_final,"",$conn);
    print_r($series);
    for($i=0;$i<$series['numcampos'];$i++){
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".htmlspecialchars(($series[$i]["nombre"])).' ('.$series[$i]['codigo'].') '." \" id=\"d".$iddependencia."-".$series[$i]['idserie']."\"");
        echo(" nocheckbox=\"1\" ");	
        echo(" child=\"0\">\n");
        echo("</item>\n");
    }
}


//SERIES SIN ASIGNAR (ssa)
function series_sin_asignar(){
	global $conn,$activo;
	$series=busca_filtro_tabla("","serie a left join entidad_serie b ON a.idserie=b.serie_idserie AND b.entidad_identidad =2","b.serie_idserie IS NULL AND a.categoria<>3".$activo,"nombre asc",$conn);
	for($i=0;$i<$series["numcampos"];$i++){
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"d"."-".$series[$i]["idserie"]."\" child=\"0\">\n");
		echo("</item>\n");
	}
}



//SERIES OTRAS CATEGORIAS (soc)
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
