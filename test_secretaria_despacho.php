<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$tabla = @$_GET["tabla"];
$id = @$_GET["id"];
if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]!="")
{
 $activo = " and estado = 1"; 
}
if(isset($_REQUEST["seleccionado"]))
  $seleccionado=explode(",",$_REQUEST["seleccionado"]);
else
  $seleccionado=array(); 
if(isset($_REQUEST["condicion"]))
  $condicion=" AND ".$_REQUEST["condicion"];
else
  $condicion="";    
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}

include_once("db.php");
/**
 * Determina que tipo de arbol armar de acuerdo a los parametros enviados
 * por el REQUEST
 */
if($_REQUEST['dependencia']){
	$idpapa = explode(',',$_REQUEST['dependencia']);
	$tabla = 'dependencia';
}elseif($_REQUEST['funcionario']){
	$idpapa = explode(',',$_REQUEST['funcionario']);
	$tabla = 'funcionario';
}elseif($_REQUEST['cargo']){
	$idpapa = explode(',',$_REQUEST['cargo']);
	$tabla = 'cargo';
}else{
	$idpapa = explode(',',0);
	$tabla='dependencia';
}

if($_REQUEST['tabla']){
	$tabla = $_REQUEST['tabla'];
}

switch($_REQUEST['tipo_funcionario']){
	case 1:
		$tipo_funcionario = 'dependencia_cargo';
	break;	
	case 2:
		$tipo_funcionario = 'idfuncionario';
	break;	
	default:
		$tipo_funcionario = 'funcionario_codigo';
	break;

}
$arbol='';
foreach($idpapa as $value){	
	$papa = busca_filtro_tabla("",$tabla,"id".$tabla."=".$value,"",$conn);
	obtener_hijos_arbol($arbol,$papa[0]['id'.$tabla],$tabla);
}

function obtener_hijos_arbol(&$arbol,$papa,$tabla,$hijo = 0){
	global $conn;		
	
	$datos_papa = busca_filtro_tabla("",$tabla,"id".$tabla."=".$papa,"",$conn);	
		
	if($tabla == 'dependencia'){
		$id = 'd'.$datos_papa[0]['id'.$tabla];
		$etiqueta = $datos_papa[0]['nombre'];		
	}elseif($tabla == 'cargo'){
		$id = 'c'.$datos_papa[0]['id'.$tabla];
		$etiqueta = $datos_papa[0]['nombre'];
	}elseif($tabla == 'funcionario'){
		$id = $datos_papa[0]['id'.$tabla];
		$etiqueta = $datos_papa[0]['nombres'].' '.$datos_papa[0]['apellidos'];
	}else{
		$id = $datos_papa[0]['id'.$tabla];
		$etiqueta = $datos_papa[0][$_REQUEST['etiqueta']];
	}	
	$funcionarios = busca_filtro_tabla("A.nombres,A.apellidos,A.idfuncionario, A.funcionario_codigo,B.iddependencia_cargo, C.nombre AS nombre_dependencia, D.nombre AS cargo","funcionario A, dependencia_cargo B, dependencia C, cargo D","A.idfuncionario=B.funcionario_idfuncionario AND C.iddependencia=B.dependencia_iddependencia AND D.idcargo=B.cargo_idcargo AND B.".$tabla."_id".$tabla."=".$papa." AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1","GROUP BY A.nombres,A.apellidos,A.idfuncionario, A.funcionario_codigo,B.iddependencia_cargo,C.nombre,D.nombre ORDER BY A.idfuncionario",$conn);				
	
	$arbol .= "<item style='font-family:verdana; font-size:7pt;' text='".($etiqueta)."' id='".$id."' nocheckbox='1'>\n"; 	
	
	for($fn=0; $fn< $funcionarios['numcampos']; $fn++){
		
		if($_REQUEST['etiqueta'] == 1){//nombre de la dependencia
			$etiqueta_funcionario = (codifica_caracteres(strtoupper($funcionarios[$fn]['nombre_dependencia'])));			
		}else{//nombre del funcionario-cargo
			$etiqueta_funcionario = (codifica_caracteres(strtoupper($funcionarios[$fn]['nombres'])))." ".(codifica_caracteres(strtoupper($funcionarios[$fn]['apellidos']))).' - '.ucwords((codifica_caracteres($funcionarios[$fn]['cargo'])));
		}
	
		$arbol .= "<item style='font-family:verdana; font-size:7pt;' text='".$etiqueta_funcionario."' id='".$funcionarios[$fn]['iddependencia_cargo']."' >\n"; 
		$arbol.= "</item>\n";
	}
	
	$hijos = busca_filtro_tabla("",$tabla,"cod_padre=".$papa." AND estado=1"," nombre ASC",$conn);
	
	for($i=0; $i<$hijos['numcampos'];$i++){					
		obtener_hijos_arbol($arbol,$hijos[$i]['id'.$tabla],$tabla,$papa);		
	}	
	$arbol.= "</item>\n";
}

$test_tree = "<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
$test_tree.= "<tree id=\"0\">\n";  
$test_tree.=$arbol;	
$test_tree.= "</tree>\n";


echo($test_tree);

function codifica_caracteres($original){
$codificada=str_replace("ACUTE;","acute;",$original);
$codificada=str_replace("TILDE;","tilde;",$codificada);
return($codificada);
}

?>
