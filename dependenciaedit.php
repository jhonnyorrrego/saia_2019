<?php 
include ("db.php");
include ("librerias_saia.php");
include_once ("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());
?>
<?php //session_start(); ?>
<?php //ob_start(); ?>
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
$x_iddependencia = Null;
$x_codigo = Null;
$x_cod_padre = Null;
$x_nombre = Null;
$x_fecha_ingreso = Null;
$x_estado= Null;
$tipo = Null;
$x_logo = Null;
$x_extension = Null;
$x_ubicacion_dependencia=Null;
?>

<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_REQUEST["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_iddependencia = @$_POST["x_iddependencia"];
	$x_codigo = @$_POST["x_codigo"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_nombre = @$_POST["x_nombre"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_estado= @$_POST["x_estado"];
	$x_tipo= @$_POST["x_tipo"];
	$x_extension= @$_POST["x_extension"];
	$x_ubicacion_dependencia = @$_POST["x_ubicacion_dependencia"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	abrir_url("dependencia.php","centro");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			abrir_url("dependencia.php","centro");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Actualizaci�n exitosa" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			abrir_url("dependencia.php","centro");
			exit();
		}
		break;
}

if(isset($_REQUEST["verlogo"])&&$_REQUEST["verlogo"])
 {echo '<img  src="formatos/librerias/mostrar_logo.php?codigo='.$_REQUEST["key"].'" />';
  die();
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - Nombre Dependencia"))
		return false;
}
return true;
}

//-->
</script>

<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/dependencia.png" border="0">&nbsp;&nbsp;EDITAR DEPENDENCIA<br><br>
</span></p>
<form name="dependenciaedit" id="dependenciaedit" action="dependenciaedit.php" method="post" onSubmit="return EW_checkMyForm(this);" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<input type="hidden" name="x_iddependencia" value="<?php echo $x_iddependencia; ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE LA DEPENDENCIA</span></td><td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $x_iddependencia; ?>
</span></td>
	</tr-->
	<tr>	  
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="50" maxlength="50" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DE LA DEPENDENCIA PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_cod_padreList = "<select name=\"x_cod_padre\">";
$x_cod_padreList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT DISTINCT A.iddependencia, A.nombre, A.codigo FROM dependencia A" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_cod_padreList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["iddependencia"] == @$x_cod_padre) {
			$x_cod_padreList .= "' selected";
		}
		$x_cod_padreList .= ">" . $datawrk["nombre"] . ValueSeparator($rowcntwrk) . $datawrk["codigo"] . "</option>";
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
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="50" maxlength="255" value="<?php echo (@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" name="x_estado" id="x_estado" value="1" <?php if($x_estado==1) echo "checked"; ?> >Activo
    <input type="radio" name="x_estado" id="x_estado" value="0" <?php if($x_estado==0) echo "checked"; ?> >Inactivo
    </span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" name="x_tipo" id="x_tipo" value="1" <?php if($x_tipo==1) echo "checked"; ?> >Dependencia
    <input type="radio" name="x_tipo" id="x_tipo" value="0" <?php if($x_tipo==0) echo "checked"; ?> >Grupo
    </span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">LOGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
    if($GLOBALS["x_logo"]<>"")
       {echo "<a href='?verlogo=1&key=".$sKey."' target='_blank' >Ver</a><br><input type='checkbox' name='borrarlogo' value=1>Borrar Logo<br>";
       }
    ?>
    Adicionar logo<input type="file" name="x_logo" >
    </span></td>
	</tr>
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EXTENSI&Oacute;N DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="text" name="x_extension" id="x_extension" size="50" maxlength="255" value="<?php echo (@$x_extension) ?>"></span>
    </td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACI&Oacute;N DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <textarea  name="x_ubicacion_dependencia" id="x_ubicacion_dependencia" cols="50" ><?php echo (@$x_ubicacion_dependencia) ?></textarea></span>
    </td>
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
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM dependencia A";
	$sSql .= " WHERE A.iddependencia = " . $sKeyWrk;
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
		$GLOBALS["x_iddependencia"] = $row["iddependencia"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha_ingreso"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_tipo"] = $row["tipo"];
		$GLOBALS["x_logo"] = $row["logo"];
		$GLOBALS["x_extension"] = $row["extension"];
		$GLOBALS["x_ubicacion_dependencia"] = $row["ubicacion_dependencia"];
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
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM dependencia A";
	$sSql .= " WHERE A.iddependencia = " . $sKeyWrk;
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
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["codigo"] = $theValue;
		$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
		$fieldList["cod_padre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;     
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_extension"]) : $GLOBALS["x_extension"];
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["extension"] = $theValue;
		
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_ubicacion_dependencia"]) : $GLOBALS["x_ubicacion_dependencia"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["ubicacion_dependencia"] = $theValue;
		
    if (is_uploaded_file($_FILES["x_logo"]["tmp_name"])) {
				$fileHandle = fopen($_FILES["x_logo"]["tmp_name"], "rb");
				$fileContent = fread($fileHandle, $_FILES["x_logo"]["size"]);
				$theValue =$fileContent; //addslashes($fileContent);
				fclose($fileHandle);
				$logo = $theValue;
				@unlink($_FILES["x_logo"]["tmp_name"]);
			}
  $theValue = $GLOBALS["x_estado"];
  	if($theValue==0)
		{
     phpmkr_query("update dependencia_cargo set estado=0 where dependencia_iddependencia=$sKeyWrk",$conn) or error("Fallo inactivar los roles de la dependencia");
     alerta("Se han desactivado la dependencia y todos los roles que pertenecen a ella");
    } 
		$fieldList["estado"] = $theValue;
		$theValue = $GLOBALS["x_tipo"];
		$fieldList["tipo"] = $theValue;
    /*verificar que no se repita codigo de la dependencia
    $verificar = busca_filtro_tabla("*","dependencia A","A.codigo=".$fieldList["codigo"],"",$conn);        
    if($verificar["numcampos"]>1)
    { alerta("El codigo del proceso ya se encuentra asignado");
      redirecciona("dependenciaedit.php?key=$sKeyWrk");
    } */ 
		// update
		$sSql = "UPDATE dependencia SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE iddependencia =". $sKeyWrk;
	//	echo $sSql; die();
		phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		
		//Modificar codigo_arbol
		if($sKeyWrk){
			$id=$sKeyWrk;
			$x_cod_padre=$fieldList["cod_padre"];
			$codigo_arbol_papa=busca_filtro_tabla("codigo_arbol","dependencia A","A.iddependencia=".$x_cod_padre,"",$conn);
			if($codigo_arbol_papa["numcampos"] && $codigo_arbol_papa[0]["codigo_arbol"]!=''){
				$modificar=$codigo_arbol_papa[0]["codigo_arbol"].".".$id;
			}
			else{
				$modificar=$id;
			}
			$sql1="UPDATE dependencia SET codigo_arbol='".$modificar."' WHERE iddependencia=".$id;
			phpmkr_query($sql1);
		}
		
	  if($_REQUEST["borrarlogo"])
     {if(MOTOR=="MySql")
       $sql="update dependencia set logo=NULL where iddependencia=".$sKeyWrk;
      elseif(MOTOR=="Oracle")
      $sql="update dependencia set logo=empty_blob() where iddependencia=".$sKeyWrk;
      phpmkr_query($sql,$conn);
     }
    if(isset($logo))
     {guardar_lob("logo","dependencia","iddependencia=".$sKeyWrk,$logo,"archivo",$conn);
     }
     

    $EditData = true; // Update Successful
	}
	return $EditData;
}

encriptar_sqli("dependenciaedit",1);
?>
