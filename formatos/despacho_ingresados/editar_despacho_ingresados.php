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
include_once $ruta_db_superior . 'formatos/despacho_ingresados/funciones.php';

llama_funcion_accion(null,353 ,'ingresar','ANTERIOR');
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
                    Planilla de Distribución
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type="hidden" name="tipo_mensajero" value="<?= mostrar_valor_campo('tipo_mensajero',353,$_REQUEST['iddoc']) ?>">
        <div class='form-group form-group-default ' id='group_anexo'>
            <label title=''>ANEXO</label>
            <div class="" id="dropzone_anexo"></div>
            <input type="hidden" class="" name="anexo">
        </div>
        <script>
            $(function(){
                let options = {"tipos":"1df,doc,docx,jpg,jpeg,gif,png,bmp,xls,xlsx,ppt","cantidad":"2"}
                let loadeddropzone_anexo = [];
                $("#dropzone_anexo").addClass('dropzone');
                let dropzone_anexo = new Dropzone('#dropzone_anexo', {
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
                        dir: 'despacho_ingresados'
                    },
                    paramName: 'file',
                    init : function() {
                                        $.post('<?= $ruta_db_superior ?>app/anexos/consultar_anexos_campo.php', {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    fieldId: 5018,
                    documentId: <?= $_REQUEST['iddoc'] ?>
                }, function(response){
                    if(response.success){
                        response.data.forEach(mockFile => {
                            dropzone_anexo.removeAllFiles();
                            dropzone_anexo.emit('addedfile', mockFile);
                            dropzone_anexo.emit('thumbnail', mockFile, '<?= $ruta_db_superior ?>' + mockFile.route);
                            dropzone_anexo.emit('complete', mockFile);

                            loadeddropzone_anexo.push(mockFile.route);
                        });                        
                        $("[name='anexo']").val(loadeddropzone_anexo.join(','));
                        dropzone_anexo.options.maxFiles = options.cantidad - loadeddropzone_anexo.length;                        
                    }
                }, 'json');

                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loadeddropzone_anexo.push(e);
                                });
                                $("[name='anexo']").val(loadeddropzone_anexo.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loadeddropzone_anexo.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loadeddropzone_anexo.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loadeddropzone_anexo = loadeddropzone_anexo.filter((e,i) => i != index);
                            $("[name='anexo']").val(loadeddropzone_anexo.join(','));
                            dropzone_anexo.options.maxFiles = options.cantidad - loadeddropzone_anexo.length;
                        });
                    }
                });
            });
        </script>
<input type="hidden" name="iddestino_radicacion" value="<?= mostrar_valor_campo('iddestino_radicacion',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="estado_documento" value="<?= mostrar_valor_campo('estado_documento',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="dependencia" value="<?= mostrar_valor_campo('dependencia',353,$_REQUEST['iddoc']) ?>">
<div class="form-group  " id="tr_tipo_recorrido">
                        <label title="">RECORRIDO DEL DIA</label><?php genera_campo_listados_editar(353,5087,$_REQUEST['iddoc']) ?><br></div>
<input type="hidden" name="docs_seleccionados" value="<?= mostrar_valor_campo('docs_seleccionados',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="mensajero" value="<?= mostrar_valor_campo('mensajero',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="idft_despacho_ingresados" value="<?= mostrar_valor_campo('idft_despacho_ingresados',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="fecha_entrega" value="<?= mostrar_valor_campo('fecha_entrega',353,$_REQUEST['iddoc']) ?>">
<div class='form-group col-12 ' id='tr_ventanilla'><label title=''>VENTANILLA<span>*</span></label><?php genera_campo_listados_editar(353,8319,$_REQUEST['iddoc']) ?> </div>
<input type="hidden" name="documento_iddocumento" value="<?= mostrar_valor_campo('documento_iddocumento',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="encabezado" value="<?= mostrar_valor_campo('encabezado',353,$_REQUEST['iddoc']) ?>">
<input type="hidden" name="firma" value="<?= mostrar_valor_campo('firma',353,$_REQUEST['iddoc']) ?>">

<input type='hidden' name='campo_descripcion' value='4080'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='apoyo'>
<input type='hidden' name='formatId' value='353'>
<input type='hidden' name='tabla' value='ft_despacho_ingresados'>
<input type='hidden' name='formato' value='despacho_ingresados'>
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