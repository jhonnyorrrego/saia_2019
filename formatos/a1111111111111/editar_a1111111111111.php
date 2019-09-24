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
include_once $ruta_db_superior . 'formatos/a1111111111111/funciones.php';

llama_funcion_accion(null,455 ,'ingresar','ANTERIOR');
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
                    a1111111111111
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type="hidden" name="documento_iddocumento" value="<?= mostrar_valor_campo('documento_iddocumento',455,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="encabezado" value="<?= mostrar_valor_campo('encabezado',455,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="firma" value="<?= mostrar_valor_campo('firma',455,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="idft_a1111111111111" value="<?= mostrar_valor_campo('idft_a1111111111111',455,$_REQUEST['iddoc']) ?>">
<div class='form-group form-group-default required col-12 '  id='tr_campo_texto_7124825'>
            <label title=''>TEXTO EN UNA L&IACUTE;NEA<span>*</span></label>
            <input class='form-control required' type='text' id='campo_texto_7124825' name='campo_texto_7124825' value='<?= mostrar_valor_campo('campo_texto_7124825',455,$_REQUEST['iddoc']) ?>' />
        </div>
<input type="hidden" name="dependencia" value="<?= mostrar_valor_campo('dependencia',455,$_REQUEST['iddoc']) ?>">
        <div class='form-group form-group-default ' id='group_archivo_1869306737'>
            <label title=''>ADJUNTOS</label>
            <div class="" id="dropzone_archivo_1869306737"></div>
            <input type="hidden" class="" name="archivo_1869306737">
        </div>
        <script>
            $(function(){
                let options = 
                let loadeddropzone_archivo_1869306737 = [];
                $("#dropzone_archivo_1869306737").addClass('dropzone');
                let dropzone_archivo_1869306737 = new Dropzone('#dropzone_archivo_1869306737', {
                    url: '<?= $ruta_db_superior ?>app/temporal/cargar_anexos.php',
                    dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                    maxFilesize: options.longitud,
                    maxFiles: options.cantidad,
                    acceptedFiles: options.tipos,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Eliminar',
                    dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                    dictMaxFilesExceeded: `Máximo ${options.cantidad} archivos`,
                    params: {
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key'),
                        dir: 'a1111111111111'
                    },
                    paramName: 'file',
                    init : function() {
                                        $.post('<?= $ruta_db_superior ?>app/anexos/consultar_anexos_campo.php', {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    fieldId: 8389,
                    documentId: <?= $_REQUEST['iddoc'] ?>
                }, function(response){
                    if(response.success){
                        response.data.forEach(mockFile => {
                            dropzone_archivo_1869306737.removeAllFiles();
                            dropzone_archivo_1869306737.emit('addedfile', mockFile);
                            dropzone_archivo_1869306737.emit('thumbnail', mockFile, '<?= $ruta_db_superior ?>' + mockFile.route);
                            dropzone_archivo_1869306737.emit('complete', mockFile);

                            loadeddropzone_archivo_1869306737.push(mockFile.route);
                        });                        
                        $("[name='archivo_1869306737']").val(loadeddropzone_archivo_1869306737.join(','));
                        dropzone_archivo_1869306737.options.maxFiles = options.cantidad - loadeddropzone_archivo_1869306737.length;                        
                    }
                }, 'json');

                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loadeddropzone_archivo_1869306737.push(e);
                                });
                                $("[name='archivo_1869306737']").val(loadeddropzone_archivo_1869306737.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loadeddropzone_archivo_1869306737.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loadeddropzone_archivo_1869306737.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loadeddropzone_archivo_1869306737 = loadeddropzone_archivo_1869306737.filter((e,i) => i != index);
                            $("[name='archivo_1869306737']").val(loadeddropzone_archivo_1869306737.join(','));
                            dropzone_archivo_1869306737.options.maxFiles = options.cantidad - loadeddropzone_archivo_1869306737.length;
                        });
                    }
                });
            });
        </script>
<div class='form-group form-group-default required col-12 '  id='tr_campo_texto_1434206007'>
            <label title=''>TEXTO EN UNA L&IACUTE;NEA<span>*</span></label>
            <input class='form-control required' type='text' id='campo_texto_1434206007' name='campo_texto_1434206007' value='<?= mostrar_valor_campo('campo_texto_1434206007',455,$_REQUEST['iddoc']) ?>' />
        </div>
<div class='form-group col-12 ' id='tr_select_882476386'><label title=''>LISTA DESPLEGABLE<span>*</span></label><?php genera_campo_listados_editar(455,8392,$_REQUEST['iddoc']) ?> </div>
<div class="form-group  required" id="tr_radio_2139529154">
                        <label title="">SELECCI&OACUTE;N &UACUTE;NICA<span>*</span></label><?php genera_campo_listados_editar(455,8393,$_REQUEST['iddoc']) ?><label id="radio_2139529154-error" class="error" for="radio_2139529154" style="display: none;"></label><br></div>

<input type='hidden' name='campo_descripcion' value='8363'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='apoyo'>
<input type='hidden' name='formatId' value='455'>
<input type='hidden' name='tabla' value='ft_a1111111111111'>
<input type='hidden' name='formato' value='a1111111111111'>
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