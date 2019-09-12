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

        $texto = '';
        $obliga = $this->getRequiredIcon();
        $obligatorio = $this->getRequiredClass();
        $valor = $this->getComponentValue();

        switch ($this->CamposFormato->etiqueta_html) {
            case "etiqueta":
            case "etiqueta_titulo":
                $texto = $this->generateLabel();
                break;
            case "etiqueta_parrafo":
                $texto .= '<p id="' . $this->CamposFormato->nombre . '">' . $this->CamposFormato->valor . '</p>';
                break;
            case "etiqueta_linea":
                $texto .= '<hr class="border" id="' . $this->CamposFormato->nombre . '">';
                break;
            case "password":
                $texto .= '<div class="form-group form-group-default ' . $obligatorio . '" id="tr_' . $this->CamposFormato->nombre . '">
                        <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>
                        <input class="form-control" type="password" name="' . $this->CamposFormato->nombre . '" ' . $obligatorio . ' value="' . $valor . '">
                    </div>';
                break;
            case "textarea_cke":
                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>
                                    <div class="celda_transparente">';
                $idcampo_cke = $this->CamposFormato->nombre;
                $texto .= '<textarea name="' . $this->CamposFormato->nombre . '" id="' . $idcampo_cke . '" cols="53" rows="3" class="form-control';
                if ($this->CamposFormato->obligatoriedad) {
                    $texto .= ' required';
                }
                $texto .= '">' . $valor . '</textarea>';
                $texto .= '<script>
                        var config = {
                            removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                        };
                        var editor = CKEDITOR.replace("' . $idcampo_cke . '", config);
                        </script>
                        </div></div>';
                break;
            case "arbol_fancytree":
                $idcampo_ft = $this->CamposFormato->getPK();
                $params_ft = json_decode($this->CamposFormato->valor, true);
                $opc_ft = "";
                $param_url = "";
                $parts = parse_url($params_ft["url"]);
                parse_str($parts['query'], $query_ft);
                foreach ($query_ft as $key => $value) {
                    $param_url .= '"' . $key . '" => "' . $value . '",';
                }

                $texto .= '<div class="form-group  ' . $obligatorio . '" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label><?php $origen_' . $idcampo_ft . ' = array(
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
                break;
            case "fecha":
                $texto .= $this->generateDate();
                break;
            case "radio":
                /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas */
                $classRadios = '';
                if ($this->CamposFormato->obligatoriedad) {
                    $classRadios = 'required';
                    $labelRequired = '<label id="' . $this->CamposFormato->nombre . '-error" class="error" for="' . $this->CamposFormato->nombre . '" style="display: none;"></label>';
                }
                /* En los campos de  e ste tipo se debe validar que  v alor contenga un list a do con las siguentes caracteristicas */
                $texto .= '<div class="form-group  ' . $classRadios . '" id="tr_' . $this->CamposFormato->nombre . '">
                        <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga .   '</label>';
                $texto .= "<?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?>{$labelRequired}<br></div>";
                break;
            case "link":
                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>';
                $texto .= '<textarea form-control cols="40" rows="3" name="' . $this->CamposFormato->nombre . '" id="' . $this->CamposFormato->nombre . '">' . $valor . '</textarea></div>';
                break;
            case "checkbox":
                if ($this->CamposFormato->obligatoriedad) {
                    $labelRequired = '<label id="' . $this->CamposFormato->nombre . '[]-error" class="error" for="' . $this->CamposFormato->nombre . '[]" style="display: none;"></label>';
                } else {
                    $labelRequired = "";
                }

                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>';
                $texto .= "<?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?>{$labelRequired}<br></div>";
                break;
            case "select":
                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>';
                $texto .= "<?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?> </div>";

                break;
            case "dependientes":
                /* parametros:
                            nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
                            (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=) */
                $parametros = explode("|", $this->CamposFormato->valor);
                if (count($parametros) < 2) {
                    throw new Exception("Por favor verifique los parametros de configuracion de su select dependiente " . $this->CamposFormato->etiqueta, 1);
                } else {
                    $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                        <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>';
                    $texto .= "<?php genera_campo_listados_editar({$this->Formato->getPK()},{$this->CamposFormato->getPK()},\$_REQUEST['iddoc']) ?></div>";
                }
                break;
            case "archivo":
                $texto .= 'pendiete desarrollar anexos';

                break;
            case "hidden":
                $texto .= '<input type="hidden" name="' . $this->CamposFormato->nombre . '" value="' . $valor . '">';
                break;
            case "autocompletar":
                /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                            ej: nombres,apellidos;idfuncionario;funcionario
                            */
                $parametros = json_decode($this->CamposFormato->valor);
                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>';
                if ($this->CamposFormato->obligatoriedad == 1) {
                    $obligatorio = "required";
                }

                $adicional = "";
                if ($this->scope == self::SCOPE_EDIT) {
                    $adicional = " data-data='<?php echo(mostrar_autocompletar('{$this->CamposFormato->nombre}', $this->Formato->getPK(), $" . "_REQUEST['iddoc'])); ?>'";
                }
                $texto .= '<input type="text" class="form-control" name="' . $this->CamposFormato->nombre . '" id="' . $this->CamposFormato->nombre . '" value=""' . $adicional . $obligatorio . '></div>';
                $texto .= $this->generateAutocomplete($this->CamposFormato->nombre, $parametros);
                break;
            case "etiqueta":
                $texto .= '<div class="card-body" id="tr_' . $this->CamposFormato->nombre . '">
                                    <h5><center>' . $valor . '</center></h5><input type="hidden" name="' . $this->CamposFormato->nombre . '" value="' . $valor . '">
                                    </div>';
                break;
            case "ejecutor":
                if ($this->scope == self::SCOPE_EDIT) {
                    $valor = "<?php echo(mostrar_valor_campo('" . $this->CamposFormato->nombre . "',$->Formato->getPK()formatId,$" . "_REQUEST['iddoc'])); ?>";
                } else
                    $valor = $this->CamposFormato->predeterminado;

                $texto .= '<div class="form-group" id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . strtoupper($this->CamposFormato->etiqueta) . $obliga . '</label>
                                    <input type="hidden" name="' . $this->CamposFormato->nombre . '" id="' . $this->CamposFormato->nombre . '" value="' . $valor . '"><?php componente_ejecutor("' . $this->CamposFormato->getPK() . '",@$_REQUEST["iddoc"]); ?' . '>';
                $texto .= '</div>';
                break;
            case "detalle":
                $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $this->CamposFormato->valor, "");
                if ($padre["numcampos"] && $this->scope == self::SCOPE_ADD) {
                    $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
                    $texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
                }
                break;
            case "moneda":
                $texto .= $this->generateInteger($this->CamposFormato, true);
                break;
            case "spin":
                $texto .= $this->generateInteger($this->CamposFormato);
                break;
            default: // text
                $texto .= '<div class="form-group col-12"  id="tr_' . $this->CamposFormato->nombre . '">
                                    <label title="' . $this->CamposFormato->ayuda . '">' . str_replace("ACUTE;", "acute;", strtoupper($this->CamposFormato->etiqueta)) . $obliga . '</label>
                                    <input class="form-control" ' . $obligatorio . ' type="text"  size="100" id="' . $this->CamposFormato->nombre . '" name="' . $this->CamposFormato->nombre . '" ' . $obligatorio . ' value="' . $valor . '">
                                    </div>';
                break;
        }
        return $texto;
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
            $valor = "<?= validar_valor_campo({$this->CamposFormato->getPK()}) ?>";
        } else {
            $valor = "<?= mostrar_valor_campo('{$this->CamposFormato->nombre}',{$this->Formato->getPK()},\$_REQUEST['iddoc']) ?>";
        }

        return $valor;
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
        return '<div id="tr_' . $this->CamposFormato->nombre . '">
        <h5 title="' . $this->CamposFormato->ayuda . '" id="' . $this->CamposFormato->nombre . '"><label >' . strtoupper($this->CamposFormato->valor) . '</label></h5>
        </div>';
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
        $campo = $this->CamposFormato->getAttributes();
        $formato_fecha = "YYYY-MM-DD";
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
        $texto[] = '<div class="form-group" id="tr_' . $campo["nombre"] . '">';
        $texto[] = '<label for="' . $campo["nombre"] . '">' . strtoupper($campo["etiqueta"]) . '</label>';
        $texto[] = $labelRequired;
        $texto[] = '<div class="input-group date">';
        $texto[] = '<input type="text" class="form-control" ' . ' id="' . $campo["nombre"] . '"  ' . $required . ' name="' . $campo["nombre"] . '" />';
        $texto[] = '<div class="input-group-append">';
        $texto[] = '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';

        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);

            $ini = "";
            $fin = "";
            $ancho = "";
            if (isset($opciones["tipo"]) && $opciones["tipo"] == "datetime") {
                //$formato_fecha="L LT";
                $formato_fecha = "YYYY-MM-DD HH:mm:ss";
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
                $fecha_por_defecto = "<?= mostrar_valor_campo('{$campo["nombre"]}',{$this->idformato},\$_REQUEST['iddoc']) ?>";
            }
        }

        if (!empty($fecha_por_defecto)) {
            $opciones_fecha["defaultDate"] = $fecha_por_defecto;
        }
        $opciones_fecha["format"] = $formato_fecha;
        $opciones_fecha["locale"] = "es";
        $opciones_fecha["useCurrent"] = true;

        $texto[] = "</div>";
        $opciones_json = json_encode($opciones_fecha, JSON_NUMERIC_CHECK);
        $texto[] = '<script type="text/javascript">
                $(function () {
                    var configuracion=' . $opciones_json . ';
                    $("#' . $nombre_selector . '").datetimepicker(configuracion);
                    $("#content_container").height($(window).height());
                });
            </script>';
        $texto[] = "</div>";
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
     */
    private function generateInteger($campo, $moneda = false)
    {
        $campo = $campo->getAttributes();
        $valor = $campo["valor"];

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

            $ini = 0;
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
            $aux2[] = 'min="' . $ini . '"';
            $aux2[] = 'max="' . $fin . '"';
            $aux2[] = 'step=' . $incremento;
            $ancho = ' col-md-' . $tam . ' col-lg-' . $tam . ' col-xl-' . $tam . '';
        } else if (!empty($valor)) {
            $parametros = explode("@", $valor);
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
        $texto[] = '<div class="form-group ' . $obligatorio . $ancho . '" id="tr_' . $campo["nombre"] . '">';
        $texto[] = '<label title="' . $campo["ayuda"] . '" for="' . $campo["nombre"] . '">' . $campo["etiqueta"] . '</label>';
        if ($moneda) {
            $pre = '<div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>';
            $post = '</div>';
            $ancho = "";
        }
        $texto[] = $pre;
        $texto[] = '<input class="form-control" ' . " $adicionales . $obligatorio" . ' type="number" id="' . $campo["nombre"] . '" name="' . $campo["nombre"] . '"  value="' . $valor . '">';
        $texto[] = '</div>';
        $texto[] = $post;
        return implode("\n", $texto);
    }

    /**
     * genera un componente tipo autocompletar
     *
     * @param string $nombre
     * @param object $parametros
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    private function generateAutocomplete($nombre, $parametros)
    {

        /* {"tipo":"multiple","url":"../../autocompletar.php","campoid":"funcionario_codigo","campotexto":["nombres","apellidos"],"tablas":["funcionario"],"condicion":"estado=1","orden":""} */
        if ($parametros->tipo == "simple") {
            $tipo = "1";
        } else {
            $tipo = "null";
        }

        $consulta = array(
            "campoid" => $parametros->campoid,
            "campotexto" => $parametros->campotexto,
            "tablas" => $parametros->tablas,
            "condicion" => $parametros->condicion,
            "orden" => $parametros->orden
        );

        $consulta64 = base64_encode(json_encode($consulta));

        $selector = "[name='$nombre']";

        $campo = '
            <script>
            $(document).ready(function(){
        $("' . $selector . '").selectize({
            valueField: "value",
            labelField: "text",
            searchField: "text",
        persist: false,
        createOnBlur: true,
        create: false,
        maxItems: ' . $tipo . ',
        load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: "' . $parametros->url . '",
                    type: "POST",
                    dataType: "json",
                    data: {
                        consulta: "' . $consulta64 . '",
                        valor: query,
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        });
            });';
        $campo .= '</script>';

        return ($campo);
    }
}
