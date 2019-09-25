<?php

class TextareaGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        return <<<HTML
            <div class="form-group form-group-default {$this->getRequiredClass()}" id="group_{$this->CamposFormato->nombre}">
                <label title="{$this->CamposFormato->ayuda}">
                    {$this->getLabel()}
                </label>
                <div class="celda_transparente">
                    <textarea name="{$this->CamposFormato->nombre}" id="{$this->CamposFormato->nombre}" rows="3" class="form-control {$this->getRequiredClass()}">
                        {$this->getComponentValue()}
                    </textarea>
                    <script>
                        CKEDITOR.replace("{$this->CamposFormato->nombre}", {
                            removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                        });
                    </script>
                </div>
            </div>
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
        return $this->generateAditionComponent();
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
