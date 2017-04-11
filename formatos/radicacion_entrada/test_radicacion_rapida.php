<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");


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
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");



echo("<tree id=\"0\">\n");
   
   
   //FORMATO radicacion_entrada
    $formato_radicacion=busca_filtro_tabla("etiqueta,nombre","formato","nombre='radicacion_entrada'","",$conn);
    $modulo_formato=busca_filtro_tabla('idmodulo','modulo','nombre="crear_'.$formato_radicacion[0]['nombre'].'"','',$conn);
    $ok_radicacion_entrada=0;
    if($modulo_formato['numcampos']){
        $ok_radicacion_entrada=acceso_modulo($modulo_formato[0]['idmodulo']);	
    } 
    if($ok_radicacion_entrada){
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".ucwords(strtolower(htmlspecialchars($formato_radicacion[0]["etiqueta"])))." Origen Externo\" id=\"radicacion_entrada\" ></item>");
    
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".ucwords(strtolower(htmlspecialchars($formato_radicacion[0]["etiqueta"])))." Origen Interno\" id=\"radicacion_salida\" ></item>");        
    }
    
    //FORMATO pqrsf
    $formato_pqrsf=busca_filtro_tabla("etiqueta,nombre","formato","nombre='pqrsf'","",$conn);
    $modulo_formato_pqrsf=busca_filtro_tabla('idmodulo','modulo','nombre="crear_'.$formato_pqrsf[0]['nombre'].'"','',$conn);
    $ok_pqrsf=0;
    if($modulo_formato['numcampos']){
        $ok_pqrsf=acceso_modulo($modulo_formato_pqrsf[0]['idmodulo']);	
    } 
    if($ok_pqrsf){
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".ucwords(strtolower(htmlspecialchars($formato_pqrsf[0]["etiqueta"])))." \" id=\"pqrsf\" ></item>");           
    }
    
echo("</tree>\n");

?>
<?php
	function acceso_modulo($idmodulo){
	  if(usuario_actual("login")=="cerok"){
	    return true;
	  }
	  $ok=new Permiso();
	  $modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"");
	  $acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	  return $acceso;
	}	
	

?>