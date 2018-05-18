<html><title>.:EDITAR DISTRIBUCI&Oacute;N F&Iacute;&SHY;SICA:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../carta/funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DISTRIBUCIÓN FÍ&SHY;SICA</td></tr><input type="hidden" name="fecha_recibido" value="<?php echo(mostrar_valor_campo('fecha_recibido',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_recibido" value="<?php echo(mostrar_valor_campo('usuario_recibido',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_entregado" value="<?php echo(mostrar_valor_campo('fecha_entregado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_entregado" value="<?php echo(mostrar_valor_campo('usuario_entregado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',272,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(272,3131,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_documento">
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(272,3125,$_REQUEST['iddoc']);?></tr><tr id="tr_nombre_mensajero">
								<td class="encabezado" width="20%" title="">NOMBRE DE MENSAJERO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(272,3126,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_nombre_mensajero" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="nombre_mensajero" id="nombre_mensajero"   value="<?php cargar_seleccionados(272,3126,1,$_REQUEST['iddoc']);?>" ><div id="esperando_nombre_mensajero">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_nombre_mensajero" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_nombre_mensajero=new dhtmlXTreeObject("treeboxbox_nombre_mensajero","100%","100%",0);
								tree_nombre_mensajero.setImagePath("../../imgs/");
								tree_nombre_mensajero.enableIEImageFix(true);tree_nombre_mensajero.enableCheckBoxes(1);
									tree_nombre_mensajero.enableRadioButtons(true);tree_nombre_mensajero.setOnLoadingStart(cargando_nombre_mensajero);
								tree_nombre_mensajero.setOnLoadingEnd(fin_cargando_nombre_mensajero);tree_nombre_mensajero.enableSmartXMLParsing(true);tree_nombre_mensajero.loadXML("../../test.php?rol=1",checkear_arbol);tree_nombre_mensajero.setOnCheckHandler(onNodeSelect_nombre_mensajero);
									function onNodeSelect_nombre_mensajero(nodeId) {
										valor_destino=document.getElementById("nombre_mensajero");
										if(tree_nombre_mensajero.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_nombre_mensajero.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_nombre_mensajero() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_nombre_mensajero"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_nombre_mensajero() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_nombre_mensajero"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(272,3126,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_nombre_mensajero.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_nivel_urgencia" >
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(272,3135,$_REQUEST['iddoc']);?></td></tr><tr id="tr_destino">
                     <td class="encabezado" width="20%" title="">DESTINO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="destino" name="destino"  value="<?php echo(mostrar_valor_campo('destino',272,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',272,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_distribucion_fisica" value="<?php echo(mostrar_valor_campo('idft_distribucion_fisica',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3125'); ?>"><input type="hidden" name="formato" value="272"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(272,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>