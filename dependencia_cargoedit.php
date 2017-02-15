<?php include ("db.php"); 
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="popcalendar.js"></script>
<?php
$ewCurSec = 0; // Initialise

if(isset($_REQUEST["funcionario"]) && $_REQUEST["funcionario"]!='' && !isset($_REQUEST["a_edit"])){   
$i=0;  
while(isset($_REQUEST["idrol".$i])){
	if($_REQUEST["estado".$i]==0){
		$_REQUEST["fechaf".$i]=date("Y-m-d H:i:s");
	}
	$sql='update dependencia_cargo set estado='.$_REQUEST["estado".$i].',fecha_inicial='.fecha_db_almacenar($_REQUEST["fechai".$i],'Y-m-d H:i:s').',fecha_final='.fecha_db_almacenar($_REQUEST["fechaf".$i],'Y-m-d H:i:s').' where iddependencia_cargo='.$_REQUEST["idrol".$i];
	phpmkr_query($sql,$conn);                     
	$i++;
}
validar_tipo_cargo($_REQUEST["funcionario"]);
abrir_url("funcionario.php?key=".@$_REQUEST["funcionario"],"_parent");
die();
} 
   

// Initialize common variables
$x_iddependencia_cargo = Null;
$x_funcionario_idfuncionario = Null;
$x_dependencia_iddependencia = Null;
$x_cargo_idcargo = Null;
$x_estado = Null;
$x_fecha_inicial = Null;
$x_fecha_final = Null;
$x_fecha_ingreso = Null;
include ("phpmkrfn.php");
include ("header.php");


if(isset($_REQUEST["func"]) && $_REQUEST["func"]!='')
 nueva_interfaz($_REQUEST["func"]); 
$sKey = @$_GET["key"];
$x_funcionario_idfuncionario=$sKey;
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	$x_iddependencia_cargo = @$_POST["x_iddependencia_cargo"];
	$x_funcionario_idfuncionario = @$_POST["x_funcionario_idfuncionario"];
	$x_estado = @$_POST["x_estado"];
	$x_fecha_inicial = @$_POST["x_fecha_inicial"];
	$x_fecha_final = @$_POST["x_fecha_final"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	abrir_url("funcionariolist.php","_parent");
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			abrir_url("funcionario.php?key=".@$x_funcionario_idfuncionario,"_parent");
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			abrir_url("funcionario.php?key=".@$_REQUEST['funcionario'],"_parent");		
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
if (EW_this.x_estado && !EW_hasValue(EW_this.x_estado, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_estado, "RADIO", "Por favor ingrese los campos requeridos - Estado Actual "))
		return false;
}
if (EW_this.x_fecha_inicial && !EW_hasValue(EW_this.x_fecha_inicial, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Por favor ingrese los campos requeridos - Fecha Inicio Actividades"))
		return false;
}
if (EW_this.x_fecha_inicial && !EW_checkdate(EW_this.x_fecha_inicial.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Formato de fecha incorrecto YYYY/MM/DD - Fecha Inicio Actividades"))
		return false; 
}
if (EW_this.x_fecha_final && !EW_hasValue(EW_this.x_fecha_final, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_final, "TEXT", "Por favor ingrese los campos requeridos - Fecha Final Actividades"))
		return false;
}
if (EW_this.x_fecha_final && !EW_checkdate(EW_this.x_fecha_final.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_final, "TEXT", "Formato de fecha incorrecto YYYY/MM/DD - Fecha Final Actividades"))
		return false; 
}
var dif;
var fecha1 = EW_this.x_fecha_inicial.value;
var fecha2 = EW_this.x_fecha_final.value;
var mes = eval(fecha1.substring(5,7)+"-1");
var mes2 = eval(fecha2.substring(5,7)+"-1");
inicio = new Date(fecha1.substring(0,4),mes,fecha1.substring(8,10));
fin = new Date(fecha2.substring(0,4),mes2,fecha2.substring(8,10));
dif = Math.floor((fin.getTime() - inicio.getTime())/(1000*60*60*24));
if(dif<=0)
{ alert("La fecha final de actividades no puede ser menor o igual que la fecha inicial, por favor verifique");
  return false;
}

return true;
}
</script>
<form name="dependencia_cargoedit" id="dependencia_cargoedit" action="dependencia_cargoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Consecutivo del registro"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE ROL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_iddependencia_cargo; ?><input type="hidden" name="x_iddependencia_cargo" value="<?php echo $x_iddependencia_cargo; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Seleccione un funcionario de la Intranet"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO INTRANET</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
  $func = busca_filtro_tabla("idfuncionario,".concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario","idfuncionario=$x_funcionario_idfuncionario","",$conn);
  if($func["numcampos"]>0)
    echo $func[0]["nombre"];
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Seleccione un proceso del listado"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$dep = busca_filtro_tabla("nombre,codigo","dependencia","iddependencia=$x_dependencia_iddependencia","",$conn);
if($dep["numcampos"])
 echo $dep[0]["nombre"]." (".$dep[0]["codigo"].")";
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Seleccione un cargo de la lista"><span class="phpmaker" style="color: #FFFFFF;">CARGO ASIGNADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$cargo = busca_filtro_tabla("nombre","cargo","idcargo=$x_cargo_idcargo","",$conn);
if($cargo["numcampos"]>0)
  echo $cargo[0]["nombre"];
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado actual del funcionario"><span class="phpmaker" style="color: #FFFFFF;">ESTADO ACTUAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha en la que el funcionario inicia su per&iacute;odo activo"><span class="phpmaker" style="color: #FFFFFF;">FECHA INICIO DE ACTIVIDADES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_inicial" id="x_fecha_inicial" value="<?php echo FormatDateTime(@$x_fecha_inicial,5); ?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_inicial,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha en la que el funcionario termina su per&iacute;odo activo"><span class="phpmaker" style="color: #FFFFFF;">FECHA FINAL DE ACTIVIDADES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_final" id="x_fecha_final" value="<?php echo FormatDateTime(@$x_fecha_final,5); ?>">
<input type="hidden" name="funcionario" value="<?php echo($x_funcionario_idfuncionario);?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_final,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php
include ("footer.php");


//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ 
  global $x_iddependencia_cargo, $x_funcionario_idfuncionario, $x_dependencia_iddependencia, $x_cargo_idcargo, $x_estado, $x_fecha_inicial, $x_fecha_final, $x_fecha_ingreso;  
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*,".fecha_db_obtener("A.fecha_inicial",'Y-m-d')." AS fecha_i,".fecha_db_obtener("A.fecha_final",'Y-m-d')." AS fecha_f FROM dependencia_cargo A";
	$sSql .= " WHERE A.iddependencia_cargo = " . $sKeyWrk;
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

		// Get the field contents
		$x_iddependencia_cargo = $row["iddependencia_cargo"];
		$x_funcionario_idfuncionario = $row["funcionario_idfuncionario"];
		$x_dependencia_iddependencia = $row["dependencia_iddependencia"];
		$x_cargo_idcargo = $row["cargo_idcargo"];
		$x_estado = $row["estado"];
		$x_fecha_inicial = $row["fecha_i"];
		$x_fecha_final = $row["fecha_f"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
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
  global $x_iddependencia_cargo, $x_funcionario_idfuncionario, $x_dependencia_iddependencia, $x_cargo_idcargo, $x_estado, $x_fecha_inicial, $x_fecha_final, $x_fecha_ingreso;
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM dependencia_cargo A";
	$sSql .= " WHERE A.iddependencia_cargo = " . $sKeyWrk;
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
		$theValue = ($x_estado != "") ? intval($x_estado) : "NULL";
		$fieldList["estado"] = $theValue;
		$fieldList["fecha_inicial"] = fecha_db_almacenar($x_fecha_inicial,'Y-m-d');
		if($fieldList["estado"]==0){
			$x_fecha_final=date("Y-m-d");
		}
		$fieldList["fecha_final"] = fecha_db_almacenar($x_fecha_final,'Y-m-d');
		// update
		$sSql = "UPDATE dependencia_cargo SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE iddependencia_cargo =". $sKeyWrk;
   		 phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);		
		validar_tipo_cargo($_REQUEST["funcionario"]);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
encriptar_sqli("dependencia_cargoedit",1);
/*
<Clase>
<Nombre>nueva_interfaz</Nombre> 
<Parametros>$fun: id del funcionario</Parametros>
<Responsabilidades>Editar todos los roles de un funcionario<Responsabilidades>
<Notas>esta nueva interfaz se hace para mejorar la edicion de los roles para los funcionarios que tienen varios roles</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function nueva_interfaz($fun)
{ global $conn;
  $roles = busca_filtro_tabla("iddependencia_cargo,dependencia_cargo.estado,dependencia.nombre as nombred,dependencia.estado as estadod,cargo.nombre as nombrec,cargo.estado as estadoc,".fecha_db_obtener('fecha_inicial','Y-m-d')." as fechai, ".fecha_db_obtener('fecha_final','Y-m-d')." as fechaf","dependencia_cargo,dependencia,cargo,funcionario","idfuncionario = funcionario_idfuncionario and iddependencia=dependencia_iddependencia and idcargo=cargo_idcargo and idfuncionario=$fun","iddependencia_cargo desc",$conn);
  
 if($roles["numcampos"]>0)
 { echo '<form name="full_edit" action="dependencia_cargoedit.php"><table border=1><tr class="encabezado_list"><!--td>&nbsp;&nbsp;</td--><td>Fecha Inicial</td><td>Fecha Final</td><td>Estado</td><td>Cargo</td><td>Dependencia</td></tr>'; 
  for($i=0; $i<$roles["numcampos"]; $i++)
  { 
    echo '<tr>
           <!--td><input type="checkbox" name="idroles[]" value="'.$roles[$i]["iddependencia_cargo"].'"></td-->           
           <td><input type="text" name="fechai'.$i.'" id="fechai'.$i.'" value="'.FormatDateTime($roles[$i]['fechai'],5).'" size="13">&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.fechai'.$i.',\'yyyy/mm/dd\');return false;"></td>
           <td><input type="text" name="fechaf'.$i.'" id="fechaf'.$i.'" value="'.FormatDateTime($roles[$i]['fechaf'],5).'" size="13">&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.fechaf'.$i.',\'yyyy/mm/dd\');return false;"></td>
           <td>'.estado($roles[$i]['estado'],5,$i).'</td><td>'.$roles[$i]["nombrec"].' ('.estado($roles[$i]['estadoc']).')</td>
           <td>'.$roles[$i]["nombred"].' ('.estado($roles[$i]['estadod']).')</td>
           </tr>';
    echo '<input type="hidden" name="idrol'.$i.'" value="'.$roles[$i]["iddependencia_cargo"].'">';
  }
  echo '<tr><td colspan="7" align="center"><input type="submit" name="Aceptar" value="Aceptar"></td></tr></table><input type="hidden" name="funcionario" value="'.$fun.'"></form>';
 }
 include_once("footer.php");  
 die();
 return true;
}
function estado($dato,$tipo="",$i="")
{
 if($dato==0)  
  $estado= 'INACTIVO';
 else 
  $estado= 'ACTIVO';
 if($tipo==5) 
 {  $estado = '<select name="estado'.$i.'"><option value="1"';
  if($dato==1) 
    $estado.=' selected>Activo</option><option value="0">Inactivo</option></select>';
  else 
    $estado.='>Activo</option><option value="0" selected>Inactivo</option></select>';
 }  
 return $estado;    
}
function validar_tipo_cargo($idfuncionario){
  $roles=busca_filtro_tabla("","dependencia_cargo a, cargo b","a.funcionario_idfuncionario=".$idfuncionario." and a.estado=1 and b.estado=1 and a.cargo_idcargo=b.idcargo and b.tipo_cargo='1'","",$conn);
  if(!$roles["numcampos"]){
    $ultimo_rol=busca_filtro_tabla("","dependencia_cargo a, cargo b","a.funcionario_idfuncionario=".$idfuncionario." and a.cargo_idcargo=b.idcargo and b.tipo_cargo='1'","iddependencia_cargo desc",$conn);
    alerta("El funcionario debe tener por lo menos un rol con cargo administrativo, se activara un rol automaticamente");
    $sql1="update dependencia_cargo set estado='1' where iddependencia_cargo=".$ultimo_rol[0]["iddependencia_cargo"];
    phpmkr_query($sql1);
  }
}
?>