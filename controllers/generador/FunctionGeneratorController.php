<?php

class FunctionGeneratorController extends ComponentFormGeneratorController implements IComponentGenerator
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
        if (in_array($this->CamposFormato->nombre, $this->Formato->getSystemFields())) {
            switch ($this->CamposFormato->nombre) {
                case 'dependencia':
                    $response = $this->generateDependencie();
                    break;

                default:
                    throw new Exception("se debe definir el componente de nucleo {$this->CamposFormato->nombre}", 1);
                    break;
            }
        } else {
            if (!$this->CamposFormato->valor) {
                throw new Exception("Debe definir la funcion en el campo {$this->CamposFormato->etiqueta}", 1);
            }

            $function = str_replace(['{*', '*}'], '', $this->CamposFormato->valor);
            $response = "<?php {$function}({$this->Formato->getPK()}, \$_REQUEST['iddoc']) ?>";
        }

        return $response;
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

    /**
     * genera el campo dependencia que pertenece a nucleo
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function generateDependencie()
    {
        return <<<PHP
        <?php
        \$selected = isset(\$ft) ? \$ft['dependencia'] : '';
        \$query = Model::getQueryBuilder();
        \$roles = \$query
            ->select("dependencia as nombre, iddependencia_cargo, cargo")
            ->from("vfuncionario_dc")
            ->where("estado_dc = 1 and tipo_cargo = 1 and login = :login")
            ->andWhere(
                \$query->expr()->lte('fecha_inicial', ':initialDate'),
                \$query->expr()->gte('fecha_final', ':finalDate')
            )->setParameter(":login", SessionController::getLogin())
            ->setParameter(':initialDate', new DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter(':finalDate', new DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
            ->execute()->fetchAll();
    
        \$total = count(\$roles);

        echo "<div class='form-group' id='group_dependencie'>";
    
        if (\$total > 1) {
            echo "<select class='full-width' name='dependencia' id='dependencia' required>";
            foreach (\$roles as \$row) {
                echo "<option value='{\$row["iddependencia_cargo"]}'>
                    {\$row["nombre"]} - ({\$row["cargo"]})
                </option>";
            }
    
            echo "</select>
                <script>
                    $('#dependencia').select2();
                    $('#dependencia').val({\$selected});
                    $('#dependencia').trigger('change');
                </script>
            ";
        } else if (\$total == 1) {
            echo "<input class='required' type='hidden' value='{\$roles[0]['iddependencia_cargo']}' id='dependencia' name='dependencia'>
                <label class ='form-control'>{\$roles[0]["nombre"]} - ({\$roles[0]["cargo"]})</label>";
        } else {
            throw new Exception("Error al buscar la dependencia", 1);
        }
        
        echo "</div>";
        ?>
PHP;
    }
}
