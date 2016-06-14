<?php
include_once("../../db.php");
if(@$_REQUEST["iddoc"] && @$_REQUEST["funcionario"]){
$fecha=date('Y-m-d H:i:s');
$sql="UPDATE ft_solicitud_cambio_calidad SET fecha_vigencia=".fecha_db_almacenar($fecha,'Y-m-d H:i:s').",firma_sgc=".$_REQUEST["funcionario"]." WHERE documento_iddocumento=".$_REQUEST["iddoc"];
//die($sql);
phpmkr_query($sql,$conn);
transferencia_solicitante_cambio($_REQUEST["iddoc"],$fecha);
//volver(1);
}

function transferencia_solicitante_cambio($iddoc,$fecha){
global $conn;
  include_once("../../class_transferencia.php");
  $documento=busca_filtro_tabla("","documento A"," A.iddocumento=".$iddoc,"",$conn);
  if($documento["numcampos"]){
    $datos["archivo_idarchivo"]=$iddoc;
    $datos["nombre"]="TRANSFERIDO";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
    $datos["notas"]="Su solicitud ha sido aprobada y ejecutada por el area de Calidad y entra en vigencia a partir de ".$fecha." GRACIAS!";
    $destino_tramite=array($documento[0]["ejecutor"]);
    transferir_archivo_prueba($datos,$destino_tramite,"");
  }
}
?>
