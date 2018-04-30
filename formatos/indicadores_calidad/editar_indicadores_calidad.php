<html><title>.:EDITAR INDICADOR(ES) DE CALIDAD:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INDICADOR(ES) DE CALIDAD</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(487,6180,$_REQUEST['iddoc']);?></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',487,$_REQUEST['iddoc'])); ?>"><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6182,$_REQUEST['iddoc']);?></td></tr><tr id="tr_dependencia_indicador">
                     <td class="encabezado" width="20%" title="Listado de dependencias de la entidad">DEPENDENCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6183,$_REQUEST['iddoc']);?></td></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre del indicador">NOMBRE DEL INDICADOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',487,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_fuente_datos">
                     <td class="encabezado" width="20%" title="Fuente de datos ">FUENTE DATOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="fuente_datos" id="fuente_datos" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('fuente_datos',487,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_objetivo_calidad_indicador">
                     <td class="encabezado" width="20%" title="Objetivo del Indicador">OBJETIVO DE CALIDAD DEL INDICADOR*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="objetivo_calidad_indicador" id="objetivo_calidad_indicador" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo_calidad_indicador',487,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo_grafico" >
                     <td class="encabezado" width="20%" title="">TIPO DE GR&Aacute;FICO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6187,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo_indicador" >
                     <td class="encabezado" width="20%" title="">TIPO DE INDICADOR</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6188,$_REQUEST['iddoc']);?></td></tr><tr id="tr_responsable_analisis">
								<td class="encabezado" width="20%" title="Responsable del an&aacute;lisis">RESPONSABLE DEL AN&Aacute;LISIS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(487,6189,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='4'  type="text" id="stext_responsable_analisis" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="100"  class="required"  name="responsable_analisis" id="responsable_analisis"   value="<?php cargar_seleccionados(487,6189,1,$_REQUEST['iddoc']);?>" ><div id="esperando_responsable_analisis">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_responsable_analisis" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_responsable_analisis=new dhtmlXTreeObject("treeboxbox_responsable_analisis","100%","100%",0);
								tree_responsable_analisis.setImagePath("../../imgs/");
								tree_responsable_analisis.enableIEImageFix(true);tree_responsable_analisis.enableCheckBoxes(1);
									tree_responsable_analisis.enableRadioButtons(true);tree_responsable_analisis.setOnLoadingStart(cargando_responsable_analisis);
								tree_responsable_analisis.setOnLoadingEnd(fin_cargando_responsable_analisis);tree_responsable_analisis.enableSmartXMLParsing(true);tree_responsable_analisis.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_responsable_analisis.setOnCheckHandler(onNodeSelect_responsable_analisis);
									function onNodeSelect_responsable_analisis(nodeId) {
										valor_destino=document.getElementById("responsable_analisis");
										if(tree_responsable_analisis.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_responsable_analisis.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_responsable_analisis() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_analisis")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_analisis")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable_analisis"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_responsable_analisis() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_analisis")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_analisis")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable_analisis"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(487,6189,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_responsable_analisis.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="idft_indicadores_calidad" value="<?php echo(mostrar_valor_campo('idft_indicadores_calidad',487,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',487,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',487,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',487,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('6184'); ?>"><input type="hidden" name="formato" value="487"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(487,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>