<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
 header("Content-type: text/xml"); 
}
include_once("db.php");
include_once("class.funcionarios.php");
include_once("pantallas/expediente/librerias.php");

$exp_doc=array();
$id=@$_REQUEST["inicia"];
$excluidos=array();

if(@$_REQUEST["excluidos"])
  $excluidos=explode(",",$_REQUEST["excluidos"]);

if(@$_REQUEST["doc"]){
	$varios=1;
	$varios_docs=explode(",",$_REQUEST["doc"]);
  $documento=busca_filtro_tabla("","expediente_doc","documento_iddocumento in(".$_REQUEST["doc"].")","",$conn);
	$exp_doc=array();
	if(count($varios_docs)==1){
  	$exp_doc=extrae_campo($documento,"expediente_idexpediente","U");
  	$varios=0;
  }
}

$funcionarios=array();
$idfunc=usuario_actual("idfuncionario");

$lista2=expedientes_asignados();

$id = @$_REQUEST["id"];

//si llega el request para cargar por partes subseries & tipo documental
if(@$_REQUEST['carga_partes_serie']){
    if($id and $id<>"" && @$_REQUEST["uid"]){
        
        if(strpos($id,'sub')!==false){
            echo("<tree id=\"".$id."\">\n");
                $ids=explode('sub',$id);
                $ids[1]=explode('_',$ids[1]);
                llena_subseries_tipo_documental($ids[0],$ids[1]);            
            echo("</tree>\n");
            die();            
        }

    }   
}



if(@$_REQUEST["id"] && @$_REQUEST["uid"]){
	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
	echo("<tree id=\"".$_REQUEST["id"]."\">\n");
	llena_expediente($_REQUEST["id"]);
	echo("</tree>\n");
	die();
}






echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
llena_expediente($id);
echo("</tree>\n");

function llena_expediente($id){
global $conn,$sql,$exp_doc,$funcionarios,$excluidos,$dependencias,$varios,$lista2;
if($id==0){
  $papas=busca_filtro_tabla("a.fecha, a
.nombre, a.descripcion, a.cod_arbol, a.idexpediente, estado_cierre","vexpediente_serie a",$lista2." and (a.cod_padre=0 OR a.cod_padre IS NULL) AND a.estado_cierre=1","GROUP BY a.fecha, a
.nombre, a.descripcion, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc",$conn);
	
}
else{
	$papas=busca_filtro_tabla("a.fecha, a
.nombre, a.descripcion, a.cod_arbol, a.idexpediente, a.estado_cierre","vexpediente_serie a",$lista2." and (a.cod_padre=".$id.") AND a.estado_cierre=1","GROUP BY a.fecha, a
.nombre, a.descripcion, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc",$conn);
} 

if($papas["numcampos"]){
	for($i=0; $i<$papas["numcampos"]; $i++){
  	$permitido=0;
  	if(!in_array($papas[$i]["idexpediente"],$excluidos)){
  		$texto_item="";
			$texto_item=($papas[$i]["nombre"]);
			if($papas[$i]["estado_cierre"]==2){
				$texto_item.=" <span style=\"color:red\">(CERRADO)</span>";
			}
		
	  	echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
	    echo("text=\"".htmlspecialchars($texto_item)." \" id=\"".$papas[$i]["idexpediente"]."\"");
	    if(@$_REQUEST["doc"]){
      	if($_REQUEST["accion"]==1 && in_array($papas[$i]["idexpediente"],$exp_doc)){
      		if(!$varios){
      			echo(" checked=\"1\" ");
      		}else{
        		echo(" nocheckbox=\"1\" ");
					}
				}
      	elseif($_REQUEST["accion"]==0 && !in_array($papas[$i]["idexpediente"],$exp_doc)){
        	echo(" nocheckbox=\"1\" ");
				}
    	}
    	elseif(@$_REQUEST["seleccionado"]&&$_REQUEST["seleccionado"]==$papas[$i]["idexpediente"])
    		echo " checked=\"1\" ";
			if($papas[$i]["estado_cierre"]==2){
				echo(" nocheckbox=\"1\" ");
			}
			echo(" child=\"1\" ");
    	echo(">");
			if(@$_REQUEST["uid"] || @$_REQUEST["carga_total"]){
    		llena_expediente($papas[$i]["idexpediente"]);
			}
    	echo("</item>\n");
   	} 
  }     
}


if(@$_REQUEST['uid'] || @$_REQUEST['id'] ){
    if($_REQUEST['id']==$id){
        $hijos_entidad_serie = busca_filtro_tabla("serie_idserie","expediente","idexpediente=".$_REQUEST['id'],"",$conn);
        
        if($hijos_entidad_serie['numcampos']){
            $lista_entidad_series_filtrar=implode(',',extrae_campo($hijos_entidad_serie,'serie_idserie'));
        }

        if($hijos_entidad_serie['numcampos']){
            
            llena_entidad_serie($_REQUEST['id'],$lista_entidad_series_filtrar);
        }
    }  
}


return;
}

//llena series asignadas segun dependencia  (dsa)
function llena_entidad_serie($iddependencia,$series){
    global $conn,$activo;
    
    $condicion_final="categoria=2 AND tipo=1 AND idserie IN(".$series.")";
    $series=busca_filtro_tabla("nombre,idserie,codigo","serie",$condicion_final.$activo,"",$conn);
    for($i=0;$i<$series['numcampos'];$i++){
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".htmlspecialchars(($series[$i]["nombre"])).' ('.$series[$i]['codigo'].') '." \" id=\"".$iddependencia."sub".$series[$i]['idserie']."\"");
        if(@$_REQUEST['sin_padre']){
            echo(" nocheckbox=\"1\" ");	
        }
        
        $subseries_tipo_documental=busca_filtro_tabla("idserie","serie","categoria=2 AND tipo IN(2,3) AND cod_padre=".$series[$i]['idserie'].$activo,"",$conn);
        //print_r($subseries_tipo_documental);
        if($subseries_tipo_documental['numcampos']){
            echo(" child=\"1\">\n");
        }else{
            echo(" child=\"0\">\n");
        }
        
        if($subseries_tipo_documental['numcampos']){
            if(!@$_REQUEST['carga_partes_serie']){ 
                llena_subseries_tipo_documental($iddependencia,$series[$i]['idserie']);
            }
            
        }
        
        echo("</item>\n");
    }
}

function llena_subseries_tipo_documental($iddependencia,$idserie){
    global $conn,$seleccionado,$activo,$excluidos;


    
    $tabla_otra = 'serie';
    $orden="nombre";

    $papas=busca_filtro_tabla("*",$tabla_otra,"cod_padre=".$idserie.$activo,"$orden ASC",$conn); 
    print_r($papas);
    if($papas["numcampos"]){ 
        for($i=0; $i<$papas["numcampos"]; $i++){
            $hijos = busca_filtro_tabla("count(*) AS cant",$tabla_otra,"cod_padre=".$papas[$i]["id$tabla_otra"].$activo,"",$conn);
            echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
		    if($tabla=="serie"){
			    if(@$papas[$i]["estado"]==1){
			    	$estado_serie=' - ACTIVA';	
		    	}else{
			    	$estado_serie=' - INACTIVA';				
			    }
		    }	
	
            echo("text=\"".htmlspecialchars(($papas[$i]["nombre"])).' ('.$papas[$i]['codigo'].') '." \" id=\"".$iddependencia."sub".$papas[$i]['idserie']."\"");
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
		        llena_subseries_tipo_documental($iddependencia,$papas[$i]["id$tabla_otra"]);
		    }
            echo("</item>\n");
        }     
    }
    return;
}




?>