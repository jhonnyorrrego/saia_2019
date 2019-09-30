<?php

class NumberGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        $value = $this->getComponentValue();
        $options = json_decode($this->CamposFormato->opciones);
        $aux2 = [];
        $texto = array();

        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);
            $estilo = json_decode($campo["estilo"], true);

            $ini = "";
            $fin = "";
            $decimales = 0;
            $incremento = 1;
            if (isset($opciones["con_decimales"]) && isset($opciones["decimales"])) {
                $decimales = $opciones["decimales"];
            }
            if (!empty($estilo)) {
                $tam = $estilo["size"];
            }
            if (isset($opciones["criterio"])) {
                $criterio = $opciones["criterio"];
                switch ($criterio) {
                    case "max_lt":
                        $fin = $opciones["valor_1"] - 1;
                        break;
                    case "max":
                        $fin = $opciones["valor_1"];
                        break;
                    case "min":
                        $ini = $opciones["valor_1"];
                        break;
                    case "min_gt":
                        $ini = $opciones["valor_1"] + 1;
                        break;
                    case "between":
                        $ini = $opciones["valor_1"];
                        $fin = $opciones["valor_2"];
                        if (empty($fin)) {
                            $fin = 1000;
                        }
                        if ($fin <= $ini) {
                            $fin = $ini + 1;
                        }
                        break;
                    case "not_between":
                        break;
                }
                if ($decimales) {
                    $incremento = pow(10, -$decimales);
                }
            }
            if ($ini) {
                $aux2[] = 'min="' . $ini . '"';
            }

            if ($fin) {
                $aux2[] = 'max="' . $fin . '"';
            }
            $aux2[] = 'step=' . $incremento;
        } else if (!empty($value)) {
            $parametros = explode("@", $value);
            if (is_numeric($parametros[0])) {
                $aux2[] = 'min="' . $parametros[0] . '"';
            }
            if (is_numeric($parametros[1])) {
                $aux2[] = 'max="' . $parametros[1] . '"';
            }
            if (is_numeric($parametros[2]))
                $aux2[] = 'step="' . $parametros[2] . '"';
        }

        $adicionales = '';
        if (is_array($aux2)) {
            $adicionales .= implode(" ", $aux2);
        }
        $texto[] = "<div class='form-group form-group-default {$this->getRequiredClass()} col-12 {$options->clase}' id='group_{$campo["nombre"]}'>";
        $texto[] = "<label title='{$campo['ayuda']}' for='{$campo["nombre"]}'>{$this->getLabel()}</label>";
        $texto[] = "<input class='form-control' {$adicionales} {$this->getRequiredClass()} type='number' id='{$this->CamposFormato->nombre}' name='{$campo["nombre"]}'  value='{$value}'>";
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
        return parent::showValue($CamposFormato, $documentId);
    }
}
