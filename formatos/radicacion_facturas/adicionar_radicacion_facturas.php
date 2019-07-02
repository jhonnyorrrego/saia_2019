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
                                    <title>.:ADICIONAR RADICACI&Oacute;N DE FACTURAS:.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../librerias/funciones_formatos_generales.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css"><script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js"></script><?php include_once('<?= ../ ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
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
                            <div class="card-body"><center><h5 class="text-black">RADICACIÓN DE FACTURAS</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],424,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(7041)); ?>"><input type="hidden" name="fecha_pago" value="<?php echo(validar_valor_campo(7043)); ?>"><input type="hidden" name="observaciones_check" value="<?php echo(validar_valor_campo(7051)); ?>"><div class="form-group "  id="tr_total_factura">
                                        <label title="">TOTAL FACTURA</label>
                                        <input class="form-control"  maxlength="50"   tabindex='1'  type="text"  size="100" id="total_factura" name="total_factura"  value="<?php echo(validar_valor_campo(7053)); ?>">
                                       </div><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(7052)); ?>"><input type="hidden" name="idft_radicacion_facturas" value="<?php echo(validar_valor_campo(7046)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(7038)); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(424,7036);?></div><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(7039)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(7045)); ?>"><div class="form-group "  id="tr_fecha_radicado">
                                        <label title="">FECHA DE RADICACI&Oacute;N</label>
                                        <input class="form-control" required  class="required"   tabindex='2'  type="text"  size="100" id="fecha_radicado" name="fecha_radicado" required value="<?php echo(validar_valor_campo(7044)); ?>">
                                       </div><div class="form-group" id="tr_numero_radicado"><label title="">N&Uacute;MERO DE RADICADO*</label><?php mostrar_radicado_factura(424,7048);?></div><div class="form-group" id="tr_natural_juridica">
                                        <label title="">PROVEEDOR*</label>
                                        <input type="hidden" maxlength="255"  class="required"  name="natural_juridica" id="natural_juridica" value=""><?php componente_ejecutor("7047",@$_REQUEST["iddoc"]); ?></div><input type="hidden" name="estado" value="<?php echo(validar_valor_campo(7040)); ?>"><div class="form-group" id="tr_fecha_emision">
<label for="fecha_emision">FECHA DE EMISI&Oacute;N DE LA FACTURA</label>

<div class="input-group date">
<input  tabindex="3 " type="text" class="form-control"  id="fecha_emision"   name="fecha_emision" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_emision").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group "  id="tr_num_factura">
                                        <label title="">N&Uacute;MERO DE FACTURA</label>
                                        <input class="form-control" required maxlength="255"   tabindex='4'  type="text"  size="100" id="num_factura" name="num_factura" required value="<?php echo(validar_valor_campo(7049)); ?>">
                                       </div><div class="form-group" id="tr_descripcion">
                                        <label title="">DESCRIPCI&Oacute;N SERVICIO O PRODUCTO*</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='5'  name="descripcion" id="descripcion" cols="53" rows="3" class="form-control required"><?php echo(validar_valor_campo(7037)); ?></textarea></div></div><div class="form-group "  id="tr_num_folios">
                                        <label title="">N&Uacute;MERO DE FOLIOS</label>
                                        <input class="form-control" required maxlength="255"   tabindex='6'  type="text"  size="100" id="num_folios" name="num_folios" required value="<?php echo(validar_valor_campo(7050)); ?>">
                                       </div><div class="form-group" id="tr_anexos_fisicos">
                                        <label title="">ANEXOS F&Iacute;SICOS</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='7'  name="anexos_fisicos" id="anexos_fisicos" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(7034)); ?></textarea></div></div><div class="form-group" id="tr_anexos_digitales">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><div id="dz_campo_7033" class="saia_dz dropzone no-margin" data-nombre-campo="anexos_digitales" data-longitud=""  data-cantidad="" data-idformato="424" data-idcampo-formato="7033" data-extensiones="<?php echo $extensiones;?>" data-multiple="unico"><div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div></div></div><div class="form-group" id="tr_copia_electronica">
                                <label title="">COPIA ELECTR&Oacute;NICA A</label><div class="form-controls"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(424,7035,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_copia_electronica" width="200px" size="25" onblur="closetree_copia_electronica()"> <input type="hidden" id="idclosetree_copia_electronica">
                                <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),0,1)">
                                    <img src="../../assets/images/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),1)">
                                        <img src="../../assets/images/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value))">
                                    <img src="../../assets/images/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="copia_electronica" id="copia_electronica"   value="" ><label style="display:none" class="error" for="copia_electronica">Campo obligatorio.</label><div id="esperando_copia_electronica">
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
                                tree_copia_electronica.enableTreeImages("false");
                                tree_copia_electronica.enableTreeLines("false");
                                tree_copia_electronica.enableIEImageFix(true);tree_copia_electronica.enableCheckBoxes(1);
                                    tree_copia_electronica.enableThreeStateCheckboxes(1);tree_copia_electronica.setOnLoadingStart(cargando_copia_electronica);
                                tree_copia_electronica.setOnLoadingEnd(fin_cargando_copia_electronica);tree_copia_electronica.enableSmartXMLParsing(true);tree_copia_electronica.loadXML("../../test.php?rol=1");tree_copia_electronica.setOnCheckHandler(onNodeSelect_copia_electronica);

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
                                }</script></div></div><?php digitalizar_formato(424,NULL);?><?php validar_digitalizacion_formato(424,NULL);?><?php add_edit(424,NULL);?><?php autocompletar_convenio_clasificacion(424,NULL);?><?php add_edit_item_facturas(424,NULL);?><input type="hidden" name="campo_descripcion" value="7047"><tr><td colspan='2'><?php submit_formato(424);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("424-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
            var upload_url = '../../app/temporal/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var upload_max_size = 5;
                    var maximo = 5;
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
                    var maxFilesize = 5;
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