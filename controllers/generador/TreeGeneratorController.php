<?php

class TreeGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        $idcampo_ft = $this->CamposFormato->getPK();
        $params_ft = json_decode($this->CamposFormato->valor, true);
        $opc_ft = "";
        $param_url = "";
        $parts = parse_url($params_ft["url"]);
        parse_str($parts['query'], $query_ft);
        foreach ($query_ft as $key => $value) {
            $param_url .= '"' . $key . '" => "' . $value . '",';
        }

        $texto = '<div class="form-group ' . $this->getRequiredClass() . '" id="group_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . $this->getLabel() . '</label><?php $origen_' . $idcampo_ft . ' = array(
                                "url" => "' . $params_ft["url"] . '",
                                "ruta_db_superior" => $ruta_db_superior,';
        if (!empty($param_url)) {
            $texto .= '"params" => array(' . $param_url . '),';
        }
        $texto .= ');';
        if (isset($params_ft["checkbox"])) {
            $texto .= '$origen_' . $idcampo_ft . '["params"]["checkbox"]="' . $params_ft["checkbox"] . '";';
            if ($params_ft["checkbox"] == "checkbox") {
                $opc_ft .= '"selectMode" => 2,';
            } else {
                $opc_ft .= '"selectMode" => 1,';
            }
        } else {
            $opc_ft .= '"selectMode" => 1,';
        }

        if (isset($params_ft["funcion_click"]) && !empty($params_ft["funcion_click"])) {
            $opc_ft .= '"onNodeClick" => "' . $params_ft["funcion_click"] . '", ';
        } else {
            $opc_ft .= '"seleccionarClick" => 1,';
        }
        if (isset($params_ft["funcion_select"]) && !empty($params_ft["funcion_select"])) {
            $opc_ft .= '"onNodeSelect" => "' . $params_ft["funcion_select"] . '", ';
        }
        if (isset($params_ft["funcion_dobleclick"]) && !empty($params_ft["funcion_dobleclick"])) {
            $opc_ft .= '"onNodeDblClick" => "' . $params_ft["funcion_dobleclick"] . '", ';
        }
        if (isset($params_ft["buscador"]) && !empty($params_ft["buscador"])) {
            $opc_ft .= '"busqueda_item" => "' . $params_ft["buscador"] . '", ';
        }
        if ($this->CamposFormato->obligatoriedad) {
            $opc_ft .= '"obligatorio" => 1,';
        }

        $texto .= '$opciones_arbol_' . $idcampo_ft . ' = array(
                                "keyboard" => true,' . $opc_ft . '
                            );
                            $extensiones_' . $idcampo_ft . ' = array(
                                "filter" => array()
                            );
                            $arbol_' . $idcampo_ft . ' = new ArbolFt("' . $this->CamposFormato->nombre . '", $origen_' . $idcampo_ft . ', $opciones_arbol_' . $idcampo_ft . ', $extensiones_' . $idcampo_ft . ');
                            echo $arbol_' . $idcampo_ft . '->generar_html();?></div>';
        return $texto;
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
        $value = parent::showValue($CamposFormato, $documentId);
        $opciones = json_decode($CamposFormato->valor, true);

        $vector = explode(",", str_replace("#", "d", $value));
        $vector = sort(array_unique($vector));
        $nombres = [];

        foreach ($vector as $fila) {
            switch ($opciones['url']) {
                case "funcionario":
                    $Funcionario = Funcionario::findByAttributes([
                        'funcionario_codigo' => $fila
                    ]);
                    $nombres[] = $Funcionario->getName();
                    break;
                case "serie":
                    //Series
                    $Serie = new Serie($fila);
                    $nombres[] = $Serie->nombre;
                    break;
                case "dependencia":
                    //Dependencia
                    $Dependencia = new Dependencia($fila);
                    $nombres[] = $Dependencia->nombre;
                    break;

                case "cargo":
                    // cargo
                    $Cargo = new Cargo($fila);
                    $nombres[] = $Cargo->nombre;
                    break;
            }
        }

        return implode(", ", $nombres);
    }
}
