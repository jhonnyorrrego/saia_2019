<html><title>.:EDITAR INFORME SEGUIMIENTO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php include_once("../../calendario/calendario.php"); ?>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INFORME SEGUIMIENTO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',483,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(483,6132,$_REQUEST['iddoc']);?></tr><input type="hidden" name="municipio_informe" value="<?php echo(mostrar_valor_campo('municipio_informe',483,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_compromisos">
                       <td class="encabezado" width="20%" title="">FECHA DE SEGUIMIENTO A COMPROMISOS*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_compromisos" id="fecha_compromisos" tipo="fecha" value="<?php mostrar_valor_campo('fecha_compromisos',483,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_compromisos","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_proceso_auditado">
                     <td class="encabezado" width="20%" title="">PROCESO AUDITADO</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="proceso_auditado" id="proceso_auditado" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('proceso_auditado',483,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="observaciones" value="<?php echo(mostrar_valor_campo('observaciones',483,$_REQUEST['iddoc'])); ?>"><tr id="tr_cumplimiento_plan">
                     <td class="encabezado" width="20%" title="">PORCENTAJE DE CUMPLIMIENTO DEL PLAN*</td>
                     <?php porcentaje_plan(483,6139,$_REQUEST['iddoc']);?></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',483,$_REQUEST['iddoc'])); ?>"><tr id="tr_jefe_control">
								<td class="encabezado" width="20%" title="">JEFE DE CONTROL INTERNO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(483,6143,'0',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='3'  type="text" id="stext_jefe_control" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="jefe_control" id="jefe_control"   value="<?php cargar_seleccionados(483,6143,1,$_REQUEST['iddoc']);?>" ><div id="esperando_jefe_control">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_jefe_control" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_jefe_control=new dhtmlXTreeObject("treeboxbox_jefe_control","100%","100%",0);
								tree_jefe_control.setImagePath("../../imgs/");
								tree_jefe_control.enableIEImageFix(true);tree_jefe_control.enableCheckBoxes(1);
									tree_jefe_control.enableRadioButtons(true);tree_jefe_control.setOnLoadingStart(cargando_jefe_control);
								tree_jefe_control.setOnLoadingEnd(fin_cargando_jefe_control);tree_jefe_control.enableSmartXMLParsing(true);tree_jefe_control.loadXML("../../test.php?sin_padre=1",checkear_arbol);tree_jefe_control.setOnCheckHandler(onNodeSelect_jefe_control);
									function onNodeSelect_jefe_control(nodeId) {
										valor_destino=document.getElementById("jefe_control");
										if(tree_jefe_control.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_jefe_control.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_jefe_control() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_jefe_control")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_jefe_control")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_jefe_control"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_jefe_control() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_jefe_control")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_jefe_control")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_jefe_control"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(483,6143,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_jefe_control.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="idft_informe_contraloria" value="<?php echo(mostrar_valor_campo('idft_informe_contraloria',483,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',483,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',483,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('6134'); ?>"><input type="hidden" name="formato" value="483"><tr><td colspan='2'><?php submit_formato(483,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>