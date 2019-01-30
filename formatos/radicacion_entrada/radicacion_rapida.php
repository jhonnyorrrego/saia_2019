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
include_once ($ruta_db_superior . "assets/librerias.php");
include_once ($ruta_db_superior . "librerias_saia.php");
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<?= jquery() ?>
        <?= bootstrap() ?>
        <?= validate() ?>
		<?php
		echo(librerias_arboles());
		?>
	</head>
	<style>
	   .error{
	       color:red;
	   }
	</style>
	<link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<body>
		<div id="div_contenido">
			<form method="POST" id="form_radicacion_rapida" action="<?php echo($ruta_db_superior); ?>colilla.php" >
				<br/>
				<br />
				<table class="table-bordered" border="1" align="center">
					<tr>
						<td class="encabezado_list" colspan="2" align="center">Seleccione Tipo de Radicaci&oacute;n</td>
					</tr>
					<tr>
						<td colspan="2">
						<input type="hidden" class="required" id="generar_consecutivo" name="generar_consecutivo">
						<input type="hidden" name="enlace" id="enlace" value="pantallas/buscador_principal.php?idbusqueda=7">
						<input type="hidden" name="enlace2" id="enlace2" value="formatos/radicacion_entrada/radicacion_rapida.php">
						<?php
						$adicional = '';
						if (@$_REQUEST["idcategoria_formato"]) {
							$adicional = "&idcategoria_formato=" . $_REQUEST["idcategoria_formato"];
						}
						?>
						<div id="esperando_serie">
							<img src="<?php echo($ruta_db_superior); ?>imagenes/cargando.gif">
						</div><div id="treeboxbox_tree_equipos" class="arbol_saia" style="" ></div>
						<script type="text/javascript">
						<!--		
						
							
						var browserType;
						if (document.layers) {browserType = "nn4"}
						if (document.all) {browserType = "ie"}
						if (window.navigator.userAgent.toLowerCase().match("gecko")) {
						 browserType= "gecko"
						}
						tree_equipos=new dhtmlXTreeObject("treeboxbox_tree_equipos","100%","100%",0);
						tree_equipos.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
						tree_equipos.enableTreeImages("false");
						tree_equipos.enableIEImageFix(true);
						tree_equipos.setOnCheckHandler(onNodeSelect);
						tree_equipos.enableCheckBoxes(1);
						tree_equipos.enableRadioButtons(true);
						tree_equipos.setOnLoadingStart(cargando_serie);
						tree_equipos.setOnLoadingEnd(fin_cargando_serie);
						tree_equipos.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");
						tree_equipos.loadXML("<?php echo($ruta_db_superior); ?>formatos/radicacion_entrada/test_radicacion_rapida.php");
						
						function onNodeSelect(nodeId){
							if(nodeId.indexOf('#',0)==-1){
								$('#generar_consecutivo').val(nodeId);
								$('#enlace').val("views/documento/index_acordeon.php");

							}
						}
						function fin_cargando_serie() {
						if (browserType == "gecko" )
						 document.poppedLayer = eval('document.getElementById("esperando_serie")');
						else if (browserType == "ie")
						 document.poppedLayer = eval('document.getElementById("esperando_serie")');
						else
						   document.poppedLayer = eval('document.layers["esperando_serie"]');
						document.poppedLayer.style.visibility = "hidden";
						  tree_equipos.openAllItems(0);
						}
						
						function cargando_serie() {
						  if (browserType == "gecko" )
						 document.poppedLayer = eval('document.getElementById("esperando_serie")');
						else if (browserType == "ie")
						 document.poppedLayer = eval('document.getElementById("esperando_serie")');
						else
						   document.poppedLayer = eval('document.layers["esperando_serie"]');
						document.poppedLayer.style.visibility = "visible";
						}                            	
						--> 		
					</script>
						
						</td>
					</tr>
					<tr>
						<td style="font-size:8pt;"  align="center">Descripci&oacuten General</td>
						<td align="center">
						<input type="text" id="descripcion_general" name="descripcion_general"/>
						</td>
					</tr>
                    <tr>
                        <td style="font-size:8pt;"  align="center">Colilla*</td>
                        <td align="center">
                            <label class="radio-inline required"><input type="radio" name="colilla_vertical" value="0">Horizontal</label>
                            <label class="radio-inline"><input type="radio" name="colilla_vertical" checked value="1">Vertical</label>
                        </td>
                    </tr>
					<tr>
						<td colspan="2" align="center">
						<input class="btn btn-complete mx-1" type="submit" value="Radicar" id="enviar" name="enviar"/>
						</td>
					</tr>
				</table>
				<input type="hidden" name="target" value="_self">
			</form>
			<script>
                            $(document).ready(function() {
                                $("#form_radicacion_rapida").validate({
                                    ignore: [],
                                    submitHandler : function(form) {
                                        var generar_consecutivo = $('#generar_consecutivo').val();
                                        if (!generar_consecutivo || generar_consecutivo == '') {
                                            top.notification({
                                                message: "<b>ATENCI&Oacute;N</b><br>De seleccionar una opci&oacute;n para radicar!",
                                                type: "warning",
                                                duration: "2500"
                                            });

                                            return (false);
                                        }
                                        form.submit();
                                    }
                                });
                            });
			</script>
	</body>
</html>