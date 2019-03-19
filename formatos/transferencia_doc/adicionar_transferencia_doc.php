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
                                    <title>.:ADICIONAR TRANSFERENCIA DOCUMENTAL:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
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
                            <div class="card-body"><center><h5 class="text-black">TRANSFERENCIA DOCUMENTAL</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],343,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="iddependencia_compania" value="<?php echo(validar_valor_campo(6748)); ?>"><input type="hidden" name="tipo_transferencia" value="<?php echo(validar_valor_campo(6753)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4794)); ?>"><input type="hidden" name="idft_transferencia_doc" value="<?php echo(validar_valor_campo(3990)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3991)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3993)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3994)); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(343,3992);?></div><div class="form-group" id="tr_expediente_vinculado"><label title="">TRANSFERENCIA VINCULADA*</label><?php guardar_expedientes_add(343,3995);?></div><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3989)); ?>"><div class="form-group" id="tr_oficina_productora">
                                <label title="">OFICINA PRODUCTORA*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(343,3997,'2',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_oficina_productora" width="200px" size="25" onblur="closetree_oficina_productora()"> <input type="hidden" id="idclosetree_oficina_productora">
                                <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="oficina_productora" id="oficina_productora"   value="" ><label style="display:none" class="error" for="oficina_productora">Campo obligatorio.</label><div id="esperando_oficina_productora">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_oficina_productora" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_oficina_productora=new dhtmlXTreeObject("treeboxbox_oficina_productora","100%","100%",0);
                                tree_oficina_productora.setImagePath("../../imgs/");
                                tree_oficina_productora.enableTreeImages("false");
                                tree_oficina_productora.enableTreeLines("false");
                                tree_oficina_productora.enableIEImageFix(true);tree_oficina_productora.enableCheckBoxes(1);
                                    tree_oficina_productora.enableRadioButtons(true);
                                    tree_oficina_productora.enableSingleRadioMode(true);tree_oficina_productora.setOnLoadingStart(cargando_oficina_productora);
                                tree_oficina_productora.setOnLoadingEnd(fin_cargando_oficina_productora);tree_oficina_productora.enableSmartXMLParsing(true);tree_oficina_productora.loadXML("../../test_serie.php?tabla=dependencia&estado=1");tree_oficina_productora.setOnCheckHandler(onNodeSelect_oficina_productora);
                                    function onNodeSelect_oficina_productora(nodeId) {
                                        valor_destino=document.getElementById("oficina_productora");
                                        if(tree_oficina_productora.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_oficina_productora.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_oficina_productora() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_oficina_productora"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_oficina_productora() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_oficina_productora")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_oficina_productora"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div class="form-group" id="tr_observaciones">
                                        <label title="">OBSERVACIONES</label>
                                        <div class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(3998)); ?></textarea></div></div><div class="form-group" id="tr_anexos">
                                        <label title="">ANEXOS</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><div id="dz_campo_3999" class="saia_dz dropzone no-margin" data-nombre-campo="anexos" data-idformato="343" data-idcampo-formato="3999" data-extensiones="<?php echo $extensiones;?>" data-multiple="unico"><div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div></div></div><div class="form-group" id="tr_entregado_por">
                                <label title="">ENTREGADO POR*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(343,4000,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='4'  type="text" id="stext_entregado_por" width="200px" size="25" onblur="closetree_entregado_por()"> <input type="hidden" id="idclosetree_entregado_por">
                                <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="entregado_por" id="entregado_por"   value="" ><label style="display:none" class="error" for="entregado_por">Campo obligatorio.</label><div id="esperando_entregado_por">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_entregado_por" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","100%","100%",0);
                                tree_entregado_por.setImagePath("../../imgs/");
                                tree_entregado_por.enableTreeImages("false");
                                tree_entregado_por.enableTreeLines("false");
                                tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
                                    tree_entregado_por.enableRadioButtons(true);
                                    tree_entregado_por.enableSingleRadioMode(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
                                tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1");tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
                                    function onNodeSelect_entregado_por(nodeId) {
                                        valor_destino=document.getElementById("entregado_por");
                                        if(tree_entregado_por.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_entregado_por.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_entregado_por() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_entregado_por"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_entregado_por() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_entregado_por")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_entregado_por"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div class="form-group" id="tr_recibido_por">
                                <label title="">RECIBIDO POR*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(343,4001,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='5'  type="text" id="stext_recibido_por" width="200px" size="25" onblur="closetree_recibido_por()"> <input type="hidden" id="idclosetree_recibido_por">
                                <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="recibido_por" id="recibido_por"   value="" ><label style="display:none" class="error" for="recibido_por">Campo obligatorio.</label><div id="esperando_recibido_por">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_recibido_por" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","100%","100%",0);
                                tree_recibido_por.setImagePath("../../imgs/");
                                tree_recibido_por.enableTreeImages("false");
                                tree_recibido_por.enableTreeLines("false");
                                tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
                                    tree_recibido_por.enableRadioButtons(true);
                                    tree_recibido_por.enableSingleRadioMode(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
                                tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1");tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
                                    function onNodeSelect_recibido_por(nodeId) {
                                        valor_destino=document.getElementById("recibido_por");
                                        if(tree_recibido_por.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_recibido_por.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_recibido_por() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_recibido_por"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_recibido_por() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_recibido_por")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_recibido_por"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div class="form-group" id="tr_transferir_a">
                                        <label title="">TRANSFERIR A*</label><?php genera_campo_listados_editar(343,4002,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_agrupador">
                                <label title="">AGRUPADOR</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(343,6752,'3',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='6'  type="text" id="stext_agrupador" width="200px" size="25" onblur="closetree_agrupador()"> <input type="hidden" id="idclosetree_agrupador">
                                <a href="javascript:void(0)" onclick="buscar_nodo_agrupador('tree_agrupador')">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_agrupador.findItem((document.getElementById('stext_agrupador').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_agrupador.findItem((document.getElementById('stext_agrupador').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  name="agrupador" id="agrupador"   value="" ><label style="display:none" class="error" for="agrupador">Campo obligatorio.</label><div id="esperando_agrupador">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_agrupador" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_agrupador=new dhtmlXTreeObject("treeboxbox_agrupador","100%","100%",0);
                                tree_agrupador.setImagePath("../../imgs/");
                                tree_agrupador.enableTreeImages("false");
                                tree_agrupador.enableTreeLines("false");
                                tree_agrupador.enableIEImageFix(true);tree_agrupador.enableCheckBoxes(1);
                                    tree_agrupador.enableRadioButtons(true);
                                    tree_agrupador.enableSingleRadioMode(true);tree_agrupador.setOnLoadingStart(cargando_agrupador);
                                tree_agrupador.setOnLoadingEnd(fin_cargando_agrupador);tree_agrupador.setOnCheckHandler(onNodeSelect_agrupador);
                                    function onNodeSelect_agrupador(nodeId) {
                                        valor_destino=document.getElementById("agrupador");
                                        if(tree_agrupador.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_agrupador.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function closetree_agrupador() {
                                    var bus_ant=document.getElementById('idclosetree_agrupador').value;
                                    var bus_actual=document.getElementById('stext_agrupador').value.trim();
                                    if(bus_actual!=''){
                                        if(bus_actual!=bus_ant){
                                            document.getElementById('idclosetree_agrupador').value=bus_actual;
                                            tree_agrupador.closeAllItems('1#');
                                        }
                                    }
                                }function fin_cargando_agrupador() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_agrupador")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_agrupador")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_agrupador"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_agrupador() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_agrupador")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_agrupador")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_agrupador"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><input type="hidden" name="expedientes_padre" value="<?php echo(validar_valor_campo(6751)); ?>"><?php asignar_responsables(343,NULL);?><?php validacion_js_transferencia(343,NULL);?><input type="hidden" name="campo_descripcion" value="3997"><tr><td colspan='2'><?php submit_formato(343);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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