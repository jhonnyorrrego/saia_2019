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
                                    <title>.:EDITAR DISTRIBUCI&Oacute;N F&Iacute;SICA:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../carta/funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= pace() ?>
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
                            <div class="card-body"><center><h5 class="text-black">DISTRIBUCIÓN FÍSICA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],272,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="fecha_recibido" value="<?php echo(mostrar_valor_campo('fecha_recibido',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_recibido" value="<?php echo(mostrar_valor_campo('usuario_recibido',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_entregado" value="<?php echo(mostrar_valor_campo('fecha_entregado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_entregado" value="<?php echo(mostrar_valor_campo('usuario_entregado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',272,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(272,3131,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_fecha_documento"><label title="">FECHA*</label><?php fecha_formato(272,3125,$_REQUEST['iddoc']);?></div><div class="form-group" id="tr_nombre_mensajero">
                                <label title="">NOMBRE DE MENSAJERO*</label><div class="form-control"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(272,3126,'5',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_nombre_mensajero" width="200px" size="25" onblur="closetree_nombre_mensajero()"> <input type="hidden" id="idclosetree_nombre_mensajero">
                                <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),0,1)">
                                    <img src="../../botones/general/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),1)">
                                        <img src="../../botones/general/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value))">
                                    <img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="nombre_mensajero" id="nombre_mensajero"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(272,3126,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_nombre_mensajero">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_nombre_mensajero" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_nombre_mensajero=new dhtmlXTreeObject("treeboxbox_nombre_mensajero","100%","100%",0);
                                tree_nombre_mensajero.setImagePath("../../imgs/");
                                tree_nombre_mensajero.enableTreeImages("false");
                                tree_nombre_mensajero.enableTreeLines("false");
                                tree_nombre_mensajero.enableIEImageFix(true);tree_nombre_mensajero.enableCheckBoxes(1);
                                    tree_nombre_mensajero.enableRadioButtons(true);
                                    tree_nombre_mensajero.enableSingleRadioMode(true);tree_nombre_mensajero.setOnLoadingStart(cargando_nombre_mensajero);
                                tree_nombre_mensajero.setOnLoadingEnd(fin_cargando_nombre_mensajero);tree_nombre_mensajero.enableSmartXMLParsing(true);tree_nombre_mensajero.loadXML("../../test.php?rol=1",checkear_arbol);tree_nombre_mensajero.setOnCheckHandler(onNodeSelect_nombre_mensajero);
                                    function onNodeSelect_nombre_mensajero(nodeId) {
                                        valor_destino=document.getElementById("nombre_mensajero");
                                        if(tree_nombre_mensajero.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_nombre_mensajero.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_nombre_mensajero() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_nombre_mensajero"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_nombre_mensajero() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_mensajero")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_nombre_mensajero"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(272,3126,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_nombre_mensajero.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group  required" id="tr_nivel_urgencia">
                            <label title="">ESTADO*</label><?php genera_campo_listados_editar(272,3135,$_REQUEST['iddoc']);?><label id="-error" class="error" f or="nivel_urgencia" style="display: none;"></label><br></div><div class="form-group form-group-default required"  id="tr_destino">
                                        <label title="">DESTINO</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='2'  type="text"  size="100" id="destino" name="destino" required value="<?php echo(mostrar_valor_campo('destino',272,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_observaciones">
                                        <label title="">OBSERVACIONES</label>
                                        <div class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="form-control"><?php echo(mostrar_valor_campo('observaciones',272,$_REQUEST['iddoc'])); ?></textarea></div></div><input type="hidden" name="idft_distribucion_fisica" value="<?php echo(mostrar_valor_campo('idft_distribucion_fisica',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',272,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3125'); ?>"><input type="hidden" name="formato" value="272"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(272,$_REQUEST['iddoc']);?></td></tr></table></form></body>
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