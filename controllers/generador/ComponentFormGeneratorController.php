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
    public function __construct($Formato)
    {
        $this->Formato = $Formato;
    }

    /**
     * genera el html de un componente
     *
     * @param CamposFormato $CamposFormato
     * @param string $scope momento de la generacion add - edit
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function generate($CamposFormato, $scope)
    {
        $this->CamposFormato = $CamposFormato;
        $this->scope = $scope;

        switch ($this->CamposFormato->etiqueta_html) {
            case "funcion":
                $texto = $this->generateFunction();
                break;
            case "etiqueta":
            case "etiqueta_titulo":
                $texto = $this->generateLabel();
                break;
            case "etiqueta_parrafo":
                $texto = $this->generateParagraph();
                break;
            case "etiqueta_linea":
                $texto = $this->generateHr();
                break;
            case "password":
                $texto = $this->generatePassword();
                break;
            case "textarea_cke":
                $texto = $this->generateTextArea();
                break;
            case "arbol_fancytree":
                $texto = $this->generateFancy();
                break;
            case "fecha":
                $texto .= $this->generateDate();
                break;
            case "radio":
                $texto .= $this->generateRadio();
                break;
            case "checkbox":
                $texto .= $this->generateCheckbox();
                break;
            case "select":
                $texto = $this->generateSelect();
                break;
            case "archivo":
                $texto = $this->generateFile();
                break;
            case "hidden":
                $texto .= $this->generateHidden();
                break;
            case "ejecutor":
                throw new Exception("Pendiente por definir componente de terceros", 1);
                break;
            case "moneda":
                $texto .= $this->generateInteger($this->CamposFormato, true);
                break;
            case "spin":
                $texto .= $this->generateInteger($this->CamposFormato);
                break;
            default:
                $texto .= $this->generateText();
                break;
        }

        return $texto;
    }

    public function getLabel()
    { }

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
     * genera un componente tipo hidden
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function generateHidden()
    {
        $value = $this->getComponentValue();
        return "<input type='hidden' name='{$this->CamposFormato->nombre}' value='{$value}'>";
    }

    /**
     * genera un string llamando la funcion
     * del campo valor pasandole idformato e iddocumento
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateFunction()
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
            $function = str_replace(['{*', '*}'], '', $this->CamposFormato->valor);
            $response = "<?php {$function}({$this->Formato->getPK()}, \$_REQUEST['iddoc']) ?>";
        }

        return $response;
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

    /**
     * genera un componente tipo titulo
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function generateLabel()
    {
        return "<div id='group_{$this->CamposFormato->nombre}'>
            <h5 title='{$this->CamposFormato->ayuda}'>
                <label>{$this->CamposFormato->valor}</label>
            </h5>
        </div>";
    }

    /**
     * genera un componente tipo parrafo
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateParagraph()
    {
        return "<div id='group_{$this->CamposFormato->nombre}'>
            <p title='{$this->CamposFormato->ayuda}'>
                {$this->CamposFormato->valor}
            </p>
        </div>";
    }

    /**
     * genera un componente tipo hr
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateHr()
    {
        return "<div id='group_{$this->CamposFormato->nombre}'>
            <hr class='border'>
        </div>";
    }

    /**
     * genera un componente tipo contrasena
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generatePassword()
    {
        $requiredClass = $this->getRequiredClass();
        $value = $this->getComponentValue();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();

        return  "<div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$label}</label>
            <input class='form-control {$requiredClass}' type='password' name='{$this->CamposFormato->nombre}' value='{$value}'>
        </div>";
    }

    /**
     * genera un componente tipo ckeditor
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateTextArea()
    {
        $valor = $this->getComponentValue();
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $idcampo_cke = $this->CamposFormato->nombre;

        return <<<HTML
            <div class="form-group form-group-default {$requiredClass}" id="group_{$this->CamposFormato->nombre}">
                <label title="{$this->CamposFormato->ayuda}">
                    {$label}
                </label>
                <div class="celda_transparente">
                    <textarea name="{$this->CamposFormato->nombre}" id="{$idcampo_cke}" rows="3" class="form-control {$requiredClass}">
                        {$valor}
                    </textarea>
                    <script>
                        CKEDITOR.replace("{$idcampo_cke}", {
                            removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                        });
                    </script>
                </div>
            </div>
HTML;
    }

    /**
     * genera un componente tipo arbol
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateFancy()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();

        $idcampo_ft = $this->CamposFormato->getPK();
        $params_ft = json_decode($this->CamposFormato->valor, true);
        $opc_ft = "";
        $param_url = "";
        $parts = parse_url($params_ft["url"]);
        parse_str($parts['query'], $query_ft);
        foreach ($query_ft as $key => $value) {
            $param_url .= '"' . $key . '" => "' . $value . '",';
        }

        $texto = '<div class="form-group ' . $requiredClass . '" id="group_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . $label . '</label><?php $origen_' . $idcampo_ft . ' = array(
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
     * genera un componente tipo fecha
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function generateDate()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $campo = $this->CamposFormato->getAttributes();
        $formato_fecha = "YYYY-MM-DD";
        $formato_fecha_time = "Y-m-d";
        $texto = array();

        $nombre_selector = $campo["nombre"];
        $labelRequired = '';
        $required = '';
        if ($campo["obligatoriedad"]) {
            $obliga = "*";
            $labelRequired = '<label id="' . $campo["nombre"] . '-error" class="error" for="' . $campo["nombre"] . '" style="display: none;"></label>';
            $required = 'required';
        } else {
            $obliga = "";
        }
        $texto[] = "<div class='form-group form-group-default input-group {$requiredClass} date' id='group_{$campo['nombre']}'>";
        $texto[] = '<div class="form-input-group">';
        $texto[] = "<label for='{$campo["nombre"]}' title='{$this->CamposFormato->ayuda}'>{$label}</label>";
        $texto[] = $labelRequired;
        $texto[] = '<input type="text" class="form-control" ' . ' id="' . $campo["nombre"] . '"  ' . $required . ' name="' . $campo["nombre"] . '" />';
        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);

            $ini = "";
            $fin = "";
            $ancho = "";
            if (isset($opciones["tipo"]) && $opciones["tipo"] == "datetime") {
                //$formato_fecha="L LT";
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
     * genera un componente tipo numero
     *
     * @param string $campo
     * @param boolean $moneda
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     * Modificación para obtener el ancho del campo clase "pequeño:col-md-3 mediano:col-md-6 grande:col-md-12"
     * @author Julian Otalvaro <julian.otalvaro@cerok.com>
     * @date 2019-09-18 
     */
    private function generateInteger($campo, $moneda = false)
    {
        $campo = $campo->getAttributes();
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $value = $this->getComponentValue();
        $options = json_decode($this->CamposFormato->opciones);

        if ($campo["obligatoriedad"]) {
            $obligatorio = " required ";
        } else {
            $obligatorio = "";
        }
        $aux2 = [];
        $texto = array();
        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);
            $estilo = json_decode($campo["estilo"], true);

            $ini = "";
            $fin = ""; //anteriormente estaba en 1000
            $decimales = 0;
            $incremento = 1;
            $tam = 100;
            $ancho = "";
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
            $ancho = ' col-md-' . $tam . ' col-lg-' . $tam . ' col-xl-' . $tam . '';
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
            if (is_numeric($parametros[3]) && $parametros[3]) {
                $aux[] = 'lock:true';
            }
        }

        $adicionales = '';
        if (is_array($aux2)) {
            $adicionales .= implode(" ", $aux2);
        }
        $pre = "";
        $post = "";
        $texto[] = "<div class='form-group form-group-default {$requiredClass} col-12 {$options->clase}' id='group_{$campo["nombre"]}'>";
        $texto[] = "<label title='{$campo['ayuda']}' for='{$campo["nombre"]}'>{$campo["etiqueta"]}</label>";
        if ($moneda) {
            $pre = "<div class='input-group'><div class='input-group-prepend'><div class='input-group-text'>$</div></div>";
            $post = "</div>";
            $ancho = "";
        }
        $texto[] = $pre;
        $texto[] = "<input class='form-control' {$adicionales} {$requiredClass} type='number' id='{$this->CamposFormato->nombre}' name='{$campo["nombre"]}'  value='{$value}'>";
        $texto[] = "</div>";
        $texto[] = $post;
        return implode("\n", $texto);
    }

    /**
     * genera los campos obligatorios de nucleo
     *
     * @param array $descriptions lista de idcampos_formato para la descripcion
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateSystemFields($descriptions)
    {
        $response = [];
        $value = implode(',', $descriptions);

        if ($this->Formato->detalle) {
            $response[] = "<input type='hidden' name='padre' value='<?= \$_REQUEST['padre'] ?>'>";
            $response[] = "<input type='hidden' name='anterior' value='<?= \$_REQUEST['anterior'] ?>'>";
        }

        $response[] = "<input type='hidden' name='campo_descripcion' value='{$value}'>";
        $response[] = "<input type='hidden' name='iddoc' value='<?= \$_REQUEST['iddoc'] ?? null ?>'>";
        $response[] = "<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='{$this->Formato->getCounter()->nombre}'>";
        $response[] = "<input type='hidden' name='formatId' value='{$this->Formato->getPK()}'>";
        $response[] = "<input type='hidden' name='tabla' value='{$this->Formato->nombre_tabla}'>";
        $response[] = "<input type='hidden' name='formato' value='{$this->Formato->nombre}'>";
        $response[] = "<input type='hidden' name='token'>";
        $response[] = "<input type='hidden' name='key'>";
        $response[] = "<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>";

        return implode("\n", $response);
    }

    /**
     * en caso de ser un formato tipo item
     * y el ambito es adicionar genera el campo accion
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-12
     */
    public function generateItemAction()
    {
        if ($this->Formato->item && $this->scope == self::SCOPE_ADD) {
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

    /* Genera el campo tipo texto con sus respectivos atributos, se realizo cambio de ancho del campo de estilo a opciones
              tipo clase y sus tamaño pequeño "col-md-3", mediano "col-md-6" y grande ""col-md-3""
     *
     * @author Julian Otalvaro <julian.otalvaro@cerok.com> - jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-18
     */

    public function generateText()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $value = $this->getComponentValue();
        $options = json_decode($this->CamposFormato->opciones);
        return "<div class='form-group form-group-default {$requiredClass} col-12 {$options->clase}'  id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$label}</label>
            <input class='form-control {$requiredClass}' type='text' id='{$this->CamposFormato->nombre}' name='{$this->CamposFormato->nombre}' value='{$value}' />
        </div>";
    }


    /* Genera el campo tipo Select con sus respectivos atributos, se realizo cambio de ancho del campo de estilo a opciones
              tipo clase y sus tamaño pequeño "col-md-3", mediano "col-md-6" y grande ""col-md-3""
     *
     * @author Julian Otalvaro <julian.otalvaro@cerok.com> - jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-18
     */

    public function generateSelect()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();

        if ($this->CamposFormato->obligatoriedad) {
            $labelRequired = "<label id='{$this->CamposFormato->nombre}-error' class='error' for='{$this->CamposFormato->nombre}' style='display: none;'></label>";
        } else {
            $labelRequired = '';
        }

        return <<<HTML
            <div class='form-group form-group-default form-group-default-select2 {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
                <label title="{$this->CamposFormato->ayuda}">{$label}</label>
                <?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?>
                {$labelRequired}
            </div>
HTML;
    }

    /**
     * genera el componente tipo radio
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function generateRadio()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();

        if ($this->CamposFormato->obligatoriedad) {
            $labelRequired = "<label id='{$this->CamposFormato->nombre}-error' class='error' for='{$this->CamposFormato->nombre}' style='display: none;'></label>";
        } else {
            $labelRequired = '';
        }

        return <<<HTML
            <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
                <label title="{$this->CamposFormato->ayuda}">{$label}</label>
                <?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?>
                {$labelRequired}
            </div>
HTML;
    }

    /**
     * genera el componente tipo radio
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-23
     */
    public function generateCheckbox()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();

        if ($this->CamposFormato->obligatoriedad) {
            $labelRequired = "<label id='{$this->CamposFormato->nombre}[]-error' class='error' for='{$this->CamposFormato->nombre}[]' style='display: none;'></label>";
        } else {
            $labelRequired = '';
        }

        return <<<HTML
            <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
                <label title="{$this->CamposFormato->ayuda}">{$label}</label>
                <?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?>
                {$labelRequired}
            </div>
HTML;
    }

    /**
     * genera el html del componente tipo anexo
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function generateFile()
    {
        $requiredClass = $this->getRequiredClass();
        $label = strtoupper($this->CamposFormato->etiqueta) . $this->getRequiredIcon();
        $identificator = "dropzone_{$this->CamposFormato->nombre}";

        if ($this->scope == self::SCOPE_EDIT) {
            $editFunction = <<<JS
                $.post('<?= \$ruta_db_superior ?>app/anexos/consultar_anexos_campo.php', {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    fieldId: {$this->CamposFormato->getPK()},
                    documentId: <?= \$_REQUEST['iddoc'] ?>
                }, function(response){
                    if(response.success){
                        response.data.forEach(mockFile => {
                            {$identificator}.removeAllFiles();
                            {$identificator}.emit('addedfile', mockFile);
                            {$identificator}.emit('thumbnail', mockFile, '<?= \$ruta_db_superior ?>' + mockFile.route);
                            {$identificator}.emit('complete', mockFile);

                            loaded{$identificator}.push(mockFile.route);
                        });                        
                        $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','));
                        {$identificator}.options.maxFiles = options.cantidad - loaded{$identificator}.length;                        
                    }
                }, 'json');
JS;
        }

        return <<<HTML
        <div class='form-group form-group-default {$requiredClass}' id='group_{$this->CamposFormato->nombre}'>
            <label title='{$this->CamposFormato->ayuda}'>{$label}</label>
            <div class="" id="dropzone_{$this->CamposFormato->nombre}"></div>
            <input type="hidden" class="{$requiredClass}" name="{$this->CamposFormato->nombre}">
        </div>
        <script>
            $(function(){
                let options = {$this->CamposFormato->opciones}
                let loaded{$identificator} = [];
                $("#dropzone_{$this->CamposFormato->nombre}").addClass('dropzone');
                let {$identificator} = new Dropzone('#{$identificator}', {
                    url: '<?= \$ruta_db_superior ?>app/temporal/cargar_anexos.php',
                    dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                    maxFilesize: options.longitud,
                    maxFiles: options.cantidad,
                    acceptedFiles: options.tipos,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Eliminar',
                    dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                    dictMaxFilesExceeded: `Máximo \${options.cantidad} archivos`,
                    params: {
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key'),
                        dir: '{$this->Formato->nombre}'
                    },
                    paramName: 'file',
                    init : function() {
                        {$editFunction}

                        this.on('success', function(file, response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                response.data.forEach(e => {
                                    loaded{$identificator}.push(e);
                                });
                                $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','))
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        });

                        this.on('removedfile', function(file) {
                            if(file.route){ //si elimina un anexo cargado antes
                                var index = loaded{$identificator}.findIndex(route => route == file.route);
                            }else{//si elimina un anexo recien cargado
                                var index = loaded{$identificator}.findIndex(route => file.status == 'success' && route.indexOf(file.upload.filename) != -1);                                
                            }
                           
                            loaded{$identificator} = loaded{$identificator}.filter((e,i) => i != index);
                            $("[name='{$this->CamposFormato->nombre}']").val(loaded{$identificator}.join(','));
                            {$identificator}.options.maxFiles = options.cantidad - loaded{$identificator}.length;
                        });
                    }
                });
            });
        </script>
HTML;
    }
}
