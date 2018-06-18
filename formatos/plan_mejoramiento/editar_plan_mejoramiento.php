<html><title>.:EDITAR PLAN DE MEJORAMIENTO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PLAN DE MEJORAMIENTO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',480,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',480,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(480,6066,$_REQUEST['iddoc']);?></tr><tr id="tr_tipo_plan" >
                     <td class="encabezado" width="20%" title="">TIPO DE PLAN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(480,6067,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',480,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_plan_mejoramiento" value="<?php echo(mostrar_valor_campo('idft_plan_mejoramiento',480,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_suscripcion"><td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION*</td><?php fecha_formato(480,6070,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_informe">
                       <td class="encabezado" width="20%" title="">FECHA RECEPCI&Oacute;N INFORME FINAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_informe" id="fecha_informe" tipo="fecha" value="<?php mostrar_valor_campo('fecha_informe',480,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_informe","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_adjuntos">
                     <td class="encabezado" width="20%" title="Anexar informes auditoria">ANEXAR INFORMES AUDITORIA</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=480&idcampo=6072" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_tipo_auditoria">
                     <td class="encabezado" width="20%" title="Plan de Mejoramiento Institucional, Funcional o Individual">TIPO DE AUDITORIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(480,6073,$_REQUEST['iddoc']);?></td></tr><tr id="tr_auditor">
                     <td class="encabezado" width="20%" title="">AUDITOR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(480,6074,$_REQUEST['iddoc']);?></td></tr><tr id="tr_descripcion_plan">
                     <td class="encabezado" width="20%" title="Realizar una breve descripci&oacute;n del alcance de la Auditor&iacute;a o l&iacute;nea de auditor&iacute;a realizada">DESCRIPCION</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_plan" id="descripcion_plan" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion_plan',480,$_REQUEST['iddoc'])); ?></textarea></td></tr><input type="hidden" name="estado_plan_mejoramiento" value="<?php echo(mostrar_valor_campo('estado_plan_mejoramiento',480,$_REQUEST['iddoc'])); ?>"><tr id="tr_periodo_evaluado">
                     <td class="encabezado" width="20%" title="Periodo que cubri&oacute; la auditor&iacute;a">PERIODO EVALUADO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="periodo_evaluado" name="periodo_evaluado"  value="<?php echo(mostrar_valor_campo('periodo_evaluado',480,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_objetivo">
                     <td class="encabezado" width="20%" title="">OBJETIVO GENERAL*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo',480,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_objetivos_especificos">
                     <td class="encabezado" width="20%" title="">OBJETIVOS ESPECIFICOS</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="objetivos_especificos" id="objetivos_especificos" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('objetivos_especificos',480,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',480,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_revisado">
								<td class="encabezado" width="20%" title="">REVISADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(480,6084,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='8'  type="text" id="stext_revisado" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  class="required"  name="revisado" id="revisado"   value="<?php cargar_seleccionados(480,6084,1,$_REQUEST['iddoc']);?>" ><div id="esperando_revisado">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_revisado" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
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
										vector2="<?php cargar_seleccionados(480,6084,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_revisado.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_aprobado">
								<td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(480,6085,'',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_aprobado" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  class="required"  name="aprobado" id="aprobado"   value="<?php cargar_seleccionados(480,6085,1,$_REQUEST['iddoc']);?>" ><div id="esperando_aprobado">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_aprobado" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
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
										vector2="<?php cargar_seleccionados(480,6085,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_aprobado.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',480,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="version" value="<?php echo(mostrar_valor_campo('version',480,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('6070,6076'); ?>"><input type="hidden" name="formato" value="480"><tr><td colspan='2'><?php submit_formato(480,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>