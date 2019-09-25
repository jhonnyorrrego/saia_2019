<?php

class FileGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
{
    public function __construct($Formato, $CamposFormato, $scope)
    {
        return parent::__construct($Formato, $CamposFormato, $scope);
    }

    /**
     * genera un componente en ambito de adicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateAditionComponent()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $identificator = "dropzone_{$this->CamposFormato->nombre}";

        return <<<HTML
        <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$label}</label>
            <div class="" id="dropzone_{$this->CamposFormato->nombre}"></div>
            <input type="hidden" class="{$requiredClass}" name="{$this->CamposFormato->nombre}">
        </div>
        <script>
            $(function(){
                let options = {$this->CamposFormato->opciones}
                let loaded{$identificator} = [];
                $("#dropzone_{$this->CamposFormato->nombre}").addClass('dropzone');
                let {$identificator} = new Dropzone('#{$identificator}', {
                    url: '<?= \$ruta_db_superior ?>app/temporal/cargar_anexos.php',
                    dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                    maxFilesize: options.longitud,
                    maxFiles: options.cantidad,
                    acceptedFiles: options.tipos,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Eliminar',
                    dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                    dictMaxFilesExceeded: `Máximo \${options.cantidad} archivos`,
                    params: {
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key'),
                        dir: '{$this->Formato->nombre}'
                    },
                    paramName: 'file',
                    init : function() {
                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loaded{$identificator}.push(e);
                                });
                                $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loaded{$identificator}.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loaded{$identificator}.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loaded{$identificator} = loaded{$identificator}.filter((e,i) => i != index);
                            $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','));
                            {$identificator}.options.maxFiles = options.cantidad - loaded{$identificator}.length;
                        });
                    }
                });
            });
        </script>
HTML;
    }

    /**
     * genera un componente en ambito de edicion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function generateEditionComponente()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $identificator = "dropzone_{$this->CamposFormato->nombre}";

        return <<<HTML
        <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$label}</label>
            <div class="" id="dropzone_{$this->CamposFormato->nombre}"></div>
            <input type="hidden" class="{$requiredClass}" name="{$this->CamposFormato->nombre}">
        </div>
        <script>
            $(function(){
                let options = {$this->CamposFormato->opciones}
                let loaded{$identificator} = [];
                $("#dropzone_{$this->CamposFormato->nombre}").addClass('dropzone');
                let {$identificator} = new Dropzone('#{$identificator}', {
                    url: '<?= \$ruta_db_superior ?>app/temporal/cargar_anexos.php',
                    dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                    maxFilesize: options.longitud,
                    maxFiles: options.cantidad,
                    acceptedFiles: options.tipos,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Eliminar',
                    dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                    dictMaxFilesExceeded: `Máximo \${options.cantidad} archivos`,
                    params: {
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key'),
                        dir: '{$this->Formato->nombre}'
                    },
                    paramName: 'file',
                    init : function() {
                        $.post('<?= \$ruta_db_superior ?>app/anexos/consultar_anexos_campo.php', {
                            token: localStorage.getItem('token'),
                            key: localStorage.getItem('key'),
                            fieldId: {$this->CamposFormato->getPK()},
                            documentId: <?= \$_REQUEST['iddoc'] ?>
                        }, function(response){
                            if(response.success){
                                response.data.forEach(mockFile => {
                                    {$identificator}.removeAllFiles();
                                    {$identificator}.emit('addedfile', mockFile);
                                    {$identificator}.emit('thumbnail', mockFile, '<?= \$ruta_db_superior ?>' + mockFile.route);
                                    {$identificator}.emit('complete', mockFile);

                                    loaded{$identificator}.push(mockFile.route);
                                });                        
                                $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','));
                                {$identificator}.options.maxFiles = options.cantidad - loaded{$identificator}.length;                        
                            }
                        }, 'json');

                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loaded{$identificator}.push(e);
                                });
                                $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loaded{$identificator}.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loaded{$identificator}.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loaded{$identificator} = loaded{$identificator}.filter((e,i) => i != index);
                            $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','));
                            {$identificator}.options.maxFiles = options.cantidad - loaded{$identificator}.length;
                        });
                    }
                });
            });
        </script>
HTML;
    }

    /**
     * muestra el valor almacenado en un documento
     * de un componente especifico
     *
     * @param integer $fieldId
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function showValue($fieldId, $documentId)
    { }
}
