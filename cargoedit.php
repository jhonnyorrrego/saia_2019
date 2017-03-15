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
$x_idcargo = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_tipo_cargo = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include ("librerias_saia.php") ?>
<?php
include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idcargo");
desencriptar_sqli("form_info");
echo(librerias_jquery());
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idcargo = @$_POST["x_idcargo"];
	$x_nombre = @$_POST["x_nombre"];
	$x_estado = @$_POST["x_estado"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_tipo_cargo = @$_POST["x_tipo_cargo"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: cargolist.php");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: cargolist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			abrir_url("cargo.php","centro");
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - nombre"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="internos">EDITAR CARGOS<br></span></p>
<form name="cargoedit" id="cargoedit" action="cargoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcargo; ?><input type="hidden" name="x_idcargo" value="<?php echo $x_idcargo; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo (@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<input type="radio" name="x_tipo_cargo" value="1" <?php if($x_tipo_cargo==1)echo("checked"); ?>>Administrativo<br>
			<input type="radio" name="x_tipo_cargo" value="2" <?php if($x_tipo_cargo==2)echo("checked"); ?>>Funciones
		</td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php arbol_cargos("x_cod_padre",$x_cod_padre);
?>

</td>
	</tr>

<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php
//phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{global $x_idcargo;
global $x_nombre;
global $x_estado;
global $x_cod_padre;
global $x_tipo_cargo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM cargo A";
	$sSql .= " WHERE A.idcargo = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idcargo = $row["idcargo"];
		$x_nombre = $row["nombre"];
		$x_estado = $row["estado"];
		$x_tipo_cargo = $row["tipo_cargo"];
    $x_cod_padre= $row["cod_padre"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{global $x_idcargo;
global $x_nombre;
global $x_estado;
global $x_cod_padre;
global $x_tipo_cargo;
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM cargo A";
	$sSql .= " WHERE A.idcargo = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_estado) : $x_estado;
		$theValue = ($theValue != "") ?  $theValue  : "NULL";
		$fieldList["estado"] = " '" .$theValue. "'";
		$fieldList["cod_padre"] = " '" .$x_cod_padre. "'";
    $fieldList["tipo_cargo"]="'".$x_tipo_cargo."'";

		if($theValue==0)
		{
     phpmkr_query("update dependencia_cargo set estado=0 where cargo_idcargo=$sKeyWrk",$conn) or error("Fallo inactivar los roles del cargo");
    }
		// update
		$sSql = "UPDATE cargo SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idcargo =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
encriptar_sqli("cargoedit",1);
function arbol_cargos($campo,$seleccionados)
  {global $conn,$ruta_db_superior;
   ?>
 Buscar:
<input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),1)">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),0,1)">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value))">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>                            <br />
<div id="esperando_<?php echo $campo; ?>">
  <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_<?php echo $campo; ?>" height="90%">
</div>
<input type="hidden" maxlenght="11"  class="required"  name="<?php echo $campo; ?>" id="<?php echo $campo; ?>"   value="<?php echo($seleccionados); ?>" >
<label style="display:none" class="error" for="<?php echo $campo; ?>">Campo obligatorio.
</label>
<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_<?php echo $campo; ?>","100%","100%",0);
                			tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
                			tree_<?php echo $campo; ?>.enableIEImageFix(true);
                      tree_<?php echo $campo; ?>.enableCheckBoxes(1);
                      tree_<?php echo $campo; ?>.enableRadioButtons(true);
                      tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.enableSmartXMLParsing(true);
                      tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=cargo&estado=1&seleccionado=<?php echo $seleccionados; ?>&excluidos=<?php echo(@$_REQUEST["key"]); ?>");
                	    tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
                      function onNodeSelect_<?php echo $campo; ?>(nodeId)
                      {valor_destino=document.getElementById("<?php echo $campo; ?>");

                       if(tree_<?php echo $campo; ?>.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
   <?php
}
?>
