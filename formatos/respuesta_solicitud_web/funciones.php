<?php
include_once("../../db.php");
include_once("../librerias/funciones_generales.php");
$datos_solicitud="";
$respuesta_solicitud="";
function tipo_solicitud_web($idformato,$iddoc){
global $conn,$datos_solicitud,$respuesta_solicitud;
$respuesta_solicitud=busca_filtro_tabla("","respuesta","destino=".$iddoc,"fecha DESC",$conn);
$datos_solicitud=busca_filtro_tabla("","ft_solicitud_web","documento_iddocumento=".$respuesta_solicitud[0]["origen"],"",$conn);
//print_r($datos_solicitud);
 //mostrar_valor_campo('cuerpo_respuesta',79,$_REQUEST['iddoc'])
echo(mostrar_valor_campo("tipo_solicitud",78,$respuesta_solicitud[0]["origen"]));
}
function nombre_persona_solicita_web($idformato,$iddoc){
global $conn,$respuesta_solicitud;
echo(mostrar_valor_campo("nombre_persona",78,$respuesta_solicitud[0]["origen"]));
}
function asunto_predeterminado()
{global $conn;
 $numero=busca_filtro_tabla("numero","documento","iddocumento=".$_REQUEST["anterior"],"",$conn);
 echo "<td><input type='text' readonly='true' name='asunto' value='Respuesta Solicitud Web No. ".$numero[0][0]."' size='100'></td>";
}
function numero_solicitud_web($idformato,$iddoc){
global $conn,$datos_solicitud;
$dato=busca_filtro_tabla("numero","documento","iddocumento=".$datos_solicitud[0]["documento_iddocumento"],"",$conn);
echo("<b>".$dato[0]["numero"]."</b>");
}
function asunto_solicitud_web($idformato,$iddoc){ 
global $conn,$datos_solicitud;
//echo(mostrar_valor_campo("asunto",78,$respuesta_solicitud[0]["origen"]));
}
function fecha_solicitud_web($idformato,$iddoc){  
global $conn,$datos_solicitud;  
$dato=busca_filtro_tabla("fecha","documento","iddocumento=".$datos_solicitud[0]["documento_iddocumento"],"",$conn);
echo($dato[0]["fecha"]);
}
function nombre_cargo_elabora($idformato,$iddoc){   
global $conn,$datos_solicitud;
$dato=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"",$conn);

$funcionario=busca_filtro_tabla("","funcionario","funcionario_codigo=".$dato[0]["ejecutor"],"",$conn);
echo($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]);
}
function mensaje_solicitud_web($idformato,$iddoc){ 
global $conn,$respuesta_solicitud;
echo(mostrar_valor_campo("mensaje",78,$respuesta_solicitud[0]["origen"]));
}
?>
