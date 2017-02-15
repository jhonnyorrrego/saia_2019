<?php include ("db.php");
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
$ewCurSec = 0; // Initialise
				
// Initialize common variables
$x_idpermiso_perfil = Null;
$x_modulo_idmodulo = Null;
$x_modulo = Null;
$x_perfil_idperfil = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;

include ("phpmkrfn.php"); 
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

switch ($sAction)
{
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "ADICION&Oacute; NUEVO REGISTRO CON &Eacute;XITO";
		    abrir_url("permiso_perfiladd.php?key=".$_REQUEST["x_perfil_idperfil"],"_self");
		}
		break;
}
?>
<?php include ("header.php") ?>
<?php include_once("formatos/librerias/header_formato.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<link rel="stylesheet" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	
$().ready(function() {
	// validar los campos del formato
	$('#permiso_perfiladd').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("permiso_perfiladd");?>
			    form.submit();
			    
			  }
	});

 $('#modulo_todos').click(function(){
   todos_check(tree3,'x_modulo_idmodulo')
 });
 $('#modulo_ninguno').click(function(){
    ninguno_check(tree3,'x_modulo_idmodulo')
 });
 
 $("#x_perfil_idperfil").change(function() {
    if($('#x_perfil_idperfil :selected').val()!="")
      {tree3.deleteChildItems(0);
       tree3.loadXML('test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad='+$('#x_perfil_idperfil :selected').val());
      }
 });
  
});
function todos_check(elemento,campo)
{
	
 seleccionados=elemento.getAllLeafs(); 
 nodos=seleccionados.split(",");

 for(i=0;i<nodos.length;i++){
 	elemento.setCheck(nodos[i],true);
 }
   
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






<?php
//include_once($ruta_db_superior."librerias_saia.php"); 

echo(estilo_bootstrap());

?>


<div class="container">
		<h5>ADICIONAR PERMISO PERFIL</h5>
		<br/>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="permiso_perfiladd.php">Adicionar Permiso</a></li>
		     <li><a href="perfiladd.php">Adicionar Perfil</a></li>
		</ul>		
		<br/>

<form name="permiso_perfiladd" id="permiso_perfiladd" action="permiso_perfiladd.php" method="post">
<?php
if(isset($_REQUEST["pantalla"]))
  echo '<input type="hidden" name="pantalla" value="'.$_REQUEST["pantalla"].'">';
?>
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:100%;">
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">		
<?php
 echo "<input type='hidden' name='perfil_seleccionado' id='perfil_seleccionado' value='$sKey'>";
?>
<select name="x_perfil_idperfil" id="x_perfil_idperfil" class="required"><option value="0">Seleccionar...</option>
<?php
$x_perfil_idperfilList = "<label for='x_perfil_idperfil[]' class='error'>Campo obligatorio</label><br />";
$sSqlWrk = "SELECT DISTINCT A.idperfil, A.nombre FROM perfil A" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		if(strtolower($datawrk["nombre"])=="administrador"&&(usuario_actual('login')!="cerok"||usuario_actual('perfil')!=1))continue;
		$x_perfil_idperfilList.='<option value="'.htmlspecialchars($datawrk[0]).'" ';
		if ($datawrk["idperfil"] == $sKey) {
			$x_perfil_idperfilList .= "' selected ";
		}
		$x_perfil_idperfilList.='>'.$datawrk["nombre"].'</option>';
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
echo $x_perfil_idperfilList;
?>
</select>
		</td>
		<!--td bgcolor="#F5F5F5" width="30%" style="text-align:center;font-size:10pt"><b>AYUDA</b></td-->
	</tr>
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MODULO*</span></td>
		<td bgcolor="#F5F5F5">
    <input type="hidden" class="required" name="x_modulo_idmodulo" id="x_modulo_idmodulo"  value="" >
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
    			tree3.loadXML("test_permiso_modulo.php?filtro_perfil=1&entidad=perfil&llave_entidad=<?php echo $sKey; echo $condicion; ?>");
    			tree3.setOnCheckHandler(onNodeSelect);
    			tree3.setOnClickHandler(onNodeSelect2);
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
            
            $("#x_perfil_idperfil").show();
          }
          function onNodeSelect(nodeId)
            {
            	document.getElementById("x_modulo_idmodulo").value=tree3.getAllChecked();
            }
          function onNodeSelect2(nodeId)
            {
            	$.post("ayuda_modulo.php",{idmodulo:nodeId},function(datos){
            		top.noty({text: datos,type: 'alert',layout: "topCenter",timeout:false});
            	});
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
            
            $("#x_perfil_idperfil").hide();
          }
    	-->
    	</script>
  <br /><a href="#" id="modulo_todos">Todos</a>&nbsp;&nbsp;<a href="#" id="modulo_ninguno">Ninguno</a>
  </td>
  <!--td id="mostrar_ayuda" bgcolor="#F5F5F5"></td-->
	</tr>
	<!--tr>
	<td class="encabezado" title="Permite establecer si se quita o se adiciona un permiso a un usuario en la organizaci&oacute;."><span class="phpmaker" style="color: #FFFFFF;">ACCI&Oacute;N *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_accion)) || ($x_accion == "")) { $x_accion = 0;} // Set default value ?>
<input type="radio" checked name="x_accion" id="x_accion_add" value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Asignar";  ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_accion" id="x_accion_del" value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Eliminar"; ?>
</span></td>
  </tr-->
</table>
<p>
<input type="submit" name="Action" value="Adicionar" class='btn btn-primary'>
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
	$sSql = "SELECT * FROM permiso_perfil A";
	$sSql .= " WHERE A.idpermiso_perfil = " . $sKeyWrk;
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$_REQUEST["x_idpermiso_perfil"] = $row["idpermiso_perfil"];
		$_REQUEST["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$_REQUEST["x_perfil_idperfil"] = $row["perfil_idperfil"];
		$_REQUEST["x_caracteristica_propio"] = $row["caracteristica_propio"];
		$_REQUEST["x_caracteristica_grupo"] = $row["caracteristica_grupo"];
		$_REQUEST["x_caracteristica_total"] = $row["caracteristica_total"];
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
	$sSql = "SELECT * FROM permiso_perfil A";
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
 
 $modulos=explode(",",$_REQUEST["x_modulo_idmodulo"]);
 
 $modulo=busca_filtro_tabla("","permiso_perfil A, modulo B","perfil_idperfil=".$_REQUEST["x_perfil_idperfil"]." AND modulo_idmodulo=idmodulo","",$conn);

 $datos=extrae_campo($modulo,'modulo_idmodulo','U');
 /*echo "Mios<br>";
 print_r(($datos));
 echo "<br><br>Escogidos<br>";
 print_r(($modulos));
 echo "<br><br>";*/
 $quitar=array_diff($datos,$modulos);
 /*echo "Quitar modulos<br>";
 print_r($quitar);*/
 $quitar=array_merge($quitar);
 //echo "<br><br>";
 
 $adicionales=array_diff($modulos,$datos);
 /*echo "Adicionar nuevos modulos<br>";
 print_r($adicionales);*/
 $adicionales=array_merge($adicionales);
 //echo "<br><br>";
 
 $cantidad_eliminar=count($quitar);
 $cantidad_adicionar=count($adicionales);
 
 if($cantidad_eliminar){
 	$sql1="DELETE FROM permiso_perfil WHERE perfil_idperfil=".$_REQUEST["x_perfil_idperfil"]." AND modulo_idmodulo IN(".implode(",",$quitar).")";
	 phpmkr_query($sql1);
	 //die($sql1);
 }
 if($cantidad_adicionar){
 	for($i=0;$i<$cantidad_adicionar;$i++){
 		$sql1="INSERT INTO permiso_perfil (perfil_idperfil,caracteristica_propio,modulo_idmodulo) VALUES(".$_REQUEST["x_perfil_idperfil"].",'l,e,m,a',".$adicionales[$i].")";
		phpmkr_query($sql1);
	 	//echo $sql1;
		//echo "<br><br>";
 	}
 }
 //die();
 	
return true;
}
?>
