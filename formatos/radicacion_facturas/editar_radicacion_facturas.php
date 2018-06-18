<html><title>.:EDITAR RADICACI&Oacute;N DE FACTURAS:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RADICACIÓN DE FACTURAS</td></tr><input type="hidden" name="fecha_pago" value="<?php echo(mostrar_valor_campo('fecha_pago',473,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="observaciones_check" value="<?php echo(mostrar_valor_campo('observaciones_check',473,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',473,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_radicacion_facturas" value="<?php echo(mostrar_valor_campo('idft_radicacion_facturas',473,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',473,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(473,5960,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',473,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',473,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_radicado">
                     <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='1'  type="text" size="100" id="fecha_radicado" name="fecha_radicado"  value="<?php echo(mostrar_valor_campo('fecha_radicado',473,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_numero_radicado"><td class="encabezado" width="20%" title="">N&Uacute;MERO DE RADICADO*</td><?php mostrar_radicado_factura(473,5964,$_REQUEST['iddoc']);?></tr><tr id="tr_natural_juridica">
                   <td class="encabezado" width="20%" title="">PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="natural_juridica" id="natural_juridica" value="<?php echo(mostrar_valor_campo('natural_juridica',473,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("5965",@$_REQUEST["iddoc"]); ?></td>
                  </tr><input type="hidden" name="estado" value="<?php echo(mostrar_valor_campo('estado',473,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_emision">
                       <td class="encabezado" width="20%" title="">FECHA DE EMISI&Oacute;N DE LA FACTURA</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  name="fecha_emision" id="fecha_emision" tipo="fecha" value="<?php mostrar_valor_campo('fecha_emision',473,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_emision","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_num_factura">
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="num_factura" name="num_factura"  value="<?php echo(mostrar_valor_campo('num_factura',473,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N SERVICIO O PRODUCTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(mostrar_valor_campo('descripcion',473,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_num_folios">
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="num_folios" name="num_folios"  value="<?php echo(mostrar_valor_campo('num_folios',473,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_anexos_fisicos">
                     <td class="encabezado" width="20%" title="">ANEXOS F&Iacute;SICOS</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="anexos_fisicos" id="anexos_fisicos" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(mostrar_valor_campo('anexos_fisicos',473,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_anexos_digitales">
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=473&idcampo=5972" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_copia_electronica">
								<td class="encabezado" width="20%" title="">COPIA ELECTR&Oacute;NICA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(473,5973,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='8'  type="text" id="stext_copia_electronica" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="copia_electronica" id="copia_electronica"   value="<?php cargar_seleccionados(473,5973,1,$_REQUEST['iddoc']);?>" ><div id="esperando_copia_electronica">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_copia_electronica" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_copia_electronica=new dhtmlXTreeObject("treeboxbox_copia_electronica","100%","100%",0);
								tree_copia_electronica.setImagePath("../../imgs/");
								tree_copia_electronica.enableIEImageFix(true);tree_copia_electronica.enableCheckBoxes(1);
									tree_copia_electronica.enableThreeStateCheckboxes(1);tree_copia_electronica.setOnLoadingStart(cargando_copia_electronica);
								tree_copia_electronica.setOnLoadingEnd(fin_cargando_copia_electronica);tree_copia_electronica.enableSmartXMLParsing(true);tree_copia_electronica.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_copia_electronica.setOnCheckHandler(onNodeSelect_copia_electronica);

									function onNodeSelect_copia_electronica(nodeId){
										valor_destino=document.getElementById("copia_electronica");
										destinos=tree_copia_electronica.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_copia_electronica.getAllSubItems(vector[i]);
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
									}function fin_cargando_copia_electronica() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_electronica")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_electronica")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_electronica"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_copia_electronica() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_electronica")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_electronica")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_electronica"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(473,5973,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_copia_electronica.setCheck(vector2[m],true);
										}
									}
</script></td></tr><?php digitalizar_formato(473,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('5965'); ?>"><input type="hidden" name="formato" value="473"><tr><td colspan='2'><?php submit_formato(473,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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