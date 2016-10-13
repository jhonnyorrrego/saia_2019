<?php
// Include the information needed for the connection to
// MySQL data base server.
include("../db.php");
//since we want to use a JSON data we should include
//encoder and decoder for JSON notation
//If you use a php >= 5 this file is not needed
include("JSON.php");

// create a JSON service
$json = new Services_JSON();

// to the url parameter are added 4 parameter
// we shuld get these parameter to construct the needed query
//

(@$_GET['page'])?$page =$_GET['page']:$page=1;
(@$_GET['rows'])?$limit =$_GET['rows']:$limit=10;
(@$_GET['sidx'])?$sidx =$_GET['sidx']:$sidx=1;
(@$_GET['sord'])?$sord =$_GET['sord']:$sord="asc";
(@$_GET['id'])?$id =$_GET['id']:$id=0;
// connect to the database
/*$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());

mysql_select_db($database) or die("Error conecting to db.");*/
$result = phpmkr_query("SELECT COUNT(*) AS count FROM asignacion WHERE 1=1",$conn);
$row = phpmkr_fetch_array($result);
$count = $row['count'];
//print_r($row);
if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
$SQL = "SELECT * FROM asignacion WHERE 1=1 ORDER BY $sidx $sord LIMIT $start , $limit";
$result = phpmkr_query( $SQL,$conn) or die("Couldn t execute query.".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = phpmkr_fetch_array($result)) {
  //print_r($row);
  $responce->rows[$i]['id']=$row["idasignacion"];
  $responce->rows[$i]['cell']=array($row["fecha_inicial"],$row["fecha_final"],$row["estado"],($row["reprograma"]." ".$row["tipo_reprograma"]),"<a href=\"parsea_accion_asignacion.php?key=".$row["idasignacion"]."&accion=completar\" target=\"listado_docs\">Declarar Terminada</a>");
  $i++;
}
echo json_encode($responce);
?>

