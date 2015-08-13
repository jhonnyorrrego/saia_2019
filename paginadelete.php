<?php   
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", true); 
  header("Pragma: no-cache"); // HTTP/1.0 xº
include_once("db.php"); 
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
 if($config["numcampos"])
 {
  $style = "<style type='text/css'>
   .encabezado 
   { background-color:".$config[0]["valor"].";
     color:white ; 
     padding:10px; 
     text-align: left;
   }
   </style>";
  }    
  else
  {  $style = " <style type='text/css'>
  .encabezado 
   { background-color:#073A78;
     color:white ; 
     padding:10px; 
     text-align: left;
   }
   </style>";
  } 
 echo $style;  
?>
<style type="text/css">
 .phpmaker 
 {
   font-family: Verdana; 
   font-size: 9px;
 }
 .imagen_internos 
 {
   vertical-align:middle
 } 
 .internos 
 {
   font-family: Verdana; 
   font-size: 9px; 
   font-weight: bold;
 }
</style>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) 
{  
  if(EW_this.x_detalle.value=="")
  { 
    alert("Por favor escriba una justificacion de la eliminacion de la pagina.");
    return false;
  }
  else  
  { var jus = EW_this.x_detalle.value;
    var num = jus.length;    
   if(num <= 10 )
   { alert("La justificacion debe tener mas de 10 caracteres.");
    return false;
   }
  }      
  return true;
}
-->
</script>
<?php
$x_consecutivo = Null;
$x_id_documento = Null;
$x_imagen = Null;
$fs_x_imagen = 0;
$fn_x_imagen = "";
$ct_x_imagen = "";
$w_x_imagen = 0;
$h_x_imagen = 0;
$a_x_imagen = "";
$x_pagina = Null;
$x_ruta=Null;
$x_detalle=Null;
$numero=Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

$sKey = $_SESSION["pagina_actual"];
if(isset($_REQUEST["doc"]))
 $llave = @$_REQUEST["doc"];
elseif(isset($_REQUEST["key"]))
   $llave = @$_REQUEST["key"];  
else 
 $llave=@$_SESSION["iddoc"]; 

if (($sKey == "") || (($sKey == NULL)))  
  $sKey = @$_POST["key_d"];
if (isset($_POST["llave_d"]) && $_POST["llave_d"]!="")
  $llave = @$_POST["llave_d"];
$x_id_documento=$llave;
$paginas = busca_filtro_tabla("A.*","pagina A","id_documento=$llave","",$conn);  //Validar si el documento tiene paginas
if(!($paginas["numcampos"]))
{
  echo utf8_encode("<script type='text/javascript'>alert('El documento no tiene paginas'); parent.centro.location='ordenar.php?key=".$llave."&accion=mostrar';</script>");  
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

if (($sKey == "") || (($sKey == NULL))) 
{
  alerta(utf8_encode("Debe seleccionar una pagina"));
  redirecciona("ordenar.php?key=".$x_id_documento."&accion=mostrar");
  exit(); 
}
$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "consecutivo=" . trim($sKey) . "";

$sAction = @$_POST["a_delete"];
$x_detalle = @$_POST["x_detalle"];
if (($sAction == "") || (($sAction == NULL))) 
$sAction = "I";	// Display with input box

switch ($sAction)
{
  case "I": // Display
    if (LoadRecordCount($sDbWhere,$conn) <= 0) 
    {
      redirecciona("ordenar.php?key=".$x_id_documento."&accion=mostrar");
      exit();
    }
  break;
  case "D": // Delete
    $numero=$_POST["numero"];
    $x_pagina=$_POST["x_pagina"];
    $x_id_documento=DeleteData($sDbWhere,$llave,$conn);
    if ($x_id_documento) 
    {
  //    $_SESSION["ewmsg"] = "BORRADO EXITOSO PARA EL REGISTRO = " . stripslashes($sKey);
      redirecciona("ordenar.php?key=".$x_id_documento."&accion=mostrar");
      exit();
    }
  break;
}
$nRecCount = 0;
foreach ($arRecKey as $sRecKey) 
{
  $sRecKey = trim($sRecKey);
  $sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
  $nRecCount = $nRecCount + 1;
  // Set row color
  $sItemRowClass = " bgcolor=\"#FFFFFF\"";
  // Display alternate color for rows
  if ($nRecCount % 2 <> 0) {
  $sItemRowClass = " bgcolor=\"#F5F5F5\"";
  }
  if (LoadData($sRecKey,$conn)) 
  {
    ?>
    <span class="internos"><img class="imagen_internos" src="images/eliminar_pagina.png" border="0">&nbsp;&nbsp;ELIMINAR P&Aacute;GINA DEL DOCUMENTO</span>
    <form action="paginadelete.php" method="post" onSubmit="return EW_checkMyForm(this);">
    <p>
    <input type="hidden" name="a_delete" value="D">
    <?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
    <input type="hidden" name="key_d" value="<?php echo  ($sKey); ?>">
    <input type="hidden" name="llave_d" value="<?php echo  ($llave); ?>">
    <input type="hidden" name="numero" value="<?php echo($numero);?>">
    <input type="hidden" name="x_pagina" value="<?php echo($x_pagina);?>">
    <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <tr class="encabezado">
    <td width="175" valign="top"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO ASOCIADO</span></td>
    <td width="56" valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo $numero; ?></font></span></td>
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO DE P&Aacute;GINA</span></td>
    <td width="56" valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo $x_pagina; ?></font></span></td>
    </tr>
    <tr<?php echo $sItemRowClass;?>>
    <td colspan="4"><div align="center"><span class="phpmaker">
    </span><span class="phpmaker">
    <?php if (($x_imagen != NULL) &&  $x_imagen <> "") { ?>
    <img src="<?php print ($x_imagen);?>" alt="Ruta <?php print($x_ruta)?>">
    <?php } ?></span></div>
    </td></tr>
    <tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF;">JUSTIFICACI&Oacute;N</span></td>
    <td width="56" valign="top" bgcolor="#F5F5F5" colspan="3"><span class="phpmaker"><font color="#000000">
    <textarea cols="35" rows="2" id="x_detalle" name="x_detalle"><?php echo @$x_detalle; ?></textarea>
    </font></span></td>
    </tr>
    <tr><td colspan="4" bgcolor="#F5F5F5"><center><input type="submit" name="Action" value="Confirmar Borrado"></center></td></tr>
    </table>
    <p>
    </form>
    <?php
  }
  else
     utf8_encode("<script type='text/javascript'>alert('Por favor seleccione la pagina del documento que desea eliminar'); parent.centro.location='ordenar.php?key=".$llave."&accion=mostrar';</script>");
}
?>

<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
function LoadData($sKey,$conn)
{
  global $_SESSION;
  global $x_consecutivo;
  global $x_id_documento;
  global $x_imagen;
  global $x_pagina;
  global $x_ruta;
  global $x_detalle;
  global $numero;
  global $llave;
  $sKeyWrk = "" . addslashes($sKey) . "";
  $sSql = "SELECT A.* FROM pagina A";
  $sSql .= " WHERE consecutivo = " . $sKeyWrk." AND id_documento=$llave";
  $sGroupBy = "";
  $sHaving = "";
  $sOrderBy = "";
  if ($sGroupBy <> "") 
  {
   $sSql .= " GROUP BY " . $sGroupBy;
  }
  if ($sHaving <> "") 
  {
   $sSql .= " HAVING " . $sHaving;
  }
  if ($sOrderBy <> "") 
  {
   $sSql .= " ORDER BY " . $sOrderBy;
  }
  $rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row)
  {
   $LoadData = false;
  }
  else
  {
  $LoadData = true;
  // Get the field contents
  $x_consecutivo = $row["consecutivo"];
  $x_id_documento = $row["id_documento"];
  $x_imagen = $row["imagen"];
  $x_pagina = $row["pagina"];
  $x_ruta = $row["ruta"];
  $x_detalle = $row["detalle"];
  $numero_radicado = busca_tabla("documento",$x_id_documento);
  $numero = $numero_radicado[0]["numero"];
  }
  phpmkr_free_result($rs);
  //print_r($row);
  //die($LoadData);
  return $LoadData;
}
?>
<?php
//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey
function LoadRecordCount($sqlKey,$conn)
{
global $_SESSION; 
$sSql = "SELECT A.* FROM pagina A";
$sSql .= " WHERE " . $sqlKey;
$sGroupBy = "";
$sHaving = "";
$sOrderBy = "";
if ($sGroupBy <> "") {
$sSql .= " GROUP BY " . $sGroupBy;
}
if ($sHaving <> "") {
$sSql .= " HAVING " . $sHaving;
}
if ($sOrderBy <> "") {
$sSql .= " ORDER BY " . $sOrderBy;
}
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$temp=array();
  $temp=phpmkr_fetch_array($rs);
  $i=0;
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
	phpmkr_free_result($rs);
  return $i;
}
?>
<?php
//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey
function DeleteData($sqlKey,$llave,$conn)
{
global $_SESSION;
global $x_detalle,$numero,$x_pagina;
//die($x_detalle.$numero.$x_pagina);
$sSql = "Delete FROM pagina";
$sSql .= " WHERE " . $sqlKey;
$sGroupBy = "";
$sHaving = "";
$sOrderBy = "";
if ($sGroupBy <> "") {
$sSql .= " GROUP BY " . $sGroupBy;
}
if ($sHaving <> "") {
$sSql .= " HAVING " . $sHaving;
}
if ($sOrderBy <> "") {
$sSql .= " ORDER BY " . $sOrderBy;
}
$rutaD=$llave;  

//se cambia la ruta de la pagina eliminada a la carpeta eliminados
$inf_eliminado = busca_filtro_tabla("imagen,ruta","pagina",$sqlKey,"",$conn);
if($inf_eliminado["numcampos"]>0)
{  $pag = substr($sqlKey,12); 
   $ruta1=$inf_eliminado[0]["imagen"];
   $eliminacion="../backup/eliminados/$rutaD";
   $nombre=$eliminacion."/".date("Y-m-d_H_i_s")."_".basename($inf_eliminado[0]["ruta"]);
   crear_destino($eliminacion);
   copy($inf_eliminado[0]["ruta"],$nombre);
    //se eliminan las imagenes de las carpetas 
  if(unlink($inf_eliminado[0]["imagen"]) && unlink($inf_eliminado[0]["ruta"]))
    alerta("ELIMINACION EXITOSA DE LA PAGINA");   
   phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
   
   $estampa = busca_filtro_tabla("","pagina_estampado","pagina_idpagina=".$pag,"",$conn);
   unlink($estampa[0]["ruta_archivo"]);
   $sql_estampado = "DELETE FROM pagina_estampado WHERE pagina_idpagina=".$pag;
   phpmkr_query($sql_estampado,$conn);
   
   $x_detalle= "Identificador: $pag ,Nombre: ".basename($inf_eliminado[0]["ruta"])." ,Justificaci&oacute;n: ".htmlentities($x_detalle)." <a href=\"$nombre\" target=\"_blank\" >Imagen</a>";
   registrar_accion_digitalizacion($rutaD,'ELIMINACION PAGINA',$x_detalle);
   //se eliminanan los comentarios de la pagina eliminada
   $sql_eliminar_nota = "DELETE FROM comentario_img WHERE pagina=".$pag;
   phpmkr_query($sql_eliminar_nota,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sql_eliminar_nota);
  $extension ="";
$lista=busca_filtro_tabla("A.*","pagina A","id_documento=".$rutaD,"pagina",$conn);
for($i=0; $i<$lista["numcampos"]; $i++)
  { 
  	$actualizar = "update pagina set pagina=".($i+1)." where consecutivo = ".$lista[$i]["consecutivo"];
    $datos_archivo = pathinfo($lista[$i]["imagen"]);
    $extension_miniatura = '.'.$datos_archivo['extension'];
    $datos_archivo = pathinfo($lista[$i]["ruta"]);
    $extension = '.'.$datos_archivo['extension'];
		
		$posmin=strpos($lista[$i]["imagen"],"miniaturas/");
		$nueva_miniatura=substr($lista[$i]["imagen"],0,$posmin)."miniaturas/"."doc".$rutaD."pag".($i+1).$extension_miniatura;
		
		$posdoc=strpos($lista[$i]["imagen"],"documentos/");
		$nuevo_doc=substr($lista[$i]["imagen"],0,$posmin)."documentos/"."doc".$rutaD."pag".($i+1).$extension;
		
		if($lista[$i]["imagen"]!=$nueva_miniatura){
			rename($lista[$i]["imagen"],$nueva_miniatura);
		} 
  	if($lista[$i]["ruta"]!=$nuevo_doc){
  		rename($lista[$i]["ruta"],$nuevo_doc);
			$sql1="UPDATE pagina SET imagen='".$nueva_miniatura."', ruta='".$nuevo_doc."' where consecutivo=".$lista[$i]["consecutivo"];
			phpmkr_query($sql1);
		}
		
  	phpmkr_query($actualizar,$conn) or error("Fallo la actualizacion" . phpmkr_error() . ' SQL:' . $actualizar);
  }
}
return $rutaD;
}
?>