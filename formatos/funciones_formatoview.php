<?php session_start(); ?>
<?php ob_start(); ?>
<?php

// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
$idformato=@$_REQUEST["idformato"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	header("Locationfunciones_formatolist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location funciones_formatolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Ver Funciones del Formato<br><br>
<a href="funciones_formatolist.php<?php if($idformato)echo("?idformato=".$idformato);?>">Ir al Listado</a>&nbsp;
<a href="<?php echo "funciones_formatoedit.php?key=" . urlencode($sKey); ?><?php if($idformato)echo("&idformato=".$idformato);?>">Edit</a>&nbsp;
<a href="<?php echo "funciones_formatodelete.php?key=" . urlencode($sKey); ?><?php if($idformato)echo("&idformato=".$idformato);?>">Delete</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre de la funci&oacute;</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre a mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Descripci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_descripcion; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_ruta; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Listado de Formatos a los que pertenece la Funcion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$formatos=busca_filtro_tabla('A.*','formato A, funciones_formato_enlace B',"A.idformato=B.formato_idformato  AND B.funciones_formato_fk=".$sKey,'GROUP BY B.formato_idformato ORDER BY etiqueta',conn);
    if($formatos["numcampos"]){
        echo("<ul>");
    for($i=0;$i<$formatos["numcampos"];$i++){
        	echo("<li>".html_entity_decode($formatos[$i]["etiqueta"])."</li>");
	}
    echo("</ul>");
	}
?>
<?php $x_formato = $ox_formato; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$ar_x_acciones = explode(",", @$x_acciones);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_acciones as $cnt_x_acciones) {
	switch (trim($cnt_x_acciones)) {
		case "a":
			$sTmp .= "Adicionar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "m":
			$sTmp .= "Mostrar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "Editar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_acciones = $x_acciones; // Backup Original Value
$x_acciones = $sTmp;
?>
<?php echo $x_acciones; ?>
<?php $x_acciones = $ox_acciones; // Restore Original Value ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
  $sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfunciones_formato = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_formato = $row["formato"];
		$x_acciones = $row["acciones"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
