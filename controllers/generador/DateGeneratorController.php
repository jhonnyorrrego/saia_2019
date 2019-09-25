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
        $campo = $this->CamposFormato->getAttributes();
        $formato_fecha = "YYYY-MM-DD";
        $formato_fecha_time = "Y-m-d";
        $texto = array();

        $nombre_selector = $campo["nombre"];
        if ($campo["obligatoriedad"]) {
            $labelRequired = '<label id="' . $campo["nombre"] . '-error" class="error" for="' . $campo["nombre"] . '" style="display: none;"></label>';
        } else {
            $labelRequired = '';
        }

        $texto[] = "<div class='form-group form-group-default input-group {$this->getRequiredClass()} date' id='group_{$campo['nombre']}'>";
        $texto[] = '<div class="form-input-group">';
        $texto[] = "<label for='{$campo["nombre"]}' title='{$this->CamposFormato->ayuda}'>{$this->getLabel()}</label>";
        $texto[] = $labelRequired;
        $texto[] = '<input type="text" class="form-control" ' . ' id="' . $campo["nombre"] . '"  ' . $this->getRequiredClass() . ' name="' . $campo["nombre"] . '" />';
        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);

            $ini = "";
            $fin = "";
            if (isset($opciones["tipo"]) && $opciones["tipo"] == "datetime") {
                $formato_fecha = "YYYY-MM-DD HH:mm:ss";
                $formato_fecha_time = "Y-m-d H:i:s";
            }
            $fecha_por_defecto = '';
            $opciones_fecha = array();
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
                    case "actual":
                        if ($opciones["tipo"] == "datetime") {
                            $fecha_por_defecto = date("Y-m-d H:i:s");
                        } else if ($opciones["tipo"] == "date") {
                            $fecha_por_defecto = date("Y-m-d");
                        }
                        break;
                    case "ant_actual":
                        if ($opciones["tipo"] == "datetime") {
                            $opciones_fecha["maxDate"] = date("Y-m-d H:i:s");
                        } else if ($opciones["tipo"] == "date") {
                            $opciones_fecha["maxDate"] = date("Y-m-d");
                        }
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
        } else {
            if (strtoupper($campo["tipo_dato"]) == "DATE") {
                $formato_fecha = "YYYY-MM-DD";

                if ($this->scope == self::SCOPE_ADD) {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
            } else if (strtoupper($campo["tipo_dato"]) == "DATETIME") {
                $formato_fecha = "YYYY-MM-DD LT";
                if ($this->scope == self::SCOPE_ADD) {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
            } else if (strtoupper($campo["tipo_dato"]) == "TIME") {
                $formato_fecha = "LT";
                if ($this->scope == self::SCOPE_ADD) {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
            }
            if ($this->scope == self::SCOPE_EDIT) {
                $fecha_por_defecto = "<?= mostrar_valor_campo('{$campo["nombre"]}',{$this->Formato->getPK()},\$_REQUEST['iddoc'], 1) ?>";
            }
        }

        if (!empty($fecha_por_defecto)) {
            $opciones_fecha["defaultDate"] = $fecha_por_defecto;
        }
        $opciones_fecha["format"] = $formato_fecha;
        $opciones_fecha["locale"] = "es";
        $opciones_fecha["useCurrent"] = true;
        $opciones_json = json_encode($opciones_fecha, JSON_NUMERIC_CHECK);
        $texto[] = '<script type="text/javascript">
                $(function () {
                    var configuracion=' . $opciones_json . ';
                    $("#' . $nombre_selector . '").datetimepicker(configuracion);
                    $("#content_container").height($(window).height());
                });
            </script>';
        $opciones_campo = json_decode($campo["opciones"], true);
        if ($opciones_campo['hoy'] == 'true') {
            $texto[] = '<script type="text/javascript">
            $(function () {
                $("#' . $nombre_selector . '").val("' . date($formato_fecha_time, time()) . '");
            });
            </script>';
        }
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
     * @param integer $fieldId
     * @param integer $documentId
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-25
     */
    public function showValue($fieldId, $documentId)
    { }
}
