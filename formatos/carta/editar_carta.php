<html><title>.:EDITAR COMUNICACI&Oacute;N EXTERNA:.</title>
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
			<script type="text/javascript" src="../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script>
			<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">COMUNICACIÓN EXTERNA</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="expediente_serie" value="<?php echo(mostrar_valor_campo('expediente_serie',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_copia_interna" value="<?php echo(mostrar_valor_campo('tipo_copia_interna',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_carta" value="<?php echo(mostrar_valor_campo('idft_carta',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',1,$_REQUEST['iddoc'])); ?>"><tr id="tr_serie_idserie">
								<td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(1,8,'4',$_REQUEST['iddoc']);?></div><br/><input type="hidden" maxlength="11"  class="required"  name="serie_idserie" id="serie_idserie"   value="<?php cargar_seleccionados(1,8,1,$_REQUEST['iddoc']);?>" ><div id="esperando_serie_idserie">
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
										vector2="<?php cargar_seleccionados(1,8,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_serie_idserie.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_fecha_carta">
                     <td class="encabezado" width="20%" title="Fecha en la que fue Creada la Carta.">FECHA DE CREACION*</td>
                     <?php fecha_formato(1,3,$_REQUEST['iddoc']);?></tr><tr id="tr_destinos">
                   <td class="encabezado" width="20%" title="">DESTINOS*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  class="required"  name="destinos" id="destinos" value="<?php echo(mostrar_valor_campo('destinos',1,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("9",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr id="tr_requiere_recogida" >
                     <td class="encabezado" width="20%" title="">REQUIERE RECOGIDA?</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,5201,$_REQUEST['iddoc']);?></td></tr><tr id="tr_copia">
                   <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  name="copia" id="copia" value="<?php echo(mostrar_valor_campo('copia',1,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("6",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr id="tr_tipo_mensajeria" >
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJER&Iacute;A</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,5200,$_REQUEST['iddoc']);?></td></tr><tr id="tr_asunto">
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(mostrar_valor_campo('asunto',1,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_contenido">
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_avanzado required"><?php echo(mostrar_valor_campo('contenido',1,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_despedida">
                     <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td>
                     <?php despedida(1,7,$_REQUEST['iddoc']);?></tr><tr id="tr_copiainterna">
								<td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(1,2,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='3'  type="text" id="stext_copiainterna" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="copiainterna" id="copiainterna"   value="<?php cargar_seleccionados(1,2,1,$_REQUEST['iddoc']);?>" ><div id="esperando_copiainterna">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_copiainterna" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","100%","100%",0);
								tree_copiainterna.setImagePath("../../imgs/");
								tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
									tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
								tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);

									function onNodeSelect_copiainterna(nodeId){
										valor_destino=document.getElementById("copiainterna");
										destinos=tree_copiainterna.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_copiainterna.getAllSubItems(vector[i]);
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
									}function fin_cargando_copiainterna() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copiainterna")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copiainterna")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copiainterna"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_copiainterna() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copiainterna")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copiainterna")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copiainterna"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(1,2,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_copiainterna.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_iniciales">
                     <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA*</td>
                     <?php iniciales(1,5,$_REQUEST['iddoc']);?></tr><tr id="tr_anexos_digitales">
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=1&idcampo=11" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_anexos_fisicos">
                     <td class="encabezado" width="20%" title="Listado con Los Anexos de la Carta">ANEXOS FISICOS</td>
                     <?php anexos_fisicos(1,4,$_REQUEST['iddoc']);?></tr><tr id="tr_vercopiainterna" >
                     <td class="encabezado" width="20%" title="">VISIBLE LA COPIA INTERNA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,12,$_REQUEST['iddoc']);?></td></tr><tr id="tr_email_aprobar" >
                     <td class="encabezado" width="20%" title="">APROBAR FUERA DE SAIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,4086,$_REQUEST['iddoc']);?></td></tr><?php cargar_destinos_carta(1,NULL,$_REQUEST['iddoc']);?><?php mostrar_imagenes_escaneadas(1,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('10'); ?>"><input type="hidden" name="formato" value="1"><tr><td colspan='2'><?php submit_formato(1,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("1-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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