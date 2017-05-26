<?php
function solicitud_documento($datos){
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
	{
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."webservice_saia/class.php");
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
  $_SESSION["usuario_actual"]="123456";
  $_SESSION["conexion_remota"]=1;
}
else{
  $_SESSION["usuario_actual"]=usuario_actual("funcionario_codigo");
  $_SESSION["conexion_remota"]=1;
} 	
$resultado="";
$_REQUEST=$datos;
switch($_REQUEST["formato"]){  
  case "pqr":
  	$resultado=consultar_pqr($_REQUEST["identificacion"]);
  break;
}
return($resultado);  
}
function consultar_pqr($identificacion){
global $conn;
$texto="";
$documentos =busca_filtro_tabla("iddocumento","ft_pqr a, documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and identificacion='".$identificacion."'","d.fecha desc",$conn);
if($documentos["numcampos"]){
	$texto=contenido_documento(PROTOCOLO_CONEXION.RUTA_PDF."/formatos/pqr/pqr_por_persona.php?identificacion=".$identificacion."&remoto=1&idfunc=".$_SESSION["usuario_actual"]."&tipo=6");
   	return("0|".$texto);
}
else
  return(array("exito"=>0,"texto"=>"No hay PQR registrada para este documento."));  

}
function contenido_documento($direccion){
$mh = curl_multi_init();
$ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
}
curl_setopt($ch, CURLOPT_URL,$direccion); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$contenido=curl_exec ($ch);
curl_close ($ch);
return($contenido);
}
?>
