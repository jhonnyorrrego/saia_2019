<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
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
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")){
    header("Content-type: application/xhtml+xml"); 
}
else{
    header("Content-type: text/xml"); 
}
$version=@$_REQUEST["idversion_documento"];
$iddoc=@$_REQUEST["iddoc"];
$documento=busca_filtro_tabla("","documento a","a.iddocumento=".$iddoc,"",$conn);
if($version){
    $datos_version=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d H:i')." as x_fecha, a.*","version_documento a","a.idversion_documento=".$version,"",$conn);
}else if($iddoc){
    $datos_version=busca_filtro_tabla(fecha_db_obtener('a.fecha','Y-m-d H:i')." as x_fecha, a.*","version_documento a","a.documento_iddocumento=".$iddoc,"idversion_documento desc",$conn);
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
for($i=0;$i<$datos_version["numcampos"];$i++){
    $fecha=$datos_version[$i]["x_fecha"];
    if(is_object($datos_version[$i]["x_fecha"]))$fecha=$datos_version[$i]["x_fecha"]->format('Y-m-d H:i');
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"V".$datos_version[$i]["version"].". ".$fecha."\" id=\"".$iddoc.$i."\" nocheckbox=\"1\" >\n");
    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Pdf\" id=\"pdf".$datos_version[$i]["idversion_documento"]."\" nocheckbox=\"1\" >\n");
    echo pdf($datos_version[$i]["idversion_documento"]);
    echo("</item>");
    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Anexos\" id=\"anexos".$datos_version[$i]["idversion_documento"]."\" nocheckbox=\"1\" >\n");
    echo anexos($datos_version[$i]["idversion_documento"]);
    echo("</item>");
    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Paginas\" id=\"paginas".$datos_version[$i]["idversion_documento"]."\" nocheckbox=\"1\" >\n");
    echo paginas($datos_version[$i]["idversion_documento"]);
    echo("</item>");
		
		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Vistas\" id=\"vistas".$datos_version[$i]["idversion_documento"]."\" nocheckbox=\"1\" >\n");
    echo vistas($datos_version[$i]["idversion_documento"]);
    echo("</item>");

		echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Notas\" id=\"_notas".$datos_version[$i]["idversion_documento"]."|".$iddoc."\" nocheckbox=\"1\" >\n");
    echo("</item>");
    
    echo("</item>");
}
echo("</tree>");
function pdf($version){
    global $conn;
    $datos=busca_filtro_tabla("","version_documento a","a.idversion_documento=".$version,"",$conn);
    $cadena=array();
    for($i=0;$i<$datos["numcampos"];$i++){
        $archivo=basename($datos[$i]["pdf"]);
        $cadena[]="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".codifica_encabezado(html_entity_decode($archivo))."\" id=\"pdf-".$version."\" nocheckbox=\"1\" ></item>";
    }
    return(implode("",$cadena));
}
function anexos($version){
    global $conn;
    $datos=busca_filtro_tabla("","version_anexos a","a.fk_idversion_documento=".$version,"",$conn);
    $cadena=array();
    for($i=0;$i<$datos["numcampos"];$i++){
        $dato_anexo=busca_filtro_tabla("","anexos a","a.idanexos=".$datos[$i]["anexos_idanexos"],"",$conn);
        $archivo=($dato_anexo[0]["etiqueta"]);
        $cadena[]="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".codifica_encabezado(html_entity_decode($archivo))."\" id=\"anexo-".$datos[$i]["idversion_anexos"]."\" nocheckbox=\"1\" ></item>";
    }
    return(implode("",$cadena));
}
function paginas($version){
    global $conn;
    $datos=busca_filtro_tabla("","version_pagina a","a.fk_idversion_documento=".$version,"",$conn);
    $cadena=array();
    for($i=0;$i<$datos["numcampos"];$i++){
        $dato_pagina=busca_filtro_tabla("","pagina a","a.consecutivo=".$datos[$i]["pagina_idpagina"],"",$conn);
        $archivo=("Documento ".$dato_pagina[0]["pagina"]);
        $cadena[]="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".codifica_encabezado(html_entity_decode($archivo))."\" id=\"pagina-".$datos[$i]["idversion_pagina"]."\" nocheckbox=\"1\" ></item>";
    }
    return(implode("",$cadena));
}
function vistas($version){
    global $conn;
    $datos=busca_filtro_tabla("","version_vista a","a.fk_idversion_documento=".$version,"",$conn);
    $cadena=array();
    for($i=0;$i<$datos["numcampos"];$i++){
        $archivo=basename($datos[$i]["pdf"]);
        $cadena[]="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".codifica_encabezado(html_entity_decode($archivo))."\" id=\"vista-".$datos[$i]["idversion_vista"]."\" nocheckbox=\"1\" ></item>";
    }
    return(implode("",$cadena));
}
?>