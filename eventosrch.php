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

?><?php
// Initialize common variables
$x_idevento = Null;
$x_funcionario_codigo = Null;
$x_fecha = Null;
$x_evento = Null;
$x_tabla = Null;
$x_estado = Null;
$x_codigo = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_search"];
switch ($sAction)
{
	case "S": // Get Search Criteria

	// Build search string for advanced search, remove blank field
	$sSrchStr = "";

	// Field idevento
	$x_idevento = @$_POST["x_idevento"];
	$z_idevento = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_idevento"][0]) : @$_POST["z_idevento"][0]; 
	if ($x_idevento <> "") {
		$sSrchFld = $x_idevento;
		$sSrchWrk = "x_idevento=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_idevento=" . urlencode($z_idevento);
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

	// Field funcionario_codigo
	$x_funcionario_codigo = @$_POST["x_funcionario_codigo"];
	$z_funcionario_codigo = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_funcionario_codigo"][0]) : @$_POST["z_funcionario_codigo"][0]; 
	if ($x_funcionario_codigo <> "") {
		$sSrchFld = $x_funcionario_codigo;
		$sSrchWrk = "x_funcionario_codigo=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_funcionario_codigo=" . urlencode($z_funcionario_codigo);
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

	// Field evento
	$x_evento = @$_POST["x_evento"];
	$z_evento = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_evento"][0]) : @$_POST["z_evento"][0]; 
	if ($x_evento <> "") {
		$sSrchFld = $x_evento;
		$sSrchWrk = "x_evento=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_evento=" . urlencode($z_evento);
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

	// Field tabla
	$x_tabla = @$_POST["x_tabla"];
	$z_tabla = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_tabla"][0]) : @$_POST["z_tabla"][0]; 
	if ($x_tabla <> "") {
		$sSrchFld = $x_tabla;
		$sSrchWrk = "x_tabla=" . urlencode($sSrchFld);
		$sSrchWrk .= "&z_tabla=" . urlencode($z_tabla);
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
		header("Location: eventolist.php" . "?" . $sSrchStr);
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
if (EW_this.x_idevento && !EW_checkinteger(EW_this.x_idevento.value)) {
	if (!EW_onError(EW_this, EW_this.x_idevento, "NO", "Incorrect integer - idevento"))
		return false; 
}
if (EW_this.x_fecha && !EW_checkdate(EW_this.x_fecha.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha, "TEXT", "Incorrect date, format = yyyy/mm/dd - fecha"))
		return false; 
}
if (EW_this.x_codigo && !EW_checkinteger(EW_this.x_codigo.value)) {
	if (!EW_onError(EW_this, EW_this.x_codigo, "TEXT", "Incorrect integer - codigo"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/cargo.gif" border="0">&nbsp;&nbsp;B&Uacute;SQUEDA EN EL LOG<br><br>
<a href="eventolist.php">Regresar al listado</a></span></p>
<form name="eventosearch" id="eventosearch" action="eventosrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_search" value="S">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ID</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_idevento[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_idevento" value="<?php echo @$x_idevento; ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">como<input type="hidden" name="z_funcionario_codigo[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" id="x_funcionario_codigo" size="30" maxlength="60" name="x_funcionario_codigo" value="<?php echo htmlspecialchars(@$x_funcionario_codigo); ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_fecha[]" value="=,','"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,5); ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EVENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">como<input type="hidden" name="z_evento[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_evento" value="<?php echo htmlspecialchars("ADICIONAR"); ?>">
<?php echo "ADICIONAR"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_evento" value="<?php echo htmlspecialchars("MODIFICAR"); ?>">
<?php echo "MODIFICAR"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="radio" name="x_evento" value="<?php echo htmlspecialchars("ELIMINAR"); ?>">
<?php echo "ELIMINAR"; ?>
<?php echo EditOptionSeparator(2); ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TABLA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">como<input type="hidden" name="z_tabla[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_tabla" id="x_tabla" size="30" maxlength="90" value="<?php echo htmlspecialchars(@$x_tabla) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">como<input type="hidden" name="z_estado[]" value="LIKE,'%,%'"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_estado" id="x_estado" size="30" maxlength="3" value="<?php echo htmlspecialchars(@$x_estado) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_codigo[]" value="=,,"></span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Buscar">
</form>
<?php include ("footer.php") ?>
