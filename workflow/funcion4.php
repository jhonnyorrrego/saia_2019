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
global $conn;
include_once($ruta_db_superior."db.php");
	
	
	$diagrama = $_SESSION['id_diagramaxxx'];
	$id_figura = $_REQUEST['figura'];
	$nombre_paso = $_REQUEST['nombre_paso'];

    $x1 = $_REQUEST["x1"];
    $y1 = $_REQUEST["y1"];
    $x2 = $_REQUEST["x2"];
    $y2 = $_REQUEST["y2"];
    $posicion = $x1.",".$y1.",".$x2.",".$y2;
    if($id_figura != 0 && $id_figura != 1){
    $buscar = busca_filtro_tabla("","paso_temporal","figura_idfigura=".$id_figura." and diagram_iddiagram=".$diagrama,"",$conn);
    //print_r($buscar);
    if($buscar["numcampos"] == 0)
      $sql = "INSERT INTO paso_temporal (figura_idfigura,diagram_iddiagram,posicion) values(".$id_figura.",".$diagrama.",'".$posicion."')";
    else
      $sql = "UPDATE paso_temporal SET posicion='".$posicion."' WHERE figura_idfigura=".$id_figura." and diagram_iddiagram=".$diagrama;
    //print_r($buscar);
    phpmkr_query($sql);
    }
    
	//$_SESSION['id_diagramaxxx'] = null;
?>