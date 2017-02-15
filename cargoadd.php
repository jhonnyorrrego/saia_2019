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
<?php

// Initialize common variables
$x_idcargo = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_tipo_cargo = Null;
?>
<?php include ("db.php") ?>
<?php include ("librerias_saia.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
include_once ("pantallas/lib/librerias_cripto.php");
desencriptar_sqli("form_info");
echo(librerias_jquery());
include ("formatos/librerias/estilo_formulario.php");
include ("formatos/librerias/header_formato.php");

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
	$x_idcargo = @$_POST["x_idcargo"];
	$x_nombre = @$_POST["x_nombre"];
  $x_cod_padre = @$_POST["x_cod_padre"];
	$x_tipo_cargo = @$_POST["x_tipo_cargo"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			header("Location: cargolist.php");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			abrir_url("cargo.php","centro");
			exit();
		}
		break;
}

?>
<?php include ("header.php") ?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - nombre"))
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
				cargo : 1,
				nombre :$(this).val()
			},
			success: function(data){
				if(data==1){
					top.noty({
						text: 'Cargo repetido!',
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
<p><span class="internos">ADICIONAR CARGOS</span></p>
<form name="cargoadd" id="cargoadd" action="cargoadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo cargo."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<input type="radio" name="x_tipo_cargo" value="1" checked>Administrativo<br>
			<input type="radio" name="x_tipo_cargo" value="2">Funciones
		</td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">

<?php arbol_cargos("x_cod_padre");
?>

</span></td>
	</tr>
</table>
<p>
<input type="submit" id="guardar" name="Action" value="Adicionar">
</form>
<?php include ("footer.php") ?>
<?php

/*
<Clase>
<Nombre>LoadData
<Parametros>sKey-id del cargo a buscar;conn-objeto de conexion con la base de datos
<Responsabilidades>Verificar si un cargo existe o no en la bd
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LoadData($sKey,$conn)
{global $x_idcargo;
global $x_nombre;
global $x_cod_padre;
global $x_tipo_cargo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM cargo";
	$sSql .= " WHERE idcargo = " . $sKeyWrk;
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
	$i=0;
	while(phpmkr_fetch_array($rs))
	   $i++;
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);

  if ($i == 0)
    {
  		$LoadData = false;
  	}

  else
    {
  		$LoadData = true;
  		$row = phpmkr_fetch_array($rs);

  		// Get the field contents
  		$x_idcargo = $row["idcargo"];
  		$x_nombre = $row["nombre"];
			$x_tipo_cargo = $row["tipo_cargo"];
      $x_cod_padre = $row["cod_padre"];
  	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

/*
<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un cargo nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
global $x_idcargo;
global $x_nombre;
global $x_cod_padre;
global $x_tipo_cargo;
	// Add New Record
	$sSql = "SELECT * FROM cargo A";
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

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;
  	$fieldList["cod_padre"] = $x_cod_padre;
	if($fieldList["cod_padre"] == ''){
		$fieldList["cod_padre"] = "''";
	}
	$fieldList["tipo_cargo"]=$x_tipo_cargo;
	// insert into database
	$strsql = "INSERT INTO cargo (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or error("Falla en la base de datos" . phpmkr_error() . ' SQL:' . $strsql);

	return true;
}
encriptar_sqli("cargoadd",1);
function arbol_cargos($campo)
  {global $conn,$ruta_db_superior;
   ?>
 Buscar:
<input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),1)">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),0,1)">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value))">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>                            <br />
<div id="esperando_<?php echo $campo; ?>">
  <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_<?php echo $campo; ?>" height="90%">
</div>
<input type="hidden" maxlenght="11"  class="required"  name="<?php echo $campo; ?>" id="<?php echo $campo; ?>"   value="" >
<label style="display:none" class="error" for="<?php echo $campo; ?>">Campo obligatorio.
</label>
<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_<?php echo $campo; ?>","100%","100%",0);
                			tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
                			tree_<?php echo $campo; ?>.enableIEImageFix(true);
                      tree_<?php echo $campo; ?>.enableCheckBoxes(1);
                      tree_<?php echo $campo; ?>.enableRadioButtons(true);
                      tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.enableSmartXMLParsing(true);
                      tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior; ?>test_serie.php?tabla=cargo&estado=1");
                	    tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
                      function onNodeSelect_<?php echo $campo; ?>(nodeId)
                      {valor_destino=document.getElementById("<?php echo $campo; ?>");

                       if(tree_<?php echo $campo; ?>.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
   <?php
}
?>
