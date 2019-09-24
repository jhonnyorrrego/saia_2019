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
include_once $ruta_db_superior . 'formatos/hacie_una_pru_form_nue/funciones.php';

llama_funcion_accion(null,454 ,'ingresar','ANTERIOR');
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
                    Haciendo una prueba - formato nuevo
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type="hidden" name="documento_iddocumento" value="<?= mostrar_valor_campo('documento_iddocumento',454,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="encabezado" value="<?= mostrar_valor_campo('encabezado',454,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="firma" value="<?= mostrar_valor_campo('firma',454,$_REQUEST['iddoc']) ?>">
<div class="form-group  " id="tr_radio_113957371">
                        <label title="hola">SELECCIóN úNICA</label><?php genera_campo_listados_editar(454,8644,$_REQUEST['iddoc']) ?><br></div>
<input type="hidden" name="dependencia" value="<?= mostrar_valor_campo('dependencia',454,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="idft_hacie_una_pru_form_nue" value="<?= mostrar_valor_campo('idft_hacie_una_pru_form_nue',454,$_REQUEST['iddoc']) ?>">
<p id='etiqueta_parrafo_950633887'>
            dsfasdf
        </p>
<?php obtenerAlgo(454, $_REQUEST['iddoc']) ?>

<input type='hidden' name='campo_descripcion' value='8644'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='radicacion_interna'>
<input type='hidden' name='formatId' value='454'>
<input type='hidden' name='tabla' value='ft_hacie_una_pru_form_nue'>
<input type='hidden' name='formato' value='hacie_una_pru_form_nue'>
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