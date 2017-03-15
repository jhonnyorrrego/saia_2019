<?php session_start(); ?>
<?php ob_start(); ?>
<?php include ("db.php") ?>
<?php include ("librerias_saia.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 

include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_iddependencia");
desencriptar_sqli('form_info');
echo(librerias_jquery());

//print_r($_REQUEST);die();
$ewCurSec = 0; // Initialise	

// Initialize common variables
$x_iddependencia = Null;
$x_codigo = Null; 
$x_cod_padre = Null;
$x_nombre = Null;
$x_fecha_ingreso = Null;
$x_tipo= 1;
$x_estado = 1;
$x_extension= Null;
$x_ubicacion_dependencia = Null;
$x_logo = Null;
if(isset($_GET["padre"]) || isset($_GET["nombre"]))
 {
  $x_cod_padre = @$_GET["padre"];
  $x_nombre = @$_GET["nombre"];  
 }
?>

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
	$x_iddependencia = @$_POST["x_iddependencia"];
	$x_codigo = @$_POST["x_codigo"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_nombre = @$_POST["x_nombre"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_estado = @$_POST["x_estado"];
	$x_tipo = @$_POST["x_tipo"];
	$x_extension = @$_POST["x_extension"];
  $x_ubicacion_dependencia= @$_POST["x_ubicacion_dependencia"];	
  $x_logo= @$_POST["x_logo"];	
}

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			abrir_url("dependencia.php","centro");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adici�n exitosa del registro.";
			alerta("Adicion exitosa del registro.");			
			abrir_url("dependencia.php","centro");
			exit();
		}
		break;
}
echo(librerias_jquery());
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
$(document).ready(function() {
	$("#x_nombre").keyup(function(){
		$.ajax({
			url:"pantallas/rol/valida_repetido.php",
			type: 'POST',
			dataType: 'html',
			data: {
				cargo : 0,
				nombre :$(this).val()
			},
			success: function(data){
				if(data==1){
					top.noty({
						text: 'Dependencia repetida!',
						type: 'error',
						layout: "topCenter",
						timeout:4500
					});
					$("#guardar").attr("disabled",true);
				}else{
					$("#guardar").attr("disabled",false);
				}
			}
		});
	});
});
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/dependencia.png" border="0">&nbsp;&nbsp;ADICIONAR DEPENDENCIAS<br><br>
</span></p>
<form name="dependenciaadd" id="dependenciaadd" action="dependenciaadd.php" method="post" onSubmit="return EW_checkMyForm(this);" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="C&oacute;digo de la dependencia asignada por la organizaci&oacute;n."><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="50" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Seleccionar la dependencia a la cual depende la nueva."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DE LA DEPENDENCIA PADRE</span></td>
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
		<td class="encabezado" title="Nombre de la nueva dependencia." ><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
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
    <input type="file" name="x_logo" >
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
<input type="submit" name="Action" value="Adicionar">
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
{global $x_iddependencia,$x_codigo,$x_cod_padre,$x_nombre, $x_fecha_ingreso, $x_tipo, $x_estado,$x_extension,$x_ubicacion_dependencia;

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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_iddependencia = $row["iddependencia"];
		$x_codigo = $row["codigo"];
		$x_cod_padre = $row["cod_padre"];
		$x_nombre = $row["nombre"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
		$x_estado = $row["estado"];
		$x_tipo = $row["tipo"];
		$x_extension= $row["extension"];
		$x_ubicacion_dependencia = $row["ubicacion_dependencia"];
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
global $x_logo,$x_iddependencia,$x_codigo,$x_cod_padre,$x_nombre,$x_fecha_ingreso,$x_tipo,$x_estado,$x_extension,$x_ubicacion_dependencia;

	// Add New Record
	$sSql = "SELECT * FROM dependencia A";
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

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_codigo) : $x_codigo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	// Field cod_padre
	$theValue = ($x_cod_padre != "") ? intval($x_cod_padre) : "NULL";
	$fieldList["cod_padre"] = $theValue;

	// Field estado
	$theValue = ($x_estado != "") ? intval($x_estado) : "NULL";
	$fieldList["estado"] = $theValue;

	// Field tipo
	$theValue = ($x_tipo != "") ? intval($x_tipo) : "NULL";
	$fieldList["tipo"] = $theValue;

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;
	
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_extension) : $x_extension;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["extension"] = $theValue;

  $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ubicacion_dependencia) : $x_ubicacion_dependencia;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["ubicacion_dependencia"] = $theValue;
	
  //verifica si existe un codigo repetido en las dependencias.
  $verificar = busca_filtro_tabla("*","dependencia A","A.codigo=".$fieldList["codigo"],"",$conn);    
    if($verificar["numcampos"]>0)
    { alerta("El codigo del proceso ya se encuentra asignado");      
      redirecciona("dependenciaadd.php?padre=".$fieldList["cod_padre"]."&nombre=".$x_nombre);
    }   
  
	// insert into database
	$strsql = "INSERT INTO dependencia (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $strsql);
	$id=phpmkr_insert_id();
	
	//guardo codigo del arbol
	if($id){
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
	
	//guardo el logo

  if($id)
	 {if (is_uploaded_file($_FILES["x_logo"]["tmp_name"])) {
				$fileHandle = fopen($_FILES["x_logo"]["tmp_name"], "rb");
				$fileContent = fread($fileHandle, $_FILES["x_logo"]["size"]);
				$theValue =$fileContent; //addslashes($fileContent);
				fclose($fileHandle);
				$logo = $theValue;
				@unlink($_FILES["x_logo"]["tmp_name"]);
			}

		 
    if(isset($logo))	
      guardar_lob("logo","dependencia","iddependencia=".$id,$logo,"archivo",$conn);
   }
	
	return true;
}

encriptar_sqli("dependenciaadd",1);
?>
