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
                                    <title>.:EDITAR AQWEQ:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><style>
ul.fancytree-container {
	width: 80%;
	height: 80%;
	overflow: auto;
	position: relative;
	border: none !important;
    outline:none !important;
}
span.fancytree-title {
    font-family: verdana;
	font-size: 7pt;
}
span.fancytree-checkbox.fancytree-radio {
    vertical-align: middle;
}
span.fancytree-expander {
    vertical-align: middle !important;
}
</style><?php include_once($ruta_db_superior . "arboles/crear_arbol_ft.php"); ?><?= jqueryUi() ?><?= arboles_ft("2.30", "filtro", "lion") ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script>
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
                            <div class="card-body"><center><h4 class="text-black">AQWEQ</h4></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],421,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="idft_aqweq" value="<?php echo(mostrar_valor_campo('idft_aqweq',421,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(421,6952,$_REQUEST['iddoc']);?></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',421,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',421,$_REQUEST['iddoc'])); ?>"><div class="form-group form-group-default "  id="tr_">
                                        <label title=""></label>
                                        <input class="form-control"  maxlength="11"   tabindex='1'  type="text"  size="100" id="" name=""  value="<?php echo(mostrar_valor_campo('',421,$_REQUEST['iddoc'])); ?>">
                                       </div><div class="form-group" id="tr_textarea_cke_1900682255">
                                        <label title="">TEXTO CON FORMATO*</label>
                                        <div class="celda_transparente"><textarea  tabindex='2'  name="textarea_cke_1900682255" id="textarea_cke_1900682255" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('textarea_cke_1900682255',421,$_REQUEST['iddoc'])); ?></textarea><script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("textarea_cke_1900682255", config);
                            </script>
                            </div></div><div class="form-group" id="tr_moneda_302700784">
<label title="" for="moneda_302700784">Moneda</label>
<div class="input-group" >
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
<input class="form-control"     tabindex="3 " type="number" id="moneda_302700784" name="moneda_302700784"  value="">
</div>
</div><div class="form-group form-group-default required"  id="tr_campo_texto_668517301">
                                        <label title="">TEXTO EN UNA L&Iacute;NEA</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='4'  type="text"  size="100" id="campo_texto_668517301" name="campo_texto_668517301" required value="<?php echo(mostrar_valor_campo('campo_texto_668517301',421,$_REQUEST['iddoc'])); ?>">
                                       </div><?php $origen_7031 = array(
                                    "url" => "",
                                    "ruta_db_superior" => $ruta_db_superior,);$origen_7031["params"]["checkbox"]="radio";$opciones_arbol_7031 = array(
                                    "keyboard" => true,"selectMode" => 1,"seleccionarClick" => 1,"obligatorio" => 1,
                                );
                                $extensiones_7031 = array(
                                    "filter" => array()
                                );
                                $arbol_7031 = new ArbolFt("arbol_fancytree_1421261091", $origen_7031, $opciones_arbol_7031, $extensiones_7031);
                                echo $arbol_7031->generar_html();?><div class="form-group" id="tr_monedita">
<label title="" for="monedita">monedita</label>
<div class="input-group" style="width:100%;">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
<input class="form-control"  min="0" max="1000" step=1   tabindex="5 " type="number" id="monedita" name="monedita"  value="">
</div>
</div><input type="hidden" name="campo_descripcion" value="<?php echo('7032'); ?>"><input type="hidden" name="formato" value="421"><tr><td colspan='2'><?php submit_formato(421,$_REQUEST['iddoc']);?></td></tr></table></form></body>
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