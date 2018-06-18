<html><title>.:EDITAR HALLAZGO PLAN DE MEJORAMIENTO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate({	
						submitHandler: function(form) {
							<?php encriptar_sqli('formulario_formatos',0,'form_info','../../');?>
							form.submit();
						}
					});
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">HALLAZGO PLAN DE MEJORAMIENTO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',481,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(481,6092,$_REQUEST['iddoc']);?></tr><tr id="tr_clase_accion">
                     <td class="encabezado" width="20%" title="">CLASE ACCION*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(481,6094,$_REQUEST['iddoc']);?></td></tr><tr id="tr_radicado_plan">
                     <td class="encabezado" width="20%" title="">RADICADO DEL PLAN VINCULADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"   tabindex='1'  type="text" size="100" id="radicado_plan" name="radicado_plan"  value="<?php echo(mostrar_valor_campo('radicado_plan',481,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_consecutivo_hallazgo">
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="consecutivo_hallazgo" name="consecutivo_hallazgo"  value="<?php echo(mostrar_valor_campo('consecutivo_hallazgo',481,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_procesos_vinculados">
								<td class="encabezado" width="20%" title="Procesos Vinculados">PROCESOS VINCULADOS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(481,6097,'3',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='3'  type="text" id="stext_procesos_vinculados" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="procesos_vinculados" id="procesos_vinculados"   value="<?php cargar_seleccionados(481,6097,1,$_REQUEST['iddoc']);?>" ><div id="esperando_procesos_vinculados">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_procesos_vinculados" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_procesos_vinculados=new dhtmlXTreeObject("treeboxbox_procesos_vinculados","100%","100%",0);
								tree_procesos_vinculados.setImagePath("../../imgs/");
								tree_procesos_vinculados.enableIEImageFix(true);tree_procesos_vinculados.enableCheckBoxes(1);
									tree_procesos_vinculados.enableThreeStateCheckboxes(1);tree_procesos_vinculados.setOnLoadingStart(cargando_procesos_vinculados);
								tree_procesos_vinculados.setOnLoadingEnd(fin_cargando_procesos_vinculados);tree_procesos_vinculados.enableSmartXMLParsing(true);tree_procesos_vinculados.loadXML("test_procesos.php",checkear_arbol);
									tree_procesos_vinculados.setOnCheckHandler(onNodeSelect_procesos_vinculados);

									function onNodeSelect_procesos_vinculados(nodeId){
										valor_destino=document.getElementById("procesos_vinculados");
										destinos=tree_procesos_vinculados.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_procesos_vinculados.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_procesos_vinculados() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_procesos_vinculados")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_procesos_vinculados")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_procesos_vinculados"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_procesos_vinculados() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_procesos_vinculados")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_procesos_vinculados")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_procesos_vinculados"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(481,6097,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_procesos_vinculados.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_clase_observacion">
                     <td class="encabezado" width="20%" title="">CLASE DE OBSERVACI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(481,6098,$_REQUEST['iddoc']);?></td></tr><tr id="tr_deficiencia">
                     <td class="encabezado" width="20%" title="">HALLAZGO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="deficiencia" id="deficiencia" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('deficiencia',481,$_REQUEST['iddoc'])); ?></textarea></td></tr><input type="hidden" name="correcion_hallazgo" value="<?php echo(mostrar_valor_campo('correcion_hallazgo',481,$_REQUEST['iddoc'])); ?>"><tr id="tr_causas">
                     <td class="encabezado" width="20%" title="">CAUSAS</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="causas" id="causas" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('causas',481,$_REQUEST['iddoc'])); ?></textarea></td></tr><input type="hidden" name="accion_mejoramiento" value="<?php echo(mostrar_valor_campo('accion_mejoramiento',481,$_REQUEST['iddoc'])); ?>"><tr id="tr_secretarias">
								<td class="encabezado" width="20%" title="">AREA RESPONSABLE</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(481,6104,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='6'  type="text" id="stext_secretarias" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="<?php cargar_seleccionados(481,6104,1,$_REQUEST['iddoc']);?>" ><div id="esperando_secretarias">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_secretarias" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_secretarias=new dhtmlXTreeObject("treeboxbox_secretarias","100%","100%",0);
								tree_secretarias.setImagePath("../../imgs/");
								tree_secretarias.enableIEImageFix(true);tree_secretarias.enableCheckBoxes(1);
									tree_secretarias.enableThreeStateCheckboxes(1);tree_secretarias.setOnLoadingStart(cargando_secretarias);
								tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);tree_secretarias.enableSmartXMLParsing(true);tree_secretarias.loadXML("../../test_serie.php?tabla=dependencia",checkear_arbol);
									tree_secretarias.setOnCheckHandler(onNodeSelect_secretarias);

									function onNodeSelect_secretarias(nodeId){
										valor_destino=document.getElementById("secretarias");
										destinos=tree_secretarias.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_secretarias.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_secretarias() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_secretarias"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_secretarias() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_secretarias")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_secretarias"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(481,6104,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_secretarias.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_responsables">
								<td class="encabezado" width="20%" title="">RESPONSABLES DE MEJORAMIENTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(481,6105,'0',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='7'  type="text" id="stext_responsables" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="responsables" id="responsables"   value="<?php cargar_seleccionados(481,6105,1,$_REQUEST['iddoc']);?>" ><div id="esperando_responsables">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_responsables" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_responsables=new dhtmlXTreeObject("treeboxbox_responsables","100%","100%",0);
								tree_responsables.setImagePath("../../imgs/");
								tree_responsables.enableIEImageFix(true);tree_responsables.enableCheckBoxes(1);
									tree_responsables.enableThreeStateCheckboxes(1);tree_responsables.setOnLoadingStart(cargando_responsables);
								tree_responsables.setOnLoadingEnd(fin_cargando_responsables);tree_responsables.enableSmartXMLParsing(true);tree_responsables.loadXML("../../test.php?sin_padre=1",checkear_arbol);
									tree_responsables.setOnCheckHandler(onNodeSelect_responsables);

									function onNodeSelect_responsables(nodeId){
										valor_destino=document.getElementById("responsables");
										destinos=tree_responsables.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_responsables.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_responsables() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsables")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsables")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsables"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_responsables() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsables")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsables")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsables"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(481,6105,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_responsables.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="tiempo_cumplimiento" value="<?php echo(mostrar_valor_campo('tiempo_cumplimiento',481,$_REQUEST['iddoc'])); ?>"><tr id="tr_tiempo_seguimiento">
                       <td class="encabezado" width="20%" title="">TIEMPO PROGRAMADO PARA SEGUIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  class="required dateISO"  name="tiempo_seguimiento" id="tiempo_seguimiento" tipo="fecha" value="<?php mostrar_valor_campo('tiempo_seguimiento',481,$_REQUEST['iddoc']); ?>"><?php selector_fecha("tiempo_seguimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_responsable_seguimiento">
								<td class="encabezado" width="20%" title="">RESPONSABLES DE SEGUIMIENTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(481,6108,'0',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_responsable_seguimiento" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="responsable_seguimiento" id="responsable_seguimiento"   value="<?php cargar_seleccionados(481,6108,1,$_REQUEST['iddoc']);?>" ><div id="esperando_responsable_seguimiento">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_responsable_seguimiento" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_responsable_seguimiento=new dhtmlXTreeObject("treeboxbox_responsable_seguimiento","100%","100%",0);
								tree_responsable_seguimiento.setImagePath("../../imgs/");
								tree_responsable_seguimiento.enableIEImageFix(true);tree_responsable_seguimiento.enableCheckBoxes(1);
									tree_responsable_seguimiento.enableThreeStateCheckboxes(1);tree_responsable_seguimiento.setOnLoadingStart(cargando_responsable_seguimiento);
								tree_responsable_seguimiento.setOnLoadingEnd(fin_cargando_responsable_seguimiento);tree_responsable_seguimiento.enableSmartXMLParsing(true);tree_responsable_seguimiento.loadXML("../../test.php?sin_padre=1",checkear_arbol);
									tree_responsable_seguimiento.setOnCheckHandler(onNodeSelect_responsable_seguimiento);

									function onNodeSelect_responsable_seguimiento(nodeId){
										valor_destino=document.getElementById("responsable_seguimiento");
										destinos=tree_responsable_seguimiento.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_responsable_seguimiento.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_responsable_seguimiento() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_seguimiento")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_seguimiento")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable_seguimiento"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_responsable_seguimiento() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_seguimiento")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_responsable_seguimiento")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_responsable_seguimiento"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(481,6108,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_responsable_seguimiento.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_indicador_cumplimiento">
                     <td class="encabezado" width="20%" title="">INDICADOR DE ACCI&Oacute;N DE CUMPLIMIENTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='10'  name="indicador_cumplimiento" id="indicador_cumplimiento" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('indicador_cumplimiento',481,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='11'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',481,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_mecanismo_interno">
                     <td class="encabezado" width="20%" title="mecanismo_interno">MECANISMO DE SEGUIMIENTO INTERNO*</td>
                     <td class="celda_transparente"><textarea  tabindex='12'  name="mecanismo_interno" id="mecanismo_interno" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('mecanismo_interno',481,$_REQUEST['iddoc'])); ?></textarea></td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',481,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',481,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_hallazgo" value="<?php echo(mostrar_valor_campo('idft_hallazgo',481,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',481,$_REQUEST['iddoc'])); ?>"><?php add_edit_hallazgo(481,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6095,6096,6099'); ?>"><input type="hidden" name="formato" value="481"><tr><td colspan='2'><?php submit_formato(481,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>