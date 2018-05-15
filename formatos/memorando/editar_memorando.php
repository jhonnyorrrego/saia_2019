<html><title>.:EDITAR COMUNICACI&Oacute;N INTERNA:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">COMUNICACIÓN INTERNA</td></tr><input type="hidden" name="expediente_serie" value="<?php echo(mostrar_valor_campo('expediente_serie',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_memorando" value="<?php echo(mostrar_valor_campo('idft_memorando',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',2,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_memorando">
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(2,19,$_REQUEST['iddoc']);?></tr><tr id="tr_serie_idserie">
								<td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(2,28,'4',$_REQUEST['iddoc']);?></div><br/><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="<?php cargar_seleccionados(2,28,1,$_REQUEST['iddoc']);?>" ><div id="esperando_serie_idserie">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_serie_idserie" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_serie_idserie=new dhtmlXTreeObject("treeboxbox_serie_idserie","100%","100%",0);
								tree_serie_idserie.setImagePath("../../imgs/");
								tree_serie_idserie.enableIEImageFix(true);tree_serie_idserie.enableCheckBoxes(1);
									tree_serie_idserie.enableRadioButtons(true);tree_serie_idserie.setOnLoadingStart(cargando_serie_idserie);
								tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.setXMLAutoLoading("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");tree_serie_idserie.loadXML("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1",checkear_arbol);tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
									function onNodeSelect_serie_idserie(nodeId) {
										valor_destino=document.getElementById("serie_idserie");
										if(tree_serie_idserie.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_serie_idserie.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_serie_idserie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_idserie"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_serie_idserie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_idserie"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(2,28,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_serie_idserie.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_destino">
								<td class="encabezado" width="20%" title="">DESTINO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(2,21,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_destino" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="2000"  class="required"  name="destino" id="destino"   value="<?php cargar_seleccionados(2,21,1,$_REQUEST['iddoc']);?>" ><div id="esperando_destino">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_destino" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
								tree_destino.setImagePath("../../imgs/");
								tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
									tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
								tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_destino.setOnCheckHandler(onNodeSelect_destino);

									function onNodeSelect_destino(nodeId){
										valor_destino=document.getElementById("destino");
										destinos=tree_destino.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_destino.getAllSubItems(vector[i]);
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
									}function fin_cargando_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_destino"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_destino"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(2,21,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_destino.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_copia">
								<td class="encabezado" width="20%" title="">CON COPIA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(2,22,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_copia" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="2000"  name="copia" id="copia"   value="<?php cargar_seleccionados(2,22,1,$_REQUEST['iddoc']);?>" ><div id="esperando_copia">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_copia" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_copia=new dhtmlXTreeObject("treeboxbox_copia","100%","100%",0);
								tree_copia.setImagePath("../../imgs/");
								tree_copia.enableIEImageFix(true);tree_copia.enableCheckBoxes(1);
									tree_copia.enableThreeStateCheckboxes(1);tree_copia.setOnLoadingStart(cargando_copia);
								tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.enableSmartXMLParsing(true);tree_copia.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_copia.setOnCheckHandler(onNodeSelect_copia);

									function onNodeSelect_copia(nodeId){
										valor_destino=document.getElementById("copia");
										destinos=tree_copia.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_copia.getAllSubItems(vector[i]);
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
									}function fin_cargando_copia() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_copia() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(2,22,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_copia.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_asunto">
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(mostrar_valor_campo('asunto',2,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_contenido">
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_avanzado required"><?php echo(mostrar_valor_campo('contenido',2,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_despedida">
                     <td class="encabezado" width="20%" title="">DESPEDIDA*</td>
                     <?php despedida(2,25,$_REQUEST['iddoc']);?></tr><tr id="tr_iniciales">
                     <td class="encabezado" width="20%" title="">INICIALES DE QUIEN PREPARO EL MEMORANDO*</td>
                     <?php iniciales(2,26,$_REQUEST['iddoc']);?></tr><tr id="tr_anexos">
                     <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=2&idcampo=32" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_anexos_fisicos">
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td>
                     <?php anexos_fisicos(2,27,$_REQUEST['iddoc']);?></tr><tr id="tr_email_aprobar" >
                     <td class="encabezado" width="20%" title="">APROBAR FUERA DE SAIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(2,5176,$_REQUEST['iddoc']);?></td></tr><?php mostrar_imagenes(2,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('23'); ?>"><input type="hidden" name="formato" value="2"><tr><td colspan='2'><?php submit_formato(2,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("2-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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