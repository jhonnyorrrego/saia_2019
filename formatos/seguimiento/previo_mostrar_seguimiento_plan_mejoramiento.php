<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;    
  }
  $ruta .= "../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");



$idformato_seguimiento_plan_mejoramiento=busca_filtro_tabla("idformato","formato","nombre='seguimiento'","",$conn);

?>

<?php include_once('../librerias/estilo_formulario.php'); include_once('../librerias/funciones_formatos_generales.php');?><?php listado_hijos_formato($idformato_seguimiento_plan_mejoramiento[0]['idformato'],$_REQUEST["iddoc"]); ?>