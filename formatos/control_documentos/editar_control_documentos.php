<html><title>.:EDITAR SOLICITUD DE ELABORACI&Oacute;N, MODIFICACI&Oacute;N, ELIMINACI&Oacute;N DE DOCUMENTOS:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script>
			<?php include_once("../../anexosdigitales/funciones_archivo.php"); ?>
			<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
			<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE ELABORACIÓN, MODIFICACIÓN, ELIMINACIÓN DE DOCUMENTOS</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idformato_calidad" value="<?php echo(mostrar_valor_campo('idformato_calidad',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="iddocumento_calidad" value="<?php echo(mostrar_valor_campo('iddocumento_calidad',498,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(498,6330,$_REQUEST['iddoc']);?></tr><tr id="tr_tipo_solicitud" >
                     <td class="encabezado" width="20%" title="">TIPO SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6332,$_REQUEST['iddoc']);?></td></tr><tr id="tr_secretaria">
								<td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(498,6333,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_secretaria" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="secretaria" id="secretaria"   value="<?php cargar_seleccionados(498,6333,1,$_REQUEST['iddoc']);?>" ><div id="esperando_secretaria">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_secretaria" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_secretaria=new dhtmlXTreeObject("treeboxbox_secretaria","100%","100%",0);
								tree_secretaria.setImagePath("../../imgs/");
								tree_secretaria.enableIEImageFix(true);tree_secretaria.enableCheckBoxes(1);
									tree_secretaria.enableThreeStateCheckboxes(1);tree_secretaria.setOnLoadingStart(cargando_secretaria);
								tree_secretaria.setOnLoadingEnd(fin_cargando_secretaria);tree_secretaria.enableSmartXMLParsing(true);tree_secretaria.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);
									tree_secretaria.setOnCheckHandler(onNodeSelect_secretaria);

									function onNodeSelect_secretaria(nodeId){
										valor_destino=document.getElementById("secretaria");
										destinos=tree_secretaria.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_secretaria.getAllSubItems(vector[i]);
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
									}function fin_cargando_secretaria() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_secretaria")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_secretaria")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_secretaria"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_secretaria() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_secretaria")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_secretaria")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_secretaria"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(498,6333,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_secretaria.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_listado_procesos">
                     <td class="encabezado" width="20%" title="">PROCESO/SUBPROCESO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6334,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo_documento" >
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6338,$_REQUEST['iddoc']);?></td></tr><tr id="tr_serie_doc_control">
								<td class="encabezado" width="20%" title="">SERIE DOCUMENTAL</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(498,6339,'1',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_serie_doc_control" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="serie_doc_control" id="serie_doc_control"   value="<?php cargar_seleccionados(498,6339,1,$_REQUEST['iddoc']);?>" ><div id="esperando_serie_doc_control">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_serie_doc_control" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_serie_doc_control=new dhtmlXTreeObject("treeboxbox_serie_doc_control","100%","100%",0);
								tree_serie_doc_control.setImagePath("../../imgs/");
								tree_serie_doc_control.enableIEImageFix(true);tree_serie_doc_control.enableCheckBoxes(1);
									tree_serie_doc_control.enableRadioButtons(true);tree_serie_doc_control.setOnLoadingStart(cargando_serie_doc_control);
								tree_serie_doc_control.setOnLoadingEnd(fin_cargando_serie_doc_control);tree_serie_doc_control.enableSmartXMLParsing(true);tree_serie_doc_control.loadXML("../../test_serie_funcionario.php",checkear_arbol);tree_serie_doc_control.setOnCheckHandler(onNodeSelect_serie_doc_control);
									function onNodeSelect_serie_doc_control(nodeId) {
										valor_destino=document.getElementById("serie_doc_control");
										if(tree_serie_doc_control.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_serie_doc_control.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_serie_doc_control() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_doc_control")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_doc_control")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_doc_control"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_serie_doc_control() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_doc_control")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_doc_control")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_doc_control"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(498,6339,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_serie_doc_control.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_otros_documentos" >
                     <td class="encabezado" width="20%" title="">OTROS DOCUMENTOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6340,$_REQUEST['iddoc']);?></td></tr><tr id="tr_almacenamiento">
                  <td class="encabezado" width="20%" title="">ALMACENAMIENTO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6341,$_REQUEST['iddoc']);?></td></tr><tr id="tr_nombre_documento">
                     <td class="encabezado" width="20%" title="">NOMBRE DOCUMENTO</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='3'  type="text" size="100" id="nombre_documento" name="nombre_documento"  value="<?php echo(mostrar_valor_campo('nombre_documento',498,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_documento_calidad">
								<td class="encabezado" width="20%" title="">DOCUMENTO DE CALIDAD VINCULADO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(498,6343,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='4'  type="text" id="stext_documento_calidad" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="documento_calidad" id="documento_calidad"   value="<?php cargar_seleccionados(498,6343,1,$_REQUEST['iddoc']);?>" ><div id="esperando_documento_calidad">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_documento_calidad" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","100%","100%",0);
								tree_documento_calidad.setImagePath("../../imgs/");
								tree_documento_calidad.enableIEImageFix(true);tree_documento_calidad.enableCheckBoxes(1);
									tree_documento_calidad.enableRadioButtons(true);tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
								tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);tree_documento_calidad.enableSmartXMLParsing(true);tree_documento_calidad.loadXML("test_documentos_calidad.php",checkear_arbol);tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
									function onNodeSelect_documento_calidad(nodeId) {
										valor_destino=document.getElementById("documento_calidad");
										if(tree_documento_calidad.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_documento_calidad.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_documento_calidad() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_documento_calidad")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_documento_calidad")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_documento_calidad"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_documento_calidad() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_documento_calidad")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_documento_calidad")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_documento_calidad"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(498,6343,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_documento_calidad.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_justificacion">
                     <td class="encabezado" width="20%" title="">JUSTIFICACION*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="justificacion" id="justificacion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('justificacion',498,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_propuesta">
                     <td class="encabezado" width="20%" title="">PROPUESTA</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="propuesta" id="propuesta" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('propuesta',498,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_anexo_formato">
                     <td class="encabezado" width="20%" title="">ANEXO FORMATO</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=498&idcampo=6346" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_revisado">
								<td class="encabezado" width="20%" title="">REVISADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(498,6347,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='8'  type="text" id="stext_revisado" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="revisado" id="revisado"   value="<?php cargar_seleccionados(498,6347,1,$_REQUEST['iddoc']);?>" ><div id="esperando_revisado">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_revisado" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_revisado=new dhtmlXTreeObject("treeboxbox_revisado","100%","100%",0);
								tree_revisado.setImagePath("../../imgs/");
								tree_revisado.enableIEImageFix(true);tree_revisado.enableCheckBoxes(1);
									tree_revisado.enableRadioButtons(true);tree_revisado.setOnLoadingStart(cargando_revisado);
								tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_revisado.setOnCheckHandler(onNodeSelect_revisado);
									function onNodeSelect_revisado(nodeId) {
										valor_destino=document.getElementById("revisado");
										if(tree_revisado.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_revisado.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_revisado() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_revisado")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_revisado")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_revisado"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_revisado() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_revisado")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_revisado")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_revisado"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(498,6347,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_revisado.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_aprobado">
								<td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(498,6348,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_aprobado" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="aprobado" id="aprobado"   value="<?php cargar_seleccionados(498,6348,1,$_REQUEST['iddoc']);?>" ><div id="esperando_aprobado">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_aprobado" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_aprobado=new dhtmlXTreeObject("treeboxbox_aprobado","100%","100%",0);
								tree_aprobado.setImagePath("../../imgs/");
								tree_aprobado.enableIEImageFix(true);tree_aprobado.enableCheckBoxes(1);
									tree_aprobado.enableRadioButtons(true);tree_aprobado.setOnLoadingStart(cargando_aprobado);
								tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
									function onNodeSelect_aprobado(nodeId) {
										valor_destino=document.getElementById("aprobado");
										if(tree_aprobado.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_aprobado.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_aprobado() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_aprobado"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_aprobado() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_aprobado"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(498,6348,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_aprobado.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="idft_control_documentos" value="<?php echo(mostrar_valor_campo('idft_control_documentos',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',498,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_confirmacion" value="<?php echo(mostrar_valor_campo('fecha_confirmacion',498,$_REQUEST['iddoc'])); ?>"><?php add_edit_control_documentos(498,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6332'); ?>"><input type="hidden" name="formato" value="498"><tr><td colspan='2'><?php submit_formato(498,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("498-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
                var upload_url = '../../dropzone/cargar_archivos_formato.php';
                var mensaje = 'Arrastre aquí los archivos';
                Dropzone.autoDiscover = false;
                var lista_archivos = new Object();
                $(document).ready(function () {
                    Dropzone.autoDiscover = false;
                    $('.saia_dz').each(function () {
                        var idformato = $(this).attr('data-idformato');
                    	var idcampo = $(this).attr('id');
                    	var paramName = $(this).attr('data-nombre-campo');
                    	var idcampoFormato = $(this).attr('data-idcampo-formato');
                    	var extensiones = $(this).attr('data-extensiones');
                    	var multiple_text = $(this).attr('data-multiple');
                    	var multiple = false;
                    	var form_uuid = $('#form_uuid').val();
                    	var maxFiles = 1;
                    	if(multiple_text == 'multiple') {
                    		multiple = true;
                    		maxFiles = 10;
                    	}
                        var opciones = {
                        	ignoreHiddenFiles : true,
                        	maxFiles : maxFiles,
                        	acceptedFiles: extensiones,
                       		addRemoveLinks: true,
                       		dictRemoveFile: 'Quitar anexo',
                       		dictMaxFilesExceeded : 'No puede subir mas archivos',
                       		dictResponseError : 'El servidor respondió con código {{statusCode}}',
                    		uploadMultiple: multiple,
                        	url: upload_url,
                        	paramName : paramName,
                        	params : {
                            	idformato : idformato,
                            	idcampo_formato : idcampoFormato,
                            	nombre_campo : paramName,
                            	uuid : form_uuid
                            },
                                removedfile : function(file) {
                                    if(lista_archivos && lista_archivos[file.upload.uuid]) {
                                    	$.ajax({
                                    		url: upload_url,
                                    		type: 'POST',
                                    		data: {
                                        		accion:'eliminar_temporal',
                                            	idformato : idformato,
                                            	idcampo_formato : idcampoFormato,
                                        		archivo: lista_archivos[file.upload.uuid]}
                                    		});
                                    }
                                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                                        file.previewElement.parentNode.removeChild(file.previewElement);
                                    	delete lista_archivos[file.upload.uuid];
                                    	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    }
                                    return this._updateMaxFilesReachedClass();
                                },
                                success : function(file, response) {
                                	for (var key in response) {
                                    	if(Array.isArray(response[key])) {
                                        	for(var i=0; i < response[key].length; i++) {
                                        		archivo=response[key][i];
                                            	if(archivo.original_name == file.upload.filename) {
                                            		lista_archivos[file.upload.uuid] = archivo.id;
                                            	}
                                        	}
                                    	} else {
                                    		if(response[key].original_name == file.upload.filename) {
                                        		lista_archivos[file.upload.uuid] = response[key].id;
                                    		}
                                    	}
                                	}
                                	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                                        $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                                    }
                                }
                        };
                        $(this).dropzone(opciones);
                        $(this).addClass('dropzone');
                    });
                });</script>
		</html><?php include_once("../librerias/footer_plantilla.php");?>