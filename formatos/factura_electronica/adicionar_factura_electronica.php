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
                                    <title>.:ADICIONAR FACTURA ELECTR&Oacute;NICA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
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
                            <div class="card-body"><center><h4 class="text-black">FACTURA ELECTRÓNICA</h4></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],423,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><div class="form-group" id="tr_anexos">
                                        <label title="">ANEXOS</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><div id="dz_campo_6995" class="saia_dz dropzone no-margin" data-nombre-campo="anexos" data-idformato="423" data-idcampo-formato="6995" data-extensiones="<?php echo $extensiones;?>" data-multiple="unico"><div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div></div></div><div class="form-group form-group-default "  id="tr_ciudad_proveedor">
                                        <label title="">CIUDAD PROVEEDOR</label>
                                        <input class="form-control"  maxlength="255"   tabindex='2'  type="text"  size="100" id="ciudad_proveedor" name="ciudad_proveedor"  value="<?php echo(validar_valor_campo(6996)); ?>">
                                       </div><div class="form-group form-group-default "  id="tr_direccion_proveedor">
                                        <label title="">DIRECCI&Oacute;N PROVEEDOR</label>
                                        <input class="form-control"  maxlength="255"   tabindex='3'  type="text"  size="100" id="direccion_proveedor" name="direccion_proveedor"  value="<?php echo(validar_valor_campo(6997)); ?>">
                                       </div><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(6998)); ?>"><div class="form-group form-group-default "  id="tr_estado_proveedor">
                                        <label title="">DEPARTAMENTO PROVEEDOR</label>
                                        <input class="form-control"  maxlength="255"   tabindex='4'  type="text"  size="100" id="estado_proveedor" name="estado_proveedor"  value="<?php echo(validar_valor_campo(6999)); ?>">
                                       </div><div class="form-group  id="tr_fecha_factura">
<label title="">FECHA FACTURA</label>
<div class="input-group">
<input  tabindex="5 " type="text" class="form-control"  id="fecha_factura"   name="fecha_factura">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD LT","locale":"es","useCurrent":true};
                $("#fecha_factura").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div><input type="hidden" name="fk_datos_factura" value="<?php echo(validar_valor_campo(7001)); ?>"><div class="form-group" id="tr_info_proveedor">
                                        <label title="">INFORMACI&Oacute;N ADICIONAL DEL PROVEEDOR</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='6'  name="info_proveedor" id="info_proveedor" cols="53" rows="3" class="form-control tiny_basico"><?php echo(validar_valor_campo(7002)); ?></textarea></div></div><div class="form-group form-group-default required"  id="tr_nit_proveedor">
                                        <label title="">NIT PROVEEDOR</label>
                                        <input class="form-control"  maxlength="20"  class="required"   tabindex='7'  type="text"  size="100" id="nit_proveedor" name="nit_proveedor" required value="<?php echo(validar_valor_campo(7003)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_nombre_proveedor">
                                        <label title="">NOMBRE PROVEEDOR</label>
                                        <input class="form-control"  maxlength="255"   tabindex='8'  type="text"  size="100" id="nombre_proveedor" name="nombre_proveedor" required value="<?php echo(validar_valor_campo(7004)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_num_factura">
                                        <label title="">N&Uacute;MERO DE FACTURA</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='9'  type="text"  size="100" id="num_factura" name="num_factura" required value="<?php echo(validar_valor_campo(7005)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_pais_proveedor">
                                        <label title="">PAIS PROVEEDOR</label>
                                        <input class="form-control"  maxlength="255"   tabindex='10'  type="text"  size="100" id="pais_proveedor" name="pais_proveedor" required value="<?php echo(validar_valor_campo(7006)); ?>">
                                       </div><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(7007)); ?>"><div class="form-group form-group-default required"  id="tr_total_factura">
                                        <label title="">TOTAL FACTURA</label>
                                        <input class="form-control"  maxlength="50"   tabindex='11'  type="text"  size="100" id="total_factura" name="total_factura" required value="<?php echo(validar_valor_campo(7008)); ?>">
                                       </div><input type="hidden" name="idft_factura_electronica" value="<?php echo(validar_valor_campo(7017)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(7018)); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(423,7019);?></div><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(7020)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(7021)); ?>"><input type="hidden" name="campo_descripcion" value="7003,7005"><tr><td colspan='2'><?php submit_formato(423);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
            var upload_url = '../../dropzone/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
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
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(".form-group.form-group-default").click(function() {
                                    $(this).find("input").focus();
                                });

                                if (!this.initFormGroupDefaultRun) {
                                    $("body").on("focus", ".form-group.form-group-default :input", function() {
                                        $(".form-group.form-group-default").removeClass("focused");
                                        $(this).parents(".form-group").addClass("focused");
                                    });

                                    $("body").on("blur", ".form-group.form-group-default :input", function() {
                                        $(this).parents(".form-group").removeClass("focused");
                                        if ($(this).val()) {
                                            $(this).closest(".form-group").find("label").addClass("fade");
                                        } else {
                                            $(this).closest(".form-group").find("label").removeClass("fade");
                                        }
                                    });

                                    // Only run the above code once.
                                    this.initFormGroupDefaultRun = true;
                                }

                                $(".form-group.form-group-default .checkbox, .form-group.form-group-default .radio").hover(function() {
                                    $(this).parents(".form-group").addClass("focused");
                                }, function() {
                                    $(this).parents(".form-group").removeClass("focused");
                                });
                                
                            });
                        </script>
                	</html>