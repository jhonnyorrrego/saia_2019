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

// User levels
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);																														
define("ewAllowAdmin", 16, true);						
?>
<?php

// Initialize common variables
$x_identidad_serie = Null;
$x_entidad_identidad = Null;
$x_serie_idserie = Null;
$x_llave_entidad = Null;
$x_estado = Null;
$x_tipo = Null;
$x_fecha = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_search"];
switch ($sAction)
{
	case "S": // Get Search Criteria

	// Build search string for advanced search, remove blank field
	$sSrchStr = "";

	// Field identidad_serie
	$x_identidad_serie = @$_POST["x_identidad_serie"];
	$z_identidad_serie = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_identidad_serie"][0]) : @$_POST["z_identidad_serie"][0]; 
	if ($x_identidad_serie <> "") {
		$sSrchFld = $x_identidad_serie;
		$sSrchWrk = "x_identidad_serie=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_identidad_serie=" . urlencode($z_identidad_serie);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field entidad_identidad
	$x_entidad_identidad = @$_POST["x_entidad_identidad"];
	$z_entidad_identidad = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_entidad_identidad"][0]) : @$_POST["z_entidad_identidad"][0]; 
	if ($x_entidad_identidad <> "") {
		$sSrchFld = $x_entidad_identidad;
		$sSrchWrk = "x_entidad_identidad=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_entidad_identidad=" . urlencode($z_entidad_identidad);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field serie_idserie
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$z_serie_idserie = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_serie_idserie"][0]) : @$_POST["z_serie_idserie"][0]; 
	if ($x_serie_idserie <> "") {
		$sSrchFld = $x_serie_idserie;
		$sSrchWrk = "x_serie_idserie=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_serie_idserie=" . urlencode($z_serie_idserie);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field llave_entidad
	$x_llave_entidad = @$_POST["x_llave_entidad"];
	$z_llave_entidad = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_llave_entidad"][0]) : @$_POST["z_llave_entidad"][0]; 
	if ($x_llave_entidad <> "") {
		$sSrchFld = $x_llave_entidad;
		$sSrchWrk = "x_llave_entidad=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_llave_entidad=" . urlencode($z_llave_entidad);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field estado
	$x_estado = @$_POST["x_estado"];
	$z_estado = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_estado"][0]) : @$_POST["z_estado"][0]; 
	if ($x_estado <> "") {
		$sSrchFld = $x_estado;
		$sSrchWrk = "x_estado=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_estado=" . urlencode($z_estado);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field tipo
	$x_tipo = @$_POST["x_tipo"];
	$z_tipo = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_tipo"][0]) : @$_POST["z_tipo"][0]; 
	if ($x_tipo <> "") {
		$sSrchFld = $x_tipo;
		$sSrchWrk = "x_tipo=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_tipo=" . urlencode($z_tipo);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}

	// Field fecha
	$x_fecha = @$_POST["x_fecha"];
	$z_fecha = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_fecha"][0]) : @$_POST["z_fecha"][0]; 
	if ($x_fecha <> "") {
		$sSrchFld = $x_fecha;
		$sSrchFld = ConvertDateToMysqlFormat($sSrchFld);
		$sSrchWrk = "x_fecha=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_fecha=" . urlencode($z_fecha);
	} else {
		$sSrchWrk = "";
	}
	if ($sSrchWrk <> "") {
		if ($sSrchStr == "") {
			$sSrchStr = $sSrchWrk;
		} else {
			$sSrchStr .= "&" . $sSrchWrk;
		}
	}
	if ($sSrchStr <> "") {
		ob_end_clean();
		header("Location: entidad_serielist.php" . "?" . $sSrchStr);
		exit();
	}
}

// Open connection to the database
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
if (EW_this.x_identidad_serie && !EW_checkinteger(EW_this.x_identidad_serie.value)) {
	if (!EW_onError(EW_this, EW_this.x_identidad_serie, "NO", "Entero Incorrecto - identidad serie"))
		return false; 
}
if (EW_this.x_llave_entidad && !EW_checkinteger(EW_this.x_llave_entidad.value)) {
	if (!EW_onError(EW_this, EW_this.x_llave_entidad, "TEXT", "Entero Incorrecto - FDC"))
		return false; 
}
if (EW_this.x_estado && !EW_checkinteger(EW_this.x_estado.value)) {
	if (!EW_onError(EW_this, EW_this.x_estado, "TEXT", "Entero Incorrecto - Estado"))
		return false; 
}
if (EW_this.x_tipo && !EW_checkinteger(EW_this.x_tipo.value)) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "TEXT", "Entero Incorrecto - Tipo"))
		return false; 
}
if (EW_this.x_fecha && !EW_checkdate(EW_this.x_fecha.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha, "NO", "Formato de fecha incorrecto yyyy/mm/dd - Fecha de creacion"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Búsqueda Tabla: entidad serie<br><br><a href="entidad_serielist.php">Regresar al listado</a></span></p>
<form name="entidad_seriesearch" id="entidad_seriesearch" action="entidad_seriesrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_search" value="S">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">identidad serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_identidad_serie[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_identidad_serie" value="<?php echo @$x_identidad_serie; ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Entidad Asociada</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_entidad_identidad[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_entidad_identidadList = "<select name=\"x_entidad_identidad\">";
$x_entidad_identidadList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT DISTINCT identidad, nombre FROM entidad" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_entidad_identidadList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["identidad"] == @$x_entidad_identidad) {
			$x_entidad_identidadList .= "' selected";
		}
		$x_entidad_identidadList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_entidad_identidadList .= "</select>";
echo $x_entidad_identidadList;
?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_serie_idserie[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_serie_idserieList = "<select name=\"x_serie_idserie\">";
$x_serie_idserieList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT DISTINCT idserie, nombre, codigo FROM serie" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_serie_idserieList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idserie"] == @$x_serie_idserie) {
			$x_serie_idserieList .= "' selected";
		}
		$x_serie_idserieList .= ">" . $datawrk["nombre"] . ValueSeparator($rowcntwrk) . $datawrk["codigo"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_serie_idserieList .= "</select>";
echo $x_serie_idserieList;
?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">FDC</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_llave_entidad[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_llave_entidad" id="x_llave_entidad" size="30" value="<?php echo htmlspecialchars(@$x_llave_entidad) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_estado[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_estado" id="x_estado" size="30" value="<?php echo htmlspecialchars(@$x_estado) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_tipo[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_tipo" id="x_tipo" size="30" value="<?php echo htmlspecialchars(@$x_tipo) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Fecha de creacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL<input type="hidden" name="z_fecha[]" value="=,','"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha" value="<?php echo @$x_fecha; ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Búsqueda">
</form>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
