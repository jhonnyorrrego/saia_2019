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
                                    <title>.:EDITAR PRUEBA NUEVO FORMATO:.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_std/ckeditor.js"></script><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= breakpoint() ?>
                        <?= toastr() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><script type="text/javascript" src="<?= $ruta_db_superior ?>js/jquery.spin.js"></script>
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

                                <link rel="stylesheet"
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
                			</head>
                			<div class=" container-fluid container-fixed-lg col-lg-8">
                    	<!-- START card -->
                    	<div class="card card-default">
                            <div class="card-body"><h5>PRUEBA NUEVO FORMATO</h5><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" class="form-horizontal" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="idft_un_formato" value="<?php echo(mostrar_valor_campo('idft_un_formato',413,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(413,6711,$_REQUEST['iddoc']);?></div><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',413,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',413,$_REQUEST['iddoc'])); ?>"><div class="form-group" id="tr_Nombre">
                     <label title="">CAMPO DE TEXTO*</label>
                     <input class="form-control"  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="Nombre" name="Nombre"  value="<?php echo(mostrar_valor_campo('Nombre',413,$_REQUEST['iddoc'])); ?>">
                    </div><div class="form-group" id="tr_link_1265888503">
                     <label title="">LINK*</label><textarea form-control cols="40" rows="3" name="link_1265888503" id="link_1265888503" maxlength="255"  class="required url" ><?php echo(mostrar_valor_campo('link_1265888503',413,$_REQUEST['iddoc'])); ?></textarea></div><div class="form-group" id="tr_password_117256542">
                     <label title="">PASSWORD*</label>
                     <input class="form-control"  tabindex='2'  type="password" name="password_117256542"  maxlength="255"  class="required"   value="<?php echo(mostrar_valor_campo('password_117256542',413,$_REQUEST['iddoc'])); ?>">
                    </div><div class="form-group" id="tr_contador_1067652812">
                     <label title="">CONTADOR</label>
                     <input class="form-control"  maxlength="255"   tabindex='3'  type="input" id="contador_1067652812" name="contador_1067652812"  value="<?php echo(mostrar_valor_campo('contador_1067652812',413,$_REQUEST['iddoc'])); ?>">
                    </div>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#contador_1067652812").spin({imageBasePath:'../../images/'});
              });
              </script><div class="form-group" id="tr_area_texto_cke">
                     <label title="">AREA DE TEXTO CKE*</label>
<div class="celda_transparente"><textarea  tabindex='4'  name="area_texto_cke" id="area_texto_cke" cols="53" rows="3" class="form-control required"><?php echo(mostrar_valor_campo('area_texto_cke',413,$_REQUEST['iddoc'])); ?></textarea><script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            var config = {
                                removePlugins : "sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("area_texto_cke", config);
                            </script>
                            </div></div><div class="form-group" id="tr_textarea_tiny_1323651124">
                     <label title="">AREA DE TEXTO*</label>
<div class="celda_transparente">
                     <textarea  tabindex='5'  name="textarea_tiny_1323651124" id="textarea_tiny_1323651124" cols="53" rows="3" class="form-control tiny_avanzado required"><?php echo(mostrar_valor_campo('textarea_tiny_1323651124',413,$_REQUEST['iddoc'])); ?></textarea></div></div><input type="hidden" name="formato" value="413"><tr><td colspan='2'><?php submit_formato(413,$_REQUEST['iddoc']);?></td></tr></table></form></body>
                		</html><?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>