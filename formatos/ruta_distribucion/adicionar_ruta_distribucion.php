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

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';
include_once $ruta_db_superior . 'formatos/librerias/funciones_acciones.php';
include_once $ruta_db_superior . 'app/arbol/crear_arbol_ft.php';
include_once $ruta_db_superior . 'anexosdigitales/funciones_archivo.php';
include_once $ruta_db_superior . 'formatos/ruta_distribucion/funciones.php';

llama_funcion_accion(null,404 ,'ingresar','ANTERIOR');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SGDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <?= pace() ?>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
    <?= moment() ?>
    <?= select2() ?>
    <?= validate() ?>
    <?= ckeditor() ?>
    <?= jqueryUi() ?>
    <?= fancyTree(true) ?>
    <?= dateTimePicker() ?>
    <?= dropzone() ?>
</head>

<body>
    <div class='container-fluid container-fixed-lg col-lg-8' style='overflow: auto;' id='content_container'>
        <div class='card card-default'>
            <div class='card-body'>
                <h5 class='text-black w-100 text-center'>
                    Rutas de Distribución
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <?php buscar_dependencia(404, $_REQUEST['iddoc']) ?>
<div class="form-group" id="tr_fecha_ruta_distribuc">
<label for="fecha_ruta_distribuc">FECHA Y HORA</label>
<label id="fecha_ruta_distribuc-error" class="error" for="fecha_ruta_distribuc" style="display: none;"></label>
<div class="input-group date">
<input type="text" class="form-control"  id="fecha_ruta_distribuc"  required name="fecha_ruta_distribuc" />
<div class="input-group-append">
<span class="input-group-text"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
                $(function () {
                    var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                    $("#fecha_ruta_distribuc").datetimepicker(configuracion);
                    $("#content_container").height($(window).height());
                });
            </script>
</div>
</div>
<div class='form-group form-group-default required col-12 '  id='tr_nombre_ruta'>
            <label title=''>NOMBRE DE LA RUTA<span>*</span></label>
            <input class='form-control required' type='text' id='nombre_ruta' name='nombre_ruta' value='' />
        </div>
<div class='form-group form-group-default  col-12 '  id='tr_descripcion_ruta'>
            <label title=''>DESCRIPCIóN RUTA</label>
            <input class='form-control ' type='text' id='descripcion_ruta' name='descripcion_ruta' value='' />
        </div>
<div class="form-group required" id="tr_asignar_dependencias">
                                    <label title="">DEPENDENCIAS DE LA RUTA<span>*</span></label><?php $origen_4998 = array(
                                "url" => "app/arbol/arbol_dependencia.php",
                                "ruta_db_superior" => $ruta_db_superior,);$origen_4998["params"]["checkbox"]="radio";$opciones_arbol_4998 = array(
                                "keyboard" => true,"selectMode" => 1,"seleccionarClick" => 1,"obligatorio" => 1,
                            );
                            $extensiones_4998 = array(
                                "filter" => array()
                            );
                            $arbol_4998 = new ArbolFt("asignar_dependencias", $origen_4998, $opciones_arbol_4998, $extensiones_4998);
                            echo $arbol_4998->generar_html();?></div>
<input type="hidden" name="serie_idserie" value="1">
<input type="hidden" name="estado_documento" value="">
<input type="hidden" name="firma" value="1">
<input type="hidden" name="encabezado" value="1">
<div class='form-group col-12 ' id='tr_asignar_mensajeros'><label title=''>MENSAJEROS DE LA RUTA<span>*</span></label><?php genera_campo_listados_editar(404,8336,$_REQUEST['iddoc']) ?> </div>
<input type="hidden" name="documento_iddocumento" value="">
<input type="hidden" name="idft_ruta_distribucion" value="">

<input type='hidden' name='campo_descripcion' value='4987'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='apoyo'>
<input type='hidden' name='formatId' value='404'>
<input type='hidden' name='tabla' value='ft_ruta_distribucion'>
<input type='hidden' name='formato' value='ruta_distribucion'>
<input type='hidden' name='token'>
<input type='hidden' name='key'>
<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>
                </form>
            </div>
        </div>
    </div>
    <?php fecha_formato(404,$_REQUEST['iddoc'] ?? null) ?>
<?php add_edit_ruta_dist(404,$_REQUEST['iddoc'] ?? null) ?>

    <script>
        $(function() {
            $("[name='token']").val(localStorage.getItem('token'));
            $("[name='key']").val(localStorage.getItem('key'));

            $("#continuar").click(function() {
                $("#formulario_formatos").validate({
                    ignore: [],
                    submitHandler: function(form) {
                        $("#continuar").hide();
                        $("#continuar").after(
                            $('<button>', {
                                class: 'btn btn-success',
                                disabled: true,
                                id: 'boton_enviando',
                                text: 'Enviando...'
                            })
                        );
                        form.submit();
                    },
                    invalidHandler: function() {
                        $("#continuar").show();
                        $("#boton_enviando").remove();
                    }
                });
            });
        });
    </script>
</body>
</html>