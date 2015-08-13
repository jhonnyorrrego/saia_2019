<?php
include_once("../db.php"); 
error_reporting(0);
if(isset($_POST['sql'])&& strpos($_POST['sql'],"reiniciar_pagina=1")!==false)
  $_POST['page']=1;
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];
if (!$sortname) $sortname = 'fecha';
if (!$sortorder) $sortorder = 'desc';
		  
$sort = "ORDER BY $sortname $sortorder";
if (!$page) $page = 1;
if (!$rp) $rp = 10;
$start = (($page-1) * $rp);
$stop=$start + $rp-1;
$sql1="Select de,para,asunto,estado,idcorreo,codificacion,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha from correo_usuario where funcionario=".usuario_actual("funcionario_codigo");
$result=$conn->Ejecutar_Limit($sql1." $where $sort",$start,$stop,$conn);
if(MOTOR=="Oracle")
   $sql_aux="select count(*) as registros from (".$sql1." $where".")";
if(MOTOR=="MySql")
   $sql_aux="select count(*) as registros from (".$sql1." $where".") b";
 
$rs = phpmkr_query($sql_aux, $conn);
$fila=phpmkr_fetch_row($rs);
$total=$fila[0];     
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "rows: [";
$rc = false;
$j=0;
while ($row = phpmkr_fetch_array($result)) {
if ($rc) $json .= ",";
$json .= "\n{";
$json .= "id:'".$row['idcorreo']."',";
$json .= "cell:['";
$json .= '<a href="#" onclick="procesar_link('.$row['idcorreo'].',1)" ><img src="../botones/formatos/ventana_externa.png" border="0px" title="Vista Previa"/></a>&nbsp;<a href="#" onclick="procesar_link('.$row['idcorreo'].',3)" ><img src="../botones/email/email_delete.png" border="0px" title="Eliminar"/></a>&nbsp;<!--a href="#" onclick="procesar_link('.$row['idcorreo'].',4)" ><img src="../botones/email/email_go.png" border="0px" title="Mover o copiar"/></a-->';
if($row['estado']=="Read")
  $json .= '&nbsp;<a href="#" onclick="procesar_link('.$row['idcorreo'].',5)" ><img src="../botones/email/email.png" border="0px" title="Marcar como no le&iacute;do"/></a>';
$json .= "','".agregar_imagen($row['estado'])."'";
$json .= ",'".addslashes(codifica($row['de']))."'";
$json .= ",'".addslashes(codifica($row['asunto']))."'";
$json .= ",'".addslashes(codifica($row['fecha']))."'";
$json .= "]}";
$rc = true; 
}
$json .= "],\n";
$json .= "total: $total\n";
$json .= "}";
echo $json;
function agregar_imagen($estado)
{switch($estado)
  {case 'Read':return('<img title="Le&iacute;do" src="../botones/email/email_open.png" />');
   break;
   case 'Unread':return('<img title="Sin leer" src="../botones/email/email.png" />');
   break;
  } 
}
function codifica($str)
{
$resultado=preg_split("/[\s]+/",$str);
return implode(" ",$resultado);
}
?>