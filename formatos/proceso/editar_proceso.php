<html><title>.:EDITAR CARACTERIZACI&Oacute;N DE PROCESO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CARACTERIZACIÓN DE PROCESO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_aprobacion_rie" value="<?php echo(mostrar_valor_campo('fecha_aprobacion_rie',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_revision_riesg" value="<?php echo(mostrar_valor_campo('fecha_revision_riesg',477,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(477,6006,$_REQUEST['iddoc']);?></tr><tr id="tr_codigo">
                     <td class="encabezado" width="20%" title="Hace referencia al Codigo del Proceso (Campos Alfa Numericos)">C&Oacute;DIGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(mostrar_valor_campo('codigo',477,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre del proceso">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',477,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_version">
                     <td class="encabezado" width="20%" title="Version del Documento">VERSI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="version" name="version"  value="<?php echo(mostrar_valor_campo('version',477,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_vigencia">
                     <td class="encabezado" width="20%" title="Vigencia del proceso">VIGENCIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="vigencia" name="vigencia"  value="<?php echo(mostrar_valor_campo('vigencia',477,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(477,6011,$_REQUEST['iddoc']);?></td></tr><tr id="tr_responsable">
								<td class="encabezado" width="20%" title="Responsable o responsables del Proceso">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6013,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_responsable" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="responsable" id="responsable"   value="<?php cargar_seleccionados(477,6013,1,$_REQUEST['iddoc']);?>" ><div id="esperando_responsable">
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
										vector2="<?php cargar_seleccionados(477,6013,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_responsable.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_lider_proceso">
								<td class="encabezado" width="20%" title="Funcionario que queda encargado para liderar el proceso">L&Iacute;DER DEL PROCESO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6014,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='6'  type="text" id="stext_lider_proceso" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="lider_proceso" id="lider_proceso"   value="<?php cargar_seleccionados(477,6014,1,$_REQUEST['iddoc']);?>" ><div id="esperando_lider_proceso">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_lider_proceso" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_lider_proceso=new dhtmlXTreeObject("treeboxbox_lider_proceso","100%","100%",0);
								tree_lider_proceso.setImagePath("../../imgs/");
								tree_lider_proceso.enableIEImageFix(true);tree_lider_proceso.enableCheckBoxes(1);
									tree_lider_proceso.enableRadioButtons(true);tree_lider_proceso.setOnLoadingStart(cargando_lider_proceso);
								tree_lider_proceso.setOnLoadingEnd(fin_cargando_lider_proceso);tree_lider_proceso.enableSmartXMLParsing(true);tree_lider_proceso.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_lider_proceso.setOnCheckHandler(onNodeSelect_lider_proceso);
									function onNodeSelect_lider_proceso(nodeId) {
										valor_destino=document.getElementById("lider_proceso");
										if(tree_lider_proceso.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_lider_proceso.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_lider_proceso() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_lider_proceso")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_lider_proceso")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_lider_proceso"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_lider_proceso() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_lider_proceso")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_lider_proceso")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_lider_proceso"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(477,6014,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_lider_proceso.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_objetivo">
                     <td class="encabezado" width="20%" title="Objetivo Principal del Proceso">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo',477,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_alcance">
                     <td class="encabezado" width="20%" title="Este es el alcance del proceso la delimitacion">ALCANCE*</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="alcance" id="alcance" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('alcance',477,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_anexos">
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=477&idcampo=6017" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><input type="hidden" name="idft_proceso" value="<?php echo(mostrar_valor_campo('idft_proceso',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',477,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="listado_maestro_registros" value="<?php echo(mostrar_valor_campo('listado_maestro_registros',477,$_REQUEST['iddoc'])); ?>"><tr id="tr_revisado_por">
								<td class="encabezado" width="20%" title="">REVISADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6026,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='10'  type="text" id="stext_revisado_por" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  class="required"  name="revisado_por" id="revisado_por"   value="<?php cargar_seleccionados(477,6026,1,$_REQUEST['iddoc']);?>" ><div id="esperando_revisado_por">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_revisado_por" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_revisado_por=new dhtmlXTreeObject("treeboxbox_revisado_por","100%","100%",0);
								tree_revisado_por.setImagePath("../../imgs/");
								tree_revisado_por.enableIEImageFix(true);tree_revisado_por.enableCheckBoxes(1);
									tree_revisado_por.enableRadioButtons(true);tree_revisado_por.setOnLoadingStart(cargando_revisado_por);
								tree_revisado_por.setOnLoadingEnd(fin_cargando_revisado_por);tree_revisado_por.enableSmartXMLParsing(true);tree_revisado_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_revisado_por.setOnCheckHandler(onNodeSelect_revisado_por);
									function onNodeSelect_revisado_por(nodeId) {
										valor_destino=document.getElementById("revisado_por");
										if(tree_revisado_por.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_revisado_por.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_revisado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_revisado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_revisado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_revisado_por"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_revisado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_revisado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_revisado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_revisado_por"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(477,6026,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_revisado_por.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_aprobado_por">
								<td class="encabezado" width="20%" title="Nombre y Cargo de quienes Aprueban el documento de Calidad">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6027,'5
',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='11'  type="text" id="stext_aprobado_por" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_aprobado_por.findItem((document.getElementById('stext_aprobado_por').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_aprobado_por.findItem((document.getElementById('stext_aprobado_por').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_aprobado_por.findItem((document.getElementById('stext_aprobado_por').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  class="required"  name="aprobado_por" id="aprobado_por"   value="<?php cargar_seleccionados(477,6027,1,$_REQUEST['iddoc']);?>" ><div id="esperando_aprobado_por">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_aprobado_por" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_aprobado_por=new dhtmlXTreeObject("treeboxbox_aprobado_por","100%","100%",0);
								tree_aprobado_por.setImagePath("../../imgs/");
								tree_aprobado_por.enableIEImageFix(true);tree_aprobado_por.enableCheckBoxes(1);
									tree_aprobado_por.enableRadioButtons(true);tree_aprobado_por.setOnLoadingStart(cargando_aprobado_por);
								tree_aprobado_por.setOnLoadingEnd(fin_cargando_aprobado_por);tree_aprobado_por.enableSmartXMLParsing(true);tree_aprobado_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_aprobado_por.setOnCheckHandler(onNodeSelect_aprobado_por);
									function onNodeSelect_aprobado_por(nodeId) {
										valor_destino=document.getElementById("aprobado_por");
										if(tree_aprobado_por.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_aprobado_por.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_aprobado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_aprobado_por"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_aprobado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_aprobado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_aprobado_por"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(477,6027,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_aprobado_por.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_permisos_acceso">
								<td class="encabezado" width="20%" title="">PERMISOS DE ACCESO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6033,'0',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='12'  type="text" id="stext_permisos_acceso" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="permisos_acceso" id="permisos_acceso"   value="<?php cargar_seleccionados(477,6033,1,$_REQUEST['iddoc']);?>" ><div id="esperando_permisos_acceso">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_permisos_acceso" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_permisos_acceso=new dhtmlXTreeObject("treeboxbox_permisos_acceso","100%","100%",0);
								tree_permisos_acceso.setImagePath("../../imgs/");
								tree_permisos_acceso.enableIEImageFix(true);tree_permisos_acceso.enableCheckBoxes(1);
									tree_permisos_acceso.enableThreeStateCheckboxes(1);tree_permisos_acceso.setOnLoadingStart(cargando_permisos_acceso);
								tree_permisos_acceso.setOnLoadingEnd(fin_cargando_permisos_acceso);tree_permisos_acceso.enableSmartXMLParsing(true);tree_permisos_acceso.loadXML("../../test.php?sin_padre=1",checkear_arbol);
									tree_permisos_acceso.setOnCheckHandler(onNodeSelect_permisos_acceso);

									function onNodeSelect_permisos_acceso(nodeId){
										valor_destino=document.getElementById("permisos_acceso");
										destinos=tree_permisos_acceso.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_permisos_acceso.getAllSubItems(vector[i]);
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
									}function fin_cargando_permisos_acceso() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_permisos_acceso")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_permisos_acceso")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_permisos_acceso"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_permisos_acceso() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_permisos_acceso")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_permisos_acceso")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_permisos_acceso"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(477,6033,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_permisos_acceso.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_dependencias_partici">
								<td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(477,6035,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='13'  type="text" id="stext_dependencias_partici" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="dependencias_partici" id="dependencias_partici"   value="<?php cargar_seleccionados(477,6035,1,$_REQUEST['iddoc']);?>" ><div id="esperando_dependencias_partici">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_dependencias_partici" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_dependencias_partici=new dhtmlXTreeObject("treeboxbox_dependencias_partici","100%","100%",0);
								tree_dependencias_partici.setImagePath("../../imgs/");
								tree_dependencias_partici.enableIEImageFix(true);tree_dependencias_partici.enableCheckBoxes(1);
									tree_dependencias_partici.enableThreeStateCheckboxes(1);tree_dependencias_partici.setOnLoadingStart(cargando_dependencias_partici);
								tree_dependencias_partici.setOnLoadingEnd(fin_cargando_dependencias_partici);tree_dependencias_partici.enableSmartXMLParsing(true);tree_dependencias_partici.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);
									tree_dependencias_partici.setOnCheckHandler(onNodeSelect_dependencias_partici);

									function onNodeSelect_dependencias_partici(nodeId){
										valor_destino=document.getElementById("dependencias_partici");
										destinos=tree_dependencias_partici.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_dependencias_partici.getAllSubItems(vector[i]);
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
									}function fin_cargando_dependencias_partici() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_dependencias_partici")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_dependencias_partici")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_dependencias_partici"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_dependencias_partici() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_dependencias_partici")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_dependencias_partici")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_dependencias_partici"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(477,6035,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_dependencias_partici.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_macroproceso">
                     <td class="encabezado" width="20%" title="">MACRO PROCESO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(477,6036,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="<?php echo('6007,6008'); ?>"><input type="hidden" name="formato" value="477"><tr><td colspan='2'><?php submit_formato(477,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("477-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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