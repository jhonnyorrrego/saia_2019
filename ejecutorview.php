<?php include ("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise
					
// Initialize common variables
$x_idejecutor = Null;
$x_identificacion = Null;
$x_tipo = Null;
$x_telefono = Null;
$x_nombre = Null;
$x_prioridad = Null;
$x_fecha_ingreso = Null;
$x_cargo = Null;
$x_direccion = Null;
$x_ciudad = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	header("Location: ejecutorlist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;		
			ob_end_clean();
			header("Location: ejecutorlist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/ejecutor.png" border="0">&nbsp;&nbsp;VER EJECUTOR REMITENTE<br>
<!--a href="<?php echo "ejecutoredit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "ejecutordelete.php?key=" . urlencode($sKey); ?>">Eliminar</a-->&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_identificacion; ?>
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$ox_tipo = $x_tipo; // Backup Original Value
$sTmp="";
$x_tipo = $sTmp;
?>
<?php echo $x_tipo; ?>
<?php $x_tipo = $ox_tipo; // Restore Original Value ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_ingreso,5); ?>
</span></td>
	</tr>
	</table><br /><table width=100%>
	<tr>
    <td class="encabezado_list">T&Iacute;TULO</td>
    <td class="encabezado_list">CARGO</td>
    <td class="encabezado_list">EMPRESA</td>
    <td class="encabezado_list">TEL&Eacute;FONO</td>
		<td class="encabezado_list">DIRECCI&Oacute;N</td>
		<td class="encabezado_list">EMAIL</td>
		<td class="encabezado_list">CIUDAD</td>
		<td class="encabezado_list">FECHA DEL CAMBIO</td>
	</tr>
<?php 
$datos=busca_filtro_tabla("datos_ejecutor.*,".fecha_db_obtener('fecha','Y-m-d')." as fecha","datos_ejecutor","ejecutor_idejecutor=$sKey","iddatos_ejecutor desc",$conn);

for($i=0;$i<$datos["numcampos"];$i++)
   {if($datos[$i]["ciudad"])
      {$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$datos[$i]["ciudad"],"",$conn);
       if($ciudad)
         $datos[$i]["ciudad"]=$ciudad[0]["nombre"];
       else
         $datos[$i]["ciudad"]="";  
      }
    else
      $datos[$i]["ciudad"]="";  
    echo '<tr>
		<td>'.$datos[$i]["titulo"].'</td>
		<td>'.$datos[$i]["cargo"].'</td>
		<td>'.$datos[$i]["empresa"].'</td>
    <td>'.$datos[$i]["telefono"].'</td>
		<td>'.$datos[$i]["direccion"].'</td>
    <td>'.$datos[$i]["email"].'</td>
		<td>'.$datos[$i]["ciudad"].'</td>
		<td>'.$datos[$i]["fecha"].'</td>
	  </tr>';
   }
?>	
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION, $x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_empresa;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*,".fecha_db_obtener("fecha_ingreso","Y-m-d")." as fecha_ingreso FROM ejecutor A";
	$sSql .= " WHERE A.idejecutor = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "idejecutor desc";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
	$datos=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$row["idejecutor"],"fecha desc",$conn);
		// Get the field contents
		$x_idejecutor = $row["idejecutor"];
		$x_identificacion = $row["identificacion"];
		$x_tipo = $row["tipo"];
		$x_telefono = $datos[0]["telefono"];
		$x_nombre = $row["nombre"];
		$x_prioridad = $row["prioridad"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
		$x_cargo = $datos[0]["cargo"];
		$x_direccion = $datos[0]["direccion"];
		$x_ciudad = $datos[0]["ciudad"];
		$x_empresa = $datos[0]["empresa"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
