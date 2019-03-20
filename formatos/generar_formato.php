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

include_once $ruta_db_superior . "db.php";

if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
    logear_funcionario_webservice($_REQUEST["LOGIN"]);
}

include_once $ruta_db_superior . FORMATOS_SAIA . "librerias/funciones.php";
include_once $ruta_db_superior . FORMATOS_SAIA . "generar_formato_buscar.php";
include_once $ruta_db_superior . "pantallas/documento/class_documento_elastic.php";
include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_notificaciones.php";

if (isset($_REQUEST["archivo"]) && !empty($_REQUEST["archivo"])) {
    $archivo = $ruta_db_superior . str_replace("-", "/", $_REQUEST["archivo"]);
}
if (isset($_REQUEST["crea"])) {
    $_REQUEST["genera"] = $_REQUEST["crea"];
}

if (isset($_REQUEST["genera"])) {
    $accion = $_REQUEST["genera"];
    if (isset($_REQUEST["idformato"])) {
        $idformato = $_REQUEST["idformato"];
        $generar = new GenerarFormato($idformato, $accion, $archivo);
        $redireccion = $generar->ejecutar_accion();
    } else {
        alerta("por favor seleccione un Formato a Generar");
        $redireccion = "formatolist.php";
        if ($archivo != '') {
            $redireccion = $archivo;
        }
    }
    if (isset($_REQUEST["llamado_ajax"]) && $_REQUEST["llamado_ajax"] && $accion != "buscar") {
        echo (json_encode(array(
            "exito" => $generar->exito,
            "mensaje" => $generar->mensaje
        )));
        die();
    }
    redirecciona($redireccion);
    die();
} else if (isset($_REQUEST["accion"]) && $_REQUEST["accion"] == "full" && isset($_REQUEST["idformato"])) {
    $status = [
        "exito" => 0,
        "mensaje" => ["No se pudo generar el formato"]
    ];


    ob_start();
    $acciones = [
        "formato",
        "tabla",
        "adicionar",
        "editar",
        "mostrar",
        "buscar",
        "cuerpo_formato"
    ];
    $mensajes = array();
    $idformato = $_REQUEST["idformato"];

    $exito = true;
    $cuerpo_formato = '';
    $publicar = 0;

    $camposDescripcion = GenerarFormato::validarCampoDescripcion($idformato);

    if ($camposDescripcion['publicarFormato'] == 0) {
        $status['mensaje'] = $camposDescripcion['mensaje'];
        echo json_encode($status);
        die();
    } else if ($camposDescripcion['error'] == 0) {
        $status['mensaje'] = $camposDescripcion['mensaje'];
        echo json_encode($status);
        die();
    }

    foreach ($acciones as $accion) {
        $generar = new GenerarFormato($idformato, $accion);
        $generar->ejecutar_accion();

        if (!$generar->exito) {
            $mensajes[] = "Error en la accion $accion";
            $mensajes[] = $generar->mensaje;
            $exito = false;
            break;
        } else {
            $exito = $exito && $generar->exito;
            $msg = $generar->mensaje;
            if (is_array($generar->mensaje) && isset($generar->mensaje["mensaje"])) {
                $msg = $generar->mensaje["mensaje"];
            }
            $mensajes[] = $msg;
            $cuerpo_formato = $generar->contenido_cuerpo;
            $publicar = $generar->publicar;
            if ($publicar == 0) {
                $updatePublicar = "UPDATE formato set publicar = 1 where idformato = {$idformato}";
                phpmkr_query($updatePublicar);
            }
            include_once $ruta_db_superior . "/pantallas/generador/librerias_pantalla.php";
            $idmodulo = crear_modulo_formato($idformato);

            if ($_REQUEST['permisosPerfil']) {
                $permisosFormato = permisosFormato($idformato, $_REQUEST['permisosPerfil'], $_REQUEST['nombreFormato']);
            } else {
                $permisosFormato = eliminarPermisoFormato($idformato, $_REQUEST['nombreFormato']);
            }
        }
    }
    //$mensajes = array_unique($mensajes, SORT_STRING);
    ob_get_clean();
    $status["exito"] = $exito;
    $status["mensaje"] = $mensajes;
    $status["contenido_cuerpo"] = $cuerpo_formato;
    $status["publicar"] = $publicar;
    $status["permisos"] = $permisosFormato['mensaje'];
    $status["estadoPermisos"] = $permisosFormato['exito'];

    ob_end_clean();
    echo json_encode($status);
    die();
}

class GenerarFormato
{

    private $accion;
    private $idformato;
    private $archivo;
    private $incluidos;
    public $exito;
    public $mensaje;
    public $contenido_cuerpo;
    public $publicar;

    public function __construct($idformato, $accion, $archivo = '')
    {
        $this->idformato = $idformato;
        $this->accion = $accion;
        $this->archivo = $archivo;
        $this->incluidos = array();
        $this->exito = 0;
        $this->mensaje = "Existe un error al generar el formato " . $accion . " con id " . $idformato;
        $this->contenido_cuerpo = "";
        $this->publicar = 0;
    }

    /**
     * Realiza una consulta a la DB (campos_formato)
     * retorna un array validando si existe campo descripcion en el formato
     * @param string $idformato :  id del formato
     * @return array
     * @author fredy.osorio <fredy.osorio@cerok.com>
     */
    public static function validarCampoDescripcion($idformato)
    {
        $retorno = ["publicarFormato" => 1, "mensaje" => '', "error" => 1];
        $consultaFormato = "SELECT acciones FROM campos_formato WHERE formato_idformato = {$idformato} and (acciones like 'p' or acciones like '%,p,%' or acciones like '%,p')";
        $camposFormato = StaticSql::search($consultaFormato);
        if (!$camposFormato) {
            $retorno['publicarFormato'] = 0;
            $retorno['mensaje'] = 'Debe seleccionar alguno de los campos para incluirse en la descripciÃ³n de los documentos';
        } else {
            $consultaFormato = "SELECT valor,etiqueta FROM campos_formato WHERE formato_idformato = {$idformato} and etiqueta_html ='arbol_fancytree'";
            $camposFormato = StaticSql::search($consultaFormato);
            if ($camposFormato) {
                for ($i = 0; $i < count($camposFormato); $i++) {
                    $url = json_decode($camposFormato[$i]['valor'], true);
                    if (!$url['url']) {
                        $retorno['error'] = 0;
                        $retorno['mensaje'] = "Debe seleccionar el tipo de arbol antes de continuar";
                    }
                }
            }
        }
        return $retorno;
    }


    public function ejecutar_accion()
    {
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
                $this->exito = $generar->exito;
                $this->mensaje = $generar->mensaje;

                if ($_REQUEST["llamado_ajax"]) {
                    echo (json_encode(array(
                        "exito" => $generar->exito,
                        "mensaje" => $generar->mensaje
                    )));
                }
                break;

            case "cuerpo_formato":
                $this->crear_cuerpo_formato();
                $redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
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
     * <Responsabilidades>Crear automaticamente los campos predeterminados como la serie,documento_iddocumento, la llave primaria... etc, verifica si la tabla estï¿½ creada, crea o actualiza la tabla con todos los campos como se han definido previamente<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    public function generar_tabla()
    {
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
            alerta($resp["mensaje"]);
        } else {
            alerta("No es posible Generar la tabla para el Formato");
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

    private function es_indice($campo, $tabla, $indice)
    {
        global $conn;
        $indice = ejecuta_filtro_tabla("SHOW INDEX FROM " . strtolower($tabla) . " WHERE Column_name LIKE '" . $campo . "'", $conn);
        if (!$indice["numcampos"]) {
            return (false);
        }
        return true;
    }

    /*
     * <Clase>
     * <Nombre>maximo_valor</Nombre>
     * <Parametros>$valor:valor asignado por configuraciï¿½n;$maximo:valor mï¿½ximo aceptado por el tipo de dato</Parametros>
     * <Responsabilidades>Valida si el valor que se estï¿½ asignando al tipo de dato estï¿½ en el rango permitido, si no lo estï¿½ devuelve el mï¿½ximo<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida>devuelve el nï¿½mero mï¿½ximo permitido</Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function maximo_valor($valor, $maximo)
    {
        if ($valor > $maximo || $valor == "NULL")
            return ($maximo);
        else
            return ($valor);
    }

    public function crear_formato_mostrar()
    {
        global $conn;

        $include_formato = '';
        $texto = '';
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            $contenido_detalles = '';

            if (strpos($formato[0]["banderas"], "acordeon") !== false) {
                $contenido_detalles .= '<frameset cols="410,*" >';
                $contenido_detalles .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'librerias/formato_detalles.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="no" >';
            } else {
                $contenido_detalles .= '<frameset cols="250,*" >';
                $contenido_detalles .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'arboles/arbolformato_documento.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="auto" >';
            }
            $contenido_detalles .= '<frame name="detalles" src="" border="0" marginwidth="20px" marginheight="10" scrolling="auto"></frameset>';

            if (!crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/detalles_" . $formato[0]["ruta_mostrar"], $contenido_detalles)) {
                alerta("No es posible crear el Archivo de detalles");
            }

            $archivos = 0;
            $texto .= htmlspecialchars_decode($formato[0]["cuerpo"]);
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
                                $include_formato .= $this->incluir("'../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . "'", "librerias");
                            } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                                $include_formato .= $this->incluir("'../" . $funciones[$i]["ruta"] . "'", "librerias");
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
                                    $include_formato .= $this->incluir("'../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . "'", "librerias");
                                } elseif (is_file(FORMATOS_CLIENTE . $funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                                    $include_formato .= $this->incluir("'../" . $funciones[$i]["ruta"] . "'", "librerias");
                                } else { // si no existe en ninguna de las dos
                                    // trato de crearlo dentro de la carpeta del formato actual
                                    alerta("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
                                    if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                        $include_formato .= $this->incluir("'" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . "'", "librerias");
                                    } else {
                                        alerta("No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                                    }
                                }
                            }

                            // si el archivo existe dentro de la carpeta del archivo inicial
                        }
                    }
                } else { // $ruta_orig=$formato[0]["nombre"];
                    // si el archivo existe dentro de la carpeta del formato actual
                    if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $include_formato .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $include_formato .= $this->incluir("'../../" . $funciones[$i]["ruta"] . "'", "librerias");
                    } else { // si no existe en ninguna de las dos
                        // trato de crearlo dentro de la carpeta del formato actual
                        if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $include_formato .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                        } else {
                            alerta("907 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
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

            $includes = '';
            $includes .= $this->incluir("'../../librerias_saia.php'", "librerias");
            $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
            $includes .= $this->incluir("'../../class_transferencia.php'", "librerias");
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir("'" . $formato[0]["librerias"] . "'", "librerias", 1);
            }
            $includes .= $include_formato;
            $includes .= $this->incluir_libreria("header_nuevo.php", "librerias");

            $validacion_tipo = '<?php if(!$_REQUEST["actualizar_pdf"] && (
                ($_REQUEST["tipo"] && $_REQUEST["tipo"] == 5) ||
                0 == '.$formato[0]['mostrar_pdf'].'
            )): ?>';
            $validacion_tipo.= '<!DOCTYPE html>

                        <html>
                            <head>
                                <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                                <meta charset="utf-8" />
                                <meta name="viewport"
                                    content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                <meta name="apple-mobile-web-app-capable" content="yes">
                                <meta name="apple-touch-fullscreen" content="yes">
                                <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                <meta content="" name="description" />
                                <meta content="" name="Cero K" />' . $includes . $texto . $this->incluir_libreria("footer_nuevo.php", "librerias");
            $validacion_tipo .= '<?php else: ?>';
            $validacion_tipo .= $this->generar_mostrar_pdf();
            $validacion_tipo .= '<?php endif; ?>';

            $mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"], $validacion_tipo);
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
        return false;
    }

    public function generar_mostrar_pdf()
    {
        $string = '<?php
        include_once "../../controllers/autoload.php";
        include_once "../../pantallas/lib/librerias_cripto.php";
        
        $documentId = $_REQUEST["iddoc"];
        $sql = "select b.pdf, a.mostrar_pdf,a.exportar from formato a, documento b where lower(b.plantilla)= lower(a.nombre) and b.iddocumento={$documentId}";
        $record = StaticSql::search($sql);

        $params = [
            "iddoc" => $documentId,
            "exportar" => $record[0]["exportar"],
            "ruta" => base64_encode($record[0]["pdf"]),
            "usuario" => encrypt_blowfish($_SESSION["idfuncionario"], LLAVE_SAIA_CRYPTO)
        ];

        if(($record[0]["mostrar_pdf"] == 1 && !$record[0]["pdf"]) || $_REQUEST["actualizar_pdf"]){
            $params["actualizar_pdf"] = 1;
        }else if($record[0]["mostrar_pdf"] == 2){
            $params["pdf_word"] = 1;
        }
        
        $url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/visor/pdfjs/viewer.php?";
        $url.= http_build_query($params);

        ?>
        <iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= $url ?>"></iframe>';

        return $string;
    }


    /*
     * <Clase>
     * <Nombre>crear_cuerpo_formato</Nombre>
     * <Parametros>$idformato:id de la vista</Parametros>
     * <Responsabilidades>Se encarga de crear el cuerpo del formato por defecto para el usuario final<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    public function crear_cuerpo_formato()
    {
        global $conn, $ruta_db_superior;

        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);

        if ($formato[0]['cuerpo'] == '') {
            $consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);

            $campos_excluir = [
                "dependencia",
                "documento_iddocumento",
                "estado_documento",
                "firma",
                "serie_idserie",
                "encabezado"
            ];
            if ($consulta_campos_lectura['numcampos']) {
                $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
                $consultaEtiquetas = busca_filtro_tabla("nombre", "campos_formato", "formato_idformato = {$this->idformato} and (nombre like '%{$campos_lectura['titulo']}%' or nombre like '%{$campos_lectura['linea']}%' or nombre like '%{$campos_lectura['ft_relacion']}%' or nombre like '%{$campos_lectura['texto_descr']}%')", "", $conn);
                if ($consultaEtiquetas['numcampos']) {
                    for ($k = 0; $k < $consultaEtiquetas['numcampos']; $k++) {
                        $campos_excluir[] = $consultaEtiquetas[$k]['nombre'];
                    }
                }

                $campos_lectura = implode(",", $campos_lectura);
                $campos_lectura = str_replace(",", "','", $campos_lectura);

                $busca_idft = strpos($campos_lectura, "idft_");

                if ($busca_idft !== false) {
                    $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $this->idformato, "", $conn);
                    $campos_lectura = str_replace("idft_", "id" . $formato[0]['nombre_tabla'], $campos_lectura);
                    $campos_excluir[] = $campos_lectura;
                }
            }

            $condicion_adicional = " and A.nombre not in('" . implode("', '", $campos_excluir) . "')";

            $campos = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $this->idformato . " and etiqueta_html<>'campo_heredado' " . $condicion_adicional . "", "A.orden", $conn);
            
            if ($campos['numcampos']) {
                $cuerpo_formato = '<style>
        .table.table-condensed thead tr td {
        padding-top: 2px;
        padding-bottom: 2px;            
    }
    .table.table-condensed {
        table-layout: auto;
    }

    </style>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-condensed" style="width: 100%; text-align:left;margin-bottom: 5%;" border="1" cellspacing="0">
                    <thead>
                    <tr>
                    <td><strong>Fecha</strong></td>
                    <td>{*fecha_creacion*}&nbsp;</td>
                    <td style="text-align: center;" rowspan="2">&nbsp;{*mostrar_codigo_qr*} <br>Radicado: {*formato_numero*}</td></tr>
                    <tr><td><strong>Asunto</strong></td>
                    <td>{*asunto_documento*}</td></tr>
                    </thead>
                </table><br>
                <table class="table table-bordered table-condensed" style="width: 100%;">
                <thead>';
                for ($i = 0; $i < $campos['numcampos']; $i++) {
                    $cuerpo_formato .= '<tr>
            <td style="width:50%;"><strong>' . $campos[$i]['etiqueta'] . '<strong></td>
            <td>{*' . $campos[$i]['nombre'] . '*}</td>
            </tr>';
                }
                $cuerpo_formato .= '</thead>
                </table>
            </div>
        </div><br><br>{*mostrar_estado_proceso*}';
                $update_formato = "UPDATE formato set cuerpo='" . $cuerpo_formato . "' where idformato=" . $this->idformato;
                phpmkr_query($update_formato);
                $datos_funcion = busca_filtro_tabla("", "funciones_formato A", "A.nombre_funcion in ('mostrar_codigo_qr','formato_numero','fecha_creacion','asunto_documento','mostrar_estado_proceso')", "", $conn);
                if ($datos_funcion['numcampos']) {
                    for ($i = 0; $i < $datos_funcion['numcampos']; $i++) {
                        $consulta_existe_func = busca_filtro_tabla("", "funciones_formato_enlace", "formato_idformato=" . $this->idformato . " and funciones_formato_fk=" . $datos_funcion[$i]['idfunciones_formato'] . " ", "", $conn);
                        if (!$consulta_existe_func['numcampos']) {
                            $sql_funciones = "INSERT INTO funciones_formato_enlace(formato_idformato,funciones_formato_fk) VALUES(" . $this->idformato . "," . $datos_funcion[$i]['idfunciones_formato'] . ")";
                            phpmkr_query($sql_funciones);
                        }
                    }
                    $this->exito = 1;
                    $this->contenido_cuerpo = $cuerpo_formato;                    
                    return true;
                }
            }
        }



        $this->publicar = $formato[0]['publicar'];
        $this->exito = 1;
        $this->contenido_cuerpo = $formato[0]['cuerpo'];
    }

    /*
     * <Clase>
     * <Nombre>generar_vista</Nombre>
     * <Parametros>$idformato:id de la vista</Parametros>
     * <Responsabilidades>Se encarga de revisar que todas las funciones y campos asociados a la vista se encuentren previamente configurados, antes de proceder a llamar la funciï¿½n que genera el archivo con el mostrar de la vista<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function generar_vista()
    {
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
                alerta("La Vista del formato no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Vistas Formato y Luego Editela");
        } else
            alerta('No existen la vista seleccionada');

        $this->crear_vista_formato($l1tablas);
    }

    /*
     * <Clase>
     * <Nombre>crear_vista_formato</Nombre>
     * <Parametros>$idformato:id de la vista;$arreglo:contiene como llave los nombres de los campos y como valor el id del formato padre de la vista</Parametros>
     * <Responsabilidades>Se encarga de crear el archivo para mostrar en pantalla la vista seleccionada<Responsabilidades>
     * <Notas>si se necesita alguna funciï¿½n, o un campo, ï¿½stos debe estar registrados como asociados al formato padre de la vista, de lo contrario no funciona</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function crear_vista_formato($arreglo)
    {
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
                $includes .= $this->incluir("'../../anexosdigitales/funciones_archivo.php'", "librerias");
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
                            alerta("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
                            if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                $includes .= $this->incluir($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
                            } else
                                alerta("1073 No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
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
                            alerta("1087 No es posible generar el archivo " . $fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                    }
                }
                if ($funciones[$i]["parametros"] != "") {
                    $parametros = $idformato_padre . "," . $funciones[$i]["parametros"];
                } else {
                    $parametros = $idformato_padre;
                }
                $texto = str_replace($funciones[$i]["nombre"], $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, "mostrar"), $texto);
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
                        $sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES ('" . $vista[0]["nombre"] . "','3','botones/formatos/modulo.gif','" . $vista[0]["etiqueta"] . "','" . FORMATOS_CLIENTE . $vista[0]["ruta_mostrar"] . "','centro','" . $modulo_formato[0]["idmodulo"] . "','1','Permite administrar el formato " . $vista[0]["etiqueta"] . ".')";
                        guardar_traza($sql, $fpadre[0]["nombre_tabla"]);
                        phpmkr_query($sql, $conn);
                    }
                } else
                    alerta("El modulo Formatos No existe por favor insertarlo a la tabla modulos");
                alerta("Vista Creada con exito por favor verificar la carpeta " . dirname($mostrar));
                $this->exito = 1;
                $this->mensaje = "Vista Creada con exito por favor verificar la carpeta " . dirname($mostrar);
                return (true);
            }
        } else {
            alerta("No es posible generar el Formato");
            $this->exito = 0;
            $this->mensaje = "No es posible generar la Vista del formato";
        }
    }

    /*
     * <Clase>
     * <Nombre>codifica</Nombre>
     * <Parametros>$texto:texto que se desea codificar</Parametros>
     * <Responsabilidades>llama la funciï¿½n que pasa el texto a mayusculas y devuelve el nuevo texto modificado<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function codifica($texto)
    {
        $texto = strtoupper($texto);
        $texto = str_replace(["ACUTE;", "NTILDE;", "IQUEST;"], ["acute;", "Ntilde;", "iquest;"], $texto);
        return $texto;
    }

    /*
     * <Clase>
     * <Nombre>crear_formato_ae</Nombre>
     * <Parametros>$idformato:id del formato;$accion:adicionar o editar</Parametros>
     * <Responsabilidades>Crea el archivo en el adicionar o el editar del formato segun la configuraciï¿½n realizada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    public function crear_formato_ae($accion)
    {
        global $conn, $ruta_db_superior;
        $texto = '';
        $includes = "";
        $obligatorio = "";
        $autoguardado = array();
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        if ($formato["numcampos"]) {
            if ($formato[0]["item"]) {
                $action = '<?= $ruta_db_superior ?>' . FORMATOS_SAIA . 'librerias/funciones_item.php';
            } else {
                $action = '<?= $ruta_db_superior ?>class_transferencia.php"';
            }
            $texto .= '<div class="container-fluid container-fixed-lg col-lg-8" style="overflow: auto;" id="content_container">
                    	<!-- START card -->
                    	<div class="card card-default">
                            <div class="card-body">';
            if (!$formato[0]["item"]) {
                $texto .= '<center><h5 class="text-black">' . codifica_encabezado(html_entity_decode(mayusculas($formato[0]["etiqueta"]))) . '</h5></center>';
            }
            $texto .= '<?php llama_funcion_accion(@$_REQUEST["iddoc"],' . $this->idformato . ',"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="' . $action . '" enctype="multipart/form-data">';


            $librerias = array();
            if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
                $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
            }
            $includes .= $this->incluir('$ruta_db_superior . "assets/librerias.php"', "librerias");

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
            $textareacke = 0;
            $arboles_fancy = 0;
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
                if ($campos[$h]["etiqueta_html"] == "arbol") {
                    $arboles = 1;
                } else if ($campos[$h]["etiqueta_html"] == "textarea") {
                    $textareas = 1;
                } else if ($campos[$h]["etiqueta_html"] == "textarea_cke") {
                    $textareacke = 1;
                }
                if ($campos[$h]["obligatoriedad"]) {
                    $obliga = "*";
                } else {
                    $obliga = "";
                }
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

                    $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '"><label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                    $parametros = $this->idformato . "," . $campos[$h]["idcampos_formato"];
                    $texto .= $this->arma_funcion($nombre_func, $parametros, $accion) . "</div>";
                    array_push($fun_campos, $nombre_func);
                } else {
                    if ($accion == 'adicionar')
                        $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
                    elseif ($accion == "editar") {
                        $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                    }
                    switch ($campos[$h]["etiqueta_html"]) {
                        case "etiqueta":
                        case "etiqueta_titulo":
                            $texto .= '<div id="tr_' . $campos[$h]["nombre"] . '">
                                        <h5 title="' . $campos[$h]["ayuda"] . '" id="' . $campos[$h]["nombre"] . '"><label >' . $this->codifica($campos[$h]["valor"]) . '</label></h5>
                                      </div>';
                            break;
                        case "etiqueta_parrafo":
                            $texto .= '<p id="' . $campos[$h]["nombre"] . '">' . $campos[$h]["valor"] . '</p>';
                            break;
                        case "etiqueta_linea":
                            $texto .= '<hr class="border" id="' . $campos[$h]["nombre"] . '">';
                            break;
                        case "password":

                            $texto .= '<div class="form-group form-group-default ' . $obligatorio . '" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <input class="form-control" ' . $tabindex . ' type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '">
                                       </div>';
                            $indice_tabindex++;
                            break;
                        case "textarea_cke":
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="celda_transparente">';
                            $idcampo_cke = $campos[$h]["nombre"];
                            $texto .= '<textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $idcampo_cke . '" cols="53" rows="3" class="form-control';
                            if ($campos[$h]["obligatoriedad"]) {
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
                            $textareacke++;
                            $indice_tabindex++;
                            break;
                        case "arbol_fancytree":
                            $idcampo_ft = $campos[$h]["idcampos_formato"];
                            $params_ft = json_decode($campos[$h]["valor"], true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $opc_ft = "";
                                $param_url = "";
                                $parts = parse_url($params_ft["url"]);
                                parse_str($parts['query'], $query_ft);
                                foreach ($query_ft as $key => $value) {
                                    $param_url .= '"' . $key . '" => "' . $value . '",';
                                }

                                $texto .= '<div class="form-group  ' . $obligatorio . '" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label><?php $origen_' . $idcampo_ft . ' = array(
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
                                if ($campos[$h]["obligatoriedad"]) {
                                    $opc_ft .= '"obligatorio" => 1,';
                                }

                                $texto .= '$opciones_arbol_' . $idcampo_ft . ' = array(
                                    "keyboard" => true,' . $opc_ft . '
                                );
                                $extensiones_' . $idcampo_ft . ' = array(
                                    "filter" => array()
                                );
                                $arbol_' . $idcampo_ft . ' = new ArbolFt("' . $campos[$h]["nombre"] . '", $origen_' . $idcampo_ft . ', $opciones_arbol_' . $idcampo_ft . ', $extensiones_' . $idcampo_ft . ');
                                echo $arbol_' . $idcampo_ft . '->generar_html();?></div>';
                                $arboles_fancy++;
                            }

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
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="celda_transparente">
                                        <textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" cols="53" rows="3" class="form-control tiny_' . $nivel_barra;
                            if ($campos[$h]["obligatoriedad"]) {
                                $texto .= ' required';
                            }
                            $texto .= '">' . $valor . '</textarea></div></div>';
                            $textareas++;
                            $indice_tabindex++;
                            break;
                        case "fecha":
                            // si la fecha es obligatoria, que valide que no se vaya con solo ceros
                            $texto .= $this->procesar_componente_fecha($campos[$h], $indice_tabindex, $accion);
                            $indice_tabindex++;
                            $fecha++;
                            break;
                        case "radio":
                            /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas */
                            $classRadios = '';
                            if ($campos[$h]["obligatoriedad"]) {
                                $classRadios = 'required';
                                $labelRequired = '<label id="' . $campos[$h]["no mbre"] . '-error" class="error" f or="' . $campos[$h]["nombre"] . '" style="display: none;"></label>';
                            }
                            /* En los campos de  e ste tipo se debe validar que  v alor contenga un list a do con las siguentes caracteristicas */
                            $texto .= '<div class="form-group  ' . $classRadios . '" id="tr_' . $campos[$h]["nombre"] . '">
                            <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga .   '</label>';
                            $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . $labelRequired . '<br></div>';
                            break;
                        case "link":
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            if (strpos($adicionales, "class") !== false)
                                $adicionales = str_replace("required", "required url", $adicionales);
                            else
                                $adicionales .= " class='url' ";
                            $texto .= '<textarea form-control cols="40" rows="3" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" ' . $adicionales . '>';
                            if ($accion == "editar") {
                                $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                            } else if ($valor == "")
                                $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
                            $texto .= $valor . '</textarea></div>';
                            break;
                        case "checkbox":
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</div>';
                            $checkboxes++;
                            break;
                        case "select":
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</div>';
                            break;
                        case "dependientes":
                            /* parametros:
                              nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
                              (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=) */
                            $parametros = explode("|", $campos[$h]["valor"]);
                            if (count($parametros) < 2)
                                alerta("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"]);
                            else {
                                $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                          <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                                $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</div>';
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

                            // $ul_adicional_archivo='';

                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding">';

                            if ($extensiones_fijas != "") {
                                $new_ext = array_map('trim', explode('|', $extensiones_fijas));
                                $extensiones_fijas = "." . implode(', .', $new_ext);
                                $extensiones = $extensiones_fijas;
                            } else {
                                $extensiones = '<?php echo $extensiones;?' . '>';
                            }
                            if ($accion == "adicionar") {
                                $opcionesCampo = json_decode($campos[$h]['opciones'], true);
                                $longitud = $opcionesCampo['longitud'];
                                $cantidad = $opcionesCampo['cantidad'];
                                $idelemento = "dz_campo_{$campos[$h]["idcampos_formato"]}";
                                $texto .= '<div id="' . $idelemento . '" class="saia_dz dropzone no-margin" data-nombre-campo="' . $campos[$h]["nombre"] . '" data-longitud="' . $longitud . '"  data-cantidad="' . $cantidad . '" data-idformato="' . $this->idformato . '" data-idcampo-formato="' . $campos[$h]["idcampos_formato"] . '" data-extensiones="' . $extensiones . '" data-multiple="' . $multiple . '">';
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
                            $texto .= '</div></div>';
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
                        case "autocompletar":
                            /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                              ej: nombres,apellidos;idfuncionario;funcionario
                             */
                            $parametros = json_decode($campos[$h]['valor']);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                die("Autocompletar: El campo valor debe ser una cadena json");
                            }
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                       <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            if ($campos[$h]["obligatoriedad"] == 1) {
                                $obligatorio = "required";
                            }

                            $adicional = "";
                            if ($accion == "editar") {
                                $adicional = " data-data='<?php echo(mostrar_autocompletar('{$campos[$h]["nombre"]}', $this->idformato, $" . "_REQUEST['iddoc'])); ? >'";
                            }
                            $texto .= '<input type="text" class="form-control" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value=""' . $adicional . $obligatorio . '></div>';
                            $texto .= $this->crea_campo_autocompletar($campos[$h]["nombre"], $parametros);
                            $autocompletar++;
                            break;
                        case "etiqueta":
                            $texto .= '<div class="card-body" id="tr_' . $campos[$h]["nombre"] . '">
                                        <h5><center>' . $valor . '</center></h5><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '">
                                       </div>';
                            break;
                        case "ejecutor":
                            if ($accion == "editar") {
                                $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
                            } else
                                $valor = $campos[$h]["predeterminado"];

                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="' . $valor . '"><?php componente_ejecutor("' . $campos[$h]["idcampos_formato"] . '",@$_REQUEST["iddoc"]); ?' . '>';
                            $texto .= '</div>';
                            break;

                        case "arbol":
                            /* En campos valor se deben almacenar los siguientes datos: ../../test.php;1;0;1;1;0;0
                              arreglo[0] ruta de el xml
                              arreglo[1] 1=> checkbox; 2=>radiobutton
                              arreglo[2] Modo calcular numero de nodos hijo
                              arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
                              arreglo[4] Busqueda
                              arreglo[5] Almacenar 0=>iddato 1=>valordato
                              arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias 3=>Otro (se debe sacar el dato) 4=>Sale de la tabla enviada a test_serie.php?tabla=nombre_tabla,5 => rol
                             */
                            $arreglo = explode(";", $campos[$h]["valor"]);
                            $dinamico = 0;
                            if (strpos($arreglo[0], 'vacio.php') !== false) {
                                $dinamico = 1;
                            }
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
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                <label title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            $texto .= '<div class="form-control"><div id="seleccionados">' . $this->arma_funcion("mostrar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",'" . $arreglo[6] . "'", "mostrar") . '</div><br/>';
                            if ($arreglo[4]) {
                                if ($arreglo[3]) {
                                    $busqueda = 'tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),0,1)';
                                } else {
                                    $busqueda = "buscar_nodo_" . $campos[$h]["nombre"] . "('tree_" . $campos[$h]["nombre"] . "')";
                                    if (strpos($ruta, "cargar_partes") === false) {
                                        if (strpos($ruta, ".php?") === false) {
                                            $ruta = substr($ruta, 0, -1) . '?cargar_partes=1"';
                                        } else {
                                            $ruta = substr($ruta, 0, -1) . '&cargar_partes=1"';
                                        }
                                    }
                                }
                                $texto .= 'Buscar: <input ' . $tabindex . ' type="text" id="stext_' . $campos[$h]["nombre"] . '" width="200px" size="25" onblur="closetree_' . $campos[$h]["nombre"] . '()"> <input type="hidden" id="idclosetree_' . $campos[$h]["nombre"] . '">
                                <a href="javascript:void(0)" onclick="' . $busqueda . '">
                                    <img src="../../assets/images/buscar.png"border="0px">
                                </a>
                                    <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),1)">
                                        <img src="../../assets/images/anterior.png"border="0px">
                                    </a>
                                <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value))">
                                    <img src="../../assets/images/siguiente.png"border="0px"></a><br/>';
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
                                tree_' . $campos[$h]["nombre"] . '.enableTreeImages("false");
                                tree_' . $campos[$h]["nombre"] . '.enableTreeLines("false");
                                tree_' . $campos[$h]["nombre"] . '.enableIEImageFix(true);';

                            if ($arreglo[1] == 1) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                                    tree_' . $campos[$h]["nombre"] . '.enableThreeStateCheckboxes(1);';
                            } else if ($arreglo[1] == 2) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                                    tree_' . $campos[$h]["nombre"] . '.enableRadioButtons(true);
                                    tree_' . $campos[$h]["nombre"] . '.enableSingleRadioMode(true);';
                            }
                            $texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnLoadingStart(cargando_' . $campos[$h]["nombre"] . ');
                                tree_' . $campos[$h]["nombre"] . '.setOnLoadingEnd(fin_cargando_' . $campos[$h]["nombre"] . ');';

                            if ($arreglo[3]) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.enableSmartXMLParsing(true);';
                            } else {
                                if (!$dinamico) {
                                    $texto .= 'tree_' . $campos[$h]["nombre"] . '.setXMLAutoLoading(' . $ruta . ');';
                                }
                            }
                            if ($accion == "editar") {
                                $ruta .= ",checkear_arbol";
                            }
                            if (!$dinamico) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.loadXML(' . $ruta . ');';
                            }
                            if ($arreglo[1] == 1) {
                                $texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');

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

                                            valor_destino.value=nodeId.split(/[_.]/)[0];
                                        }else{
                                            valor_destino.value="";
                                        }
                                    }';
                            }
                            if (!$arreglo[3]) {
                                $texto .= $this->busca_funcion_test($campos[$h]["nombre"], str_replace('../', "", $arreglo[0]));

                                $texto .= "function closetree_" . $campos[$h]["nombre"] . "() {
                                    var bus_ant=document.getElementById('idclosetree_" . $campos[$h]["nombre"] . "').value;
                                    var bus_actual=document.getElementById('stext_" . $campos[$h]["nombre"] . "').value.trim();
                                    if(bus_actual!=''){
                                        if(bus_actual!=bus_ant){
                                            document.getElementById('idclosetree_" . $campos[$h]["nombre"] . "').value=bus_actual;
                                            tree_" . $campos[$h]["nombre"] . ".closeAllItems('1#');
                                        }
                                    }
                                }";
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
                            $texto .= '</script></div></div>';
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
                        case "moneda":
                            $texto .= $this->procesar_componente_numero($campos[$h], $indice_tabindex, true);
                            $indice_tabindex++;
                            //$spinner++;
                            break;
                        case "spin":
                            $texto .= $this->procesar_componente_numero($campos[$h], $indice_tabindex);
                            $indice_tabindex++;
                            //$spinner++;
                            break;
                        default: // text
                            $estilo = json_decode($campos[$h]["estilo"], true);
                            $tam = 100;
                            $ancho = "";
                            if (!empty($estilo)) {
                                $tam = $estilo["size"];
                                $ancho = ' style="width:' . $tam . '%;" ';
                            }

                            if ($campos[$h]["obligatoriedad"] == 1) {
                                $obligatorio = "required";
                            }
                            $texto .= '<div class="form-group form-group-default ' . $obligatorio . '" ' . $ancho . ' id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . str_replace("ACUTE;", "acute;", $this->codifica($campos[$h]["etiqueta"])) . '</label>
                                        <input class="form-control" ' . " $adicionales $tabindex" . ' type="text" ' . $ancho . ' size="100" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '">
                                       </div>';
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
                $texto .= '<div "form-group">'
                    . '<label>ACCION A SEGUIR LUEGO DE GUARDAR</label>'
                    . '<div class="radio radio-success">'
                    . '<input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">'
                    . '<label for="opcion_item1">Adicionar otro</label>'
                    . '<input type="radio" name="opcion_item" id="opcion_item" value="terminar" checked>'
                    . '<label for="opcion_item">Terminar</label>'
                    . '</div>'
                    . '</div>';
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
                            $includes .= $this->incluir("'../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . "'", "librerias");
                        } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                            $includes .= $this->incluir("'../" . $funciones[$i]["ruta"] . "'", "librerias");
                        } else { // si no existe en ninguna de las dos
                            // trato de crearlo dentro de la carpeta del formato actual
                            if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                                $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                            } else {
                                alerta("No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
                            }
                        }
                    }
                } else {
                    if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        // Modificacion realizada el 28-02-2009 porque buscaba la ruta en la raiz pero debia buscarla en la raiz del propio formato se quita el ../
                        $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                    } else { // si no existe en ninguna de las dos
                        // trato de crearlo dentro de la carpeta del formato actual
                        $ruta_libreria = FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"];
                        $ruta_real = realpath($ruta_libreria);
                        if ($ruta_real === false) {
                            $ruta_real = normalizePath($ruta_libreria);
                        }
                        if (crear_archivo($ruta_real)) {
                            $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                        } else {
                            alerta("1863 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
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
                alerta("Recuerde asignar el campo que sera almacenado como descripcion del documento");
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
            //$includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
            if ($archivo) {
                $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
                $id_unico = '<?php echo (uniqid("' . $this->idformato . '-") . "-" . uniqid());?>';
                $texto .= "<input type='hidden' name='form_uuid'       id='form_uuid'       value='$id_unico'>";
            }
            $texto .= '</form></body>';
            if ($textareas) {
                $includes .= $this->incluir_libreria("header_formato.php", "librerias");
            }
            if ($textareacke) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js', "javascript");
            }
            $includes .= '<?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= icons() ?>
                        <?= moment() ?>';
            $includes .= "<?= validate() ?>";

            if ($arboles_fancy) {
                $includes .= '<style>
ul.fancytree-container {
	width: 80%;
	height: 80%;
	overflow: auto;
	position: relative;
	border: none !important;
    outline:none !important;
}
span.fancytree-title {
    font-family: verdana;
	font-size: 7pt;
}
span.fancytree-checkbox.fancytree-radio {
    vertical-align: middle;
}
span.fancytree-expander {
    vertical-align: middle !important;
}
</style>';
                $includes .= $this->incluir('$ruta_db_superior . "arboles/crear_arbol_ft.php"', "librerias");
                $includes .= '<?= jqueryUi() ?>';
                $includes .= '<?= arboles_ft("2.30", "filtro", "lion") ?>';
            }

            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/title2note.js', "javascript");
            if ($arboles) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/dhtmlXCommon.js', "javascript");
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/dhtmlXTree.js', "javascript");
                $includes .= $this->incluir_libreria("header_formato.php", "librerias");
                $includes .= '<link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">';
            }
            if ($autocompletar) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>css/selectize.css', "estilos");
                // $includes .= $this->incluir("../../js/jquery-1.7.2.js", "javascript");
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/selectize.js', "javascript");
                // $includes .= incluir("../librerias/autocompletar.js", "javascript");
            }
            if ($dependientes > 0) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>librerias/dependientes.js', "javascript");
            }

            if ($hora) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.clock.js', "javascript");
            }
            $numero_unicos = count($unico);
            $enmascarar = '';
            if ($numero_unicos) {
                $listado = array();
                $enmascarar .= '<script type="text/javascript">
	$(document).ready(function() {';
                for ($k = 0; $k < $numero_unicos; $k++) {
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
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.spin.js', "javascript");
            if ($mascaras) {
                $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.maskedinput.js', "javascript");
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
                $includes .= $this->incluir('<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js', "javascript");
                $includes .= $this->incluir("'<?= $ruta_db_superior ?>anexosdigitales/funciones_archivo.php'", "librerias");
                $includes .= $this->incluir('<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js', "javascript");
                $includes .= '<link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style>';
                $includes .= '<link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style>';
                $includes .= '<script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>';
                $js_archivos = $this->crear_campo_dropzone(null, null);
            }
            //$includes .= "<style>label.error{color:red}</style>";

            $contenido = '<?php
                    $max_salida = 10;
                    $ruta_db_superior = $ruta = "";

                    while ($max_salida > 0) {
                        if (is_file($ruta . "db.php")) {
                            $ruta_db_superior = $ruta;
                        }

                        $ruta .= "../";
                        $max_salida --;
                    }

                    ?>
                        <!DOCTYPE html>
                            <html>
                                <head>
                                    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                                    <meta charset="utf-8" />
                                    <title>.:' . $this->codifica($accion . ' ' . $formato[0]["etiqueta"]) . ':.</title>
                                    <meta name="viewport"
                                    	content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> ' . $includes . '
                	<link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css"
                                	rel="stylesheet" type="text/css" media="screen" />
                                <link class="main-stylesheet"
                                	href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                	rel="stylesheet" type="text/css" />
                                <link
                                	href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"
                                	rel="stylesheet" type="text/css" media="screen">
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-validation/js/jquery.validate.min.js"
                                	type="text/javascript"></script>
                                <script
                                    src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js"
                                    type="text/javascript"></script>

                                <link rel="stylesheet"
                                    href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"  type="text/css" media="screen" />
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>' . $enmascarar . ' ' . $codigo_enter2tab . '
                                <script
                                	src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script>' . $enmascarar . ' ' . $codigo_enter2tab . '
                	</head>
                	' . $texto . $js_archivos . '
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(".form-group.form-group-default").click(function() {
                                    $(this).find("input").focus();
                                });

                                if (!this.initFormGroupDefaultRun) {
                                    $("body").on("focus", ".form-group.form-group-default :input", function() {
                                        $(".form-group.form-group-default").removeClass("focused");
                                        $(this).parents(".form-group").addClass("focused");
                                    });

                                    $("body").on("blur", ".form-group.form-group-default :input", function() {
                                        $(this).parents(".form-group").removeClass("focused");
                                        if ($(this).val()) {
                                            $(this).closest(".form-group").find("label").addClass("fade");
                                        } else {
                                            $(this).closest(".form-group").find("label").removeClass("fade");
                                        }
                                    });

                                    // Only run the above code once.
                                    this.initFormGroupDefaultRun = true;
                                }

                                $(".form-group.form-group-default .checkbox, .form-group.form-group-default .radio").hover(function() {
                                    $(this).parents(".form-group").addClass("focused");
                                }, function() {
                                    $(this).parents(".form-group").removeClass("focused");
                                });
                                
                            });
                        </script>
                	</html>';
            if ($accion == "editar") {
                $contenido .= '<?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?' . '>';
            }
            include_once($ruta_db_superior . "pantallas/lib/librerias_notificaciones.php");

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
     * <Nombre>generar_comparacion</Nombre>
     * <Parametros>$tipo:tipo de campo sobre el que se va a hacer la comparacion;$nombre:nombre del campo</Parametros>
     * <Responsabilidades>genera un listado con las opciones de comparaciï¿½n posibles segï¿½n el tipo de campo<Responsabilidades>
     * <Notas>usado para la pantalla de busqueda del formato</Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    public function generar_comparacion($tipo, $nombre)
    {
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

    private function incluir($cad, $tipo, $eval = 0)
    {
        $includes = "";
        $lib = explode(",", $cad);
        switch ($tipo) {
            case "librerias":
                $texto1 = '<?php include_once(';
                $texto2 = '); ? >';
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
                        alerta("Problemas al generar el Formato en " . $lib[$j]);
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

    private function incluir_libreria($nombre, $tipo)
    {
        $includes = "";
        if (!is_file(FORMATOS_SAIA . "librerias/" . $nombre)) {
            if (!crear_archivo(FORMATOS_SAIA . "librerias/" . $nombre)) {
                alerta("No es posible generar el archivo " . $nombre);
            }
        }
        if ($tipo == 'librerias') {
            $includes .= $this->incluir("'../../" . FORMATOS_SAIA . "librerias/" . $nombre . "'", $tipo);
        } else {
            $includes .= $this->incluir("../../" . FORMATOS_SAIA . "librerias/" . $nombre, $tipo);
        }

        return ($includes);
    }

    /*
     * <Clase>
     * <Nombre>arma_funcion</Nombre>
     * <Parametros>$nombre:nombre de la funciï¿½n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
     * <Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funciï¿½n especificada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function arma_funcion($nombre, $parametros, $accion)
    {
        if ($parametros != "" && $accion != "adicionar" && $accion != 'buscar')
            $parametros .= ",";
        if ($accion == "mostrar") {
            $texto = '<?php if(isset($_REQUEST["iddoc"])){';
            $texto .= $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);";
            $texto .= '}?>';
        } elseif ($accion == "adicionar")
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

    private function generar_formato()
    {
        global $conn, $ruta_db_superior;
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
        $encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);

        $data = array(
            "adicionar_" . $formato[0]['nombre'] . ".php",
            "editar_" . $formato[0]['nombre'] . ".php",
            "buscar_" . $formato[0]['nombre'] . ".php",
            "buscar_" . $formato[0]['nombre'] . "2.php",
            "mostrar_" . $formato[0]['nombre'] . ".php",
            "detalles_mostrar_" . $formato[0]['nombre'] . ".php"
        );
        crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", implode("\n", $data));
        /*
        $fp = fopen(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", 'w') or die("no creo el archivo");
        fwrite($fp, implode("\n", $data));
        fclose($fp);
        chmod($ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", PERMISOS_ARCHIVOS);*/
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
                notificaciones("El formato mostrar no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Formato y Luego Editelo", "error", 5000);
            }
        }
        $tadd = "";
        $ted = "";
        $tod = "";
        $tadd .= implode(",", $campos_adicionar);
        $ted .= implode(",", $campos_editar);
        $tod .= implode(",", $campos_otrosf);
        if ($campos_otrosf != "") {
            notificaciones("Existen otros Formatos Vinculados ", "error", 5000);
        }
        $adicionales = "";
        if (@$_REQUEST["pantalla"] == "tiny") {
            $adicionales = "&pantalla=tiny";
        }
        $redireccion = "formatoview.php?idformato=" . $this->idformato . $adicionales;
        if (usuario_actual('login') == 'cerok') {
            $redireccion = "funciones_formatoadd.php?adicionar=" . $tadd . "&editar=" . $ted . "&idformato=" . $this->idformato . $adicionales;
        }
        $this->mensaje = "Formato generado con exito";
        $this->exito = "1";
        return $redireccion;
    }

    private function busca_funcion_test($nombre_test, $ruta)
    {
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

    private function crea_campo_autocompletar($nombre, $parametros)
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

    private function crear_campo_dropzone($nombre, $parametros)
    {

        $upload_max_size = str_replace("M", "", ini_get('upload_max_filesize'));
        $maximo = str_replace("M", "", return_megabytes($upload_max_size));
        $js_archivos = "<script type='text/javascript'>
            var upload_url = '../../dropzone/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var upload_max_size = $upload_max_size;
                    var maximo = $maximo;
                    var longitudSolicitada = $(this).attr('data-longitud');
                    var cantidadSolicitada = $(this).attr('data-cantidad');
                    var multiple_text = $(this).attr('data-multiple');
                    if(longitudSolicitada > 1){
                         multiple_text = 'multiple';
                    }
                    
                    var idformato = $(this).attr('data-idformato');
                	var idcampo = $(this).attr('id');
                	var paramName = $(this).attr('data-nombre-campo');
                	var idcampoFormato = $(this).attr('data-idcampo-formato');
                	var extensiones = $(this).attr('data-extensiones');
                	
                	var multiple = false;
                	var form_uuid = $('#form_uuid').val();
                    var maxFiles = 1;
                    var maxFiles = $maximo;
                	if(multiple_text == 'multiple') {
                	    multiple = true;
                        if(longitudSolicitada > upload_max_size){
                            maxFilesize = 200;                           
                        }else{
                            maxFilesize = longitudSolicitada;
                        }
                        if(cantidadSolicitada > maximo){
                            maxFiles = 10;
                        }else{
                            maxFiles = cantidadSolicitada;
                        } 
                	}
                    var opciones = {
                        maxFilesize: maxFilesize,
                    	ignoreHiddenFiles : true,
                    	maxFiles : maxFiles,
                    	acceptedFiles: extensiones,
                   	addRemoveLinks: true,
                   	dictRemoveFile: 'Quitar anexo',
                   	dictMaxFilesExceeded : 'No puede subir mas archivos',
                   	dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
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
        return $js_archivos;
    }

    private function procesar_componente_numero($campo, $indice_tabindex, $moneda = false)
    {
        $valor = $campo["valor"];

        $obligatorio = "";
        $obliga = "";
        $tabindex = ' tabindex="' . $indice_tabindex . ' "';
        if ($campo["obligatoriedad"]) {
            $obliga = "*";
            $obligatorio = " required ";
        }
        $aux2 = [];
        $texto = array();
        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);
            $estilo = json_decode($campo["estilo"], true);

            $ini = 0;
            $fin = 1000;
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
            $ancho = 'style="width:' . $tam . '%;"';
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
        $texto[] = '<div class="form-group form-group-default ' . $obligatorio . '" id="tr_' . $campo["nombre"] . '">';
        $texto[] = '<label title="' . $campo["ayuda"] . '" for="' . $campo["nombre"] . '">' . $campo["etiqueta"] . '</label>';
        if ($moneda) {
            $pre = '<div class="input-group" ' . $ancho . '>
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>';
            $post = '</div>';
            $ancho = "";
        }
        $adicionales .= " $ancho";
        $texto[] = $pre;
        $texto[] = '<input class="form-control" ' . " $adicionales $tabindex" . ' type="number" id="' . $campo["nombre"] . '" name="' . $campo["nombre"] . '"  value="' . $valor . '">';
        $texto[] = '</div>';
        $texto[] = $post;
        return implode("\n", $texto);
    }

    private function procesar_componente_fecha($campo, $indice_tabindex, $accion)
    {
        $tabindex = ' tabindex="' . $indice_tabindex . ' "';

        //$formato_fecha="L";
        $formato_fecha = "YYYY-MM-DD";
        $texto = array();

        //$nombre_selector =  "dtp_" . $campo["nombre"];
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
        $texto[] = '<label for="' . $campo["nombre"] . '">' . $this->codifica($campo["etiqueta"]) . '</label>';
        $texto[] = $labelRequired;
        $texto[] = '<div class="input-group date">';
        $texto[] = '<input ' . $tabindex . ' type="text" class="form-control" ' . ' id="' . $campo["nombre"] . '"  ' . $required . ' name="' . $campo["nombre"] . '" />';
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
                        if($opciones["tipo"] == "datetime"){
                            $fecha_por_defecto = date("Y-m-d H:i:s");
                        } else if ($opciones["tipo"] == "date") {
                            $fecha_por_defecto = date("Y-m-d");
                        }                     
                        break;
                    case "ant_actual":
                        if($opciones["tipo"] == "datetime"){
                            $fecha_por_defecto = date("Y-m-d H:i:s");
                            $fecha_por_defecto = strtotime('-1 day', strtotime( $fecha_por_defecto));
                            $fecha_por_defecto = date ('Y-m-d H:i:s' , $fecha_por_defecto );
                        } else if ($opciones["tipo"] == "date") {
                            $fecha_por_defecto = date("Y-m-d");
                            $fecha_por_defecto = strtotime('-1 day', strtotime($fecha_por_defecto));
                            $fecha_por_defecto = date('Y-m-d' , $fecha_por_defecto );
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

                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            } else if (strtoupper($campo["tipo_dato"]) == "DATETIME") {
                $formato_fecha = "YYYY-MM-DD LT";
                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            } else if (strtoupper($campo["tipo_dato"]) == "TIME") {
                $formato_fecha = "LT";
                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            }
            if ($accion == "editar") {
                $fecha_por_defecto = "<?php echo(mostrar_valor_campo('" . $campo["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ?" . ">";
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
}

