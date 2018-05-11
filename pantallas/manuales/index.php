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

$est_check = array(
	1 => "",
	0 => ""
);
$agrup_check = array(
	1 => "",
	0 => ""
);
$idmanual = 0;
$accion_manual="add_manual";
$agrupador = 1;
$nombre = "";
$descrip = "";
$cod_padre = 0;
$ruta_anexo = "";
$estado = 1;

if (isset($_REQUEST["idmanual"])) {
	if ($_REQUEST["idmanual"] != 0) {
		$datos = busca_filtro_tabla("", "manual", "idmanual=" . $_REQUEST["idmanual"], "", $conn);
		if ($datos["numcampos"]) {
			$accion_manual="edit_manual";
			$idmanual = $datos[0]["idmanual"];
			$agrupador = $datos[0]["agrupador"];
			$nombre = $datos[0]["etiqueta"];
			$descrip = $datos[0]["descripcion"];
			$cod_padre = $datos[0]["cod_padre"];
			$ruta_anexo = base64_encode($datos[0]["ruta_anexo"]);
			$estado = $datos[0]["estado"];
		}
	}
}
$agrup_check[$agrupador] = 'checked';
$est_check[$estado] = 'checked';

include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
echo librerias_jquery("1.7");
echo librerias_validar_formulario("11");
echo librerias_arboles();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	<body>
		<div class="container">
			<form id="formulario" name="formulario" method="post" action="ejecutar_acciones.php" enctype="multipart/form-data">
				<table class="table table-bordered" style="margin: 20px;">
					<tbody>
						<tr>
							<td><strong>AGRUPADOR</strong></td>
							<td>
							<input type="radio" name="agrupador" <?php echo $agrup_check[1]; ?> value="1">
							SI
							<input type="radio" name="agrupador" <?php echo $agrup_check[0]; ?> value="0">
							NO</td>
						</tr>
						<tr>
							<td><strong>NOMBRE</strong></td>
							<td>
							<input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre;?>" >
							</td>
						</tr>
						<tr class="tr_hidden">
							<td><strong>DESCRIPCI&Oacute;N</strong></td>
							<td><textarea name="descripcion" id="descripcion" style="width: 500px; height: 150px;"><?php echo $descrip;?></textarea></td>
						</tr>
						<tr>
							<td><strong>VINCULADO A</strong></td>
							<td>
							<input  tabindex='2'  type="text" id="stext_cod_padre" width="200px" size="25">
							<a href="javascript:void(0)" onclick="tree.findItem((document.getElementById('stext_cod_padre').value),1)"> <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"> </a><a href="javascript:void(0)" onclick="tree.findItem((document.getElementById('stext_cod_padre').value),0,1)"> <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"> </a><a href="javascript:void(0)" onclick="tree.findItem((document.getElementById('stext_cod_padre').value))"> <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>
							<br/>
							<input type="hidden" name="cod_padre" id="cod_padre" value="<?php echo $cod_padre;?>">
							<div id="esperando_cod_padre">
								<img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif">
							</div><div id="treeboxbox_cod_padre" class="arbol_saia" height="90%"></div></td>
						</tr>
						<tr class="tr_hidden">
							<td><strong>ANEXO</strong></td>
							<td>
							<input type="file" id="anexo" name="anexo">
							</td>
						</tr>
						<tr>
							<td><strong>ESTADO</strong></td>
							<td>
							<input type="radio" name="estado" <?php echo $est_check[1]; ?> value="1">
							SI
							<input type="radio" name="estado" <?php echo $est_check[0]; ?> value="0">
							NO</td>
						</tr>
						<tr>
							<td colspan="2">
							<input type="hidden" name="idmanual" id="idmanual" value="<?php echo $idmanual; ?>" />
							<input type="hidden" name="ruta_anexo" id="ruta_anexo" value="<?php echo $ruta_anexo; ?>" />
							<input type="hidden" name="accion_manual" id="accion_manual" value="<?php echo $accion_manual; ?>" />
							<input type="submit" value="Guardar" class="btn btn-mini btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<script src="<?php echo $ruta_db_superior; ?>js/additional-methods.min.js"></script>
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
			tree = new dhtmlXTreeObject("treeboxbox_cod_padre", "100%", "100%", 0);
			tree.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree.enableIEImageFix(true);
			tree.enableCheckBoxes(1);
			tree.enableRadioButtons(true);
			tree.setOnLoadingStart(cargando_cod_padre);
			tree.setOnLoadingEnd(fin_cargando_cod_padre);
			tree.enableSmartXMLParsing(true);
			tree.loadXML("test_ayuda.php?idmanual=<?php echo $idmanual;?>&seleccionado=<?php echo $cod_padre;?>");
			tree.setOnCheckHandler(onNodeSelect_cod_padre);

			function onNodeSelect_cod_padre(nodeId) {
				valor_destino = document.getElementById("cod_padre");
				if (tree.isItemChecked(nodeId)) {
					if (valor_destino.value !== "")
						tree.setCheck(valor_destino.value, false);
					if (nodeId.indexOf("_") != -1)
						nodeId = nodeId.substr(0, nodeId.indexOf("_"));
					valor_destino.value = nodeId;
				} else {
					valor_destino.value = "";
				}
			}

			function fin_cargando_cod_padre() {
				if (browserType == "gecko") {
					document.poppedLayer = eval('document.getElementById("esperando_cod_padre")');
				} else if (browserType == "ie") {
					document.poppedLayer = eval('document.getElementById("esperando_cod_padre")');
				} else {
					document.poppedLayer = eval('document.layers["esperando_cod_padre"]');
				}
				document.poppedLayer.style.display = "none";
			}

			function cargando_cod_padre() {
				if (browserType == "gecko") {
					document.poppedLayer = eval('document.getElementById("esperando_cod_padre")');
				} else if (browserType == "ie") {
					document.poppedLayer = eval('document.getElementById("esperando_cod_padre")');
				} else {
					document.poppedLayer = eval('document.layers["esperando_cod_padre"]');
				}
				document.poppedLayer.style.display = "";
			}
		
		
			$(document).ready(function() {			
				$("#formulario").validate({
					rules : {
						nombre : {
							required : true
						}
					},
					messages : {
						nombre : "Por favor ingrese el nombre",
						anexo : {
							required : "Por favor ingrese el anexo",
							extension : "Extensi&oacute;n no valida (pdf)"
						}
					}

				});
				
				$("[name='agrupador']").change(function() {
						var ruta_anexo=$("#ruta_anexo").val();
						if ($(this).val() == 0) {
							$(".tr_hidden").show();
							if(ruta_anexo==""){
								$("#anexo").rules("add", {
									required : true,
									extension : "pdf"
								});
							}
							$("#cod_padre").rules("add", {
								required : true
							});
						} else {
							$(".tr_hidden").hide();
							$("#anexo").rules("remove");
							$("#cod_padre").rules("remove");
						}
				});
				$("[name='agrupador']:checked").trigger("change");
								
			});

		</script>
	</body>
</html>
