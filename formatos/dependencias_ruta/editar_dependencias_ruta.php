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
                                    <title>.:EDITAR DEPENDENCIAS DE LA RUTA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
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
                            <div class="card-body"><?php llama_funcion_accion(@$_REQUEST["iddoc"],405,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>formatos/librerias/funciones_item.php" enctype="multipart/form-data"><input type="hidden" name="orden_dependencia" value="<?php echo(mostrar_valor_campo('orden_dependencia',405,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_dependencia" value="<?php echo(mostrar_valor_campo('estado_dependencia',405,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_fecha_item_dependenc">
<label for="fecha_item_dependenc">FECHA</label>
<label id="fecha_item_dependenc-error" class="error" for="fecha_item_dependenc" style="display: none;"></label>
<div class="input-group date">
<input  tabindex="1 " type="text" class="form-control"  id="fecha_item_dependenc"  required name="fecha_item_dependenc" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"defaultDate":"<?php echo(mostrar_valor_campo('fecha_item_dependenc',405,$_REQUEST['iddoc'])); ?>","format":"YYYY-MM-DD LT","locale":"es","useCurrent":true};
                $("#fecha_item_dependenc").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group" id="tr_dependencia_asignada">
                                <label title="">DEPENDENCIA*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(405,4995,'2',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='2'  type="text" id="stext_dependencia_asignada" width="200px" size="25" onblur="closetree_dependencia_asignada()"> <input type="hidden" id="idclosetree_dependencia_asignada">
                                <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="dependencia_asignada" id="dependencia_asignada"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(405,4995,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_dependencia_asignada">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_dependencia_asignada" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_dependencia_asignada=new dhtmlXTreeObject("treeboxbox_dependencia_asignada","100%","100%",0);
                                tree_dependencia_asignada.setImagePath("../../imgs/");
                                tree_dependencia_asignada.enableTreeImages("false");
                                tree_dependencia_asignada.enableTreeLines("false");
                                tree_dependencia_asignada.enableIEImageFix(true);tree_dependencia_asignada.enableCheckBoxes(1);
                                    tree_dependencia_asignada.enableRadioButtons(true);
                                    tree_dependencia_asignada.enableSingleRadioMode(true);tree_dependencia_asignada.setOnLoadingStart(cargando_dependencia_asignada);
                                tree_dependencia_asignada.setOnLoadingEnd(fin_cargando_dependencia_asignada);tree_dependencia_asignada.enableSmartXMLParsing(true);tree_dependencia_asignada.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);tree_dependencia_asignada.setOnCheckHandler(onNodeSelect_dependencia_asignada);
                                    function onNodeSelect_dependencia_asignada(nodeId) {
                                        valor_destino=document.getElementById("dependencia_asignada");
                                        if(tree_dependencia_asignada.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_dependencia_asignada.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_dependencia_asignada() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_dependencia_asignada"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_dependencia_asignada() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_dependencia_asignada")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_dependencia_asignada"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(405,4995,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_dependencia_asignada.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group" id="tr_descripcion_dependen">
                                        <label title="">DESCRIPCIÃ³N</label>
                                        <div class="celda_transparente"><textarea  tabindex='3'  name="descripcion_dependen" id="descripcion_dependen" cols="53" rows="3" class="form-control"><?php echo(mostrar_valor_campo('descripcion_dependen',405,$_REQUEST['iddoc'])); ?></textarea></div></div><input type="hidden" name="idft_dependencias_ruta" value="<?php echo(mostrar_valor_campo('idft_dependencias_ruta',405,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="405"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="dependencias_ruta"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(405,$_REQUEST['iddoc']);?></td></tr></table></form></body>
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