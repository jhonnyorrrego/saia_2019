<html><title>.:EDITAR DEPENDENCIAS DE LA RUTA:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="orden_dependencia" value="<?php echo(mostrar_valor_campo('orden_dependencia',405,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_dependencia" value="<?php echo(mostrar_valor_campo('estado_dependencia',405,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_item_dependenc">
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required" style="width: 100px;"  tabindex='1'  type="text" size="100" id="fecha_item_dependenc" name="fecha_item_dependenc"  value="<?php echo(mostrar_valor_campo('fecha_item_dependenc',405,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_dependencia_asignada">
								<td class="encabezado" width="20%" title="">DEPENDENCIA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(405,4995,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_dependencia_asignada" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="dependencia_asignada" id="dependencia_asignada"   value="<?php cargar_seleccionados(405,4995,1,$_REQUEST['iddoc']);?>" ><div id="esperando_dependencia_asignada">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_dependencia_asignada" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_dependencia_asignada=new dhtmlXTreeObject("treeboxbox_dependencia_asignada","100%","100%",0);
								tree_dependencia_asignada.setImagePath("../../imgs/");
								tree_dependencia_asignada.enableIEImageFix(true);tree_dependencia_asignada.enableCheckBoxes(1);
									tree_dependencia_asignada.enableRadioButtons(true);tree_dependencia_asignada.setOnLoadingStart(cargando_dependencia_asignada);
								tree_dependencia_asignada.setOnLoadingEnd(fin_cargando_dependencia_asignada);tree_dependencia_asignada.enableSmartXMLParsing(true);tree_dependencia_asignada.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);tree_dependencia_asignada.setOnCheckHandler(onNodeSelect_dependencia_asignada);
									function onNodeSelect_dependencia_asignada(nodeId) {
										valor_destino=document.getElementById("dependencia_asignada");
										if(tree_dependencia_asignada.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_dependencia_asignada.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_dependencia_asignada() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_dependencia_asignada"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_dependencia_asignada() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_dependencia_asignada"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(405,4995,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_dependencia_asignada.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_descripcion_dependen">
                     <td class="encabezado" width="20%" title="">DESCRIPCIóN</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_dependen" id="descripcion_dependen" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(mostrar_valor_campo('descripcion_dependen',405,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_dependencias_ruta" value="<?php echo(mostrar_valor_campo('idft_dependencias_ruta',405,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="405"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="dependencias_ruta"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(405,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>