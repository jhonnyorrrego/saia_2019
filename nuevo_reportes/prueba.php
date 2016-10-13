<?php
$page = $_GET['page']; // get the requested page 
$limit = $_GET['rows']; // get how many rows we want to have into the grid 
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
$sord = $_GET['sord']; // get the direction 
if(!$sidx) $sidx =1; // connect to the database 
$db = ($GLOBALS["___mysqli_ston"] = mysqli_connect("saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com",  "saia",  "cerok_saia421_5")) or die("Connection Error: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))." AQUI"); 
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . saia_nucleo)) or die("Error conecting to db."); 
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(*) AS count FROM funcionario a WHERE 1=1"); 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
$count = $row['count']; 
if( $count >0 ) { 
  $total_pages = ceil($count/$limit); 
} else { 
  $total_pages = 0; 
} 
if ($page > $total_pages) 
  $page=$total_pages; 
$start = $limit*$page - $limit; // do not put $limit*($page - 1) 
$SQL = "SELECT a.idfuncionario, a.nombres, a.apellidos, a.login,a.clave,a.nombres,a.apellidos FROM funcionario a WHERE 1=1 ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysqli_query($GLOBALS["___mysqli_ston"],  $SQL ) or die("Couldn t execute query.".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 
$responce->page = $page; 
$responce->total = $total_pages; 
$responce->records = $count; 
$i=0; 
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
  $responce->rows[$i]['id']=$row[idfuncionario]; 
  $responce->rows[$i]['cell']=array($row[idfuncionario],$row[nombres],$row[apellidos],$row[login],$row[clave],$row[nombres],$row[epellidos]); $i++; 
} 
echo json_encode($responce);