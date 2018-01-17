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
include_once ($ruta_db_superior . "librerias_saia.php");

if (!isset($_REQUEST["iddoc"])) {
	die();
}

echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_validar_formulario('11'));
?>
<div class="container">
	<legend>
		Responsables
	</legend>
	<br>
	<form id="formulario" name="formulario" method="post">
		<table align="center" style="width: 100%;" class="table table-bordered">
			<tr>
				<td><strong>Funcionario</strong></td>
				<td>
					<?php echo arbol_func("responsable","radio","test.php?rol=1&sin_padre=1");?>
				</td>
			</tr>
			<tr>
				<td><strong>Tipo Aprobaci&oacute;n</strong></td>
				<td>
				<div class="control-group element">
					<label class="control-label" for="aprobacion_en"></label>
					<div class="controls">
						<input type="radio" name="tipo_aprobacion" id="tipo_aprobacion1" value="1" class="required" checked="true">
						Aprobar
						<input type="radio" name="tipo_aprobacion" id="tipo_aprobacion2" value="2">
						Visto Bueno
					</div>
				</div></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center">
				<button class="btn btn-primary btn-mini" id="submit_formulario">
					Guardar
				</button></td>
			</tr>
		</table>
	</form>
</div>


<?php
echo(librerias_arboles());
function arbol_func($campo, $tipo = "radio", $url="test.php") {
	global $ruta_db_superior;
?>
Buscar:
<input tabindex='1' type="text" id="stext_<?php echo $campo;?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_<?php echo $campo;?>.findItem((document.getElementById('stext_<?php echo $campo;?>').value),1)"> <img src="<?php echo $ruta_db_superior;?>botones/general/anterior.png"border="0px"> </a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo;?>.findItem((document.getElementById('stext_<?php echo $campo;?>').value),0,1)"> <img src="<?php echo $ruta_db_superior;?>botones/general/buscar.png"border="0px"> </a>
<a href="javascript:void(0)" onclick="tree_<?php echo $campo;?>.findItem((document.getElementById('stext_<?php echo $campo;?>').value))"> <img src="<?php echo $ruta_db_superior;?>botones/general/siguiente.png"border="0px"> </a>
<br />
<input type="hidden" maxlength="2000" class="required" name="<?php echo $campo;?>" id="<?php echo $campo;?>" >

<div id="esperando_<?php echo $campo;?>"><img src="<?php echo $ruta_db_superior;?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_<?php echo $campo;?>" height="90%"></div>
<script type="text/javascript">
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
	tree_<?php echo $campo;?> = new dhtmlXTreeObject("treeboxbox_<?php echo $campo;?>", "100%", "100%", 0);
	tree_<?php echo $campo;?>.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
	tree_<?php echo $campo;?>.enableIEImageFix(true);
	tree_<?php echo $campo;?>.enableCheckBoxes(1);
	<?php
	if($tipo=="radio"){
		?>
		tree_responsable.enableRadioButtons(true);
		<?php
	}else{
		?>
		tree_<?php echo $campo;?>.enableThreeStateCheckboxes(1);
		<?php
	}
	?>
	tree_<?php echo $campo;?>.setOnLoadingStart(cargando_<?php echo $campo;?>);
	tree_<?php echo $campo;?>.setOnLoadingEnd(fin_cargando_<?php echo $campo;?>);
	tree_<?php echo $campo;?>.enableSmartXMLParsing(true);
	tree_<?php echo $campo;?>.loadXML("<?php echo $ruta_db_superior.$url;?>");
	tree_<?php echo $campo;?>.setOnCheckHandler(onNodeSelect_<?php echo $campo;?>);

	function onNodeSelect_<?php echo $campo;?>(nodeId) {
		valor_destino = document.getElementById("<?php echo $campo;?>");
		destinos = tree_<?php echo $campo;?>.getAllChecked();
		nuevo = destinos.replace(/\,{2,}(d)*/gi, ",");
		nuevo = nuevo.replace(/\,$/gi, "");
		vector = destinos.split(",");
		for ( i = 0; i < vector.length; i++) {
			if (vector[i].indexOf("_") != -1) {
				vector[i] = vector[i].substr(0, vector[i].indexOf("_"));
			}
			nuevo = vector.join(",");
			if (vector[i].indexOf("#") != -1) {
				hijos = tree_<?php echo $campo;?>.getAllSubItems(vector[i]);
				hijos = hijos.replace(/\,{2,}(d)*/gi, ",");
				hijos = hijos.replace(/\,$/gi, "");
				vectorh = hijos.split(",");

				for ( h = 0; h < vectorh.length; h++) {
					if (vectorh[h].indexOf("_") != -1)
						vectorh[h] = vectorh[h].substr(0, vectorh[h].indexOf("_"));
					nuevo = eliminarItem(nuevo, vectorh[h]);
				}
			}
		}
		nuevo = nuevo.replace(/\,{2,}(d)*/gi, ",");
		nuevo = nuevo.replace(/\,$/gi, "");
		valor_destino.value = nuevo;
	}

	function fin_cargando_<?php echo $campo;?>() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo $campo;?>")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo $campo;?>")');
		else
			document.poppedLayer = eval('document.layers["esperando_<?php echo $campo;?>"]');
		document.poppedLayer.style.display = "none";
	}

	function cargando_<?php echo $campo;?>() {
		if (browserType == "gecko")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo $campo;?>")');
		else if (browserType == "ie")
			document.poppedLayer = eval('document.getElementById("esperando_<?php echo $campo;?>")');
		else
			document.poppedLayer = eval('document.layers["esperando_<?php echo $campo;?>"]');
		document.poppedLayer.style.display = "";
	}
</script>
<?php
}
?>