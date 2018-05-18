<html><title>.:EDITAR CORREO SAIA:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CORREO SAIA</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',348,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(348,4038,$_REQUEST['iddoc']);?></tr><tr id="tr_asunto">
                     <td class="encabezado" width="20%" title="Asunto del correo">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(mostrar_valor_campo('asunto',348,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_fecha_oficio_entrada">
                     <td class="encabezado" width="20%" title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="fecha_oficio_entrada" name="fecha_oficio_entrada"  value="<?php echo(mostrar_valor_campo('fecha_oficio_entrada',348,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_de">
                     <td class="encabezado" width="20%" title="Remitente del correo">DE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="de" name="de"  value="<?php echo(mostrar_valor_campo('de',348,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_para">
                     <td class="encabezado" width="20%" title="">PARA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='4'  type="text" size="100" id="para" name="para"  value="<?php echo(mostrar_valor_campo('para',348,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_transferencia_correo">
								<td class="encabezado" width="20%" title="">TRANSFERIR</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(348,4084,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_transferencia_correo" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  name="transferencia_correo" id="transferencia_correo"   value="<?php cargar_seleccionados(348,4084,1,$_REQUEST['iddoc']);?>" ><div id="esperando_transferencia_correo">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_transferencia_correo" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_transferencia_correo=new dhtmlXTreeObject("treeboxbox_transferencia_correo","100%","100%",0);
								tree_transferencia_correo.setImagePath("../../imgs/");
								tree_transferencia_correo.enableIEImageFix(true);tree_transferencia_correo.enableCheckBoxes(1);
									tree_transferencia_correo.enableRadioButtons(true);tree_transferencia_correo.setOnLoadingStart(cargando_transferencia_correo);
								tree_transferencia_correo.setOnLoadingEnd(fin_cargando_transferencia_correo);tree_transferencia_correo.enableSmartXMLParsing(true);tree_transferencia_correo.loadXML("../../test.php?rol=1",checkear_arbol);tree_transferencia_correo.setOnCheckHandler(onNodeSelect_transferencia_correo);
									function onNodeSelect_transferencia_correo(nodeId) {
										valor_destino=document.getElementById("transferencia_correo");
										if(tree_transferencia_correo.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_transferencia_correo.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_transferencia_correo() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_transferencia_correo")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_transferencia_correo")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_transferencia_correo"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_transferencia_correo() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_transferencia_correo")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_transferencia_correo")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_transferencia_correo"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(348,4084,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_transferencia_correo.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_copia_correo">
								<td class="encabezado" width="20%" title="">CON COPIA</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(348,4085,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='6'  type="text" id="stext_copia_correo" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="copia_correo" id="copia_correo"   value="<?php cargar_seleccionados(348,4085,1,$_REQUEST['iddoc']);?>" ><div id="esperando_copia_correo">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_copia_correo" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_copia_correo=new dhtmlXTreeObject("treeboxbox_copia_correo","100%","100%",0);
								tree_copia_correo.setImagePath("../../imgs/");
								tree_copia_correo.enableIEImageFix(true);tree_copia_correo.enableCheckBoxes(1);
									tree_copia_correo.enableThreeStateCheckboxes(1);tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
								tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);tree_copia_correo.enableSmartXMLParsing(true);tree_copia_correo.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);

									function onNodeSelect_copia_correo(nodeId){
										valor_destino=document.getElementById("copia_correo");
										destinos=tree_copia_correo.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_copia_correo.getAllSubItems(vector[i]);
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
									}function fin_cargando_copia_correo() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_copia_correo() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(348,4085,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_copia_correo.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_comentario">
                     <td class="encabezado" width="20%" title="Comentario del correo">COMENTARIO</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="comentario" id="comentario" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('comentario',348,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="anexos" value="<?php echo(mostrar_valor_campo('anexos',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_correo_saia" value="<?php echo(mostrar_valor_campo('idft_correo_saia',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',348,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('4031'); ?>"><input type="hidden" name="formato" value="348"><tr><td colspan='2'><?php submit_formato(348,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>