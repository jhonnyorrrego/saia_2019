<html><title>.:EDITAR CLASIFICACION PQRSF:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../carta/funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<script type="text/javascript" src="../../js/jquery.js"></script>
			<script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CLASIFICACION PQRSF</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',306,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',306,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(306,3589,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha">
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(306,3583,$_REQUEST['iddoc']);?></tr><tr id="tr_serie">
								<td class="encabezado" width="20%" title="">CLASIFICACION*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(306,3586,'1',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_serie" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="serie" id="serie"   value="<?php cargar_seleccionados(306,3586,1,$_REQUEST['iddoc']);?>" ><div id="esperando_serie">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_serie" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_serie=new dhtmlXTreeObject("treeboxbox_serie","100%","100%",0);
								tree_serie.setImagePath("../../imgs/");
								tree_serie.enableIEImageFix(true);tree_serie.enableCheckBoxes(1);
									tree_serie.enableRadioButtons(true);tree_serie.setOnLoadingStart(cargando_serie);
								tree_serie.setOnLoadingEnd(fin_cargando_serie);tree_serie.enableSmartXMLParsing(true);tree_serie.loadXML("../../test_serie.php?tabla=serie&id=1033",checkear_arbol);tree_serie.setOnCheckHandler(onNodeSelect_serie);
									function onNodeSelect_serie(nodeId) {
										valor_destino=document.getElementById("serie");
										if(tree_serie.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_serie.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_serie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_serie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(306,3586,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_serie.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_responsable">
								<td class="encabezado" width="20%" title="">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(306,3585,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_responsable" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="responsable" id="responsable"   value="<?php cargar_seleccionados(306,3585,1,$_REQUEST['iddoc']);?>" ><div id="esperando_responsable">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_responsable" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","100%","100%",0);
								tree_responsable.setImagePath("../../imgs/");
								tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
									tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
								tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
									function onNodeSelect_responsable(nodeId) {
										valor_destino=document.getElementById("responsable");
										if(tree_responsable.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_responsable.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_responsable() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_responsable() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(306,3585,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_responsable.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',306,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_clasificacion_pqrsf" value="<?php echo(mostrar_valor_campo('idft_clasificacion_pqrsf',306,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',306,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',306,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3586'); ?>"><input type="hidden" name="formato" value="306"><tr><td colspan='2'><?php submit_formato(306,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>