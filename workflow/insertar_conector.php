<?php
session_start();
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
global $conn;

$inicial = $_REQUEST["nodoinicial"];
$final = $_REQUEST["nodofinal"];
$idconector = $_REQUEST["conector"];
$diagrama = $_SESSION['id_diagramaxxx'];
if($inicial != "" && $diagrama != ""){
    if($inicial == 0)
      $inicial = -1;
    if($inicial == 1)
      $inicial = -2;
    $sql = "INSERT INTO paso_enlace_temporal (origen,idconector,diagram_iddiagram) values('".$inicial."',".$idconector.",".$diagrama.")";
    phpmkr_query($sql);
}
if($final != "" && $diagrama != ""){
    if($final == 0)
      $final = -1;
    if($final == 1)
      $final = -2;
    $buscarultimo = busca_filtro_tabla("max(idpaso_enlace_temporal) as ultimo","paso_enlace_temporal","","",$conn);
    $sql = "UPDATE paso_enlace_temporal SET destino='".$final."' WHERE idpaso_enlace_temporal=".$buscarultimo[0]["ultimo"]." and diagram_iddiagram=".$diagrama;
    phpmkr_query($sql);
}
?>