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
                                    <title>.:EDITAR DESTINO_RADICACION:.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXCommon.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/dhtmlXTree.js"></script><?php include_once('../../formatos/librerias/header_formato.php'); ?><link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">
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
                            <div class="card-body"><?php llama_funcion_accion(@$_REQUEST["iddoc"],403,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>formatos/librerias/funciones_item.php" enctype="multipart/form-data"><input type="hidden" name="estado_recogida" value="<?php echo(mostrar_valor_campo('estado_recogida',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_mensajero" value="<?php echo(mostrar_valor_campo('tipo_mensajero',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="ruta_origen" value="<?php echo(mostrar_valor_campo('ruta_origen',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="ruta_destino" value="<?php echo(mostrar_valor_campo('ruta_destino',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="finalizacion_observa" value="<?php echo(mostrar_valor_campo('finalizacion_observa',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_destino_radicacion" value="<?php echo(mostrar_valor_campo('idft_destino_radicacion',403,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_nombre_destino">
                                <label title="">DESTINO*</label><div class="form-controls"><div id="seleccionados"><?php if(isset($_REQUEST["iddoc"])){mostrar_seleccionados(403,4972,'0',$_REQUEST['iddoc']);}?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_nombre_destino" width="200px" size="25" onblur="closetree_nombre_destino()"> <input type="hidden" id="idclosetree_nombre_destino">
                                <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),0,1)">
                                    <img src="../../assets/images/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),1)">
                                        <img src="../../assets/images/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value))">
                                    <img src="../../assets/images/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="nombre_destino" id="nombre_destino"   value="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(403,4972,1,$_REQUEST['iddoc']);}?>" ><div id="esperando_nombre_destino">
                                    <img src="../../imagenes/cargando.gif">
                                </div>
                                <div id="treeboxbox_nombre_destino" height="90%"></div><script type="text/javascript">
                                var browserType;
                                if (document.layers) {browserType = "nn4"}
                                if (document.all) {browserType = "ie"}
                                if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                    browserType= "gecko"
                                }
                                tree_nombre_destino=new dhtmlXTreeObject("treeboxbox_nombre_destino","100%","100%",0);
                                tree_nombre_destino.setImagePath("../../imgs/");
                                tree_nombre_destino.enableTreeImages("false");
                                tree_nombre_destino.enableTreeLines("false");
                                tree_nombre_destino.enableIEImageFix(true);tree_nombre_destino.enableCheckBoxes(1);
                                    tree_nombre_destino.enableRadioButtons(true);
                                    tree_nombre_destino.enableSingleRadioMode(true);tree_nombre_destino.setOnLoadingStart(cargando_nombre_destino);
                                tree_nombre_destino.setOnLoadingEnd(fin_cargando_nombre_destino);tree_nombre_destino.enableSmartXMLParsing(true);tree_nombre_destino.loadXML("../../test.php?sin_padre=1&rol=1",checkear_arbol);tree_nombre_destino.setOnCheckHandler(onNodeSelect_nombre_destino);
                                    function onNodeSelect_nombre_destino(nodeId) {
                                        valor_destino=document.getElementById("nombre_destino");
                                        if(tree_nombre_destino.isItemChecked(nodeId)){
                                            if(valor_destino.value!=="")
                                            tree_nombre_destino.setCheck(valor_destino.value,false);

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }function fin_cargando_nombre_destino() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_nombre_destino"]');
                                    }
                                    document.poppedLayer.style.display = "none";
                                }

                                function cargando_nombre_destino() {
                                    if (browserType == "gecko" ) {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
                                    } else if (browserType == "ie") {
                                        document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
                                    } else {
                                        document.poppedLayer = eval('document.layers["esperando_nombre_destino"]');
                                    }
                                    document.poppedLayer.style.display = "";
                                }function checkear_arbol(){
                                        vector2="<?php if(isset($_REQUEST["iddoc"])){cargar_seleccionados(403,4972,1,$_REQUEST['iddoc']);}?>";
                                        vector2=vector2.split(",");
                                        for(m=0;m<vector2.length;m++) {
                                            tree_nombre_destino.setCheck(vector2[m],true);
                                        }
                                    }
</script></div></div><div class="form-group "  id="tr_observacion_destino">
                                        <label title="">OBSERVACI&Oacute;N</label>
                                        <input class="form-control"    tabindex='2'  type="text"  size="100" id="observacion_destino" name="observacion_destino"  value="<?php echo(mostrar_valor_campo('observacion_destino',403,$_REQUEST['iddoc'])); ?>">
                                       </div><input type="hidden" name="nombre_origen" value="<?php echo(mostrar_valor_campo('nombre_origen',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_destino" value="<?php echo(mostrar_valor_campo('tipo_destino',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_origen" value="<?php echo(mostrar_valor_campo('tipo_origen',403,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_destino_externo">
                                        <label title="">DESTINO*</label>
                                        <input type="hidden" maxlength="255"  name="destino_externo" id="destino_externo" value="<?php echo(mostrar_valor_campo('destino_externo',403,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("5012",@$_REQUEST["iddoc"]); ?></div><input type="hidden" name="origen_externo" value="<?php echo(mostrar_valor_campo('origen_externo',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="mensajero_encargado" value="<?php echo(mostrar_valor_campo('mensajero_encargado',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="numero_item" value="<?php echo(mostrar_valor_campo('numero_item',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="recepcion" value="<?php echo(mostrar_valor_campo('recepcion',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="recepcion_fecha" value="<?php echo(mostrar_valor_campo('recepcion_fecha',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_item" value="<?php echo(mostrar_valor_campo('estado_item',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="anexos" value="<?php echo(mostrar_valor_campo('anexos',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="403"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="destino_radicacion"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(403,$_REQUEST['iddoc']);?></td></tr></table></form></body>
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