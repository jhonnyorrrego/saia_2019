<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

class GenerarBuscar {

    private $idformato;

    private $accion;

    private $incluidos;

    public function __construct($idformato, $accion) {
        $this->idformato = $idformato;
        $this->accion = $accion;
    }

    /*
     * <Clase>
     * <Nombre>crear_formato_buscar</Nombre>
     * <Parametros>$idformato:id del formato;$accion:buscar</Parametros>
     * <Responsabilidades>crear la interface para realizar las busquedas sobre los formatos<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function crear_formato_buscar() {
        global $conn, $ruta_db_superior;
        $datos_detalles["numcampos"] = 0;
        $texto = '';
        $includes = "";
        $this->incluidos = array();
        $obligatorio = "";
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            $action = '../librerias/funciones_buscador.php';
            $texto .= '<body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="' . $action . '" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ' . $this->codifica($formato[0]["etiqueta"]) . '</td></tr>';
            $librerias = array();
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $texto1 = '<?php include_once("../../' . FORMATOS_SAIA . 'librerias/funciones_generales.php';
            $texto2 = '"); ? >';
            $includes .= $texto1 . $texto2;
            $includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
            $includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
            $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
            if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
                $includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
            }
            if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
                $includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
            }
            $radio = 0;

            $texto .= $includes;
            $arboles = 0;
            $dependientes = 0;
            $mascaras = 0;
            $textareas = 0;
            $autocompletar = 0;
            $checkboxes = 0;
            $ejecutores = 0;
            $fecha = 0;
            $archivo = 0;
            $lista_enmascarados = "";
            $listado_campos = array();
            $unico = array();
            $obliga = "";
            $adicionales = "";
            $campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $this->idformato, "orden ASC", $conn);
            $fun_campos = array();
            for ($h = 0; $h < $campos["numcampos"]; $h++) {
                $saltar_campo = false;
                if ($campos[$h]["etiqueta_html"] == "arbol")
                    $arboles = 1;
                elseif ($campos[$h]["etiqueta_html"] == "textarea")
                    $textareas = 1;
                $obliga = "";
                // ******************** validaciones *****************
                $adicionales = "";
                $longitud = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica ='maxlength' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
                if ($longitud["numcampos"]) {
                    if ($longitud[0][0] > $campos[$h]["longitud"])
                        $adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";
                    else
                        $adicionales .= "maxlength=\"" . $longitud[0][0] . "\" ";
                } elseif ($campos[$h]["longitud"])
                    $adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";

                $caracteristicas = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica not in('adicionales','class','maxlength') and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
                for ($c = 0; $c < $caracteristicas["numcampos"]; $c++) {
                    $adicionales .= $caracteristicas[$c]["tipo_caracteristica"] . "=\"" . $caracteristicas[$c]["valor"] . "\" ";
                }
                $class = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica='class' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
                if ($class["numcampos"])
                    $adicionales .= " class=\"" . $class[0][0] . "\" ";
                // atributos adicionales
                $otros = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica='adicionales' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
                if ($otros["numcampos"])
                    $adicionales .= $otros[0]["valor"];

                $valor = "";
                switch ($campos[$h]["etiqueta_html"]) {
                    case "password":
                        $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><input type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '"></td>
                    </tr>';
                        break;
                    case "fecha":
                        // si la fecha es obligatoria, que valide que no se vaya con solo ceros
                        $adicionales = str_replace("required", "required dateISO", $adicionales);
                        if ($campos[$h]["tipo_dato"] == "DATE") {
                            $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                       <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '_1" id="' . $campos[$h]["nombre"] . '_1" tipo="fecha" value="';

                            $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>&nbsp;&nbsp; Y &nbsp;&nbsp;';
                            $texto .= '<input type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '_2" id="' . $campos[$h]["nombre"] . '_2" tipo="fecha" value="';

                            $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font>';
                            $fecha++;
                        } else if ($campos[$h]["tipo_dato"] == "DATETIME") {
                            $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="' . $campos[$h]["nombre"] . '_1" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '_1" value="';

                            $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>&nbsp;&nbsp; Y &nbsp;&nbsp;';
                            $texto .= '<input type="text" readonly="true" name="' . $campos[$h]["nombre"] . '_2" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '_2" value="';

                            $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>';
                            $fecha++;
                        } else
                            alerta_formatos("No esta definido su formato de Fecha");
                        $texto .= '</td></tr>';
                        break;
                    case "radio":
                                        /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
                                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);

                        $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
                        break;
                    case "checkbox":
                        $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion("arbol", $campos[$h]["nombre"]);
                        $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
                        $checkboxes++;
                        break;
                    case "select":
                        $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);
                        $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
                        break;
                    case "dependientes":
                                        /*parametros:
                                         nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
                                         (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)*/
                                        $parametros = explode("|", $campos[$h]["valor"]);
                        if (count($parametros) < 2)
                            alerta_formatos("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"]);
                        else {
                            $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);
                            $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
                            $dependientes++;
                        }
                        break;
                    case "autocompletar":
                                        /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                                         ej: nombres,apellidos;idfuncionario;funcionario

                                         Queda pendiente La parte de la busqueda.
                                         */
                                        $texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]) . '
                   <td bgcolor="#F5F5F5">';
                        $texto .= '<input type="text" size="30" ' . $adicionales . ' value="" id="input' . $campos[$h]["idcampos_formato"] . '" onkeyup="lookup(this.value,' . $campos[$h]["idcampos_formato"] . ');" onblur="fill(this.value,' . $campos[$h]["idcampos_formato"] . ');" />
                <div class="suggestionsBox" id="suggestions' . $campos[$h]["idcampos_formato"] . '" style="display: none;">
				        <div class="suggestionList" id="list' . $campos[$h]["idcampos_formato"] . '" >&nbsp;
        				</div>
        			  </div>
        			  <input ' . $obligatorio . ' type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '">
                </td></tr>';
                        $autocompletar++;
                        break;
                    case "etiqueta":
                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5"><label>' . $valor . '</label><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '"></td>
                  </tr>';
                        break;
                    case "arbol":
                                        /*En campos valor se deben almacenar los siguientes datos:
                                         arreglo[0]:ruta de el xml
                                         arreglo[1]=1=> checkbox;arreglo[1]=2=>radiobutton
                                         arreglo[2] Modo calcular numero de nodos hijo
                                         arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
                                         arreglo[4] Busqueda
                                         arreglo[5] Almacenar 0=>iddato 1=>valordato
                                         arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias
                                         */
                                        $arreglo = explode(";", $campos[$h]["valor"]);
                        if (isset($arreglo) && $arreglo[0] != "") {
                            $ruta = "\"" . $arreglo[0] . "\"";
                        } else {
                            $ruta = "\"../arboles/test_dependencia.xml\"";
                            $arreglo[1] = 0;
                            $arreglo[2] = 0;
                            $arreglo[3] = 0;
                            $arreglo[4] = 1;
                        }
                        $texto .= '<tr>' . $this->generar_condicion($campos[$h]["nombre"]) . '
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion("arbol", $campos[$h]["nombre"]) . '<td bgcolor="#F5F5F5"><div id="esperando_' . $campos[$h]["nombre"] . '"><img src="../../imagenes/cargando.gif"></div>';
                        $texto .= '<div id="seleccionados">' . $this->arma_funcion("mostrar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",'" . $arreglo[6] . "'", "mostrar") . '</div>
                          <br />  ';
                        if ($arreglo[4]) {
                            $texto .= 'Buscar: <input type="text" id="stext_' . $campos[$h]["nombre"] . '" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />';
                        }
                        $texto .= '<div id="treeboxbox_' . $campos[$h]["nombre"] . '" height="90%"></div>';
                        // miro si ya estan incluidas las librerias del arbol
                        $texto .= '<input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '"  ';
                        if ($accion == "editar") {
                            $texto .= ' value="' . $this->arma_funcion("cargar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . '" >';
                        } else
                            $texto .= ' value="" ><label style="display:none" class="error" for="' . $campos[$h]["nombre"] . '">Campo obligatorio.</label>';
                        $texto .= '<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_' . $campos[$h]["nombre"] . '=new dhtmlXTreeObject("treeboxbox_' . $campos[$h]["nombre"] . '","100%","100%",0);
                			tree_' . $campos[$h]["nombre"] . '.setImagePath("../../imgs/");
                			tree_' . $campos[$h]["nombre"] . '.enableIEImageFix(true);';
                        if ($arreglo[1] == 1) {
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                			tree_' . $campos[$h]["nombre"] . '.enableThreeStateCheckboxes(1);';
                        } else if ($arreglo[1] == 2) {
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                    tree_' . $campos[$h]["nombre"] . '.enableRadioButtons(true);';
                        }
                        $texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnLoadingStart(cargando_' . $campos[$h]["nombre"] . ');
                      tree_' . $campos[$h]["nombre"] . '.setOnLoadingEnd(fin_cargando_' . $campos[$h]["nombre"] . ');';
                        if ($arreglo[3]) {
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableSmartXMLParsing(true);';
                        } else
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.setXMLAutoLoading(' . $ruta . ');';
                        if ($accion == "editar") {
                            $ruta .= ",checkear_arbol";
                        }
                        $texto .= 'tree_' . $campos[$h]["nombre"] . '.loadXML(' . $ruta . ');
                      tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');
                      function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId)
                      {valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");
                       destinos=tree_' . $campos[$h]["nombre"] . '.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_' . $campos[$h]["nombre"] . '.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }';
                        $texto .= "
                      function fin_cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.visibility = \"hidden\";
                      }
                      function cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.visibility = \"visible\";
                      }
                	";
                        if ($accion == "editar") {
                            $texto .= "
                  function checkear_arbol(){
                  vector2=\"" . $this->arma_funcion("cargar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . "\";
                  vector2=vector2.split(\",\");
                  for(m=0;m<vector2.length;m++)
                    {tree_" . $campos[$h]["nombre"] . ".setCheck(vector2[m],true);
                    }}\n";
                        }
                        $texto .= "--></script>";
                        $texto .= '</td></tr>';
                        $arboles++;
                        break;
                    case "detalle":
                        $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
                        if ($padre["numcampos"]) {
                            $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
                            $texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
                        }
                        break;
                    case "ejecutor":
                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion("arbol", $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><select multiple ' . " $adicionales " . ' id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#' . $campos[$h]["nombre"] . '").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script>';
                        $ejecutores++;
                        break;

                    default: // text
                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">' . $this->generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . $this->generar_comparacion("arbol", $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><select multiple id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '"></select><script>
                     $(document).ready(function()
                      {
                      $("#' . $campos[$h]["nombre"] . '").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr>';
                        $ejecutores++;
                        break;
                }

                array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
            }
            // die();
            // ******************************************************************************************
            $wheref = "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $this->idformato . " AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";

            $funciones = busca_filtro_tabla("A.*,B.formato_idformato", "funciones_formato A, funciones_formato_enlace B", $wheref, " A.idfunciones_formato asc", $conn);
            for ($i = 0; $i < $funciones["numcampos"]; $i++) {
                $ruta_orig = "";
                // saco el primer formato de la lista de la funcion (formato inicial)
                $formato_orig = $funciones[0]["formato_idformato"];
                // si el formato actual es distinto del formato inicial
                if ($formato_orig != $this->idformato) { // busco el nombre del formato inicial
                    $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                    if ($dato_formato_orig["numcampos"]) {
                        // si el archivo existe dentro de la carpeta del archivo inicial
                        if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                        } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                            $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                        } else { // si no existe en ninguna de las dos
                            $ruta_libreria = FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"];
                            $ruta_real = realpath($ruta_libreria);
                            if ($ruta_real === false) {
                                $ruta_real = normalizePath($ruta_libreria);
                            }
                            // trato de crearlo dentro de la carpeta del formato actual
                            if (crear_archivo($ruta_real)) {
                                $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                            } else {
                                alerta_formatos("FB 464 No es posible generar el archivo " . $ruta_real);
                            }
                        }
                    }
                } else { // $ruta_orig=$formato[0]["nombre"];
                         // si el archivo existe dentro de la carpeta del formato actual
                    if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } else if (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                    } else { // si no existe en ninguna de las dos
                             // trato de crearlo dentro de la carpeta del formato actual
                        $ruta_libreria = FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"];
                        $ruta_real = realpath($ruta_libreria);
                        if ($ruta_real === false) {
                            $ruta_real = normalizePath($ruta_libreria);
                        }
                        if (crear_archivo($ruta_real)) {
                            $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                        } else {
                            alerta_formatos("FB 486 No es posible generar el archivo " . $ruta_real);
                        }
                    }
                }
                if (!in_array($funciones[$i]["nombre_funcion"], $fun_campos)) {
                    $parametros = "$this->idformato,NULL";
                    $texto .= $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, $accion);
                }
            }
            // ******************************************************************************************
            $campo_descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $this->idformato . " AND acciones LIKE '%p%'", "", $conn);
            $valor1 = extrae_campo($campo_descripcion, "idcampos_formato", "U");
            $valor = implode(",", $valor1);
            if ($campo_descripcion["numcampos"]) {
                if ($accion == "editar") {
                    if ($formato[0]["detalle"]) {
                        $valor = "<?php echo('" . $valor . "'); ? >";
                    } else {
                        $valor = "<?php echo('" . $valor . "'); ? >";
                    }
                }
                $texto .= '<input type="hidden" name="campo_descripcion" value="' . $valor . '">';
            } else {
                alerta_formatos("Recuerde asignar el campo que sera almacenado como descripcion del documento");
            }
            if ($accion == "editar") {
                $texto .= '<input type="hidden" name="formato" value="' . $idformato . '">';
            }
            if ($formato[0]["detalle"]) {
                $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>">';
                $texto .= '<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?' . '>">';
                if ($accion == "adicionar") {
                    $texto .= '<input type="hidden" name="accion" value="guardar_detalle" >';
                } elseif ($accion == "editar") {
                    $texto .= '<input type="hidden" name="accion" value="editar" >';
                    $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                    $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
                }
            }
            if ($formato[0]["item"]) {
                $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden" name="formato" value="' . $formato[0]["nombre"] . '">';
                if ($accion == "adicionar") {
                    $texto .= '<input type="hidden" name="accion" value="guardar_item" >';
                } elseif ($accion == "editar") {
                    $texto .= '<input type="hidden" name="accion" value="editar" >';
                    $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                    $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
                }
            }
            $texto .= $this->arma_funcion("submit_formato", $idformato, "adicionar");
            $texto .= '</table>';
            if ($archivo)
                $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
            /* Se debe tener especial cuidado con los campos con doble guion bajo ya que se muestra asi para evitar que un funcionario pueda seleccionar un campo con el mismo nombre */
            $texto .= '<?php if(@$_REQUEST["campo__retorno"]){ ?' . '>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?' . '>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?' . '>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?' . '>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?' . '>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?' . '>">
             <?php  }
              else{ ?' . '>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?' . '>">
             <?php  } ?' . '>';
            $texto .= '</form></body>';
            if ($fecha) {
                $includes .= $this->incluir("../../calendario/calendario.php", "librerias");
            }
            if ($textareas) {
                $includes .= $this->incluir_libreria("header_formato.php", "librerias");
            }
            $includes .= "<?php echo(librerias_jquery('1.8')); ?>";
            $includes .= $this->incluir("../../js/jquery.validate.js", "javascript");

            $includes .= $this->incluir("../../js/title2note.js", "javascript");
            if ($arboles) {
                $includes .= $this->incluir("../../js/dhtmlXCommon.js", "javascript");
                $includes .= $this->incluir("../../js/dhtmlXTree.js", "javascript");
                $includes .= $this->incluir("../../css/dhtmlXTree.css", "estilos");
            }
            if ($ejecutores) {
                $includes .= $this->incluir("../../js/jquery.fcbkcomplete.js", "javascript");
                $includes .= $this->incluir("../../css/style_fcbkcomplete.css", "estilos");
            }
            if ($autocompletar) {
                $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
                $includes .= $this->incluir("../../js/selectize.js", "javascript");
                $includes .= $this->incluir("../../css/selectize.css", "estilos");
                // $includes .= $this->incluir("../librerias/autocompletar.js", "javascript");
            }
            if ($dependientes > 0) {
                $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
                $includes .= $this->incluir("../librerias/dependientes.js", "javascript");
            }
            $contenido = "<html><title>.:" . strtoupper($accion . " " . $formato[0]["etiqueta"]) . ":.</title><head>" . $includes . $enmascarar . "</head>" . $texto . "</html>";
            if ($accion == "editar")
                $contenido .= '<?php include_once("../librerias/footer_plantilla.php");?' . '>';
            $mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/buscar_" . $formato[0]["nombre"] . ".php", $contenido);
            if ($mostrar != "") {
                alerta_formatos("Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar));
            }
        } else {
            alerta_formatos("No es posible generar el Formato");
        }
    }

    /*
     * <Clase>
     * <Nombre>generar_condicion</Nombre>
     * <Parametros>$nombre:nombre del campo</Parametros>
     * <Responsabilidades>Crea un select para que se pueda elegir si la condici?n sobre el campo especificado es de obligatorio cumplimiento en la busqueda o no<Responsabilidades>
     * <Notas>usado para la pantalla de busqueda del formato</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function generar_condicion($nombre) {
        $texto = '<div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor(\'bqsaiaenlace_' . $nombre . '\',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor(\'bqsaiaenlace_' . $nombre . '\',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_' . $nombre . '" id="bqsaiaenlace_' . $nombre . '" value="y" />
		</div>';
        return ($texto);
    }

    /*
     * <Clase>
     * <Nombre>generar_comparacion</Nombre>
     * <Parametros>$tipo:tipo de campo sobre el que se va a hacer la comparacion;$nombre:nombre del campo</Parametros>
     * <Responsabilidades>genera un listado con las opciones de comparaci?n posibles seg?n el tipo de campo<Responsabilidades>
     * <Notas>usado para la pantalla de busqueda del formato</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function generar_comparacion($tipo, $nombre) {
        $texto = '';
        $listado = array();
        switch ($tipo) {
            case "INT":
                $texto = '<input type="hidden" name="bksaiacondicion_' . $nombre . '" id="bksaiacondicion_' . $nombre . '" value="=">';
                break;
            case "arbol":
                $texto = '<input type="hidden" name="bksaiacondicion_' . $nombre . '" id="bksaiacondicion_' . $nombre . '" value="like">';
                break;
            case "date":
                $texto = '<input type="hidden" name="bksaiacondicion_' . $nombre . '" id="bksaiacondicion_' . $nombre . '" value="date">';
                break;
            case "datetime":
                $texto = '<input type="hidden" name="bksaiacondicion_' . $nombre . '" id="bksaiacondicion_' . $nombre . '" value="datetime">';
                break;
            default:
                $texto = '<input type="hidden" name="bksaiacondicion_' . $nombre . '" id="bksaiacondicion_' . $nombre . '" value="like_total">';
                break;
        }
        return ($texto);
    }

    /*
     * <Clase>
     * <Nombre></Nombre>
     * <Parametros>cad:cadena con las rutas relativas de los archivos a incluir separadas por comas;
     * tipo:Tipo de libreria a incluir librerias->php, javascript->js,estilos->css;
     * eval:Si debe crear el archivo o no</Parametros>
     * <Responsabilidades>Genera la cadena que se necesita incluir los archivos especificados<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida>Cadena de texto</Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function incluir($cad, $tipo, $eval = 0) {
        $includes = "";
        $lib = explode(",", $cad);
        switch ($tipo) {
            case "librerias":
                $texto1 = '<?php include_once("';
                $texto2 = '"); ?' . '>';
                break;
            case "javascript":
                $texto1 = '<script type="text/javascript" src="';
                $texto2 = '"></script>';
                break;
            case "estilos":
                $texto1 = '<link rel="stylesheet" type="text/css" href="';
                $texto2 = '"/>';
                break;
            default:
                return (""); // retorna un vacio si no existe el tipo
                break;
        }
        for ($j = 0; $j < count($lib); $j++) {
            $includes .= $texto1 . $lib[$j] . $texto2;
            array_push($this->incluidos, $texto1 . $lib[$j] . $texto2);
        }
        return ($includes);
    }

    /*
     * <Clase>
     * <Nombre>incluir_libreria</Nombre>
     * <Parametros>$nombre:nombre del archivo;$tipo:tipo de archivo php, js, css</Parametros>
     * <Responsabilidades>Crea la cadena necesaria para incluir un archivo que se encuentre en la carpeta formatos/librerias<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function incluir_libreria($nombre, $tipo) {
        $includes = "";
        if (!is_file(FORMATOS_SAIA . "librerias/" . $nombre)) {
            if (!crear_archivo(FORMATOS_SAIA . "librerias/" . $nombre)) {
                alerta_formatos("No es posible generar el archivo " . $nombre);
            }
        }
        $includes .= $this->incluir("../../" . FORMATOS_SAIA . "librerias/" . $nombre, $tipo);
        return ($includes);
    }

    /*
     * <Clase>
     * <Nombre>arma_funcion</Nombre>
     * <Parametros>$nombre:nombre de la funci?n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
     * <Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funci?n especificada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    function arma_funcion($nombre, $parametros, $accion) {
        if ($parametros != "" && $accion != "adicionar" && $accion != 'buscar')
            $parametros .= ",";
        if ($accion == "mostrar")
            $texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
        elseif ($accion == "adicionar")
            $texto = "<?php " . $nombre . "(" . $parametros . ");? >";
        elseif ($accion == "editar")
            $texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
        elseif ($accion == "buscar")
            $texto = "<?php " . $nombre . "(" . $parametros . ",'',1,'" . $accion . "');? >";
        return ($texto);
    }

    /*
     * <Clase>
     * <Nombre>codifica</Nombre>
     * <Parametros>$texto:texto que se desea codificar</Parametros>
     * <Responsabilidades>llama la funci?n que pasa el texto a mayusculas y devuelve el nuevo texto modificado<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    function codifica($texto) {
        // strtoupper(codifica_encabezado(html_entity_decode($campos[$h]["etiqueta"].generar_comparacion($campos[$h]["tipo_dato"],$campos[$h]["nombre"]))))
        return mayusculas($texto);
    }
}
?>