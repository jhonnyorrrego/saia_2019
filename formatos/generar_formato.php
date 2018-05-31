<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");

if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
    logear_funcionario_webservice($_REQUEST["LOGIN"]);
}
include_once ($ruta_db_superior . FORMATOS_SAIA . "librerias/funciones.php");
include_once ($ruta_db_superior . FORMATOS_SAIA . "generar_formato_buscar.php");
include_once ($ruta_db_superior . "pantallas/documento/class_documento_elastic.php");

if (@$_REQUEST["archivo"] != '') {
    $archivo = $ruta_db_superior . str_replace("-", "/", $_REQUEST["archivo"]);
}
if (@$_REQUEST["crea"]) {
    $_REQUEST["genera"] = $_REQUEST["crea"];
}
if (@$_REQUEST["genera"]) {
    $accion = $_REQUEST["genera"];
    if (@$_REQUEST["idformato"]) {
        $idformato = $_REQUEST["idformato"];
        $generar = new GenerarFormato($idformato, $accion, $archivo);
        $redireccion = $generar->ejecutar_accion();
    } else {
        alerta_formatos("por favor seleccione un Formato a Generar");
        $redireccion = "formatolist.php";
        if ($archivo != '') {
            $redireccion = $archivo;
        }
    }
    if ($_REQUEST["llamado_ajax"] && $accion != "buscar") {
        echo (json_encode(array(
            "exito" => $generar->exito,
            "mensaje" => $generar->mensaje
        )));
    }
    redirecciona($redireccion);
}

class GenerarFormato {

    private $accion;

    private $idformato;

    private $archivo;

    private $incluidos;

    public $exito;

    public $mensaje;

    public function __construct($idformato, $accion, $archivo = '') {
        $this->idformato = $idformato;
        $this->accion = $accion;
        $this->archivo = $archivo;
        $this->incluidos = array();
        $this->exito = 0;
        $this->mensaje = "Existe un error al generar el formato " . $accion . " con id " . $idformato;
    }

    public function ejecutar_accion() {
        // ir a la carpeta anterior
        $ruta_padre = dirname(__DIR__);
        chdir($ruta_padre);
        $redireccion = false;
        switch (@$this->accion) {
            case "formato":
                $redireccion = $this->generar_formato();
                break;
            case "tabla":
                $this->generar_tabla();
                if (defined("INDEXA_ELASTICSEARCH") && INDEXA_ELASTICSEARCH) {
                    $doc_elastic = new DocumentoElastic(null);
                    $doc_elastic->actualizar_indice_formato($this->idformato);
                }

                $redireccion = "campos_formatolist.php?idformato=" . $this->idformato;
                break;
            case "vista":
                $this->generar_vista();
                $redireccion = "vista_formatoedit.php?key=" . $_REQUEST["idformato"];
                break;
            case "mostrar":
                $this->crear_formato_mostrar();
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
                break;
            case "adicionar":
                $this->crear_formato_ae("adicionar");
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
                break;
            case "editar":
                $this->crear_formato_ae("editar");
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
                break;
            case "buscar":
                $generar = new GenerarBuscar($this->idformato, "buscar");
                $generar->crear_formato_buscar();
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
                if ($_REQUEST["llamado_ajax"]) {
                    echo (json_encode(array(
                        "exito" => $generar->exito,
                        "mensaje" => $generar->mensaje
                    )));
                }
                break;
            case "eliminar":
                $this->crear_formato_mostrar("eliminar");
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
                break;
        }

        if ($this->archivo != '') {
            $redireccion = $this->archivo;
        }

        chdir(__DIR__);
        return ($redireccion);
    }

    /*
     * <Clase>
     * <Nombre>generar_tabla</Nombre>
     * <Parametros>$idformato:</Parametros>
     * <Responsabilidades>Crear automaticamente los campos predeterminados como la serie,documento_iddocumento, la llave primaria... etc, verifica si la tabla est� creada, crea o actualiza la tabla con todos los campos como se han definido previamente<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function generar_tabla() {
        global $conn;
        $sql_tabla = "";
        $lcampos = array();
        $idesta = 0;
        $iddocesta = 0;
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            $resp = $conn->formato_generar_tabla($this->idformato, $formato);
            if ($resp["estado"] == "OK") {
                $this->exito = 1;
            } else {
                $this->exito = 0;
            }
            $this->mensaje = $resp["mensaje"];
            alerta_formatos($resp["mensaje"]);
        } else {
            alerta_formatos("No es posible Generar la tabla para el Formato");
            return (false);
        }
    }

    /*
     * <Clase>
     * <Nombre>es_indice</Nombre>
     * <Parametros>$campo:nombre del campo;$tabla:nombre de la tabla;$indice:vector donde se guarda la informacion consultada</Parametros>
     * <Responsabilidades>Verifca si en la tabla y el campo elegidos existe algun indice<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function es_indice($campo, $tabla, $indice) {
        global $conn;
        $indice = ejecuta_filtro_tabla("SHOW INDEX FROM " . strtolower($tabla) . " WHERE Column_name LIKE '" . $campo . "'", $conn);
        if (!$indice["numcampos"]) {
            return (false);
        }
        return (true);
    }

    /*
     * <Clase>
     * <Nombre>maximo_valor</Nombre>
     * <Parametros>$valor:valor asignado por configuraci�n;$maximo:valor m�ximo aceptado por el tipo de dato</Parametros>
     * <Responsabilidades>Valida si el valor que se est� asignando al tipo de dato est� en el rango permitido, si no lo est� devuelve el m�ximo<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida>devuelve el n�mero m�ximo permitido</Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function maximo_valor($valor, $maximo) {
        if ($valor > $maximo || $valor == "NULL")
            return ($maximo);
        else
            return ($valor);
    }

    /*
     * <Clase>
     * <Nombre>crear_formato_mostrar</Nombre>
     * <Parametros>$idformato:id del formato</Parametros>
     * <Responsabilidades>Se encarga de crear el archivo con el mostrar del formato correspondiente basandose en la configuraciones realizadas<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function crear_formato_mostrar() {
        global $conn;
        $include_formato = '';
        $includes = '';
        $texto = '';
        $enlace = "";
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            if (strpos($formato[0]["banderas"], "acordeon") !== false) {
                $texto .= '<frameset cols="410,*" >';
                $texto .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'librerias/formato_detalles.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="no" >';
            } else {
                $texto .= '<frameset cols="250,*" >';
                $texto .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'arboles/arbolformato_documento.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="auto" >';
            }
            $texto .= '<frame name="detalles" src="" border="0" marginwidth="20px" marginheight="10" scrolling="auto"></frameset>';
            $contenido_detalles = $texto;

            if (!crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/detalles_" . $formato[0]["ruta_mostrar"], $contenido_detalles)) {
                alerta_formatos("No es posible crear el Archivo de detalles");
            }
            $texto = '';

            $texto .= '<tr><td>';
            $archivos = 0;
            $texto .= htmlspecialchars_decode($formato[0]["cuerpo"]);
            $texto .= '</td></tr>';
            $librerias = array();
            $campos = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $this->idformato, "", $conn);
            $lcampos = extrae_campo($campos, "nombre", "U");

            for ($i = 0; $i < $campos["numcampos"]; $i++) {
                if ($campos[$i]["etiqueta_html"] == "autocompletar") {
                    $parametros = explode(";", $campos[$i]["valor"]);
                    $texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", "<?php busca_campo(" . "'" . $parametros[0] . "','" . $parametros[1] . "','" . $parametros[2] . "',mostrar_valor_campo('" . $campos[$i]["nombre"] . "','" . $this->idformato . "',$" . "_REQUEST['iddoc'],1)); ?" . ">", $texto);
                } elseif ($campos[$i]["etiqueta_html"] == "detalle") {
                    $texto = str_replace("{*listado_detalles_" . str_replace("id", "", $campos[$i]["nombre"]) . "*}", $this->arma_funcion("buscar_listado_formato", "'" . $formato[0]["nombre"] . "'," . $campos[$i]["valor"], "mostrar"), $texto);
                } else {
                    $texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", $this->arma_funcion("mostrar_valor_campo", "'" . $campos[$i]["nombre"] . "',$this->idformato", "mostrar"), $texto);
                }
                if ($campos[$i]["etiqueta_html"] == "archivo") {
                    $archivos++;
                }
            }

            $funciones = busca_filtro_tabla("A.*,B.funciones_formato_fk", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $this->idformato . " AND A.acciones LIKE '%m%'", "A.idfunciones_formato asc", $conn);
            for ($i = 0; $i < $funciones["numcampos"]; $i++) {
                $ruta_orig = "";
                // saco el primer formato de la lista de la funcion (formato inicial)
                $form_origen = busca_filtro_tabla("formato_idformato", "funciones_formato_enlace", "funciones_formato_fk=" . $funciones[$i]["funciones_formato_fk"], "idfunciones_formato_enlace asc", $conn);
                if ($form_origen["numcampos"]) {
                    $formato_orig = $form_origen[0]["formato_idformato"];
                }

                if ($formato_orig != $this->idformato) {
                    // busco el nombre del formato inicial
                    $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                    if ($funciones[$i]["ruta"] == "funciones.php") {
                        if ($dato_formato_orig["numcampos"]) {
                            // si el archivo existe dentro de la carpeta del archivo inicial
                            if (is_file($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                $include_formato .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                            } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                                $include_formato .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                            } else {
                                alerta("Hay funciones vinculadas al archivo (" . $funciones[$i]["ruta"] . ") => " . $funciones[$i]["nombre_funcion"] . ", el archivo no se ha encontrado");
                            }
                        }
                    } else { // busco el nombre del formato inicial
                        if ($dato_formato_orig["numcampos"] && ($dato_formato_orig[0]["nombre"] != $formato[0]["nombre"])) {
                            $eslibreria = strpos($funciones[$i]["ruta"], "../librerias/");
                            if ($eslibreria === false) {
                                $eslibreria = strpos($funciones[$i]["ruta"], "../class_transferencia");
                            }

                            if (!$eslibreria) {
                                if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                    $include_formato .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                                } elseif (is_file(FORMATOS_CLIENTE . $funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                                    $include_formato .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                                } else { // si no existe en ninguna de las dos
                                    // trato de crearlo dentro de la carpeta del formato actual
                                    alerta_formatos("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
                                    if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                        $include_formato .= $this->incluir($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                                    } else {
                                        alerta_formatos("No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                                    }
                                }
                            }

                            // si el archivo existe dentro de la carpeta del archivo inicial
                        }
                    }

                }
                 else { // $ruta_orig=$formato[0]["nombre"];
                         // si el archivo existe dentro de la carpeta del formato actual
                    if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $include_formato .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $include_formato .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } else { // si no existe en ninguna de las dos
                             // trato de crearlo dentro de la carpeta del formato actual
                        if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $include_formato .= $this->incluir($funciones[$i]["ruta"], "librerias");
                        } else {
                            alerta_formatos("907 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                        }
                    }
                }
                if ($funciones[$i]["parametros"] != "") {
                    $parametros = $this->idformato . "," . $funciones[$i]["parametros"];
                } else {
                    $parametros = $this->idformato;
                }
                $texto = str_replace($funciones[$i]["nombre"], $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, "mostrar"), $texto);
            }

            $includes .= $this->incluir("../../librerias_saia.php", "librerias");
            $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
            $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
            $includes .= $this->incluir("../../class_transferencia.php", "librerias");
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $includes .= $include_formato;
            $includes .= $this->incluir_libreria("header_nuevo.php", "librerias");
            $contenido = $includes . $texto . $enlace . $this->incluir_libreria("footer_nuevo.php", "librerias");
            $mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"], $contenido);
            if ($mostrar !== false) {
                notificaciones("Formato mostrar Creado con exito por favor verificar la carpeta " . dirname($mostrar), "success", 2000);
                $this->exito = 1;
                $this->mensaje = "Formato mostrar Creado con exito por favor verificar la carpeta " . dirname($mostrar);
                return (true);
            } else {
                notificaciones("Error al crear el archivo " . dirname($mostrar), "error", 5000);
                $this->exito = 0;
                $this->mensaje = "Error al crear el archivo";
            }
        } else {
            notificaciones("Formato NO encontrado ", "error", 5000);
            $this->exito = 0;
            $this->mensaje = "Formato no encontrado";
        }
        return (false);
    }

    /*
     * <Clase>
     * <Nombre>generar_vista</Nombre>
     * <Parametros>$idformato:id de la vista</Parametros>
     * <Responsabilidades>Se encarga de revisar que todas las funciones y campos asociados a la vista se encuentren previamente configurados, antes de proceder a llamar la funci�n que genera el archivo con el mostrar de la vista<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function generar_vista() {
        global $conn;
        $vista = busca_filtro_tabla("*", "vista_formato A", "A.idvista_formato=" . $this->idformato, "", $conn);
        if ($vista["numcampos"]) {
            $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
            $pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["pie_pagina"] . "'", "", $conn);
            $formato_padre = busca_filtro_tabla("", "formato", "idformato=" . $vista[0]["formato_padre"], "", $conn);
            $lcampos = "";
            $regs = array();
            $regs1 = array();
            $texto = $vista[0]["cuerpo"];
            if ($encabezado["numcampos"])
                $texto .= $encabezado[0][0];
            if ($pie["numcampos"])
                $texto .= $pie[0][0];
            $resultado = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*)+\*})', $texto, $regs);
            $campos = array_unique($regs[0]);
            sort($campos);

            $campos_editar = array();
            $campos_edit = array();
            $campos_adicionar = array();
            $campos_otrosf = array();
            if ($campos) {
                $l1campos = array();
                $l1tablas = array();
                foreach ($campos as $key => $value) {
                    $valor = explode('.', $value);
                    if (@$valor[1] == "" && $valor[0] != "") {
                        $valor[1] = $valor[0];
                        $valor[0] = $formato_padre[0]["nombre_tabla"];
                    }
                    if (array_key_exists($valor[0], $l1tablas)) {
                        array_push($l1tablas[$valor[0]], $valor[1]);
                    } else {
                        $l1tablas[$valor[0]] = array(
                            $valor[1]
                        );
                    }
                }
            } else
                alerta_formatos("La Vista del formato no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Vistas Formato y Luego Editela");
        } else
            alerta_formatos('No existen la vista seleccionada');

        $this->crear_vista_formato($l1tablas);
    }

    /*
     * <Clase>
     * <Nombre>crear_vista_formato</Nombre>
     * <Parametros>$idformato:id de la vista;$arreglo:contiene como llave los nombres de los campos y como valor el id del formato padre de la vista</Parametros>
     * <Responsabilidades>Se encarga de crear el archivo para mostrar en pantalla la vista seleccionada<Responsabilidades>
     * <Notas>si se necesita alguna funci�n, o un campo, �stos debe estar registrados como asociados al formato padre de la vista, de lo contrario no funciona</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function crear_vista_formato($arreglo) {
        global $conn;
        $vista = busca_filtro_tabla("*", "vista_formato A", "A.idvista_formato=" . $this->idformato, "", $conn);
        $includes = '';
        $texto = '';
        $enlace = "";
        if ($vista["numcampos"]) {
            $texto .= '<tr><td>';
            $archivos = 0;
            $texto .= htmlspecialchars_decode($vista[0]["cuerpo"]);
            $texto .= '</td></tr>';
            $librerias = array();
            $idformato_padre = $vista[0]["formato_padre"];
            $fpadre = busca_filtro_tabla("", "formato", "idformato=" . $idformato_padre, "", $conn);

            $campos = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $idformato_padre, "", $conn);
            $lcampos = extrae_campo($campos, "nombre", "U");
            for ($i = 0; $i < $campos["numcampos"]; $i++) {
                if ($campos[$i]["etiqueta_html"] == "autocompletar") {
                    $parametros = explode(";", $campos[$i]["valor"]);
                    $texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", "<?php busca_campo(" . "'" . $parametros[0] . "','" . $parametros[1] . "','" . $parametros[2] . "',mostrar_valor_campo('" . $campos[$i]["nombre"] . "','" . $idformato_padre . "',$" . "_REQUEST['iddoc'],1)); ?" . ">", $texto);
                } else {
                    $texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", $this->arma_funcion("mostrar_valor_campo", "'" . $campos[$i]["nombre"] . "',$idformato_padre", "mostrar"), $texto);
                }
                if ($campos[$i]["etiqueta_html"] == "archivo") {
                    $archivos++;
                }
            }
            if ($archivos) {
                $includes .= $this->incluir("../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js", "javascript");
                $includes .= $this->incluir("../../anexosdigitales/funciones_archivo.php", "librerias");
                $includes .= $this->incluir("../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js", "javascript");
                $includes .= '<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" />
    </style>';
                $includes .= "<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>";
            }

            $funciones = busca_filtro_tabla("A.*, B.funciones_formato_fk", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $idformato_padre . " AND A.acciones LIKE '%m%'", "A.idfunciones_formato", $conn);
            for ($i = 0; $i < $funciones["numcampos"]; $i++) {
                $ruta_orig = "";
                $formato_orig = $funciones[0]["formato_idformato"];
                if ($formato_orig != $idformato_padre) { // busco el nombre del formato inicial
                    $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                    if ($dato_formato_orig["numcampos"] && ($dato_formato_orig[0]["nombre"] != $fpadre[0]["nombre"])) {
                        $eslibreria = strpos($funciones[$i]["ruta"], "../librerias/");
                        if ($eslibreria === false) {
                            $eslibreria = strpos($funciones[$i]["ruta"], "../class_transferencia");
                        }
                        // si el archivo existe dentro de la carpeta del archivo inicial
                        if (is_file($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]) && $eslibreria === false) {
                            $includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                        } elseif (is_file($funciones[$i]["ruta"]) && $eslibreria === false) { // si el archivo existe en la ruta especificada partiendo de la raiz
                            $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                        } else if ($eslibreria === false) { // si no existe en ninguna de las dos
                                                            // trato de crearlo dentro de la carpeta del formato actual
                            alerta_formatos("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
                            if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                $includes .= $this->incluir($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                            } else
                                alerta_formatos("1073 No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                        }
                    }
                } else {
                    if (is_file($fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                    } else { // si no existe en ninguna de las dos
                             // trato de crearlo dentro de la carpeta del formato actual
                        if (crear_archivo(FORMATOS_CLIENTE . $fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                        } else
                            alerta_formatos("1087 No es posible generar el archivo " . $fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                    }
                }
                if ($funciones[$i]["parametros"] != "") {
                    $parametros = $idformato_padre . "," . $funciones[$i]["parametros"];
                } else {
                    $parametros = $idformato_padre;
                }
                $texto = str_replace($funciones[$i]["nombre"], $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, "mostrar"), $texto);
            }

            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
            $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
            $includes .= $this->incluir_libreria("header_nuevo.php", "librerias");
            $includes .= $this->incluir("../../class_transferencia.php", "librerias");

            $contenido = $includes . $texto . $enlace . $this->incluir_libreria("footer_nuevo.php", "librerias");
            $mostrar = crear_archivo($fpadre[0]["nombre"] . "/" . $vista[0]["ruta_mostrar"], $contenido);
            if ($mostrar != "") {
                $modulo_formato = busca_filtro_tabla("", "modulo", "nombre LIKE 'modulo_formatos'", "", $conn);
                if ($modulo_formato["numcampos"]) {
                    $submodulo_formato = busca_filtro_tabla("", "modulo", "nombre LIKE '" . $vista[0]["nombre"] . "'", "", $conn);
                    if (!$submodulo_formato["numcampos"]) {
                        $sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES ('" . $vista[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','" . $vista[0]["etiqueta"] . "','" . FORMATOS_CLIENTE . $vista[0]["ruta_mostrar"] . "','centro','" . $modulo_formato[0]["idmodulo"] . "','1','Permite administrar el formato " . $vista[0]["etiqueta"] . ".')";
                        guardar_traza($sql, $fpadre[0]["nombre_tabla"]);
                        phpmkr_query($sql, $conn);
                    }
                } else
                    alerta_formatos("El modulo Formatos No existe por favor insertarlo a la tabla modulos");
                alerta_formatos("Vista Creada con exito por favor verificar la carpeta " . dirname($mostrar));
                $this->exito = 1;
                $this->mensaje = "Vista Creada con exito por favor verificar la carpeta " . dirname($mostrar);
                return (TRUE);
            }
        } else {
            alerta_formatos("No es posible generar el Formato");
            $this->exito = 0;
            $this->mensaje = "No es posible generar la Vista del formato";
        }
    }

    /*
     * <Clase>
     * <Nombre>codifica</Nombre>
     * <Parametros>$texto:texto que se desea codificar</Parametros>
     * <Responsabilidades>llama la funci�n que pasa el texto a mayusculas y devuelve el nuevo texto modificado<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function codifica($texto) {
        return mayusculas($texto);
    }

    /*
     * <Clase>
     * <Nombre>crear_formato_ae</Nombre>
     * <Parametros>$idformato:id del formato;$accion:adicionar o editar</Parametros>
     * <Responsabilidades>Crea el archivo en el adicionar o el editar del formato segun la configuraci�n realizada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function crear_formato_ae($accion) {
        global $conn;
        $datos_detalles["numcampos"] = 0;
        $texto = '';
        $includes = "";
        $obligatorio = "";
        $autoguardado = array();
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            if ($formato[0]["item"]) {
                $action = '../../' . FORMATOS_SAIA . 'librerias/funciones_item.php';
            } else {
                $action = '../../class_transferencia.php';
            }
            $texto .= '<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");? ><form name="formulario_formatos" id="formulario_formatos" method="post" action="' . $action . '" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4">';

            if (!$formato[0]["item"]) {
                $texto .= '<tr><td colspan="2" class="encabezado_list">' . codifica_encabezado(html_entity_decode(mayusculas($formato[0]["etiqueta"]))) . '</td></tr>';
            }
            $librerias = array();
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $includes .= $this->incluir("../../librerias_saia.php", "librerias");

            $includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
            // $includes .= $this->incluir("../../js/cmxforms.js", "javascript");
            if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
                $includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
            }
            if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
                $includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
            }
            $arboles = 0;
            $spinner = 0;
            $dependientes = 0;
            $mascaras = 0;
            $textareas = 0;
            $autocompletar = 0;
            $checkboxes = 0;
            $fecha = 0;
            $hora = 0;
            $archivo = 0;
            $lista_enmascarados = "";
            $indice_tabindex = 1;
            $listado_campos = array();
            $unico = array();
            $campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $this->idformato, "orden ASC", $conn);

            $fun_campos = array();
            for ($h = 0; $h < $campos["numcampos"]; $h++) {
                if ($campos[$h]["etiqueta_html"] == "arbol")
                    $arboles = 1;
                elseif ($campos[$h]["etiqueta_html"] == "textarea")
                    $textareas = 1;
                if ($campos[$h]["obligatoriedad"])
                    $obliga = "*";
                else
                    $obliga = "";

                $tabindex = " tabindex='$indice_tabindex' ";
                if ($campos[$h]["autoguardado"])
                    $autoguardado[] = $campos[$h]["nombre"];
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
                    $adicionales .= " " . $caracteristicas[$c]["tipo_caracteristica"] . "='" . $caracteristicas[$c]["valor"] . "' ";
                }
                // obligatoriedad
                $class = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica='class' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);

                if ($campos[$h]["obligatoriedad"]) {
                    if ($class["numcampos"])
                        $adicionales .= " class=\"required " . $class[0][0] . "\" ";
                    else
                        $adicionales .= " class=\"required\" ";
                } elseif ($class["numcampos"])
                    $adicionales .= " class=\"" . $class[0][0] . "\" ";
                // atributos adicionales
                $otros = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica='adicionales' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
                if ($otros["numcampos"])
                    $adicionales .= $otros[0]["valor"];

                // ***************************************************
                if ($campos[$h]["banderas"] != "") {
                    $bandera_unico = strpos("u", $campos[$h]["banderas"]);
                    if ($bandera_unico !== false) {
                        array_push($unico, array(
                            $campos[$h]["nombre"],
                            $campos[$h]["idcampos_formato"]
                        ));
                        $obligatorio = 'obligatorio="obligatorio"';
                        $obliga = "(*)";
                    }
                }
                if (strpos($campos[$h]["valor"], "*}") > 0) {
                    $nombre_func = str_replace("{*", "", $campos[$h]["valor"]);
                    $nombre_func = str_replace("*}", "", $nombre_func);
                    $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '"><td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                    $parametros = $this->idformato . "," . $campos[$h]["idcampos_formato"];
                    $texto .= $this->arma_funcion($nombre_func, $parametros, $accion) . "</tr>";
                    array_push($fun_campos, $nombre_func);
                } else {
                    if ($accion == 'adicionar')
                        $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
                    elseif ($accion == "editar") {
                        $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                    }
                    switch ($campos[$h]["etiqueta_html"]) {
                        case "etiqueta":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '" colspan="2" id="' . $campos[$h]["nombre"] . '">' . $campos[$h]["valor"] . '</td>
                    </tr>';
                            break;
                        case "password":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . $tabindex . ' type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '"></td>
                    </tr>';
                            $indice_tabindex++;
                            break;
                        case "textarea":
                            $valor = $campos[$h]["valor"];
                            $valor2 = explode("|", $campos[$h]["valor"]);
                            $nivel_barra = "";
                            if (count($valor2)) {
                                $nivel_barra = $valor2[0];
                                if (@$valor2[1] != "") {
                                    if ($accion == "adicionar" && strpos($valor2[1], "*}")) {
                                        $includes .= $this->incluir("funciones.php", "librerias");
                                        $valor = $this->arma_funcion($valor2[1], $this->idformato . ",$" . "_REQUEST['iddoc']", $accion);
                                    } else if ($accion == "adicionar" && strpos($valor2[1], "*}") === false) {
                                        $valor = $valor2[1];
                                    }
                                } else {
                                    $valor = "";
                                }
                            }
                            if ($accion == "editar") {
                                $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                            } else if ($valor == "") {
                                $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
                            }
                            if ($nivel_barra == "") {
                                $nivel_barra = "basico";
                            }
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td class="celda_transparente"><textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" cols="53" rows="3" class="tiny_' . $nivel_barra;
                            if ($campos[$h]["obligatoriedad"]) {
                                $texto .= ' required';
                            }
                            $texto .= '">' . $valor . '</textarea></td></tr>';
                            $textareas++;
                            $indice_tabindex++;
                            break;
                        case "fecha":
                            // si la fecha es obligatoria, que valide que no se vaya con solo ceros
                            if (strtoupper($campos[$h]["tipo_dato"]) == "DATE") {
                                $adicionales = str_replace("required", "required dateISO", $adicionales);

                                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                       <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input ' . $tabindex . ' type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" tipo="fecha" value="';
                                if ($accion == "adicionar") {
                                    if ($campos[$h]["predeterminado"] == "now()")
                                        $texto .= '<?php echo(date("Y-m-d")); ?' . '>';
                                    else
                                        $texto .= '<?php echo(date("0000-00-00")); ?' . '>';
                                } else
                                    $texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
                                $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?' . '></span></font>';

                                $fecha++;
                                $indice_tabindex++;
                            } else if (strtoupper($campos[$h]["tipo_dato"]) == "DATETIME") {
                                $adicionales = str_replace("required", "required dateISO", $adicionales);
                                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input ' . $tabindex . ' type="text" readonly="true" name="' . $campos[$h]["nombre"] . '" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '" value="';
                                if ($accion == "adicionar") {
                                    if ($campos[$h]["predeterminado"] == "now()")
                                        $texto .= '<?php echo(date("Y-m-d H:i")); ?' . '>';
                                    else
                                        $texto .= '<?php echo(date("0000-00-00 00:00")); ?' . '>';
                                } else
                                    $texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
                                $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font>';
                                $fecha++;
                                $indice_tabindex++;
                            } else if (strtoupper($campos[$h]["tipo_dato"]) == "TIME") {
                                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input ' . $tabindex . ' type="text"  name="' . $campos[$h]["nombre"] . '" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '" value="';
                                if ($accion == "adicionar") {
                                    $texto .= '"></span></font>';
                                } else {
                                    $texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . '>"></span></font>';
                                }
                                if ($accion == "adicionar") {
                                    $texto .= '<script type="text/javascript">
                      $(function(){
                        var now = new Date();
                        var h=(now.getHours());
                        var m=now.getMinutes();
                        var s=now.getSeconds();

                        $(' . "'#" . $campos[$h]["nombre"] . "'" . ').clock({displayFormat:' . "'24'" . ',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script>';
                                } elseif ($accion == "editar") {
                                    $texto .= '<script type="text/javascript">
                      $(function(){
                        var now = $(' . "'#" . $campos[$h]["nombre"] . "'" . ').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $(' . "'#" . $campos[$h]["nombre"] . "'" . ').clock({displayFormat:' . "'24'" . ',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script>';
                                }

                                $hora++;
                                $indice_tabindex++;
                            } else
                                alerta_formatos("No esta definido su formato de Fecha");
                            $texto .= '</td>';

                            break;
                        case "radio" :
						/* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
						$texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '" >
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';

                            $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
                            break;
                        case "link":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                            if (strpos($adicionales, "class") !== false)
                                $adicionales = str_replace("required", "required url", $adicionales);
                            else
                                $adicionales .= " class='url' ";
                            $texto .= '<td bgcolor="#F5F5F5"><textarea cols="40" rows="3" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" ' . $adicionales . '>';
                            if ($accion == "editar") {
                                $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                            } else if ($valor == "")
                                $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
                            $texto .= $valor . '</textarea></td></tr>';
                            break;
                        case "checkbox":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                            $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
                            $checkboxes++;
                            break;
                        case "select":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                            $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
                            break;
                        case "dependientes" :
						/*parametros:
						 nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
						 (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)*/
						$parametros = explode("|", $campos[$h]["valor"]);
                            if (count($parametros) < 2)
                                alerta_formatos("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"]);
                            else {
                                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                                $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
                                $dependientes++;
                            }
                            break;
                        case "archivo":
                            $multiple = 'unico';
                            if ($campos[$h]["valor"] != '') {
                                $mystring = $campos[$h]["valor"];
                                $findme = '@';
                                $pos = strpos($mystring, $findme);
                                if ($pos !== false) { // fue encontrada
                                    $vector_extensiones_tipo = explode($findme, $mystring);
                                    $multiple = $vector_extensiones_tipo[1];
                                    $extensiones_fijas = $vector_extensiones_tipo[0];
                                }
                            }
                            $funcion_adicional_archivo = '';
                            // $ul_adicional_archivo='';

                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td class="celda_transparente">' . $funcion_adicional_archivo;

                            if ($extensiones_fijas != "") {
                                $new_ext = array_map('trim', explode('|', $extensiones_fijas));
                                $extensiones_fijas = "." . implode(', .', $new_ext);
                                $extensiones = $extensiones_fijas;
                            } else {
                                $extensiones = '<?php echo $extensiones;?' . '>';
                            }
                            if ($accion == "adicionar") {
                                // $campos[$h]["idcampos_formato"]
                                $idelemento = "dz_campo_{$campos[$h]["idcampos_formato"]}";
                                $texto .= '<div id="' . $idelemento . '" class="saia_dz" data-nombre-campo="' . $campos[$h]["nombre"] . '" data-idformato="' . $this->idformato . '" data-idcampo-formato="' . $campos[$h]["idcampos_formato"] . '" data-extensiones="' . $extensiones . '" data-multiple="' . $multiple . '">';
                                $texto .= '<div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div>';
                                if ($campos[$h]["obligatoriedad"]) {
                                    $texto .= '<input type="hidden" class="required" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" value="">';
                                }
                                $texto .= '</div>';
                                // $texto.=$ul_adicional_archivo;
                            }
                            if ($accion == "editar") {

                                /* SE DEBEN LISTAR TODOS LOS ANEXOS Y PERMITIR BORRARLOS CON UN AGREGA BOTON */
                                $texto .= '<?php echo \'<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key=\'.$_REQUEST["iddoc"].\'&idformato=' . $campos[$h]["formato_idformato"] . '&idcampo=' . $campos[$h]["idcampos_formato"] . '" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \\\'iframe\\\', outlineType: \\\'rounded-white\\\', wrapperClassName: \\\'highslide-wrapper drag-header\\\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>\'; ?' . '>';
                            }
                            $texto .= '</td></tr>';
                            $indice_tabindex++;
                            $archivo++;
                            break;
                        case "tarea":
                            // parametros:id de la tarea
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input type="hidden" name="tarea_' . $campos[$h]["nombre"] . '" value="' . $campos[$h]["valor"] . '"><input type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="';
                            if ($accion == "adicionar") {
                                if ($campos[$h]["predeterminado"] == "now()")
                                    $texto .= '<?php echo(date("Y-m-d H:i")); ?' . '>';
                                else
                                    $texto .= '<?php echo(date("0000-00-00 00:00")); ?' . '>';
                            } else
                                $texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
                            $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formato","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font></td>';
                            $fecha++;
                            $mascaras++;
                            $lista_enmascarados .= "
                  $('#" . $campos[$h]["nombre"] . "').mask('9999-99-99 99:99',{
                      completed:function(){
                        $.ajax({
                          type:'POST',
                          url:'../librerias/validar_fecha.php',
                          data:'formato=%Y-%m-%d %H:%s:00&valor='+this.val()+':00',
                          success: function(datos,exito){
                            if(datos==0){
                              alert('Fecha no valida');
                              this.focus();
                            }
                          }
                        });
                      }
                    });";
                            break;
                        case "hidden":
                            $texto .= '<input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '">';
                            break;
                        case "autocompletar" :
						/* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
						 ej: nombres,apellidos;idfuncionario;funcionario
						 */
                        $parametros = json_decode($campos[$h]['valor']);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                die("Autocompletar: El campo valor debe ser una cadena json");
                            }
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5">';
                            if ($campos[$h]["obligatoriedad"] == 1) {
                                $obligatorio = "required";
                            }

                            $adicional = "";
                            if ($accion == "editar") {
                                $adicional = " data-data='<?php echo(mostrar_autocompletar('{$campos[$h]["nombre"]}', $this->idformato, $" . "_REQUEST['iddoc'])); ? >'";
                            }
                            $texto .= '<input type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value=""' . $adicional . $obligatorio . '></td>';
                            $texto .= $this->crea_campo_autocompletar($campos[$h]["nombre"], $parametros);
                            $autocompletar++;
                            break;
                        case "etiqueta":
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5"><label>' . $valor . '</label><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '"></td>
                  </tr>';
                            break;
                        case "ejecutor":
                            if ($accion == "editar") {
                                $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                            } else
                                $valor = $campos[$h]["predeterminado"];

                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="' . $valor . '"><?php componente_ejecutor("' . $campos[$h]["idcampos_formato"] . '",@$_REQUEST["iddoc"]); ?' . '>';
                            $texto .= '</td>
                  </tr>';
                            break;

                        case "arbol" :
						/*En campos valor se deben almacenar los siguientes datos: ../../test.php;1;0;1;1;0;0
						 arreglo[0] ruta de el xml
						 arreglo[1] 1=> checkbox; 2=>radiobutton
						 arreglo[2] Modo calcular numero de nodos hijo
						 arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
						 arreglo[4] Busqueda
						 arreglo[5] Almacenar 0=>iddato 1=>valordato
						 arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias 3=>Otro (se debe sacar el dato) 4=>Sale de la tabla enviada a test_serie.php?tabla=nombre_tabla,5 => rol
						 */
						$arreglo = explode(";", $campos[$h]["valor"]);
                            if (isset($arreglo) && $arreglo[0] != "") {
                                $ruta = "\"" . $arreglo[0] . "\"";
                            } else {
                                $ruta = "\"../../test.php?rol=1&sin_padre=1\"";
                                $arreglo[1] = 2;
                                $arreglo[3] = 1;
                                $arreglo[4] = 1;
                                $arreglo[5] = 0;
                                $arreglo[6] = 5;
                            }
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
								<td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
                            $texto .= '<td bgcolor="#F5F5F5">';
                            $texto .= '<div id="seleccionados">' . $this->arma_funcion("mostrar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",'" . $arreglo[6] . "'", "mostrar") . '</div><br/>';
                            if ($arreglo[4]) {
                                $texto .= 'Buscar: <input ' . $tabindex . ' type="text" id="stext_' . $campos[$h]["nombre"] . '" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/>';
                                $indice_tabindex++;
                            }

                            $texto .= '<input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '"  ';
                            if ($accion == "editar") {
                                $texto .= ' value="' . $this->arma_funcion("cargar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . '" >';
                            } else {
                                $texto .= ' value="" ><label style="display:none" class="error" for="' . $campos[$h]["nombre"] . '">Campo obligatorio.</label>';
                            }

                            $texto .= '<div id="esperando_' . $campos[$h]["nombre"] . '">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_' . $campos[$h]["nombre"] . '" height="90%"></div>';

                            $texto .= '<script type="text/javascript">
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
                            } else {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.setXMLAutoLoading(' . $ruta . ');';
                            }
                            if ($accion == "editar") {
                                $ruta .= ",checkear_arbol";
                            }
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.loadXML(' . $ruta . ');';
                            if ($arreglo[1] == 1) {
                                $texto .= '
									tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');

									function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId){
										valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");
										destinos=tree_' . $campos[$h]["nombre"] . '.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_' . $campos[$h]["nombre"] . '.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}';
                            } elseif ($arreglo[1] == 2) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');
									function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId) {
										valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");
										if(tree_' . $campos[$h]["nombre"] . '.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_' . $campos[$h]["nombre"] . '.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}';
                            }

                            $texto .= "function fin_cargando_" . $campos[$h]["nombre"] . "() {
									if (browserType == \"gecko\" ) {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
									} else if (browserType == \"ie\") {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
									} else {
										document.poppedLayer = eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
									}
									document.poppedLayer.style.display = \"none\";
								}

								function cargando_" . $campos[$h]["nombre"] . "() {
									if (browserType == \"gecko\" ) {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
									} else if (browserType == \"ie\") {
										document.poppedLayer = eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
									} else {
										document.poppedLayer = eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
									}
									document.poppedLayer.style.display = \"\";
								}";

                            if ($accion == "editar") {
                                $texto .= "function checkear_arbol(){
										vector2=\"" . $this->arma_funcion("cargar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . "\";
										vector2=vector2.split(\",\");
										for(m=0;m<vector2.length;m++) {
											tree_" . $campos[$h]["nombre"] . ".setCheck(vector2[m],true);
										}
									}\n";
                            }
                            $texto .= '</script></td></tr>';
                            $arboles++;
                            break;
                        case "item":
                            break;
                        case "detalle":
                            if ($formato[0]["item"]) {
                                $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
                                if ($padre["numcampos"]) {
                                    $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden"  name="idpadre" ' . $obligatorio . ' value="<?php echo $_REQUEST["idpadre"]; ?' . '>">' . '<?php } ?' . '>';
                                } else
                                    $texto .= '<?php listar_select_padres(' . $padre[0]["nombre_tabla"] . '); ?' . '>';
                            } else {
                                $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
                                if ($padre["numcampos"] && $accion == "adicionar") {
                                    $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
                                    $texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
                                }
                            }
                            break;
                        case "spin":
                            $aux[] = "imageBasePath:'../../images/'";
                            if ($campos[$h]["valor"] != "") {
                                $parametros = explode("@", $campos[$h]["valor"]);
                                if (is_numeric($parametros[0])) {
                                    $aux[] = 'min:' . $parametros[0];
                                    $aux2[] = 'min="' . $parametros[0] . '"';
                                }
                                if (is_numeric($parametros[1])) {
                                    $aux[] = 'max:' . $parametros[1];
                                    $aux2[] = 'max="' . $parametros[1] . '"';
                                }
                                if (is_numeric($parametros[2]))
                                    $aux[] = 'interval:' . $parametros[2];
                                if (is_numeric($parametros[3]) && $parametros[3])
                                    $aux[] = 'lock:true';
                            }
                            if (is_array($aux2))
                                $adicionales .= implode(" ", $aux2);
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . " $adicionales $tabindex" . ' type="input" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#' . $campos[$h]["nombre"] . '").spin({';
                            if (is_array($aux))
                                $texto .= implode(",", $aux);
                            $texto .= '});
              });
              </script>';
                            $indice_tabindex++;
                            $spinner++;
                            break;
                        default: // text
                            $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . " $adicionales $tabindex" . ' type="text" size="100" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '"></td>
                    </tr>';
                            if ($campos[$h]["mascara"] != "") {
                                $mascaras++;
                                $lista_enmascarados .= "$('#" . $campos[$h]["nombre"] . "').mask('" . $campos[$h]["mascara"] . "');";
                            }
                            $indice_tabindex++;
                            break;
                    }
                }
                array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
            }
            // ******************************************************************************************
            if ($formato[0]["item"] && $accion == "adicionar") {
                $texto .= '<tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</td></tr>';
            }
            $wheref = "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $this->idformato . " AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";
            if (count($listado_campos)) {
                $wheref .= "AND nombre_funcion NOT IN(" . implode(",", $listado_campos) . ")";
            }

            $funciones = busca_filtro_tabla("A.*,B.funciones_formato_fk", "funciones_formato A, funciones_formato_enlace B", $wheref, " A.idfunciones_formato asc", $conn);
            for ($i = 0; $i < $funciones["numcampos"]; $i++) {
                $ruta_orig = "";
                $form_origen = busca_filtro_tabla("formato_idformato", "funciones_formato_enlace", "funciones_formato_fk=" . $funciones[$i]["funciones_formato_fk"], "idfunciones_formato_enlace asc", $conn);
                if ($form_origen["numcampos"]) {
                    $formato_orig = $form_origen[0]["formato_idformato"];
                }

                if ($formato_orig != $this->idformato && $funciones[$i]["ruta"] == "funciones.php") { // busco el nombre del formato inicial
                    $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                    if ($dato_formato_orig["numcampos"]) {
                        // si el archivo existe dentro de la carpeta del archivo inicial
                        if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                        } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                            $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                        } else { // si no existe en ninguna de las dos
                                 // trato de crearlo dentro de la carpeta del formato actual
                            if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                            } else {
                                alerta_formatos("No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                            }
                        }
                    }
                } else {
                    if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                                                                 // Modificacion realizada el 28-02-2009 porque buscaba la ruta en la raiz pero debia buscarla en la raiz del propio formato se quita el ../
                        $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
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
                            alerta_formatos("1863 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
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
                $texto .= '<input type="hidden" name="formato" value="' . $this->idformato . '">';
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
            $texto .= "<tr><td colspan='2'>" . $this->arma_funcion("submit_formato", $this->idformato, $accion);
            $texto .= '</td></tr></table>';

            $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
            $includes .= $this->incluir_libreria("funciones_acciones.php", "librerias");
            $includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
            if ($archivo) {
                $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
                $id_unico = '<?php echo (uniqid("' . $idformato . '-") . "-" . uniqid());?>';
                $texto .= "<input type='hidden' name='form_uuid'       id='form_uuid'       value='$id_unico'>";
            }
            $texto .= '</form></body>';
            if ($textareas) {
                $includes .= $this->incluir_libreria("header_formato.php", "librerias");
            }
            if ($fecha) {
                $includes .= $this->incluir("../../calendario/calendario.php", "librerias");
            }

            $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
            $includes .= "<?php echo(librerias_validar_formulario()); ?>";

            $includes .= $this->incluir("../../js/title2note.js", "javascript");
            if ($arboles) {
                $includes .= $this->incluir("../../js/dhtmlXCommon.js", "javascript");
                $includes .= $this->incluir("../../js/dhtmlXTree.js", "javascript");
                $includes .= $this->incluir_libreria("header_formato.php", "librerias");
                $includes .= '<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">';
            }
            if ($autocompletar) {
                $includes .= $this->incluir("../../css/selectize.css", "estilos");
                // $includes .= $this->incluir("../../js/jquery-1.7.2.js", "javascript");
                $includes .= $this->incluir("../../js/selectize.js", "javascript");
                // $includes .= incluir("../librerias/autocompletar.js", "javascript");
            }
            if ($dependientes > 0) {
                $includes .= $this->incluir("../librerias/dependientes.js", "javascript");
            }

            if ($hora) {
                $includes .= $this->incluir("../../js/jquery.clock.js", "javascript");
            }
            $numero_unicos = count($unico);
            if ($numero_unicos) {
                $listado = array();
                $enmascarar .= '<script type="text/javascript">
				$(document).ready(function() {';
                for ($k; $k < $numero_unicos; $k++) {
                    $enmascarar .= "$('#" . $unico[0][0] . "').blur(function(){
							$.ajax({url: '../librerias/validar_unico.php',
								type:'POST',
								data:'nombre=unico&valor='+$('#" . $unico[0][0] . "').val()+'&tabla=" . $formato[0]["nombre_tabla"] . "&iddoc=<" . "?php echo $" . "_REQUEST[\"iddoc\"]; ?" . ">',
								success: function(datos){
									if(datos==0){
										alert('El campo " . $unico[0][0] . " debe Ser unico');
										$('#" . $unico[0][0] . "').val('');
										$('#" . $unico[0][0] . "').focus();
									}
								}
							});
						});";
                }
                $enmascarar .= '});
			</script>';
            }

            if ($spinner)
                $includes .= $this->incluir("../../js/jquery.spin.js", "javascript");
            if ($mascaras) {
                $includes .= $this->incluir("../../js/jquery.maskedinput.js", "javascript");
                $enmascarar .= '
      <script type="text/javascript">
      jQuery.noConflict();(function($) {
        $(function() {' . $lista_enmascarados . '});
       })(jQuery);
      </script>';
            }
            if ($formato[0]["enter2tab"]) {
                $codigo_enter2tab = "<script>$(document).ready(function()
      {/* Para que el enter se comporte como tabulador    */
        tb = $('input');
        if ($.browser.mozilla)
           $(tb).keypress(enter2tab);
        else
           $(tb).keydown(enter2tab);
      });

      function enter2tab(e)
      {
        if (e.keyCode == 13)
        {
          cb = parseInt($(this).attr('tabindex'));
          if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null)
            {
              $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
              $(':input[tabindex=\'' + (cb + 1) + '\']').select();
              e.preventDefault();
              return false;
            }
        }
      }</script>";
            }
            if (count($autoguardado) > 0 && $accion == "adicionar") {
                $texto .= '
      <script type="text/javascript">
      setInterval("auto_save(' . "'" . implode(",", $autoguardado) . "'" . ',' . "'" . $formato[0]["nombre"] . "'" . ')",' . $formato[0]["tiempo_autoguardado"] . ');
      </script>';
            }

            $js_archivos = "";
            if ($archivo) {
                // $includes .= $this->incluir("../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js", "javascript");
                $includes .= $this->incluir("../../dropzone/dist/dropzone.js", "javascript");
                $includes .= $this->incluir("../../anexosdigitales/funciones_archivo.php", "librerias");
                $includes .= $this->incluir("../../anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js", "javascript");
                $includes .= '<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style>';
                $includes .= '<link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" />';
                $includes .= "<script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-5.0.0/highslide/graphics/'; hs.outlineType = 'rounded-white';</script>";
                $js_archivos = "<script type='text/javascript'>
                var upload_url = '../../dropzone/cargar_archivos_formato.php';
                var mensaje = 'Arrastre aquí los archivos';
                Dropzone.autoDiscover = false;
                var lista_archivos = new Object();
                $(document).ready(function () {
                    Dropzone.autoDiscover = false;
                    $('.saia_dz').each(function () {
                        var idformato = $(this).attr('data-idformato');
                    	var idcampo = $(this).attr('id');
                    	var paramName = $(this).attr('data-nombre-campo');
                    	var idcampoFormato = $(this).attr('data-idcampo-formato');
                    	var extensiones = $(this).attr('data-extensiones');
                    	var multiple_text = $(this).attr('data-multiple');
                    	var multiple = false;
                    	var form_uuid = $('#form_uuid').val();
                    	var maxFiles = 1;
                    	if(multiple_text == 'multiple') {
                    		multiple = true;
                    		maxFiles = 10;
                    	}
                        var opciones = {
                        	ignoreHiddenFiles : true,
                        	maxFiles : maxFiles,
                        	acceptedFiles: extensiones,
                       		addRemoveLinks: true,
                       		dictRemoveFile: 'Quitar anexo',
                       		dictMaxFilesExceeded : 'No puede subir mas archivos',
                       		dictResponseError : 'El servidor respondió con código {{statusCode}}',
                    		uploadMultiple: multiple,
                        	url: upload_url,
                        	paramName : paramName,
                        	params : {
                            	idformato : idformato,
                            	idcampo_formato : idcampoFormato,
                            	nombre_campo : paramName,
                            	uuid : form_uuid
                            },
                                removedfile : function(file) {
                                    if(lista_archivos && lista_archivos[file.upload.uuid]) {
                                    	$.ajax({
                                    		url: upload_url,
                                    		type: 'POST',
                                    		data: {
                                        		accion:'eliminar_temporal',
                                            	idformato : idformato,
                                            	idcampo_formato : idcampoFormato,
                                        		archivo: lista_archivos[file.upload.uuid]}
                                    		});
                                    }
                                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                                        file.previewElement.parentNode.removeChild(file.previewElement);
                                    	delete lista_archivos[file.upload.uuid];
                                    	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    }
                                    return this._updateMaxFilesReachedClass();
                                },
                                success : function(file, response) {
                                	for (var key in response) {
                                    	if(Array.isArray(response[key])) {
                                        	for(var i=0; i < response[key].length; i++) {
                                        		archivo=response[key][i];
                                            	if(archivo.original_name == file.upload.filename) {
                                            		lista_archivos[file.upload.uuid] = archivo.id;
                                            	}
                                        	}
                                    	} else {
                                    		if(response[key].original_name == file.upload.filename) {
                                        		lista_archivos[file.upload.uuid] = response[key].id;
                                    		}
                                    	}
                                	}
                                	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                                        $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                                    }
                                }
                        };
                        $(this).dropzone(opciones);
                        $(this).addClass('dropzone');
                    });
                });</script>";
            }
            $includes .= "<style>label.error{color:red}</style>";

            $contenido = "<html><title>.:" . $this->codifica($accion . " " . $formato[0]["etiqueta"]) . ":.</title>
			<head>" . $includes . "
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script>" . $enmascarar . " $codigo_enter2tab
			</head>
			" . $texto . $js_archivos . "
		</html>";
            if ($accion == "editar") {
                $contenido .= '<?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?' . '>';
            }

            $mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_" . $accion], $contenido);
            if ($mostrar !== false) {
                notificaciones("Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar), "success", 2000);
                $this->exito = 1;
                $this->mensaje = "Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar);
                return (true);
            } else {
                notificaciones("Error al crear el archivo " . dirname($mostrar), "error", 5000);
                $this->exito = 0;
                $this->mensaje = "Error al crear el archivo " . dirname($mostrar);
                return (false);
            }
        } else {
            $this->exito = 0;
            $this->mensaje = "Formato No encontrado";
            notificaciones("Formato NO encontrado ", "error", 5000);
            return (false);
        }
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
    public function crear_formato_buscar($idformato, $accion) {
        global $conn;
        $datos_detalles["numcampos"] = 0;
        $texto = '';
        $includes = "";
        $obligatorio = "";
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $idformato, "", $conn);
        if ($formato["numcampos"]) {
            $action = '../librerias/funciones_buscador.php';
            $texto .= '<body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="' . $action . '" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ' . $this->codifica($formato[0]["etiqueta"]) . '</td></tr>';
            $librerias = array();
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
            $includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
            $includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
            $includes .= "<?php echo(librerias_jquery('1.7')); ?>";
            if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
                $includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
            }
            if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
                $includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
            }
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
            $campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $idformato, "orden ASC", $conn);
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
                    case "radio" :
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
                    case "dependientes" :
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
                    case "autocompletar" :
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
                    case "arbol" :
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
                          <br /><br />
                ';
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
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_' . $campos[$h]["nombre"] . '.getAllSubItems(vector[i]);
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
                  vector2=\"" . $this->arma_funcion("cargar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . "\";
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
                    case "spin":
                        $aux[] = "imageBasePath:'../../images/'";
                        if ($campos[$h]["valor"] != "") {
                            $parametros = explode("@", $campos[$h]["valor"]);
                            if (is_numeric($parametros[0])) {
                                $aux[] = 'min:' . $parametros[0];
                                $aux2[] = 'min="' . $parametros[0] . '"';
                            }
                            if (is_numeric($parametros[1])) {
                                $aux[] = 'max:' . $parametros[1];
                                $aux2[] = 'max="' . $parametros[1] . '"';
                            }
                            if (is_numeric($parametros[2]))
                                $aux[] = 'interval:' . $parametros[2];
                            if (is_numeric($parametros[3]) && $parametros[3])
                                $aux[] = 'lock:true';
                        }
                        if (is_array($aux2))
                            $adicionales .= implode(" ", $aux2);
                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . " $adicionales $tabindex" . ' type="input" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#' . $campos[$h]["nombre"] . '").spin({';
                        if (is_array($aux))
                            $texto .= implode(",", $aux);
                        $texto .= '});
              });
              </script>';
                        $indice_tabindex++;
                        $spinner++;
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
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion("arbol", $campos[$h]["nombre"]) . '
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
            }
            array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
        }
        // die();
        // ******************************************************************************************
        $wheref = "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $idformato . " AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";

        $funciones = busca_filtro_tabla("A.*,B.formato_idformato", "funciones_formato A, funciones_formato_enlace B", $wheref, " A.idfunciones_formato asc", $conn);
        for ($i = 0; $i < $funciones["numcampos"]; $i++) {
            $ruta_orig = "";
            // saco el primer formato de la lista de la funcion (formato inicial)
            $formato_orig = $funciones[0]["formato_idformato"];
            // si el formato actual es distinto del formato inicial
            if ($formato_orig != $idformato) { // busco el nombre del formato inicial
                $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                if ($dato_formato_orig["numcampos"]) {
                    // si el archivo existe dentro de la carpeta del archivo inicial
                    if (is_file($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                    } else { // si no existe en ninguna de las dos
                             // trato de crearlo dentro de la carpeta del formato actual
                        if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                        } else
                            alerta_formatos("No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                    }
                }
            } else { // $ruta_orig=$formato[0]["nombre"];
                     // si el archivo existe dentro de la carpeta del formato actual
                if (is_file($formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                    $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                    $includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
                } else { // si no existe en ninguna de las dos
                         // trato de crearlo dentro de la carpeta del formato actual
                    if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
                    } else {
                        alerta_formatos("No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                    }
                }
            }
            if (!in_array($funciones[$i]["nombre_funcion"], $fun_campos)) {
                $parametros = "$idformato,NULL";
                $texto .= $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, $accion);
            }
        }
        // ******************************************************************************************
        $campo_descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $idformato . " AND acciones LIKE '%p%'", "", $conn);
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
            $this->exito = 1;
            $this->mensaje = "Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar);
            return (true);
        }
    }

    /*
     * <Clase>
     * <Nombre>generar_condicion</Nombre>
     * <Parametros>$nombre:nombre del campo</Parametros>
     * <Responsabilidades>Crea un select para que se pueda elegir si la condici�n sobre el campo especificado es de obligatorio cumplimiento en la busqueda o no<Responsabilidades>
     * <Notas>usado para la pantalla de busqueda del formato</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function generar_condicion($nombre) {
        $texto = '<td class="encabezado">&nbsp;';
        $texto .= '<select name="condicion_' . $nombre . '" id="condicion_' . $nombre . '">';
        $texto .= '<option value="AND">Y</option>';
        $texto .= '<option value="OR">O</option>';
        $texto .= "</td>";
        return ($texto);
    }

    /*
     * <Clase>
     * <Nombre>generar_comparacion</Nombre>
     * <Parametros>$tipo:tipo de campo sobre el que se va a hacer la comparacion;$nombre:nombre del campo</Parametros>
     * <Responsabilidades>genera un listado con las opciones de comparaci�n posibles seg�n el tipo de campo<Responsabilidades>
     * <Notas>usado para la pantalla de busqueda del formato</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    public function generar_comparacion($tipo, $nombre) {
        $listado_like = array(
            "Similar" => "LIKE|%|%",
            "Inicia Con" => "LIKE|%|@",
            "Finaliza Con" => "LIKE|@|%"
        );
        $listado_compara = array(
            "Igual" => "=|@|@",
            "Menor" => "-|@|@",
            "Mayor" => "+|@|@",
            "Diferente" => "!|@|@"
        );
        $listado_arbol = array(
            "Alguno" => "or",
            "Todos" => "and"
        );
        echo $tipo . " " . $nombre . "<br />";
        $texto = '<td class="encabezado">&nbsp;';
        $listado = array();
        switch ($tipo) {
            case "INT":
                $listado = $listado_compara;
                break;
            case "arbol":
                $listado = $listado_arbol;
                break;
            default:
                $listado = $listado_like;
                break;
        }
        if (count($listado)) {
            $texto .= '<select name="compara_' . $nombre . '" id="compara_' . $nombre . '"> ';
            foreach ($listado as $llave => $valor) {

                $texto .= '<option value="' . $valor . '">' . $llave . '</option>';
            }
            $texto .= '</select>';
        }
        $texto .= '</td>';
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
                $texto2 = '"); ? >';
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
            $pos = array_search($texto1 . $lib[$j] . $texto2, $this->incluidos);
            if ($pos === false) {
                if (!is_file($lib[$j]) & $eval) {
                    if (crear_archivo($lib[$j])) {
                        $includes .= $texto1 . $lib[$j] . $texto2;
                    } else {
                        alerta_formatos("Problemas al generar el Formato en " . $lib[$j]);
                        return ("");
                    }
                } else {
                    $includes .= $texto1 . $lib[$j] . $texto2;
                }
                array_push($this->incluidos, $texto1 . $lib[$j] . $texto2);
            }
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
     * <Parametros>$nombre:nombre de la funci�n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
     * <Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funci�n especificada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function arma_funcion($nombre, $parametros, $accion) {
        if ($parametros != "" && $accion != "adicionar" && $accion != 'buscar')
            $parametros .= ",";
        if ($accion == "mostrar")
            $texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
        elseif ($accion == "adicionar")
            $texto = "<?php " . $nombre . "(" . $parametros . ");? >";
        elseif ($accion == "editar")
            $texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
        elseif ($accion == "buscar")
            $texto = "<?php " . $nombre . "(" . $parametros . ",'',1);? >";

        return ($texto);
    }

    /*
     * <Clase>
     * <Nombre>generar_formato</Nombre>
     * <Parametros>$idformato:id del formato</Parametros>
     * <Responsabilidades>Verifica que las funciones y campos usados en el formato se encuentren todos previamente definidos y configurados<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
    private function generar_formato() {
        global $conn, $ruta_db_superior;
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);

        $data = "adicionar_" . $formato[0]['nombre'] . ".php
	editar_" . $formato[0]['nombre'] . ".php
	buscar_" . $formato[0]['nombre'] . ".php
	buscar_" . $formato[0]['nombre'] . "2.php
	mostrar_" . $formato[0]['nombre'] . ".php
	detalles_mostrar_" . $formato[0]['nombre'] . ".php";
        if (intval($formato[0]["pertenece_nucleo"]) == 0) {
            $data = "*";
        }
        $fp = fopen($ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", 'w+');
        fwrite($fp, $data);
        fclose($fp);
        chmod($ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", PERMISOS_ARCHIVOS);
        $pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["pie_pagina"] . "'", "", $conn);
        $lcampos = "";
        $regs = array();
        $regs1 = array();

        if ($formato["numcampos"]) {
            $texto = $formato[0]["cuerpo"];
            if ($encabezado["numcampos"]) {
                $texto .= $encabezado[0][0];
            }
            if ($pie["numcampos"]) {
                $texto .= $pie[0][0];
            }

            $texto = str_replace("listado_detalles_", "id", $texto);
            $resultado = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*)+\*})', $texto, $regs);
            $campos = array_unique($regs[0]);
            sort($campos);
            $campos_editar = array();
            $campos_edit = array();
            $campos_adicionar = array();
            $campos_otrosf = array();

            if ($campos) {
                /* Busco el listado de las funciones para compararlas con los campos que se van a ingresar */
                $listado = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $this->idformato, "", $conn);
                for ($i = 0; $i < $listado["numcampos"]; $i++) {
                    array_push($campos_edit, "{*" . $listado[$i]["nombre"] . "*}");
                }
                $funciones = array_diff($campos, $campos_edit);
                sort($funciones);
                $lcampos = busca_filtro_tabla("A.*", "funciones_formato A", "A.nombre IN('" . implode("','", $funciones) . "')", "idfunciones_formato", $conn);
                for ($i = 0; $i < $lcampos["numcampos"]; $i++) {

                    array_push($campos_editar, $lcampos[$i]["idfunciones_formato"]);
                    $formatos_func = busca_filtro_tabla("formato_idformato", "funciones_formato_enlace", "funciones_formato_fk=" . $lcampos[$i]["idfunciones_formato"] . " AND formato_idformato=" . $this->idformato, "", $conn);

                    if (!$formatos_func["numcampos"]) {
                        array_push($campos_otrosf, $lcampos[$i]["idfunciones_formato"]);
                        $sqlf = "INSERT INTO funciones_formato_enlace(funciones_formato_fk,formato_idformato) VALUES(" . $lcampos[$i]["idfunciones_formato"] . "," . $this->idformato . ")";
                        guardar_traza($sqlf, $formato[0]["nombre_tabla"]);
                        phpmkr_query($sqlf);
                    }
                    array_push($campos_edit, $lcampos[$i]["nombre"]);
                }
                $campos_adicionar = array_diff($campos, $campos_edit);
                $campos_adicionar = array_unique($campos_adicionar);
            } else {
                notificaciones("El formato mostrar no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Formato y Luego Editelo");
            }
        }
        $tadd = "";
        $ted = "";
        $tod = "";
        $tadd .= implode(",", $campos_adicionar);
        $ted .= implode(",", $campos_editar);
        $tod .= implode(",", $campos_otrosf);
        if ($campos_otrosf != "") {
            notificaciones("Existen otros Formatos Vinculados");
        }
        $adicionales = "";
        if (@$_REQUEST["pantalla"] == "tiny") {
            $adicionales = "&pantalla=tiny";
        }
        $redireccion = "formatoview.php?idformato=" . $this->idformato . $adicionales;
        if (usuario_actual('login') == 'cerok') {
            $redireccion = "funciones_formatoadd.php?adicionar=" . $tadd . "&editar=" . $ted . "&idformato=" . $this->idformato . $adicionales;
        }
        return $redireccion;
    }

    private function busca_funcion_test($nombre_test, $ruta) {
        global $ruta_db_superior;
        $url = explode(".php?", $ruta);

        switch ($url[0]) {
            case 'test_funcionario':
                return ("<script>

                function buscar_nodo_" . $nombre_test . "() {
                    $.ajax({
                        type : 'POST',
                        url : '../../test_funcionario_buscar.php',
                        dataType : 'json',
                        data : {
                            nombre : $('#stext_" . $nombre_test . "').val(),
                            tabla : 'dependencia'
                        },
                        success : function(data) {
                            if(data['error']){
                                alert(data['mensaje']);
}
                            else{
                                tree_" . $nombre_test . ".attachEvent('onOpenDynamicEnd', function(){
                                    tree_" . $nombre_test . ".selectItem('1#',false,false);
                                    tree_" . $nombre_test . ".clearSelection();
                                    for(var i=0;i<data['numcampos_func'];i++){
                                        tree_" . $nombre_test . ".selectItem(data['funcionarios'][i],false,true);
                                    }
                                    for(var i=0;i<data['numcampos_dep'];i++){
                                        tree_" . $nombre_test . ".selectItem(data['dependencias'][i],false,true);
                                    }
                                });
                                tree_" . $nombre_test . ".openItemsDynamic(data['datos'],true);
                            }
                        }
                    });
                }
                </script>");
                break;
        }
    }

    private function crea_campo_autocompletar($nombre, $parametros) {

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

?>
