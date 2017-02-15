<?php include ("db.php");
include_once("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
 ?>
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
$x_idperfil = Null;
$x_nombre = Null;
?>
<?php include ("phpmkrfn.php") ?>
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
	$x_idperfil = @$_POST["x_idperfil"];
	$x_nombre = @$_POST["x_nombre"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No hay registros con la llave = " . $sKey;
			ob_end_clean();
			header("Location: permiso_perfiladd.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Se adicion&oacute; el registro con &eacute;xito";
			ob_end_clean();
			header("Location: permiso_perfiladd.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>

<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<?php
include_once("librerias_saia.php"); 
echo(librerias_jquery('1.7'));
echo(estilo_bootstrap());
echo(librerias_notificaciones());
?>
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	//if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor escriba el nombre del perfil"))
	notificacion_saia('<b>ATENCI&Oacute;N</b><br>Por favor escriba el nombre del perfil','warning','',4000);
		return false;
}
return true;
}

//-->
</script>




<div class="container">
		<h5><span class="internos"><img class="imagen_internos" src="botones/configuracion/perfil.gif" border="0"></span>ADICIONAR PERFIL</h5>

		<ul class="nav nav-tabs">
		  <li ><a href="permiso_perfiladd.php">Adicionar Permiso</a></li>
		     <li class="active"><a href="perfiladd.php">Adicionar Perfil</a></li>
		</ul>		
		<br/>


<form name="perfiladd" id="perfiladd" action="perfiladd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:100%;">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_nombre)) || ($x_nombre == "")) { $x_nombre = "ADMINISTRADOR";} // Set default value ?>
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="13">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar"  class='btn btn-primary'>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("perfiladd",1); 
function LoadData($sKey,$conn)
{   global $x_idperfil;
    global $x_nombre;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM perfil A";
	$sSql .= " WHERE A.idperfil = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idperfil = $row["idperfil"];
		$x_nombre = $row["nombre"];
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
   global $x_idperfil;
   global $x_nombre;
	// Add New Record
	$sSql = "SELECT * FROM perfil A";
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

	// insert into database
	$strsql = "INSERT INTO perfil (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")"; 
	phpmkr_query($strsql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}

?>
