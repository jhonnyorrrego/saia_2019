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
$x_idexpediente = Null;
$x_nombre = Null;
$x_fecha = Null;
$x_descripcion = Null;
$x_codigo = Null;
$x_cod_padre = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
//Permiso de expediente: solo la que tenga el permiso puede modificar los datos del expedite
//Los documentos solo los pueden eliminar la persona que lo coloco.
$permiso = false;
$perm=new PERMISO();
$permiso=$perm->acceso_modulo_perfil("editar_expediente");
$permiso_exp=busca_filtro_tabla("propietario,editar_todos","expediente","idexpediente=$sKey","",$conn);
//$permiso_exp2=busca_filtro_tabla("editar","permiso_expediente_func","expediente_idexpediente=$sKey and funcionario=".usuario_actual("funcionario_codigo"),"",$conn);
if($permiso || $permiso_exp[0]["propietario"]==usuario_actual("funcionario_codigo") || $permiso_exp[0]["editar_todos"]==1 || @$permiso_exp2[0]["editar"]==1)
  $permiso=1;
// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idexpediente = @$_POST["x_idexpediente"];
	$x_nombre = @$_POST["x_nombre"];
	$x_fecha = @$_POST["x_fecha"];
	$x_descripcion = @$_POST["x_descripcion"];
  $x_codigo = @$_POST["x_codigo"];
  $x_cod_padre = @$_POST["x_cod_padre"];
}
if (($sKey == "") || (($sKey == NULL))) {
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			abrir_url("expediente_principal.php","centro");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
      alerta(("Actualización exitosa"));
			abrir_url("expediente_principal.php?key=".$sKey,"centro");
		}
		break;
}
?>
<?php include ("header.php") ?>
<?php include ("formatos/librerias/header_formato.php") ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
<!--
$().ready(function() {
	$('#expedienteedit').validate(); 
});
//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/expediente.png" border="0">&nbsp;&nbsp;EDITAR EXPEDIENTE<br><br><a href="expediente_detalles.php?key=<?php echo($sKey);?>">Regresar al listado</a></span></p>
<form name="expedienteedit" id="expedienteedit" action="expedienteedit.php" method="post" >
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Id EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idexpediente; ?><input type="hidden" name="x_idexpediente" value="<?php echo $x_idexpediente; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEL PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
	<input type="hidden" name="x_cod_padre" id="x_cod_padre" value="<?php echo @$x_cod_padre;?>">
		<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value))">
      <img src="botones/general/siguiente.png"border="0px"></a>
<br /><br />
				<div id="treeboxbox_tree2"></div></span>
				<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
      tree2.enableSingleRadioMode(true);
      tree2.enableSmartXMLParsing(true);			
			tree2.loadXML("test_expediente.php?permiso_editar=1<?php echo '&excluidos='.$x_idexpediente.'&seleccionado='.$x_cod_padre;?>"); 
			tree2.setOnCheckHandler(onNodeSelect);
			function onNodeSelect(nodeId)
      {if(tree2.isItemChecked(nodeId)==true)
         $("#x_cod_padre").val(nodeId);
       else
         $("#x_cod_padre").val('');
      } 
			-->
      </script>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php if($permiso){ ?>
<input type="text" class="required" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo @$x_nombre; ?>">
    <?php } else echo @$x_nombre; ?>    
  </span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
	$doc = busca_filtro_tabla("distinct idexpediente_doc,numero,documento.descripcion","documento,expediente_doc,expediente,buzon_entrada","expediente_idexpediente=$sKey and documento_iddocumento=iddocumento AND expediente_idexpediente=idexpediente AND iddocumento=archivo_idarchivo AND (origen=".$_SESSION["usuario_actual"]." OR destino=".$_SESSION["usuario_actual"].")","",$conn); 
	if($doc["numcampos"]>0)
	{for($i=0; $i<$doc["numcampos"]; $i++)
   echo "<li>".$doc[$i]["numero"]." ".delimita($doc[$i]["descripcion"],100)."&nbsp;&nbsp;<a href='expedientedelete.php?idexpediente=".$doc[$i]["idexpediente_doc"]."&key=$sKey'><img src='carrito/remove.gif' border='0' alt='Eliminar' onclick=\"javascript:if(confirm('Está seguro de eliminar el documento del expediente?'))return true;return false;\"></a></li><br>"; 
  }
  else     
   echo "No hay documentos bajo su responsabilidad asociados en este expediente";
?>
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php if($permiso){ ?>
<input type="text" name="x_fecha" id="x_fecha" value="<?php echo FormatDateTime(@$x_fecha,5); ?>">&nbsp;<input name="image" id="image" type="image" onclick="popUpCalendar(this, this.form.x_fecha,'yyyy/mm/dd');return false;" src="images/ew_calendar.gif" alt="Seleccione una Fecha" />
 <?php } else echo @$x_fecha; ?> 
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php if($permiso){ ?>
    <textarea id="x_descripcion" name="x_descripcion" cols="53" rows="3"><?php echo htmlspecialchars(@$x_descripcion) ?></textarea>
     <?php } else echo @$x_descripcion; ?> 
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php if($permiso){ ?>
<input type="text" class="required" name="x_codigo" id="x_codigo" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
  <?php } else echo @$x_codigo; ?> 
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERMISOS PARA TODOS LOS FUNCIONARIOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="checkbox" name="editar_todos" value="1" <?php if($editar_todos) echo "checked";?>>Editar
    <input type="checkbox" name="ver_todos" value="1" <?php if($ver_todos) echo "checked";?>>Ver contenido
    </span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT expediente.*,".fecha_db_obtener("fecha","Y-m-d")." as fecha FROM expediente";
	$sSql .= " WHERE idexpediente = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idexpediente"] = $row["idexpediente"];
		$GLOBALS["x_nombre"] = $row["nombre"];	
		$GLOBALS["x_fecha"] = $row["fecha"];
		$GLOBALS["x_descripcion"]= $row["descripcion"];
		$GLOBALS["x_codigo"]= $row["codigo"];
		$GLOBALS["x_cod_padre"]= $row["cod_padre"];
	  $GLOBALS["ver_todos"]= $row["ver_todos"];
		$GLOBALS["editar_todos"]= $row["editar_todos"];
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
{
	global $_SESSION;
	global $_POST;	

	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM expediente";
	$sSql .= " WHERE idexpediente = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		
	$theValue = ($GLOBALS["x_fecha"] != "") ?  fecha_db_almacenar($GLOBALS["x_fecha"],"Y-m-d H:i:s")  : "NULL";
		$fieldList["fecha"] = $theValue;
     
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_descripcion"]) : $GLOBALS["x_descripcion"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["descripcion"] = $theValue;
		
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["codigo"] = $theValue;
     
     
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_cod_padre"]) : $GLOBALS["x_cod_padre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["cod_padre"] = $theValue;
				if(isset($_REQUEST["ver_todos"]))
     $fieldList["ver_todos"] =1;
    else
     $fieldList["ver_todos"] =0;
    if(isset($_REQUEST["editar_todos"]))
     $fieldList["editar_todos"] =1;   
    else
     $fieldList["editar_todos"] =0; 
// update
		$sSql = "UPDATE expediente SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idexpediente =". $sKeyWrk;

		phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
