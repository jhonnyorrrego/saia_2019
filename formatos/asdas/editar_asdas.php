<?php
                    $max_salida = 10;
                    $ruta_db_superior = $ruta = "";

                    while ($max_salida > 0) {
                        if (is_file($ruta . "db.php")) {
                            $ruta_db_superior = $ruta;
                        }

                        $ruta .= "../";
                        $max_salida --;
                    }

                    ?>
                        <!DOCTYPE html>
                            <html>
                                <head>
                                    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                                    <meta charset="utf-8" />
                                    <title>.:editar asdasd:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= breakpoint() ?>
                        <?= toastr() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script><?php include_once('<?=  ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
                				<link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link class="main-stylesheet"
                                	href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"
                                	rel="stylesheet" type="text/css" media="screen">
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js"
                                	type="text/javascript"></script>
                                <script
                                    src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js"
                                    type="text/javascript"></script>

                                <link rel="stylesheet"
                                    href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"  type="text/css" media="screen" />
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script> 
                			</head>
                			<div class="container-fluid container-fixed-lg col-lg-8" style="overflow: auto;" id="content_container">
                    	<!-- START card -->
                    	<div class="card card-default">
                            <div class="card-body"><h5>ASDASD</h5><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" class="form-horizontal" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="serie_idserie" value="<?php echo(mostrar_valor_campo('serie_idserie',417,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_asdas" value="<?php echo(mostrar_valor_campo('idft_asdas',417,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',417,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_fecha_hora">
<label class="etiqueta_campo" title="Seleccione una fecha con hora">Fecha con Hora*</label>
<div class="input-group">
<input  tabindex="1 " type="text" class="form-control"  id="fecha_hora" name="fecha_hora">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"maxDate":"2018-12-26","format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_hora").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div><div class="form-group" id="tr_textarea_cke_1430966504">
                     <label class="etiqueta_campo" title="">Texto con formato*</label>
<div class="celda_transparente"><textarea  tabindex='2'  name="textarea_cke_1430966504" id="textarea_cke_1430966504" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('textarea_cke_1430966504',417,$_REQUEST['iddoc'])); ?></textarea><script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("textarea_cke_1430966504", config);
                            </script>
                            </div></div><div class="form-group" id="tr_moneda_1953843243">
<label class="etiqueta_campo" title="" for="moneda_1953843243">Moneda</label>
<div class="input-group" >
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
<input class="form-control"     tabindex="3 " type="number" id="moneda_1953843243" name="moneda_1953843243"  value="">
</div>
</div><p id="etiqueta_parrafo_1185182134"></p><div class="form-group" id="tr_textarea_cke_649574615">
                     <label class="etiqueta_campo" title="">Texto con formato*</label>
<div class="celda_transparente"><textarea  tabindex='4'  name="textarea_cke_649574615" id="textarea_cke_649574615" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('textarea_cke_649574615',417,$_REQUEST['iddoc'])); ?></textarea><script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("textarea_cke_649574615", config);
                            </script>
                            </div></div><div class="form-group" id="tr_select_923812534">
                     <label class="etiqueta_campo" title="">Lista desplegable*</label><?php genera_campo_listados_editar(417,7025,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_dependencia"><label class="etiqueta_campo" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(417,6869,$_REQUEST['iddoc']);?></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',417,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',417,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_contador_1203113038">
<label class="etiqueta_campo" title="" for="contador_1203113038">Campo num&eacute;rico</label>

<input class="form-control"     tabindex="5 " type="number" id="contador_1203113038" name="contador_1203113038"  value="">
</div>
<div class="form-group" id="tr_campo_texto_1922978464">
                     <label class="etiqueta_campo" title="">Campo de texto*</label>
                     <input class="form-control"  maxlength="255"  class="required"   tabindex='6'  type="text"  size="100" id="campo_texto_1922978464" name="campo_texto_1922978464"  value="<?php echo(mostrar_valor_campo('campo_texto_1922978464',417,$_REQUEST['iddoc'])); ?>">
                    </div><div class="form-group" id="tr_ejecutor_310418348">
                   <label class="etiqueta_campo" title="">Terceros*</label>
                   <input type="hidden" maxlength="255"  class="required"  name="ejecutor_310418348" id="ejecutor_310418348" value="<?php echo(mostrar_valor_campo('ejecutor_310418348',417,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("6914",@$_REQUEST["iddoc"]); ?></div><div class="form-group" id="tr_checkbox_1657477002">
                  <label class="etiqueta_campo" title="">Selecci&oacute;n m&uacute;ltiple*</label><?php genera_campo_listados_editar(417,6915,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_archivo_568795365">
                     <label class="etiqueta_campo" title="">Adjuntos</label>
                     <div class="tools">
                          <a class="collapse" href="javascript:;"></a>
                          <a class="config" data-toggle="modal" href="#grid-config"></a>
                          <a class="reload" href="javascript:;"></a>
                          <a class="remove" href="javascript:;"></a>
                    </div>
                    <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=417&idcampo=6917" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></div></div><input type="hidden" name="campo_descripcion" value="<?php echo('6925'); ?>"><input type="hidden" name="formato" value="417"><tr><td colspan='2'><?php submit_formato(417,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
            var upload_url = '../../dropzone/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aqui� los archivos';
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
                        maxFilesize: 2,
                    	ignoreHiddenFiles : true,
                    	maxFiles : maxFiles,
                    	acceptedFiles: extensiones,
                   		addRemoveLinks: true,
                   		dictRemoveFile: 'Quitar anexo',
                   		dictMaxFilesExceeded : 'No puede subir mas archivos',
                   		dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
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
                		</html><?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>