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
  
 switch (trim($_REQUEST["documento"])){
   	case 1://Caracterización 
			    	 	
   	break;
   	case 2://Procedimiento
    	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'procedimiento'","",$conn);
   	break;
   	case 3://Guías
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'guia'","",$conn);
   	break;
   	case 4://Instructivo
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'instructivo'","",$conn);
   	break;
   	case 5://Manual
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'manual'","",$conn);
   	break;
   	case 6://Política de Operación
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'politicas_proceso'","",$conn);
   	break;	   
   	case 7://Planes
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'plan_calidad'","",$conn);
   	break;
	case 8://Otros Documentos
     	$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'otros_calidad'","",$conn);
   	break;	
	case 10://Formato
		$formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'formato'","",$conn);		
   	break;   
   	case 11:
   	    $formato = busca_filtro_tabla("idformato, nombre_tabla, etiqueta","formato","lower(nombre) like'prog_calidad'","",$conn);	
   	    break;
}

$arbol='';
if($formato["numcampos"] && $_REQUEST["proceso"]){
	arbol_calidad_formatos($arbol, $formato[0]["idformato"], $formato[0]["nombre_tabla"], $formato[0]["etiqueta"]);	
}


function arbol_calidad_formatos(&$arbol, $idformato, $tabla, $etiqueta){
	global $conn;
			
	if($_REQUEST['tipo_solicitud'] == 1){				
		armar_ramas_arbol($arbol,1, $etiqueta, $idformato."|",$nocheckbox);				
	}else{
		documentos_hijos_formato($arbol, $idformato, $tabla, $etiqueta);			
	}	
}

function documentos_hijos_formato(&$arbol, $idformato, $tabla, $etiqueta){
	global $conn;	
	
	$cierre = 0;	
	$cierre += armar_ramas_arbol($arbol,0, $etiqueta, $idformato."|",1);
	
	$documentos = busca_filtro_tabla("a.nombre, a.documento_iddocumento",$tabla." a, documento b","a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and a.ft_proceso=".$_REQUEST["proceso"]," nombre asc",$conn);	
	
	for($i=0; $i < $documentos['numcampos']; $i++){
		
		$etiqueta = $documentos[$i]["nombre"];
		$id = $idformato."|".$documentos[$i]["documento_iddocumento"];				
		armar_ramas_arbol($arbol,1, $etiqueta, $id,0);		
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
	
	if($nocheckbox == 1){
		$nocheckbox = "nocheckbox='1'";
	}else{
		$nocheckbox ='';
	}
	
	$arbol .= "<item style='font-family:verdana; font-size:7pt;' text='".htmlentities(codifica_caracteres(strtoupper($etiqueta)))."' id='".$idrama."' ".$nocheckbox." ".$checked.">\n";
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
							'/ACUTE;/',
							'/&NTILDE;/'
							
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
							'acute;',
							'&Ntilde;'
						),
						$original
					);
}
?>