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
                                    <title>.:ADICIONAR RUTAS DE DISTRIBUCI&Oacute;N:.</title>
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
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><?php include_once('../../formatos/librerias/header_formato.php'); ?><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">
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
                            <div class="card-body"><center><h5 class="text-black">RUTAS DE DISTRIBUCIÓN</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],404,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(404,4991);?></div><div class="form-group" id="tr_fecha_ruta_distribuc"><label title="">FECHA*</label><?php fecha_formato(404,4986);?></div><div class="form-group form-group-default required"  id="tr_nombre_ruta">
                                        <label title="">NOMBRE DE LA RUTA</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="nombre_ruta" name="nombre_ruta" required value="<?php echo(validar_valor_campo(4987)); ?>">
                                       </div><div class="form-group" id="tr_descripcion_ruta">
                                        <label title="">DESCRIPCI&Oacute;N RUTA</label>
                                        <div class="celda_transparente"><textarea  tabindex='2'  name="descripcion_ruta" id="descripcion_ruta" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(4988)); ?></textarea></div></div><div class="form-group" id="tr_asignar_dependencias">
                                <label title="">DEPENDENCIAS DE LA RUTA*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(404,4998,'2',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='3'  type="text" id="stext_asignar_dependencias" width="200px" size="25" onblur="closetree_asignar_dependencias()"> <input type="hidden" id="idclosetree_asignar_dependencias">
                                <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  class="required"  name="asignar_dependencias" id="asignar_dependencias"   value="" ><label style="display:none" class="error" for="asignar_dependencias">Campo obligatorio.</label><div id="esperando_asignar_dependencias">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_asignar_dependencias" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_asignar_dependencias=new dhtmlXTreeObject("treeboxbox_asignar_dependencias","100%","100%",0);
                                tree_asignar_dependencias.setImagePath("../../imgs/");
                                tree_asignar_dependencias.enableTreeImages("false");
                                tree_asignar_dependencias.enableTreeLines("false");
                                tree_asignar_dependencias.enableIEImageFix(true);tree_asignar_dependencias.enableCheckBoxes(1);
                                    tree_asignar_dependencias.enableThreeStateCheckboxes(1);tree_asignar_dependencias.setOnLoadingStart(cargando_asignar_dependencias);
                                tree_asignar_dependencias.setOnLoadingEnd(fin_cargando_asignar_dependencias);tree_asignar_dependencias.enableSmartXMLParsing(true);tree_asignar_dependencias.loadXML("../../test_serie.php?tabla=dependencia&estado=1");tree_asignar_dependencias.setOnCheckHandler(onNodeSelect_asignar_dependencias);

                                    function onNodeSelect_asignar_dependencias(nodeId){
                                        valor_destino=document.getElementById("asignar_dependencias");
                                        destinos=tree_asignar_dependencias.getAllChecked();
                                        nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                                        nuevo=nuevo.replace(/\,$/gi,"");
                                        vector=destinos.split(",");
                                        for(i=0;i<vector.length;i++){
                                            if(vector[i].indexOf("_")!=-1){
                                                vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                                            }
                                            nuevo=vector.join(",");
                                            if(vector[i].indexOf("#")!=-1){
                                                hijos=tree_asignar_dependencias.getAllSubItems(vector[i]);
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
                                    }function fin_cargando_asignar_dependencias() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_asignar_dependencias")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_asignar_dependencias")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_asignar_dependencias"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_asignar_dependencias() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_asignar_dependencias")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_asignar_dependencias")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_asignar_dependencias"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }</script></div></div><div class="form-group" id="tr_asignar_mensajeros">
                                        <label title="">MENSAJEROS DE LA RUTA*</label><?php genera_campo_listados_editar(404,4999,$_REQUEST['iddoc']);?></div><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4993)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4992)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4990)); ?>"><input type="hidden" name="idft_ruta_distribucion" value="<?php echo(validar_valor_campo(4989)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4985)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4984)); ?>"><?php add_edit_ruta_dist(404,NULL);?><input type="hidden" name="campo_descripcion" value="4987"><tr><td colspan='2'><?php submit_formato(404);?></td></tr></table></form></body>
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