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
                                    <title>.:ADICIONAR ITEM FACTURA ELECTR&Oacute;NICA:.</title>
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
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script>
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
                            <div class="card-body"><?php llama_funcion_accion(@$_REQUEST["iddoc"],439,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>formatos/librerias/funciones_item.php" enctype="multipart/form-data"><div class="form-group form-group-default required"  id="tr_cantidad">
                                        <label title="">CANTIDAD</label>
                                        <input class="form-control"  maxlength="11"  class="required"   tabindex='1'  type="text"  size="100" id="cantidad" name="cantidad" required value="<?php echo(validar_valor_campo(7192)); ?>">
                                       </div><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(7194)); ?>"><?php listar_select_padres(); ?><input type="hidden" name="idft_ite_factur_electronica" value="<?php echo(validar_valor_campo(7196)); ?>"><div class="form-group form-group-default required"  id="tr_impuesto_1">
                                        <label title="">IMP. 1</label>
                                        <input class="form-control"    tabindex='2'  type="text"  size="100" id="impuesto_1" name="impuesto_1" required value="<?php echo(validar_valor_campo(7197)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_impuesto_2">
                                        <label title="">IMP. 2</label>
                                        <input class="form-control"    tabindex='3'  type="text"  size="100" id="impuesto_2" name="impuesto_2" required value="<?php echo(validar_valor_campo(7198)); ?>">
                                       </div><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(7199)); ?>"><div class="form-group form-group-default required"  id="tr_valor_iva">
                                        <label title="">IVA</label>
                                        <input class="form-control"    tabindex='4'  type="text"  size="100" id="valor_iva" name="valor_iva" required value="<?php echo(validar_valor_campo(7200)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_valor_total">
                                        <label title="">TOTAL</label>
                                        <input class="form-control"   class="required"   tabindex='5'  type="text"  size="100" id="valor_total" name="valor_total" required value="<?php echo(validar_valor_campo(7201)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_valor_unitario">
                                        <label title="">VALOR UNITARIO</label>
                                        <input class="form-control"   class="required"   tabindex='6'  type="text"  size="100" id="valor_unitario" name="valor_unitario" required value="<?php echo(validar_valor_campo(7202)); ?>">
                                       </div><div class="form-group form-group-default required"  id="tr_descripcion">
                                        <label title="">DESCRIPCI&Oacute;N</label>
                                        <input class="form-control"  maxlength="255"  class="required"   tabindex='7'  type="text"  size="100" id="descripcion" name="descripcion" required value="<?php echo(validar_valor_campo(7193)); ?>">
                                       </div><div "form-group"><label>ACCION A SEGUIR LUEGO DE GUARDAR</label><div class="radio radio-success"><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar"><label for="opcion_item1">Adicionar otro</label><input type="radio" name="opcion_item" id="opcion_item" value="terminar" checked><label for="opcion_item">Terminar</label></div></div><input type="hidden" name="campo_descripcion" value="7193"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="ite_factur_electronica"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(439);?></td></tr></table></form></body>
      <script type="text/javascript">
      setInterval("auto_save('descripcion','ite_factur_electronica')",300000);
      </script>
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