<?php
@set_time_limit(0);
if (!@$_SESSION["LOGIN"]) {
  @session_start();
  $_SESSION["LOGIN"] = "0k";
  $_SESSION["usuario_actual"] = "1449";
}
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;
  }
  $ruta .= "../";
  $max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "class_transferencia.php");

$hoy=date("Y-m-d");
$nuevafecha = date ('Y-m-d',strtotime ('+5 day',strtotime(date('Y-m-d'))) );
$formato=busca_filtro_tabla("idformato","formato","nombre='hallazgo'","",$conn);

$datos_seguimiento = busca_filtro_tabla("responsable_seguimiento,documento_iddocumento", "ft_hallazgo h,documento d","d.iddocumento=h.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and (notifica_seg is null or notifica_seg=0) and '".$hoy."'<=TO_CHAR(tiempo_seguimiento,'YYYY-MM-DD') AND '".$nuevafecha."'>=TO_CHAR(tiempo_seguimiento,'YYYY-MM-DD')", "", $conn);
if ($datos_seguimiento["numcampos"]) {
  for ($i = 0; $i < $datos_seguimiento["numcampos"]; $i++) {
    $responsable=explode(",", $datos_seguimiento[$i]["responsable_seguimiento"]);
    transferencia_automatica($formato[0]["idformato"], $datos_seguimiento[$i]["documento_iddocumento"],implode("@",$responsable) , 3, "Notificacion Saia, falta 5 dias o menos para la fecha de Seguimiento");
    $update="UPDATE ft_hallazgo SET notifica_seg=1 WHERE documento_iddocumento=".$datos_seguimiento[$i]["documento_iddocumento"];
    phpmkr_query($update);
  }
}

$datos_cumplimiento = busca_filtro_tabla("responsables,documento_iddocumento", "ft_hallazgo h,documento d","d.iddocumento=h.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and (notifica_cump is null or notifica_cump=0) and '".$hoy."'<=TO_CHAR(tiempo_cumplimiento,'YYYY-MM-DD') AND '".$nuevafecha."'>=TO_CHAR(tiempo_cumplimiento,'YYYY-MM-DD')", "", $conn);
if ($datos_cumplimiento["numcampos"]) {
  for ($i = 0; $i < $datos_cumplimiento["numcampos"]; $i++) {
    $responsable=explode(",", $datos_cumplimiento[$i]["responsable_seguimiento"]);
    transferencia_automatica($formato[0]["idformato"], $datos_cumplimiento[$i]["documento_iddocumento"],implode("@",$responsable) , 3, "Notificacion Saia, falta 5 dias o menos para la fecha de Seguimiento");
    $update2="UPDATE ft_hallazgo SET notifica_cump=1 WHERE documento_iddocumento=".$datos_cumplimiento[$i]["documento_iddocumento"];
    phpmkr_query($update2);
  }
}


$log = fopen($ruta_db_superior . "tareas/tareas_administrativas_saia/logs/log_hallazgo.txt", "a+");
fwrite($log, date("Y-m-d H:m:s") . "\r\nSQL:" . $datos_seguimiento["sql"].\r\n.$datos_cumplimiento["sql"].\r\n);
fclose($log);
@session_unset();
@session_destroy();
