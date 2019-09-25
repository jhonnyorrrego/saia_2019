<?php

class ComponentFormGeneratorController
{
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
            $valor = "<?= mostrar_valor_campo('{$this->CamposFormato->nombre}',{$this->Formato->getPK()},\$_REQUEST['iddoc']) ?>";
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
        switch ($CamposFormato->etiqueta_html) {
            case "funcion":
                $class = FunctionGeneratorController::class;
                break;
            case "etiqueta_titulo":
                $class = LabelGeneratorController::class;
                break;
            case "etiqueta_parrafo":
                $class = ParagraphGeneratorController::class;
                break;
            case "etiqueta_linea":
                $class = LineGeneratorController::class;
                break;
            case "password":
                $class = PasswordGeneratorController::class;
                break;
            case "textarea_cke":
                $class = TextareaGeneratorController::class;
                break;
            case "arbol_fancytree":
                $class = TreeGeneratorController::class;
                break;
            case "fecha":
                $class = DateGeneratorController::class;
                break;
            case "radio":
                $class = RadioGeneratorController::class;
                break;
            case "checkbox":
                $class = CheckboxGeneratorController::class;
                break;
            case "select":
                $class = SelectGeneratorController::class;
                break;
            case "archivo":
                $class = FileGeneratorController::class;
                break;
            case "hidden":
                $class = HiddenGeneratorController::class;
                break;
            case "ejecutor":
                $class = ExternalUserGeneratorController::class;
                break;
            case "moneda":
                $class = CoinGeneratorController::class;
                break;
            case "spin":
                $class = NumberGeneratorController::class;
                break;
            default:
                $class = TextGeneratorController::class;
                break;
        }

        $Generator = new $class($Formato, $CamposFormato, $scope);

        return ($scope == self::SCOPE_ADD) ?
            $Generator->generateAditionComponent() : $Generator->generateEditionComponente();
    }
}
