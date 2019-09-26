<?php

class SelectGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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

        $text = "
        <div class='form-group form-group-default form-group-default-select2 {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>
            <div class='form-group'>
            <select name='{$this->CamposFormato->nombre}' id='{$this->CamposFormato->nombre}' $requiredClass>
            <option value=''>Por favor seleccione...</option>
        ";

        $options = $this->CamposFormato->getRadioOptions();

        if (!$options) {
            throw new Exception("Debe indicar las opciones de {$this->CamposFormato->etiqueta}", 1);
        }

        foreach ($options as $key => $CampoOpciones) {
            $text .= "<option value='{$CampoOpciones->getPK()}'>
                {$CampoOpciones->valor}
            </option>";
        }

        $text .= "</select>
                <script>
                $(document).ready(function() {
                    $('#{$this->CamposFormato->nombre}').select2();
                    $('#{$this->CamposFormato->nombre}').addClass('full-width');
                });
                </script>
            </div>
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
                                    $("[name='{$this->CamposFormato->nombre}']")
                                        .val(response.data)
                                        .trigger('change');
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
     * @param CamposFormato $CamposFormato
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public function showValue($CamposFormato, $documentId)
    {
        $value = CampoSeleccionados::findColumn('valor', [
            'fk_documento' => $documentId,
            'fk_campos_formato' => $CamposFormato->getPk()
        ]);

        return $value[0];
    }
}
