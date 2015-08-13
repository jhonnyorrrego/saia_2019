<?php
$page = $_GET['page']; // get the requested page 
$limit = $_GET['rows']; // get how many rows we want to have into the grid 
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
$sord = $_GET['sord']; // get the direction 
if(!$sidx) $sidx =1; // connect to the database 
$db = mysql_connect("saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com", "saia", "cerok_saia421_5") or die("Connection Error: " . mysql_error()." AQUI"); 
mysql_select_db("saia_nucleo") or die("Error conecting to db."); 
$result = mysql_query("SELECT COUNT(*) AS count FROM funcionario a WHERE 1=1"); 
$row = mysql_fetch_array($result,MYSQL_ASSOC); 
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
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
$responce->page = $page; 
$responce->total = $total_pages; 
$responce->records = $count; 
$i=0; 
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
  $responce->rows[$i]['id']=$row[idfuncionario]; 
  $responce->rows[$i]['cell']=array($row[idfuncionario],$row[nombres],$row[apellidos],$row[login],$row[clave],$row[nombres],$row[epellidos]); $i++; 
} 
echo json_encode($responce);