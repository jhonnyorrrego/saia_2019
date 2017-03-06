<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0

if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")){ 
  header("Content-type: application/xhtml+xml"); 
}else{ 
  header("Content-type: text/xml"); 
}

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
//ini_set("display_errors",true);
include_once($ruta_db_superior."db.php");
/**
 * Determina que tipo de arbol armar de acuerdo a los parametros enviados
 * para ello se llama una funcion que arma el arbol
 * NOTA: Si la tabla no existe dentro del SWITCH se debe agrear al SWITCH y 
 * la funcion que arme el arbol
 */ 
 $arbol=''; 
 switch (trim($_REQUEST['tabla'])){
   case 'dependencia':
     arbol_dependencia($arbol);
   break;
   
   default:
     arbol_dependencia();
   break;
}


function arbol_dependencia(&$arbol){
	
	if($_REQUEST['estado']){
		$estado = " AND estado=".$_REQUEST['estado']." ";
	}else {
		$estado = "";
	}
	
	if($_REQUEST['excluidos']){
		$excluidos = " AND iddependencia NOT IN(".$_REQUEST['excluidos'].") ";
	}else {
		$excluidos = "";
	}
	
	if($_REQUEST['no_excluidos']){
		$no_excluidos = " AND iddependencia IN(".$_REQUEST['no_excluidos'].") ";
	}else {
		$no_excluidos = "";
	}
	
	$dependencia = busca_filtro_tabla("","dependencia","cod_padre IS NULL".$estado.$excluidos.$no_excluidos," nombre ASC",$conn);
		
	if($_REQUEST['no_hijo']){
		for($i=0; $i < $dependencia['numcampos']; $i++){
			armar_ramas_arbol($arbol,1, $dependencia[$i]['nombre'], $dependencia[$i]['iddependencia'],$nocheckbox);
		}		
	}else{
		$dependencias = extrae_campo($dependencia,'iddependencia','U');
		
		foreach ($dependencias as $value){
			hijos_dependencia($arbol, $value, $estado);
		}	
	}	
}


function hijos_dependencia(&$arbol, $idpapa, $estado){
	
	if($_REQUEST['excluidos_hijos']){
		$excluidos = " AND iddependencia NOT IN(".$_REQUEST['excluidos_hijos'].") ";
	} else {
		$excluidos_hijos = "";
	}
	
	$cierre = 0;
	
	$datos_papa = busca_filtro_tabla("","dependencia","iddependencia=".$idpapa,"",$conn);	
	
	$hijos = busca_filtro_tabla("","dependencia","cod_padre=".$idpapa.$estado.$excluidos_hijos,"nombre ASC",$conn);	
	
	if($_REQUEST['no_papas'] && $hijos['numcampos'] == 0){
		//$nocheckbox = "";		
	}else{
		//$nocheckbox = " nocheckbox='1' ";
	}	
	
	$cierre += armar_ramas_arbol($arbol,0, $datos_papa[0]['nombre'], $datos_papa[0]['iddependencia'],$nocheckbox);	
	
	for($i=0; $i < $hijos['numcampos']; $i++){				
		hijos_dependencia($arbol,$hijos[$i]['iddependencia'],$estado);		
	}
	
	for($c=0; $c < $cierre; $c++){
		$arbol.= "</item>\n";		
	} 	
		
}

function armar_ramas_arbol(&$arbol,$cierre = 1, $etiqueta, $idrama, $nocheckbox=null){
	
	if($_REQUEST['seleccionado']){
		$seleccionado = explode(',',$_REQUEST['seleccionado']);
	}	

	if(in_array($idrama, $seleccionado)){
		$checked = " checked='1' ";		
	}else{
		$checked = "";		
	}	
	
	$arbol .= "<item style='font-family:verdana; font-size:7pt;' text='".(codifica_caracteres(strtoupper($etiqueta)))."' id='".$idrama."' ".$nocheckbox." ".$checked.">\n";
	if($cierre){
		$arbol.= "</item>\n";	
	}else{
		return 1;		
	}									
}

$test_tree = "<?xml version='1.0' encoding='UTF-8' ?>";
$test_tree.= "<tree id='0'>\n";  
$test_tree.=$arbol;	
$test_tree.= "</tree>\n";


echo($test_tree);

function codifica_caracteres($original){
	return preg_replace(array(
							'/ä/',
							'/ö/',
							'/ü/',							
							'/à/',
							'/è/',
							'/á/',
							'/é/',
							'/í/',
							'/ó/',
							'/ú/',
							'/Á/',
							'/É/',
							'/Í/',
							'/Ó/',
							'/Ú/',
							'/ñ/',
							'/Ñ/',
							'/°/',
							'/ACUTE;/'
							
						),
						array (
							'&auml;',
							'&ouml;',
							'&uuml;',							
							'&agrave;',
							'&egrave;',
							'&aacute;',
							'&eacute;',
							'&iacute;',
							'&oacute;',
							'&uacute;',
							'&Aacute;',
							'&Eacute;',
							'&Iacute;',
							'&Oacute;',
							'&Uacute;',
							'&ntilde;',
							'&Ntilde;',	
							'&deg;',
							'acute;'
						),
						$original
					);
}
?>