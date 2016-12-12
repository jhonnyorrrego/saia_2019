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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<?php

// Initialize common variables
$x_iddependencia_cargo = Null;
$x_funcionario_idfuncionario = Null;
$x_dependencia_iddependencia = Null;
$x_cargo_idcargo = Null;
$x_estado = Null;
$x_fecha_inicial = Null;  
$x_fecha_final = Null;
$x_fecha_ingreso = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include_once ("librerias_saia.php"); echo(librerias_notificaciones()); ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$x_funcionario_idfuncionario = @$_REQUEST["func"];
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
	$x_iddependencia_cargo = @$_POST["x_iddependencia_cargo"];
	$x_funcionario_idfuncionario = @$_POST["x_funcionario_idfuncionario"];
	$x_dependencia_iddependencia = @$_POST["x_dependencia_iddependencia"];
	$x_cargo_idcargo = @$_POST["x_cargo_idcargo"];
	$x_estado = @$_POST["x_estado"];
	$x_fecha_inicial = @$_POST["x_fecha_inicial"];
	$x_fecha_final = @$_POST["x_fecha_final"];
	$x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
}

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
	    alerta("Registro no encontrado" . @$x_funcionario_idfuncionario);
			abrir_url("funcionario.php?key=".@$x_funcionario_idfuncionario,"centro");
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			alerta("Adicion exitosa del registro.");
			abrir_url("funcionario.php?key=".@$x_funcionario_idfuncionario,"_parent");
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
          <style>label.error{color:red}                                 
          </style>
<script type='text/javascript'>
  $().ready(function(){
	// validar los campos del formato
	$('#dependencia_cargoadd').validate();
	
});
</script>  
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {

if (EW_this.x_fecha_inicial && !EW_hasValue(EW_this.x_fecha_inicial, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Por favor ingrese los campos requeridos - Fecha Inicio Actividades"))
		return false;
}
if (EW_this.x_fecha_inicial && !EW_checkdate(EW_this.x_fecha_inicial.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - Fecha Inicio Actividades"))
		return false; 
}
if (EW_this.x_fecha_final && !EW_hasValue(EW_this.x_fecha_final, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_final, "TEXT", "Por favor ingrese los campos requeridos - Fecha Final Actividades"))
		return false;
}
if (EW_this.x_fecha_final && !EW_checkdate(EW_this.x_fecha_final.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_final, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - Fecha Final Actividades"))
		return false; 
}
// verificar que la fecha final de actividades sea mayor que la fecha inicial de actividades de un rol
var dif;
var fecha1 = EW_this.x_fecha_inicial.value;
var fecha2 = EW_this.x_fecha_final.value;
var mes = eval(fecha1.substring(5,7)+"-1");
var mes2 = eval(fecha2.substring(5,7)+"-1");
inicio = new Date(fecha1.substring(0,4),mes,fecha1.substring(8,10));
fin = new Date(fecha2.substring(0,4),mes2,fecha2.substring(8,10));
dif = Math.floor((fin.getTime() - inicio.getTime())/(1000*60*60*24));
if(dif<=0)
{ 
    //alert("La fecha final de actividades no puede ser menor o igual que la fecha inicial, por favor verifique");
    notificacion_saia('<b>ATENCI&Oacute;</b><br>La fecha final de actividades no puede ser menor o igual que la fecha inicial, por favor verifique','warning','',4000);
  return false;
}
return true;
}

//-->
</script>
<script type="text/javascript" src="popcalendar.js"></script>
<form name="dependencia_cargoadd" id="dependencia_cargoadd" action="dependencia_cargoadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Seleccione un funcionario de la Intranet."><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO INTRANET*</span></td>
		<?php if($x_funcionario_idfuncionario){ ?>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<input type="hidden" class="required" name="x_funcionario_idfuncionario" id="x_funcionario_idfuncionario" value="<?php echo($x_funcionario_idfuncionario); ?>">
<?php
$funcionario=busca_filtro_tabla("","funcionario a","a.idfuncionario=".$x_funcionario_idfuncionario,"",$conn);
echo(ucwords(strtolower($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"])));
?>
</span></td>
		<?php }else{
			$funcionarios=busca_filtro_tabla("","funcionario A","","A.nombres,A.apellidos",$conn);
			?>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
			<select name="x_funcionario_idfuncionario" id="x_funcionario_idfuncionario">
			<?php for($i=0;$i<$funcionarios["numcampos"];$i++){
				echo('<option value="'.$funcionarios[$i]["idfuncionario"].'">'.ucwords(strtolower($funcionarios[$i]["nombres"].' '.$funcionarios[$i]["apellidos"])).'</option>');
			} ?>
			</select>
			</span></td>
		<?php } ?>
	</tr>
	<tr>
		<td class="encabezado" title="Asigne una dependencia al funcionario."><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_dependencia_iddependencia)) || ($x_dependencia_iddependencia == "")) { $x_dependencia_iddependencia = 0;} // Set default value ?>
<div id="esperando_dep"><img src="imagenes/cargando.gif"></div>
    <span style="font-family: Verdana; font-size: 9px;">
  	  <br>
      Buscar:<br><input type="text" id="stext2" width="200px" size="20" style="font-family: Verdana; font-size: 9px;">
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext2').value,1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext2').value,0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext2').value)">
      <img src="botones/general/siguiente.png"border="0px"></a>
     </span><br><br>
<div id="treeboxbox_tree3"></div>
<input type="hidden" name="x_dependencia_iddependencia" class="required" id="x_dependencia_iddependencia">
	<script type="text/javascript">
  <!--
  var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","290px",0);
			tree3.setImagePath("imgs/");
			tree3.enableIEImageFix(true);
			tree3.setOnCheckHandler(onNodeSelect);
			tree3.setXMLAutoLoading("test_serie.php?tabla=dependencia");
			tree3.setOnLoadingStart(cargando_serie);
      tree3.enableCheckBoxes(true);
      tree3.enableRadioButtons(true);
      tree3.enableSingleRadioMode(true);
      tree3.setOnLoadingEnd(fin_cargando_serie);
			tree3.loadXML("test_serie.php?tabla=dependencia&estado=1");

			function onNodeSelect(nodeId)
      { document.getElementById('x_dependencia_iddependencia').value=nodeId;
      }   
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_dep")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_dep")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_dep"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_dep")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_dep")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_dep"]');
        document.poppedLayer.style.display = "";
      }       
	--> 		
	</script>

</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Seleccione el cargo que se le asignar&aacute; al funcionario."><span class="phpmaker" style="color: #FFFFFF;">CARGO ASIGNADO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_cargo_idcargo)) || ($x_cargo_idcargo == "")) { $x_cargo_idcargo = 0;} // Set default value ?>
<div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
    <span style="font-family: Verdana; font-size: 9px;">
  	  <br>
      Buscar:<br><input type="text" id="stext" width="200px" size="20" style="font-family: Verdana; font-size: 9px;">
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png"border="0px"></a>
     </span><br><br>
<div id="treeboxbox_tree2"></div>
<input type="hidden" name="x_cargo_idcargo" class="required" id="x_cargo_idcargo">
	<script type="text/javascript">
  <!--
  var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","290px",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.setOnCheckHandler(onNodeSelect);
			tree2.setXMLAutoLoading("test_serie.php?tabla=cargo");
			tree2.setOnLoadingStart(cargando_serie);
      tree2.enableCheckBoxes(true);
      tree2.enableRadioButtons(true);
      tree2.enableSingleRadioMode(true);
      tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.loadXML("test_serie.php?tabla=cargo&estado=1");

			function onNodeSelect(nodeId)
      { document.getElementById('x_cargo_idcargo').value=nodeId;
      }   
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
        document.poppedLayer.style.display = "none";
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
        document.poppedLayer.style.display = "";
      }       
	--> 		
	</script>

</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado actual del funcionario cumpliendo el rol asignado."><span class="phpmaker" style="color: #FFFFFF;">ESTADO ACTUAL*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_estado)) || ($x_estado == "")) { $x_estado = 1;} // Set default value ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha en la que el funcionario inicia su per&iacute;odo activo."><span class="phpmaker" style="color: #FFFFFF;">FECHA INICIO DE ACTIVIDADES*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_fecha_inicial)) || ($x_fecha_inicial == "")) { $x_fecha_inicial = date('Y-m-d');} // Set default value ?>
<input type="text" readonly="true" name="x_fecha_inicial" class="required" id="x_fecha_inicial" value="<?php echo FormatDateTime(@$x_fecha_inicial,5); ?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_inicial,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Fecha en la que el funcionario termina su per&iacute;odo activo."><span class="phpmaker" style="color: #FFFFFF;">FECHA FINAL ACTIVIDADES*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_fecha_final)) || ($x_fecha_final == "")) { $x_fecha_final = date("Y-m-d");} // Set default value ?>
<input type="text" readonly="true" name="x_fecha_final" class="required" id="x_fecha_final" value="<?php echo FormatDateTime(@$x_fecha_final,5); ?>">
&nbsp;<input type="image" src="images/ew_calendar.gif" alt="Escoger Fecha" onClick="popUpCalendar(this, this.form.x_fecha_final,'yyyy/mm/dd');return false;">
</span></td>
	</tr>
</table>
<p>
<input type="submit" id="adicionar" name="Action" value="Adicionar">
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
	global $x_iddependencia_cargo, $x_funcionario_idfuncionario, $x_dependencia_iddependencia, $x_cargo_idcargo, $x_estado,
		$x_fecha_inicial, $x_fecha_final,	$x_fecha_ingreso;
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_iddependencia_cargo = $row["iddependencia_cargo"];
		$x_funcionario_idfuncionario = $row["funcionario_idfuncionario"];
		$x_dependencia_iddependencia = $row["dependencia_iddependencia"];
		$x_cargo_idcargo = $row["cargo_idcargo"];
		$x_estado = $row["estado"];
		$x_fecha_inicial = $row["fecha_inicial"];
		$x_fecha_final = $row["fecha_final"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
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
	global $x_iddependencia_cargo, $x_funcionario_idfuncionario, $x_dependencia_iddependencia, $x_cargo_idcargo, $x_estado,
		$x_fecha_inicial, $x_fecha_final,	$x_fecha_ingreso;

	// Add New Record
	$sSql = "SELECT * FROM dependencia_cargo A";
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

	// Field funcionario_idfuncionario
	$theValue = ($x_funcionario_idfuncionario != "") ? intval($x_funcionario_idfuncionario) : "NULL";
	$fieldList["funcionario_idfuncionario"] = $theValue;

	// Field dependencia_iddependencia
	$theValue = ($x_dependencia_iddependencia != "") ? intval($x_dependencia_iddependencia) : "NULL";
	$fieldList["dependencia_iddependencia"] = $theValue;

	// Field cargo_idcargo
	$theValue = ($x_cargo_idcargo != "") ? intval($x_cargo_idcargo) : "NULL";
	$fieldList["cargo_idcargo"] = $theValue;

	// Field estado
	$theValue = ($x_estado != "") ? intval($x_estado) : "NULL";
	$fieldList["estado"] = $theValue;

	// Field fecha_inicial
	$fieldList["fecha_inicial"] = fecha_db_almacenar($x_fecha_inicial,'Y/m/d');


	// Field fecha_final	
  $anio=date("Y");
  $fecha_fin= date("Y-m-d", mktime( 0, 0, 0,1, 1,$anio+1));
  $fieldList["fecha_final"] = fecha_db_almacenar($x_fecha_final,'Y-m-d');

  
  $fieldList["tipo"] =1;
	
	if(!validar_tipo_cargo($fieldList))return false;
	// insert into database
	$strsql = "INSERT INTO dependencia_cargo (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	//error($strsql);
	phpmkr_query($strsql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $strsql);
	return true;
}
function validar_tipo_cargo($datos){
	global $conn;
	$idfuncionario=$datos["funcionario_idfuncionario"];
	$cargo=$datos["cargo_idcargo"];
	$tipo_cargo=busca_filtro_tabla("","cargo a","a.idcargo=".$cargo,"",$conn);
	$roles_activos=busca_filtro_tabla("","dependencia_cargo a, cargo b","a.funcionario_idfuncionario=".$idfuncionario." and a.estado=1 and a.cargo_idcargo=b.idcargo and b.estado=1 and b.tipo_cargo='1'","",$conn);
	if(!$roles_activos["numcampos"]&&$tipo_cargo[0]["tipo_cargo"]==2){
		alerta("El funcionario debe tener por lo menos un rol con cargo administrativo");
		return false;
	}
	else
		return true;
}
?>