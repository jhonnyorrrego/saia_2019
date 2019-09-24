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
                                    <title>.:ADICIONAR CORREO SAIA:.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> <?php include_once($ruta_db_superior . "assets/librerias.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../formatos/librerias/funciones_acciones.php'); ?><?php include_once('../../formatos/librerias/header_formato.php'); ?><?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?><?= validate() ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script><link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>css/selectize.css"/><script type="text/javascript" src="<?= $ruta_db_superior ?>js/selectize.js"></script>
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
                            <div class="card-body"><center><h5 class="text-black">CORREO SAIA</h5></center><?php llama_funcion_accion(@$_REQUEST["iddoc"],348,"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php"" enctype="multipart/form-data"><input type="hidden" name="ingresar_datos_factu" value="<?php echo(validar_valor_campo(6959)); ?>"><input type="hidden" name="fecha_datos" value="<?php echo(validar_valor_campo(6960)); ?>"><input type="hidden" name="responsable_datos_fa" value="<?php echo(validar_valor_campo(6961)); ?>"><input type="hidden" name="uid_correo" value="<?php echo(validar_valor_campo(6962)); ?>"><input type="hidden" name="buzon_correo" value="<?php echo(validar_valor_campo(6963)); ?>"><input type="hidden" name="fecha_factura" value="<?php echo(validar_valor_campo(6964)); ?>"><input type="hidden" name="cant_dias" value="<?php echo(validar_valor_campo(6965)); ?>"><input type="hidden" name="fecha_venc_fact" value="<?php echo(validar_valor_campo(6966)); ?>"><input type="hidden" name="concepto_fact" value="<?php echo(validar_valor_campo(6967)); ?>"><input type="hidden" name="valor_factura" value="<?php echo(validar_valor_campo(6968)); ?>"><input type="hidden" name="pago_desde" value="<?php echo(validar_valor_campo(6969)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4823)); ?>"><input type="hidden" name="idft_correo_saia" value="<?php echo(validar_valor_campo(4036)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4037)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4039)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4040)); ?>"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(348,4038);?></div><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4030)); ?>"><div class="form-group "  id="tr_asunto">
                                        <label title="Asunto del correo">ASUNTO*</label>
                                        <input class="form-control" required maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="asunto" name="asunto" required value="<?php echo(validar_valor_campo(4031)); ?>">
                                       </div><div class="form-group" id="tr_fecha_oficio_entrada">
<label for="fecha_oficio_entrada">FECHA OFICIO ENTRADA</label>
<label id="fecha_oficio_entrada-error" class="error" for="fecha_oficio_entrada" style="display: none;"></label>
<div class="input-group date">
<input  tabindex="2 " type="text" class="form-control"  id="fecha_oficio_entrada"  required name="fecha_oficio_entrada" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
            $(function () {
                var configuracion={"format":"YYYY-MM-DD LT","locale":"es","useCurrent":true};
                $("#fecha_oficio_entrada").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>
</div>
</div><div class="form-group "  id="tr_de">
                                        <label title="Remitente del correo">DE*</label>
                                        <input class="form-control" required maxlength="255"  class="required"   tabindex='3'  type="text"  size="100" id="de" name="de" required value="<?php echo(validar_valor_campo(4033)); ?>">
                                       </div><div class="form-group "  id="tr_para">
                                        <label title="">PARA*</label>
                                        <input class="form-control" required  class="required"   tabindex='4'  type="text"  size="100" id="para" name="para" required value="<?php echo(validar_valor_campo(4034)); ?>">
                                       </div><div class="form-group" id="tr_transferencia_correo">
                                       <label title="">TRANSFERIR</label><input type="text" class="form-control" name="transferencia_correo" id="transferencia_correo" value=""required></div>
    <script>
    $(document).ready(function(){
  $("[name='transferencia_correo']").selectize({
      valueField: "value",
      labelField: "text",
      searchField: "text",
  persist: false,
  createOnBlur: true,
  create: false,
  maxItems: null,
  load: function(query, callback) {
          if (!query.length) return callback();
          $.ajax({
              url: "../../autocompletar.php",
              type: "POST",
              dataType: "json",
              data: {
                  consulta: "eyJjYW1wb2lkIjoiZnVuY2lvbmFyaW9fY29kaWdvIiwiY2FtcG90ZXh0byI6WyJub21icmVzIiwiYXBlbGxpZG9zIl0sInRhYmxhcyI6WyJmdW5jaW9uYXJpbyJdLCJjb25kaWNpb24iOiJlc3RhZG89MSIsIm9yZGVuIjoiIn0=",
                  valor: query,
              },
              error: function() {
                  callback();
              },
              success: function(res) {
                  callback(res);
              }
          });
      }
  });
    });</script><div class="form-group" id="tr_comentario">
                                        <label title="Comentario del correo">COMENTARIO</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='5'  name="comentario" id="comentario" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(4042)); ?></textarea></div></div><input type="hidden" name="anexos" value="<?php echo(validar_valor_campo(4035)); ?>"><input type="hidden" name="no_factura" value="<?php echo(validar_valor_campo(6955)); ?>"><input type="hidden" name="nit_proveedor" value="<?php echo(validar_valor_campo(6956)); ?>"><input type="hidden" name="centro_costo" value="<?php echo(validar_valor_campo(6957)); ?>"><input type="hidden" name="adjunto_imagen" value="<?php echo(validar_valor_campo(6958)); ?>"><?php recibir_datos(348,NULL);?><input type="hidden" name="campo_descripcion" value="4031"><tr><td colspan='2'><?php submit_formato(348);?></td></tr></table></form></body>
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