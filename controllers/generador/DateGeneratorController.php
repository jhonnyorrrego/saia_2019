<?php

class DateGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        $texto = [];

        if ($this->CamposFormato->obligatoriedad) {
            $labelRequired = '<label id="' . $this->CamposFormato->nombre . '-error" class="error" for="' . $this->CamposFormato->nombre . '" style="display: none;"></label>';
        } else {
            $labelRequired = '';
        }

        $texto[] = "<div class='form-group form-group-default input-group {$this->getRequiredClass()} date' id='group_{$this->CamposFormato->nombre}'>";
        $texto[] = '<div class="form-input-group">';
        $texto[] = "<label for='{$this->CamposFormato->nombre}' title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>";
        $texto[] = $labelRequired;
        $texto[] = '<input type="text" class="form-control" ' . ' id="' . $this->CamposFormato->nombre . '"  ' . $this->getRequiredClass() . ' name="' . $this->CamposFormato->nombre . '" />';

        $opciones = json_decode($this->CamposFormato->opciones, true);

        if (!is_array($opciones)) {
            throw new Exception("Se debe configurar el campo {$this->CamposFormato->nombre}", 1);
        }

        $ini = "";
        $fin = "";
        $fecha_por_defecto = '';
        $opciones_fecha = [];
        if (isset($opciones["criterio"])) {
            $criterio = $opciones["criterio"];
            switch ($criterio) {
                case "max_lt":
                    $ff = new Datetime($opciones["fecha_1"]);
                    $fin = $ff->sub(new DateInterval('P1D'));
                    $opciones_fecha["maxDate"] = $fin->format("Y-m-d");
                    break;
                case "max":
                    $fin = $opciones["fecha_1"];
                    $opciones_fecha["maxDate"] = $fin;
                    break;
                case "min":
                    $ini = $opciones["fecha_1"];
                    $opciones_fecha["minDate"] = $ini;
                    break;
                case "min_gt":
                    $fi = new Datetime($opciones["fecha_1"]);
                    $ini = $fi->add(new DateInterval('P1D'));
                    $opciones_fecha["minDate"] = $ini->format("Y-m-d");
                    break;
                case "between":
                    $ini = $opciones["fecha_1"];
                    $fin = $opciones["fecha_2"];
                    $opciones_fecha["minDate"] = $ini;
                    $opciones_fecha["maxDate"] = $fin;
                    break;
                case "not_between":
                    $excluidos = array();
                    $fi = new Datetime($opciones["fecha_1"]);
                    $ff = new Datetime($opciones["fecha_2"]);
                    if ($fi > $ff) {
                        $t = $fi;
                        $fi = $ff;
                        $ff = $t;
                    }
                    $interval = DateInterval::createFromDateString('1 day');
                    $period = new DatePeriod($fi, $interval, $ff);

                    foreach ($period as $dt) {
                        $excluidos[] = $dt->format("Y-m-d");
                    }
                    if (!empty($excluidos)) {
                        $opciones_fecha["disabledDates"] = $excluidos;
                    }
                    break;
            }
        }

        if ($this->scope == self::SCOPE_ADD && $opciones['hoy'] == 'true') {
            $fecha_por_defecto = date(DateController::DEFAULT_FORMAT);
        } else if ($this->scope == self::SCOPE_EDIT) {
            $fecha_por_defecto = "<?= ComponentFormGeneratorController::callShowValue({$this->Formato->getPK()}, \$_REQUEST['iddoc']),{$this->CamposFormato->nombre} ?>";
        }

        if ($opciones['tipo'] == 'datetime') {
            $formato_fecha = 'YYYY-MM-DD HH:mm:ss';
        } else {
            $formato_fecha = 'YYYY-MM-DD';
        }

        if (!empty($fecha_por_defecto)) {
            if ($opciones['tipo'] == 'datetime') {
                $format = 'Y-m-d H:i:s';
            } else {
                $format = 'Y-m-d';
            }

            $opciones_fecha["defaultDate"] = DateController::convertDate($fecha_por_defecto, $format, DateController::DEFAULT_FORMAT);
        }

        $opciones_fecha["format"] = $formato_fecha;
        $opciones_fecha["locale"] = "es";
        $opciones_fecha["useCurrent"] = true;
        $opciones_json = json_encode($opciones_fecha, JSON_NUMERIC_CHECK);
        $texto[] = "<script type='text/javascript'>
            $(function () {
                var configuracion={$opciones_json};
                $('#{$this->CamposFormato->nombre}').datetimepicker(configuracion);
                $('#content_container').height($(window).height());
            });
        </script>";
        $texto[] = "</div>";
        $texto[] = "<div class='input-group-append'>
            <span class='input-group-text'><i class='fa fa-calendar'></i></span>
        </div>";
        $texto[] = "</div>";

        return implode("\n", $texto);
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
     * @param CamposFormato $CamposFormato
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-26
     */
    public static function showValue($CamposFormato, $documentId)
    {
        $date = parent::showValue($CamposFormato, $documentId);
        return DateController::convertDate($date);
    }
}
