<?php
include_once("header.php");
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
  if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
  include_once("pantallas/documento/menu_principal_documento.php");
 	menu_principal_documento($_REQUEST["iddoc"]);
}
function combo($seleccionado) {
	$option="";
	for ($i = 5; $i < 51; $i++) {
		if ($i == $seleccionado){
			$option.= "<option value='" . $i . "' selected>" . $i. "</option>";
		}else{
			$option.= "<option value='" . $i . "'>" . $i . "</option>";
		}
	}
	echo $option;
}

if(!$_REQUEST["iddoc"] && !$_REQUEST["iddocumento"]){
	notificaciones("Informaci&oacute;n NO encontrada","error");
	volver(1);
	die();
}
$iddocumento = ($_REQUEST["iddoc"]) ? $_REQUEST["iddoc"] : $_REQUEST["iddocumento"] ;
$info_doc = busca_filtro_tabla("A.numero,A.descripcion AS etiqueta,B.nombre_tabla,B.idformato,B.nombre,B.margenes,B.font_size,B.papel,B.orientacion", "documento A,formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=" . $iddocumento, "", $conn);

include_once("librerias_saia.php");
echo librerias_jquery("1.8");
echo librerias_highslide();
echo librerias_arboles();
?>
<script type='text/javascript'>
	hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	
	function guardar_configuracion() {
		parent.document.getElementById("orientacion").value = document.getElementById("orientacion").value;
		parent.document.getElementById("margenes").value = document.getElementById("mizq").value + "," + document.getElementById("mder").value + "," + document.getElementById("msup").value + "," + document.getElementById("minf").value;
		parent.document.getElementById("font_size").value = document.getElementById("font_size").value;
		parent.document.getElementById("papel").value = document.getElementById("papel").value;
		if (document.getElementById("ocultar_firmas2").checked){
			parent.document.getElementById("ocultar_firmas").value = 1;
		}else{
			parent.document.getElementById("ocultar_firmas").value = 0;
		}
		parent.document.getElementById("config").value=1;
		window.parent.hs.close();
	}
	
	$(document).ready(function() {
		$("input[name=seleccionar]").click(function() {
			if ($(this).val() == 1) {
				var list_seleccionados = tree2.getAllUnchecked();
				vector = list_seleccionados.split(",");
				for ( i = 0; i < vector.length; i++) {
					tree2.setCheck(vector[i], $(this).val());
				}
			} else {
				var list_seleccionados = tree2.getAllChecked();
				vector = list_seleccionados.split(",");
				for ( i = 0; i < vector.length; i++) {
					tree2.setCheck(vector[i], $(this).val());
				}
			}
		});
	}); 
</script>
<?php
if(isset($_REQUEST["configurar_impresion"])){
  $margenes=explode(",",$info_doc[0]["margenes"]);
	$orig=array(0=>"",1=>"");
	$orig[$info_doc[0]["orientacion"]]="selected";
	
	$papel=array("Letter"=>"","Legal"=>"","A4"=>"");
	$papel[$info_doc[0]["papel"]]="selected";
?>
<b>CONFIGURAR IMPRESI&Oacute;N</b><br><br>
<form name='configurar_impresion' method="post">
	<table border="0" width="100%" align="center">
		<tr>
			<td width="40%" class="encabezado">M&Aacute;RGENES</td>
			<td bgcolor="#F5F5F5">
			<table>
				<tr>
					<td> Izquierda</td><td>
					<select id="mizq" name="mizq">
						<?php combo($margenes[0]); ?>
					</select></td>
				</tr>
				<tr>
					<td> Derecha</td><td>
					<select id="mder" name="mder">
						<?php combo($margenes[1]); ?>
					</select></td>
				</tr>
				<tr>
					<td> Superior</td><td>
					<select id="msup" name="msup">
						<?php combo($margenes[2]); ?>
					</select></td>
				</tr>
				<tr>
					<td> Inferior</td><td>
					<select id="minf" name="minf">
						<?php combo($margenes[3]); ?>
					</select></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td class="encabezado">ORIENTACI&Oacute;N</td>
			<td bgcolor="#F5F5F5">
			<select name="orientacion" id="orientacion" >
				<option value="0" <?php echo $orig[0];?> >Vertical</option>
				<option value="1" <?php echo $orig[1];?> >Horizontal</option>
			</select></td>
		</tr>
		<tr>
			<td class="encabezado">TAMA&Ntilde;O DEL PAPEL</td>
			<td bgcolor='#F5F5F5'>
			<select name='papel' id='papel'>
				<option value='Letter' <?php echo $papel["Letter"];?> >Carta</option>
				<option value='Legal' <?php echo $papel["Legal"];?>>Oficio</option>
				<option value='A4' <?php echo $papel["A4"];?>>A4</option>
			</select></td>
		</tr>
		<tr>
			<td class="encabezado">OCULTAR NOMBRES Y FIRMAS DE RESPONSABLES</td>
			<td bgcolor='#F5F5F5'>
			<input type='radio' id='ocultar_firmas2' name='ocultar_firmas'  value='1'>
			Si
			<input type='radio' id='ocultar_firmas1' name='ocultar_firmas' value='0' checked="true">
			No </td>
		</tr>
		<tr>
			<td class="encabezado">TAMA&Ntilde;O DE LETRA</td>
			<td bgcolor='#F5F5F5'>
			<input type='text' id='font_size' name='font_size' value='<?php echo $info_doc[0]["font_size"];?>'>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<input type='button' value='Aplicar' onclick='guardar_configuracion();'>
			</td>
		</tr>
	</table>
</form>
<?php
}else{
$texto = '';
if ($info_doc["numcampos"]) {
	$texto .= '<b>' . strtoupper($info_doc[0]["nombre"]) . ':</b><br/>';
	$texto .= "Numero Radicado: " . $info_doc[0]["numero"] . "<br/>";
	$texto .= strip_tags(codifica_encabezado("Descripci&oacute;n:" . $info_doc[0]["etiqueta"]), "</b>");

	$descripcion = busca_filtro_tabla("nombre", "campos_formato", "formato_idformato=" . $info_doc[0]["idformato"] . " AND acciones LIKE '%d%'", "", $conn);
	if ($descripcion["numcampos"]) {
		$campo_descripcion = $descripcion[0]["nombre"];
	} else {
		$campo_descripcion = "id" . $info_doc[0]["nombre_tabla"];
	}
	$info_ft = busca_filtro_tabla("id" . $info_doc[0]["nombre_tabla"] . " AS llave, " . $campo_descripcion . " AS etiqueta ,'" . $info_doc[0]["nombre_tabla"] . "' AS nombre_tabla", $info_doc[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, "", $conn);
	if ($info_ft["numcampos"]) {
		$iddoc = $info_doc[0]["idformato"] . "-" . $info_ft[0]["llave"] . "-id" . $info_doc[0]["nombre_tabla"];
	} else {
		$iddoc = 0;
	}
} else {
	notificaciones("Formato NO encontrado", "error");
	volver(1);
	die();
}
?>
<table border="1" style="border-collapse:collapse;width: 98%; height: 90%" >
	<tr style="height: 20%">
		<td colspan="2">
			<?php echo $texto;?>
			<div align="right"><a href="?configurar_impresion=1&iddocumento=<?php echo $iddocumento;?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:450,preserveContent:true } )">Configurar Impresi&oacute;n</a>&nbsp;&nbsp;&nbsp;<a href="#" style='cursor:pointer; color:blue' onClick='generar_seleccion();'>Imprimir</a></div>
			<form id="configuracion" name='configuracion' method="post" action="exportar_seleccionar_impresion.php">
			<input type='hidden' name='margenes' id='margenes' value='<?php echo $info_doc[0]["margenes"];?>'>
			<input type='hidden' name='font_size' id='font_size' value='<?php echo $info_doc[0]["font_size"];?>'>
			<input type='hidden' name='orientacion' id='orientacion' value='<?php echo $info_doc[0]["orientacion"];?>'>
			<input type='hidden' name='papel' id='papel' value='<?php echo $info_doc[0]["papel"];?>'>
			<input type='hidden' name='ocultar_firmas' id='ocultar_firmas' value='0'>
			<input type='hidden' name='config' id='config' value='0'>
			<input type='hidden' name='iddoc' id='iddoc' value='<?php echo $iddocumento;?>'>
			<input type='hidden' name='seleccion' id='seleccion' value=''>
			</form>
		</td>
	</tr>
<tr>
<td width="40%" valign="top">
<input type="radio" name="seleccionar" value="1">Todos <input type="radio" name="seleccionar" value="0">Ninguno<br/><br/>
<div id="esperando"><img src="imagenes/cargando.gif"></div>
<div id="treeboxbox_tree2"></div>

<script type="text/javascript">
	var nivel = 0;
	var browserType;
	if (document.layers) {
		browserType = "nn4"
	}
	if (document.all) {
		browserType = "ie"
	}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		browserType = "gecko"
	}

	tree2 = new dhtmlXTreeObject("treeboxbox_tree2", "100%", "100%", 0);
	tree2.setOnLoadingStart(cargando);
	tree2.setOnLoadingEnd(fin_cargando);
	tree2.setImagePath("imgs/");
	tree2.enableIEImageFix(true);
	tree2.enableCheckBoxes(1);
	tree2.enableSmartXMLParsing(true);
	tree2.loadXML("test_seleccionar_impresion.php?id=<?php echo $iddoc; ?>&paginas=<?php echo $iddocumento; ?>");
	tree2.setOnClickHandler(onNodeSelect);

	function onNodeSelect(nodeId) {
		var llave = 0;
		llave = tree2.getParentId(nodeId);
		tree2.closeAllItems(tree2.getParentId(nodeId))
		tree2.openItem(nodeId);
		tree2.openItem(tree2.getParentId(nodeId));
		conexion = "parsear_accion_arbol_impresion.php?id=" + nodeId + "&accion=mostrar&llave=" + llave;
		window.open(conexion, "detalles_impresion");
	}

	function cargando() {
		if (browserType == "gecko") {
			document.poppedLayer = eval('document.getElementById("esperando")');
		} else if (browserType == "ie") {
			document.poppedLayer = eval('document.getElementById("esperando")');
		} else {
			document.poppedLayer = eval('document.layers["esperando"]');
		}
		document.poppedLayer.style.visibility = "visible";
	}

	function fin_cargando() {
		if (browserType == "gecko") {
			document.poppedLayer = eval('document.getElementById("esperando")');
		} else if (browserType == "ie") {
			document.poppedLayer = eval('document.getElementById("esperando")');
		} else {
			document.poppedLayer = eval('document.layers["esperando"]');
		}
		document.poppedLayer.style.visibility = "hidden";
	}
		
	function generar_seleccion() {
		var list_seleccionados = tree2.getAllChecked();
		var list_medios = tree2.getAllPartiallyChecked();
		var selectos = "";
		if (list_seleccionados == "") {
			selectos = list_medios;
		} else {
			selectos = list_seleccionados;
			if(list_medios!=""){
				selectos+=","+list_medios;
			}
			
		}
		if (selectos == "" || !selectos) {
			alert("Seleccione algun item del arbol para imprimir");
			return false;
		}else{
			$("#seleccion").val(selectos);
			$("#configuracion").submit();
		}
	}
	
</script>
</td>
<td>
<iframe name="detalles_impresion" id="detalles_impresion" src="vacio.php" frameborder="0" width="100%" scrolling="auto" height="100%"></iframe>
</td>
</tr>
</table>
<?php
}
include_once("footer.php");
?>