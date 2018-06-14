<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include ($ruta_db_superior . "header.php");
include ($ruta_db_superior . "phpmkrfn.php");
//include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones.php");
echo(librerias_arboles());
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;

//$validar_enteros = array("idformato");
//desencriptar_sqli('form_info');

//TODO: Validar SQLi en estas pantallas
$sKey = @$_GET["key"];
$idformato = @$_REQUEST["idformato"];
if (($sKey == "") || (is_null($sKey))) {
	$sKey = @$_POST["key"];
}
if (!empty($sKey))
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";
} else {
	// Get fields from form
	$x_idfuncion_formato = @$_POST["x_idfunciones_formato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_descripcion = @$_POST["x_descripcion"];
	$x_ruta = @$_POST["x_ruta"];
	$x_formato = @$_POST["x_formato"];
	$x_acciones = @$_POST["x_acciones"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	if ($idformato)
		redirecciona("funciones_formatolist.php?idformato=" . $idformato);
	redirecciona("funciones_formatolist.php");
}

switch ($sAction) {
	case "I" :
		// Get a record to display
		if (!LoadData($sKey, $conn)) {// Load Record based on key
			//phpmkr_db_close($conn);
			if ($idformato)
				redirecciona("funciones_formatolist.php?idformato=" . $idformato);
			redirecciona("funciones_formatolist.php");
		}
		break;
	case "U" :
		if (EditData($sKey, $conn)) {// Update Record based on key
			alerta("Actualizacion exitosa");
			if (isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"] == "tiny")
				redirecciona("../tinymce34/jscripts/tiny_mce/plugins/formatos/formatos.php?formato=" . $idformato . "&tipo=funciones_formato");
			else if ($idformato)
				redirecciona("funciones_formatolist.php?idformato=" . $idformato);
			else
				redirecciona("funciones_formatolist.php");
		}
		break;
}
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

function EW_checkMyForm(EW_this) {
var lformatos='';
if(typeof(tree2) != 'undefined'){
    var formatos = tree2.getAllChecked();
    var formatos_tmp = formatos.split(",");
    for(i=0; i<formatos_tmp.length; i++){
    	if(formatos_tmp[i]!=""){
          var temp=formatos_tmp[i].split("#");
	      if(lformatos=="")
	        lformatos = temp[0];
	      else
	        lformatos += ","+temp[0];
      }
    }
}
$("#x_formato").val(lformatos);
if (EW_this.x_formato && !EW_hasValue(EW_this.x_formato, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_formato, "TEXT", "Please enter required field - La funcion  debe estar vinculado a un formato ;"))
		return false;
}
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Please enter required field - Nombre de la funci&oacute;"))
		return false;
}
if (EW_this.x_etiqueta && !EW_hasValue(EW_this.x_etiqueta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_etiqueta, "TEXT", "Please enter required field - Nombre a mostrar"))
		return false;
}
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "Please enter required field - Descripci&oacute;n"))
		return false;
}
if (EW_this.x_ruta && !EW_hasValue(EW_this.x_ruta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_ruta, "TEXT", "Please enter required field - Ubicada en Archivo"))
		return false;
}

if (EW_this.x_acciones && !EW_hasValue(EW_this.x_acciones, "CHECKBOX" )) {
	if (!EW_onError(EW_this, EW_this.x_acciones, "CHECKBOX", "Please enter required field - acciones"))
		return false;
}
return true;
}

//-->
</script>
<p><br />
<a class="btn btn-mini btn-default" href="funciones_formatolist.php?idformato=<?php echo $idformato; ?>">Regresar</a>
</p>
<form name="funciones_formatoedit" id="funciones_formatoedit" action="funciones_formatoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<?php
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
   echo '<input type="hidden" name="pantalla" value="tiny">';
?>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<input type="hidden" name="idformato" value="<?php echo ($idformato); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre de la funci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre a mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Descripci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_descripcion" id="x_descripcion" value="<?php echo htmlspecialchars(@$x_descripcion) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$formatos=busca_filtro_tabla("A.etiqueta,A.idformato,A.nombre,C.ruta,C.etiqueta AS etiqueta_funcion,B.funciones_formato_fk","formato A, funciones_formato_enlace B,funciones_formato C","A.idformato=B.formato_idformato AND B.funciones_formato_fk=C.idfunciones_formato AND funciones_formato_fk=".$sKey."","GROUP BY A.idformato HAVING min(B.funciones_formato_fk)=B.funciones_formato_fk ORDER BY B.idfunciones_formato_enlace ASC",$conn);
// si el archivo existe dentro de la carpeta formatos
$ruta_final=$formatos[0]["nombre"] . "/" . $formatos[0]["ruta"];
if (is_file($ruta_db_superior . FORMATOS_CLIENTE . $formatos[0]["nombre"] . "/" . $formatos[0]["ruta"])) {
	$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA ."/". FORMATOS_CLIENTE . $formatos[0]["nombre"]);
} elseif (is_file($ruta_db_superior . $formatos[0]["ruta"])) {
	// si el archivo existe en la ruta especificada partiendo de la raiz
	$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA."/" );
} else {
	$ruta_formato = 'Error: ' . $formatos[0]["ruta"] . "|id=" . $formatos[0]["idfunciones_formato"];
}
echo($ruta_formato."/");
?>
<input type="text" name="x_ruta" id="x_ruta" value="<?php echo htmlspecialchars(@$x_ruta) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Listado de Formatos</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$formatos=busca_filtro_tabla("A.idformato","formato A, funciones_formato_enlace B","A.idformato=B.formato_idformato AND funciones_formato_fk=".$sKey."","B.idfunciones_formato_enlace ASC",$conn);
$x_formato=extrae_campo($formatos,"idformato","U");
?>
<span style="font-family: Verdana; font-size: 9px;">FORMATOS:&nbsp;<br><br></span>
<div id="esperando_arbol">
	<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_tree2"></div>
<input type="hidden" name="x_formato" id="x_formato" value="<?php echo(implode(",",$x_formato))?>">
<script type="text/javascript">		
	var browserType;
	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
	   browserType= "gecko"
			}
	tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
	tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
	tree2.enableIEImageFix(true);
	tree2.enableCheckBoxes(1);
	tree2.setOnClickHandler(onNodeSelect);
	tree2.setOnLoadingStart(cargando_arbol);
    tree2.setOnLoadingEnd(fin_cargando_arbol);
	tree2.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_formatos.php?seleccionados=<?php implode(",",$x_formato);?>");
	tree2.loadXML("<?php echo($ruta_db_superior);?>test_formatos.php?seleccionados=<?php echo(implode(",",$x_formato)); ?>"); 	
	function onNodeSelect(nodeId){
		console.log(tree2.getAllChecked());
      $("#x_formato").val(tree2.getAllChecked());  
		}
	function fin_cargando_arbol() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_arbol")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_arbol")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_arbol"]');
        document.poppedLayer.style.visibility = "hidden";
	}

      function cargando_arbol() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_arbol")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_arbol")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_arbol"]');
        document.poppedLayer.style.visibility = "visible";
}


     /* $(document).ready(function(){ 
    		if(!$("#form_info").length){
    			$("#funciones_formatoedit").append('<input type="hidden" id="form_info" name="form_info">');
    		}
    	$("#funciones_formatoedit").submit(function(event){
    		
    		if($(".tiny_formatos").length){
    			
    			$.each( ".tiny_formatos", function() {
    				var id_textarea=$(this).attr("id");
    				var contenido_textarea=tinyMCE.get(id_textarea).getContent(); 
    				$("#"+id_textarea).val(contenido_textarea);
    			});
    			
    		}
    		
    		salida_sqli = false;
    	      $.ajax({
    	        type:"POST",
    	        async: false,
    	        url: "../formatos/librerias/encript_data.php",
    	        data: {datos:JSON.stringify($("#funciones_formatoedit").serializeArray())},
    	        success: function(data) {
    						//$("#funciones_formatoedit")[0].reset();
    		
    				$("#funciones_formatoedit").find("input:hidden,input:text, input:password, select, textarea").val("");
    	    		$("#funciones_formatoedit").find("input:radio, input:checkbox").removeAttr("checked").removeAttr("selected");
    						
    	          $("#form_info").val(data);
    	          salida_sqli = true;
    	        }
    	      });return salida_sqli;
    				event.preventDefault();
    		  });
    		
    		});*/
</script>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_acciones = explode(",",@$x_acciones);
$x_accionesChk = "";
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "a") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Adicionar" . EditOptionSeparator(0);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("m"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "m") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Mostrar" . EditOptionSeparator(1);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "e") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Editar" . EditOptionSeparator(2);
echo $x_accionesChk;
?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="EDITAR">
</form>
<?php
//encriptar_sqli("funciones_formatoedit",1,"form_info",$ruta_db_superior);
function LoadData($sKey,$conn){
  global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
	$sSql = "SELECT * FROM funciones_formato WHERE idfunciones_formato = " . $sKey;
	$rs = phpmkr_query($sSql) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$row = phpmkr_fetch_array($rs);
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_acciones = $row["acciones"];
		
		$x_formato = array();
		$idform_enlace=busca_filtro_tabla("formato_idformato","funciones_formato_enlace","funciones_formato_fk=".$sKey,"",$conn);
		if($idform_enlace["numcampos"]){
			$x_formato=extrae_campo($idform_enlace,"formato_idformato");
		}
		$LoadData = true;
	}
	phpmkr_free_result($rs);
	return $LoadData;
}

function EditData($sKey,$conn) {
  global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
	$formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $_REQUEST["idformato"], "", $conn);
	$funciones_formato = busca_filtro_tabla("idfunciones_formato", "funciones_formato", "idfunciones_formato=" . $sKey, "", $conn);
	if ($funciones_formato["numcampos"] == 0) {
		$EditData = false;
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["etiqueta"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["descripcion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta) : $x_ruta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta"] = $theValue;
		$theValue = implode(",", $x_acciones);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["acciones"] = $theValue;
        
		$sSql = "UPDATE funciones_formato SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idfunciones_formato =" . $sKey;
		guardar_traza($sSql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sSql) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		if($x_formato){
			$delete="DELETE FROM funciones_formato_enlace WHERE funciones_formato_fk=".$sKey." AND formato_idformato not in (".$x_formato.")";
			guardar_traza($delete, $formato[0]["nombre_tabla"]);
			phpmkr_query($delete) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $delete);
			
			$funciones_enlace=busca_filtro_tabla("formato_idformato","funciones_formato_enlace","funciones_formato_fk=".$sKey,"",$conn);
			if ($funciones_enlace["numcampos"]) {
				$idform_enlace=extrae_campo($funciones_enlace,"formato_idformato");
				$lformato=explode(",",$x_formato);
				foreach ($lformato as $idform) {
					if(!in_array($idform, $idform_enlace)){
						$insert="INSERT INTO funciones_formato_enlace (funciones_formato_fk,formato_idformato) VALUES (".$sKey.",".$idform.")";
						guardar_traza($insert, $formato[0]["nombre_tabla"]);
						phpmkr_query($insert) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $insert);
					}
				}
			}
		}else{
			$delete="DELETE FROM funciones_formato_enlace WHERE funciones_formato_fk=".$sKey;
			guardar_traza($delete, $formato[0]["nombre_tabla"]);
			phpmkr_query($delete) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $delete);
			
			$delete_f="DELETE FROM funciones_formato WHERE idfunciones_formato=".$sKey;
			guardar_traza($delete_f, $formato[0]["nombre_tabla"]);
			phpmkr_query($delete_f) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $delete_f);
		}
		$EditData = true;
	}
	return $EditData;
}
?>