<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/expediente/librerias.php");

// Initialize common variables
$x_idserie = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_dias_entrega = Null;
$x_codigo = Null;
$x_retencion_gestion = Null;
$x_retencion_central = Null;
$x_conservacion = Null;
$x_seleccion = Null;
$x_otro = Null;
$x_procedimiento = Null;
$x_digitalizacion = Null;
$x_copia = Null;
$x_estado = Null;
$x_categoria = Null;
$x_tipo = Null;
//$x_formato =  Null;
?>

<?php include ("phpmkrfn.php");
include ("librerias_saia.php");
echo(librerias_jquery()); 
?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idserie = @$_POST["x_idserie"];
	$x_nombre = @$_POST["x_nombre"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_dias_entrega = @$_POST["x_dias_entrega"];
	$x_codigo = @$_POST["x_codigo"];
	$x_retencion_gestion = @$_POST["x_retencion_gestion"];
	$x_retencion_central = @$_POST["x_retencion_central"];
	$x_conservacion = @$_POST["x_conservacion"];
	$x_seleccion = @$_POST["x_seleccion"];
	$x_otro = @$_POST["x_otro"];
	$x_procedimiento = @$_POST["x_procedimiento"];
	$x_digitalizacion = @$_POST["x_digitalizacion"];
	$x_copia = @$_POST["x_copia"];
	$x_estado = @$_POST["x_estado"]; 
  $x_categoria = @$_POST["x_categoria"];
	$x_tipo = @$_POST["x_tipo"];
  //$x_formato= @$_POST["x_formato"];
 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: serielistdep.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;			
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey, $conn)) { // Update Record based on key
        		abrir_url("arbolserie.php","arbol");
            abrir_url("serieview.php?key=".$sKey,"_self");
						exit();
        }
        break;
}
?>
<?php include ("header.php") ?>
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor llenar campo requerido - nombre"))
		return false;
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "RADIO", "Por favor llenar campo requerido - tipo"))
		return false; 
}
if (EW_this.x_cod_padre && !EW_checkinteger(EW_this.x_cod_padre.value)) {
	if (!EW_onError(EW_this, EW_this.x_cod_padre, "TEXT", "Por favor llenar campo requerido - cod padre"))
		return false; 
}
if (EW_this.x_dias_entrega && !EW_hasValue(EW_this.x_dias_entrega, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor llenar campo requerido - dias entrega"))
		return false;
}
if (EW_this.x_dias_entrega && !EW_checkinteger(EW_this.x_dias_entrega.value)) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor llenar campo requerido - dias entrega"))
		return false; 
}
if (EW_this.x_retencion_gestion && !EW_checkinteger(EW_this.x_retencion_gestion.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_gestion, "TEXT", "Por favor llenar campo requerido - retencion gestion"))
		return false; 
}
if (EW_this.x_retencion_central && !EW_checkinteger(EW_this.x_retencion_central.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_central, "TEXT", "Por favor llenar campo requerido - retencion central"))
		return false; 
}
if (EW_this.x_seleccion && !EW_checkinteger(EW_this.x_seleccion.value)) {
	if (!EW_onError(EW_this, EW_this.x_seleccion, "TEXT", "Por favor llenar campo requerido - seleccion"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;EDITAR SERIES DOCUMENTALES<br><br><!--a href="serielistdep.php">Regresar al listado</a--></span>
<form name="serieedit" id="serieedit" action="serieedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
</p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE LA SERIE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idserie; ?><input type="hidden" name="x_idserie" value="<?php echo $x_idserie; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"  title="Categoria a la cual pertenece" >CATEGORIA
		</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <!--input type='radio' name='x_categoria' value='1' id='cat1' <?php if($x_categoria==1) echo "checked"; ?> >
    <label for='cat1'>Comunicaciones oficiales</label-->
    <input type='radio' name='x_categoria' value='2' id='cat2' <?php if($x_categoria==2) echo "checked"; ?>>
    <label for='cat2'>Produccion Documental</label>
    <input type='radio' name='x_categoria' value='3' id='cat3' <?php if($x_categoria==3) echo "checked"; ?> >
    <label for='cat3'>Otras categorias</label>
  </span>
    </td>
	</tr>
	<script>
	$(document).ready(function(){
		/*$("#cat2").click(function(){
			$(".ocultar").each(function(){
				$(this).show();
			});
		});
		$("#cat3").click(function(){
			$(".ocultar").each(function(){
				$(this).hide();
			});
		});*/
		
		<?php if($x_categoria==3){ ?>
			$("#cat3").click();
		<?php } ?>
		
		
	});
	</script>
	<script>
	
	function filtrar_arbol_series(){
		    tree2.deleteItem('3-categoria-Otras categorias');
		    tree2.deleteItem('1-categoria-Comunicaciones Oficiales');
		    tree2.deleteItem('2-categoria-Produccion Documental');	
		    $('[name="x_cod_padre"]').val('');
		    var tipo=$('input:radio[name=x_tipo]:checked').val();
		    var filtrar_arbol='';		    
		    switch(parseInt(tipo)){
		        case 1:
		            
		            break;
		        case 2:
		            filtrar_arbol="&filtrar_arbol=series";
		            tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
		            break;
		        case 3:
		            filtrar_arbol="&filtrar_arbol=documental";
		            tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
		            break;
		    }	    
	}
	
	$(document).ready(function(){
	    
	    
	    
	    $('[name="x_tipo"]').click(function(){
	        $('#nombre_padre_muestra').remove();
		    filtrar_arbol_series();
	    });
	    
	    
		$("#cat2").click(function(){
            $('#x_tipo1').attr('disabled',false);
        	$('#x_tipo2').attr('disabled',false);	
        	$('#x_tipo3').attr('disabled',false);
		    $('#nombre_padre_muestra').remove();
		    $('#x_cod_padre').val('');
		    filtrar_arbol_series();
			$(".ocultar").each(function(){
				$(this).show();
			});
		});
		$("#cat3").click(function(){
		    $('#x_cod_padre').val('');
		    $('#nombre_padre_muestra').remove();
            $('#x_tipo1').attr('disabled',false);
        	$('#x_tipo2').attr('disabled',false);	
        	$('#x_tipo3').attr('disabled',false);		    
		    tree2.deleteItem('3-categoria-Otras categorias');
		    tree2.deleteItem('1-categoria-Comunicaciones Oficiales');
		    tree2.deleteItem('2-categoria-Produccion Documental');	
		    tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=3");
			$(".ocultar").each(function(){
				$(this).hide();
			});
		});
	});
	</script>	
	
	<tr class="ocultar">
		<td class="encabezado"  title="Definir el tipo de serie que se esta creando" style="text-align: left; background-color:#57B0DE; color: #ffffff;">TIPO *</td>
		<td bgcolor="#F5F5F5">
			<input type="radio" name="x_tipo"<?php if(@$x_tipo=="1")echo " checked"; ?> value="1">Serie<br>
			<input type="radio" name="x_tipo"<?php if(@$x_tipo=="2")echo " checked"; ?> value="2">Subserie<br>
			<input type="radio" name="x_tipo"<?php if(@$x_tipo=="3")echo " checked"; ?> value="3">Tipo documental<br>
		</td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de la serie"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo $x_nombre ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de la serie a la cual pertenece"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">



<script type="text/javascript" src="ew.js"></script>
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">

			
		<br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="buscar_nodo();"> <img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))" id="siguiente_nodo"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
                          </span>
			  <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2" width="100px" height="100px"></div>
				<input type="hidden" class="required"  name="x_cod_padre" id="x_cod_padre" value="<?php echo $x_cod_padre; ?>">
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
      
      tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","70%",0);
      tree2.setImagePath("imgs/");
      tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
      tree2.enableIEImageFix(true);
      //tree2.setXMLAutoLoadingBehaviour("id");
    //tree2.setOnClickHandler(onNodeSelect);
      tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
     
     
     /* tree2.setXMLAutoLoading("test_serie.php?tabla=serie&admin=1&arbol_series=1");
      tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1");*/
      
      
      var filtrar_arbol='&filtrar_arbol=documental';
      tree2.setXMLAutoLoading("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2&solo_series=1"+filtrar_arbol);
      tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
      
      
	  tree2.setOnCheckHandler(onNodeSelect_tree2);
	  
      function onNodeSelect_tree2(nodeId){
      	valor_destino=document.getElementById("x_cod_padre");
        if(tree2.isItemChecked(nodeId))
         {if(valor_destino.value!=="")
          tree2.setCheck(valor_destino.value,false);
          if(nodeId.indexOf("_")!=-1)
             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
          valor_destino.value=nodeId;
         }
       else
         {valor_destino.value="";
         }
      }
      function fin_cargando_serie() {
      	if (browserType == "gecko" )
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else if (browserType == "ie")
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else
      		document.poppedLayer = eval('document.layers["esperando_serie"]');
      	document.poppedLayer.style.display = "none";
      	
      	tree2.setCheck('<?php echo $x_cod_padre; ?>',true); //chequea el cod_padre
      	
      }
      
      function cargando_serie() {
      	if (browserType == "gecko" )
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else if (browserType == "ie")
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else
      		document.poppedLayer = eval('document.layers["esperando_serie"]');
      	document.poppedLayer.style.display = "";
       }
       function buscar_nodo(){
       	$.ajax({
       		type:'POST',
       		url: "buscar_test_serie.php",
       		dataType:"json",
       		data: {
       			nombre: $('#stext_serie_idserie').val(),
       			 tabla: "serie"
       		},
       		success: function(data){
       			$.each(data, function(i, item) {
       				$.each(item, function(j, value) {
       					tree2.openItem(value);
       					if(j==item.length-1){
       						tree2.selectItem(value);
       						tree2.focusItem(value);
       					}
       				});
       			});
			}
		});
		tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value));
       }
--> 		
	</script>
	







</span></td>
	</tr>
  <tr class="ocultar">
		<td class="encabezado" title="Cantidad de d&iacute;as para dar tr&aacute;mite y respuesta al documento"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_dias_entrega" id="x_dias_entrega" size="30" value="<?php echo htmlspecialchars(@$x_dias_entrega) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="C&oacute;odigo de la serie"><span class="phpmaker" style="color: #FFFFFF;">CODIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a�os que permanece la serie en el archivo de gesti&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_retencion_gestion" id="x_retencion_gestion" size="30" value="<?php echo htmlspecialchars(@$x_retencion_gestion) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a�os que permanece la serie en el archivo central"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_retencion_central" id="x_retencion_central" size="30" value="<?php echo htmlspecialchars(@$x_retencion_central) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="El documento al pasarse al archivo central ser&aacute; conservado o eliminado?"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_conservacion"<?php if (@$x_conservacion == "TOTAL") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TOTAL"); ?>">
<?php echo "Conservaci&oacute;n total"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_conservacion"<?php if (@$x_conservacion == "ELIMINACION") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ELIMINACION"); ?>">
<?php echo "Eliminaci&oacute;n"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="El documento al pasarse al archivo central ser&aacute, digitalizado?"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_digitalizacion"<?php if (@$x_digitalizacion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Si"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_digitalizacion"<?php if (@$x_digitalizacion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "No"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_seleccion"<?php if (@$x_seleccion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_seleccion"<?php if (@$x_seleccion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado"  title="Si va a hacerse algo diferente a Conservar, Eliminar o Seleccionar el documento"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_otro" id="x_otro" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_otro) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado"  title="Describir el procedimiento de conservaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_procedimiento" name="x_procedimiento"><?php echo @$x_procedimiento; ?></textarea>
</span></td>
	</tr>
  <tr class="ocultar">
		<td class="encabezado"  title="Decidir si se perminte copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" name="x_copia"<?php if (@$x_copia == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_copia"<?php if (@$x_copia == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>	
	  <tr>
		<td class="encabezado"  title="Inactivar o activar una serie documental"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>	
</table>
<p>
<input type="submit" name="Action" value="EDITAR">
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
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE A.idserie = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;	
		// Get the field contents
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_dias_entrega"] = $row["dias_entrega"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_retencion_gestion"] = $row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = $row["retencion_central"];
		$GLOBALS["x_conservacion"] = $row["conservacion"];
		$GLOBALS["x_seleccion"] = $row["seleccion"];
		$GLOBALS["x_otro"] = $row["otro"];
		$GLOBALS["x_procedimiento"] = $row["procedimiento"];
		$GLOBALS["x_digitalizacion"] = $row["digitalizacion"];
		$GLOBALS["x_copia"] = $row["copia"];
		$GLOBALS["x_estado"] = $row["estado"]; 
    $GLOBALS["x_categoria"] = $row["categoria"];
		$GLOBALS["x_tipo"] = $row["tipo"];
    //$GLOBALS["x_formato"] = $row["formato"];
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
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE A.idserie = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
		$fieldList["cod_padre"] = $theValue;
		
		$theValue = ($GLOBALS["x_dias_entrega"] != "") ? intval($GLOBALS["x_dias_entrega"]) : "NULL";
		$fieldList["dias_entrega"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["codigo"] = $theValue;
		$theValue = ($GLOBALS["x_retencion_gestion"] != "") ? intval($GLOBALS["x_retencion_gestion"]) : "NULL";
		$fieldList["retencion_gestion"] = $theValue;
		$theValue = ($GLOBALS["x_retencion_central"] != "") ? intval($GLOBALS["x_retencion_central"]) : "NULL";
		$fieldList["retencion_central"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["conservacion"] = $theValue;
		$theValue = ($GLOBALS["x_seleccion"] != "") ? intval($GLOBALS["x_seleccion"]) : "NULL";
		$fieldList["seleccion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["otro"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["procedimiento"] = $theValue;
		$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
		$fieldList["digitalizacion"] = $theValue;
		$theValue = ($GLOBALS["x_copia"] != "") ? intval($GLOBALS["x_copia"]) : "NULL";
		$fieldList["copia"] = $theValue;
		$theValue = ($GLOBALS["x_estado"] != "") ? intval($GLOBALS["x_estado"]) : "NULL";
		$fieldList["estado"] = $theValue;
     $theValue = ($GLOBALS["x_categoria"] != "") ? intval($GLOBALS["x_categoria"]) : "NULL";
		$fieldList["categoria"] = $theValue;
		//die("categoria ".$fieldList["categoria"]);
		// update
		$fieldList["tipo"]="'".$GLOBALS["x_tipo"]."'";
		$sSql = "UPDATE serie SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idserie =". $sKeyWrk;
    //die($sSql);		
		phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		insertar_expediente_automatico($sKeyWrk);
		if(!$fieldList["estado"])
		  phpmkr_query("update serie set estado=0 where cod_padre=".$sKeyWrk);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
<script>
$(document).ready(function(){
	tree2.setOnCheckHandler(cargar_datos_padre);	
});
function cargar_datos_padre(){
		<?php 
		if(@$_REQUEST['key_padre']){
			echo("$('#nombre_padre_muestra').html('');");
		}	
		?>		
	
	$.ajax({ 
		type:"POST",
		dataType:"json",
		url: "buscar_datos_serie.php",
		data: {
			idserie:$('#x_cod_padre').val()
		},
		success: function(datos){
						
			$('#x_dias_entrega').val(datos.dias_entrega);
			$('#x_codigo').val(datos.codigo);
			$('#x_retencion_gestion').val(datos.retencion_gestion);
			$('#x_retencion_central').val(datos.retencion_central);
			$('#x_conservacion'+datos.conservacion).attr('checked',true);
			$('#x_seleccion'+datos.seleccion).attr('checked',true);
			$('#x_digitalizacion'+datos.digitalizacion).attr('checked',true);	
			$('#x_otro').val(datos.otro);	
			$('#x_procedimiento').text(datos.procedimiento);	
			$('#x_copia'+datos.copia).attr('checked',true);	
			
		}
	}); 	
}
</script>