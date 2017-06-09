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


$mostrar_nodos=array('dsa'=>1,'dsatvd'=>1,'ssa'=>1,'soc'=>1); //dsa: dependencia serie asignadas - dsatvd: ependencia serie asignadas TVD  - ssa: series sin asignar   - soc: series otras categorias  
if(@$_REQUEST['mostrar_nodos']){
    $mostrar_nodos=array('dsa'=>0,'dsatvd'=>0,'ssa'=>0,'soc'=>0); 
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
    $lista_series_funcionario= implode(",",$datos_admin_funcionario["series"]); 
    global $lista_series_funcionario;
}

$id = @$_REQUEST["id"];

//si llega el request para cargar por partes series,dependencias,etc
if(@$_REQUEST['carga_partes_dependencia']){
    if($id and $id<>"" && @$_REQUEST["uid"]){
        echo("<tree id=\"".$id."\">\n");
      
        if($id[0]=='d' && $mostrar_nodos['dsa']){ //si es dependencia
            $ids=explode('d',$id);
			$mystring = $ids[1];
			$findme   = '_tv';
			$pos = strpos($mystring, $findme);
			if ($pos !== false) {
				$ids[1]=str_replace("_tv", "",$ids[1]);
     			llena_dependencia($ids[1],'',1);
			}else{
				llena_dependencia($ids[1]);	
			}	
        }else if(strpos($id,'sub')!==false && $mostrar_nodos['dsa']){   //si es subserie o tipo documental
            $ids=explode('sub',$id);
			$mystring = $ids[1];
			$findme   = '_tv';
			$pos = strpos($mystring, $findme);
			if ($pos !== false) {
				$ids[1]=str_replace("_tv", "",$ids[1]);
				llena_subseries_tipo_documental($ids[0],$ids[1],1);
			}else{
				llena_subseries_tipo_documental($ids[0],$ids[1]);
			}			
            
        }else if( ( strpos($id,'sin_asignar')!==false || strpos($id,'asignada')!==false) && $mostrar_nodos['ssa']){
        	
			if( strpos($id,'sin_asignar')!==false ){
				$ids=explode('sin_asignar-',$id);
			}else{
				$ids=explode('asignada-',$id);
			}
			series_sin_asignar(intval($ids[1]));
        }else if($mostrar_nodos['soc']){ //si es serie otras categorias
            $ids=explode('-',$id);
            llena_serie_otras($ids[1]," and categoria=3 ");
        }
        echo("</tree>\n");
        die();
    }     
}

//si llega el request para cargar por partes subseries & tipo documental
if(@$_REQUEST['carga_partes_serie']){
    if($id and $id<>"" && @$_REQUEST["uid"]){
        
        if(strpos($id,'sub')!==false && $mostrar_nodos['dsa']){
            echo("<tree id=\"".$id."\">\n");
                $ids=explode('sub',$id);
				$mystring = $ids[1];
				$findme   = '_tv';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
					$ids[1]=str_replace("_tv", "",$ids[1]);
					llena_subseries_tipo_documental($ids[0],$ids[1],1);
				}else{
					llena_subseries_tipo_documental($ids[0],$ids[1]);     
				}				     
            echo("</tree>\n");
            die();            
        }

    }   
}


//cargar series de una dependencia
if(@$_REQUEST['cargar_series'] && @$_REQUEST['iddependencia']){
    $iddependencia=$_REQUEST['iddependencia'];
    $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$iddependencia,"",$conn);
    if($hijos_entidad_serie['numcampos']){
        $lista_entidad_series_filtrar=implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie'));
    }  
    echo("<tree id=\"d".$iddependencia."\">\n"); 
    if($hijos_entidad_serie['numcampos']){
        $tvd=0;
		if(@$_REQUEST['tvd']){
			$tvd=1;
		}    
        llena_entidad_serie($iddependencia,$lista_entidad_series_filtrar,$tvd);
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


//NODO:  dsatvd: ependencia serie asignadas TVD
if($id and $id<>"" && $mostrar_nodos['dsatvd']){ //si se va a filtrar una dependencia especifica
    llena_dependencia($id,'',1); 
}
elseif($mostrar_nodos['dsatvd']){ //si se va a cargar todo el arbol dependencia/serie
    llena_dependencia("NULL",'',1);
}


//NODO:  ssa: series sin asignar 
if($mostrar_nodos['ssa']){
    series_sin_asignar();
}

//NODO:   soc: series otras categorias 
if($mostrar_nodos['soc']){    
    echo  "<item style=\"font-family:verdana; font-size:7pt;\" text=\"Otras categorias\" id=\"3-categoria-Otras categorias\" nocheckbox=\"1\" >\n"; 
    llena_serie_otras("NULL"," and categoria=3 ");
    echo "</item>\n";	  
}

echo("</tree>\n");
//FIN ARBOL


$activo = "";

 
//arbol de dependencias (dsa)
function llena_dependencia($serie,$condicion="",$tvd=0){
global $conn,$seleccionado,$activo,$excluidos,$lista_series_funcionario;

$prefijo_tvd='';
$condicion_tvd=' AND b.tvd=0';
if($tvd){
	$activo='';
	$prefijo_tvd='_tv';
	$condicion_tvd=" AND b.tvd=1";
}

$tabla="dependencia";
if(isset($_REQUEST["orden"]))
  $orden=$_REQUEST["orden"];
else
  $orden="nombre";

$texto_trd_tvd='';
if($serie=="NULL")
  $papas=busca_filtro_tabla("*",$tabla,"(cod_padre IS NULL OR cod_padre=0) $activo $condicion $excluidos","$orden ASC",$conn);
else
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie.$activo.$condicion.$excluidos,"$orden ASC",$conn); 


if($papas["numcampos"]){ 
  for($i=0; $i<$papas["numcampos"]; $i++){
    $hijos = busca_filtro_tabla("count(*) AS cant",$tabla,"cod_padre=".$papas[$i]["id$tabla"].$activo.$condicion,"",$conn);
    
    $hijos_entidad_serie = busca_filtro_tabla("a.serie_idserie","entidad_serie a, serie b","a.serie_idserie=b.idserie AND a.estado=1 AND a.entidad_identidad='2' AND a.llave_entidad=".$papas[$i]["id$tabla"].$condicion_tvd,"",$conn);
    
    if(@$_REQUEST['funionario']){
        $almenos_una_serie=1;
        if( $lista_series_funcionario!='' && $hijos_entidad_serie['numcampos'] ){
            $almenos_una_serie=0;
            $idserie_hijos_entidad_serie=extrae_campo($hijos_entidad_serie,'serie_idserie');
            $idserie_hijos_entidad_serie=array_map('intval',$idserie_hijos_entidad_serie);
            $vector_lista_series_funcionario=explode(',',$lista_series_funcionario);
            $vector_lista_series_funcionario=array_map('intval',$vector_lista_series_funcionario);
            for($h=0;$h<count($idserie_hijos_entidad_serie);$h++){
                if( in_array($idserie_hijos_entidad_serie[$h],$vector_lista_series_funcionario) ){
                   $almenos_una_serie=1; 
                }
            }
        }
        if(!$almenos_una_serie){
            $hijos_entidad_serie['numcampos']=0;
        }  
    }    

    
    echo("<item style=\"font-family:verdana; font-size:7pt;font-weight: 900;\" ");
    $cadena_codigo='';
    if(@$papas[$i]["codigo"]){
      $cadena_codigo="(".$papas[$i]["codigo"].")";
    }
	if($serie=='NULL' && $i==0){
		if($tvd==1){
			$texto_trd_tvd=' - TVD';
		}else{
			$texto_trd_tvd=' - TRD';
		}
		 
	}
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo.$texto_trd_tvd." \" id=\"d".$papas[$i]["id$tabla"].$prefijo_tvd."\"");
if(@$_REQUEST["arbol_series"]){		
				
	}		
	else if(@$_REQUEST["sin_padre_dependencia"]){		
      echo(" nocheckbox=\"1\" ");		
	}
	
    if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false){
        echo " checked=\"1\" ";  
    }
      
      
    if(@$_REQUEST['solo_dependencias']){
        $hijos_entidad_serie['numcampos']=0;
    }  
      
    if(($hijos[0][0] || $hijos_entidad_serie['numcampos'])){
        echo(" child=\"1\">\n");
    }else{
        echo(" child=\"0\">\n");
    }
    if(@$_REQUEST['carga_partes_dependencia']){
        if(@$_REQUEST['uid']){
        	if(!$_REQUEST["id"]){
        	    llena_dependencia($papas[$i]["id$tabla"],'',$tvd);
        	}else{
        		if(!$_REQUEST["admin"]){
        			llena_dependencia($papas[$i]["id$tabla"],'',$tvd);
        		}
        	}        
        }
    }else{
        llena_dependencia($papas[$i]["id$tabla"],'',$tvd);
    }
    
    echo("</item>\n");
  }     
}
if(@$_REQUEST['uid'] || @$_REQUEST['id'] ){
    if($_REQUEST['id']=='d'.$serie.$prefijo_tvd){
        $hijos_entidad_serie = busca_filtro_tabla("a.serie_idserie","entidad_serie a, serie b","a.serie_idserie=b.idserie AND a.estado=1 AND a.entidad_identidad='2' AND a.llave_entidad=".$serie.$condicion_tvd,"",$conn);
        if($hijos_entidad_serie['numcampos']){
            $lista_entidad_series_filtrar=implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie'));
        }
                
        if(@$_REQUEST['funcionario']){
                $almenos_una_serie=1;
                if( $lista_series_funcionario!='' && $hijos_entidad_serie['numcampos'] ){
                    $almenos_una_serie=0;
                    $idserie_hijos_entidad_serie=extrae_campo($hijos_entidad_serie,'serie_idserie');
                    $idserie_hijos_entidad_serie=array_map('intval',$idserie_hijos_entidad_serie);
                    
                    $vector_lista_series_funcionario=explode(',',$lista_series_funcionario);
                    $vector_lista_series_funcionario=array_map('intval',$vector_lista_series_funcionario);
                    $series_para_filtrar=array();
                    for($h=0;$h<count($idserie_hijos_entidad_serie);$h++){
                        if( in_array($idserie_hijos_entidad_serie[$h],$vector_lista_series_funcionario) ){
                           $almenos_una_serie=1; 
                           $series_para_filtrar[]=$idserie_hijos_entidad_serie[$h];
                        }
                    }
                    if(count($series_para_filtrar) && $almenos_una_serie){
                        $lista_entidad_series_filtrar=implode(',',$series_para_filtrar);
                    }
                }
                if(!$almenos_una_serie){
                    $hijos_entidad_serie['numcampos']=0;
                }    
        }        

        if($hijos_entidad_serie['numcampos']){
            
            llena_entidad_serie($serie,$lista_entidad_series_filtrar,$tvd);
        }
    }    
}

return;

}  //fin llena_dependencia()




//llena series asignadas segun dependencia  (dsa)
function llena_entidad_serie($iddependencia,$series,$tvd=0){
    global $conn,$activo;
	
	$prefijo_tvd='';
	$condicion_tvd=' AND tvd=0';
	if($tvd){
		$activo='';
		$prefijo_tvd='_tv';
		$condicion_tvd=" AND tvd=1";
	}
    
    $condicion_final="categoria=2 AND tipo=1 AND idserie IN(".$series.")";
	$condicion_subseries_tipo_documental=" AND idserie IN(".$series.")";
    $series=busca_filtro_tabla("nombre,idserie,codigo","serie",$condicion_final.$activo.$condicion_tvd,"",$conn);
    for($i=0;$i<$series['numcampos'];$i++){
        echo("<item style=\"font-family:verdana; font-size:7pt;font-weight: normal;\" ");
        echo("text=\"".htmlspecialchars(($series[$i]["nombre"])).' ('.$series[$i]['codigo'].') '." \" id=\"".$iddependencia."sub".$series[$i]['idserie'].$prefijo_tvd."\"");
        if(@$_REQUEST['sin_padre']){
            echo(" nocheckbox=\"1\" ");	
        }
        
        $subseries_tipo_documental=busca_filtro_tabla("idserie","serie","categoria=2 AND tipo IN(2,3) AND cod_padre=".$series[$i]['idserie'].$activo.$condicion_subseries_tipo_documental.$condicion_tvd,"",$conn);
        //print_r($subseries_tipo_documental);
        if($subseries_tipo_documental['numcampos']){
            echo(" child=\"1\">\n");
        }else{
            echo(" child=\"0\">\n");
        }
        
        if($subseries_tipo_documental['numcampos']){
            if(!@$_REQUEST['carga_partes_serie']){ 
                llena_subseries_tipo_documental($iddependencia,$series[$i]['idserie'],$tvd);
            }
            
        }
        
        echo("</item>\n");
    }
}

function llena_subseries_tipo_documental($iddependencia,$idserie,$tvd=0){
    global $conn,$seleccionado,$activo,$excluidos;
	
	$prefijo_tvd='';
	$condicion_tvd=' AND tvd=0';
	if($tvd){
		$activo='';
		$prefijo_tvd='_tv';
		$condicion_tvd=" AND tvd=1";
	}	

	$hijos_entidad_serie = busca_filtro_tabla("serie_idserie","entidad_serie","estado=1 AND entidad_identidad='2' AND llave_entidad=".$iddependencia,"",$conn);
    $lista_entidad_series_filtrar='';    
    if($hijos_entidad_serie['numcampos']){
        $lista_entidad_series_filtrar=" AND idserie IN(".implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie')).")";
    }
    
    $tabla_otra = 'serie';
    $orden="nombre";

    $papas=busca_filtro_tabla("*",$tabla_otra,"cod_padre=".$idserie.$activo.$lista_entidad_series_filtrar.$condicion_tvd,"$orden ASC",$conn); 
    //print_r($papas);
    if($papas["numcampos"]){ 
        for($i=0; $i<$papas["numcampos"]; $i++){
            $hijos = busca_filtro_tabla("count(*) AS cant",$tabla_otra,"cod_padre=".$papas[$i]["id$tabla_otra"].$activo.$lista_entidad_series_filtrar.$condicion_tvd,"",$conn);
            echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
		    if($tabla=="serie"){
			    if(@$papas[$i]["estado"]==1){
			    	$estado_serie=' - ACTIVA';	
		    	}else{
			    	$estado_serie=' - INACTIVA';				
			    }
		    }	
	
            echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).' ('.$papas[$i]['codigo'].') '." \" id=\"".$iddependencia."sub".$papas[$i]['idserie'].$prefijo_tvd."\"");
		    if(@$_REQUEST["arbol_series"]){		
				
	        }		
	        else if($hijos[0]["cant"]!=0 && (@$_REQUEST["sin_padre"])){		
              echo(" nocheckbox=\"1\" ");		
	        }
            if(in_array($papas[$i]["id$tabla"],$seleccionado)!==false)
              echo " checked=\"1\" ";  
            if($hijos[0][0])
                 echo(" child=\"1\">\n");
            else
              echo(" child=\"0\">\n");
		    if(!@$_REQUEST['carga_partes_serie']){
		        llena_subseries_tipo_documental($iddependencia,$papas[$i]["id$tabla_otra"],$tvd);
		    }
            echo("</item>\n");
        }     
    }
    return;
}


//SERIES SIN ASIGNAR (ssa)
function series_sin_asignar($id=0){
	global $conn;
	
	$condicion_id=' AND (cod_padre IS NULL OR cod_padre=0)';
	if($id){
		$condicion_id=' AND cod_padre='.$id;
	}
	
	
	$series=busca_filtro_tabla("","serie","categoria=2 AND estado=1".$condicion_id,"nombre asc",$conn);

	if($series['numcampos']){
		
		if(!$id){
			$child=0;
			if($series['numcampos']){
			    $child=1;
			}
			echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Series sin asignar\" id=\"series_sin_asignar\" child=\"".$child."\">");		
		}
		for($i=0;$i<$series["numcampos"];$i++){
			$hijos=busca_filtro_tabla("cod_padre","serie","cod_padre=".$series[$i]["idserie"],"",$conn);
			$child_hijos=0;
			if($hijos['numcampos']){
				$child_hijos=1;
			}
			
			$asignada=busca_filtro_tabla("serie_idserie","entidad_serie","entidad_identidad=2 AND serie_idserie=".$series[$i]["idserie"],"",$conn);
			$remarcar='';
			$pretexto='sin_asignar';
			if($asignada['numcampos']){
				$remarcar='font-weight: 900;';
				$pretexto='asignada';	
			}

			echo("<item style=\"font-family:verdana; font-size:7pt;".$remarcar."\" text=\"".htmlspecialchars($series[$i]["nombre"])."(".$series[$i]["codigo"].")\" id=\"".$pretexto.""."-".$series[$i]["idserie"]."\" child=\"".$child_hijos."\">\n");
			echo("</item>\n");	
		}
		
		if(!$id){
			echo("</item>");  
		}
	
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
	
    echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).$cadena_codigo." \" id=\"otras_categorias-".$papas[$i]["id$tabla_otra"]."\"");
		if(@$_REQUEST["arbol_series"]){		
				
	}		
	else if($hijos[0]["cant"]!=0 && (@$_REQUEST["sin_padre_otras"])){		
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
