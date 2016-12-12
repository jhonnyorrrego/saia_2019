<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise

?>
<?php

// Initialize common variables
$x_idconfiguracion = Null;
$x_nombre = Null;
$x_valor = Null;
$x_tipo = Null;
//$x_fecha = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include_once ("librerias_saia.php"); echo(librerias_notificaciones()); ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{

	// Get fields from form
	$x_idconfiguracion = @$_POST["x_idconfiguracion"];
	$x_nombre = @$_POST["x_nombre"];
	$x_valor = @$_POST["x_valor"];
	$x_tipo = @$_POST["x_tipo"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;			
			ob_end_clean();
			header("Location: configuracionlist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adici�n exitosa del registro.";		
			ob_end_clean();
			header("Location: configuracionlist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	//if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "<b>ATENCI&Oacute;N</b><br>Por favor ingrese los campos requeridos - Nombre"))
	    notificacion_saia('<b>ATENCI&Oacute;N</b><br>Por favor ingrese los campos requeridos - Nombre','warning','',4000);
		return false;
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "TEXT" )) {
	//if (!EW_onError(EW_this, EW_this.x_tipo, "TEXT", "<b>ATENCI&Oacute;N</b><br>Por favor ingrese los campos requeridos - Tipo"))
	    notificacion_saia('<b>ATENCI&Oacute;N</b><br>Por favor ingrese los campos requeridos - Tipo','warning','',4000);
		return false;
}

return true;
}

//-->
</script>
<form name="configuracionadd" id="configuracionadd" action="configuracionadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">VALOR</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_valor" id="x_valor" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_valor) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_tipo" id="x_tipo" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_tipo) ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ global $x_idconfiguracion,$x_nombre,$x_valor,$x_tipo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM configuracion A";
	$sSql .= " WHERE A.idconfiguracion = " . $sKeyWrk;
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idconfiguracion = $row["idconfiguracion"];
		$x_nombre = $row["nombre"];
		$x_valor = $row["valor"];
		$x_tipo = $row["tipo"];		
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
global $x_nombre;
global $x_valor;
global $x_tipo;
global $x_fecha;
	// Add New Record
	$sSql = "SELECT * FROM configuracion A";
	$sSql .= " WHERE 0 = 1";
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

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field valor
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_valor) : $x_valor; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["valor"] = $theValue;

	// Field tipo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo) : $x_tipo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["tipo"] = $theValue;

	// Field fecha
	/*$theValue = ($x_fecha != "") ? " '" . ConvertDateToMysqlFormat($x_fecha) . "'" : "NULL";
	$fieldList["fecha"] = "to_date(".$theValue.",'YYYY-MM-DD HH24:MI:SS')";*/

	// insert into database
	$strsql = "INSERT INTO configuracion (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";

	phpmkr_query($strsql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>
