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
$x_idestructura_calidad = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_nivel = Null;
$x_mostrar = Null;
$x_codigo = Null;
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

	// Field idestructura_calidad
	$x_idestructura_calidad = @$_POST["x_idestructura_calidad"];
	$z_idestructura_calidad = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_idestructura_calidad"][0]) : @$_POST["z_idestructura_calidad"][0]; 
	if ($x_idestructura_calidad <> "") {
		$sSrchFld = $x_idestructura_calidad;
		$sSrchWrk = "x_idestructura_calidad=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_idestructura_calidad=" . urlencode($z_idestructura_calidad);
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

	// Field nombre
	$x_nombre = @$_POST["x_nombre"];
	$z_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_nombre"][0]) : @$_POST["z_nombre"][0]; 
	if ($x_nombre <> "") {
		$sSrchFld = $x_nombre;
		$sSrchWrk = "x_nombre=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_nombre=" . urlencode($z_nombre);
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

	// Field cod_padre
	$x_cod_padre = @$_POST["x_cod_padre"];
	$z_cod_padre = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_cod_padre"][0]) : @$_POST["z_cod_padre"][0]; 
	if ($x_cod_padre <> "") {
		$sSrchFld = $x_cod_padre;
		$sSrchWrk = "x_cod_padre=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_cod_padre=" . urlencode($z_cod_padre);
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

	// Field nivel
	$x_nivel = @$_POST["x_nivel"];
	$z_nivel = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_nivel"][0]) : @$_POST["z_nivel"][0]; 
	if ($x_nivel <> "") {
		$sSrchFld = $x_nivel;
		$sSrchWrk = "x_nivel=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_nivel=" . urlencode($z_nivel);
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

	// Field mostrar
	$x_mostrar = @$_POST["x_mostrar"];
	$z_mostrar = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_mostrar"][0]) : @$_POST["z_mostrar"][0]; 
	if ($x_mostrar <> "") {
		$sSrchFld = $x_mostrar;
		$sSrchWrk = "x_mostrar=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_mostrar=" . urlencode($z_mostrar);
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

	// Field codigo
	$x_codigo = @$_POST["x_codigo"];
	$z_codigo = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_codigo"][0]) : @$_POST["z_codigo"][0]; 
	if ($x_codigo <> "") {
		$sSrchFld = $x_codigo;
		$sSrchWrk = "x_codigo=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_codigo=" . urlencode($z_codigo);
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
		header("Location: estructura_calidadlist.php" . "?" . $sSrchStr);
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
if (EW_this.x_idestructura_calidad && !EW_checkinteger(EW_this.x_idestructura_calidad.value)) {
	if (!EW_onError(EW_this, EW_this.x_idestructura_calidad, "NO", "Incorrect integer - idestructura calidad"))
		return false; 
}
if (EW_this.x_mostrar && !EW_checkinteger(EW_this.x_mostrar.value)) {
	if (!EW_onError(EW_this, EW_this.x_mostrar, "TEXT", "Incorrect integer - mostrar"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Search TABLE: estructura calidad<br><br><a href="estructura_calidadlist.php">Back to List</a></span></p>
<form name="estructura_calidadsearch" id="estructura_calidadsearch" action="estructura_calidadsrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_search" value="S">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">idestructura calidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_idestructura_calidad[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_idestructura_calidad" value="<?php echo @$x_idestructura_calidad; ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_nombre[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">cod padre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_cod_padre[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_cod_padreList = "<select name=\"x_cod_padre\">";
$x_cod_padreList .= "<option value=''>Please Select</option>";
$sSqlWrk = "SELECT DISTINCT idestructura_calidad, nombre FROM estructura_calidad" . " ORDER BY nombre Desc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_cod_padreList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idestructura_calidad"] == @$x_cod_padre) {
			$x_cod_padreList .= "' selected";
		}
		$x_cod_padreList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_cod_padreList .= "</select>";
echo $x_cod_padreList;
?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">nivel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_nivel[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" id="x_nivel" size="30" name="x_nivel" value="<?php echo htmlspecialchars(@$x_nivel); ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_mostrar[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_mostrar" id="x_mostrar" size="30" value="<?php echo htmlspecialchars(@$x_mostrar) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">codigo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_codigo[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" maxlength="255" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Search">
</form>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
