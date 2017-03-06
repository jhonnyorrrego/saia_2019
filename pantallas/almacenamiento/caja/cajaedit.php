<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."calendario/calendario.php");
// Initialize common variables
$x_idcaja = Null;
$x_fondo = Null;
$x_subseccion = Null;
$x_division = Null;
$x_codigo = Null;
$x_serie_idserie = Null;
$x_no_carpetas = Null;
$x_no_cajas = Null;
$x_no_consecutivo = Null;
$x_no_correlativo = Null;
$x_fecha_extrema_i = Null;
$x_fecha_extrema_f = Null;
$x_estanteria = Null;
$x_panel = Null;
$x_material = Null;
$x_seguridad = Null;

$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idcaja = @$_POST["x_idcaja"];
  $x_fondo = @$_POST["x_fondo"];
  $x_subseccion = @$_POST["x_subseccion"];
	$x_division = @$_POST["x_division"];
	$x_codigo = @$_POST["x_codigo"];
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$x_no_carpetas = @$_POST["x_no_carpetas"];
	$x_no_cajas = @$_POST["x_no_cajas"];
	$x_no_consecutivo = @$_POST["x_no_consecutivo"];
	$x_no_correlativo = @$_POST["x_no_correlativo"];
	$x_fecha_extrema_i = @$_POST["x_fecha_extrema_i"];
	$x_fecha_extrema_f = @$_POST["x_fecha_extrema_f"];
  $x_estanteria = @$_POST["x_estanteria"];
  $x_panel = @$_POST["x_panel"];
  $x_material = @$_POST["x_material"];
  $x_seguridad = @$_POST["x_seguridad"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: cajalist.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
		abrir_url("cajaview.php?key=".$sKey,"_self");
		}
		break;
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {

if (EW_this.x_codigo.value==''){
	alert("Por favor ingrese los campos requeridos - codigo");
	return false;
}

if (EW_this.x_serie_idserie.value==''){
	alert("Por favor ingrese los campos requeridos - serie");
	return false;
}

if (EW_this.x_no_carpetas.value=='') {
	alert("Por favor ingrese los campos requeridos - no carpetas");
	return false;
}

if (EW_this.x_no_cajas.value=='') {
	alert("Por favor ingrese los campos requeridos - no cajas");
	return false;
}

if (EW_this.x_no_consecutivo.value=='') {
	alert("Por favor ingrese los campos requeridos - no consecutivo");
	return false;
}

if (EW_this.x_no_correlativo.value=='') {
	alert("Por favor ingrese los campos requeridos - no correlativo");
	return false;
}
if (EW_this.x_fecha_extrema_i.value=='') {
	alert("Entero Incorrecto - fecha extrema inicial");
	return false; 
}
if (EW_this.x_fecha_extrema_f.value=='') {
	alert("Entero Incorrecto - fecha extrema final");
	return false; 
}

}

//-->
</script>
<link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior; ?>css/dhtmlXTree.css">
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree.js"></script>
<?php include_once($ruta_db_superior."formatos/librerias/header_formato.php"); ?>
<form name="cajaedit" id="cajaedit" action="cajaedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CAJA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcaja; ?><input type="hidden" name="x_idcaja" value="<?php echo $x_idcaja; ?>">
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FONDO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fondo" id="x_fondo" size="30" maxlength="255" value="<?php echo $x_fondo; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_subseccion" id="x_subseccion" size="30" maxlength="255" value="<?php echo $x_subseccion; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIVISION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_division" id="x_division" size="30" maxlength="255" value="<?php echo $x_division; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CODIGO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="255" value="<?php echo $x_codigo; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php generar_arbol('x_serie_idserie',$x_serie_idserie); ?>
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CARPETAS*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_carpetas" id="x_no_carpetas" size="30" maxlength="255" value="<?php echo $x_no_carpetas; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CAJAS*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_cajas" id="x_no_cajas" size="30" maxlength="255" value="<?php echo $x_no_cajas; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CONSECUTIVO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_consecutivo" id="x_no_consecutivo" size="30" maxlength="255" value="<?php echo $x_no_consecutivo; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CORRELATIVO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_correlativo" id="x_no_correlativo" size="30" maxlength="255" value="<?php echo $x_no_correlativo; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTREMA INICIAL*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_extrema_i" id="x_fecha_extrema_i" size="25" maxlength="255" value="<?php echo $x_fecha_extrema_i; ?>" readonly>
</span><?php selector_fecha("x_fecha_extrema_i","cajaedit","Y-m-d H:i",date("m"),date("Y"),"default.css",$ruta_db_superior,""); ?></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTREMA FINAL*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_extrema_f" id="x_fecha_extrema_f" size="25" maxlength="255" value="<?php echo $x_fecha_extrema_f; ?>" readonly>
</span><?php selector_fecha("x_fecha_extrema_f","cajaedit","Y-m-d H:i",date("m"),date("Y"),"default.css",$ruta_db_superior,""); ?></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTANTERIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_estanteria" id="x_estanteria" size="30" maxlength="255" value="<?php echo $x_estanteria; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PANEL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_panel" id="x_panel" size="30" maxlength="255" value="<?php echo $x_panel; ?>">
</span></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MATERIAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_material" id="x_material" size="30" maxlength="255" value="<?php echo $x_material; ?>">
</span></td>
	</tr>
	
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SEGURIDAD</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select name="x_seguridad" id="x_seguridad">
<option value="1" <?php if($x_seguridad=='1') echo "selected"; ?>>Confidencial</option>
<option value="2" <?php if($x_seguridad=='2') echo "selected"; ?>>Publica</option>
<option value="3" <?php if($x_seguridad=='3') echo "selected"; ?>>Rutinario</option>
</select>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="EDITAR">
</form>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ global $x_fondo;
global $x_subseccion;
global $x_division;
global $x_codigo;
global $x_serie_idserie;
global $x_no_carpetas;
global $x_no_cajas;
global $x_no_consecutivo;
global $x_no_correlativo;
global $x_fecha_extrema_i;
global $x_fecha_extrema_f;
global $x_estanteria;
global $x_panel;
global $x_material;
global $x_seguridad;
	global $_SESSION;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT ".fecha_db_obtener('A.fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('A.fecha_extrema_f','Y-m-d H:i')." as fecha_f, A.* FROM caja A";
	$sSql .= " WHERE A.idcaja = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
  if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
	
		// Get the field contents
		$x_fondo = $row["fondo"];
		$x_subseccion = $row["subseccion"];
		$x_division = $row["division"];
		$x_codigo = $row["codigo"];
		$x_serie_idserie = $row["serie_idserie"];
		$x_no_carpetas = $row["no_carpetas"];
		$x_no_cajas = $row["no_cajas"];
		$x_no_consecutivo = $row["no_consecutivo"];
		$x_no_correlativo = $row["no_correlativo"];
		$x_fecha_extrema_i = $row["fecha_i"];
		$x_fecha_extrema_f = $row["fecha_f"];
		$x_estanteria = $row["estanteria"];
		$x_panel = $row["panel"];
		$x_material = $row["material"];
		$x_seguridad = $row["seguridad"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{global $x_fondo;
global $x_subseccion;
global $x_division;
global $x_codigo;
global $x_serie_idserie;
global $x_no_carpetas;
global $x_no_cajas;
global $x_no_consecutivo;
global $x_no_correlativo;
global $x_fecha_extrema_i;
global $x_fecha_extrema_f;
global $x_estanteria;
global $x_panel;
global $x_material;
global $x_seguridad;
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM caja A";
	$sSql .= " WHERE A.idcaja = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
  if (!$row) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_fondo) : $x_fondo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["fondo"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_subseccion) : $x_subseccion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["subseccion"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_division) : $x_division; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["division"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_codigo) : $x_codigo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_serie_idserie) : $x_serie_idserie; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["serie_idserie"] = $theValue;

	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_no_carpetas) : $x_no_carpetas; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_carpetas"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_no_cajas) : $x_no_cajas; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_cajas"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_no_consecutivo) : $x_no_consecutivo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_consecutivo"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_no_correlativo) : $x_no_correlativo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_correlativo"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_fecha_extrema_i) : $x_fecha_extrema_i; 
	$theValue = ($theValue != "") ? $theValue : "NULL";
	$fieldList["fecha_extrema_i"] = fecha_db_almacenar($theValue,'Y-m-d H:i');
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_fecha_extrema_f) : $x_fecha_extrema_f; 
	$theValue = ($theValue != "") ? $theValue : "NULL";
	$fieldList["fecha_extrema_f"] = fecha_db_almacenar($theValue,'Y-m-d H:i');
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_estanteria) : $x_estanteria; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["estanteria"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_panel) : $x_panel; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["panel"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_material) : $x_material; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["material"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_seguridad) : $x_seguridad; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["seguridad"] = $theValue;

		// update
		$sSql = "UPDATE caja SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idcaja =". $sKeyWrk;
		phpmkr_query($sSql) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
function generar_arbol($campo,$seleccionado){
	global $ruta_db_superior;
	?>
	<?php
$serie=busca_filtro_tabla("","serie","idserie=".$seleccionado,"",$conn);
 echo ucfirst(strtolower($serie[0]["nombre"])); ?>
    <br />  Buscar: <input type="text" id="stext_serie" width="200px" size="25"><br><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie').value),0,1)"> Buscar</a>  |
    <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie').value))"> Siguiente</a>  |
    <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie').value),1)"> Anterior</a><br /><div id="esperando_serie"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    <div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.enableRadioButtons(true);
			tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.enableThreeStateCheckboxes(true);
			tree2.loadXML("<?php echo $ruta_db_superior; ?>test_serie_funcionario.php?seleccionado=<?php echo $seleccionado; ?>");
			tree2.setOnCheckHandler(onNodeSelect_serie);
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.visibility = "visible";
      }
      function onNodeSelect_serie(nodeId)
      {valor_destino=document.getElementById("x_serie_idserie");

       if(tree2.isItemChecked(nodeId))
         {if(valor_destino.value!=="")
          tree2.setCheck(valor_destino.value,false);
          if(nodeId.indexOf("_")!=-1)
             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
          valor_destino.value=nodeId;
         }
       else
         {valor_destino.value="";
         }
      }
	--> 		
	</script>
	<input type="hidden" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>" value="<?php echo $seleccionado; ?>">
	<?php
}
?>
