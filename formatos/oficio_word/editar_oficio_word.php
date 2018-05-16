<html><title>.:EDITAR DOCUMENTOS EN FORMATO (WORD):.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<?php include_once("../librerias/header_formato.php"); ?>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script>
			<?php include_once("../../anexosdigitales/funciones_archivo.php"); ?>
			<script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script>
			<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DOCUMENTOS EN FORMATO (WORD)</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(400,4802,$_REQUEST['iddoc']);?></tr><tr id="tr_asunto_word">
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto_word" name="asunto_word"  value="<?php echo(mostrar_valor_campo('asunto_word',400,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_tipo_radicado">
                     <td class="encabezado" width="20%" title="">CONTADOR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(400,6696,$_REQUEST['iddoc']);?></td></tr><tr id="tr_clasifica_expediente">
								<td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(400,6700,'4',$_REQUEST['iddoc']);?></div><br/><input type="hidden" maxlength="255"  class="required"  name="clasifica_expediente" id="clasifica_expediente"   value="<?php cargar_seleccionados(400,6700,1,$_REQUEST['iddoc']);?>" ><div id="esperando_clasifica_expediente">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_clasifica_expediente" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_clasifica_expediente=new dhtmlXTreeObject("treeboxbox_clasifica_expediente","100%","100%",0);
								tree_clasifica_expediente.setImagePath("../../imgs/");
								tree_clasifica_expediente.enableIEImageFix(true);tree_clasifica_expediente.enableCheckBoxes(1);
									tree_clasifica_expediente.enableRadioButtons(true);tree_clasifica_expediente.setOnLoadingStart(cargando_clasifica_expediente);
								tree_clasifica_expediente.setOnLoadingEnd(fin_cargando_clasifica_expediente);tree_clasifica_expediente.setXMLAutoLoading("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");tree_clasifica_expediente.loadXML("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1",checkear_arbol);tree_clasifica_expediente.setOnCheckHandler(onNodeSelect_clasifica_expediente);
									function onNodeSelect_clasifica_expediente(nodeId) {
										valor_destino=document.getElementById("clasifica_expediente");
										if(tree_clasifica_expediente.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_clasifica_expediente.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_clasifica_expediente() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_clasifica_expediente")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_clasifica_expediente")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_clasifica_expediente"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_clasifica_expediente() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_clasifica_expediente")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_clasifica_expediente")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_clasifica_expediente"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(400,6700,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_clasifica_expediente.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="fk_idexpediente" value="<?php echo(mostrar_valor_campo('fk_idexpediente',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(mostrar_valor_campo('serie_idserie',400,$_REQUEST['iddoc'])); ?>"><tr id="tr_anexo_word">
                     <td class="encabezado" width="20%" title="Por favor elija la plantilla recomendada y una vez diligenciada debe cargarla en esta opci&oacute;n">CARGAR ARCHIVO DE WORD*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=400&idcampo=4797" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_anexo_csv">
                     <td class="encabezado" width="20%" title="<b>Para combinar Correspondencia:</b>
<br/><br/>
Consideraciones:<br/>
1. La base de informaci&oacute;n puede hacerla en EXCEL.<br/>

2. Cada columna debe tener el TITULO y debajo los datos asociados.<br/>

3. El t&iacute;tulo de cada columna debe ser escrito <b>exactamente</b> igual a como aparece en la plantilla de WORD, ya que esto permitir&aacute; hacer la relaci&oacute;n entre los datos y el WORD. <br/>

4. EL archivo debe subirse en formato <b>CSV o XLSX</b><br/>

5. Recuerde que en la plantilla de WORD  deben aparecer los textos que escribi&oacute; como encabezado de las columnas pero adicionando los s&iacute;mbolos <b>$</b> y <b>{ }</b> al inicio y final.  Ejemplo:  <b>${Nombre del Destino}</b>,  <b>${Direccion}</b>, <b>${Telefono}</b>, etc.">CARGAR ARCHIVO EN FORMATO CSV/XLSX CON LOS DATOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=400&idcampo=4944" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><input type="hidden" name="idft_oficio_word" value="<?php echo(mostrar_valor_campo('idft_oficio_word',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',400,$_REQUEST['iddoc'])); ?>"><?php add_edit_oficio_word(400,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6698'); ?>"><input type="hidden" name="formato" value="400"><tr><td colspan='2'><?php submit_formato(400,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("400-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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