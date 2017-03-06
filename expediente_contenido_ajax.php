<?php
include_once("db.php");
//include_once("permisos_tabla.php");
$idexpediente=$_REQUEST["sql"];
error_reporting(0);
$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];
$cod_usu=usuario_actual("funcionario_codigo");
$id_usu=usuario_actual("id");

$prop_cargo="0";
$prop_dependencia="0";
$cond_expediente="";
  
if($idexpediente)
{/*$_POST['sql']="select idexpediente as id,nombre,fecha,'expediente' as tipo,1 as orden,'' as numero from expediente where cod_padre='$idexpediente' and (propietario='$id_usu' or ver_todos=1 or editar_todos=1)
union select idexpediente as id,nombre,fecha,'expediente' as tipo,1 as orden,'' as numero from expediente,permiso_expediente_func p where expediente_idexpediente=idexpediente and cod_padre='$idexpediente' and funcionario='$id_usu'
union select iddocumento as id,d.descripcion as nombre,d.fecha,'documento' as tipo,2 as orden,numero from documento d,expediente_doc where documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and expediente_idexpediente=$idexpediente";   */
 $_POST['sql']="select idexpediente as id,nombre,fecha,'expediente' as tipo,1 as orden,'' as numero from expediente where cod_padre='$idexpediente' 
union select iddocumento as id,d.descripcion as nombre,d.fecha,'documento' as tipo,2 as orden,numero from documento d,expediente_doc where documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and expediente_idexpediente=$idexpediente"; 
//echo $_POST['sql'];
if (!$sortname) $sortname = 'orden,nombre';
if (!$sortorder) $sortorder = 'asc';
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
$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);
$stop=$start + $rp-1;

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
$busqueda_general=0;
$radicador = new PERMISO();
$busqueda_general=$radicador->acceso_modulo_perfil("permiso_busqueda_general");

while ($row = phpmkr_fetch_array($result)) 
{if($row['tipo']=="documento" && !$busqueda_general) 
   {$permiso=0;
    $transferencias=busca_filtro_tabla("count(idtransferencia)","buzon_salida","archivo_idarchivo='".$row["id"]."' and (origen='$cod_usu' or destino='$cod_usu') ","",$conn);
    if($transferencias[0][0])
      $permiso=1;
   }
  else
   $permiso=1; 
  if ($rc) $json .= ",";
  $json .= "\n{cell:[";
  $json .= "'".iconos($permiso,$row["id"],$row["tipo"])."'";
  $json .= ",'";
  if($row['numero']<>"")
    $json .="Rad. ".$row['numero']." ";
  $json .=addslashes($row['nombre'])."'";
  $json .= ",'".addslashes($row['fecha'])."'";
  $json .= ",'";
  if($row['tipo']=="documento"&& $permiso)
    $json .= "<input type=\"checkbox\" name=\"transferir\" value=\"".$row['id']."\">";
  $json .="'";  
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
}
function iconos($permiso,$llave,$tipo)
{global $conn,$idexpediente;
 $texto="";
 $imagen_vista_previa="botones/expedientes/page_white_magnify.png";
 $imagen_documento="botones/expedientes/page_white_go.png";
 $imagen_acceso="imgs/hijo.gif";
 $imagen_expediente="botones/expedientes/folder_go.png";
 $imagen_vacio="imgs/blank.gif";
 
 if($tipo=="documento")
 {$documento=busca_filtro_tabla("","documento,expediente_doc","iddocumento=$llave and documento_iddocumento=iddocumento and expediente_idexpediente=$idexpediente","",$conn); 
 if($permiso)
  {
   if($documento[0]["plantilla"]!="")
    { $plant = strtolower($documento[0]["plantilla"]);
      $idplant = busca_filtro_tabla("idformato,nombre","formato","nombre like '$plant'","",$conn);
      $iddoc_plant = busca_filtro_tabla("idft_".$plant,"ft_".$plant,"documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);                       
      $texto.='<a href="formatos/arboles/parsear_accion_arbol.php?id='.$idplant[0][0].'-idft_'.$plant.'-'.$iddoc_plant[0][0].'&accion=mostrar&llave='.$documento[0]["iddocumento"].'"  target="_blank"><img src="'.$imagen_vista_previa.'" border="0px" title="Vista Previa" /></a>';
    }
    else
    { 
      $texto.='<a href="visor_imagenes.php?key='.$documento[0]["iddocumento"].'" target="_blank"><img title="Vista Previa" src="'.$imagen_vista_previa.'" border="0px" /></a>';                      
    }
   $texto.='<a href="documentoview.php?key='.$documento[0]["iddocumento"].'&modulo=64&mostrar_menu=1" ><img title="Detalles del documento" src="'.$imagen_documento.'" border="0px" /></a>&nbsp';
   $texto.="<a href=\"#\" onclick=\"if(confirm(\'Esta seguro de eliminar el documento del expediente?\')) window.location=\'expedientedelete.php?idexpediente=".$documento[0]["idexpediente_doc"]."&key=$idexpediente&pantalla=listar\';\"><img src=\"botones/expedientes/page_white_delete.png\" border=\"0\" title=\"Eliminar del expediente\" ></a>"; 
   $texto.="<a href=\"expediente_documento_copiar.php?iddoc=".$documento[0]["iddocumento"]."&key=$idexpediente&pantalla=listar\"><img src=\"botones/expedientes/folder_page.png\" border=\"0\" title=\"Copiar o Mover a otro expediente\" ></a>";
   }
  else
     $texto.='<a href="#" title="Personas que tienen el documento"  onclick="abrir_popup('.$documento[0]["iddocumento"].',1)" ><img src="'.$imagen_acceso.'" border="0px" /></a>';
 }
else
 {$texto.='<a href="#" onclick="abrir_popup('.$llave.',2)" ><img src="botones/expedientes/folder_explore.png" border="0px" title="Vista Previa"/></a>'; 
  $texto.='<a href="expediente_detalles.php?key='.$llave.'&vista=1" ><img title="Detalles" src="'.$imagen_expediente.'" border="0px" /></a>'; 
 }     
 return($texto);     
}
?>
