<?php
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");

?>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">(function($) {

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
$x_ventanilla_radicacion = Null;
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
$x_acceso_web = NULL;
$x_intento_login = NULL;


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
	$x_ventanilla_radicacion = @$_POST['x_ventanilla_radicacion'];
  $x_direccion = @$_POST["x_direccion"];
  $x_telefono = @$_POST["x_telefono"];
	$x_firma = @$_POST["x_firma"];
	$x_estado = @$_POST["x_estado"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
	$x_nit = @$_POST["x_nit"];
	$x_perfil = @$_POST["x_perfil"];
	$x_sistema = @$_POST["x_sistema"];
  $x_acceso_web = implode(",",@$_POST["x_acceso_web"]);

  if($x_estado==1){
  	$x_intento_login=0;
  }else{
  	$x_intento_login=@$_POST["x_intento_login"];;
  }



}
if (($sKey == "") || ((is_null($sKey)))) {
  abrir_url("funcionariolist.php","_parent");
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			alerta("Registro no encontrado" . $sKey);
			abrir_url("funcionario_detalles_start.php?key=".$sKey,"detalle_fun");
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

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:100%;">

	<tr>
		<td class="encabezado" title="Numero de identificacion del funcionario"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo htmlspecialchars(@$x_nit) ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de usuario con el cual se ingresa al sistema"><span class="phpmaker" style="color: #FFFFFF;">LOGIN (intranet)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo htmlspecialchars(@$x_login) ?>
</span></td>
	</tr>
	<!-- tr>
		<td class="encabezado" title="Contraseña asignada al funcionario para ingresar al sistema"><span class="phpmaker" style="color: #FFFFFF;">CLAVE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">

</span></td>
	</tr -->
	<tr>
		<td class="encabezado" title="Nombre(s) del funcionario"><span class="phpmaker" style="color: #FFFFFF;">NOMBRES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_nombres; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Apellido(s) del funcionario"><span class="phpmaker" style="color: #FFFFFF;">APELLIDOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_apellidos; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Direcci&oacute;n del funcionario."><span class="phpmaker" style="color: #FFFFFF;">DIRECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_direccion ?>
</span></td>
	</tr>
  <tr>
		<td class="encabezado" title="Telefono."><span class="phpmaker" style="color: #FFFFFF;">TEL&Eacute;FONO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_telefono ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Correo electronico del funcionario."><span class="phpmaker" style="color: #FFFFFF;">Email</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_email ?>
</span></td>
	</tr>

	<tr>
		<td class="encabezado" title="Firma digital del funcionario"><span class="phpmaker" style="color: #FFFFFF;">FIRMA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php

	if($x_firma!=''){
		echo '<img src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/formatos/librerias/mostrar_foto.php?codigo='.$x_funcionario_codigo;
		echo '" width="200" height="100"/><br />';
	}else{
		echo'Sin Firma';
	}



 ?>



</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado del funcionario en el sistema"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php

	if (@$x_estado == "1") {
		echo('Activo');

	}else{
		echo('Inactivo');
	}
?>
</span>

</td>
	</tr>

<tr>
	<td class="encabezado" title="Ventanilla de radicaci&oacute;n del funcionario en el sistema">
		<span class="phpmaker" style="color: #FFFFFF;">VENTANILLA DE RADICACI&Oacute;N
		</span>
	</td>
	<td bgcolor="#F5F5F5">
		<span class="phpmaker">
			<?php
				$nombre_ventanilla='Sin ventanilla de radicaci&oacute;n asignada';
				if($x_ventanilla_radicacion){
					$cnombre_ventanilla=busca_filtro_tabla("nombre,valor","cf_ventanilla","estado=1	AND idcf_ventanilla=".$x_ventanilla_radicacion,"",$conn);
					if($cnombre_ventanilla['numcampos']){
						$nombre_ventanilla=$cnombre_ventanilla[0]['nombre'];
					}
				}
				echo($nombre_ventanilla);
			?>
		</span>
	</td>
</tr>

	<tr>
		<td class="encabezado" title="Fecha de ingreso del funcionario"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo date('Y-m-d',strtotime(@$x_fecha_ingreso)); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Permite elegir el perfil de acceso al funcionario"><span class="phpmaker" style="color: #FFFFFF;">PERFIL DE ACCESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
  		<?php
  		$nombre_perfil=busca_filtro_tabla("nombre","perfil","idperfil in($x_perfil)","",$conn);

		for($i=0;$i<$nombre_perfil['numcampos'];$i++){
			echo($nombre_perfil[$i]['nombre'].'<br/>');
		}


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

			 <?php
			 	if(in_array("1",$tipos)){
			?>
				<tr>
				<td class="encabezado" title="Permite elefir el perfil de acceso al funcionario"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE VALIDACI&Oacute;N</span></td>

				<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
			 		 echo 'Transferencias Masivas';
			?>
				</span></td>
				</tr>
			<?php
				}
			 ?>


</table>
<p>

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
		$GLOBALS["x_ventanilla_radicacion"] = $row["ventanilla_radicacion"];
		$GLOBALS["x_firma"] = $row["firma"];
		$GLOBALS["x_estado"] = $row["estado"];
    $GLOBALS["x_direccion"] = $row["direccion"];
    $GLOBALS["x_telefono"] = $row["telefono"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha"];
		$GLOBALS["x_nit"] = $row["nit"];
		$GLOBALS["x_perfil"] = $row["perfil"];
		$GLOBALS["x_sistema"] = $row["sistema"];
		$GLOBALS["x_intento_login"] = $row["intento_login"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
