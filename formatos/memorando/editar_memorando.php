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
include_once $ruta_db_superior . 'formatos/memorando/funciones.php';

llama_funcion_accion(null,2 ,'ingresar','ANTERIOR');
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
                    Comunicación Interna
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type="hidden" name="expediente_serie" value="<?= mostrar_valor_campo('expediente_serie',2,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="firma" value="<?= mostrar_valor_campo('firma',2,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="encabezado" value="<?= mostrar_valor_campo('encabezado',2,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="estado_documento" value="<?= mostrar_valor_campo('estado_documento',2,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="idft_memorando" value="<?= mostrar_valor_campo('idft_memorando',2,$_REQUEST['iddoc']) ?>">
<div class="form-group col-12"  id="tr_fecha_memorando">
                                    <label title="">FECHA<span>*</span></label>
                                    <input class="form-control" required type="text"  size="100" id="fecha_memorando" name="fecha_memorando" required value="<?= mostrar_valor_campo('fecha_memorando',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<div class="form-group col-12"  id="tr_serie_idserie">
                                    <label title="">CLASIFICAR EN EXPEDIENTE</label>
                                    <input class="form-control"  type="text"  size="100" id="serie_idserie" name="serie_idserie"  value="<?= mostrar_valor_campo('serie_idserie',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<div class="form-group col-12"  id="tr_destino">
                                    <label title="">DESTINO</label>
                                    <input class="form-control"  type="text"  size="100" id="destino" name="destino"  value="<?= mostrar_valor_campo('destino',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<input type="hidden" name="documento_iddocumento" value="<?= mostrar_valor_campo('documento_iddocumento',2,$_REQUEST['iddoc']) ?>">
<div class="form-group col-12"  id="tr_copia">
                                    <label title="">CON COPIA A</label>
                                    <input class="form-control"  type="text"  size="100" id="copia" name="copia"  value="<?= mostrar_valor_campo('copia',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<div class="form-group col-12"  id="tr_asunto">
                                    <label title="">ASUNTO<span>*</span></label>
                                    <input class="form-control" required type="text"  size="100" id="asunto" name="asunto" required value="<?= mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']) ?>">
                                    </div>
            <div class="form-group" id="tr_contenido">
                <label title="">
                    CONTENIDO<span>*</span>
                </label>
                <div class="celda_transparente">
                    <textarea name="contenido" id="contenido" rows="3" class="form-control required">
                        <?= mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']) ?>
                    </textarea>
                    <script>
                        CKEDITOR.replace("contenido", {
                            removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                        });
                    </script>
                </div>
            </div>';
<div class="form-group col-12"  id="tr_despedida">
                                    <label title="">DESPEDIDA<span>*</span></label>
                                    <input class="form-control" required type="text"  size="100" id="despedida" name="despedida" required value="<?= mostrar_valor_campo('despedida',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<div class="form-group col-12"  id="tr_iniciales">
                                    <label title="">INICIALES DE QUIEN PREPARO EL MEMORANDO<span>*</span></label>
                                    <input class="form-control" required type="text"  size="100" id="iniciales" name="iniciales" required value="<?= mostrar_valor_campo('iniciales',2,$_REQUEST['iddoc']) ?>">
                                    </div>
        <div class='form-group form-group-default ' id='group_anexos'>
            <label title='Anexos digitales'>ANEXOS DIGITALES</label>
            <div class="" id="dropzone_anexos"></div>
            <input type="hidden" class="" name="anexos">
        </div>
        <script>
            $(function(){
                let options = {"tipos":"1df,doc,docx,jpg,jpeg,gif,png,bmp,xls,xlsx,ppt","longitud":"3","cantidad":"2"}
                let loadeddropzone_anexos = [];
                $("#dropzone_anexos").addClass('dropzone');
                let dropzone_anexos = new Dropzone('#dropzone_anexos', {
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
                        dir: 'memorando'
                    },
                    paramName: 'file',
                    init : function() {
                                        $.post('<?= $ruta_db_superior ?>app/anexos/consultar_anexos_campo.php', {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    fieldId: 32,
                    documentId: <?= $_REQUEST['iddoc'] ?>
                }, function(response){
                    if(response.success){
                        response.data.forEach(mockFile => {
                            dropzone_anexos.removeAllFiles();
                            dropzone_anexos.emit('addedfile', mockFile);
                            dropzone_anexos.emit('thumbnail', mockFile, '<?= $ruta_db_superior ?>' + mockFile.route);
                            dropzone_anexos.emit('complete', mockFile);

                            loadeddropzone_anexos.push(mockFile.route);
                        });                        
                        $("[name='anexos']").val(loadeddropzone_anexos.join(','));
                        dropzone_anexos.options.maxFiles = options.cantidad - loadeddropzone_anexos.length;                        
                    }
                }, 'json');

                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loadeddropzone_anexos.push(e);
                                });
                                $("[name='anexos']").val(loadeddropzone_anexos.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loadeddropzone_anexos.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loadeddropzone_anexos.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loadeddropzone_anexos = loadeddropzone_anexos.filter((e,i) => i != index);
                            $("[name='anexos']").val(loadeddropzone_anexos.join(','));
                            dropzone_anexos.options.maxFiles = options.cantidad - loadeddropzone_anexos.length;
                        });
                    }
                });
            });
        </script>
<div class="form-group col-12"  id="tr_anexos_fisicos">
                                    <label title="">ANEXOS FISICOS</label>
                                    <input class="form-control"  type="text"  size="100" id="anexos_fisicos" name="anexos_fisicos"  value="<?= mostrar_valor_campo('anexos_fisicos',2,$_REQUEST['iddoc']) ?>">
                                    </div>
<div class="form-group  required" id="tr_email_aprobar">
                        <label title="">APROBAR FUERA DE SAIA<span>*</span></label><?php genera_campo_listados_editar(2,5176,$_REQUEST['iddoc']) ?><label id="email_aprobar-error" class="error" for="email_aprobar" style="display: none;"></label><br></div>

<input type='hidden' name='campo_descripcion' value='23,6921'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='radicacion_interna'>
<input type='hidden' name='formatId' value='2'>
<input type='hidden' name='tabla' value='ft_memorando'>
<input type='hidden' name='formato' value='memorando'>
<input type='hidden' name='token'>
<input type='hidden' name='key'>
<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>
                </form>
            </div>
        </div>
    </div>
    <?php fecha_formato(2,$_REQUEST['iddoc'] ?? null) ?>
<?php mostrar_imagenes(2,$_REQUEST['iddoc'] ?? null) ?>

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