<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
$id=@$_REQUEST["idft_solicitud_afiliacion"];
$idft_solicitud_afiliacion=busca_filtro_tabla("","ft_radicacion_entrada A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO') AND B.numero='".$id."'","",$conn);

if($idft_solicitud_afiliacion["numcampos"]){
	$nombres=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$idft_solicitud_afiliacion[0]["persona_natural"],"",$conn);
	echo("1|".$nombres[0]["nombre"]." - ".$nombres[0]["identificacion"]);
}
else{
	echo("2|");
}
?>