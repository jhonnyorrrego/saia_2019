<?php

class ComponentFormGeneratorController
{
    const GENERATORS = [
        "funcion" => FunctionGeneratorController::class,
        "etiqueta_titulo" => LabelGeneratorController::class,
        "etiqueta_parrafo" => ParagraphGeneratorController::class,
        "etiqueta_linea" => LineGeneratorController::class,
        "textarea_cke" => TextareaGeneratorController::class,
        "arbol_fancytree" => TreeGeneratorController::class,
        "fecha" => DateGeneratorController::class,
        "radio" => RadioGeneratorController::class,
        "checkbox" => CheckboxGeneratorController::class,
        "select" => SelectGeneratorController::class,
        "archivo" => FileGeneratorController::class,
        "hidden" => HiddenGeneratorController::class,
        "ejecutor" => ExternalUserGeneratorController::class,
        "moneda" => CoinGeneratorController::class,
        "spin" => NumberGeneratorController::class,
        "text" => TextGeneratorController::class,
    ];
    const SCOPE_ADD = 1;
    const SCOPE_EDIT = 2;

    /**
     * almacena la instancia del CamposFormato
     * que generara el componente
     *
     * @var CamposFormato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    protected $CamposFormato;

    /**
     * almacena la instancia de Formato a
     * la que pertenece el CamposFormato
     *
     * @var Formato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    protected $Formato;

    /**
     * almacena el ambito sobre el cual
     * debe generarse el componente add - edit
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    protected $scope;

    /**
     * setea la instancia de Formato
     *
     * @param Formato $Formato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function __construct($Formato, $CamposFormato, $scope)
    {
        $this->Formato = $Formato;
        $this->CamposFormato = $CamposFormato;
        $this->scope = $scope;
    }

    /**
     * genera la etiqueta del componente
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function getLabel()
    {
        return strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
    }

    /**
     * define la clase para los componentes obligatorios
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function getRequiredClass()
    {
        return $this->CamposFormato->obligatoriedad ? "required" : '';
    }

    /**
     * define el simbolo para indentificar
     * si el componente es obligatorio
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function getRequiredIcon()
    {
        return $this->CamposFormato->obligatoriedad ? '<span>*</span>' : '';
    }

    /**
     * obtiene el valor del camponente basado
     * en el ambito de generacion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function getComponentValue()
    {
        if ($this->scope == self::SCOPE_ADD) {
            $valor = $this->CamposFormato->predeterminado;
        } else {
            $valor = "<?= ComponentFormGeneratorController::callShowValue(
                {$this->Formato->getPK()},
                \$_REQUEST['iddoc'],
                {$this->CamposFormato->nombre}
            ) ?>";
        }

        return $valor;
    }

    /**
     * genera los campos obligatorios de nucleo
     *
     * @param Formato $Formato
     * @param array $descriptions lista de idcampos_formato para la descripcion
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public static function generateSystemFields($Formato, $descriptions)
    {
        $response = [];
        $value = implode(',', $descriptions);

        if ($Formato->detalle) {
            $response[] = "<input type='hidden' name='padre' value='<?= \$_REQUEST['padre'] ?>'>";
            $response[] = "<input type='hidden' name='anterior' value='<?= \$_REQUEST['anterior'] ?>'>";
        }

        $response[] = "<input type='hidden' name='campo_descripcion' value='{$value}'>";
        $response[] = "<input type='hidden' name='iddoc' value='<?= \$_REQUEST['iddoc'] ?? null ?>'>";
        $response[] = "<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='{$Formato->getCounter()->nombre}'>";
        $response[] = "<input type='hidden' name='formatId' value='{$Formato->getPK()}'>";
        $response[] = "<input type='hidden' name='tabla' value='{$Formato->nombre_tabla}'>";
        $response[] = "<input type='hidden' name='formato' value='{$Formato->nombre}'>";
        $response[] = "<input type='hidden' name='token'>";
        $response[] = "<input type='hidden' name='key'>";
        $response[] = "<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>";

        return implode("\n", $response);
    }

    /**
     * en caso de ser un formato tipo item
     * y el ambito es adicionar genera el campo accion
     *
     * @param Formato $Formato
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public static function generateItemAction($Formato)
    {
        if ($Formato->item) {
            $response = '
            <div "form-group">
                <label>ACCION A SEGUIR LUEGO DE GUARDAR</label>
                <div class="radio radio-success">
                    <input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">
                    <label for="opcion_item1">Adicionar otro</label>
                    <input type="radio" name="opcion_item" id="opcion_item" value="terminar" checked>
                    <label for="opcion_item">Terminar</label>
                </div>
            </div>';
        } else {
            $response = '';
        }

        return $response;
    }

    /**
     * genera el html de un componente
     *
     * @param Foramto $Foramto
     * @param CamposFormato $CamposFormato
     * @param string $scope momento de la generacion add - edit
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public static function generate($Formato, $CamposFormato, $scope)
    {
        $class = self::getGeneratorFromField($CamposFormato->etiqueta_html);
        $Generator = new $class($Formato, $CamposFormato, $scope);

        return ($scope == self::SCOPE_ADD) ?
            $Generator->generateAditionComponent() : $Generator->generateEditionComponente();
    }

    /**
     * obtiene la clase encargada de generar el componente
     * basado en la etiqueta_html de campos_formato
     *
     * @param string $tag etiqueta_html del campos_formato
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public static function getGeneratorFromField($tag)
    {
        $type = in_array($tag, array_keys(self::GENERATORS)) ? $tag : 'text';

        return self::GENERATORS[$type];
    }

    /**
     * ejecuta el metodo showValue de un generador de componente
     * basado en su idcampos_formato
     *
     * @param integer $formatId
     * @param integer $documentId
     * @param integer $field nombre del campo a mostrar
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public static function callShowValue($formatId, $documentId, $field)
    {
        $CamposFormato = CamposFormato::findByAttributes([
            'formato_idformato' => $formatId,
            'nombre' => $field
        ]);

        if (!$CamposFormato) {
            throw new Exception("no existe el campo {$field}", 1);
        }

        $class = self::getGeneratorFromField($CamposFormato->etiqueta_html);
        return $class::showValue($CamposFormato, $documentId);
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
    public static function showValue($CamposFormato, $documentId)
    {
        $ft = (new Documento($documentId))->getFt();

        return $ft[$CamposFormato->nombre] ? $ft[$CamposFormato->nombre] : '';
    }
}
