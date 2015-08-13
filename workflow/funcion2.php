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
	
	//echo $_SESSION['id_diagramaxxx'];
	
	$diagrama = $_SESSION['id_diagramaxxx'];
	$id_figura = $_REQUEST['id_figura'];
	$x1 = $_REQUEST['x1'];
	$y1 = $_REQUEST['y1'];
	$x2 = $_REQUEST['x2'];
	$y2 = $_REQUEST['y2'];
	
	if($_SESSION['id_diagramaxxx'] != ""){
		$comprobar_existencia = mysql_query("SELECT * FROM paso WHERE idfigura=$id_figura AND diagram_iddiagram=$diagrama");
		$res = mysql_fetch_array($comprobar_existencia);
		if($res > 0){
			$sql = "UPDATE paso SET posicion='$x1,$y1,$x2,$y2' WHERE idfigura=$id_figura AND diagram_iddiagram=$diagrama";
			mysql_query($sql);
		}
		//echo $sql;
	}
	//$_SESSION['id_diagramaxxx'] = null;
?>