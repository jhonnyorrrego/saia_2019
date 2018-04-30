<html><title>.:EDITAR PROCEDIMIENTO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../formato/funciones.php"); ?>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PROCEDIMIENTO</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(496,6294,$_REQUEST['iddoc']);?></tr><input type="hidden" name="idft_procedimiento" value="<?php echo(mostrar_valor_campo('idft_procedimiento',496,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',496,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',496,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',496,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',496,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_nomina">
                       <td class="encabezado" width="20%" title="">FECHA VIGENCIA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_nomina" id="fecha_nomina" tipo="fecha" value="<?php mostrar_valor_campo('fecha_nomina',496,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_nomina","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_codigo">
                     <td class="encabezado" width="20%" title="Codigo">CODIGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(mostrar_valor_campo('codigo',496,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_version">
                     <td class="encabezado" width="20%" title="Version">VERSION</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="version" name="version"  value="<?php echo(mostrar_valor_campo('version',496,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre del Procedimiento">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',496,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(496,6305,$_REQUEST['iddoc']);?></td></tr><tr id="tr_objetivo">
                     <td class="encabezado" width="20%" title="Objetivo especifico del Procedimiento">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo',496,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_alcance">
                     <td class="encabezado" width="20%" title="Alcance Procedimiento">ALCANCE*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="alcance" id="alcance" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('alcance',496,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_definicion">
                     <td class="encabezado" width="20%" title="Definicion del procedimiento">DEFINICION*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="definicion" id="definicion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('definicion',496,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_dispocisiones_generales">
                     <td class="encabezado" width="20%" title="Disposiciones Generales">DISPOSICIONES GENERALES</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="dispocisiones_generales" id="dispocisiones_generales" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('dispocisiones_generales',496,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_anexos">
                     <td class="encabezado" width="20%" title="Anexos Digitales al Procedimiento">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=496&idcampo=6311" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_acta">
                     <td class="encabezado" width="20%" title="Acta con que fue aprobado el procedimiento">ACTA</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=496&idcampo=6312" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_aprobado_por">
                     <td class="encabezado" width="20%" title="Datos que deben quedar guardados de quien ( Nombre y Cargo de quien Aprueba) o que (Acta administrativa o documento legal) aprueba el documento">DATOS PARA APROBAR EL DOCUMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="3000"   tabindex='11'  type="text" size="100" id="aprobado_por" name="aprobado_por"  value="<?php echo(mostrar_valor_campo('aprobado_por',496,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_secretarias">
								<td class="encabezado" width="20%" title="Secretarias vinculadas">SECRETARIAS VINCULADAS</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(496,6314,'2',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='12'  type="text" id="stext_secretarias" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="<?php cargar_seleccionados(496,6314,1,$_REQUEST['iddoc']);?>" ><div id="esperando_secretarias">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_secretarias" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
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
										vector2="<?php cargar_seleccionados(496,6314,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_secretarias.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="origen_documento" value="<?php echo(mostrar_valor_campo('origen_documento',496,$_REQUEST['iddoc'])); ?>"><?php no_permitir_adicion_formatos_acalidad(496,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6304'); ?>"><input type="hidden" name="formato" value="496"><tr><td colspan='2'><?php submit_formato(496,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("496-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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