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
$x_categoria = Null;
$x_tipo = Null;
//$x_formato =  Null;




?>
<?php include ("phpmkrfn.php") ;

	include ("librerias_saia.php");		
echo(librerias_jquery()); 
?>
<?php

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
  $x_categoria = @$_POST["x_categoria"];
	$x_tipo = @$_POST["x_tipo"];
  //$x_formato= @$_POST["x_formato"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro " . $sKey." No encontrado";		
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
	case "A": // Add
		$ok=AddData($conn);
        if($ok){ // Add New Record
        	abrir_url("arbolserie.php","arbol");
					abrir_url("serieview.php?key=".$ok,"_self");
					exit();
				}
				break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
		<script type="text/javascript" src="js/dhtmlXCommon.js"></script>		
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese el campo requerido - Nombre"))
		return false;
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "RADIO", "Por favor llenar campo requerido - tipo"))
		return false; 
}
if (EW_this.x_cod_padre && !EW_checkinteger(EW_this.x_cod_padre.value)) {
	if (!EW_onError(EW_this, EW_this.x_cod_padre, "TEXT", "Por favor ingrese el campo requerido - cod padre"))
		return false; 
}

if (EW_this.x_dias_entrega && !EW_hasValue(EW_this.x_dias_entrega, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor ingrese el campo requerido - D&iacute;as entrega"))
		return false;
}
if (EW_this.x_dias_entrega && !EW_checkinteger(EW_this.x_dias_entrega.value)) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor ingrese el campo requerido - D&iacute;as entrega"))
		return false; 
}
if (EW_this.x_retencion_gestion && !EW_checkinteger(EW_this.x_retencion_gestion.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_gestion, "TEXT", "Por favor ingrese el campo requerido - Retenci&oacute;n gesti&oacute;n"))
		return false; 
}
if (EW_this.x_retencion_central && !EW_checkinteger(EW_this.x_retencion_central.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_central, "TEXT", "Por favor ingrese el campo requerido - Retenci&oacute;n central"))
		return false; 
}
if (EW_this.x_seleccion && !EW_checkinteger(EW_this.x_seleccion.value)) {
	if (!EW_onError(EW_this, EW_this.x_seleccion, "TEXT", "Por favor ingrese el campo requerido - Selecci&oacute;n"))
		return false; 
}
return true;
}

//-->
</script>



<?php 

if(@$_REQUEST['key_padre']){
	
	$serie_padre=busca_filtro_tabla('','serie','idserie='.$_REQUEST['key_padre'],'',$conn);
	
	
	$x_idserie = @$serie_padre[0]["idserie"];
	$x_nombre_padre = @$serie_padre[0]["nombre"];
	$x_cod_padre = @$serie_padre[0]["cod_padre"];
	$x_dias_entrega = @$serie_padre[0]["dias_entrega"];
	$x_codigo = @$serie_padre[0]["codigo"];
	$x_retencion_gestion = @$serie_padre[0]["retencion_gestion"];
	$x_retencion_central = @$serie_padre[0]["retencion_central"];
	$x_conservacion = @$serie_padre[0]["conservacion"];
	$x_seleccion = @$serie_padre[0]["seleccion"];
	$x_otro = @$serie_padre[0]["otro"];
	$x_procedimiento = @$serie_padre[0]["procedimiento"];
	$x_digitalizacion = @$serie_padre[0]["digitalizacion"];
	$x_copia = @$serie_padre[0]["copia"];
    $x_categoria = @$serie_padre[0]["categoria"];
	$x_tipo = @$serie_padre[0]["tipo"];
?>
<script>
$(document).ready(function(){
	$('#cat<?php echo($x_categoria); ?>').attr('checked',true);
	var check=0;
	var tipo=parseInt('<?php echo($x_tipo); ?>');
	switch(tipo){
		case 1:
			check=2;
			break;
		case 2:
			check=3;
			break;		
		case 3:
			check=3;
			break;				
	}
	$('#x_tipo'+check).attr('checked',true);
	
});
</script>
<?php
}
?>


<p><span class="internos">&nbsp;&nbsp;ADICIONAR SERIES DOCUMENTALES<br><br><!--a href="serielistdep.php">Regresar al listado</a--></span></p>
<form name="serieadd" id="serieadd" action="serieadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"  title="Categoria a la cual pertenece" >CATEGORIA
		</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <!--input type='radio' name='x_categoria' value='1' id='cat1'  >
    <label for='cat1'>Comunicaciones oficiales</label-->
    <input type='radio' name='x_categoria' value='2' id='cat2' checked>
    <label for='cat2'>Produccion Documental</label>
    <input type='radio' name='x_categoria' value='3' id='cat3' >
    <label for='cat3'>Otras categorias</label>
  </span>
    </td>
	</tr>
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
		            filtrar_arbol="";
		            tree2.loadXML("test_serie.php?tabla=serie&admin=1&sin_padre=1&categoria=2"+filtrar_arbol);
		            break;
		    }	    
	}
	
	$(document).ready(function(){
	    $('[name="x_tipo"]').click(function(){
		    filtrar_arbol_series();
	    });
	    
	    
		$("#cat2").click(function(){
		    filtrar_arbol_series();
			$(".ocultar").each(function(){
				$(this).show();
			});
		});
		$("#cat3").click(function(){
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
		<td class="encabezado" title="Definir el tipo de serie que se esta creando" style="text-align: left; background-color:#57B0DE; color: #ffffff;">TIPO *</td>
		<td bgcolor="#F5F5F5">
			<input type="radio" name="x_tipo" id="x_tipo1" value="1">Serie<br>
			<input type="radio" name="x_tipo" id="x_tipo2" value="2">Subserie<br>
			<input type="radio" name="x_tipo" id="x_tipo3" value="3" checked>Tipo documental<br>
		</td>
	</tr>		
	<tr>
		<td class="encabezado" title="Nombre de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de la serie a la cual pertenece"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php 

		if(@$_REQUEST['key_padre']){
			echo('<div id="nombre_padre_muestra"><b>Padre: </b>'.$x_nombre_padre.'<br/></div>');
		}	
		?>	
			
			
		<br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="buscar_nodo();"> <img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))" id="siguiente_nodo"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
                          </span>
			  <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2" width="100px" height="100px"></div>
				<input type="hidden" class="required"  name="x_cod_padre" id="x_cod_padre" value="<?php echo($x_idserie); ?>">
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
      tree2.setXMLAutoLoading("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2&solo_series=1&filtrar_arbol=subseries");
      tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2&filtrar_arbol=subseries");
      
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
<?php if (!(!is_null($x_dias_entrega)) || ($x_dias_entrega == "")) { $x_dias_entrega = 8;} // Set default value ?>
<input type="text" name="x_dias_entrega" id="x_dias_entrega" size="30" value="<?php echo htmlspecialchars(@$x_dias_entrega) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="C&oacute;digo de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo de gesti&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_gestion)) || ($x_retencion_gestion == "")) { $x_retencion_gestion = 3;} // Set default value ?>
<input type="text" name="x_retencion_gestion" id="x_retencion_gestion" size="30" value="<?php echo htmlspecialchars(@$x_retencion_gestion) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo central"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_central)) || ($x_retencion_central == "")) { $x_retencion_central = 5;} // Set default value ?>
<input type="text" name="x_retencion_central" id="x_retencion_central" size="30" value="<?php echo htmlspecialchars(@$x_retencion_central) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute; conservado o eliminado?"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_conservacionTOTAL" name="x_conservacion"<?php if (@$x_conservacion == "TOTAL") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TOTAL"); ?>">
<?php echo "Conservaci&oacute;n total"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_conservacionELIMINACION" name="x_conservacion"<?php if (@$x_conservacion == "ELIMINACION") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ELIMINACION"); ?>">
<?php echo "Eliminaci&oacute;n"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
	<td class="encabezado" title="�El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_seleccion1" name="x_seleccion"<?php if (@$x_seleccion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio"  id="x_seleccion0" name="x_seleccion"<?php if (@$x_seleccion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
		<tr class="ocultar">
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute digitalizado?"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_digitalizacion1" name="x_digitalizacion"<?php if (@$x_digitalizacion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Si"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_digitalizacion0" name="x_digitalizacion"<?php if (@$x_digitalizacion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "No"; ?>
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
		<td class="encabezado"  title="Decidir si se permite copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" id="x_copia1" name="x_copia"<?php if (@$x_copia == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_copia0" name="x_copia" checked value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		//$GLOBALS["x_formato"] = $row["formato"];
		$GLOBALS["x_dias_entrega"] = $row["dias_entrega"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_retencion_gestion"] = $row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = $row["retencion_central"];
		$GLOBALS["x_conservacion"] = $row["conservacion"];
		$GLOBALS["x_seleccion"] = $row["seleccion"];
		$GLOBALS["x_otro"] = $row["otro"];
		$GLOBALS["x_procedimiento"] = $row["procedimiento"];
		$GLOBALS["x_digitalizacion"] = $row["digitalizacion"];  
		$GLOBALS["x_tipo"] = $row["tipo"];
    //$GLOBALS["x_categoria"] = $row["categoria"];
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
	$sSql = "SELECT * FROM serie A";
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
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field cod_padre
	$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
	$fieldList["cod_padre"] = $theValue;
	
	// Field formato
	// Field conservacion

	// Field dias_entrega
	$theValue = ($GLOBALS["x_dias_entrega"] != "") ? intval($GLOBALS["x_dias_entrega"]) : "NULL";
	$fieldList["dias_entrega"] = $theValue;

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	// Field retencion_gestion
	$theValue = ($GLOBALS["x_retencion_gestion"] != "") ? intval($GLOBALS["x_retencion_gestion"]) : "NULL";
	$fieldList["retencion_gestion"] = $theValue;

	// Field retencion_central
	$theValue = ($GLOBALS["x_retencion_central"] != "") ? intval($GLOBALS["x_retencion_central"]) : "NULL";
	$fieldList["retencion_central"] = $theValue;

	// Field conservacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["conservacion"] = $theValue;

	// Field seleccion
	$theValue = ($GLOBALS["x_seleccion"] != "") ? intval($GLOBALS["x_seleccion"]) : "NULL";
	$fieldList["seleccion"] = $theValue;

	// Field otro
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["otro"] = $theValue;

	// Field procedimiento
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["procedimiento"] = $theValue;

	// Field digitalizacion
	$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
	$fieldList["digitalizacion"] = $theValue;
	
	// Field digitalizacion
	$theValue = ($GLOBALS["x_copia"] != "") ? intval($GLOBALS["x_copia"]) : "NULL";
	$fieldList["copia"] = $theValue;
  $fieldList["categoria"] = $GLOBALS["x_categoria"];
	
	// tipo
	$fieldList["tipo"]="'".$GLOBALS["x_tipo"]."'";
	// insert into database
	$strsql = "INSERT INTO serie (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";

	phpmkr_query($strsql, $conn);
	$id=phpmkr_insert_id();
	insertar_expediente_automatico($id);
	return $id;
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