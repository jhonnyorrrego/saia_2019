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
include_once $ruta_db_superior . 'formatos/prim_format_desd_cero_/funciones.php';

llama_funcion_accion(null,453 ,'ingresar','ANTERIOR');
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
                    Primer Formato desde Ceros 
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type="hidden" name="idft_prim_format_desd_cero_" value="<?= mostrar_valor_campo('idft_prim_format_desd_cero_',453,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="documento_iddocumento" value="<?= mostrar_valor_campo('documento_iddocumento',453,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="encabezado" value="<?= mostrar_valor_campo('encabezado',453,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="firma" value="<?= mostrar_valor_campo('firma',453,$_REQUEST['iddoc']) ?>">
<div class='form-group form-group-default required col-12 '  id='tr_campo_texto_484281000'>
            <label title=''>TEXTO EN UNA LíNEA<span>*</span></label>
            <input class='form-control required' type='text' id='campo_texto_484281000' name='campo_texto_484281000' value='<?= mostrar_valor_campo('campo_texto_484281000',453,$_REQUEST['iddoc']) ?>' />
        </div>
<?php buscar_dependencia(453, $_REQUEST['iddoc']) ?>

<input type='hidden' name='campo_descripcion' value='8778'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='radicacion_entrada'>
<input type='hidden' name='formatId' value='453'>
<input type='hidden' name='tabla' value='ft_prim_format_desd_cero_'>
<input type='hidden' name='formato' value='prim_format_desd_cero_'>
<input type='hidden' name='token'>
<input type='hidden' name='key'>
<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>
                </form>
            </div>
        </div>
    </div>
    
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