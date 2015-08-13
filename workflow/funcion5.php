<?php
session_start();
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
$id = $_REQUEST["borrar_figura"];
$diagrama = $_SESSION['id_diagramaxxx'];
if($id != ""){
  $sql = "DELETE FROM paso WHERE idfigura=".$id." and diagram_iddiagram=".$diagrama;
  phpmkr_query($sql);
  $sql = "DELETE FROM paso_temporal WHERE figura_idfigura=".$id." and diagram_iddiagram=".$diagrama;
  phpmkr_query($sql);
  $sql = "DELETE FROM paso_enlace_temporal WHERE idconector=".$id." and diagram_iddiagram=".$diagrama;
  phpmkr_query($sql);
  $sql = "DELETE FROM paso_enlace WHERE idconector=".$id." and diagram_iddiagram=".$diagrama;
  phpmkr_query($sql);
}
?>