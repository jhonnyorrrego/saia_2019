<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."pantallas/lib/librerias_saia.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
echo(librerias_jquery("1.7"));
echo(librerias_validacion());
?>
<script type="text/javascript">(function($) {
$(function() {$('#x_funcionario_codigo').blur(function(){
    $.ajax({
      type:'POST',
      url:'<?php echo($ruta_db_superior);?>formatos/librerias/validar_unico.php',
      data:'nombre=funcionario_codigo&valor='+$('#x_funcionario_codigo').val()+'&tabla=funcionario_editor',
      success: function(datos,exito){
        if(datos==0){
          alert('El campo codigo de usuario debe Ser unico');
          $('#x_funcionario_codigo').val("");
        }  
      }
    });
  })});
  
  $(function() {$('#x_login').blur(function(){
    $.ajax({
      type:'POST',
      url:'<?php echo($ruta_db_superior);?>formatos/librerias/validar_unico.php',
      data:'nombre=login&valor='+$('#x_login').val()+'&tabla=funcionario',
      success: function(datos,exito){
        if(datos==0){
          alert('El campo login de usuario debe Ser unico');
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
$x_nombres = Null;
$x_apellidos = Null;
$x_email = Null;
$x_estado = Null;
$x_fecha_ingreso = Null;
?>
<?php include ($ruta_db_superior."phpmkrfn.php") ?>
<?php
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
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
  $x_estado = @$_POST["x_estado"];
  $x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
}
switch ($sAction){
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
      $_SESSION["ewmsg"] = "Adicion exitosa del registro.";
        ob_end_clean();
      header("Location: funcionariolist.php");
      exit();
    }
    break;
}
?>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator 
//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_funcionario_codigo && !EW_hasValue(EW_this.x_funcionario_codigo, "TEXT" )) {
  if (!EW_onError(EW_this, EW_this.x_funcionario_codigo, "TEXT", "Por favor ingrese los campos requeridos - Codigo de Funcionario"))
    return false;
}
if (EW_this.x_funcionario_codigo && !EW_checkinteger(EW_this.x_funcionario_codigo.value)) {
  if (!EW_onError(EW_this, EW_this.x_funcionario_codigo, "TEXT", "Entero Incorrecto - Codigo de Funcionario"))
    return false; 
}
if (EW_this.x_login && !EW_hasValue(EW_this.x_login, "TEXT" )) {
  if (!EW_onError(EW_this, EW_this.x_login, "TEXT", "Por favor ingrese los campos requeridos - Login(intranet)"))
    return false;
}
if (EW_this.x_clave && !EW_hasValue(EW_this.x_clave, "PASSWORD" )) {
  if (!EW_onError(EW_this, EW_this.x_clave, "PASSWORD", "Por favor ingrese los campos requeridos - Clave"))
    return false;
}
if (EW_this.x_nombres && !EW_hasValue(EW_this.x_nombres, "TEXT" )) {
  if (!EW_onError(EW_this, EW_this.x_nombres, "TEXT", "Por favor ingrese los campos requeridos - Nombre"))
    return false;
}
if (EW_this.x_estado && !EW_hasValue(EW_this.x_estado, "RADIO" )) {
  if (!EW_onError(EW_this, EW_this.x_estado, "RADIO", "Por favor ingrese los campos requeridos - Estado"))
    return false;
}
if (EW_this.x_fecha_ingreso && !EW_hasValue(EW_this.x_fecha_ingreso, "TEXT" )) {
  if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Por favor ingrese los campos requeridos - Fecha Ingreso"))
    return false;
}
if (EW_this.x_fecha_ingreso && !EW_checkdate(EW_this.x_fecha_ingreso.value)) {
  if (!EW_onError(EW_this, EW_this.x_fecha_ingreso, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - Fecha Ingreso"))
    return false; 
}
numero_permitido=12
num_caracteres = EW_this.x_funcionario_codigo.value.length;
if(num_caracteres>numero_permitido){
alert("El codigo del funcionario debe ser maximo de 12 digitos");
return false;
} 
return true;
}

//-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>
<form name="funcionarioadd" id="funcionarioadd" action="funcionarioadd.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
  <tr>
    <td class="encabezado" title="C&oacute;digo interno asignado a cada funcionario."><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DE FUNCIONARIO</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
<?php //if (!(!is_null($x_funcionario_codigo)) || ($x_funcionario_codigo == "")) { $x_funcionario_codigo = 0;} // Set default value ?>
<input type="text" class="required" name="x_funcionario_codigo" id="x_funcionario_codigo" size="30" value="<?php echo htmlspecialchars(@$x_funcionario_codigo) ?>">
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
  </tr> <tr>
    <td class="encabezado" title="Correo electronico del funcionario."><span class="phpmaker" style="color: #FFFFFF;">EMAIL</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_email" id="x_email" size="30" maxlength="255" value="<?php echo @$x_email ?>">
</span></td>
  </tr>
  
  <tr>
    <td class="encabezado" title="Salario del funcionario."><span class="phpmaker" style="color: #FFFFFF;">SALARIO</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_salario" id="x_salario" size="30" maxlength="255" value="<?php echo @$x_salario ?>">
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
  </tr>   <!--tr>
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
  //die($strsql);
  phpmkr_query($strsql,$conn);
  //para guardar la firma
  $sKeyWrk=phpmkr_insert_id();
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