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
                                    <title>.:EDITAR REGISTRO DE CORRESPONDENCIA:.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../librerias/funciones_formatos_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><style>
ul.fancytree-container {
  width: 80%;
  height: 80%;
  overflow: auto;
  position: relative;
  border: none !important;
    outline:none !important;
}
span.fancytree-title {
    font-family: verdana;
  font-size: 7pt;
}
span.fancytree-checkbox.fancytree-radio {
    vertical-align: middle;
}
span.fancytree-expander {
    vertical-align: middle !important;
}
</style><?php include_once($ruta_db_superior . "arboles/crear_arbol_ft.php"); ?><?= jqueryUi() ?><?= fancyTree(true) ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js"></script><?php include_once('<?= ../ ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
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
                            <div class="card-body"><center><h5 class="text-black">REGISTRO DE CORRESPONDENCIA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],3,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="despachado" value="<?php echo(mostrar_valor_campo('despachado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',3,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(3,48,$_REQUEST['iddoc']);?></div><div id="tr_etiqueta_datos_gener">
                                        <h5 title="" id="etiqueta_datos_gener"><label ><CENTER><STRONG>DATOS GENERALES</STRONG></CENTER></label></h5>
                                      </div><div class="form-group" id="tr_fecha_radicacion_entrada"><label title="">FECHA DE REGISTRO*</label><?php fecha_formato(3,53,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_radicado"><label title="">NO. REGISTRO</label><?php mostrar_radicado_entrada(3,54,$_REQUEST['iddoc']);?></div><div class="form-group  required" id="tr_tipo_origen">
                            <label title="">ORIGEN DEL DOCUMENTO*</label><?php genera_campo_listados_editar(3,4966,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_origen" style="display: none;"></label><br></div><div id="tr_etiqueta_origen">
                                        <h5 title="" id="etiqueta_origen"><label ><CENTER><STRONG>INFORMACI&Oacute;N ORIGEN</STRONG></CENTER></label></h5>
                                      </div><div class="form-group" id="tr_fecha_oficio_entrada">
<label for="fecha_oficio_entrada">FECHA DEL DOCUMENTO</label>

<div class="input-group date">
<input  tabindex="1 " type="text" class="form-control"  id="fecha_oficio_entrada"   name="fecha_oficio_entrada" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"defaultDate":"<?php echo(mostrar_valor_campo('fecha_oficio_entrada',3,$_REQUEST['iddoc'])); ?>","format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_oficio_entrada").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group" id="tr_persona_natural">
                                        <label title="">PERSONA NATURAL/JUR&Iacute;DICA*</label>
                                        <input type="hidden" maxlength="255"  name="persona_natural" id="persona_natural" value="<?php echo(mostrar_valor_campo('persona_natural',3,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("37",@$_REQUEST["iddoc"]); ?></div><div class="form-group  " id="tr_area_responsable">
                                        <label title="">FUNCIONARIO RESPONSABLE</label><?php $origen_4967 = array(
                                    "url" => "arboles/arbol_funcionario.php",
                                    "ruta_db_superior" => $ruta_db_superior,);$origen_4967["params"]["checkbox"]="radio";$opciones_arbol_4967 = array(
                                    "keyboard" => true,"selectMode" => 1,"seleccionarClick" => 1,
                                );
                                $extensiones_4967 = array(
                                    "filter" => array()
                                );
                                $arbol_4967 = new ArbolFt("area_responsable", $origen_4967, $opciones_arbol_4967, $extensiones_4967);
                                echo $arbol_4967->generar_html();?></div><div class="form-group  required" id="tr_distribuid_entre_sedes">
                            <label title="">DISTRIBUIDO ENTRE SEDES*</label><?php genera_campo_listados_editar(3,8318,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="distribuid_entre_sedes" style="display: none;"></label><br></div><div class="form-group "  id="tr_numero_oficio">
                                        <label title="">N&Uacute;MERO DE DOCUMENTO</label>
                                        <input class="form-control"  maxlength="255" style="width:350px"  tabindex='2'  type="text"  size="100" id="numero_oficio" name="numero_oficio"  value="<?php echo(mostrar_valor_campo('numero_oficio',3,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group  col-md-50 col-lg-50 col-xl-50"  id="tr_descripcion">
                                        <label title="">ASUNTO*</label>
                                        <input class="form-control" required maxlength="255"  class="required"   tabindex='3'  type="text"  size="100" id="descripcion" name="descripcion" required value="<?php echo(mostrar_valor_campo('descripcion',3,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_descripcion_anexos">
                                        <label title="">ANEXOS FISICOS</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='4'  name="descripcion_anexos" id="descripcion_anexos" cols="53" rows="3" class="form-control"><?php echo(mostrar_valor_campo('descripcion_anexos',3,$_REQUEST['iddoc'])); ?></textarea></div></div><div class="form-group" id="tr_tiempo_respuesta">
<label for="tiempo_respuesta">FECHA L&Iacute;MITE DE RESPUESTA</label>

<div class="input-group date">
<input  tabindex="5 " type="text" class="form-control"  id="tiempo_respuesta"   name="tiempo_respuesta" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#tiempo_respuesta").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group  " id="tr_requiere_recogida">
                            <label title="">REQUIERE SERVICIO DE RECOGIDA?</label><?php genera_campo_listados_editar(3,5199,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="distribuid_entre_sedes" style="display: none;"></label><br></div><div class="form-group  " id="tr_tipo_mensajeria">
                            <label title="">REQUIERE SERVICIO DE ENTREGA?</label><?php genera_campo_listados_editar(3,4970,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="distribuid_entre_sedes" style="display: none;"></label><br></div><div class="form-group "  id="tr_numero_guia">
                                        <label title="">N&Uacute;MERO DE GU&Iacute;A</label>
                                        <input class="form-control" required maxlength="255"   tabindex='6'  type="text"  size="100" id="numero_guia" name="numero_guia" required value="<?php echo(mostrar_valor_campo('numero_guia',3,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_empresa_transportado">
                                        <label title="">EMPRESA TRANSPORTADORA</label><?php genera_campo_listados_editar(3,5084,$_REQUEST['iddoc']);?></div><div id="tr_etiqueta_destino">
                                        <h5 title="" id="etiqueta_destino"><label ><CENTER><STRONG>INFORMACI&Oacute;N DESTINO</STRONG></CENTER></label></h5>
                                      </div><div class="form-group  required" id="tr_tipo_destino">
                            <label title="">DESTINO DEL DOCUMENTO*</label><?php genera_campo_listados_editar(3,4968,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_destino" style="display: none;"></label><br></div><div class="form-group  required" id="tr_destino">
                                        <label title="">DESTINO</label><?php $origen_43 = array(
                                    "url" => "arboles/arbol_funcionario.php",
                                    "ruta_db_superior" => $ruta_db_superior,);$origen_43["params"]["checkbox"]="checkbox";$opciones_arbol_43 = array(
                                    "keyboard" => true,"selectMode" => 2,"seleccionarClick" => 1,
                                );
                                $extensiones_43 = array(
                                    "filter" => array()
                                );
                                $arbol_43 = new ArbolFt("destino", $origen_43, $opciones_arbol_43, $extensiones_43);
                                echo $arbol_43->generar_html();?></div><div class="form-group  required" id="tr_copia_a">
                                        <label title="">COPIA ELECTR&Oacute;NICA A</label><?php $origen_44 = array(
                                    "url" => "arboles/arbol_funcionario.php",
                                    "ruta_db_superior" => $ruta_db_superior,);$origen_44["params"]["checkbox"]="checkbox";$opciones_arbol_44 = array(
                                    "keyboard" => true,"selectMode" => 2,"seleccionarClick" => 1,
                                );
                                $extensiones_44 = array(
                                    "filter" => array()
                                );
                                $arbol_44 = new ArbolFt("copia_a", $origen_44, $opciones_arbol_44, $extensiones_44);
                                echo $arbol_44->generar_html();?></div><input type="hidden" name="serie_idserie" value="<?php echo(mostrar_valor_campo('serie_idserie',3,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_persona_natural_dest">
                                        <label title="">PERSONA NATURAL O JUR&Iacute;DICA*</label>
                                        <input type="hidden" maxlength="255"  name="persona_natural_dest" id="persona_natural_dest" value="<?php echo(mostrar_valor_campo('persona_natural_dest',3,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("4969",@$_REQUEST["iddoc"]); ?></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_radicacion_entrada" value="<?php echo(mostrar_valor_campo('idft_radicacion_entrada',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_radicado" value="<?php echo(mostrar_valor_campo('estado_radicado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',3,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_anexos_digitales">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=3&idcampo=42" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><?php quitar_descripcion_entrada(3,NULL,$_REQUEST['iddoc']);?><?php tipo_radicado_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php datos_editar_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php serie_documental_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php digitalizar_formato(3,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('39'); ?>"><input type="hidden" name="formato" value="3"><tr><td colspan='2'><?php submit_formato(3,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("3-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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
                  </html><?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>