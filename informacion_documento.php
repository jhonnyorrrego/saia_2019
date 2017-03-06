<?php
if(!@$_SESSION["LOGIN"]){
@session_start();
$_SESSION["LOGIN"]="cerok";
$_SESSION["usuario_actual"]="1";
}
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior.'pantallas/lib/librerias_cripto.php');
include_once($ruta_db_superior.'formatos/librerias/funciones_generales.php');
$parametros=request_encriptado();
$iddoc=$parametros["iddocumento"];
$iddoc=$_REQUEST["iddocumento"];
$documento=busca_filtro_tabla("","documento A","A.iddocumento=".$iddoc,"",$conn);

$formato=busca_filtro_tabla("","formato A","A.nombre='".strtolower($documento[0]["plantilla"])."'","",$conn);

$datos_fecha=date_parse($documento[0]["fecha"]);

$firmas=busca_filtro_tabla("CONCAT(B.nombres,CONCAT(' ',B.apellidos)) AS nombre","buzon_salida A, funcionario B","A.origen=B.funcionario_codigo AND (A.nombre LIKE 'APROBADO' OR A.nombre LIKE 'REVISADO')AND A.archivo_idarchivo=".$iddoc,"", $conn);
$nombres=array();
for($i=0; $i<$firmas['numcampos']; $i++){
	$nombres[]=codifica_encabezado(html_entity_decode($firmas[$i]['nombre']));    
}

$elaboro=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$documento[0]["ejecutor"],"",$conn);

$respuestas=array();
$respondidos=busca_filtro_tabla("","respuesta A, documento B","A.origen=".$documento[0]["iddocumento"]." AND A.destino=B.iddocumento","",$conn);
for($i=0; $i<$respondidos['numcampos']; $i++){
	$respuestas[]=" Respuesta con <b>Radicado No</b> ".$respondidos[$i]["numero"].", <b>Asunto:</b> ".$respondidos[$i]["descripcion"];    
}
if(!$respondidos["numcampos"])$respuestas[]="Sin respuestas realizadas";

$tipo_documento=busca_filtro_tabla("","serie A","A.idserie=".$documento[0]["serie"],"",$conn);
if(!$tipo_documento["numcampos"])$tipo_documento[0]["nombre"]="Sin serie asignada";

$tabla="";
$tabla.="<table style='font-family:arial;width:100%;border-collapse:collapse' border='1px'>";
$tabla.="<tr>";
$tabla.="<td colspan='2' style='text-align:center;'><b>Informaci&oacute;n del documento</b></td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td style=''><b>Radicado No:</b> </td><td style=''>".$documento[0]["numero"]."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Asunto:</b> </td><td>".$documento[0]["descripcion"]."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Fecha:</b> </td><td>".$datos_fecha["day"]." ".mes($datos_fecha["month"])." del ".$datos_fecha["year"]."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Tipo de documento:</b> </td><td>".$tipo_documento[0]["nombre"]."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Personas que firman:</b> </td>";
$tabla.="<td>".implode("<br />",$nombres)."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Respuestas al documento:</b> </td><td>".implode("<br />",$respuestas)."</td>";
$tabla.="</tr>";
$tabla.="<tr>";
$tabla.="<td><b>Elabor&oacute;:</b> </td><td>".ucwords(strtolower($elaboro[0]["nombres"]." ".$elaboro[0]["apellidos"]))."</td>";
$tabla.="</tr>";
$tabla.="</table>";
echo($tabla);
?>