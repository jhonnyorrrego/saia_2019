<?php
include_once("db.php");
include_once("funciones_buscador.php"); 
error_reporting(0);
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];
//permiso para el listado de tramitados
$radicador = new PERMISO();
$permiso = false;
$permiso=$radicador->acceso_modulo_perfil("lsalidas");

if (!$sortname) $sortname = 'nombres';
if (!$sortorder) $sortorder = 'desc';
		if($_POST['query']!=''){
			$where = "and ".$_POST['qtype']." LIKE '%".(($_POST['query']))."%' ";
		} else {
			$where ='';
		}
		if($_POST['letter_pressed']!=''){
			$where = "and ".$_POST['qtype']." LIKE '".$_POST['letter_pressed']."%' ";	
		}
		if($_POST['letter_pressed']=='#'){
			$where = " and ".$_POST['qtype']." REGEXP '[[:digit:]]' ";
		}
if($sortname=="numero")
  {if(MOTOR=="Oracle")
      $sortname="cast(numero as number)";
   else
      $sortname="cast(numero as unsigned)";      
  }		  
$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$stop=$start + $rp-1;

$_POST["sql"]=(stripslashes($_POST["sql"]));
//echo $_POST["sql"];
$result=$conn->Ejecutar_Limit($_POST["sql"]." $where $sort",$start,$stop,$conn);

if(MOTOR=="Oracle")
   $sql_aux="select count(*) as registros from (".$_POST["sql"]." $where".")";
if(MOTOR=="MySql")
   $sql_aux="select count(*) as registros from (".$_POST["sql"]." $where".") b";
 
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
$adicionales=array();
if($_POST["adicionales"]<>"")
  {$vector=explode(',',$_POST["adicionales"]);
   foreach($vector as $fila)
     {$datoa=explode("=",$fila);
      $adicionales[$datoa[0]]=$datoa[1];
     }
  }

while ($row = phpmkr_fetch_array($result)) {

if ($rc) $json .= ",";
$json .= "\n{cell:[";
if(isset($adicionales["pagina_exp"]))
$json.="'".checkbox_expediente($row['iddocumento'])."',";

if(isset($adicionales["vincular_documento"]))
$json.="'".checkbox_vincular_documento($row['iddocumento'])."',";

if($permiso)  
  $json.="'".chechbox_despacho($row['iddocumento'])."',";  
$json .= "'<a href=\"ordenar.php?accion=mostrar&mostrar_formato=1&key=".$row['iddocumento']."\">Detalles</a>'";
$json .= ",'".($row['fecha'])."'";
$json .= ",'".addslashes($row['numero'])."'";
$json .= ",'".addslashes($row['remitente'])."'";
$json .= ",'".addslashes(codifica($row['descripcion']))."'";
$json .= ",'".addslashes($row['plantilla'])."'"; 
$nombre_serie="No asignada";
if($row["serie"]){
  $serie=busca_filtro_tabla("nombre","serie","idserie=".$row["serie"],"",$conn);
  if($serie["numcampos"])
    $nombre_serie=$serie[0]["nombre"];
}
$json .= ",'".addslashes($nombre_serie)."'";
if($row['estado']!='GESTION' && $row['estado']!='CENTRAL' && $row['estado']!='HISTORICO'&& $row['estado']!='ANULADO')                                
  $json .=  ",'Pendiente / <br />Proceso'";
else
  $json .=  ",'".$row['estado']."'";  
$json .= "]}";
$rc = true; 

}
$json .= "],\n";
$json .= "total: $total\n";
$json .= "}";
echo $json;

function codifica($str)
{
$resultado=preg_split("/[\s]+/",$str);
return implode(" ",$resultado);
}
?>