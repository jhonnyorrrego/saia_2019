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
                                    <title>.:EDITAR COMUNICACI&Oacute;N INTERNA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('../librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script><?= pace() ?>
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
                            <div class="card-body"><center><h5 class="text-black">COMUNICACIÓN INTERNA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],2,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="expediente_serie" value="<?php echo(mostrar_valor_campo('expediente_serie',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',2,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_memorando" value="<?php echo(mostrar_valor_campo('idft_memorando',2,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_fecha_memorando"><label title="">FECHA*</label><?php fecha_formato(2,19,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_serie_idserie">
                                <label title="">CLASIFICAR EN EXPEDIENTE</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(2,28,'1',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_serie_idserie" width="200px" size="25" onblur="closetree_serie_idserie()"> <input type="hidden" id="idclosetree_serie_idserie">
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,28,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_serie_idserie">
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
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,28,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_serie_idserie.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group" id="tr_destino">
                                <label title="">DESTINO*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(2,21,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_destino" width="200px" size="25" onblur="closetree_destino()"> <input type="hidden" id="idclosetree_destino">
                                <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="2000"  class="required"  name="destino" id="destino"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,21,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_destino">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_destino" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
                                tree_destino.setImagePath("../../imgs/");
                                tree_destino.enableTreeImages("false");
                                tree_destino.enableTreeLines("false");
                                tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                                    tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                                tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1",checkear_arbol);tree_destino.setOnCheckHandler(onNodeSelect_destino);

                                    function onNodeSelect_destino(nodeId){
                                        valor_destino=document.getElementById("destino");
                                        destinos=tree_destino.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_destino.getAllSubItems(vector[i]);
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
                                    }function fin_cargando_destino() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_destino")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_destino")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_destino"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_destino() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_destino")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_destino")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_destino"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,21,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_destino.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',2,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_copia">
                                <label title="">CON COPIA A</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(2,22,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='3'  type="text" id="stext_copia" width="200px" size="25" onblur="closetree_copia()"> <input type="hidden" id="idclosetree_copia">
                                <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="2000"  name="copia" id="copia"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,22,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_copia">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_copia" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_copia=new dhtmlXTreeObject("treeboxbox_copia","100%","100%",0);
                                tree_copia.setImagePath("../../imgs/");
                                tree_copia.enableTreeImages("false");
                                tree_copia.enableTreeLines("false");
                                tree_copia.enableIEImageFix(true);tree_copia.enableCheckBoxes(1);
                                    tree_copia.enableThreeStateCheckboxes(1);tree_copia.setOnLoadingStart(cargando_copia);
                                tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.enableSmartXMLParsing(true);tree_copia.loadXML("../../test.php?rol=1",checkear_arbol);tree_copia.setOnCheckHandler(onNodeSelect_copia);

                                    function onNodeSelect_copia(nodeId){
                                        valor_destino=document.getElementById("copia");
                                        destinos=tree_copia.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_copia.getAllSubItems(vector[i]);
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
                                    }function fin_cargando_copia() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_copia() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(2,22,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_copia.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group form-group-default required"  id="tr_asunto">
                                        <label title="">ASUNTO</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='4'  type="text"  size="100" id="asunto" name="asunto" required value="<?php echo(mostrar_valor_campo('asunto',2,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_contenido">
                                        <label title="">CONTENIDO*</label>
                                        <div class="celda_transparente"><textarea  tabindex='5'  name="contenido" id="contenido" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('contenido',2,$_REQUEST['iddoc'])); ?></textarea><script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("contenido", config);
                            </script>
                            </div></div><div class="form-group" id="tr_despedida"><label title="">DESPEDIDA*</label><?php despedida(2,25,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_iniciales"><label title="">INICIALES DE QUIEN PREPARO EL MEMORANDO*</label><?php iniciales(2,26,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_anexos">
                                        <label title="Anexos digitales">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><?php echo '<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=2&idcampo=32" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>'; ?></div></div><div class="form-group" id="tr_anexos_fisicos"><label title="">ANEXOS FISICOS</label><?php anexos_fisicos(2,27,$_REQUEST['iddoc']);?></div><div class="form-group  required" id="tr_email_aprobar">
                            <label title="">APROBAR FUERA DE SAIA*</label><?php genera_campo_listados_editar(2,5176,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="email_aprobar" style="display: none;"></label><br></div><?php mostrar_imagenes(2,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('23,6921'); ?>"><input type="hidden" name="formato" value="2"><tr><td colspan='2'><?php submit_formato(2,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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