<html><title>.:EDITAR SOLICITUD PERMISO P1:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD PERMISO P1</td></tr><tr id="tr_clase_permiso" >
                     <td class="encabezado" width="20%" title="">CLASE DE PERMISO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(512,6680,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_solicitud_permiso_p1" value="<?php echo(mostrar_valor_campo('idft_solicitud_permiso_p1',512,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',512,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(512,6660,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',512,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',512,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_solicitud">
                    <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='1'  type="text" readonly="true" name="fecha_solicitud"  class="required dateISO"  id="fecha_solicitud" value="<?php mostrar_valor_campo('fecha_solicitud',512,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_solicitud","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr id="tr_funcionario">
								<td class="encabezado" width="20%" title="">FUNCIONARIO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(512,6663,'5
',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_funcionario" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="funcionario" id="funcionario"   value="<?php cargar_seleccionados(512,6663,1,$_REQUEST['iddoc']);?>" ><div id="esperando_funcionario">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_funcionario" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {
									browserType= "gecko"
								}
								tree_funcionario=new dhtmlXTreeObject("treeboxbox_funcionario","100%","100%",0);
								tree_funcionario.setImagePath("../../imgs/");
								tree_funcionario.enableIEImageFix(true);tree_funcionario.enableCheckBoxes(1);
									tree_funcionario.enableRadioButtons(true);tree_funcionario.setOnLoadingStart(cargando_funcionario);
								tree_funcionario.setOnLoadingEnd(fin_cargando_funcionario);tree_funcionario.enableSmartXMLParsing(true);tree_funcionario.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);tree_funcionario.setOnCheckHandler(onNodeSelect_funcionario);
									function onNodeSelect_funcionario(nodeId) {
										valor_destino=document.getElementById("funcionario");
										if(tree_funcionario.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_funcionario.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_funcionario() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_funcionario")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_funcionario")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_funcionario"]');
									}
									document.poppedLayer.style.display = "none";
								}

								function cargando_funcionario() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_funcionario")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_funcionario")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_funcionario"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(512,6663,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_funcionario.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_tipo_permiso" >
                     <td class="encabezado" width="20%" title="">TIPO DE PERMISO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(512,6656,$_REQUEST['iddoc']);?></td></tr><tr id="tr_fecha_permiso">
                    <td class="encabezado" width="20%" title="">FECHA DEL PERMISO*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='3'  type="text" readonly="true" name="fecha_permiso"  class="required dateISO"  id="fecha_permiso" value="<?php mostrar_valor_campo('fecha_permiso',512,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_permiso","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr id="tr_salida_porteria">
                     <td class="encabezado" width="20%" title="">PORTERIA DE SALIDA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(512,6665,$_REQUEST['iddoc']);?></td></tr><tr id="tr_compensacion" >
                     <td class="encabezado" width="20%" title="">COMPENSACI&Oacute;N DEL PERMISO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(512,6666,$_REQUEST['iddoc']);?></td></tr><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="">DESCRIBA EL PERMISO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion',512,$_REQUEST['iddoc'])); ?></textarea></td></tr><tr id="tr_anexo_formato">
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=512&idcampo=6652" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><input type="hidden" name="campo_descripcion" value="<?php echo('6656,6663,6680'); ?>"><input type="hidden" name="formato" value="512"><tr><td colspan='2'><?php submit_formato(512,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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