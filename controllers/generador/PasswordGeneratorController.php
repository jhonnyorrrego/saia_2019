<?php

class PasswordGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        return "<div class='form-group form-group-default {$this->getRequiredClass()}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>
            <input class='form-control {$this->getRequiredClass()}' type='password' name='{$this->CamposFormato->nombre}' value='{$this->getComponentValue()}'>
        </div>";
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
