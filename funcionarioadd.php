<?php
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
echo(librerias_notificaciones());
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">(function($) {
          $(function() {$('#x_nit').blur(function(){
              $.ajax({
                type:'POST',
                url:'formatos/librerias/validar_unico.php',
                data:'nombre=nit&valor='+$('#x_nit').val()+'&tabla=funcionario',
                success: function(datos,exito){
                  if(datos==0){
                  //  alert('El campo codigo de funcionario debe Ser unico');
                    notificacion_saia('<B>ATENCI&Oacute;N!</B> <BR> El campo Identificaci&oacute;n debe Ser unico','success','',4000);
		    $('#x_nit').val("");
                  }  
                }
              });
            })});
            
            $(function() {$('#x_login').blur(function(){
              $.ajax({
                type:'POST',
                url:'formatos/librerias/validar_unico.php',
                data:'nombre=login&valor='+$('#x_login').val()+'&tabla=funcionario',
                success: function(datos,exito){
                  if(datos==0){
                  	 notificacion_saia('<B>ATENCI&Oacute;N!</B> <BR> El campo login de funcionario debe Ser unico','success','',4000);
                   // alert('El campo login de funcionario debe Ser unico');
		    $('#x_login').val("");
                  }  
                }
              });
            })});
            	
          })(jQuery);

$(document).ready(function(){
	$("#funcionarioadd").validate();
});
        </script>
<?php
$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idfuncionario = Null;
$x_funcionario_codigo = Null;
$x_login = Null;
$x_clave = Null;
$x_direccion = Null;
$x_telefono = Null;
$x_nombres = Null;
$x_apellidos = Null;
$x_email = Null;
$x_firma = Null;
$fs_x_firma = 0;
$fn_x_firma = "";
$ct_x_firma = "";
$w_x_firma = 0;
$h_x_firma = 0;
$a_x_firma = "";
$x_estado = Null;
$x_fecha_ingreso = Null;
$x_nit = Null;
$x_perfil = Null;
////Particular Cliente Aguas 
$x_acceso_web = NULL;
?>
<?php include ("phpmkrfn.php"); ?>
<?php
include_once("formatos/librerias/estilo_formulario.php");
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
	$x_idfuncionario = @$_POST["x_idfuncionario"];
	$x_funcionario_codigo = @$_POST["x_funcionario_codigo"];
	$x_login = @$_POST["x_login"];
	$x_clave = @$_POST["x_clave"];
	$x_nombres = @$_POST["x_nombres"];
	$x_apellidos = @$_POST["x_apellidos"];
	$x_email = @$_POST["x_email"];
	$x_firma = @$_POST["x_firma"];
	$x_estado = @$_POST["x_estado"];
  $x_direccion = @$_POST["x_direccion"];
  $x_telefono = @$_POST["x_telefono"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_nit = @$_POST["x_nit"];
	$x_perfil = @$_POST["x_perfil"];
  $x_acceso_web = implode(",",@$_POST["x_acceso_web"]);
}

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			header("Location: funcionariolist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adici�n exitosa del registro.";
		    ob_end_clean();
			header("Location: funcionariolist.php");
			exit();
		}
		break;
}
?>
<script type="text/javascript" src="popcalendar.js"></script>
<style>
label.error{
	color:red;
}
</style>
<form name="funcionarioadd" id="funcionarioadd" action="funcionarioadd.php" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<input type="hidden"  name="x_funcionario_codigo" id="x_funcionario_codigo" size="30" value="0">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="C&oacute;digo interno asignado a cada funcionario."><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php //if (!(!is_null($x_funcionario_codigo)) || ($x_funcionario_codigo == "")) { $x_funcionario_codigo = 0;} // Set default value ?>
<input type="text" class="required" name="x_nit" id="x_nit" size="30" >
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Login de usuario asignado por la Organizaci&oacute;n."><span class="phpmaker" style="color: #FFFFFF;">LOGIN (INTRANET)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="text" name="x_login" id="x_login" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_login) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Clave de acceso del usuario."><span class="phpmaker" style="color: #FFFFFF;">CLAVE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="password" name="x_clave" value="<?php echo $x_clave; ?>" size="30" maxlength="50">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombres completos del funcionario."><span class="phpmaker" style="color: #FFFFFF;">NOMBRES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="text" name="x_nombres" id="x_nombres" size="30" maxlength="255" value="<?php echo @$x_nombres ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Apellidos completos del funcionario."><span class="phpmaker" style="color: #FFFFFF;">APELLIDOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_apellidos" id="x_apellidos" size="30" maxlength="255" value="<?php echo @$x_apellidos ?>">
</span></td>
	</tr>
<tr>
		<td class="encabezado" title="Direcci&oacute;n del funcionario."><span class="phpmaker" style="color: #FFFFFF;">DIRECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_direccion" id="x_direccion" size="30" maxlength="255" value="<?php echo @$x_direccion ?>">
</span></td>
	</tr>
  <tr>
		<td class="encabezado" title="Telefono."><span class="phpmaker" style="color: #FFFFFF;">TEL&Eacute;FONO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_telefono" id="x_telefono" size="30" maxlength="255" value="<?php echo @$x_telefono ?>">
</span></td>
	</tr>	<tr>
		<td class="encabezado" title="Correo electronico del funcionario."><span class="phpmaker" style="color: #FFFFFF;">EMAIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_email" id="x_email" size="30" maxlength="255" value="<?php echo @$x_email ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado" title="Permite adjuntar la firma electronica del funcionario."><span class="phpmaker" style="color: #FFFFFF;">FIRMA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="file" id="x_firma" name="x_firma" size="30">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Permite establecer si el usuario est&aacute; activo o no en la organizaci&oacute;."><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_estado)) || ($x_estado == "")) { $x_estado = 1;} // Set default value ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha en la cual el funcionario ingres&oacute; a la Organizaci&oacute;n."><span class="phpmaker" style="color: #FFFFFF;">FECHA INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_fecha_ingreso)) || ($x_fecha_ingreso == "")) { $x_fecha_ingreso = date('Y-m-d H:i:s');} // Set default value ?>
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo FormatDateTime(@$x_fecha_ingreso,5); ?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_ingreso,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL DE ACCESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
  		<?php
  		$perfiles=explode(",",$x_perfil);
  		$nombre_perfil=busca_filtro_tabla("","perfil","","",$conn);
			$check='';
      for($i=0; $i<$nombre_perfil["numcampos"]; $i++){
      	$adicional='';
				$adicional2='';
				if($i==0 && usuario_actual('login')=='cerok')$adicional2=' class="required" ';
				if($i==1 && usuario_actual('login')!='cerok')$adicional2=' class="required" ';
				if(in_array($nombre_perfil[$i]["idperfil"],$perfiles))$adicional=" checked ";
      	if(usuario_actual('login')=='cerok'){
      		$check.='<input type="checkbox" id="x_perfil'.$nombre_perfil[$i]["idperfil"].'" name="x_perfil[]" value="'.$nombre_perfil[$i]["idperfil"].'" '.$adicional.$adicional2.'>'.$nombre_perfil[$i]["nombre"]."<br>";
				}
				else if($nombre_perfil[$i]["idperfil"]>1){
					$check.='<input type="checkbox" id="x_perfil'.$nombre_perfil[$i]["idperfil"].'" name="x_perfil[]" value="'.$nombre_perfil[$i]["idperfil"].'" '.$adicional.$adicional2.'>'.$nombre_perfil[$i]["nombre"]."<br>";
				}
      }
			echo $check;
      ?>   
    </span></td>
	</tr>		<!--tr>
		<td class="encabezado" title="Permite establecer si el usuario tiene acceso al sistema SAIA."><span class="phpmaker" style="color: #FFFFFF;">ACCESO SAIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_sistema)) || ($x_sistema == "")) { $x_sistema = 1;} // Set default value ?>
<input type="radio" name="x_sistema"<?php if (@$x_sistema == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Si"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_sistema"<?php if (@$x_sistema == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "No"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado" title=""><span class="phpmaker" style="color: #FFFFFF;">TIPO DE VALIDACI&Oacute;N</span></td>
		
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<input type="checkbox" name="validaciones_funcionario[]" value="1">Transferencias Masivas
		</td>
	</tr>
  	<!--tr>
		<td class="encabezado" title="Permite establecer si el usuario tiene acceso al sistema SAIA."><span class="phpmaker" style="color: #FFFFFF;">ACCESO WEB</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_acceso_web)) || ($x_acceso_web == "")) { /*$x_acceso_web = 1;*/ } // Set default value ?>
<input type="checkbox" name="x_acceso_web[]"<?php if (@$x_acceso_web == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SAIA"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="checkbox" name="x_acceso_web[]"<?php if (@$x_acceso_web == "2") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("2"); ?>">
<?php echo "ISOSYSTEM"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="checkbox" name="x_acceso_web[]"<?php if (@$x_acceso_web == "3") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("3"); ?>">
<?php echo "CAKTUS"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr-->
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php

?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funcionario A";
	$sSql .= " WHERE A.idfuncionario = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) ;
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idfuncionario"] = $row["idfuncionario"];
		$GLOBALS["x_funcionario_codigo"] = $row["funcionario_codigo"];
		$GLOBALS["x_login"] = $row["login"];
		$GLOBALS["x_clave"] = $row["clave"];
		$GLOBALS["x_nombres"] = $row["nombres"];
    $GLOBALS["x_direccion"] = $row["direccion"];
    $GLOBALS["x_telefono"] = $row["telefono"];
		$GLOBALS["x_apellidos"] = $row["apellidos"];
		$GLOBALS["x_firma"] = $row["firma"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha_ingreso"];
		$GLOBALS["x_nit"] = $row["nit"];
		$GLOBALS["x_perfil"] = $row["perfil"];
		$GLOBALS["x_acceso_web"] = $row["acceso_web"];
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
	// Add New Record
	$sSql = "SELECT * FROM funcionario A";
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

		// check file size
		$EW_MaxFileSize = @$_POST["EW_Max_File_Size"];
	if (!empty($_FILES["x_firma"]["size"])) {
		if (!empty($EW_MaxFileSize) && $_FILES["x_firma"]["size"] > $EW_MaxFileSize) {
			error("Max. file upload size exceeded");
		}
	}


	// Field nit
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nit"]) : $GLOBALS["x_nit"]; 
	$fieldList["nit"] = $theValue;

	// Field funcionario_codigo
	$theValue = ($GLOBALS["x_funcionario_codigo"] != "") ? $GLOBALS["x_funcionario_codigo"] : "NULL";
	$sTmp = $theValue;
	$srchFld = $sTmp;
	$srchFld = (!get_magic_quotes_gpc()) ? addslashes($srchFld) : $srchFld;	
	$strsql = "SELECT * FROM funcionario A WHERE A.funcionario_codigo = " . $srchFld;	
	$rschk = phpmkr_query($strsql,$conn);
	if (phpmkr_num_rows($rschk) > 0) {
		//echo "El codigo de funcionario est&aacute; duplicado " . $sTmp . "<br>";
		error("El codigo de funcionario est&aacute; duplicado ");
	}
	@phpmkr_free_result($rschk);
	$fieldList["funcionario_codigo"] = $theValue;

	// Field login
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_login"]) : $GLOBALS["x_login"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$sTmp = $theValue;
	$srchFld = $sTmp;
	//error($srchFld);
	//$srchFld = (!get_magic_quotes_gpc()) ? addslashes($srchFld) : $srchFld;	
	$strsql = "SELECT * FROM funcionario A WHERE A.login = " . $srchFld;	
	$rschk = phpmkr_query($strsql,$conn) ;
	if (phpmkr_num_rows($rschk) > 0) {
		echo "El codigo de funcionario est&aacute; duplicado " . $sTmp . "<br>";
	}
	@phpmkr_free_result($rschk);
	$fieldList["login"] = $theValue;

	// Field clave
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_clave"]) : $GLOBALS["x_clave"]; 
	$theValue = ($theValue != "") ? " '" . encrypt_md5(trim($theValue)) . "'" : "NULL";
	$fieldList["clave"] = $theValue;

	// Field nombres
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombres"]) : $GLOBALS["x_nombres"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombres"] = ($theValue);

	// Field apellidos
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_apellidos"]) : $GLOBALS["x_apellidos"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["apellidos"] = ($theValue);
// Field email
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_email"]) : $GLOBALS["x_email"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["email"] = ($theValue);
  // Field direccion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_direccion"]) : $GLOBALS["x_direccion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["direccion"] = ($theValue);
	// Field telefono
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_telefono"]) : $GLOBALS["x_telefono"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["telefono"] = ($theValue);
	
	// Field estado
	$theValue = ($GLOBALS["x_estado"] != "") ? intval($GLOBALS["x_estado"]) : "NULL";
	$fieldList["estado"] = $theValue;







	// Field fecha_ingreso
	$theValue = $GLOBALS["x_fecha_ingreso"];
  $fieldList["fecha_ingreso"] = fecha_db_almacenar($theValue,"Y/m/d");
	// Field perfil
	$fieldList["perfil"] = "'".implode(",",$GLOBALS["x_perfil"])."'";
  
  /*$theValue = ($GLOBALS["x_acceso_web"] != "") ? addslashes($GLOBALS["x_acceso_web"]) : "NULL";
	$fieldList["acceso_web"] = $theValue;*/
	
	/*$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_acceso_web"]) : $GLOBALS["x_acceso_web"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["acceso_web"] = ($theValue);*/

  //verifica si existe un codigo repetido en los funcionarios.
  $verificar = busca_filtro_tabla("*","funcionario A","A.funcionario_codigo=".$fieldList["funcionario_codigo"],"",$conn);    
    if($verificar["numcampos"]>0)
    { alerta("El codigo del funcionario ya se encuentra asignado");      
      redirecciona("funcionarioadd.php");
    } 
  
	// insert into database
	$strsql = "INSERT INTO funcionario (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ",tipo) VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ",'1') ";

	phpmkr_query($strsql,$conn);
	//para guardar la firma
  $sKeyWrk=phpmkr_insert_id();
  
  	$ufcsql="update funcionario set funcionario_codigo='$sKeyWrk' where idfuncionario=$sKeyWrk";
	phpmkr_query($ufcsql,$conn);
  

  
  
  if (is_uploaded_file($_FILES["x_firma"]["tmp_name"])) 
     {
			$fileHandle = fopen($_FILES["x_firma"]["tmp_name"], "rb");
			$fileContent = fread($fileHandle, $_FILES["x_firma"]["size"]);
			fclose($fileHandle);
			$theValue =$fileContent;// addslashes($fileContent);
			@unlink($_FILES["x_firma"]["tmp_name"]);
			guardar_lob("firma","funcionario","idfuncionario=".$sKeyWrk,$theValue,"archivo",$conn);
 
      }
	 foreach($_REQUEST["validaciones_funcionario"] as $valor){
		if($valor){
			$sql1="insert into funcionario_validacion (funcionario_idfuncionario, tipo) values ('".$sKeyWrk."', '".$valor."')";
			phpmkr_query($sql1);
		}
	}
  	/* para guardar la firma*/

	return true;
}
?>