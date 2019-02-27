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
                                    <title>.:EDITAR COMUNICACI&Oacute;N EXTERNA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><?php include_once('../../formatos/librerias/header_formato.php'); ?><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css"><script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js"></script><?php include_once('<?=  ?>anexosdigitales/funciones_archivo.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style><script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>
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
                            <div class="card-body"><center><h5 class="text-black">COMUNICACIÓN EXTERNA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],1,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="expediente_serie" value="<?php echo(mostrar_valor_campo('expediente_serie',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_copia_interna" value="<?php echo(mostrar_valor_campo('tipo_copia_interna',1,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_fecha_carta"><label title="Fecha en la que fue Creada la Carta.">FECHA DE CREACION*</label><?php fecha_formato(1,3,$_REQUEST['iddoc']);?></div><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',1,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_destinos">
                                        <label title="">DESTINOS*</label>
                                        <input type="hidden" maxlength="2000"  class="required"  name="destinos" id="destinos" value="<?php echo(mostrar_valor_campo('destinos',1,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("9",@$_REQUEST["iddoc"]); ?></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_carta" value="<?php echo(mostrar_valor_campo('idft_carta',1,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',1,$_REQUEST['iddoc'])); ?>"><div class="form-group  " id="tr_requiere_recogida">
                            <label title="">REQUIERE RECOGIDA?</label><?php genera_campo_listados_editar(1,5201,$_REQUEST['iddoc']);?><br></div><div class="form-group" id="tr_copia">
                                        <label title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</label>
                                        <input type="hidden" maxlength="2000"  name="copia" id="copia" value="<?php echo(mostrar_valor_campo('copia',1,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("6",@$_REQUEST["iddoc"]); ?></div><div class="form-group" id="tr_serie_idserie">
                                <label title="">CLASIFICAR EN EXPEDIENTE*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(1,8,'1',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_serie_idserie" width="200px" size="25" onblur="closetree_serie_idserie()"> <input type="hidden" id="idclosetree_serie_idserie">
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  class="required"  name="serie_idserie" id="serie_idserie"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(1,8,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_serie_idserie">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_serie_idserie" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_serie_idserie=new dhtmlXTreeObject("treeboxbox_serie_idserie","100%","100%",0);
                                tree_serie_idserie.setImagePath("../../imgs/");
                                tree_serie_idserie.enableTreeImages("false");
                                tree_serie_idserie.enableTreeLines("false");
                                tree_serie_idserie.enableIEImageFix(true);tree_serie_idserie.enableCheckBoxes(1);
                                    tree_serie_idserie.enableRadioButtons(true);
                                    tree_serie_idserie.enableSingleRadioMode(true);tree_serie_idserie.setOnLoadingStart(cargando_serie_idserie);
                                tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.enableSmartXMLParsing(true);tree_serie_idserie.loadXML("../../test/test_expediente_funcionario.php",checkear_arbol);tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
                                    function onNodeSelect_serie_idserie(nodeId) {
                                        valor_destino=document.getElementById("serie_idserie");
                                        if(tree_serie_idserie.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_serie_idserie.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
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
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(1,8,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_serie_idserie.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group  " id="tr_tipo_mensajeria">
                            <label title="">TIPO DE MENSAJER&Iacute;A</label><?php genera_campo_listados_editar(1,5200,$_REQUEST['iddoc']);?><br></div><div class="form-group form-group-default required"  id="tr_asunto">
                                        <label title="">ASUNTO</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='2'  type="text"  size="100" id="asunto" name="asunto" required value="<?php echo(mostrar_valor_campo('asunto',1,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_contenido">
                                        <label title="">CONTENIDO*</label>
                                        <div class="celda_transparente"><textarea  tabindex='3'  name="contenido" id="contenido" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('contenido',1,$_REQUEST['iddoc'])); ?></textarea><script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("contenido", config);
                            </script>
                            </div></div><div class="form-group" id="tr_despedida"><label title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</label><?php despedida(1,7,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_copiainterna">
                                <label title="">CON COPIA INTERNA A</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(1,2,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='4'  type="text" id="stext_copiainterna" width="200px" size="25" onblur="closetree_copiainterna()"> <input type="hidden" id="idclosetree_copiainterna">
                                <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="copiainterna" id="copiainterna"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(1,2,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_copiainterna">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_copiainterna" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","100%","100%",0);
                                tree_copiainterna.setImagePath("../../imgs/");
                                tree_copiainterna.enableTreeImages("false");
                                tree_copiainterna.enableTreeLines("false");
                                tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
                                    tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
                                tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php?rol=1",checkear_arbol);tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);

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
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(1,2,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_copiainterna.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group" id="tr_iniciales"><label title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA*</label><?php iniciales(1,5,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_anexos_digitales">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=1&idcampo=11" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><div class="form-group" id="tr_anexos_fisicos"><label title="Listado con Los Anexos de la Carta">ANEXOS FISICOS</label><?php anexos_fisicos(1,4,$_REQUEST['iddoc']);?></div><div class="form-group  required" id="tr_vercopiainterna">
                            <label title="">VISIBLE LA COPIA INTERNA*</label><?php genera_campo_listados_editar(1,12,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="vercopiainterna" style="display: none;"></label><br></div><?php cargar_destinos_carta(1,NULL,$_REQUEST['iddoc']);?><?php mostrar_imagenes_escaneadas(1,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('10,7104'); ?>"><input type="hidden" name="formato" value="1"><tr><td colspan='2'><?php submit_formato(1,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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