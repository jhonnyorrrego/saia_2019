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
                                    <title>.:ADICIONAR SOLICITUD DE PRESTAMO:.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js"></script><?php include_once('<?= ../ ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
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
                            <div class="card-body"><center><h5 class="text-black">SOLICITUD DE PRESTAMO</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],412,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><div class="form-group "  id="tr_highslide_1926201103">
                                        <label title="">HIGHSLIDE*</label>
                                        <input class="form-control" required maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="highslide_1926201103" name="highslide_1926201103" required value="<?php echo(validar_valor_campo(6703)); ?>">
                                       </div><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(412,5104);?></div><div class="form-group" id="tr_fecha"><label title="">FECHA DE SOLICITUD</label><?php fecha_formato(412,5111);?></div><div class="form-group" id="tr_transferencia_presta"><label title="">EXPEDIENTE VINCULADO*</label><?php guardar_expedientes_prestamos(412,5205);?></div><div class="form-group" id="tr_observaciones">
                                        <label title="">OBSERVACIONES*</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="form-control required"><?php echo(validar_valor_campo(5113)); ?></textarea></div></div><div class="form-group  required" id="tr_documento_archivo">
                            <label title="">UBICACI&Oacute;N DEL DOCUMENTO*</label><?php genera_campo_listados_editar(412,5114,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="documento_archivo" style="display: none;"></label><br></div><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(5106)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(5105)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(5103)); ?>"><input type="hidden" name="idft_solicitud_prestamo" value="<?php echo(validar_valor_campo(5102)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(5101)); ?>"><div class="form-group" id="tr_fecha_prestamo_rep">
<label for="fecha_prestamo_rep">FECHA REQUERIDA PARA PRESTAMO</label>

<div class="input-group date">
<input  tabindex="3 " type="text" class="form-control"  id="fecha_prestamo_rep"   name="fecha_prestamo_rep" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_prestamo_rep").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group" id="tr_fecha_devolucion_rep">
<label for="fecha_devolucion_rep">FECHA DE DEVOLUCI&Oacute;N ESTIMADA</label>

<div class="input-group date">
<input  tabindex="4 " type="text" class="form-control"  id="fecha_devolucion_rep"   name="fecha_devolucion_rep" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_devolucion_rep").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5100)); ?>"><div class="form-group" id="tr_anexos">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><div id="dz_campo_5116" class="saia_dz dropzone no-margin" data-nombre-campo="anexos" data-longitud=""  data-cantidad="" data-idformato="412" data-idcampo-formato="5116" data-extensiones="<?php echo $extensiones;?>" data-multiple="unico"><div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div></div></div><?php asignar_responsables(412,NULL);?><?php validar_fecha_prestamo(412,NULL);?><input type="hidden" name="campo_descripcion" value="5113"><tr><td colspan='2'><?php submit_formato(412);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("412-") . "-" . uniqid());?>'></form></body>
      <script type="text/javascript">
      setInterval("auto_save('highslide_1926201103','solicitud_prestamo')",1);
      </script><script type='text/javascript'>
            var upload_url = '../../app/temporal/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var upload_max_size = 2;
                    var maximo = 2;
                    var tamanoMaximo = $(this).attr('data-longitud');
                    var archivosMaximo = $(this).attr('data-cantidad');
                    var multiple_text = $(this).attr('data-multiple');
                    if(tamanoMaximo > 1){
                         multiple_text = 'multiple';
                    }
                    
                    var idformato = $(this).attr('data-idformato');
                  var idcampo = $(this).attr('id');
                  var paramName = $(this).attr('data-nombre-campo');
                  var idcampoFormato = $(this).attr('data-idcampo-formato');
                  var extensiones = $(this).attr('data-extensiones');
                  
                  var multiple = false;
                  var form_uuid = $('#form_uuid').val();
                    var maxFiles = 1;
                    var maxFilesize = 2;
                  if(multiple_text == 'multiple') {
                      multiple = true;
                        if(tamanoMaximo > upload_max_size){
                            maxFilesize = 200;                           
                        }else{
                            maxFilesize = tamanoMaximo;
                        }
                        if(archivosMaximo > maximo){
                            maxFiles = 10;
                        }else{
                            maxFiles = archivosMaximo;
                        } 
                  }
                    var opciones = {
                        maxFilesize: maxFilesize,
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