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
                                    <meta content="" name="Cero K" /> 
                                    <?php include_once($ruta_db_superior . "assets/librerias.php"); ?>
                                    <script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script>
                                    <?php include_once('../carta/funciones.php'); ?>
                                    <?php include_once('funciones.php'); ?>
                                    <?php include_once('../../formatos/librerias/funciones_generales.php'); ?>
                                    <?php include_once('../../formatos/librerias/funciones_acciones.php'); ?>
                                    <?php include_once('../../formatos/librerias/header_formato.php'); ?>
                                    <?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= theme() ?>
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
</style><?php include_once($ruta_db_superior . "arboles/crear_arbol_ft.php"); ?><?= jqueryUi() ?><?= fancyTree(true) ?><script type="text/javascript" src="<?= $ruta_db_superior ?>js/title2note.js"></script>
                  <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
                                  rel="stylesheet" type="text/css" media="screen" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"
                                  rel="stylesheet" type="text/css" media="screen" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css"
                                  rel="stylesheet" type="text/css" media="screen" />                                
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                  rel="stylesheet" type="text/css" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"
                                  rel="stylesheet" type="text/css" media="screen">
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
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="<?= $ruta_db_superior ?>class_transferencia.php" enctype="multipart/form-data"><div class="form-group" id="tr_dependencia"><label title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</label><?php buscar_dependencia(404,4991);?></div><div class="form-group" id="tr_fecha_ruta_distribuc"><label title="">FECHA*</label><?php fecha_formato(404,4986);?></div><div class="form-group "  id="tr_nombre_ruta">
                                        <label title="">NOMBRE DE LA RUTA*</label>
                                        <input class="form-control" required maxlength="255"  class="required"   tabindex='1'  type="text"  size="100" id="nombre_ruta" name="nombre_ruta" required value="<?php echo(validar_valor_campo(4987)); ?>">
                                       </div><div class="form-group" id="tr_descripcion_ruta">
                                        <label title="">DESCRIPCI&Oacute;N RUTA</label>
                                        <div class="celda_transparente">
                                        <textarea  tabindex='2'  name="descripcion_ruta" id="descripcion_ruta" cols="53" rows="3" class="form-control"><?php echo(validar_valor_campo(4988)); ?></textarea></div></div><div class="form-group  required" id="tr_asignar_dependencias">
                                        <label title="">DEPENDENCIAS DE LA RUTA*</label><?php $origen_4998 = array(
                                    "url" => "arboles/arbol_dependencia.php",
                                    "ruta_db_superior" => $ruta_db_superior,);$origen_4998["params"]["checkbox"]="radio";$opciones_arbol_4998 = array(
                                    "keyboard" => true,"selectMode" => 1,"seleccionarClick" => 1,"obligatorio" => 1,
                                );
                                $extensiones_4998 = array(
                                    "filter" => array()
                                );
                                $arbol_4998 = new ArbolFt("asignar_dependencias", $origen_4998, $opciones_arbol_4998, $extensiones_4998);
                                echo $arbol_4998->generar_html();?></div><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4993)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4992)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4990)); ?>"><input type="hidden" name="idft_ruta_distribucion" value="<?php echo(validar_valor_campo(4989)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4985)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4984)); ?>"><div class="form-group" id="tr_asignar_mensajeros">
                                        <label title="">MENSAJEROS DE LA RUTA*</label><?php genera_campo_listados_editar(404,8336,$_REQUEST['iddoc']);?></div><?php add_edit_ruta_dist(404,NULL);?><input type="hidden" name="campo_descripcion" value="4987"><tr><td colspan='2'><?php submit_formato(404);?></td></tr></table></form></body>
      <script type="text/javascript">
      setInterval("auto_save('asignar_mensajeros','ruta_distribucion')",300000);
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