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
                                    <title>.:ADICIONAR RADICACI&Oacute;N DE CORRESPONDENCIA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../librerias/funciones_formatos_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
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
                            <div class="card-body"><center><h5 class="text-black">RADICACIÓN DE CORRESPONDENCIA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],3,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="despachado" value="<?php echo(validar_valor_campo(4977)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4824)); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(3,48);?></div><div id="tr_etiqueta_datos_gener">
                                        <h5 title="" id="etiqueta_datos_gener"><label ><CENTER><STRONG>DATOS GENERALES</STRONG></CENTER></label></h5>
                                      </div><div class="form-group" id="tr_fecha_radicacion_entrada"><label title="">FECHA DE RADICACI&Oacute;N*</label><?php fecha_formato(3,53);?></div><div class="form-group" id="tr_numero_radicado"><label title="">N&Uacute;MERO DE RADICADO</label><?php mostrar_radicado_entrada(3,54);?></div><div class="form-group  required" id="tr_tipo_origen">
                            <label title="">ORIGEN DEL DOCUMENTO*</label><?php genera_campo_listados_editar(3,4966,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_origen" style="display: none;"></label><br></div><div class="form-group" id="tr_fecha_oficio_entrada">
<label for="fecha_oficio_entrada">FECHA DOCUMENTO ENTRADA</label>

<div class="input-group date">
<input  tabindex="1 " type="text" class="form-control"  id="fecha_oficio_entrada"   name="fecha_oficio_entrada" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $("#fecha_oficio_entrada").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group form-group-default "  id="tr_numero_oficio">
                                        <label title="">N&Uacute;MERO DE DOCUMENTO</label>
                                        <input class="form-control"  maxlength="255" style="width:350px"  tabindex='2'  type="text"  size="100" id="numero_oficio" name="numero_oficio"  value="<?php echo(validar_valor_campo(36)); ?>">
                                       </div><div class="form-group" id="tr_descripcion">
                                        <label title="">ASUNTO*</label>
                                        <div class="celda_transparente"><textarea  tabindex='3'  name="descripcion" id="descripcion" cols="53" rows="3" class="form-control required"><?php echo(validar_valor_campo(39)); ?></textarea></div></div><div class="form-group" id="tr_descripcion_anexos">
                                        <label title="">ANEXOS FISICOS</label>
                                        <div class="celda_transparente"><textarea  tabindex='4'  name="descripcion_anexos" id="descripcion_anexos" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(41)); ?></textarea></div></div><div class="form-group" id="tr_anexos_digitales">
                                        <label title="">ANEXOS DIGITALES</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding"><div id="dz_campo_42" class="saia_dz dropzone no-margin" data-nombre-campo="anexos_digitales" data-idformato="3" data-idcampo-formato="42" data-extensiones="<?php echo $extensiones;?>" data-multiple="multiple"><div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div></div></div></div><div class="form-group  " id="tr_requiere_recogida">
                            <label title="">REQUIERE SERVICIO DE RECOGIDA?</label><?php genera_campo_listados_editar(3,5199,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_origen" style="display: none;"></label><br></div><div class="form-group  " id="tr_tipo_mensajeria">
                            <label title="">REQUIERE SERVICIO DE ENTREGA?</label><?php genera_campo_listados_editar(3,4970,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_origen" style="display: none;"></label><br></div><div class="form-group form-group-default "  id="tr_numero_guia">
                                        <label title="">N&Uacute;MERO DE GU&Iacute;A</label>
                                        <input class="form-control"  maxlength="255"   tabindex='6'  type="text"  size="100" id="numero_guia" name="numero_guia"  value="<?php echo(validar_valor_campo(5083)); ?>">
                                       </div><div class="form-group" id="tr_empresa_transportado">
                                        <label title="">EMPRESA TRANSPORTADORA</label><?php genera_campo_listados_editar(3,5084,$_REQUEST['iddoc']);?></div><div id="tr_etiqueta_origen">
                                        <h5 title="" id="etiqueta_origen"><label ><CENTER><STRONG>INFORMACI&Oacute;N ORIGEN</STRONG></CENTER></label></h5>
                                      </div><div class="form-group" id="tr_persona_natural">
                                        <label title="">PERSONA NATURAL/JUR&Iacute;DICA*</label>
                                        <input type="hidden" maxlength="255"  name="persona_natural" id="persona_natural" value=""><?php componente_ejecutor("37",@$_REQUEST["iddoc"]); ?></div><div class="form-group" id="tr_area_responsable">
                                <label title="">FUNCIONARIO RESPONSABLE*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(3,4967,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='7'  type="text" id="stext_area_responsable" width="200px" size="25" onblur="closetree_area_responsable()"> <input type="hidden" id="idclosetree_area_responsable">
                                <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><div id="esperando_area_responsable">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_area_responsable" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                                tree_area_responsable.setImagePath("../../imgs/");
                                tree_area_responsable.enableTreeImages("false");
                                tree_area_responsable.enableTreeLines("false");
                                tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                                    tree_area_responsable.enableRadioButtons(true);
                                    tree_area_responsable.enableSingleRadioMode(true);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                                tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?sin_padre=1&rol=1");tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                                    function onNodeSelect_area_responsable(nodeId) {
                                        valor_destino=document.getElementById("area_responsable");
                                        if(tree_area_responsable.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_area_responsable.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_area_responsable() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_area_responsable"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_area_responsable() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_area_responsable"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div id="tr_etiqueta_destino">
                                        <h5 title="" id="etiqueta_destino"><label ><CENTER><STRONG>INFORMACI&Oacute;N DESTINO</STRONG></CENTER></label></h5>
                                      </div><div class="form-group  required" id="tr_tipo_destino">
                            <label title="">DESTINO DEL DOCUMENTO*</label><?php genera_campo_listados_editar(3,4968,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="tipo_destino" style="display: none;"></label><br></div><div class="form-group" id="tr_destino">
                                <label title="">DESTINO*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(3,43,'5
',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='8'  type="text" id="stext_destino" width="200px" size="25" onblur="closetree_destino()"> <input type="hidden" id="idclosetree_destino">
                                <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</label><div id="esperando_destino">
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
                                tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");tree_destino.setOnCheckHandler(onNodeSelect_destino);

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
                                }</script></div></div><div class="form-group" id="tr_serie_idserie">
                                <label title="Radicacion entrada">TIPO DOCUMENTAL</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(3,52,'1',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_serie_idserie" width="200px" size="25" onblur="closetree_serie_idserie()"> <input type="hidden" id="idclosetree_serie_idserie">
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="" ><label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label><div id="esperando_serie_idserie">
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
                                tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.enableSmartXMLParsing(true);tree_serie_idserie.loadXML("../../test/test_expediente_funcionario.php");tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
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
                                }</script></div></div><div class="form-group" id="tr_copia_a">
                                <label title="">COPIA ELECTR&Oacute;NICA A</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(3,44,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='10'  type="text" id="stext_copia_a" width="200px" size="25" onblur="closetree_copia_a()"> <input type="hidden" id="idclosetree_copia_a">
                                <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="copia_a" id="copia_a"   value="" ><label style="display:none" class="error" for="copia_a">Campo obligatorio.</label><div id="esperando_copia_a">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_copia_a" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","100%","100%",0);
                                tree_copia_a.setImagePath("../../imgs/");
                                tree_copia_a.enableTreeImages("false");
                                tree_copia_a.enableTreeLines("false");
                                tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
                                    tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
                                tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1");tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);

                                    function onNodeSelect_copia_a(nodeId){
                                        valor_destino=document.getElementById("copia_a");
                                        destinos=tree_copia_a.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_copia_a.getAllSubItems(vector[i]);
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
                                    }function fin_cargando_copia_a() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia_a"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_copia_a() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_copia_a"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div class="form-group" id="tr_persona_natural_dest">
                                        <label title="">PERSONA NATURAL O JUR&Iacute;DICA*</label>
                                        <input type="hidden" maxlength="255"  name="persona_natural_dest" id="persona_natural_dest" value=""><?php componente_ejecutor("4969",@$_REQUEST["iddoc"]); ?></div><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(49)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(47)); ?>"><input type="hidden" name="idft_radicacion_entrada" value="<?php echo(validar_valor_campo(46)); ?>"><input type="hidden" name="estado_radicado" value="<?php echo(validar_valor_campo(56)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(50)); ?>"><div class="form-group  required" id="tr_colilla">
                            <label title="">COLILLA*</label><?php genera_campo_listados_editar(3,7009,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="colilla" style="display: none;"></label><br></div><?php quitar_descripcion_entrada(3,NULL);?><?php tipo_radicado_radicacion(3,NULL);?><?php serie_documental_radicacion(3,NULL);?><?php digitalizar_formato(3,NULL);?><input type="hidden" name="campo_descripcion" value="39,54"><tr><td colspan='2'><?php submit_formato(3);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
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