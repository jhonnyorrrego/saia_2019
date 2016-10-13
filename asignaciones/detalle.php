<?php
include("../db.php");
(@$_GET['page'])?$page =$_GET['page']:$page=1;
(@$_GET['rows'])?$limit =$_GET['rows']:$limit=10;
(@$_GET['sidx'])?$sidx =$_GET['sidx']:$sidx=1;
(@$_GET['sord'])?$sord =$_GET['sord']:$sord="asc";
(@$_GET['id'])?$id =$_GET['id']:$id=0;
//$page = $_GET['page']; // get the requested page
/*$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$id = $_GET['id'];
if(!$sidx) $sidx =1;*/

// connect to the database
/*$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());

mysql_select_db($database) or die("Error conecting to db.");*/

$result = phpmkr_query("SELECT COUNT(*) AS count FROM control_asignacion WHERE asignacion_idasignacion=".$id,$conn);
$row = phpmkr_fetch_array($result);
$count = $row['count'];
if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
    if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if ($start<0)
  $start = 0;
$SQL = "SELECT * FROM control_asignacion WHERE asignacion_idasignacion=".$id." ORDER BY $sidx $sord LIMIT $start , $limit";
$result = phpmkr_query($SQL,$conn) or die("Error en la consulta.".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = phpmkr_fetch_array($result)) {
	$responce->rows[$i]['id']=$row["idcontrol_asignacion"];
  $responce->rows[$i]['cell']=array($row["accion"],($row["periocidad"]." ".$row["tipo_periocidad"]),($row["anticipacion"]." ".$row["tipo_anticipacion"]),$row["fecha_actualizacion"],"<a href=\"parsea_accion_asignacion.php?key=".$row["idcontrol_asignacion"]."&accion=ejecutar\" target=\"listado_docs\">Ejecutar</a>");
  $i++;
}
echo json_encode($responce);
?>
