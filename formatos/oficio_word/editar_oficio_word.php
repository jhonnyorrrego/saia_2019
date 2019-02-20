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
                                    <title>.:EDITAR DOCUMENTOS EN FORMATO (WORD):.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><?php include_once('../../formatos/librerias/header_formato.php'); ?><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css"><script type="text/javascript" src="<?= $ruta_db_superior ?>dropzone/dist/dropzone.js"></script><?php include_once('<?=  ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link href="<?= $ruta_db_superior ?>dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
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
                            <div class="card-body"><center><h4 class="text-black">DOCUMENTOS EN FORMATO (WORD)</h4></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],400,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(400,4802,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_tipo_radicado">
                                        <label title="">SELECCIONAR TIPO DE RADICADO*</label><?php genera_campo_listados_editar(400,6696,$_REQUEST['iddoc']);?></div><div class="form-group form-group-default required"  id="tr_asunto_word">
                                        <label title="">ASUNTO</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="asunto_word" name="asunto_word" required value="<?php echo(mostrar_valor_campo('asunto_word',400,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_clasifica_expediente">
                                <label title="">CLASIFICAR EN EXPEDIENTE*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(400,6700,'4',$_REQUEST['iddoc']);}?></div><br/><input type="hidden" maxlength="255"  class="required"  name="clasifica_expediente" id="clasifica_expediente"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(400,6700,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_clasifica_expediente">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_clasifica_expediente" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_clasifica_expediente=new dhtmlXTreeObject("treeboxbox_clasifica_expediente","100%","100%",0);
                                tree_clasifica_expediente.setImagePath("../../imgs/");
                                tree_clasifica_expediente.enableTreeImages("false");
                                tree_clasifica_expediente.enableTreeLines("false");
                                tree_clasifica_expediente.enableIEImageFix(true);tree_clasifica_expediente.enableCheckBoxes(1);
                                    tree_clasifica_expediente.enableRadioButtons(true);
                                    tree_clasifica_expediente.enableSingleRadioMode(true);tree_clasifica_expediente.setOnLoadingStart(cargando_clasifica_expediente);
                                tree_clasifica_expediente.setOnLoadingEnd(fin_cargando_clasifica_expediente);tree_clasifica_expediente.setXMLAutoLoading("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");tree_clasifica_expediente.loadXML("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1",checkear_arbol);tree_clasifica_expediente.setOnCheckHandler(onNodeSelect_clasifica_expediente);
                                    function onNodeSelect_clasifica_expediente(nodeId) {
                                        valor_destino=document.getElementById("clasifica_expediente");
                                        if(tree_clasifica_expediente.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_clasifica_expediente.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function closetree_clasifica_expediente() {
                                    var bus_ant=document.getElementById('idclosetree_clasifica_expediente').value;
                                    var bus_actual=document.getElementById('stext_clasifica_expediente').value.trim();
                                    if(bus_actual!=''){
                                        if(bus_actual!=bus_ant){
                                            document.getElementById('idclosetree_clasifica_expediente').value=bus_actual;
                                            tree_clasifica_expediente.closeAllItems('1#');
                                        }
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
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(400,6700,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_clasifica_expediente.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><input type="hidden" name="fk_idexpediente" value="<?php echo(mostrar_valor_campo('fk_idexpediente',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(mostrar_valor_campo('serie_idserie',400,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_anexo_word">
                                        <label title="Por favor elija la plantilla recomendada y una vez diligenciada debe cargarla en esta opci&oacute;n">CARGAR ARCHIVO DE WORD*</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=400&idcampo=4797" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><div class="form-group" id="tr_anexo_csv">
                                        <label title="<b>Para combinar Correspondencia:</b>
<br/><br/>
Consideraciones:<br/>
1. La base de informaci&oacute;n puede hacerla en EXCEL.<br/>

2. Cada columna debe tener el TITULO y debajo los datos asociados.<br/>

3. El t&iacute;tulo de cada columna debe ser escrito <b>exactamente</b> igual a como aparece en la plantilla de WORD, ya que esto permitir&aacute; hacer la relaci&oacute;n entre los datos y el WORD. <br/>

4. EL archivo debe subirse en formato <b>CSV o XLSX</b><br/>

5. Recuerde que en la plantilla de WORD  deben aparecer los textos que escribi&oacute; como encabezado de las columnas pero adicionando los s&iacute;mbolos <b>$</b> y <b>{ }</b> al inicio y final.  Ejemplo:  <b>${Nombre del Destino}</b>,  <b>${Direccion}</b>, <b>${Telefono}</b>, etc.">CARGAR ARCHIVO DE EXCEL (PARA COMBINAR CORRESPONDENCIA)</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=400&idcampo=4944" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_oficio_word" value="<?php echo(mostrar_valor_campo('idft_oficio_word',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',400,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',400,$_REQUEST['iddoc'])); ?>"><?php add_edit_oficio_word(400,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6698'); ?>"><input type="hidden" name="formato" value="400"><tr><td colspan='2'><?php submit_formato(400,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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
                	</html><?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>