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
$x_titulo = Null;
$x_email = Null;
$x_empresa = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || (($sAction == NULL))) {
	$sKey = @$GET_["key"];
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
	$x_idejecutor = @$_POST["x_idejecutor"];
	$x_identificacion = @$_POST["x_identificacion"];
	$x_tipo = @$_POST["x_tipo"];
	$x_telefono = @$_POST["x_telefono"];
	$x_nombre = @$_POST["x_nombre"];
	$x_prioridad = @$_POST["x_prioridad"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_cargo = @$_POST["x_cargo"];
	$x_direccion = @$_POST["x_direccion"];
	$x_ciudad = @$_POST["x_ciudad"];
	$x_titulo = @$_POST["x_titulo"];
		$x_empresa = @$_POST["x_empresa"];
    $x_email = @$_POST["x_email"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;		
			ob_end_clean();
			header("Location: ejecutorlist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adicion de un nuevo registro";		
			ob_end_clean();
			header("Location: ejecutorlist.php");
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
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "RADIO", "Please enter required field - tipo"))
		return false;
}
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Please enter required field - nombre"))
		return false;
}
if (EW_this.x_fecha_ingreso && !EW_hasValue(EW_this.x_fecha_ingreso, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Please enter required field - fecha ingreso"))
		return false;
}
if (EW_this.x_fecha_ingreso && !EW_checkdate(EW_this.x_fecha_ingreso.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Incorrect date, format = yyyy/mm/dd - fecha ingreso"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/ejecutor.png" border="0">&nbsp;&nbsp;EJECUTOR REMITENTE<br></span></p>
<form name="ejecutoradd" id="ejecutoradd" action="ejecutoradd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_identificacion" id="x_identificacion" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_identificacion) ?>">
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_tipo)) || ($x_tipo == "")) { $x_tipo = 0;} // Set default value ?>
<input type="radio" name="x_tipo"<?php if (@$x_tipo == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "C&eacute;dula Ciudadan&iacute;a"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_tipo"<?php if (@$x_tipo == "2") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("2"); ?>">
<?php echo "C&eacute;dula Extranjer&iacute;a"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="radio" name="x_tipo"<?php if (@$x_tipo == "3") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("3"); ?>">
<?php echo "NIT"; ?>
<?php echo EditOptionSeparator(2); ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="55" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TITULO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker" id="td_titulo">
      <select name="x_titulo" >
          <option value="Se&ntilde;or" selected>Se&ntilde;or</option>
          <option value="Se&ntilde;ora" >Se&ntilde;ora</option>
          <option value="Doctor">Doctor</option>
          <option value="Doctora">Doctora</option>
          <option value="Ingeniera">Ingeniera</option>
          <option value="Ingeniero">Ingeniero</option>
        </select>
        <label style="text-decoration:underline;cursor: pointer" 
        onclick="document.getElementById('td_titulo').innerHTML='<td><input type=text name=x_titulo id=obligatorio></td>'";>OTRO
        </label>
</span></td>
</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TELEFONO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_telefono" id="x_telefono" size="55" value="<?php echo htmlspecialchars(@$x_telefono) ?>">
</span></td>
	</tr>	
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">fecha ingreso</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_fecha_ingreso != NULL) || ($x_fecha_ingreso == "")) { $x_fecha_ingreso = "CURRENT_TIMESTAMP";} // Set default value ?>
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo FormatDateTime(@$x_fecha_ingreso,5); ?>">
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_cargo" id="x_cargo" size="55" maxlength="150" value="<?php echo htmlspecialchars(@$x_cargo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EMPRESA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_empresa" id="x_empresa" size="55" maxlength="150" value="<?php echo htmlspecialchars(@$x_empresa) ?>">
</span></td>
	</tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EMAIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_email" id="x_email" size="55" maxlength="150" value="<?php echo htmlspecialchars(@$x_email) ?>">
</span></td>
	</tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIRECCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_direccion" id="x_direccion" size="55" value="<?php echo htmlspecialchars(@$x_direccion) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CIUDAD</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
    $ciudades=busca_filtro_tabla("idmunicipio,nombre","municipio","","nombre",$conn);

if($ciudades["numcampos"]>0)
  {echo '<select name="x_ciudad" id="obligatorio">
         <option value="" selected>Seleccionar...</option>';
   for($i=0; $i<$ciudades["numcampos"];$i++)
      echo "<option value='".$ciudades[$i]["idmunicipio"]."'>".$ciudades[$i]["nombre"]."</option>";
   echo '</select>';   
  }   
    ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="ADICIONAR">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION, $x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_titulo,$x_empresa,$x_email;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM ".DB.".ejecutor";
	$sSql .= " WHERE A.idejecutor = " . $sKeyWrk;
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
		$x_idejecutor = $row["idejecutor"];
		$x_identificacion = $row["identificacion"];
		$x_tipo = $row["tipo"];
		$x_telefono = $row["telefono"];
		$x_nombre = $row["nombre"];
		$x_prioridad = $row["prioridad"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
		$x_cargo = $row["cargo"];
		$x_direccion = $row["direccion"];
		$x_ciudad = $row["ciudad"];
		$x_titulo = $row["titulo"];
	  $x_empresa = $row["empresa"];
    $x_email = $row["email"];
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
	global $_SESSION;
	global $_POST,$x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_titulo,$x_empresa,$x_email;

	// Add New Record
	$sSql = "SELECT * FROM ".DB.".ejecutor";
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

	// Field identificacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_identificacion) : $x_identificacion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "''";
	$fieldList1["identificacion"] = $theValue;

	// Field tipo
	$theValue = ($x_tipo != "") ? intval($x_tipo) : "NULL";
	$fieldList["tipo"] = $theValue;

	// Field telefono
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_telefono) : $x_telefono; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList2["telefono"] = $theValue;

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList1["nombre"] = $theValue;

	// Field fecha_ingreso
	$fieldList1["fecha_ingreso"] =fecha_db_almacenar(date('Y-m-d H:i:s'),"Y-m-d H:i:s");

	// Field cargo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_cargo) : $x_cargo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList2["cargo"] =  $theValue;

	// Field direccion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_direccion) : $x_direccion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList2["direccion"] =  $theValue;

	// Field ciudad
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ciudad) : $x_ciudad; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList2["ciudad"] =  $theValue;
	// Field titulo
	$fieldList2["titulo"] = "'".@$x_titulo."'";
  $fieldList2["empresa"] = "'".@$x_empresa."'";
  $fieldList2["email"] = "'".@$x_email."'";
	// insert into database
	$strsql = "INSERT INTO ".DB.".ejecutor (";
	$strsql .= implode(",", array_keys($fieldList1));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList1));
	$strsql .= ")";

	phpmkr_query($strsql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$idejecutor=phpmkr_insert_id();
	$fieldList2["ejecutor_idejecutor"] =  $idejecutor;
	$strsql = "INSERT INTO ".DB.".datos_ejecutor (";
	$strsql .= implode(",", array_keys($fieldList2));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList2));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
  return true;
}
?>

