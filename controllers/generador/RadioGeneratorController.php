<?php

class RadioGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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

        if ($this->CamposFormato->obligatoriedad) {
            $labelRequired = "<label id='{$this->CamposFormato->nombre}-error' class='error' for='{$this->CamposFormato->nombre}' style='display: none;'></label>";
        } else {
            $labelRequired = '';
        }

        $text = "
        <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>
            <div class='radio radio-success'>
        ";

        $options = $this->CamposFormato->getRadioOptions();

        if (!$options) {
            throw new Exception("Debe indicar las opciones de {$this->CamposFormato->etiqueta}", 1);
        }

        foreach ($options as $key => $CampoOpciones) {
            $text .= "<input 
                {$requiredClass}
                type='radio'
                name='{$this->CamposFormato->nombre}'
                id='{$this->CamposFormato->nombre}{$key}'
                value='{$CampoOpciones->getPK()}'
                aria-required='true'>
                <label for='{$this->CamposFormato->nombre}{$key}'>
                    {$CampoOpciones->valor}
                </label>";
        }

        $text .= "</div>
            {$labelRequired}
        </div>";

        return $text;
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
        $text = $this->generateAditionComponent();
        $text .= <<<JAVASCRIPT
            <script>
                $(function(){
                    $.post(
                        '<?= \$ruta_db_superior ?>app/documento/consulta_seleccionado.php',
                        {
                            key: localStorage.getItem('key'),
                            token: localStorage.getItem('token'),
                            fieldId: {$this->CamposFormato->getPK()},
                            documentId: "<?= \$_REQUEST['iddoc'] ?>"
                        },
                        function (response) {
                            if (response.success) {
                                if(response.data){
                                    $("[name='{$this->CamposFormato->nombre}'][value='"+response.data+"']").prop('checked', true);
                                }
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        },
                        'json'
                    );
                });
            </script>
JAVASCRIPT;

        return $text;
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
