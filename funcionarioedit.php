<?php
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">(function($) {
           
            $(function() {$('#x_salario').blur(function(){
            	if($('#x_salario').val() != ''){
	            	$.ajax({
	                type:'POST',
	                url:'buscar_rol_funcionario.php',
	                data:'funcionario_codigo='+$('#x_funcionario_codigo').val(),
	                success: function(datos,exito){
	                  if(datos==0){
	                    alert('El funcionario no tiene rol asignado.');
			    $('#x_salario').val("");
	                  }  
	                }
	              });
	           	}
            })});
            	
          })(jQuery);
$(document).ready(function(){
	$("#funcionarioedit").validate();
});
        </script>
<?php
$ewCurSec = 0; // Initialise
				
?>
<?php

// Initialize common variables
$x_idfuncionario = Null;
$x_funcionario_codigo = Null;
$x_login = Null;
$x_clave = Null;
$x_nombres = Null;
$x_apellidos = Null;
$x_email = Null;
$x_direccion = Null;
$x_telefono = Null;
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
$x_sistema = Null;
$x_salario = Null;
$x_acceso_web = NULL;
include_once ("phpmkrfn.php");
include_once("formatos/librerias/estilo_formulario.php");
$sKey = @$_REQUEST["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idfuncionario = @$_POST["x_idfuncionario"];
	$x_funcionario_codigo = @$_POST["x_funcionario_codigo"];
	$x_login = @$_POST["x_login"];
	$x_clave = @$_POST["x_clave"];
	$x_nombres = @$_POST["x_nombres"];
	$x_apellidos = @$_POST["x_apellidos"];
	$x_email = @$_POST["x_email"];
  $x_direccion = @$_POST["x_direccion"];
  $x_telefono = @$_POST["x_telefono"];
	$x_firma = @$_POST["x_firma"];
	$x_estado = @$_POST["x_estado"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_nit = @$_POST["x_nit"];
	$x_perfil = @$_POST["x_perfil"];
	$x_sistema = @$_POST["x_sistema"];
	$x_salario = @$_POST["x_salario"];
  $x_acceso_web = implode(",",@$_POST["x_acceso_web"]);
}
if (($sKey == "") || ((is_null($sKey)))) {
  abrir_url("funcionariolist.php","_parent");
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			alerta("Registro no encontrado" . $sKey);
			abrir_url("funcionario_detalles.php?key=".$sKey,"detalle_fun");
			abrir_url("vacio.php?key=".$sKey,"detalles");
		}
		break;
	case "U": // Update
    if (EditData($sKey,$conn)) { // Update Record based on key
		  alerta("Actualización exitosa");
			abrir_url("funcionario_detalles.php?key=".$sKey,"detalle_fun");
			abrir_url("vacio.php?key=".$sKey,"detalles");
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
<form name="funcionarioedit" id="funcionarioedit" action="funcionarioedit.php" method="post" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<input type="hidden" name="EW_Max_File_Size" value="2000000">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Numero automatico entregado por el sistema que identifica el funcionario"><span class="phpmaker" style="color: #FFFFFF;" >IDENTIFICACI&Oacute;N DEL FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idfuncionario; ?><input type="hidden" name="x_idfuncionario" id="x_idfuncionario" value="<?php echo $x_idfuncionario; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Numero de identificacion del funcionario"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEL FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="hidden" name="x_funcionario_codigo" id="x_funcionario_codigo" size="30" value="<?php echo htmlspecialchars(@$x_funcionario_codigo) ?>">
<?php echo htmlspecialchars(@$x_funcionario_codigo) ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de usuario con el cual se ingresa al sistema"><span class="phpmaker" style="color: #FFFFFF;">LOGIN (intranet)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="hidden" name="x_login" id="x_login" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_login) ?>">
<?php echo htmlspecialchars(@$x_login) ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Contraseña asignada al funcionario para ingresar al sistema"><span class="phpmaker" style="color: #FFFFFF;">CLAVE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="password" name="x_clave" value="" size="30" maxlength="50">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre(s) del funcionario"><span class="phpmaker" style="color: #FFFFFF;">NOMBRES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input class="required" type="text" name="x_nombres" id="x_nombres" size="30" maxlength="255" value="<?php echo @$x_nombres; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Apellido(s) del funcionario"><span class="phpmaker" style="color: #FFFFFF;">APELLIDOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_apellidos" id="x_apellidos" size="30" maxlength="255" value="<?php echo @$x_apellidos; ?>">
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
	</tr>
	<tr>
		<td class="encabezado" title="Correo electronico del funcionario."><span class="phpmaker" style="color: #FFFFFF;">Email</span></td>
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
		<td class="encabezado" title="Firma digital del funcionario"><span class="phpmaker" style="color: #FFFFFF;">FIRMA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if ((!is_null($x_firma)) && $x_firma <> "") {  ?>
<input type="radio" name="a_x_firma" value="1" checked>Guardar&nbsp;
<input type="radio" name="a_x_firma" value="2">Remover&nbsp;
<input type="radio" name="a_x_firma" value="3">Reemplazar<br>
<?php } else {?>
<input type="hidden" name="a_x_firma" value="3">
<?php } ?>
<input type="file" id="x_firma" name="x_firma" size="30" onChange="if (this.form.a_x_firma[2]) this.form.a_x_firma[2].checked=true;">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado del funcionario en el sistema"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1);
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha de ingreso del funcionario"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="<?php echo FormatDateTime(@$x_fecha_ingreso,5); ?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_ingreso,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Permite elegir el perfil de acceso al funcionario"><span class="phpmaker" style="color: #FFFFFF;">PERFIL DE ACCESO</span></td>
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
	</tr>
		<!--tr>
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
	<?php
	$busqueda=busca_filtro_tabla("","funcionario_validacion a","funcionario_idfuncionario='".$_REQUEST["key"]."'","",$conn);
	$tipos=extrae_campo($busqueda,"tipo");

	?>
	<tr>
		<td class="encabezado" title="Permite elefir el perfil de acceso al funcionario"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE VALIDACI&Oacute;N</span></td>
		
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<input type="checkbox" name="validaciones_funcionario[]" value="1" <?php if(in_array("1",$tipos)){ echo 'checked'; } ?> >Transferencias Masivas
		</td>
	</tr>
  <!--tr>
		<td class="encabezado" title="Permite establecer si el usuario tiene acceso al sistema SAIA."><span class="phpmaker" style="color: #FFFFFF;">ACCESO WEB</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php $acceso=explode(",",$x_acceso_web); 
//print_r($acceso[0]);//if (!(!is_null($x_acceso_web)) || ($x_acceso_web == "")) { $x_acceso_web = 1;} // Set default value ?>
<input type="checkbox" name="x_acceso_web[]"<?php for($i=0;$i<count($acceso);$i++){if ($acceso[$i] == "1") { ?> checked<?php }} ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SAIA"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="checkbox" name="x_acceso_web[]"<?php for($j=0;$j<count($acceso);$j++){if ($acceso[$j] == "2") { ?> checked<?php }} ?> value="<?php echo htmlspecialchars("2"); ?>">
<?php echo "ISOSYSTEM"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="checkbox" name="x_acceso_web[]"<?php for($k=0;$k<count($acceso);$k++){if ($acceso[$k] == "3") { ?> checked<?php }} ?> value="<?php echo htmlspecialchars("3"); ?>">
<?php echo "CAKTUS"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr-->
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*,".fecha_db_obtener("A.fecha_ingreso","Y-m-d H:i:s")." AS fecha FROM funcionario A";
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
	$rs = phpmkr_query($sSql,$conn) or error("Fall&oacute; la b&uacute;squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
  $dato=phpmkr_num_rows($rs);
	if ($dato == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
	  
		// Get the field contents
		$GLOBALS["x_idfuncionario"] = $row["idfuncionario"];
		$GLOBALS["x_funcionario_codigo"] = $row["funcionario_codigo"];
		$GLOBALS["x_login"] = $row["login"];
		$GLOBALS["x_clave"] = $row["clave"];
		$GLOBALS["x_nombres"] = $row["nombres"];
		$GLOBALS["x_apellidos"] = $row["apellidos"];
		$GLOBALS["x_email"] = $row["email"];
		$GLOBALS["x_firma"] = $row["firma"];
		$GLOBALS["x_estado"] = $row["estado"];
    $GLOBALS["x_direccion"] = $row["direccion"];
    $GLOBALS["x_telefono"] = $row["telefono"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha"];
		$GLOBALS["x_nit"] = $row["nit"];
		$GLOBALS["x_perfil"] = $row["perfil"];
		$GLOBALS["x_sistema"] = $row["sistema"];
		
		$salario = busca_filtro_tabla("","dependencia_cargo a, funcionario_salario b","funcionario_idfuncionario=".$sKeyWrk." AND a.estado=1 AND dependencia_cargo_iddependencia_cargo=iddependencia_cargo","",$conn);
		if($salario["numcampos"] > 0){
			$GLOBALS["x_salario"] = $salario[0]["salario"];
		}
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
	$sSql = "SELECT A.* FROM funcionario A";
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
	$rs1=phpmkr_query($sSql,$conn);
	$i=phpmkr_num_rows($rs1);
	
	if ($i== 0) {
		$EditData = false; // Update Failed
	}else{

		// check file size
		$EW_MaxFileSize = @$_POST["EW_Max_File_Size"];
		if (!empty($_FILES["x_firma"]["size"])) {
			if (!empty($EW_MaxFileSize) && $_FILES["x_firma"]["size"] > $EW_MaxFileSize) {
				error("Archivo de firma demasiado grande.");
			}
		}
		$a_x_firma = @$_POST["a_x_firma"];
		$theValue = ($GLOBALS["x_funcionario_codigo"] != "") ? intval($GLOBALS["x_funcionario_codigo"]) : "NULL";
		$fieldList["funcionario_codigo"] = "'".$theValue."'";	
    $codigo = $theValue;			
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_login"]) : $GLOBALS["x_login"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["login"] = $theValue;
		
		if($GLOBALS["x_clave"]){
			$theValue = " '" .encrypt_md5(trim($GLOBALS["x_clave"])). "'";
			$fieldList["clave"] = $theValue;
		}
		
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombres"]) : $GLOBALS["x_nombres"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombres"] = ($theValue);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_apellidos"]) : $GLOBALS["x_apellidos"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["apellidos"] = ($theValue);
		  // Field direccion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_direccion"]) : $GLOBALS["x_direccion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["direccion"] = ($theValue);
	// Field telefono
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_telefono"]) : $GLOBALS["x_telefono"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["telefono"] = ($theValue);

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_email"]) : $GLOBALS["x_email"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["email"] = ($theValue);
		if ($a_x_firma == "2") { // Remove
			$fieldList["firma"] = "null";
		} else if ($a_x_firma == "3") { // Update
			if (is_uploaded_file($_FILES["x_firma"]["tmp_name"])) {
				$fileHandle = fopen($_FILES["x_firma"]["tmp_name"], "rb");
				$fileContent = fread($fileHandle, $_FILES["x_firma"]["size"]);
				$theValue =$fileContent; //addslashes($fileContent);
				fclose($fileHandle);
				$fieldList["firma"] = $theValue;
				@unlink($_FILES["x_firma"]["tmp_name"]);
			}
		}
    $theValue = ($GLOBALS["x_estado"] != "") ? intval($GLOBALS["x_estado"]) : "NULL";
		$fieldList["estado"] = "'".$theValue."'";
    		
		$reemplazo = busca_filtro_tabla("nuevo,antiguo,iddependencia_cargo as id","reemplazo,dependencia_cargo,funcionario","funcionario_idfuncionario=idfuncionario and funcionario_codigo = $codigo and (nuevo=iddependencia_cargo or antiguo=iddependencia_cargo) and reemplazo.activo=1","",$conn);
		if($reemplazo["numcampos"]>0)
		 for($i=0; $i<$reemplazo["numcampos"]; $i++)
     {
      if($theValue==0 && $reemplazo[$i]["id"]==$reemplazo[$i]["nuevo"])
      {
       $nombre_r=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazo[$i]["antiguo"],"",$conn);
       confirmacion("El funcionario no se puede desactivar porque esta reemplazando a ".$nombre_r[0]["nombre"].". Desea desactivar el reemplazo ?");
       $theValue=1;
       return false;
      }
      if($theValue==1 && $reemplazo[$i]["id"]==$reemplazo[$i]["antiguo"])
      {
       $nombre_r=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$reemplazo[$i]["nuevo"],"",$conn);
       confirmacion("No se puede activar porque el funcionario ".$nombre_r[0]["nombre"]." lo esta reemplazando. Desea desactivar el reemplazo ?");
       $theValue=0; 
       return false;      
      }
     }		
		if($theValue==0)
		{
     phpmkr_query("update dependencia_cargo set estado=0 where funcionario_idfuncionario=$sKeyWrk",$conn) or error("Fallo inactivar los roles del funcioanrio");
    }    
		$theValue = ($GLOBALS["x_fecha_ingreso"] != "") ?  ConvertDateToMysqlFormat($GLOBALS["x_fecha_ingreso"])  : "NULL";
		$fieldList["fecha_ingreso"] = fecha_db_almacenar($theValue,'Y-m-d h:i:s');
		$fieldList["perfil"] = "'".implode(",",$GLOBALS["x_perfil"])."'";
		/*$theValue = ($GLOBALS["x_sistema"] != "") ? intval($GLOBALS["x_sistema"]) : "NULL";
		$fieldList["sistema"] = "'".$theValue."'";*/
		phpmkr_query("delete from funcionario_validacion where funcionario_idfuncionario=".$sKeyWrk);
		foreach($_REQUEST["validaciones_funcionario"] as $valor){
			if($valor){
				$sql1="insert into funcionario_validacion (funcionario_idfuncionario, tipo) values ('".$sKeyWrk."', '".$valor."')";
				phpmkr_query($sql1);
			}
		}
    //$theValue = ($GLOBALS["x_acceso_web"] != "") ? intval($GLOBALS["x_acceso_web"]) : "NULL";
  	//$fieldList["acceso_web"] = $theValue;
  	
  	/*$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_acceso_web"]) : $GLOBALS["x_acceso_web"]; 
  	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  	$fieldList["acceso_web"] = ($theValue);*/
    //verifica si existe un codigo repetido en los funcionarios.
  $verificar = busca_filtro_tabla("*","funcionario A","A.funcionario_codigo=".$fieldList["funcionario_codigo"]." and A.idfuncionario<>$sKeyWrk","",$conn);    
    if($verificar["numcampos"]>0)
    { alerta("El codigo del funcionario ya se encuentra asignado");      
      redirecciona("funcionarioedit.php?key=$sKeyWrk");
    } 
    
		// update
		$sSql = "UPDATE funcionario SET ";
		$firma=NULL;
		foreach ($fieldList as $key=>$temp) {
			
		 if(!strcmp($key, "firma"))
		   {
		     $firma=$temp; // Guardo la informacion  de la firma 
		   }
     else 
       $sSql .= "$key = $temp, ";   
		}
		
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idfuncionario ='". $sKeyWrk."'";    
     phpmkr_query($sSql);
     /// ACTUALIZO LAS FIRMAS DIGITALES 
     //echo $fieldList["firma"];
     if($firma!=NULL)
     {guardar_lob("firma","funcionario","idfuncionario=".$sKeyWrk,$fieldList["firma"],"archivo",$conn);
     } // fin If */
    //die();
   $EditData = true; // Update Successful  
	//cargar_permisos_funcionario($sKeyWrk);
	}
	$rol = busca_filtro_tabla("","dependencia_cargo a,funcionario_salario b","dependencia_cargo_iddependencia_cargo=iddependencia_cargo AND funcionario_idfuncionario=".$sKeyWrk." AND a.estado=1","iddependencia_cargo desc",$conn);
	if($rol["numcampos"] > 0){
		$sql = "UPDATE funcionario_salario SET salario='".@$_POST["x_salario"]."' WHERE dependencia_cargo_iddependencia_cargo=".$rol[0]["iddependencia_cargo"];
		phpmkr_query($sql);
	}
	else {
		$rol = busca_filtro_tabla("","dependencia_cargo a","funcionario_idfuncionario=".$sKeyWrk." AND a.estado=1","",$conn);
		$sql = "INSERT INTO funcionario_salario (salario,dependencia_cargo_iddependencia_cargo) values('".@$_POST["x_salario"]."',".$rol[0]["iddependencia_cargo"].")";
		phpmkr_query($sql);
	}
	return $EditData;
}

function confirmacion($texto)
{
?>
<script type="text/javascript">
<!--
if(confirm("<?php echo $texto ;?>"))
 window.open("reemplazo.php?formato_revertir=1","centro"); 
//-->
</script>
<?php
}
?>