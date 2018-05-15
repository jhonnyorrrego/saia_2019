<html><title>.:EDITAR TRANSFERENCIA DOCUMENTAL:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">TRANSFERENCIA DOCUMENTAL</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_transferencia_doc" value="<?php echo(mostrar_valor_campo('idft_transferencia_doc',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',343,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(343,3992,$_REQUEST['iddoc']);?></tr><tr id="tr_expediente_vinculado">
                     <td class="encabezado" width="20%" title="">TRANSFERENCIA VINCULADA*</td>
                     <?php guardar_expedientes_add(343,3995,$_REQUEST['iddoc']);?></tr><tr id="tr_oficina_productora">
								<td class="encabezado" width="20%" title="">OFICINA PRODUCTORA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(343,3997,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_oficina_productora" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="oficina_productora" id="oficina_productora"   value="<?php cargar_seleccionados(343,3997,1,$_REQUEST['iddoc']);?>" ><div id="esperando_oficina_productora">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_oficina_productora" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_oficina_productora=new dhtmlXTreeObject("treeboxbox_oficina_productora","100%","100%",0);
								tree_oficina_productora.setImagePath("../../imgs/");
								tree_oficina_productora.enableIEImageFix(true);tree_oficina_productora.enableCheckBoxes(1);
									tree_oficina_productora.enableRadioButtons(true);tree_oficina_productora.setOnLoadingStart(cargando_oficina_productora);
								tree_oficina_productora.setOnLoadingEnd(fin_cargando_oficina_productora);tree_oficina_productora.enableSmartXMLParsing(true);tree_oficina_productora.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);tree_oficina_productora.setOnCheckHandler(onNodeSelect_oficina_productora);
									function onNodeSelect_oficina_productora(nodeId) {
										valor_destino=document.getElementById("oficina_productora");
										if(tree_oficina_productora.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_oficina_productora.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_oficina_productora() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_oficina_productora"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_oficina_productora() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_oficina_productora"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(343,3997,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_oficina_productora.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',343,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_anexos">
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=343&idcampo=3999" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_entregado_por">
								<td class="encabezado" width="20%" title="">ENTREGADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(343,4000,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='4'  type="text" id="stext_entregado_por" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="entregado_por" id="entregado_por"   value="<?php cargar_seleccionados(343,4000,1,$_REQUEST['iddoc']);?>" ><div id="esperando_entregado_por">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_entregado_por" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","100%","100%",0);
								tree_entregado_por.setImagePath("../../imgs/");
								tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
									tree_entregado_por.enableRadioButtons(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
								tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
									function onNodeSelect_entregado_por(nodeId) {
										valor_destino=document.getElementById("entregado_por");
										if(tree_entregado_por.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_entregado_por.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_entregado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_entregado_por"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_entregado_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_entregado_por"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(343,4000,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_entregado_por.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_recibido_por">
								<td class="encabezado" width="20%" title="">RECIBIDO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(343,4001,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_recibido_por" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="recibido_por" id="recibido_por"   value="<?php cargar_seleccionados(343,4001,1,$_REQUEST['iddoc']);?>" ><div id="esperando_recibido_por">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_recibido_por" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","100%","100%",0);
								tree_recibido_por.setImagePath("../../imgs/");
								tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
									tree_recibido_por.enableRadioButtons(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
								tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
									function onNodeSelect_recibido_por(nodeId) {
										valor_destino=document.getElementById("recibido_por");
										if(tree_recibido_por.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_recibido_por.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_recibido_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_recibido_por"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_recibido_por() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_recibido_por"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(343,4001,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_recibido_por.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_transferir_a">
                     <td class="encabezado" width="20%" title="">TRANSFERIR A*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(343,4002,$_REQUEST['iddoc']);?></td></tr><?php validacion_js_transferencia(343,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3997'); ?>"><input type="hidden" name="formato" value="343"><tr><td colspan='2'><?php submit_formato(343,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("343-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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