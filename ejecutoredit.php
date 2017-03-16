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
$x_titulo=Null;
$x_empresa = Null;
$x_email = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idejecutor = @$_POST["x_idejecutor"];
	$x_identificacion = @$_POST["x_identificacion"];
	//$x_tipo = @$_POST["x_tipo"];
	$x_telefono = @$_POST["x_telefono"];
	$x_nombre = @$_POST["x_nombre"];
//	$x_prioridad = @$_POST["x_prioridad"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_cargo = @$_POST["x_cargo"];
	$x_direccion = @$_POST["x_direccion"];
	$x_ciudad = @$_POST["x_ciudad"];
	$x_titulo = @$_POST["x_titulo"];
	$x_empresa = @$_POST["x_empresa"];
  $x_email = @$_POST["x_email"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: ejecutorlist.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
		 ob_end_clean();
			header("Location: ejecutorlist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Se actualizo el registro con exito = " . $sKey;			
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
	if (!EW_onError(EW_this, EW_this.x_tipo, "RADIO", "Por favor ingrese el campo requerido - tipo"))
		return false;
}
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese el campo requerido - nombre"))
		return false;
}
if (EW_this.x_fecha_ingreso && !EW_hasValue(EW_this.x_fecha_ingreso, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Por favor ingrese el campo requerido - fecha ingreso"))
		return false;
}
if (EW_this.x_fecha_ingreso && !EW_checkdate(EW_this.x_fecha_ingreso.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Fecha incorrecta, formato = yyyy/mm/dd - fecha ingreso"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/ejecutor.png" border="0">&nbsp;&nbsp;EJECUTOR REMITENTE<br></span></p>
<form name="ejecutoredit" id="ejecutoredit" action="ejecutoredit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDEJECUTOR</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idejecutor; ?><input type="hidden" name="x_idejecutor" value="<?php echo $x_idejecutor; ?>">
</span></td>
	</tr>
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
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TELEFONO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_telefono" id="x_telefono" value="<?php echo htmlspecialchars(@$x_telefono) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" readonly="true" name="x_nombre" id="x_nombre" value="<?php echo @$x_nombre ?>">
</span></td>
	</tr>
	<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TITULO</span></td>
		<td bgcolor="#F5F5F5" ><span class="phpmaker" id="td_titulo">

<?php
        $titulos=array("Se&ntilde;or","Se&ntilde;ora","Doctor","Doctora","Ingeniera","Ingeniero");
           echo '<select name="x_titulo" id="obligatorio">';
           //echo "<option value='".codifica_encabezado($resultado[0][$_POST["op"]])."' selected>".codifica_encabezado($resultado[0][$_POST["op"]])."</option>";
           $encontrado=0;
           foreach($titulos as $fila)
              {if($fila==$x_titulo)
                  {echo "<option value='".$fila."' selected>".$fila."</option>";
                   $encontrado=1;
                  }
               else
                  echo "<option value='".$fila."'>".$fila."</option>";
              }
           if($encontrado==0 && codifica_encabezado($x_titulo)<>"")
              echo "<option value='".codifica_encabezado($x_titulo)."' selected>".codifica_encabezado($x_titulo)."</option>";
           elseif($encontrado==0)
              echo "<option value='Se&ntilde;or' selected>Se&ntilde;or</option>";     
  
           echo '</select>&nbsp;&nbsp;
            <label style="text-decoration:underline;cursor: pointer" 
            onclick="document.getElementById('."'td_titulo'".').innerHTML='."'<td><input type=text name=x_titulo id=obligatorio></td>'".';">OTRO
            </label>';
?>
</td>
</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_cargo" id="x_cargo" size="30" maxlength="150" value="<?php echo @$x_cargo ?>">
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EMPRESA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_empresa" id="x_empresa" size="30" maxlength="150" value="<?php echo @$x_empresa ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EMAIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_email" id="x_email" size="30" maxlength="150" value="<?php echo @$x_email ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIRECCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_direccion" id="x_direccion" value="<?php echo @$x_direccion ?>">
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
      {echo "<option value='".$ciudades[$i]["idmunicipio"]."'";
       if($ciudades[$i]["idmunicipio"]==$x_ciudad) 
         echo " selected ";
       echo ">".$ciudades[$i]["nombre"]."</option>";
      }
   echo '</select>';   
  }   
 ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="EDITAR">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION,$x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_titulo,$x_empresa,$x_email;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM ".DB.".ejecutor A";
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);
$otros_datos=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$row["idejecutor"],"iddatos_ejecutor desc",$conn);
		// Get the field contents		
		$x_idejecutor = $row["idejecutor"];
		$x_identificacion = $row["identificacion"];
		//$x_tipo = $row["tipo"];
		$x_telefono = $otros_datos[0]["telefono"];
		$x_nombre = $row["nombre"];
		//$x_prioridad = $row["prioridad"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
		$x_cargo = $otros_datos[0]["cargo"];
		$x_direccion = $otros_datos[0]["direccion"];
		$x_ciudad = $otros_datos[0]["ciudad"];
		$x_titulo = $otros_datos[0]["titulo"];
		$x_empresa = $otros_datos[0]["empresa"];
    $x_email = $otros_datos[0]["email"];
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
	global $conn,$_SESSION,$x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_titulo,$x_empresa,$x_email;
	global $_POST;
	global $_POST;
 $x_identificacion = ($x_identificacion != "") ? $x_identificacion:  ''; 

 $condicion=($x_identificacion != "") ?  "identificacion='".$x_identificacion."'"  :  "(identificacion is NULL or identificacion='')";
     
  $campo = busca_filtro_tabla("iddatos_ejecutor,idejecutor","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and idejecutor=$sKey and nombre ='".(($x_nombre))."' and $condicion","iddatos_ejecutor desc",$conn);
  if($campo["numcampos"]>0)
  {
  $repetido = busca_filtro_tabla("iddatos_ejecutor","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$campo[0]["iddatos_ejecutor"]." and cargo='".(($x_cargo))."' and direccion='".(($x_direccion))."' and telefono='".(($x_telefono))."' and titulo='".(($x_titulo))."' and ciudad='".(($x_ciudad))."'  and email='".(($x_email))."' and empresa='".(($x_empresa))."'","",$conn);

  if($repetido["numcampos"]>0)
     {return ($sKey);}
  else   
   {
    phpmkr_query("INSERT INTO ".DB.".datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,empresa,direccion,titulo,ciudad,email) VALUES(".$campo[0]["idejecutor"].",'".(($x_telefono))."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".(($x_cargo))."','".(($x_empresa))."','".(($x_direccion))."','".(($x_titulo))."','$x_ciudad','".(($x_email))."')",$conn) or error("NO SE INSERTO EJECUTOR 1");         

 //die();  
 return(phpmkr_insert_id());
   }
  }
  else 
  {   
    phpmkr_query("INSERT INTO ".DB.".ejecutor(nombre,identificacion,fecha_ingreso) VALUES('".(($x_nombre))."','".$x_identificacion."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').")",$conn) or error("NO SE INSERTO EJECUTOR 2");
    $idejecutor=phpmkr_insert_id();
  
    phpmkr_query("INSERT INTO ".DB.".datos_ejecutor(ejecutor_idejecutor,telefono,fecha,cargo,empresa,direccion,titulo,ciudad,email) VALUES(".$idejecutor.",'".(($x_telefono))."',".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'".(($x_cargo))."','".(($x_empresa))."','".(($x_direccion))."','".(($x_titulo))."','$x_ciudad','".(($x_email))."')",$conn) or error("NO SE INSERTO EJECUTOR 3"); 
//die();
   return(phpmkr_insert_id());    
     } 
 //die();
 return (true);
}
?>

