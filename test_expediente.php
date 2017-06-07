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
  
$estado_cierre='';  
if(@$_REQUEST['estado_cierre']){
    $estado_cierre=" AND (a.estado_cierre IN(".$_REQUEST['estado_cierre']."))";
}  
$estado_archivo='';  
if(@$_REQUEST['estado_archivo']){
    $estado_archivo=" AND (a.estado_archivo IN(".$_REQUEST['estado_archivo']."))";
}  

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
global $conn,$sql,$exp_doc,$funcionarios,$excluidos,$dependencias,$varios,$lista2,$estado_cierre,$estado_archivo;
if($id==0){
  $papas=busca_filtro_tabla("a.fecha, a
.nombre, a.cod_arbol, a.idexpediente, estado_cierre","vexpediente_serie a",$lista2." and (a.cod_padre=0 OR a.cod_padre IS NULL)".$estado_cierre.$estado_archivo,"GROUP BY a.fecha, a
.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc",$conn);
	
}
else{
	$papas=busca_filtro_tabla("a.fecha, a
.nombre, a.cod_arbol, a.idexpediente, a.estado_cierre","vexpediente_serie a",$lista2." and (a.cod_padre=".$id.")".$estado_cierre.$estado_archivo,"GROUP BY a.fecha, a
.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by idexpediente desc",$conn);
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
			
			$cantidad_tomos=cantidad_tomos($papas[$i]["idexpediente"]);
			$cadena_tomos='';
			if($cantidad_tomos['cantidad']>1){
			    $cadena_tomos='&nbsp;&nbsp;<b>('.$cantidad_tomos['tomo_no'].' de '.$cantidad_tomos['cantidad'].')</b>';
			}
		
	  	echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
	    echo("text=\"".htmlspecialchars($texto_item.$cadena_tomos)." \" id=\"".$papas[$i]["idexpediente"]."\"");
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
			
			$hijos=busca_filtro_tabla("idexpediente","vexpediente_serie a",$lista2." AND cod_padre=".$papas[$i]["idexpediente"],"",$conn);
			if($hijos['numcampos']){
               echo(" child=\"1\" ");
			}
    	echo(">");
			if(@$_REQUEST["uid"] || @$_REQUEST["carga_total"]){
    		llena_expediente($papas[$i]["idexpediente"]);
			}
    	echo("</item>\n");
   	} 
  }     
}
return;
}

function cantidad_tomos($idexpediente){
    global $conn;
    
    $expediente_actual=busca_filtro_tabla("tomo_padre,tomo_no","expediente","idexpediente=".$idexpediente,"",$conn);
    $ccantidad_tomos=busca_filtro_tabla("idexpediente","expediente","tomo_padre=".$expediente_actual[0]['tomo_padre'],"",$conn);
    $cantidad_tomos=array();
    $cantidad_tomos['cantidad']=$ccantidad_tomos['numcampos']+1; //tomos + el padre  
    $cantidad_tomos['tomo_no']=$expediente_actual[0]['tomo_no'];
    return($cantidad_tomos);
}

?>