<?php include ("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idpermiso = Null;
$x_funcionario_idfuncionario = Null;
$x_modulo_idmodulo = Null;
$x_accion = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
$x_modulo = Null;
?>

<?php include ("phpmkrfn.php") ?>
<?php

include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());


// Get action
$sAction = @$_POST["a_add"];
$x_funcionario_idfuncionario=@$_REQUEST["func"];
$datos_func=busca_filtro_tabla("","funcionario","idfuncionario=$x_funcionario_idfuncionario","",$conn);
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
	$x_idpermiso = @$_POST["x_idpermiso"];
	$x_funcionario_idfuncionario = @$_POST["funcionario_elegido"];
	$x_modulo = @$_POST["x_modulos"];	                               //el mudulo
  $x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];  //sub-modulos
  $x_accion = @$_POST["x_accion"];
	//$x_ = @$_POST["x_accion"];
	$x_caracteristica_propio = @$_POST["x_caracteristica_propio"];
	$x_caracteristica_grupo = @$_POST["x_caracteristica_grupo"];
	$x_caracteristica_total = @$_POST["x_caracteristica_total"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			alerta("Registro no encontrado" . $sKey);
			abrir_url("funcionariolist.php","centro");		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
		  alerta("Adicion Exitosa");
			abrir_url("funcionario.php?key=".$x_funcionario_idfuncionario,"_parent");
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<link rel="stylesheet" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<?php include_once("formatos/librerias/header_formato.php"); ?>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
$().ready(function() {
	// validar los campos del formato
 $('#permisoadd').validate({
 	submitHandler: function(form) {
				<?php encriptar_sqli("permisoadd");?>
			    form.submit();
			    
			  }
 });
 $('#modulo_todos').click(function(){
   todos_check(tree3,'x_modulo_idmodulo')
 });
 $('#modulo_ninguno').click(function(){
    ninguno_check(tree3,'x_modulo_idmodulo')
 });
 $('#func_todos').click(function(){
   todos_check(tree4,'x_funcionario_idfuncionario')
 });
 $('#func_ninguno').click(function(){
    ninguno_check(tree4,'x_funcionario_idfuncionario')
 });
});
function todos_check(elemento,campo)
{seleccionados=elemento.getAllLeafs();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],true);
   
   
 seleccionados_padres=elemento.getAllFatItems();	 
 nodos_padre=seleccionados_padres.split(",");
 for(i=0;i<nodos_padre.length;i++){
 	elemento.setCheck(nodos_padre[i],true);   
 }   
   
 document.getElementById(campo).value=elemento.getAllChecked();   
} 
function ninguno_check(elemento,campo)
{seleccionados=elemento.getAllLeafs();
 nodos=seleccionados.split(",");
 for(i=0;i<nodos.length;i++)
   elemento.setCheck(nodos[i],false);
   
 seleccionados_padres=elemento.getAllFatItems();	 
 nodos_padre=seleccionados_padres.split(",");
 for(i=0;i<nodos_padre.length;i++){
 	elemento.setCheck(nodos_padre[i],false);   
 }   
   
 document.getElementById(campo).value="";
}
//-->
</script>
<p><span class="internos">&nbsp;&nbsp;ADICIONAR PERMISO DE ACCESO<br><br><!--a href="permisolist.php">Regresar al listado</a>
&nbsp;&nbsp;&nbsp;<a href="permiso_perfiladd.php">Adicionar Permiso para un Perfil</a--></span></p>
<form name="permisoadd" id="permisoadd" action="permisoadd.php" method="post" >
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="funcionario_elegido" value="<?php echo($x_funcionario_idfuncionario);?>">
<input type="hidden" name="x_funcionario_idfuncionario"  id="x_funcionario_idfuncionario" class="required" value="<?php echo($x_funcionario_idfuncionario);?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&Oacute;DULO ASIGNADO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
     <input type="hidden" name="x_modulo_idmodulo" id="x_modulo_idmodulo"  value="" >
        <br />
          Buscar:<br><input type="text" id="stext_3" width="200px" size="20">
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
          <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
          <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
          <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a>
        <br /><div id="esperando_modulo">
        <img src="imagenes/cargando.gif"></div>
        <div id="treeboxbox_tree3"></div>
    	<script type="text/javascript">
      <!--
          var browserType;
          if (document.layers) {browserType = "nn4"}
          if (document.all) {browserType = "ie"}
          if (window.navigator.userAgent.toLowerCase().match("gecko")) {
             browserType= "gecko"
          }
    			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
    			tree3.setImagePath("imgs/");
    			tree3.enableIEImageFix(true);
    			tree3.enableAutoTooltips(1);
          tree3.enableCheckBoxes(1);
    			tree3.setOnLoadingStart(cargando_serie);
          tree3.setOnLoadingEnd(fin_cargando_serie);
    			//tree3.enableThreeStateCheckboxes(true);
    			tree3.loadXML("test_permiso_modulo.php?entidad=funcionario&llave_entidad=<?php echo $x_funcionario_idfuncionario; echo $condicion; ?>");
    			tree3.setOnCheckHandler(onNodeSelect);
          function fin_cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                  eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "hidden";
            $('#x_modulo_idmodulo').val(tree3.getAllChecked() );
          }
          function onNodeSelect(nodeId)
            {document.getElementById("x_modulo_idmodulo").value=tree3.getAllChecked();
            }
          function cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                   eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "visible";
          }
    	-->
    	</script>
   <br />
   <a href="#" id="modulo_todos">Todos</a>&nbsp;&nbsp;<a href="#" id="modulo_ninguno">Ninguno</a>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Permite establecer si se quita o se adiciona un permiso a un usuario en la organizaci&oacute;."><span class="phpmaker" style="color: #FFFFFF;">ACCI&Oacute;N *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_accion)) || ($x_accion == "")) { $x_accion = 0;} // Set default value ?>
<input type="radio" checked name="x_accion" id="x_accion_add" value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Asignar";  ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_accion" id="x_accion_del" value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Negar"; ?>
<?php echo EditOptionSeparator(1); ?>
<!--input type="radio" name="x_accion" id="x_accion_eli" value="<?php echo htmlspecialchars("2"); ?>">
<?php echo "Eliminar"; ?>-->
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM permiso A";
	$sSql .= " WHERE A.idpermiso = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Falla la busqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$_POST["x_idpermiso"] = $row["idpermiso"];
		$_POST["x_funcionario_idfuncionario"] = $row["funcionario_idfuncionario"];
		$_POST["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$_POST["x_accion"] = $row["accion"];
	/*	$_POST["x_caracteristica_propio"] = $row["caracteristica_propio"];
		$_POST["x_caracteristica_grupo"] = $row["caracteristica_grupo"];
		$_POST["x_caracteristica_total"] = $row["caracteristica_total"];  */
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
	$sSql = "SELECT * FROM permiso";
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
	$idfuncionario=$_POST["x_funcionario_idfuncionario"];	
	$accion=$_POST["x_accion"];
	
  $modulos=explode(',',$_POST["x_modulo_idmodulo"]);
  $modulo=busca_filtro_tabla("","permiso A, modulo B","funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo=idmodulo","",$conn);
  
  $datos=extrae_campo($modulo,'modulo_idmodulo','U');
	
	$quitar=array_diff($datos,$modulos);
	$quitar=array_merge($quitar);
	
	$adicionales=array_diff($modulos,$datos);
	$adicionales=array_merge($adicionales);
 
 	$cantidad_eliminar=count($quitar);
 	$cantidad_adicionar=count($adicionales);
  
	if($cantidad_eliminar && $accion==1){
 		$sql1="DELETE FROM permiso WHERE funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo IN(".implode(",",$quitar).")";
	 	phpmkr_query($sql1);
 	}
	if($cantidad_adicionar && $accion==1){
		for($i=0;$i<$cantidad_adicionar;$i++){
	 		$sql1="INSERT INTO permiso(funcionario_idfuncionario,modulo_idmodulo,accion,tipo) VALUES(".$idfuncionario.",".$adicionales[$i].",'".$accion."','1')";
			phpmkr_query($sql1);
	 	}
	}
	if($accion==0){
		$cantidad_negar=count($modulos);
		for($i=0;$i<$cantidad_negar;$i++){
	 		$sql1="INSERT INTO permiso(funcionario_idfuncionario,modulo_idmodulo,accion,tipo) VALUES(".$idfuncionario.",".$modulos[$i].",'".$accion."','1')";
			phpmkr_query($sql1);
	 	}
	}
return true;
}
?>
