<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/generador/librerias.php";
include_once $ruta_db_superior . "pantallas/generador/librerias_formato.php";
include_once $ruta_db_superior . "pantallas/generador/librerias_bpmni.php";
include_once $ruta_db_superior . "pantallas/modulo/librerias.php";
include_once $ruta_db_superior . "formatos/librerias/funciones.php";
include_once $ruta_db_superior . "anexosdigitales/funciones_archivo.php";

$librerias_incluidas = array();

if (@$_REQUEST["ejecutar_libreria_pantalla"]) {
    if (!@$_REQUEST["tipo_retorno"]) {
        $_REQUEST["tipo_retorno"] = 1;
    }
    $_REQUEST["ejecutar_libreria_pantalla"]($_REQUEST["idformato"], $_REQUEST["tipo_retorno"]);
}
if (@$_REQUEST["ejecutar_datos_pantalla"]) {
    if (!@$_REQUEST["tipo_retorno"]) {
        $_REQUEST["tipo_retorno"] = 1;
    }
    $_REQUEST["ejecutar_datos_pantalla"]($_REQUEST, @$_REQUEST["tipo_retorno"]);
}

function load_pantalla($idpantalla, $generar_archivo = "", $accion = '') {
   
    $consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);
   
    $campos_excluir = array(
        "dependencia",
        "documento_iddocumento",
        "estado_documento",
        "firma",
        "serie_idserie",
        "encabezado"
    );
    if ($consulta_campos_lectura['numcampos']) {
        $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
        $campos_lectura = implode(",", $campos_lectura);
        $campos_lectura = str_replace(",", "','", $campos_lectura);
        $busca_idft = strpos($campos_lectura, "idft_");
        if ($busca_idft !== false) {
            $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idpantalla, "", $conn);
            $campos_lectura = str_replace("idft_", "id" . $consulta_ft[0]['nombre_tabla'], $campos_lectura);
            $campos_excluir[] =  $campos_lectura;
        }
    }

    $condicion_adicional = " and B.nombre not in('" . implode("', '", $campos_excluir) . "')";
    $pantalla = busca_filtro_tabla("", "formato A,campos_formato B", "A.idformato=B.formato_idformato AND A.idformato=" . $idpantalla . $condicion_adicional, "B.orden", $conn);
    $texto = '';
    for ($i = 0; $i < $pantalla["numcampos"]; $i++) {
        $cadena = load_pantalla_campos($pantalla[$i]["idcampos_formato"], 0, $generar_archivo, $accion, $pantalla[$i]);
        $texto .= $cadena["codigo_html"];
    }
    $texto = str_replace("? >", "?" . ">", $texto);
    $texto = str_replace("< ?php ", "<" . "?php", $texto);
    return $texto;
}

function carga_vista_previa($idFormato) {
    global $conn,$ruta_db_superior;
    
    include_once $ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php";
    
    $consultaDatos =  busca_filtro_tabla("encabezado,pie_pagina,cuerpo","formato","idformato=".$idFormato,"",$conn);
    $encabezado = '';
    $contenido_formato = '';
    $piePagina = '';

    if($consultaDatos['numcampos']){
        if($consultaDatos[0]['encabezado']){
            $consultaEncabezados = busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=".$consultaDatos[0]["encabezado"],"",$conn);  
            if($consultaEncabezados['numcampos']){
                $encabezado = $consultaEncabezados[0]['contenido']; 
                $contenidoEncabezado = buscar_funciones_generador($encabezado, $idFormato);          
            }            
        } 
        if($consultaDatos[0]['cuerpo']){
            $excluirFunciones=1;
            $contenidoFormato = buscar_funciones_generador($consultaDatos[0]['cuerpo'], $idFormato, $excluirFunciones); 
        }   
        if($consultaDatos[0]['pie_pagina']){
            $consultaPie = busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=".$consultaDatos[0]["pie_pagina"],"",$conn);
            if($consultaPie['numcampos']){
                $piePagina = $consultaPie[0]['contenido'];
                $contenidoPie = buscar_funciones_generador($piePagina, $idFormato);  
            }                                     
        }

        $tableCuerpo = "<div style='padding:20px;'>".$contenidoEncabezado."</div><div style='padding:20px;'>".$contenidoFormato."</div><div style='padding:20px;'>".$contenidoPie."</div>";
        return $tableCuerpo;                       
    }       
}

function buscar_funciones_generador($cuerpo, $idFormato, $excluirFunciones = 0){
    global $conn,$ruta_db_superior;
    $iddoc=1;
    $tipo=1;
    $nombreFunciones = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $cuerpo, $resultadoFunciones);  
    if ($nombreFunciones !== FALSE) {          
        $patronesBusqueda = str_replace(array(
            "{*",
            "*}"
        ), "", $resultadoFunciones[0]);        
    }       
    
    foreach ($patronesBusqueda as $key => $nombreFuncion) {
    
        if($excluirFunciones==1 && $nombreFuncion =='mostrar_estado_proceso'){
            $rutaContenido = $ruta_db_superior."firmas/faltante.jpg";
            $contenidoFuncion ="<img src={$rutaContenido} width='109' />";            
        }else if($excluirFunciones==1 && $nombreFuncion !='mostrar_codigo_qr'){
            $contenidoFuncion = "Lorem Ipsum is simply dummy text of the printing and typesetting industry.";        
        }else if($excluirFunciones==1 && $nombreFuncion =='mostrar_codigo_qr'){
            $imagenQr = busca_filtro_tabla("valor", "configuracion", "nombre='qr_formato'", "", $conn);
            if ($imagenQr["numcampos"]) {
                $tipo_almacenamiento = new SaiaStorage("archivos");             
                $ruta_imagen = json_decode($imagenQr[0]["valor"]);               
                if (is_object($ruta_imagen)) {
                    if ($tipo_almacenamiento -> get_filesystem() -> has($ruta_imagen -> ruta)) {
                        $ruta_imagen = json_encode($ruta_imagen);
                        $archivo_binario = StorageUtils::get_binary_file($ruta_imagen);
                    }
                }
            }
            $rutaContenido = $ruta_db_superior."imagenes/qrFormato.png";
            $contenidoFuncion ="<img src={$archivo_binario} width='109' />";            
        }else{
            $contenidoFuncion = call_user_func($nombreFuncion, $idFormato,$iddoc,$tipo); 
        }
        
        $cuerpo = str_replace("{*".$nombreFuncion."*}", $contenidoFuncion, $cuerpo);              
    }

    return $cuerpo;
}
function echo_load_pantalla($idpantalla, $tipo_retorno) {
    echo (load_pantalla($idpantalla));
}

function ordenar_pantalla_campos($nuevo_orden) {
    $pantalla_campos = explode(",", $nuevo_orden);
    $i = 0;

    foreach ($pantalla_campos as $key => $valor) {
        $cadena = str_replace("pc_", "", $valor);
        /* $sql2 = 'UPDATE pantalla_campos SET orden=' . $i . ' WHERE idpantalla_campos=' . $cadena; */
        $sql2 = 'UPDATE campos_formato SET orden=' . $i . ' WHERE idcampos_formato=' . $cadena;
        $i++;
        phpmkr_query($sql2);
    }
}

function adicionar_datos_formato($datos, $tipo_retorno = 1) {
    global $ruta_db_superior;

    $retorno = array(
        "mensaje" => "Error al tratar de generar el adicionar de la pantalla",
        "exito" => 0
    );
  
    if ($datos["nombre_formato"] == "") {
        $nombre_formato_automatico = strtolower($datos["etiqueta"]);
        $nombre_formato_automatico = preg_replace("/formato/", "", $nombre_formato_automatico); // se reemplaza la palabra formato por vacio
        $nombre_formato_automatico = strip_tags($nombre_formato_automatico);
        $nombre_formato_automatico = htmlentities($nombre_formato_automatico);
        $nombre_formato_automatico = preg_replace('/\&(.)[^;]*;/', '\\1', $nombre_formato_automatico);
        $nombre_formato_automatico = quitar_preposiciones_articulos($nombre_formato_automatico); // quita las preposiciones y articulos
        $cant_palabra = count($nombre_formato_automatico); // cantidad de palabra
        $cant_espacios = $cant_palabra - 1;
        $res = 23 - $cant_expacios; // cantidad de caracteres permitidos

        $total_caracteres = $res / $cant_palabra; // para saber cuantos caracteres debe tener cada palabra
        $cadena = array();
        // quita los ultimos caracteres que completen la palabra
        for ($i = 0; $i < $cant_palabra; $i++) {
            if ($nombre_formato_automatico[$i] != "") {
                $cantidad_caracteres = strlen($nombre_formato_automatico[$i]);
                $diferencia = $cantidad_caracteres - round($total_caracteres);
                if (strlen($nombre_formato_automatico[$i]) > round($total_caracteres)) {
                    $quitar_caracteres = $diferencia * -1;
                    $cadena[] = substr($nombre_formato_automatico[$i], 0, $quitar_caracteres);
                } else {
                    $cadena[] = $nombre_formato_automatico[$i];
                }
            }
        }
        if (count($cadena) > 1) { // si hay mas de una palabra
            $nuevo_nombre_formato = implode("_", $cadena);
        } else {
            $nuevo_nombre_formato = implode($cadena);
        }

        $datos["nombre"] = validar_nombres($nuevo_nombre_formato);
    } else {
        $datos["nombre"] = trim($datos["nombre_formato"]);
        unset($datos["nombre_formato"]);
        
        if (empty($datos["nombre"]) || preg_match("/undefined/", $datos["nombre"])) {
            $retorno["mensaje"] = "Nombre del formato incorrecto: " . $datos["nombre"];
            echo (json_encode($retorno));
            die();
        }
    }
    // Field Banderas
    
    $fieldList = array();
    if (is_array($datos["banderas"])) {
        $fieldList["banderas"] = "'" . implode(",", $datos["banderas"]) . "'";
    }
    $fieldList["mostrar_pdf"] = $datos["mostrar_pdf"];

    // Field nombre
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["nombre"]) : $datos["nombre"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["nombre"] = $theValue;

    // Field firma_digital
    $theValue = ($datos["firma_digital"] != "") ? intval($datos["firma_digital"]) : 0;
    $fieldList["firma_digital"] = $theValue;

    // Field etiqueta
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["etiqueta"]) : $datos["etiqueta"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["etiqueta"] = htmlentities($theValue);

    // Field descripcion_formato
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["descripcion_formato"]) : $datos["descripcion_formato"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["descripcion_formato"] = ($theValue);

    // Field proceso al que pertenece
    $theValue = ($datos["proceso_pertenece"] != 0) ? intval($datos["proceso_pertenece"]) : 0;
    $fieldList["proceso_pertenece"] = $theValue;

    // Field version
    $theValue = ($datos["version"] != 0) ? intval($datos["version"]) : 0;
    $fieldList["version"] = $theValue;

    // Field version
    /*
     * $theValue = ($datos["documentacion"] != 0) ? intval($datos["documentacion"]) : 0;
     * $fieldList["documentacion"] = $theValue;
     */
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["form_uuid"]) : $datos["form_uuid"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["documentacion"] = ($theValue);
    $theValue = ($datos["anexos"] != 0) ? intval($datos["anexos"]) : 0;
    $anexos = $theValue;
    // $fieldList["documentacion"]=$theValue;

    // Field contador_idcontador
    $theValue = ($datos["contador_idcontador"] != 0) ? intval($datos["contador_idcontador"]) : crear_contador($datos["nombre"]);
    $fieldList["contador_idcontador"] = $theValue;
    // reinicio del contador
    
    if ($fieldList["contador_idcontador"]) {
        $reinicio = 0;
        if ($datos["reiniciar_contador"])
            $reinicio = 1;
        $sql = "update contador set reiniciar_cambio_anio=$reinicio where idcontador=" . $fieldList["contador_idcontador"];

        guardar_traza($sql, "ft_" . $datos["nombre"]);
        phpmkr_query($sql, $conn);
    }
   
    // Field Serie_idserie
    if ($datos["serie_idserie"] == "") { // crear la serie con el nombre del formato
        $nomb_serie_papa = busca_filtro_tabla("idserie", "serie", "lower(nombre) like 'administracion%formatos'", "", $conn);
        if ($nomb_serie_papa["numcampos"]) {
            $idserie_papa = $nomb_serie_papa[0]["idserie"];
        } else {
            $sql_serie_papa = "insert into serie(nombre,cod_padre,categoria) values('Administracion de Formatos',0,3)";
            guardar_traza($sql_serie_papa, $datos["nombre"]);
            phpmkr_query($sql_serie_papa, $conn);
            $idserie_papa = phpmkr_insert_id();
        }

        $nomb_serie = busca_filtro_tabla("idserie,cod_padre", "serie", "nombre like '" . $datos["etiqueta"] . "'", "", $conn);
        if ($nomb_serie["numcampos"]) {
            if ($nomb_serie[0]["cod_padre"] != $idserie_papa) {
                $update = "UPDATE serie SET cod_padre=" . $idserie_papa . " WHERE idserie=" . $nomb_serie[0]["idserie"];
                guardar_traza($update, $datos["nombre"]);
                phpmkr_query($update, $conn);
                $fieldList["serie_idserie"] = $nomb_serie[0]["idserie"];
            }
        } else {
            $sql_serie = "insert into serie(nombre,cod_padre,categoria) values('" . $datos["etiqueta"] . "'," . $idserie_papa . ",3)";
            $sql_export = array(
                "sql" => $sql_serie
            );
            guardar_traza($sql_serie, $datos["nombre"]);
            phpmkr_query($sql_serie);
            $fieldList["serie_idserie"] = phpmkr_insert_id();
        }
    } else { // otra serie elegida o sin serie
        $theValue = ($datos["serie_idserie"] != 0) ? intval($datos["serie_idserie"]) : 0;
        $fieldList["serie_idserie"] = $theValue;
    }

    if(!empty($datos["mostrar_tipodoc_pdf"])) {
        $fieldList["mostrar_tipodoc_pdf"] = $datos["mostrar_tipodoc_pdf"];
    } else {
        $fieldList["mostrar_tipodoc_pdf"] = 0;
    }

    /*
     * Se valida que si el tiempo que llega es menor de 3000 milisegundos se multiplica el valor por 60000 ya que se esta ingresando en minutos
     */
    if ($datos["tiempo_autoguardado"] < 3000) {
        $datos["tiempo_autoguardado"] = $datos["tiempo_autoguardado"] * 60000;
    }
    $fieldList["tiempo_autoguardado"] = $datos["tiempo_autoguardado"];

    $x_tabla = "ft_" . $datos["nombre"];
    $fieldList["nombre_tabla"] = "'" . $x_tabla . "'";

    // Field librerias
    $fieldList["librerias"] = "''";

    // Field margenes
    $fieldList["margenes"] = "'" . $datos["mizq"] * 10 . "," . $datos["mder"] * 10 . "," . $datos["msup"] * 10 . "," . $datos["minf"] * 10 . "'";
    // font_size
    $fieldList["font_size"] = $datos["font_size"];
    $fieldList["enter2tab"] = 0;

    // Field orientacion
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["orientacion"]) : $datos["orientacion"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["orientacion"] = $theValue;

    // Field papel
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["papel"]) : $datos["papel"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["papel"] = $theValue;

    // Field exportar
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["exportar"]) : $datos["exportar"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["exportar"] = $theValue;
    if (!is_dir($ruta_db_superior . "formatos/" . $datos["nombre"])) {
        mkdir($ruta_db_superior . "formatos/" . $datos["nombre"], 0777);
        $data = "adicionar_" . $datos["nombre"] . ".php
editar_" . $datos["nombre"] . ".php
buscar_" . $datos["nombre"] . ".php
buscar_" . $datos["nombre"] . "2.php
mostrar_" . $datos["nombre"] . ".php
detalles_mostrar_" . $datos["nombre"] . ".php";
        if (!intval($datos["pertenece_nucleo"])) {
            $data = '*';
        }

        file_put_contents($ruta_db_superior . "formatos/" . $datos["nombre"] . "/.gitignore", $data);
        chmod($ruta_db_superior . "formatos/" . $datos["nombre"] . "/.gitignore", PERMISOS_ARCHIVOS);
        /*
         * if(!file_put_contents($x_nombre . "/.gitignore", $data)) {
         * alerta("No se crea el archivo .gitignore para versionamiento");
         * }
         */
    }

    // Field cod_padre
    $theValue = ($datos["cod_padre"] != 0) ? intval($datos["cod_padre"]) : 0;
    $fieldList["cod_padre"] = $theValue;

    // Field Tipo Edicion continua
    $theValue = ($datos["tipo_edicion"] != 0) ? intval($datos["tipo_edicion"]) : 0;
    $fieldList["tipo_edicion"] = $theValue;

    $fieldList["mostrar"] = 1;

    // paginar en el mostrar
    $theValue = ($datos["paginar"] != 0) ? intval($datos["paginar"]) : 0;
    $fieldList["paginar"] = $theValue;

    // tipo detalle
    $theValue = ($datos["detalle"] != "") ? intval($datos["detalle"]) : 0;
    $fieldList["detalle"] = $theValue;
    // tipo item
    $fieldList["item"] = intval($datos["item"]);

    $fieldList["fk_categoria_formato"] = "'" . $datos["fk_categoria_formato"] . "'";
    // /Aqui se cambia si se quiere que se cargue desde el formulario, sin embargo la vinculacion real se hace por medio de la interfaz bpmn
    $fieldList["flujo_idflujo"] = 0;
    $fieldList["funcion_predeterminada"] = "'" . implode(",", $datos["funcion_predeterminada"]) . "'";

    $fieldList["ruta_mostrar"] = "'" . "mostrar_" . $datos["nombre"] . ".php'";
    $fieldList["ruta_editar"] = "'" . "editar_" . $datos["nombre"] . ".php'";
    $fieldList["ruta_adicionar"] = "'" . "adicionar_" . $datos["nombre"] . ".php'";
    $fieldList["funcionario_idfuncionario"] = usuario_actual("funcionario_codigo");
    $fieldList["pertenece_nucleo"] = intval($datos["pertenece_nucleo"]);
    $documentacion = $fieldList["documentacion"];
    // insert into database
    $sql_if = "INSERT INTO formato (";
    $sql_if .= implode(",", array_keys($fieldList));
    $sql_if .= ") VALUES (";
    $sql_if .= implode(",", array_values($fieldList));
    $sql_if .= ")";
    guardar_traza($sql_if, "ft_" . $datos["nombre"]);
    phpmkr_query($sql_if) or die("Falla al ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_if);

    $idformato = phpmkr_insert_id();
    
    if (!empty($idformato)) {
        if ($x_flujo_idflujo != 0) {
            generar_campo_flujo($idformato, $x_flujo_idflujo);
        }
        if (in_array("1", $datos["funcion_predeterminada"])) {
            vincular_funcion_responsables($idformato);
        }
        if (in_array("2", $datos["funcion_predeterminada"])) {
            vincular_funcion_digitalizacion($idformato);
        }
        if (in_array("3", $datos["funcion_predeterminada"])) {
            vincular_campo_anexo($idformato);
        }
        insertar_anexo_formato($idformato, $documentacion, $anexos);
        crear_modulo_formato($idformato);
    }
    if ($fieldList["cod_padre"] && $idformato) {

        $formato_padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fieldList["cod_padre"], "", $conn);
        $sql_icf1 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html,placeholder) VALUES (" . $idformato . ",'" . $formato_padre[0]["nombre_tabla"] . "', " . $fieldList["nombre"] . ", 'INT', 11, 1," . $fieldList["cod_padre"] . ", 'a','" . str_replace("'", "", $fieldList["etiqueta"]) . "(Formato padre)', 'fk', 'detalle','Formato padre')";
        guardar_traza($sql_icf1, "ft_" . $datos["nombre"]);
        phpmkr_query($sql_icf1) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf1);
    }
    if ($idformato && !$fieldList["item"]) {
        $sql_icf2 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'estado_documento', 'ESTADO DEL DOCUMENTO', 'VARCHAR', 255, 0,'', 'a','', '', 'hidden')";
        phpmkr_query($sql_icf2) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf2);

        $sql_icf3 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html,valor) VALUES (" . $idformato . ",'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1,'" . $fieldList["serie_idserie"] . "', 'a'," . $fieldList["etiqueta"] . ", 'fk', 'hidden','../../test/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1')";
        guardar_traza($sql_icf3, "ft_" . $datos["nombre"]);
        phpmkr_query($sql_icf3) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf3);
    }
    /*
     * Se validan y adicionan los campos adicionales al formato como iddocumento, serie_idserie, idft , etc
     */

    if ($idformato) {
        $retorno["adicionales"] = adicionar_pantalla_campos_formato($idformato, $fieldList);        
        $retorno["mensaje"] = "EL m&oacute;dulo se inserta con &eacute;xito";
        $retorno["idformato"] = $idformato;
        $retorno['exito'] = 1;
    } else {
        $retorno["error"] = "Error al insertar el Formato";
    }   
   
    if ($tipo_retorno == 1) {
        echo json_encode($retorno);
    } else {
        return $retorno;
    }
}

function crear_campo_bpmni($idpantalla) {
    if (!$idpantalla)
        $idpantalla = @$_REQUEST["idpantalla"];
    $campo = busca_filtro_tabla("", "pantalla_campos a", "a.pantalla_idpantalla=" . $idpantalla . " and nombre='fk_idbpmni'", "", $conn);
    if (!$campo["numcampos"]) {
        $pantalla = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $idpantalla, "", $conn);
        $tabla = '';
        if ($pantalla[0]["tipo_pantalla"] == 1) {
            $tabla = $pantalla[0]["nombre"];
        }
        $sql1 = "insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('" . $idpantalla . "', '" . $tabla . "', 'fk_idbpmni', 'Identificador instancia proceso " . $pantalla[0]["etiqueta"] . "', 'int', '11', '0', '2|idbpmni', 'a', 'Conector de la instancia BPMNI con la pantalla " . $pantalla[0]["etiqueta"] . "', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
        phpmkr_query($sql1) or die($sql1);
    }
    $campo = busca_filtro_tabla("", "pantalla_campos a", "a.pantalla_idpantalla=" . $idpantalla . " and nombre='fk_idbpmn_tarea'", "", $conn);
    if (!$campo["numcampos"]) {
        $pantalla = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $idpantalla, "", $conn);
        $tabla = '';
        if ($pantalla[0]["tipo_pantalla"] == 1) {
            $tabla = $pantalla[0]["nombre"];
        }
        $sql1 = "insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('" . $idpantalla . "', '" . $tabla . "', 'fk_idbpmn_tarea', 'Identificador tarea BPMN " . $pantalla[0]["etiqueta"] . "', 'int', '11', '0', '2|idbpmn_tarea', 'a', 'Conector de la instancia BPMN TAREA con la pantalla " . $pantalla[0]["etiqueta"] . "', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
        phpmkr_query($sql1) or die($sql1);
    }
}

function verificar_datos_clase_padre($idpantalla, $clase) {
    $where = '';
    $lcamposh = array();
    $datos_clase = busca_filtro_tabla("", "pantalla", "idpantalla=" . $clase, "", $conn);
    $dato = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $campos_heredados = busca_filtro_tabla("", "pantalla A, pantalla_campos B", "A.idpantalla=B.pantalla_idpantalla AND A.idpantalla=" . $idpantalla . " AND etiqueta_html ='campo_heredado'", "", $conn);
    for ($i = 0; $i < $campos_heredados["numcampos"]; $i++) {
        $campo_heredado = explode("|", $campos_heredados[$i]["valor"]);
        $where .= " AND idpantalla_campos<>" . $campo_heredado[0];
    }
    $nuevos_campos = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $clase . " AND banderas NOT LIKE '%pk%'" . $where, "", $conn);
    for ($i = 0; $i < $nuevos_campos["numcampos"]; $i++) {
        $existe_campo = busca_filtro_tabla("", "pantalla_campos A", "A.valor like '" . $nuevos_campos[$i]["idpantalla_campos"] . "|%' AND A.pantalla_idpantalla='" . $idpantalla . "'", "", $conn);
        if (!$existe_campo["numcampos"]) {
            $valor = $nuevos_campos[$i]["predeterminado"];
            if ($nuevos_campos[$i]["nombre"] == "numero") {
                $valor = '0';
            } else if ($nuevos_campos[$i]["nombre"] == "estado") {
                $valor = 'ACTIVO';
            } else if ($nuevos_campos[$i]["nombre"] == "fecha") {
                $valor = 'now()';
            } else if ($nuevos_campos[$i]["nombre"] == "fecha_creacion") {
                $valor = 'now()';
            } else if ($nuevos_campos[$i]["nombre"] == "pantalla_idpantalla") {
                $valor = $idpantalla;
            } else if ($nuevos_campos[$i]["nombre"] == "plantilla") {
                $valor = $dato[0]["nombre"];
            } else if ($nuevos_campos[$i]["nombre"] == "serie") {
                $valor = '0';
            }
            $sql2 = "INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $idpantalla . ",'','" . $nuevos_campos[$i]["nombre"] . "','" . $nuevos_campos[$i]["etiqueta"] . "','" . $nuevos_campos[$i]["tipo_dato"] . "','" . $nuevos_campos[$i]["longitud"] . "'," . $nuevos_campos[$i]["obligatoriedad"] . ",'" . $nuevos_campos[$i]["idpantalla_campos"] . "|2','" . $nuevos_campos[$i]["acciones"] . "','" . $nuevos_campos[$i]["ayuda"] . "','" . $valor . "','" . $nuevos_campos[$i]["banderas"] . "','campo_heredado',0,0,'" . $nuevos_campos[$i]["placeholder"] . "')";
            phpmkr_query($sql2) or die($sql2);
        }
    }
    $campo_enlace = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $idpantalla . " AND (nombre LIKE 'fk_id" . $datos_clase[0]["nombre"] . "' or nombre LIKE '" . $datos_clase[0]["nombre"] . "_id" . $datos_clase[0]["nombre"] . "')", "", $conn);
    if (!$campo_enlace["numcampos"]) {
        $sql2 = "INSERT INTO pantalla_campos(pantalla_idpantalla,tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $idpantalla . ",'" . $dato[0]["nombre"] . "','fk_id" . $datos_clase[0]["nombre"] . "','Identificador " . $datos_clase[0]["etiqueta"] . "','int','11',0,'','a','Identificador " . $datos_clase[0]["etiqueta"] . "','','','hidden',0,0,'fk_id" . $datos_clase[0]["nombre"] . "')";
        phpmkr_query($sql2) or die($sql2);
    }
}

function eliminar_datos_clase_padre($idpantalla, $clase) {
    $dato_clase = busca_filtro_tabla("", "pantalla", "idpantalla=" . $clase, "", $conn);
    if ($clase && $idpantalla) {
        $campos_clase_padre = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla = " . $clase, "", $conn);
        for ($i = 0; $i < $campos_clase_padre["numcampos"]; $i++) {
            $sql2 = "DELETE FROM pantalla_campos WHERE pantalla_idpantalla=" . $idpantalla . " AND etiqueta_html='campo_heredado' AND valor like '" . $campos_clase_padre[$i]["idpantalla_campos"] . "|%'";
            phpmkr_query($sql2);
        }
        if ($dato_clase["numcampos"]) {
            $sql2 = "DELETE FROM pantalla_campos WHERE pantalla_idpantalla=" . $idpantalla . " AND nombre LIKE 'fk_id" . $dato_clase[0]["nombre"] . "'";
            phpmkr_query($sql2);
        }
    }
}

function editar_datos_formato($datos, $tipo_retorno = 1) {
    global $ruta_db_superior;
    $retorno = array(
        "mensaje" => "Error al tratar de generar el adicionar de la pantalla",
        "exito" => 0
    );
    if (!$datos["idformato"]) {

        $retorno["mensaje"] = "Error al tratar de editar un formato sin identificador ";
        if ($tipo_retorno == 1) {
            die(json_encode($retorno));
        } else {
            return ($retorno);
        }
    } else {
        $buscar_formato = busca_filtro_tabla("", "formato", "idformato=" . $datos["idformato"], "", $conn);
        if ($buscar_formato["numcampos"]) {
            $datos["nombre"] = $buscar_formato[0]["nombre"];
        }
    }

    $fieldList = array();
    // Field Banderas
    if (is_array($datos["banderas"]))
        $fieldList["banderas"] = "'" . implode(",", $datos["banderas"]) . "'";

    $fieldList["mostrar_pdf"] = $datos["mostrar_pdf"];

    // Field firma_digital
    $theValue = ($datos["firma_digital"] != "") ? intval($datos["firma_digital"]) : 0;
    $fieldList["firma_digital"] = $theValue;

    // Field etiqueta
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["etiqueta"]) : $datos["etiqueta"];
    if(!empty($thevalue)) {
        $fieldList["etiqueta"] = htmlentities($theValue);
    }

    // Field descripcion_formato
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["descripcion_formato"]) : $datos["descripcion_formato"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["descripcion_formato"] = ($theValue);

    // Field proceso al que pertenece
    $theValue = ($datos["proceso_pertenece"] != 0) ? intval($datos["proceso_pertenece"]) : 0;
    $fieldList["proceso_pertenece"] = $theValue;

    // Field version
    $theValue = ($datos["version"] != 0) ? intval($datos["version"]) : 0;
    $fieldList["version"] = $theValue;

    // Field version
    /*
     * $theValue = ($datos["documentacion"] != 0) ? intval($datos["documentacion"]) : 0;
     * $fieldList["documentacion"] = $theValue;
     */

    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["form_uuid"]) : $datos["form_uuid"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["documentacion"] = ($theValue);
    $theValue = ($datos["anexos"] != 0) ? intval($datos["anexos"]) : 0;
    $anexos = $theValue;

    // Field contador_idcontador
    $theValue = ($datos["contador_idcontador"] != 0) ? intval($datos["contador_idcontador"]) : crear_contador($datos["nombre"]);
    $fieldList["contador_idcontador"] = $theValue;
    // reinicio del contador
    if ($fieldList["contador_idcontador"]) {
        $reinicio = 0;
        if ($datos["reiniciar_contador"])
            $reinicio = 1;
        $sql = "update contador set reiniciar_cambio_anio=$reinicio where idcontador=" . $fieldList["contador_idcontador"];

        guardar_traza($sql, "ft_" . $datos["nombre"]);
        phpmkr_query($sql, $conn);
    }

    // Field Serie_idserie
    if ($datos["serie_idserie"] == "") { // crear la serie con el nombre del formato
        $nomb_serie_papa = busca_filtro_tabla("idserie", "serie", "lower(nombre) like 'administracion%formatos'", "", $conn);
        if ($nomb_serie_papa["numcampos"]) {
            $idserie_papa = $nomb_serie_papa[0]["idserie"];
        } else {
            $sql_serie_papa = "insert into serie(nombre,cod_padre,categoria) values('Administracion de Formatos',0,3)";
            guardar_traza($sql_serie_papa, $datos["nombre"]);
            phpmkr_query($sql_serie_papa, $conn);
            $idserie_papa = phpmkr_insert_id();
        }

        $nomb_serie = busca_filtro_tabla("idserie,cod_padre", "serie", "nombre like '" . $datos["etiqueta"] . "'", "", $conn);
        if ($nomb_serie["numcampos"]) {
            if ($nomb_serie[0]["cod_padre"] != $idserie_papa) {
                $update = "UPDATE serie SET cod_padre=" . $idserie_papa . " WHERE idserie=" . $nomb_serie[0]["idserie"];
                guardar_traza($update, $datos["nombre"]);
                phpmkr_query($update, $conn);
                $fieldList["serie_idserie"] = $nomb_serie[0]["idserie"];
            }
        } else {
            $sql_serie = "insert into serie(nombre,cod_padre,categoria) values('" . $datos["etiqueta"] . "'," . $idserie_papa . ",3)";
            $sql_export = array(
                "sql" => $sql_serie
            );
            guardar_traza($sql_serie, $datos["nombre"]);
            phpmkr_query($sql_serie);
            $fieldList["serie_idserie"] = phpmkr_insert_id();
        }
    } else { // otra serie elegida o sin serie
        $theValue = ($datos["serie_idserie"] != 0) ? intval($datos["serie_idserie"]) : 0;
        $fieldList["serie_idserie"] = $theValue;
    }

    if(isset($datos["mostrar_tipodoc_pdf"]) && isset($datos["mostrar_tipodoc_pdf"]) && !empty($datos["mostrar_tipodoc_pdf"])) {
        $fieldList["mostrar_tipodoc_pdf"] = $datos["mostrar_tipodoc_pdf"];
    } else {
        $fieldList["mostrar_tipodoc_pdf"] = 0;
    }

    /*
     * Se valida que si el tiempo que llega es menor de 3000 milisegundos se multiplica el valor por 60000 ya que se esta ingresando en minutos
     */
    if ($datos["tiempo_autoguardado"] < 3000) {
        $datos["tiempo_autoguardado"] = $datos["tiempo_autoguardado"] * 60000;
    }
    $fieldList["tiempo_autoguardado"] = $datos["tiempo_autoguardado"];

    $x_tabla = "ft_" . $datos["nombre"];
    $fieldList["nombre_tabla"] = "'" . $x_tabla . "'";

    // Field librerias
    $fieldList["librerias"] = "''";

    // Field margenes
    $fieldList["margenes"] = "'" . $datos["mizq"] * 10 . "," . $datos["mder"] * 10 . "," . $datos["msup"] * 10 . "," . $datos["minf"] * 10 . "'";
    // font_size
    $fieldList["font_size"] = $datos["font_size"];
    $fieldList["enter2tab"] = 0;

    // Field orientacion
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["orientacion"]) : $datos["orientacion"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["orientacion"] = $theValue;

    // Field papel
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["papel"]) : $datos["papel"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["papel"] = $theValue;

    // Field exportar
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($datos["exportar"]) : $datos["exportar"];
    $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
    $fieldList["exportar"] = $theValue;
    if (!is_dir($ruta_db_superior . "formatos/" . $datos["nombre"])) {
        mkdir($ruta_db_superior . "formatos/" . $datos["nombre"], 0777);
        $data = "adicionar_" . $datos["nombre"] . ".php
editar_" . $datos["nombre"] . ".php
buscar_" . $datos["nombre"] . ".php
buscar_" . $datos["nombre"] . "2.php
mostrar_" . $datos["nombre"] . ".php
detalles_mostrar_" . $datos["nombre"] . ".php";
        if (!intval($datos["pertenece_nucleo"])) {
            $data = '*';
        }

        file_put_contents($ruta_db_superior . "formatos/" . $datos["nombre"] . "/.gitignore", $data);
        chmod($ruta_db_superior . "formatos/" . $datos["nombre"] . "/.gitignore", PERMISOS_ARCHIVOS);
        /*
         * if(!file_put_contents($x_nombre . "/.gitignore", $data)) {
         * alerta("No se crea el archivo .gitignore para versionamiento");
         * }
         */
    }

    // Field cod_padre
    $theValue = ($datos["cod_padre"] != 0) ? intval($datos["cod_padre"]) : 0;
    $fieldList["cod_padre"] = $theValue;

    // Field Tipo Edicion continua
    $theValue = ($datos["tipo_edicion"] != 0) ? intval($datos["tipo_edicion"]) : 0;
    $fieldList["tipo_edicion"] = $theValue;

    $fieldList["mostrar"] = 1;

    // paginar en el mostrar
    $theValue = ($datos["paginar"] != 0) ? intval($datos["paginar"]) : 0;
    $fieldList["paginar"] = $theValue;

    // tipo detalle
    $theValue = ($datos["detalle"] != "") ? intval($datos["detalle"]) : 0;
    $fieldList["detalle"] = $theValue;
    // tipo item
    $fieldList["item"] = intval($datos["item"]);

    $fieldList["fk_categoria_formato"] = "'" . $datos["fk_categoria_formato"] . "'";
    // /Aqui se cambia si se quiere que se cargue desde el formulario, sin embargo la vinculacion real se hace por medio de la interfaz bpmn
    $fieldList["flujo_idflujo"] = 0;
    $fieldList["funcion_predeterminada"] = "'" . implode(",", $datos["funcion_predeterminada"]) . "'";

    $fieldList["ruta_mostrar"] = "'" . "mostrar_" . $datos["nombre"] . ".php'";
    $fieldList["ruta_editar"] = "'" . "editar_" . $datos["nombre"] . ".php'";
    $fieldList["ruta_adicionar"] = "'" . "adicionar_" . $datos["nombre"] . ".php'";
    $fieldList["funcionario_idfuncionario"] = usuario_actual("funcionario_codigo");
    $fieldList["pertenece_nucleo"] = intval($datos["pertenece_nucleo"]);
    $documentacion = $fieldList["documentacion"];
    // UPDATE
    $strsql = "UPDATE formato SET ";
    $strsql_array = array();
    foreach ($fieldList as $key => $value) {
        if($key == "etiqueta" && (empty($value) || preg_match("/NULL/", $value))) {
            continue;
        }
        array_push($strsql_array, $key . " = " . $value);
    }
    $strsql .= implode(",", $strsql_array) . " WHERE idformato=" . $datos["idformato"];
    // $retorno["documentacion"]=$idformato." - ".$documentacion." - ".$anexos;
    guardar_traza($strsql, "ft_" . $datos["nombre"]);

    phpmkr_query($strsql) or die("Falla al ejecutar " . phpmkr_error() . ' SQL:' . $strsql);
    // $retorno["documentacion"]=$datos["idformato"]." - ".$documentacion." - ".$anexos;
    $retorno["documentacion"] = insertar_anexo_formato($datos["idformato"], $documentacion, $anexos);

    $idformato = $datos["idformato"];
    if ($idformato != '') {

        if ($x_flujo_idflujo != 0) {
            generar_campo_flujo($idformato, $x_flujo_idflujo);
        }
        if (in_array("1", $datos["funcion_predeterminada"])) {
            vincular_funcion_responsables($idformato);
        }
        if (in_array("2", $datos["funcion_predeterminada"])) {
            vincular_funcion_digitalizacion($idformato);
        }
        if (in_array("3", $datos["funcion_predeterminada"])) {
            vincular_campo_anexo($idformato);
        }
        // $retorno["documentacion"]=$idformato." - ".$documentacion." - ".$anexos;
        // insertar_anexo_formato($idformato,$documentacion,$anexos);
        crear_modulo_formato($idformato);
    }

    if ($fieldList["cod_padre"] && $idformato) {

        $formato_padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fieldList["cod_padre"], "", $conn);
        $strsql_icf = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html,placeholder) VALUES (" . $idformato . ",'" . $formato_padre[0]["nombre_tabla"] . "', " . $fieldList["nombre"] . ", 'INT', 11, 1," . $fieldList["cod_padre"] . ", 'a','" . str_replace("'", "", $fieldList["etiqueta"]) . "(Formato padre)', 'fk', 'detalle','Formato padre')";
        guardar_traza($strsql_icf, "ft_" . $datos["nombre"]);
        phpmkr_query($strsql_icf) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $strsql_icf);
    }
    if ($idformato && !$fieldList["item"]) {
        $strsql_icf2 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'estado_documento', 'ESTADO DEL DOCUMENTO', 'VARCHAR', 255, 0,'', 'a','', '', 'hidden')";
        //TODO: Verificar existencia del campo
        //phpmkr_query($strsql_icf2) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $strsql_icf2);

        $strsql_icf3 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1," . $fieldList["serie_idserie"] . ", 'a'," . $fieldList["etiqueta"] . ", 'fk', 'hidden')";
        //TODO: Verificar existencia del campo
        //guardar_traza($strsql_icf3, "ft_" . $datos["nombre"]);
        //phpmkr_query($strsql_icf3) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $strsql_icf3);
    }
    /*
     * Se validan y adicionan los campos adicionales al formato como iddocumento, serie_idserie, idft , etc
     */

    if ($datos["idformato"]) {
        $retorno["adicionales"] = adicionar_pantalla_campos_formato($idformato, $fieldList);
        $retorno["mensaje"] = "EL m&oacute;dulo se inserta con &eacute;xito";
        $retorno["idformato"] = $datos["idformato"];
        $retorno['exito'] = 1;
    } else {
        $retorno["error"] = "Error al insertar el Formato";
        ;
    }

    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function editar_datos_pantalla($datos, $tipo_retorno = 1) {
    global $conn;
    if ($datos["idpantalla"]) {
        $pantalla_actual = busca_filtro_tabla("", "pantalla A, pantalla_campos B", "A.idpantalla=B.pantalla_idpantalla AND B.pantalla_idpantalla=" . $datos["idpantalla"], "", $conn);
        $sql_update_datos_pantalla = "UPDATE pantalla SET nombre='" . $datos['nombre'] . "', librerias = '" . $datos['librerias'] . "', etiqueta = '" . $datos['etiqueta'] . "', funcionario_idfuncionario='" . $_SESSION['idfuncionario']. "', ayuda='" . $datos['ayuda'] . "',banderas='" . $datos['banderas'] . "' ,tiempo_autoguardado ='" . $datos['tiempo'] . "',tipo_pantalla='" . $datos["tipo_pantalla"] . "',ruta_pantalla='" . $datos["ruta_pantalla"] . "',cod_padre='" . $datos["cod_padre"] . "',clase='" . $datos["clase"] . "', prefijo='" . $datos["prefijo"] . "', ruta_almacenamiento='" . $datos["ruta_almacenamiento"] . "',aprobacion_automatica='" . $datos["aprobacion_automatica"] . "',fk_idpantalla_categoria = '" . $datos["fk_categoria_formato"] . "',versionar='" . $datos["versionar"] . "',accion_eliminar='" . $datos["accion_eliminar"] . "' WHERE idpantalla =" . $datos['idpantalla'];
        phpmkr_query($sql_update_datos_pantalla);
        // crear_campo_padre($datos['idpantalla'],$datos["cod_padre"]);
        // crear_campo_bpmni($datos['idpantalla']);
        $pantalla_campos = busca_filtro_tabla("", "pantalla_campos A", "A.pantalla_idpantalla=" . $datos["idpantalla"] . " AND nombre='id" . $datos["nombre"] . "'", "", $conn);
        if (!$pantalla_campos["numcampos"]) {
            $sql2 = "INSERT INTO pantalla_campos(pantalla_idpantalla,tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $datos["idpantalla"] . ",'" . $datos["nombre"] . "','id" . $datos["nombre"] . "','Identificador " . $datos["etiqueta"] . "','INT','11',0,'','a','Identificador " . $datos["etiqueta"] . "','','pk','hidden',0,0,'id" . $datos["nombre"] . "')";
            phpmkr_query($sql2) or die($sql2);
        }
        if ($pantalla_actual["numcampos"]) {
            if ($datos["clase"] != $pantalla_actual[0]["clase"]) {
                eliminar_datos_clase_padre($datos["idpantalla"], $pantalla_actual[0]["clase"]);
                if ($datos["clase"]) {
                    verificar_datos_clase_padre($datos["idpantalla"], $datos["clase"]);
                }
            } else if ($datos["clase"]) {
                verificar_datos_clase_padre($datos["idpantalla"], $datos["clase"]);
            }
            if ($datos["tipo_pantalla"] == 2) {
                adicionar_pantalla_campos_formato($pantalla_actual[0]["pantalla_idpantalla"], $datos);
            }
            // Se valida que los datos de la pantalla actual no se modifiquen de un formato a otras pantallas
            if (($datos["tipo_pantalla"] !== 2) && $pantalla_actual[0]["tipo_pantalla"] == 2) {
                eliminar_pantalla_campos_formato($pantalla_actual[0]["pantalla_idpantalla"]);
            }
        }
        $idmodulo = crear_modulo_formato($datos["idpantalla"]);
        if ($idmodulo) {
            $retorno["mensaje"] = "EL m&oacute;dulo se actualiza con &eacute;xito";
            $retorno["idmodulo"] = $modulo;
        } else {
            $retorno["error"] = "Error al insrtar el m&oacute;dulo";
        }
        $retorno['exito'] = 1;
        $retorno['sql'] = $sql_update_datos_pantalla;
        $retorno['idpantalla'] = $datos['idpantalla'];
    } else {
        $retorno['exito'] = 0;
        $retorno['mensaje'] = "Error editar la pantalla datos no encontrados";
    }

    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function crear_campo_padre($idpantalla, $idpadre) {
    if (!$idpadre)
        $idpadre = @$_REQUEST["idpadre"];
    if (!$idpantalla)
        $idpantalla = @$_REQUEST["idpantalla"];
    $padre = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $idpadre, "", $conn);
    if ($padre["numcampos"]) {
        $campo = busca_filtro_tabla("", "pantalla_campos a", "a.pantalla_idpantalla=" . $idpantalla . " and nombre='fk_id" . $padre[0]["nombre"] . "' and etiqueta_html='conector_hidden'", "", $conn);
        if (!$campo["numcampos"]) {
            $pantalla = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $idpantalla, "", $conn);
            // SE ELIMINARON LAS LINEAS QUE VALIDABAN EL MOTOR VERIFICAR PARA QUE O ASEGURARSE DE BORRARLAS
            /*
             * if(MOTOR=="MySql"){
             * $sql1="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('".$idpantalla."', '".$pantalla[0]["nombre"]."', 'fk_id".$padre[0]["nombre"]."', 'Codigo padre ".$padre[0]["etiqueta"]."', 'varchar', '255', '0', '2|id".$padre[0]["nombre"]."', 'a', 'Conector de un registro con otro', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
             * }
             * else if(MOTOR=="Oracle"){
             * $sql1="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('".$idpantalla."', '".$pantalla[0]["nombre"]."', 'fk_id".$padre[0]["nombre"]."', 'Codigo padre ".$padre[0]["etiqueta"]."', 'varchar2', '255', '0', '2|id".$padre[0]["nombre"]."', 'a', 'Conector de un registro con otro', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
             * }
             * else if(MOTOR=="SqlServer"){
             * $sql1="insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('".$idpantalla."', '".$pantalla[0]["nombre"]."', 'fk_id".$padre[0]["nombre"]."', 'Codigo padre ".$padre[0]["etiqueta"]."', 'nvarchar', '255', '0', '2|id".$padre[0]["nombre"]."', 'a', 'Conector de un registro con otro', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
             * }
             */
            $sql1 = "insert into pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, mascara, adicionales, autoguardado, fila_visible, placeholder)values('" . $idpantalla . "', '" . $pantalla[0]["nombre"] . "', 'fk_id" . $padre[0]["nombre"] . "', 'Codigo padre " . $padre[0]["etiqueta"] . "', 'varchar', '255', '0', '2|id" . $padre[0]["nombre"] . "', 'a', 'Conector de un registro con otro', '', '', 'conector_hidden', '1', '', '', '0', '0', '')";
            phpmkr_query($sql1) or die($sql1);
        }
    } else {
        $campo = busca_filtro_tabla("", "pantalla_campos a", "pantalla_idpantalla=" . $idpantalla . " and nombre like 'fk_id%' and etiqueta_html='conector_hidden'", "", $conn);
        if ($campo["numcampos"]) {
            $sql1 = "delete from pantalla_campos where idpantalla_campos=" . $campo[0]["idpantalla_campos"];
            phpmkr_query($sql1);
        }
    }
}

function load_componentes($tipo_retorno) {
    global $conn;
    $texto = '';
    $where = '';
    $retorno = array(
        "exito" => 0
    );
    if (@$_REQUEST["categoria"]) {
        $where = " AND lower(categoria)='" . strtolower($_REQUEST["categoria"]) . "'";
    }
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $_REQUEST["idpantalla"], "", $conn);
    // valida que el tipo de pantalla sea diferente de formato
    if ($pantalla["numcampos"] && $pantalla[0]["tipo_pantalla"] != 2) {
        $where .= " AND lower(categoria)<>'documento'";
    }
    $categorias = busca_filtro_tabla("categoria, nombre", "pantalla_componente", "estado=1" . $where, "GROUP BY categoria ORDER BY orden", $conn);
    if ($categorias["numcampos"]) {
        $retorno["exito"] = 1;
        $texto = '<div class="accordion" id="acordion_componentes">';
        for ($i = 0; $i < $categorias["numcampos"]; $i++) {
            $texto .= '<div class="accordion-group"><div class="accordion-heading">';
            $texto .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_componentes" href="#categoria_' . $categorias[$i]["nombre"] . '">';
            $texto .= $categorias[$i]["categoria"];
            $texto .= '</a>';
            $texto .= '</div>';
            // $texto .= '<div id="categoria_' . $categorias[$i]["nombre"] . '" class="accordion-body collapse"><div class="accordion-inner">';
            $texto .= '<div id="categoria_' . $categorias[$i]["nombre"] . '" class="accordion-body"><div class="accordion-inner">';
            $texto .= llena_componentes($categorias[$i]["categoria"]);
            $texto .= '</div>';
            $texto .= '</div>';
            $texto .= '</div>';
        }
        $texto .= '</div>';
    }
    $retorno["codigo_html"] = $texto;
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function llena_componentes($nombre) {
    global $conn;
    $texto = '';
    $componentes = busca_filtro_tabla("idpantalla_componente, clase, etiqueta", "pantalla_componente", "estado=1 AND lower(categoria)='" . strtolower($nombre) . "'", "etiqueta ASC", $conn);

    if ($componentes["numcampos"]) {
        for ($i = 0; $i < $componentes["numcampos"]; $i++) {
            $etiqueta = htmlentities(html_entity_decode(utf8_encode($componentes[$i]["etiqueta"])));
            $texto .= '<div class="component" idpantalla_componente="' . $componentes[$i]["idpantalla_componente"] . '">';
            $texto .= '<span class="' . $componentes[$i]["clase"] . ' fa-fw"></span>&nbsp;' . $etiqueta . '</div>';
        }
    }
    return ($texto);
}

function generar_adicionar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $retorno = array(
        "mensaje" => "Error al tratar de generar el adicionar de la pantalla",
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        $nombre_archivo = $ruta_carpeta . "/adicionar_" . $pantalla[0]["nombre"] . ".php";
        vincular_librerias_componente($pantalla);
        $texto_pantalla = encabezado_pantalla($pantalla);
        $texto_pantalla .= encabezado_pantalla_adicionar($pantalla);
        $texto_pantalla .= load_pantalla($idpantalla, 1, "adicionar");
        $texto_pantalla .= footer_pantalla($pantalla, "adicionar");
        $texto_pantalla .= generar_validaciones_formulario($pantalla, "set_" . $pantalla[0]["nombre"], "adicionar");
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($nombre_archivo,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_adicionar: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function generar_atributos($campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= 'var $' . $valor . ';
    var $idpantalla_' . $valor . ';
		var $campos_' . $valor . ';
    var $id' . $valor . ";\n";
        }
    }
    $texto_pantalla .= '    var $nombre_pantalla;' . "\n\n";
    return ($texto_pantalla);
}

function generar_constructor($pantalla, $campos_pantalla) {
    global $conn;
    $texto_pantalla = '';
    $texto_pantalla .= 'public function __construct(){' . "\n";
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    if ($pantalla[0]["clase"]) {
        $clase = busca_filtro_tabla("", "pantalla", "idpantalla=" . $pantalla[0]["clase"], "", $conn);
        if ($clase["numcampos"]) {
            $texto_pantalla .= 'parent::__construct();' . "\n";
        }
    }
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= '$this->campos_' . $valor . '=array();' . "\n";
        }
    }
    $texto_pantalla .= '$this->get_campos_' . $pantalla[0]["nombre"] . '();' . "\n";
    $texto_pantalla .= '$this->idpantalla_' . $pantalla[0]["nombre"] . '=' . $pantalla[0]["idpantalla"] . ';
$this->nombre_pantalla=' . $pantalla[0]["nombre"] . ';
}' . "\n";
    return ($texto_pantalla);
}

function generar_destructor($pantalla) {
    global $conn;
    $texto_pantalla = '';
    $texto_pantalla .= 'public function __destruct(){';
    if ($pantalla[0]["clase"]) {
        $clase = busca_filtro_tabla("", "pantalla", "idpantalla=" . $pantalla[0]["clase"], "", $conn);
        if ($clase["numcampos"]) {
            $texto_pantalla .= 'parent::__destruct();' . "\n";
        }
    }
    $texto_pantalla .= '}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_set($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= ' public function set_' . $pantalla[0]["nombre"] . '($validar=1,$set_type="request",$data=null){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al guardar ' . $pantalla[0]["etiqueta"] . '";
    $exito=1;' . "\n";
    $texto_pantalla .= 'if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros";
    return($retorno);
  }';
    // se define el tipo de datos en el que se recibe la informacion para realizar la carga en las tabla, tipo=request, tipo=json

    // 1->Es el momento anterior
    $texto_funcion = bloque_codigo_funciones($pantalla, "adicionar", 1, "php");
    if ($texto_funcion)
        $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";

    $texto_pantalla .= 'if($set_type=="request"){
    $datos_set=$_REQUEST;
  } else if($set_type=="json" && $data){
    $datos_set=(array)json_decode($data);
  }';
    if ($pantalla[0]["clase"]) {
        $clase = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $pantalla[0]["clase"], "", $conn);
        $nombres_campos = extrae_campo($campos_pantalla, "nombre", 'U,m');
        $texto_pantalla .= '
		$this->set_' . $clase[0]["nombre"] . '(0);
		if($this->id' . $clase[0]["nombre"] . '){
		';
        if (in_array("fk_id" . $clase[0]["nombre"], $nombres_campos)) {
            $texto_pantalla .= '$datos_set["fk_id' . $clase[0]["nombre"] . '"]=$this->id' . $clase[0]["nombre"] . ';
		';
        }
        if (in_array($clase[0]["nombre"] . "_id" . $clase[0]["nombre"], $nombres_campos)) {
            $texto_pantalla .= '$datos_set["' . $clase[0]["nombre"] . '_id' . $clase[0]["nombre"] . '"]=$this->id' . $clase[0]["nombre"] . ';
		';
        }
    }
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $valor = strtolower($valor);
            $texto_pantalla .= '$valores_' . $valor . '=array();' . "\n";
            $texto_pantalla .= '$campos_temp=array();' . "\n";

            $texto_pantalla .= 'foreach($this->campos_' . $valor . ' AS $key=>$campo){
        if($key!="" && isset($datos_set[$key])){
          if(is_array($datos_set[$key])){
            $valor_request=implode(",",$datos_set[$key]);
          }
          else{
            $valor_request=$datos_set[$key];
          }
        }
        else{
        	if($campo["predeterminado"]){
        		$valor_request=$campo["predeterminado"];
        	}
					else{
          	$valor_request="";
					}
        }
				if($campo["tipo_dato"]=="datetime"){
					if($valor_request=="now()"){
						$valor_request=date("Y-m-d H:i:s");
					}
					$valor_request=fecha_db_obtener("\'".$valor_request."\'","Y-m-d H:i:s");
				}
				else if($campo["tipo_dato"]=="date"){
					if($valor_request=="now()"){
						$valor_request=date("Y-m-d");
					}
					$valor_request=fecha_db_obtener("\'".$valor_request."\'","Y-m-d");
				}
				else{
					$valor_request="\'".$valor_request."\'";
				}
        array_push($campos_temp,$key);
        array_push($valores_' . $valor . ',htmlentities($valor_request));
      }' . "\n";
            // Valida el tipo de pantalla 1->sistema o standar,2->Formato,3->Auxiliar
            if ($pantalla[0]["tipo_pantalla"] != 3) {
                $texto_pantalla .= '$sql_' . $valor . '="INSERT INTO ' . $valor . '(".implode(",",$campos_temp).")VALUES(".implode(",",$valores_' . $valor . ').")";
        phpmkr_query($sql_' . $valor . ');' . "\n";
                $texto_pantalla .= '$this->get_' . $valor . '(phpmkr_insert_id());' . "\n";

                $texto_pantalla .= '
      if(!$this->id' . $valor . '){
        $exito=0;
        $retorno->mensaje.="<br>".$sql_' . $valor . ';
        ';
            }
            // 3->Es el momento error
            $texto_funcion = bloque_codigo_funciones($pantalla, "adicionar", 3, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            if ($pantalla[0]["tipo_pantalla"] != 3) {
                $texto_pantalla .= '}';
            }
        }
    }
    if ($pantalla[0]["clase"]) {
        $texto_pantalla .= '
		}
		else{
			$exito=0;
			$retorno->mensaje="Error al guardar en ' . $clase[0]["etiqueta"] . '";
		}
		';
    }
    $texto_pantalla .= '
  if($exito){' . "\n";
    $texto_pantalla .= '$retorno->exito=1;' . "\n";
    foreach ($tablas as $key => $valor) {
        $texto_pantalla .= '$retorno->id' . $valor . '=$this->id' . $valor . ";\n";
    }
    if ($pantalla[0]["tipo_pantalla"] == 2) {
        $texto_pantalla .= '$retorno->documento_iddocumento=$this->get_valor_' . $pantalla[0]["nombre"] . '("' . $pantalla[0]["nombre"] . '","documento_iddocumento");' . "\n";
        $texto_pantalla .= '$this->registrar_descripcion();' . "\n";
        // $texto_pantalla .= '$this->indexar_elasticsearch();'."\n";
    }
    /*
     * if(strpos($pantalla[0]["nombre"],"bpmn")===FALSE){
     * $texto_pantalla.='$this->validar_bpmni("adicionar");';
     * }
     */
    $texto_pantalla .= '$retorno->mensaje="' . $pantalla[0]["etiqueta"] . ' guardada con &eacute;xito";' . "\n";

    // Aqui va todo lo que debe hacerse como documento
    if ($pantalla[0]["tipo_pantalla"] == 2) {
        /* $texto_pantalla .= 'aprobar_documento($this->iddocumento,' . $pantalla[0]["aprobacion_automatica"] . ');' . "\n"; */
        $texto_pantalla .= '$this->radicar_documento();' . "\n";
    }
    // 2->Es el momento posterior
    $texto_funcion = bloque_codigo_funciones($pantalla, "adicionar", 2, "php");
    if ($texto_funcion)
        $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";

    $texto_pantalla .= '
  }
  return($retorno);
}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_insert_busqueda_temp($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= 'public function insert_busqueda_temp_' . $pantalla[0]["nombre"] . '($validar=1){
    global $conn, $ruta_db_superior;
    $retorno=new stdClass;
    $retorno->exito=0;
    $retorno->mensaje="Error al almacenar los datos de la busqueda de ' . $pantalla[0]["etiqueta"] . '";
    $exito=1;' . "\n";
    $texto_pantalla .= 'if(!$this->validar_insert() && $validar){
    $exito=0;
    $retorno->mensaje="Tratando de almacenar varias veces los registros";
    return($retorno);
  }';
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $valor = strtolower($valor);
            $texto_pantalla .= '$valores_' . $valor . '=array();' . "\n";
            $texto_pantalla .= '$campos_temp=array();' . "\n";
            // 1->Es el momento anterior
            $texto_funcion = bloque_codigo_funciones($pantalla, "buscar", 1, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion . '
      $cadena_condicion="";
      $retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";

            $texto_pantalla .= '
      if(@$_REQUEST["idbusqueda_componente"]){
        $busqueda_componente[0]["idbusqueda_componente"]=$_REQUEST["idbusqueda_componente"];
        $busqueda_componente["numcampos"]=1;
      }
      else{
        $busqueda_componente=busca_filtro_tabla("","busqueda_componente","nombre LIKE \'pantalla_' . $pantalla[0]["nombre"] . '\'","",$conn);
      }
      $cant_campos=count($this->campos_' . $valor . ');
    if($busqueda_componente["numcampos"]){
      $k=0;
      foreach($this->campos_' . $valor . ' AS $key=>$campo){
        if($key!="" && @$_REQUEST[$key]!==""){
          if(is_array($_REQUEST[$key])){
            $valor_request=implode(",",$_REQUEST[$key]);
          }
          else{
            $valor_request=$_REQUEST[$key];
          }
          //////////////////TODO: Agrupacion de condiciones
          if(@$_REQUEST["bqsaiacondicion_".$key] && @$_REQUEST["bqsaiaenlace_".$key]){
            if($k){
              $cadena_condicion.="|".$_REQUEST["bqsaiaenlace_".$key]."|";
            }
            $cadena_condicion.="lower(".$key.")|".$_REQUEST["bqsaiacondicion_".$key]."|(".strtolower($_REQUEST[$key]).")";
            $k++;
          }
        }
      }
' . "\n";
            // Valida el tipo de pantalla 1->sistema o standar,2->Formato,3->Auxiliar
            if ($pantalla[0]["tipo_pantalla"] != 3) {
                $texto_pantalla .= '$sql_' . $valor . '="INSERT INTO busqueda_filtro_temp(fk_busqueda_componente,funcionario_idfuncionario,fecha,detalle)VALUES(".$busqueda_componente[0]["idbusqueda_componente"].",\'".usuario_actual("funcionario_codigo")."\',".fecha_db_obtener("\'".date("Y-m-d H:i:s")."\'","Y-m-d H:i:s").",\'".$cadena_condicion."\')";
        phpmkr_query($sql_' . $valor . ');' . "\n";
                $texto_pantalla .= '$idbusqueda_temp=phpmkr_insert_id();' . "\n";

                $texto_pantalla .= '
      if(!$idbusqueda_temp){
        $exito=0;
        $retorno->mensaje.="<br>".$sql_' . $valor . ';
      }';
            }
            // 3->Es el momento error
            $texto_funcion = bloque_codigo_funciones($pantalla, "buscar", 3, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            $texto_pantalla .= '}';
        }
    }
    $texto_pantalla .= '
  if($exito){' . "\n";
    $texto_pantalla .= '$retorno->exito=1;' . "\n";
    $texto_pantalla .= '$retorno->idbusqueda_temp=$idbusqueda_temp' . ";\n";
    $texto_pantalla .= '$retorno->mensaje="' . $pantalla[0]["etiqueta"] . ' guardada con &eacute;xito";' . "\n";
    // 2->Es el momento posterior
    $texto_funcion = bloque_codigo_funciones($pantalla, "buscar", 2, "php");
    if ($texto_funcion)
        $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
    $texto_pantalla .= '
  }
  return($retorno);
}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_validar_insert() {
    $texto_pantalla = '';
    $texto_pantalla .= 'public function validar_insert(){' . "\n";
    $texto_pantalla .= 'if(isset($_SESSION["key_formulario_saia"])){
  if ($_REQUEST["key_formulario_saia"] === $_SESSION["key_formulario_saia"]) {
    return false;
  }
  else {
    $_SESSION["key_formulario_saia"] = $_REQUEST["key_formulario_saia"];
    return true;
  }
}
else {
  $_SESSION["key_formulario_saia"] = $_REQUEST["key_formulario_saia"];
  return true;
}
}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_existe($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $texto_pantalla .= 'public function existe_' . $pantalla[0]["nombre"] . '(){';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= '
    if(!$this->' . $valor . '["numcampos"]){
      return(false);
    }' . "\n";
        }
    }
    $texto_pantalla .= 'return(true);
}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_get_campos($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= 'public function get_campos_' . $pantalla[0]["nombre"] . '() {' . "\n";
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= '$campos_temp=busca_filtro_tabla("","pantalla_campos","tabla=\'' . $valor . '\' AND tabla<>\'\'","orden",$conn);
        for($i=0;$i<$campos_temp["numcampos"];$i++){
            $this->campos_' . $valor . '[$campos_temp[$i]["nombre"]]=$campos_temp[$i];
        }' . "\n";
        }
    }
    $texto_pantalla .= "    }\n";
    return ($texto_pantalla);
}

function generar_metodo_get_campo($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= 'public function get_campo_' . $valor . '($nombre){' . "\n";
            $texto_pantalla .= 'if($this->campos_' . $valor . '!=""){
        return($this->campos_' . $valor . '[$nombre]);
      }
      else{
        return($nombre);
      }
      }' . "\n";
        }
    }
    return ($texto_pantalla);
}

function generar_metodo_get_valor($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_pantalla .= 'public function get_valor_' . $valor . '($tabla,$nombre_campo){' . "\n";
            $texto_pantalla .= 'if($tabla=="' . $valor . '" && $this->' . $valor . '["numcampos"]){
      return($this->' . $valor . '[0][$nombre_campo]);
  }
  else{';
            $texto_pantalla .= 'return($this->campos_' . $valor . '[$nombre_campo]["predeterminado"]);
  }' . "\n";
            $texto_pantalla .= '}' . "\n";
        }
    }
    return ($texto_pantalla);
}

function generar_metodo_update($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $texto_parametro = array();
    $texto_cuerpo = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= 'public function update_' . $pantalla[0]["nombre"] . '($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al actualizar ' . $pantalla[0]["etiqueta"] . '";
$exito=0;' . "\n";
    // se define el tipo de datos en el que se recibe la informacion para realizar la carga en las tabla, tipo=request, tipo=json
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_funcion = bloque_codigo_funciones($pantalla, "editar", 1, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion;
            $texto_pantalla .= 'if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["id' . $valor . '"]=$datos_set["id' . $valor . '"];
    }';
            $texto_pantalla .= 'if($_REQUEST["id' . $valor . '"]){';

            $texto_pantalla .= '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            $texto_pantalla .= '$sql2="UPDATE ' . $valor . ' SET ";
$valor_update=array();
foreach($this->campos_' . $valor . ' AS $key=>$value){
  if($key!="" && isset($datos_set[$key])){
    $valor_request="";
    if(is_array($datos_set[$key])){
      $valor_request=$key."=\'".implode(",",$datos_set[$key])."\'";
    }
    else{
      $valor_request=$key."=\'".$datos_set[$key]."\'";
    }
    array_push($valor_update,htmlentities($valor_request));
  }
}
$sql2.= implode(",",$valor_update);
$sql2.= " WHERE id' . $valor . '=".$_REQUEST["id' . $valor . '"];
$retorno->sql_' . $valor . '=$sql2;
phpmkr_query($sql2);
$exito=1;
$this->get_' . $valor . '($_REQUEST["id' . $valor . '"]);
}
if($exito){';
            $texto_pantalla .= '$retorno->exito=1;
  $retorno->mensaje="Pantalla ' . $pantalla[0]["etiqueta"] . ' actualizado con &eacute;xito";';
            /*
             * if(strpos($pantalla[0]["nombre"],"bpmn")===FALSE){
             * $texto_pantalla.='$this->validar_bpmni("editar");';
             * }
             */
            $texto_funcion = bloque_codigo_funciones($pantalla, "editar", 2, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            if ($pantalla[0]["tipo_pantalla"] == 2) {
                // $texto_pantalla .= '$this->indexar_elasticsearch();'."\n";
            }
            $texto_pantalla .= '
}
return($retorno);' . "\n";
        }
    }
    $texto_pantalla .= '}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_delete($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $texto_parametro = array();
    $texto_cuerpo = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= 'public function delete_' . $pantalla[0]["nombre"] . '($set_type="request",$data=null){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al Eliminar ' . $pantalla[0]["etiqueta"] . '";
$exito=0;' . "\n";
    // se define el tipo de datos en el que se recibe la informacion para realizar la carga en las tabla, tipo=request, tipo=json
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $texto_funcion = bloque_codigo_funciones($pantalla, "eliminar", 1, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion;
            $texto_pantalla .= 'if($set_type=="request"){
      $datos_set=$_REQUEST;
    } else if($set_type=="json" && $data){
      $datos_set=(array)json_decode($data);
      $_REQUEST["id' . $valor . '"]=$datos_set["id' . $valor . '"];
    }';
            $texto_pantalla .= 'if($_REQUEST["id' . $valor . '"]){';

            $texto_pantalla .= '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            // AQUI FALTAN LAS OPCIONES DE ELIMINAR POR EJEMPLO Se debe sacar el insert SQL para restauración, se debe hacer un zip con los datos que se eliminan, se debe adicionar en la pantalla la opción de borrar en cascada, para eliminar todos los datos de los hijos, Para los formatos se deben eliminar los documentos y demás relacionados
            // Como politica todo lo que se deba inactivar como metodo de eliminacion se debe hacer sobre el campo estado, el campo estaod debe existir y el estado de incativacion debe ser siempre 0.
            if ($pantalla[0]["accion_eliminar"] == 1) {
                $texto_pantalla .= '$sql2="DELETE FROM ' . $valor . '";
$sql2.= " WHERE id' . $valor . '=".$_REQUEST["id' . $valor . '"];';
            } else {
                $texto_pantalla .= 'if($this->campos_funcionario["estado"]){';
                $texto_pantalla .= '	$sql2="UPDATE ' . $valor . ' SET estado=0 WHERE id' . $valor . '=".$_REQUEST["id' . $valor . '"];
				}';
            }
            $texto_pantalla .= '
$retorno->sql_' . $valor . '=$sql2;
phpmkr_query($sql2);
$exito=1;
}
if($exito){';
            $texto_pantalla .= '$retorno->exito=1;
  $retorno->mensaje="Pantalla ' . $pantalla[0]["etiqueta"] . ' borrado con &eacute;xito";';
            $texto_funcion = bloque_codigo_funciones($pantalla, "eliminar", 2, "php");
            if ($texto_funcion)
                $texto_pantalla .= $texto_funcion . '$retorno=$this->validar_retorno_pantalla($retorno,$retorno_temp);' . "\n";
            $texto_pantalla .= '
}
return($retorno);' . "\n";
        }
    }
    $texto_pantalla .= '}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_get($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $texto_parametro = array();
    $texto_cuerpo = '';
    $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
    $texto_pantalla .= "public function get_{$pantalla[0]["nombre"]}(";
    foreach ($tablas as $key => $valor) {
        if ($valor != '') {
            $valor = strtolower($valor);
            array_push($texto_parametro, '$id' . $valor);
            $texto_cuerpo .= '$this->id' . $valor . '=$id' . $valor . ";\n";
            $texto_cuerpo .= '$this->' . $valor . '=busca_filtro_tabla("","' . $valor . '","id' . $valor . '=".$this->id' . $valor . ',"",$conn);' . "\n";
        }
    }
    $texto_pantalla .= implode(",", $texto_parametro) . ") {\n";
    $texto_pantalla .= $texto_cuerpo;
    if ($pantalla[0]["tipo_pantalla"] == 2) {
        $pantalla_heredada = busca_filtro_tabla("", "pantalla a", "a.idpantalla=" . $pantalla[0]["clase"], "", $conn);
        $nombres_campos = extrae_campo($campos_pantalla, "nombre", "U,m");
        if (in_array("fk_id" . $pantalla_heredada[0]["nombre"], $nombres_campos)) {
            $campo_heredado = "fk_id" . $pantalla_heredada[0]["nombre"];
        }
        if (in_array($pantalla_heredada[0]["nombre"] . "_id" . $pantalla_heredada[0]["nombre"], $nombres_campos)) {
            $campo_heredado = $pantalla_heredada[0]["nombre"] . "_id" . $pantalla_heredada[0]["nombre"];
        }
        if (!empty($pantalla_heredada[0]["nombre"])) {
            $texto_pantalla .= '$this->get_' . $pantalla_heredada[0]["nombre"] . '($this->' . $pantalla[0]["nombre"] . '[0]["' . $campo_heredado . '"]);' . "\n";
        }
    }
    $texto_pantalla .= '}' . "\n";
    return ($texto_pantalla);
}

function generar_metodo_ejecutar_acciones($pantalla, $campos_pantalla) {
    $texto_pantalla = '';
    $texto_parametro = array();

    $texto_cuerpo = '';
    $texto_pantalla .= 'public function ejecutar_acciones($momento,$accion){' . "\n";
    $texto_pantalla .= $texto_cuerpo;
    $texto_pantalla .= '}' . "\n";
    return ($texto_pantalla);
}

function generar_clase($idpantalla, $tipo_retorno) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    $texto_clase = '';
    $retorno = array(
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $retorno = array(
        "mensaje" => "Error al tratar de generar la clase de la pantalla " . $pantalla[0]["nombre"]
    );
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        if (!is_file($ruta_carpeta . "/funciones.php")) {
            file_put_contents($ruta_carpeta . "/funciones.php", '<' . '?php' . "\n" . '?' . '>');
            // chmod($ruta_carpeta."/funciones.php",PERMISOS_ARCHIVOS);
        }
        if (!is_file($ruta_carpeta . "/class_" . $pantalla[0]["nombre"] . "_adicionales.php")) {
            file_put_contents($ruta_carpeta . "/class_" . $pantalla[0]["nombre"] . "_adicionales.php", '<' . '?php' . "\n" . '?' . '>');
            // chmod($ruta_carpeta."/funciones.php",PERMISOS_ARCHIVOS);
        }

        $campos_pantalla = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND tabla<>''", "orden", $conn);
        $nombre_archivo = $ruta_carpeta . "/class_" . $pantalla[0]["nombre"] . ".php";
        $texto_pantalla = generar_ruta_superior();
        $texto_pantalla .= incluir_libreria_saia("db.php", "php");
        $librerias = busca_filtro_tabla("", "pantalla_funcion_exe A, pantalla_funcion B, pantalla_libreria C", "A.fk_idpantalla_funcion=B.idpantalla_funcion AND B.fk_idpantalla_libreria=C.idpantalla_libreria AND B.tipo_funcion='php' AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"], "", $conn);
        for ($i = 0; $i < $librerias["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias[$i]["ruta"], $librerias[$i]["tipo_funcion"]);
        }
        if ($pantalla[0]["clase"]) {
            $clase = busca_filtro_tabla("", "pantalla", "idpantalla=" . $pantalla[0]["clase"], "", $conn);
            if ($clase["numcampos"]) {
                $texto_pantalla .= incluir_libreria_saia($clase[0]["ruta_pantalla"] . "/" . $clase[0]["nombre"] . "/class_" . $clase[0]["nombre"] . ".php", "php");
                $texto_clase = " extends " . $clase[0]["nombre"];
            }
        }
        $texto_pantalla .= '<' . '?php' . "\n";
        $texto_pantalla .= 'class ' . $pantalla[0]["nombre"] . $texto_clase . "{\n";
        $texto_pantalla .= generar_atributos($campos_pantalla);
        $texto_pantalla .= generar_constructor($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_destructor($pantalla);
        $texto_pantalla .= generar_metodo_set($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_get($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_get_campos($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_get_campo($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_get_valor($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_update($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_delete($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_existe($pantalla, $campos_pantalla);
        $texto_pantalla .= generar_metodo_validar_insert();
        $texto_pantalla .= generar_metodo_validar_retorno_pantalla();
        $texto_pantalla .= generar_metodo_insert_busqueda_temp($pantalla, $campos_pantalla);
        /*
         * if(strpos($pantalla[0]["nombre"],"bpmn")===FALSE){
         * $texto_pantalla.=generar_metodo_validar_bpmni($pantalla,$campos_pantalla);
         * $texto_pantalla.=generar_metodo_validar_bpmni_tarea($pantalla,$campos_pantalla);
         * $texto_pantalla.=generar_metodo_instancia_bpmni($pantalla,$campos_pantalla);
         * $texto_pantalla.=generar_metodo_actualizar_estado_instancia_bpmni($pantalla,$campos_pantalla);
         * }
         */
        $texto_pantalla .= '
  } ' . "\n" . '?' . ">\n";
        $texto_pantalla .= importar_funciones_externas_clase($pantalla);
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($nombre_archivo,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_clase: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_clase: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function importar_funciones_externas_clase($pantalla) {
    $texto_pantalla = '';
    // print_r($pantalla);
    if ($pantalla[0]["librerias"] != "") {
        $texto_pantalla = '<?' . 'php' . "\n";
        $librerias = explode(",", $pantalla[0]["librerias"]);
        foreach ($librerias as $key => $libreria) {
            $texto_pantalla .= 'runkit_import($ruta_db_superior."' . $libreria . '");' . "\n";
        }
        $texto_pantalla .= '?' . '>';
    }
    return ($texto_pantalla);
}

function generar_pantalla_libreria($idpantalla, $tipo_retorno) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    $retorno = array(
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $retorno = array(
        "mensaje" => "Error al tratar de generar la libreria de la pantalla " . $pantalla[0]["nombre"]
    );
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        $campos_pantalla = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $pantalla[0]["idpantalla"], "orden", $conn);
        $nombre_archivo = $ruta_carpeta . "/librerias_" . $pantalla[0]["nombre"] . ".php";
        $texto_pantalla = generar_ruta_superior();
        $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");
        $texto_pantalla .= '<' . '?php' . "\n";
        $texto_pantalla .= '$pantalla = new ' . $pantalla[0]["nombre"] . '();
  if(@$_REQUEST["ejecutar_' . $pantalla[0]["nombre"] . '"]){
    if(!@$_REQUEST["tipo_retorno"]){
      $_REQUEST["tipo_retorno"]=1;
    }
    if($_REQUEST["tipo_retorno"]){
      echo(json_encode($pantalla->$_REQUEST["ejecutar_' . $pantalla[0]["nombre"] . '"]()));
    }
    else{
      $pantalla->$_REQUEST["ejecutar_' . $pantalla[0]["nombre"] . '"]();
    }
  }
  ?' . ">\n";
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($nombre_archivo,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_pantalla_libreria: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_pantalla_libreria: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function generar_ruta_superior() {
    $texto = '<' . '?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?' . '>';
    return ($texto);
}

function generar_version_pantalla($idpantalla, $tipo_retorno) {
    global $ruta_db_superior;
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_origen = $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    $ruta_destino = "../versiones_pantalla/" . $pantalla[0]["nombre"];
    if (is_dir($ruta_db_superior . $ruta_origen)) {
        $archivo_zip = $pantalla[0]["nombre"] . "_" . $pantalla[0]["version"] . ".zip";
        crear_destino($ruta_db_superior . $ruta_destino);
        include_once ($ruta_db_superior . "pantallas/generador/lib/librerias_zip.php");
        $retorno = comprimir_zip($ruta_origen, $ruta_destino, $archivo_zip, 0);
        if ($retorno["exito"] == 1) {
            $sql2 = "UPDATE pantalla SET version=" . ($pantalla[0]["version"] + 1) . " WHERE idpantalla=" . $pantalla[0]["idpantalla"];
            phpmkr_query($sql2);
        }
    } else {
        $retorno["exito"] = 1;
        $retorno["mensaje"] = "Versi&oacute;n inicial de la pantalla, no es necesario versionar";
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function encabezado_pantalla($pantalla) {
    $texto_pantalla = generar_ruta_superior();
    $texto_pantalla .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $texto_pantalla .= incluir_libreria_saia('pantallas/lib/librerias_componentes.php', "php");
    $librerias_default = busca_filtro_tabla("", "pantalla_libreria_def", "estado=1 AND lugar_incluir='head'", "orden", $conn);
    if ($librerias_default["numcampos"]) {
        for ($i = 0; $i < $librerias_default["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_default[$i]["ruta"], $librerias_default[$i]["tipo_archivo"]);
        }
    }
    // $sql1="delete from pantalla_include where pantalla_idpantalla=".$pantalla[0]["idpantalla"];
    // phpmkr_query($sql1);
    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include not like '%a%' AND A.acciones_include not like '%e%' AND A.acciones_include not like '%m%'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= incluir_libreria_saia('pantallas/lib/mobile_detect.php', "php");
    $texto_pantalla .= '<' . '?php $detect = new Mobile_Detect;
  if ( $detect->isMobile() ) {
    $tipo_form="form";
  }
  else{
    $tipo_form="form-horizontal";
  }';
    $texto_pantalla .= '?' . '>';
    return ($texto_pantalla);
}

// /2-Posterior 1->anterior 3->error
function bloque_codigo_funciones($pantalla, $accion, $momento = 2, $bloque_actual = "php") {
    $texto_pantalla = '';
    $funciones = busca_filtro_tabla("", "pantalla_funcion A,pantalla_funcion_exe B", "A.idpantalla_funcion=B.fk_idpantalla_funcion AND B.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lower(B.accion)='" . strtolower($accion) . "' AND A.tipo_funcion='php' AND momento=" . $momento, "B.orden", $conn);
    if ($funciones["numcampos"]) {
        if ($bloque_actual != "php")
            $texto_pantalla .= '<' . '?php ';
        for ($i = 0; $i < $funciones["numcampos"]; $i++) {
            $lparametros = busca_filtro_tabla("", "pantalla_func_param A", "A.fk_idpantalla_funcion_exe=" . $funciones[$i]["idpantalla_funcion_exe"], "", $conn);
            $listado_parametros = array();
            for ($j = 0; $j < $lparametros["numcampos"]; $j++) {
                if ($lparametros[$j]["tipo"] == 1) {
                    $campo = busca_filtro_tabla("", "pantalla_campos", "idpantalla_campos=" . $lparametros[$j]["valor"], "", $conn);
                    array_push($listado_parametros, '$this->get_valor_' . $pantalla[0]["nombre"] . '("' . $pantalla[0]["nombre"] . '","' . $campo[0]["nombre"] . '")');
                } else if ($lparametros[$j]["tipo"] == 3) {
                    array_push($listado_parametros, '$_REQUEST["' . $lparametros[$j]["valor"] . '"]');
                } else {
                    array_push($listado_parametros, "'" . $lparametros[$j]["valor"] . "'");
                }
            }
            $texto_pantalla .= '$retorno_temp=' . $funciones[$i]["nombre"] . '(' . implode(",", $listado_parametros) . ');' . "\n";
        }
        if ($bloque_actual != "php")
            $texto_pantalla .= '?' . '>' . "\n";
    }
    $funciones = busca_filtro_tabla("", "pantalla_funcion A,pantalla_funcion_exe B", "A.idpantalla_funcion=B.fk_idpantalla_funcion AND B.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND B.accion='" . $accion . "' AND A.tipo_funcion='js' AND momento=" . $momento, "B.orden", $conn);
    if ($funciones["numcampos"]) {
        if ($bloque_actual != "js") {
            if ($bloque_actual == "php") {
                $texto_pantalla .= '?' . '>';
            }
            $texto_pantalla .= '<script type="text/javascript"> $(document).ready(function(){';
        }
        for ($i = 0; $i < $funciones["numcampos"]; $i++) {
            $texto_pantalla .= $funciones[$i]["nombre"] . '();';
        }
        if ($bloque_actual != "js") {
            $texto_pantalla .= '}); </script>';
            if ($bloque_actual == "php") {
                $texto_pantalla .= '<' . '?php';
            }
        }
    }

    return ($texto_pantalla);
}

function footer_pantalla($pantalla, $accion) {
    $texto_pantalla = '';
    $texto_pantalla .= '<input type="hidden" name="key_formulario_saia" value="<' . '?php echo(generar_llave_md5_saia());?' . '>">';
    $texto_pantalla .= '<input type="hidden" name="fk_idbpmni" value="<' . '?php echo($_REQUEST["bpmni"]);?' . '>">';
    $texto_pantalla .= '<input type="hidden" name="fk_idbpmn_tarea" value="<' . '?php echo($_REQUEST["idbpmn_tarea"]);?' . '>">';
    // falta validar que la pantalla esté relacionada con un documento para que mande el documento anterior
    $texto_pantalla .= '<input type="hidden" id="fk_documento_anterior" name="fk_documento_anterior" value="<' . '?php echo($_REQUEST["fk_documento_anterior"]);?' . '>">';
    if ($pantalla[0]["submit_formulario"] && in_array($accion, array(
        "adicionar",
        "editar",
        "buscar",
        "eliminar"
    ))) {
        $texto_pantalla .= '<div class="form-actions">
            <div class="btn btn-primary btn-mini" id="submit_formulario_' . $pantalla[0]["nombre"] . '">Aceptar</div>
            <!--div class="btn btn-mini" id="cancel_formulario_' . $pantalla[0]["nombre"] . '">Cancelar</div-->
            <div id="cargando_enviar" class="pull-right"></div>
          </div>';
        $texto_pantalla .= '</form>';
    }
    if ($accion !== "mostrar") {
        $librerias_default = busca_filtro_tabla("", "pantalla_libreria_def", "estado=1 AND lugar_incluir='footer'", "orden", $conn);
        if ($librerias_default["numcampos"]) {
            for ($i = 0; $i < $librerias_default["numcampos"]; $i++) {
                $texto_pantalla .= incluir_libreria_saia($librerias_default[$i]["ruta"], $librerias_default[$i]["tipo_archivo"]);
            }
        }
    }
    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='footer'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }

    $nombre_accion = 'ingresar';
    $idmomento = 2;
    switch ($accion) {
        case 'adicionar':
            $nombre_accion = 'adicionar';
            $idmomento = 4;
            break;
        case 'editar':
            $nombre_accion = 'editar';
            $idmomento = 4;
            break;
    }

    $texto_pantalla .= bloque_codigo_funciones($pantalla, $nombre_accion, $idmomento, "html");
    return ($texto_pantalla);
}

function footer_pantalla_mostrar($pantalla) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    if ($pantalla[0]["tipo_pantalla"] == 2) {
        if ((!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1)) {
            $texto_pantalla .= '<?' . 'php';
            $texto_pantalla .= ' if(@$_' . 'REQUEST["imprimir"]!=1){ ?' . ">\n";
            $texto_pantalla .= '
      </div>
          </div>
            <div class="page_margin_bottom" id="doc_footer">';
            $pie_pagina .= generar_ruta_superior();
            $pie_pagina .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php", 1, 1);
            $pie_pagina .= '<' . '?php if(!@$' . $pantalla[0]["nombre"] . '){
				$' . $pantalla[0]["nombre"] . '=new ' . $pantalla[0]["nombre"] . '();
				$' . $pantalla[0]["nombre"] . '->get_' . $pantalla[0]["nombre"] . '($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);
		  	if(!$' . $pantalla[0]["nombre"] . '->existe_' . $pantalla[0]["nombre"] . '()){
		          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
		  	}
	  	}
  	?' . '>';
            $pie_pagina .= incluir_librerias_encabezado_pie($pantalla);
            $parseo_footer = parsear_pantalla_mostrar($pantalla, "pie");
            $pie_pagina .= $parseo_footer;
            $texto_pantalla .= $parseo_footer;
            file_put_contents($ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/pie_" . $pantalla[0]["nombre"] . ".php", $pie_pagina);
            $texto_pantalla .= '</div>
        </div>
      </div>';
            $texto_pantalla .= '<?' . 'php } ?' . ">\n";
        }
    } else {
        $texto_pantalla .= parsear_pantalla_mostrar($pantalla, "pie");
    }
    return ($texto_pantalla);
}

function generar_metodo_validar_retorno_pantalla() {
    $texto = 'public function validar_retorno_pantalla($retorno,$retorno_temp){
    if($retorno_temp && $retorno_temp->operador_exito){
      if($retorno_temp->operador_exito==1)
        $retorno->exito=$retorno->exito && $retorno_temp->exito;
      else if($retorno_temp->operador_exito==2)
        $retorno->exito=$retorno->exito || $retorno_temp->exito;
      else if($retorno_temp->operador_exito==3)
        $retorno->exito=$retorno->exito xor $retorno_temp->exito;
    }
    if($retorno_temp->concatenar==1){
      $retorno->mensaje.=$retorno_temp->mensaje;
    }
    else if ($retorno_temp->concatenar==2){
      $retorno->mensaje=$retorno_temp->mensaje;
    }
    return($retorno);
  }';
    return ($texto);
}

// se encarga de asignar los valores a los campos ocultos del adicionar de las pantallas ejemplo: ejecutor, tipo_radicado
function generar_valores_campos_ocultos_obligatorios($pantalla) {
    global $conn;

    $texto = '';
    $texto .= '$("#ejecutor").val(<?php echo(usuario_actual("funcionario_codigo")); ?>);';
    // pendiente validar si tiene campo tipo_radicado
    return ($texto);
}

function generar_validaciones_formulario($pantalla, $funcion_default, $accion = "") {
    $campos_pantalla = busca_filtro_tabla("", "pantalla_campos A", "A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND A.nombre<>'id" . $pantalla[0]["nombre"] . "'", "orden", $conn);
    $texto_pantalla = '';
    $texto_pantalla .= '<script type="text/javascript">';
    $texto_pantalla .= '
  $(document).ready(function(){

    var formulario_' . $pantalla[0]["nombre"] . '=$("#formulario_' . $pantalla[0]["nombre"] . '");';
    if ($accion == "adicionar" || $accion == "editar") {

        if ($accion == "adicionar") {
            $texto_pantalla .= generar_valores_campos_ocultos_obligatorios($pantalla);
        }

        $texto_pantalla .= 'formulario_' . $pantalla[0]["nombre"] . '.validate(';
        if ($campos_pantalla["numcampos"]) {

            $reglas = array(
                "ignore" => "''",
                "rules" => array()
            );
            for ($i = 0; $i < $campos_pantalla["numcampos"]; $i++) {
                $nombre_campo = $campos_pantalla[$i]["nombre"];
                if (strpos($campos_pantalla[$i]["banderas"], "a") !== false) {
                    $nombre_campo .= '[]';
                }
                if ($campos_pantalla[$i]["obligatoriedad"] && $accion != "buscar") {
                    if (!@$reglas["rules"][$nombre_campo]) {
                        $reglas["rules"][$nombre_campo] = array();
                    }
                    $reglas["rules"][$nombre_campo]["required"] = true;
                    if (function_exists("validaciones_adicionales_" . $campos_pantalla[$i]["etiqueta_html"]))
                        $reglas = call_user_func_array("validaciones_adicionales_" . $campos_pantalla[$i]["etiqueta_html"], array(
                            $nombre_campo,
                            $reglas
                        ));
                }
            }
            $texto_pantalla .= json_encode($reglas);
        }
        $texto_pantalla .= ');';
    }
    if ($pantalla[0]["submit_formulario"]) {
        $texto_pantalla .= '$("#submit_formulario_' . $pantalla[0]["nombre"] . '").click(function(){';
        $texto_pantalla .= 'if (typeof(tinyMCE)!="undefined")
           							tinyMCE.triggerSave();';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar", 1, "js"); // Esta linea estaba exactamente antes del if
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar", 2, "js");
        $texto_pantalla .= "\n";
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "validar", 1, "js");
        $texto_pantalla .= '  if(formulario_' . $pantalla[0]["nombre"] . '.valid()){';

        $texto_pantalla .= bloque_codigo_funciones($pantalla, "validar", 2, "html");
        $texto_pantalla .= '
$(\'#cargando_enviar\').html("<div id=\'icon-cargando\'></div>Procesando");
$(this).attr(\'disabled\', \'disabled\');
$.ajax({
  type:\'POST\',
  url: "<?php echo($ruta_db_superior);?' . '>' . $pantalla[0]["ruta_pantalla"] . '/' . $pantalla[0]["nombre"] . '/librerias_' . $pantalla[0]["nombre"] . '.php",
  data: "ejecutar_' . $pantalla[0]["nombre"] . '=' . $funcion_default . '&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_' . $pantalla[0]["nombre"] . '.serialize(),
  success: function(html){
    if(html){
      var objeto=jQuery.parseJSON(html);
      if(objeto.exito){
        $(\'#cargando_enviar\').html("Terminado ...");';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_exito", 1, "js");
        $texto_pantalla .= 'notificacion_saia(objeto.mensaje,"success","",2500);';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_exito", 2, "js");
        $texto_pantalla .= '
      }
      else{
        $(\'#cargando_enviar\').html("Terminado ...");';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_error", 1, "js");
        $texto_pantalla .= 'notificacion_saia(objeto.mensaje,"error","",8500);';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_error", 2, "js");
        $texto_pantalla .= '
      }
    }
  }';
        $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar", 2, "js");
        $texto_pantalla .= '
  	});';
        $texto_pantalla .= '
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }';
        $texto_pantalla .= '
    });' . "\n";
    }
    $texto_pantalla .= '
});
</script>';
    return ($texto_pantalla);
}

function incluir_libreria_saia($ruta_archivo, $tipo_archivo, $incluir_tag = 1, $encabezado_pie = "") {
    global $librerias_incluidas;
    if (!in_array($ruta_archivo, $librerias_incluidas) || $encabezado_pie == 1) {
        switch ($tipo_archivo) {
            case "php":
                if ($incluir_tag)
                    $texto = '<' . '?php ';
                $texto .= 'include_once($ruta_db_superior."' . $ruta_archivo . '");';
                if ($incluir_tag)
                    $texto .= ' ?' . '>';
                break;
            case "js":
                $texto = '<script type="text/javascript" src="<' . '?php echo($ruta_db_superior);?' . '>' . $ruta_archivo . '"></script>';
                break;
            case "css":
                $texto = '<link rel="stylesheet" type="text/css" href="<' . '?php echo($ruta_db_superior);?' . '>' . $ruta_archivo . '"/>';
                break;
            default:
                $texto = ""; // retorna un vacio si no existe el tipo
                break;
        }
        array_push($librerias_incluidas, $ruta_archivo);
        return ("\n" . $texto);
    }
    return;
}

function encabezado_pantalla_adicionar($pantalla) {
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");

    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include like '%a%'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= '<' . '?php
  $' . $pantalla[0]["nombre"] . '= new ' . $pantalla[0]["nombre"] . '();
  ?' . '>
  ';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "ingresar", 1, "html");
    $texto_pantalla .= '<form class="';
    $texto_pantalla .= '<' . '?php echo($tipo_form); ?' . '>" name="formulario_' . $pantalla[0]["nombre"] . '" id="formulario_' . $pantalla[0]["nombre"] . '" method="post" enctype="multipart/form-data">';

    return ($texto_pantalla);
}

function encabezado_pantalla_buscar($pantalla) {
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");

    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include like '%b%'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }

    $texto_pantalla .= '<' . '?php
  $' . $pantalla[0]["nombre"] . '= new ' . $pantalla[0]["nombre"] . '();
  ?' . '>
  ';
    $texto_pantalla .= '<form class="';
    $texto_pantalla .= '<' . '?php echo($tipo_form); ?' . '>" name="formulario_' . $pantalla[0]["nombre"] . '" id="formulario_' . $pantalla[0]["nombre"] . '" method="post" enctype="multipart/form-data">';

    return ($texto_pantalla);
}

function encabezado_pantalla_mostrar($pantalla) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");

    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include like '%m%'", "A.orden", $conn);
    $librerias_encabezado = array();
    $librerias_encabezado[] = generar_ruta_superior();
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= $librerias_encabezado[] = incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= '<' . '?php
  $' . $pantalla[0]["nombre"] . '= new ' . $pantalla[0]["nombre"] . '();
  $' . $pantalla[0]["nombre"] . '->get_' . $pantalla[0]["nombre"] . '($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);
  if(!$' . $pantalla[0]["nombre"] . '->existe_' . $pantalla[0]["nombre"] . '()){
          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
  }
  ?' . '>
  <input type="hidden" name="id' . $pantalla[0]["nombre"] . '" value="<' . '?php echo($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);?' . '>">
  ';
    if ($pantalla[0]["tipo_pantalla"] == 2) {
        $texto_pantalla .= encabezado_pantalla_formatos($pantalla, $librerias_encabezado);
    } else {
        $texto_pantalla .= parsear_pantalla_mostrar($pantalla, "encabezado");
    }
    return ($texto_pantalla);
}

function encabezado_pantalla_formatos($pantalla, $librerias_encabezado) {
    global $ruta_db_superior, $librerias_incluidas;
    $texto_pantalla = '';
    $pantalla_adicional = busca_filtro_tabla("", "pantalla_pdf a", "fk_idpantalla=" . $pantalla[0]["idpantalla"], "", $conn);
    if (!$pantalla_adicional["numcampos"]) {
        $pantalla_adicional[0]["tamano"] = 12;
        $pantalla_adicional[0]["derecha"] = 20;
        $pantalla_adicional[0]["izquierda"] = 15;
        $pantalla_adicional[0]["superior"] = 30;
        $pantalla_adicional[0]["inferior"] = 20;
        $pantalla_adicional[0]["tamano_papel"] = "LETTER";
        $pantalla_adicional[0]["tipo_fuente"] = "arial";
        $pantalla_adicional[0]["color_fondo"] = "#CCC";
    }
    $nombre = $pantalla[0]["nombre"];
    // $_SESSION["pagina_actual"]=$doc;
    // $_SESSION["tipo_pagina"]=$formato[0]["ruta_pantalla"]."/$nombre/mostrar_$nombre.php?id".$nombre."=$doc";
    if (@$_REQUEST["font_size"]) {
        $pantalla_adicional[0]["tamano"] = $_REQUEST["font_size"];
    }

    $texto_pantalla .= '<?' . 'php' . "\n";
    $texto_pantalla .= ' if(!@$_REQUEST["imprimir"]){ ?' . ">\n";
    $texto_pantalla .= "<style type='text/css'>body {font-size:" . $pantalla_adicional[0]["tamano"] . "pt; font-family:" . $pantalla_adicional[0]["tipo_fuente"] . "; background-color:" . $pantalla_adicional[0]["color_fondo"] . "} </style>";
    $texto_pantalla .= '<body style="background-color:' . $pantalla_adicional[0]["color_fondo"] . '">';
    $texto_pantalla .= incluir_libreria_saia("pantallas/documento/menu_principal_documento.php", "php");
    $texto_pantalla .= '<?' . 'php' . "\n";
    $texto_pantalla .= 'echo(menu_principal_documento($' . $pantalla[0]["nombre"] . '->get_valor_' . $pantalla[0]["nombre"] . '("' . $pantalla[0]["nombre"] . '","documento_iddocumento")));';
    $texto_pantalla .= '?' . ">\n";

    $tam_pagina = array();
    $equivalencia = 3.7882;

    $tam_pagina["A4"]["ancho"] = 797;
    $tam_pagina["A4"]["alto"] = 1123;
    $tam_pagina["Letter"]["ancho"] = 819;
    $tam_pagina["Letter"]["alto"] = 1400;
    $tam_pagina["Legal"]["ancho"] = 819;
    $tam_pagina["Legal"]["alto"] = 1345;
    $tam_pagina["margen_derecha"] = $pantalla_adicional[0]["derecha"] * $equivalencia;
    $tam_pagina["margen_izquierda"] = $pantalla_adicional[0]["izquierda"] * $equivalencia;
    $tam_pagina["margen_superior"] = $pantalla_adicional[0]["superior"] * $equivalencia;
    $tam_pagina["margen_inferior"] = $pantalla_adicional[0]["inferior"] * $equivalencia;
    $tamano_papel = ucfirst(strtolower($pantalla_adicional[0]["tamano_papel"]));
    if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1) {
        $texto_pantalla .= '<style type="text/css">
.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
.paginador_docs { width: ' . $tam_pagina[$tamano_papel]["ancho"] . 'px; height:' . $tam_pagina[$tamano_papel]["alto"] . 'px; margin: auto; padding-left: 0px; margin-bottom:10px; background-color:#FFF; overflow:hidden; box-shadow: 5px 5px 5px #888888;}
.page_content { height: ' . ($tam_pagina[$tamano_papel]["alto"] - ($tam_pagina["margen_superior"] + $tam_pagina["margen_inferior"])) . 'px;  overflow:hidden; font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-right: ' . $tam_pagina["margen_derecha"] . 'px; margin-left: ' . $tam_pagina["margen_izquierda"] . 'px; }
.page_margin_top { height:' . ($tam_pagina["margen_superior"]) . 'px; overflow: hidden; }
.page_margin_bottom { height:' . $tam_pagina["margen_inferior"] . 'px; padding-top:30px; page-break-after:always; }
</style>
<script>
	$(document).ready(function(){
		var alto_papel=' . $tam_pagina[$tamano_papel]["alto"] . ';
    var alto_encabezado=' . $tam_pagina["margen_superior"] . ';
    var alto_pie_pagina=' . $tam_pagina["margen_inferior"] . ';
		var altopagina = alto_papel-(alto_encabezado+alto_pie_pagina);
    var paginas=1;
    var alto=0;
    var inicial=$("#documento").offset().top;
    $(".page_break").each(function(){
      pos=$(this).offset().top;
	    paginas =Math.ceil(pos/altopagina);
      var nuevo_alto=(inicial+((altopagina)*paginas))-(pos)+(alto_encabezado);
      $(this).height(nuevo_alto);

    });
    alto = $("#page_overflow").height();
	  paginas =Math.ceil(alto/altopagina);
		var contenido = $("#page_overflow").html();
		var encabezado = $("#doc_header").html();
		var piedepagina = $("#doc_footer").html();

		for(i=1;i<paginas;i++){
			var altoPaginActual = altopagina*i;
			var pagina = \'<div class="paginador_docs page_border"><div class="page_margin_top">\'+encabezado+\'</div><div class="page_content" ><div style="margin-top:-\'+altoPaginActual+\'px">\'+contenido+\'</div></div><div class="page_margin_bottom">\'+piedepagina+\'</div></div>\';

			$("#documento").append(pagina);
		}
	});
</script>';
        $texto_pantalla .= '<div id="documento"><div class="paginador_docs page_border">';
    }
    if (!@$_REQUEST["export"]) {
        $texo_pantalla .= "<div id='div1'>";
        $texto_patalla .= "</div>";
    }
    $texto_pantalla .= '<div class="page_margin_top" id="doc_header">';
    $librerias_encabezado[] = incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php", 1, 1);
    $librerias_encabezado[] = '<' . '?php if(!@$' . $pantalla[0]["nombre"] . '){
				$' . $pantalla[0]["nombre"] . '=new ' . $pantalla[0]["nombre"] . '();
				$' . $pantalla[0]["nombre"] . '->get_' . $pantalla[0]["nombre"] . '($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);
		  	if(!$' . $pantalla[0]["nombre"] . '->existe_' . $pantalla[0]["nombre"] . '()){
		          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
		  	}
	  	}
  	?' . '>';
    $librerias_encabezado[] = incluir_librerias_encabezado_pie($pantalla);
    $texto_pantalla .= $librerias_encabezado[] = parsear_pantalla_mostrar($pantalla, "encabezado");
    file_put_contents($ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/encabezado_" . $pantalla[0]["nombre"] . ".php", implode("\n", $librerias_encabezado));
    $texto_pantalla .= '</div>
    <div class="page_content">
      <div id="page_overflow">';
    $texto_pantalla .= '<?' . 'php } ?' . ">\n";
    return ($texto_pantalla);
}

function incluir_librerias_encabezado_pie($pantalla) {
    global $conn, $ruta_db_superior;
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia('pantallas/lib/librerias_componentes.php', "php");
    $librerias_default = busca_filtro_tabla("", "pantalla_libreria_def", "estado=1 AND lugar_incluir='head'", "orden", $conn);
    if ($librerias_default["numcampos"]) {
        for ($i = 0; $i < $librerias_default["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_default[$i]["ruta"], $librerias_default[$i]["tipo_archivo"], 1, 1);
        }
    }
    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND A.acciones_include like '%m%'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"], 1, 1);
        }
    }
    $texto_pantalla .= incluir_libreria_saia('pantallas/lib/mobile_detect.php', "php");
    return ($texto_pantalla);
}

function encabezado_pantalla_editar($pantalla) {
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");

    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include like '%e%'", "A.orden", $conn);
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= '<' . '?php
  $' . $pantalla[0]["nombre"] . '= new ' . $pantalla[0]["nombre"] . '();
  $' . $pantalla[0]["nombre"] . '->get_' . $pantalla[0]["nombre"] . '($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);
  if(!$' . $pantalla[0]["nombre"] . '->existe_' . $pantalla[0]["nombre"] . '()){
          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
  }
  ?' . '>';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "ingresar", 1, "html");
    $texto_pantalla .= '<form class="';
    $texto_pantalla .= '<' . '?php echo($tipo_form); ?' . '>" name="formulario_' . $pantalla[0]["nombre"] . '" id="formulario_' . $pantalla[0]["nombre"] . '" method="post" enctype="multipart/form-data">';
    $texto_pantalla .= '<input type="hidden" name="id' . $pantalla[0]["nombre"] . '" value="<' . '?php echo($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);?' . '>">';

    return ($texto_pantalla);
}

function generar_editar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior;
    $retorno = array(
        "exito" => 0
    );
    $retorno = array(
        "mensaje" => "Error al tratar de generar el editar de la pantalla"
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        $nombre_archivo = $ruta_carpeta . "/editar_" . $pantalla[0]["nombre"] . ".php";
        $texto_pantalla = encabezado_pantalla($pantalla);
        $texto_pantalla .= encabezado_pantalla_editar($pantalla);
        $texto_pantalla .= load_pantalla($idpantalla, 1, "editar");
        $texto_pantalla .= footer_pantalla($pantalla, "editar");
        $texto_pantalla .= generar_validaciones_formulario($pantalla, "update_" . $pantalla[0]["nombre"], "editar");
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($nombre_archivo,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_editar: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_editar: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function encabezado_pantalla_eliminar($pantalla) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    $texto_pantalla .= incluir_libreria_saia($pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/class_" . $pantalla[0]["nombre"] . ".php", "php");

    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='head' AND A.acciones_include like '%e%'", "A.orden", $conn);
    $librerias_encabezado = array();
    $librerias_encabezado[] = generar_ruta_superior();
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= $librerias_encabezado[] = incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= incluir_libreria_saia("pantallas/lib/librerias_cripto.php", "php");
    $texto_pantalla .= '<' . '?php
  $' . $pantalla[0]["nombre"] . '= new ' . $pantalla[0]["nombre"] . '();
  $' . $pantalla[0]["nombre"] . '->get_' . $pantalla[0]["nombre"] . '($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);
  if(!$' . $pantalla[0]["nombre"] . '->existe_' . $pantalla[0]["nombre"] . '()){
          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
  }
  ?' . '>
  <input type="hidden" id="id' . $pantalla[0]["nombre"] . '" name="id' . $pantalla[0]["nombre"] . '" value="<' . '?php echo($_REQUEST["id' . $pantalla[0]["nombre"] . '"]);?' . '>">
	<div class="alert alert-danger"> <h5>Est&aacute; absolutamente seguro? </h5>Esta acci&oacute;n <b>NO SE PUEDE DESHACER</b> ser&aacute; eliminado el registro por completo con todo lo que se encuentre relacionado. Debe confirmar la eliminac&oacute;n haciendo click en el bot&oacute;n<br><div id="confirmar_eliminar" class="btn btn-mini btn-danger" >Confirmaci&oacute;n de borrado</div><div id="cargando_enviar" class="pull-right" style="display:hidden"></div></div>';
    return ($texto_pantalla);
}

function generar_eliminar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $retorno = array(
        "mensaje" => "Error al tratar de generar el mostrar de la pantalla",
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        $nombre_archivo = $ruta_carpeta . "/eliminar_" . $pantalla[0]["nombre"] . ".php";
        $texto_pantalla = encabezado_pantalla($pantalla);
        $texto_pantalla .= encabezado_pantalla_eliminar($pantalla);
        $texto_pantalla .= footer_pantalla_eliminar($pantalla);
        $texto_pantalla .= footer_pantalla($pantalla, "elliminar");
        // guardar_encabezado_pie($idpantalla, @$_REQUEST["encabezado"], @$_REQUEST["pie"]);
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($ruta_datos,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_mostrar: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_mostrar: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function footer_pantalla_eliminar($pantalla) {
    global $ruta_db_superior;
    $texto_pantalla = '';
    $librerias_pantalla = busca_filtro_tabla("", "pantalla_include A, pantalla_libreria B", "A.fk_idpantalla_libreria=B.idpantalla_libreria AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND lugar_incluir='footer' AND A.acciones_include like '%e%'", "A.orden", $conn);
    $librerias_encabezado = array();
    $librerias_encabezado[] = generar_ruta_superior();
    if ($librerias_pantalla["numcampos"]) {
        for ($i = 0; $i < $librerias_pantalla["numcampos"]; $i++) {
            $texto_pantalla .= $librerias_encabezado[] = incluir_libreria_saia($librerias_pantalla[$i]["ruta"], $librerias_pantalla[$i]["tipo_archivo"]);
        }
    }
    $texto_pantalla .= '<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click","#confirmar_eliminar",function(){
			$("#cargando_enviar").show();
				$.ajax({
					type:"POST",
					url: "<?php echo($ruta_db_superior);?' . '>' . $pantalla[0]["ruta_pantalla"] . '/' . $pantalla[0]["nombre"] . '/librerias_' . $pantalla[0]["nombre"] . '.php",
				  data: "ejecutar_' . $pantalla[0]["nombre"] . '=delete_' . $pantalla[0]["nombre"] . '&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&id' . $pantalla[0]["nombre"] . '="+$("#id' . $pantalla[0]["nombre"] . '").val(),
					success: function(html){
						if(html){
							var objeto=jQuery.parseJSON(html);
							if(objeto.exito){
								$("#cargando_enviar").html("Terminado ...");';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_exito", 1, "js");
    $texto_pantalla .= 'notificacion_saia(objeto.mensaje,"success","",2500);';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_exito", 2, "js");
    $texto_pantalla .= '
							}
							else{
								$("#cargando_enviar").html("Terminado ...");';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_error", 1, "js");
    $texto_pantalla .= 'notificacion_saia(objeto.mensaje,"error","",8500);';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar_error", 2, "js");
    $texto_pantalla .= '
							}
						}
					}';
    $texto_pantalla .= bloque_codigo_funciones($pantalla, "enviar", 2, "js");
    $texto_pantalla .= '
				});
		});
	});
</script>';
    return ($texto_pantalla);
}

function validar_indices_pantalla($pantalla, $campos_pantalla, $tablas) {
    global $conn;
    $llaves = array(
        "pk",
        "u",
        "i"
    );
    $cant_llaves = count($llaves);
    $texto = '';
    for ($i = 0; $i < $campos_pantalla["numcampos"]; $i++) {
        for ($j = 0; $j < $cant_llaves; $j++) {
            if (strpos($campos_pantalla[$i]["banderas"], $llaves[$j]) !== false) {
                if (!$conn->Existe_indice($campos_pantalla[$i]["tabla"], $campos_pantalla[$i]["nombre"], $llaves[$j])) {
                    if (!$conn->Crear_indice($campos_pantalla[$i]["tabla"], $campos_pantalla[$i]["nombre"], $llaves[$j])) {
                        $texto .= 'Error al crear el indice ' . $llaves[$j] . ' en el campo ' . $campos_pantalla[$i]["nombre"];
                    }
                } else if (!$conn->Crear_indice($campos_pantalla[$i]["tabla"], $campos_pantalla[$i]["nombre"], $llaves[$j])) {
                    $texto .= 'Error al crear el indice ' . $llaves[$j] . ' en el campo ' . $campos_pantalla[$i]["nombre"];
                }
            }
            // TODO:Pendiente eliminar los indices que se eliminan del campo y ya están en la base de datos
        }
    }
}

function generar_tablas($idpantalla, $tipo_retorno) {
    global $conn;
    $pantalla = busca_filtro_tabla("", "pantalla A", "A.idpantalla=" . $idpantalla, "", $conn);
    $campos_base = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $idpantalla . " AND tabla<>''", "", $conn);
    $tablas = extrae_campo($campos_base, "tabla", "U,L");
    $retorno = validar_tablas_pantalla($pantalla, $campos_base, $tablas);
    $retorno["descripcion_error"] .= validar_indices_pantalla($pantalla, $campos_base, $tablas);
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function validar_tablas_pantalla($pantalla, $campos_base, $tablas) {
    global $conn;
    $retorno = array();
    $retorno["exito"] = 1;
    $retorno["mensaje"] = "";
    $retorno["descripcion_error"] = '<div style="padding:10px;">';
    $cant_tablas = count($tablas);

    $exito = 0;
    $exito_tablas = 0;
    for ($i = 0; $i < $cant_tablas; $i++) {
        $campos_base = busca_filtro_tabla("nombre,tipo_dato AS tipo, longitud,obligatoriedad,predeterminado", "pantalla_campos", "pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND tabla='" . $tablas[$i] . "' AND tabla<>''", "", $conn);
        $campos_pantalla = extrae_campo($campos_base, "nombre", "U,L");
        $hay_tablas = $conn->lista_tabla("", $tablas[$i]);
        if ($hay_tablas["numcampos"]) {
            $campos = listar_campos_tabla($tablas[$i]);
            sort($campos);
            sort($campos_pantalla);
            $entabla = array_diff($campos, $campos_pantalla);
            $registros = busca_filtro_tabla("count(*) AS cant", $tablas[$i], "", "", $conn);
            // datos que son eliminados de la pantalla se debe poner como nulos en la base de datos si tienen datos, de lo contrario se borran
            $cant_entabla = count($entabla);
            sort($entabla);
            if ($cant_entabla) {
                for ($j = 0; $j < $cant_entabla; $j++) {
                    if ($registros[0]["cant"]) {
                        $datos = $conn->Ejecutar_existe_campo($tablas[$i], $entabla[$j], 2);
                        if ($datos !== false) {
                            $datos["obligatoriedad"] = "";
                            $datos["accion"] = "borrar";
                            $conn->Clonar_tabla($tablas[$i], $tablas[$i] . "_v" . $pantalla[0]["version"], 1);
                            if ($conn->Ejecutar_alter_table($tablas[$i], $entabla[$j], $datos)) {
                                $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $entabla[$j] . " borrado<br />";
                                $exito++;
                            } else {
                                $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $entabla[$j] . " NO se ha modificado<br />";
                            }
                        } else {
                            $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $entabla[$j] . " NO es posible obtener informaci&oacute;n<br />";
                        }
                    } else {
                        $datos["accion"] = "borrar";
                        if ($conn->Ejecutar_alter_table($tablas[$i], $entabla[$j], $datos)) {
                            $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $entabla[$j] . " borrado<br />";
                            $exito++;
                        } else {
                            $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $entabla[$j] . " NO se ha podido borrar<br />";
                        }
                    }
                }
            }
            // Se hace un recorrido por todos los campos para validar cuales estan en la pantalla diferente a los de la tabla y se actualizan en caso de ser necesario
            for ($j = 0; $j < $campos_base["numcampos"]; $j++) {
                $campos_base[$j]["accion"] = "";
                $compara_campos = $conn->Ejecutar_existe_campo($tablas[$i], $campos_base[$j]["nombre"], 3, $campos_base[$j]);
                if ($compara_campos === false) {
                    $campos_base[$j]["accion"] = "adicionar";
                } else if ($compara_campos["diferencia_campos"]) {
                    $campos_base[$j]["accion"] = "modificar";
                    // $conn->Clonar_tabla($tablas[$i],$tablas[$i]."_v".$pantalla[0]["version"],1);
                    // $aleatorio=rand(0,99);
                    // $conn->Ejecutar_copiar_campo($tablas[$i],$campos_base[$j]["nombre"],$campos_base[$j]["nombre"]."_".$aleatorio);
                }
                if ($campos_base[$j]["accion"] != '') {
                    if ($conn->Ejecutar_alter_table($tablas[$i], $campos_base[$j]["nombre"], $campos_base[$j])) {
                        $exito++;
                        $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $campos_base[$j]["nombre"] . " adicionado<br />";
                    } else {
                        $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " campo " . $campos_base[$j]["nombre"] . " No se ha podido adicionar: {$campos_base[$j]["accion"]}<br />";
                    }
                }
            }
        } else if ($conn->Ejecutar_crear_tabla($tablas[$i], $campos_base)) {
            $retorno["descripcion_error"] .= "tabla " . $tablas[$i] . " creada<br />";
            $exito_tablas++;
        }
    }
    if ($exito == ($cant_entabla + $exito_tablas)) {
        $retorno["exito"] = 1;
        $retorno["mensaje"] = "La tabla se ha procesado de forma exitosa";
        $retorno["descripcion_error"] .= "Se realizaron modificaciones en las tablas " . implode(", ", $tablas) . " por favor verifique";
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "La tabla se ha procesado con errores";
        $retorno["descripcion_error"] .= "Se realizaron modificaciones en las tablas " . implode("<br />", $tablas) . " que fallaron por favor verifique";
    }
    $retorno["descripcion_error"] .= "</div>";
    return ($retorno);
}

function generar_buscar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $retorno = array(
        "mensaje" => "Error al tratar de generar el buscar de la pantalla",
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (crear_destino($ruta_carpeta) != '') {
        $nombre_archivo = $ruta_carpeta . "/buscar_" . $pantalla[0]["nombre"] . ".php";
        vincular_librerias_componente($pantalla);
        $texto_pantalla = encabezado_pantalla($pantalla);
        $texto_pantalla .= encabezado_pantalla_buscar($pantalla);
        $texto_pantalla .= load_pantalla($idpantalla, 1, "buscar");
        $texto_pantalla .= '<' . '?php if(@$_REQUEST["idbusqueda_componente"]){
    echo(\'<input type="hidden" name="idbusqueda_componente" value="\'.$_REQUEST["idbusqueda_componente"].\'">\');
  } ?' . '>';
        $texto_pantalla .= footer_pantalla($pantalla, "buscar");
        $texto_pantalla .= generar_validaciones_formulario($pantalla, "insert_busqueda_temp_" . $pantalla[0]["nombre"], "buscar");
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($nombre_archivo,PERMISOS_ARCHIVOS);
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_buscar: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_buscar: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function parsear_pantalla_mostrar($pantalla, $request_procesar) {
    global $ruta_db_superior;
    $retorno = array(
        "exito" => 0
    );
    $campos_pantalla = array();
    $pantalla_campos = busca_filtro_tabla("A.*,B.procesar", "pantalla_campos A, pantalla_componente B", "A.etiqueta_html=B.nombre AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND tabla<>''", "orden", $conn);
    $texto = @$_REQUEST[$request_procesar];
    if ($pantalla_campos["numcampos"]) {
        $retorno["exito"] = 1;
        for ($i = 0; $i < $pantalla_campos["numcampos"]; $i++) {
            if ($pantalla_campos[$i]["procesar"] != '') {
                $reemplaza = '<' . '?php echo(' . $pantalla_campos[$i]["procesar"] . '(' . $pantalla_campos[$i]["idpantalla_campos"] . ',$' . $pantalla[0]["nombre"] . '->get_valor_' . $pantalla[0]["nombre"] . '("' . $pantalla_campos[$i]["tabla"] . '","' . $pantalla_campos[$i]["nombre"] . '"),"mostrar",$' . $pantalla[0]["nombre"] . '->get_campo_' . $pantalla[0]["nombre"] . '("' . $pantalla_campos[$i]["nombre"] . '"))); ?' . '>';
            } else {
                $reemplaza = '<' . '?php  echo($' . $pantalla[0]["nombre"] . '->get_valor_' . $pantalla[0]["nombre"] . '("' . $pantalla_campos[$i]["tabla"] . '","' . $pantalla_campos[$i]["nombre"] . '")); ?' . '>';
            }
            $texto = str_replace('{*' . $pantalla_campos[$i]["nombre"] . '*}', $reemplaza, $texto);
        }
    }

    $listado_funciones_usadas = busca_filtro_tabla("a.nombre AS nombre_funcion,b.idpantalla_funcion_exe", "pantalla_funcion a, pantalla_funcion_exe b", "a.idpantalla_funcion=b.fk_idpantalla_funcion AND b.accion='mostrar' AND b.pantalla_idpantalla=" . $pantalla[0]["idpantalla"], "", $conn);
    $cadena_funcion = '';
    for ($i = 0; $i < $listado_funciones_usadas['numcampos']; $i++) {
        $cadena_funcion = $listado_funciones_usadas[$i]['nombre_funcion'];
        $parametros_funcion = busca_filtro_tabla("", "pantalla_func_param a", "fk_idpantalla_funcion_exe=" . $listado_funciones_usadas[$i]['idpantalla_funcion_exe'], "a.idpantalla_func_param ASC", $conn);
        $cadena_parametros = '';
        $vector_parametros = array();
        if ($parametros_funcion['numcampos']) {
            for ($j = 0; $j < $parametros_funcion['numcampos']; $j++) {
                switch ($parametros_funcion[$j]['tipo']) {
                    case 1: // campo
                        $dato_campo = busca_filtro_tabla("", "pantalla_campos", "idpantalla_campos=" . $parametros_funcion[$j]['valor'], "", $conn);
                        if ($dato_campo["numcampos"]) {
                            $vector_parametros[] = '$' . $pantalla[0]["nombre"] . '->get_valor_' . $pantalla[0]["nombre"] . '("' . $dato_campo[0]["tabla"] . '","' . $dato_campo[0]["nombre"] . '")';
                        }
                        break;
                    case 2: // dato
                        $vector_parametros[] = '"' . $parametros_funcion[$j]['valor'] . '"';
                        break;
                    case 3: // request
                        $vector_parametros[] = '$_REQUEST["' . $parametros_funcion[$j]['valor'] . '"]';
                        break;
                } // fin switch
            } // fin for
            $cadena_parametros = '(' . implode(',', $vector_parametros) . ')';
        } else { // fin if numcampos $parametros_funcion
            $cadena_parametros = '()';
        }
        $cad_orig = "{*" . $cadena_funcion . "@" . $listado_funciones_usadas[$i]['idpantalla_funcion_exe'] . "*}";
        $cad_destino = '<' . '?php echo(' . $cadena_funcion . $cadena_parametros . '); ?' . '>';
        $texto = str_replace($cad_orig, $cad_destino, $texto);
    }
    return ($texto);
}

function generar_mostrar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $retorno = array(
        "mensaje" => "Error al tratar de generar el mostrar de la pantalla",
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $ruta_db_superior . $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"];
    if (!@$_REQUEST["mostrar_codificado"]) {
        if (filesize($ruta_carpeta . "/dato_mostrar_" . $pantalla[0]["nombre"] . ".php") > 50) {
            $_REQUEST["mostrar_codificado"] = file_get_contents($ruta_carpeta . "/dato_mostrar_" . $pantalla[0]["nombre"] . ".php");
            if ($_REQUEST["mostrar_codificado"] === false) {
                $retorno["exito"] = 0;
                $retorno["mensaje"] = "generar_mostrar: Error al cargar el archivo de datos " . $ruta_carpeta . "/dato_mostrar_" . $pantalla[0]["nombre"] . ".php";
                return ($retorno);
            }
        } else {
            $_REQUEST["mostrar_codificado"] = '<p></p>';
        }
    }
    if (crear_destino($ruta_carpeta) != '' && @$_REQUEST["mostrar_codificado"]) {
        $ruta_datos = $ruta_carpeta . "/dato_mostrar_" . $pantalla[0]["nombre"] . ".php";
        $nombre_archivo = $ruta_carpeta . "/mostrar_" . $pantalla[0]["nombre"] . ".php";
        $texto_pantalla = encabezado_pantalla($pantalla);
        $texto_pantalla .= encabezado_pantalla_mostrar($pantalla);
        $texto_pantalla .= parsear_pantalla_mostrar($pantalla, "mostrar_codificado");
        $texto_pantalla .= footer_pantalla_mostrar($pantalla);
        $texto_pantalla .= footer_pantalla($pantalla, "mostrar");

        guardar_encabezado_pie($idpantalla, @$_REQUEST["encabezado"], @$_REQUEST["pie"]);
        if (file_put_contents($nombre_archivo, $texto_pantalla) !== false) {
            // chmod($ruta_datos,PERMISOS_ARCHIVOS);

            if (file_put_contents($ruta_datos, @$_REQUEST["mostrar_codificado"]) !== false) {
                // chmod($nombre_cuerpo,PERMISOS_ARCHIVOS);
                // Valida que el archivo creado tenga informacion, de lo contrario no actualiza el cuerpo de la pantalla
                if (filesize($ruta_datos) > 50) {
                    // $sql2="UPDATE pantalla SET cuerpo_pantalla='".addslashes($_REQUEST["mostrar_codificado"])."' WHERE idpantalla=".$idpantalla;
                    phpmkr_query($sql2);
                }
            }
            $retorno["mensaje"] = "Archivo: " . $nombre_archivo . " creado o actualizado con &eacute;xito";
            $retorno["exito"] = 1;
        } else {
            $retorno["exito"] = 0;
            $retorno["mensaje"] = "generar_mostrar: Error al crear el archivo " . $nombre_archivo;
        }
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "generar_mostrar: Error al crear la carpeta " . $ruta_carpeta;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function guardar_encabezado_pie($idpantalla, $encabezado, $pie) {
    global $conn, $ruta_db_superior;
    $buscar = busca_filtro_tabla("", "pantalla_encabezado a", "a.fk_idpantalla=" . $idpantalla, "", $conn);
    if (!$buscar["numcampos"]) {
        $sql1 = "insert into pantalla_encabezado(fk_idpantalla, encabezado, pie)values('" . $idpantalla . "', '" . $encabezado . "', '" . $pie . "')";
    } else {
        $sql1 = "update pantalla_encabezado set encabezado='" . $encabezado . "', pie='" . $pie . "' where idpantalla_encabezado=" . $buscar[0]["idpantalla_encabezado"];
    }
    phpmkr_query($sql1);
}

function generar_listar($idpantalla, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $sql1 = '';
    $retorno = new stdClass();
    $retorno->mensaje = "Error al tratar de generar el listar de la pantalla";
    $retorno->exito = 0;
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $idbusqueda = 0;
    if ($pantalla["numcampos"]) {
        if ($pantalla[0]["tipo_pantalla"] == 3) {
            $retorno->mensaje = "Las pantallas Auxiliares no generan Listados";
            $retorno->descripcion_error = "Las pantallas Auxiliares no generan Listados";
            $retorno->exito = 0;
            if ($tipo_retorno == 1) {
                die(json_encode($retorno));
            } else {
                return ($retorno);
            }
        }
        $busqueda = busca_filtro_tabla("", "busqueda", "nombre LIKE 'pantalla_" . $pantalla[0]["nombre"] . "'", "", $conn);
        if ($busqueda["numcampos"]) {
            $retorno->mensaje = "La pantalla ya se encuentra creada con el identificador " . $busqueda[0]["idpantalla"];
            $retorno->idbusqueda = $busqueda[0]["idbusqueda"];
            $retorno->exito = 0;
            $idbusqueda = $busqueda[0]["idbusqueda"];
        } else {
            $campos_pantalla = busca_filtro_tabla("", "pantalla_campos", "pantalla_idpantalla=" . $idpantalla . " AND tabla<>'' AND nombre <>'id" . $pantalla[0]["nombre"] . "'", "", $conn);
            $tablas = extrae_campo($campos_pantalla, "tabla", "U,L");
            $ltablas = array();
            $lcampos = array();
            $i = 65;
            foreach ($tablas as $key => $valor) {
                $campos = busca_filtro_tabla("nombre", "pantalla_campos A", "A.tabla='" . $valor . "' AND pantalla_idpantalla=" . $pantalla[0]["idpantalla"] . " AND nombre<>'id" . $pantalla[0]["nombre"] . "'", "GROUP BY nombre", $conn);
                if ($i < 90) {
                    $alias = chr($i);
                } else {
                    $alias = " A" . $i;
                }
                array_push($ltablas, $valor . " " . $alias);
                $campos_temp = array();
                for ($k = 0; $k < $campos["numcampos"]; $k++) {
                    array_push($campos_temp, $alias . "." . $campos[$k]["nombre"]);
                }
                $lcampos = array_merge($lcampos, $campos_temp);
                $i++;
            }
            $librerias = '';
            $librerias_pantalla = '';
            // tipo_busqueda=1 listado, 2=tabla, ruta_librerias=librerias que deben ir en el encabezado, ruta_librerias_pantalla=librerias que deben ir en el footer
            $sql1 = "INSERT INTO busqueda(nombre, etiqueta, estado, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda) VALUES('pantalla_" . $pantalla[0]["nombre"] . "','" . $pantalla[0]["etiqueta"] . "', 1, '" . implode(",", $lcampos) . "','id" . $pantalla[0]["nombre"] . "','" . implode(",", $ltablas) . "','" . $libreias . "','" . $librerias_pantalla . "',10,500,'pantallas/busquedas/consulta_busqueda.php',1)";
            phpmkr_query($sql1);
            $idbusqueda = phpmkr_insert_id();
        }
    }
    if ($idbusqueda) {
        $modulo = busca_filtro_tabla("", "modulo", "nombre LIKE 'pantalla_" . $pantalla[0]["nombre"] . "'", "", $conn);
        if (!$modulo["numcampos"]) {
            $retorno2 = generar_modulo($idpantalla, 0);
            if ($retorno2["exito"]) {
                $modulo[0]["idmodulo"] = $retorno2["idmodulo"];
            } else {
                $retorno->mensaje .= '<br>No es posible generar el m&oacute;dulo.';
                $modulo[0]["idmodulo"] = 0;
            }
        }
        $componente = busca_filtro_tabla("", "busqueda_componente", "busqueda_idbusqueda=" . $idbusqueda . " AND nombre='pantalla_" . $pantalla[0]["nombre"] . "'", "", $conn);
        if ($componente["numcampos"]) {
            $idcomponente = $componente[0]["idbusqueda_componente"];
            if (@$_REQUEST["mostrar_codificado"] != '') {
                $sql2 = "UPDATE busqueda_componente SET info='" . $_REQUEST["mostrar_codificado"] . "' WHERE idbusqueda_componente=" . $idcomponente;
                phpmkr_query($sql2);
            }
        } else {
            $sql1 = "INSERT INTO busqueda_componente(busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, encabezado_componente, estado, cargar,campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, modulo_idmodulo, librerias_componente, menu_busqueda_superior, enlace_adicionar) VALUES(" . $idbusqueda . ",3,2,'','" . $pantalla[0]["etiqueta"] . "','pantalla_" . $pantalla[0]["nombre"] . "',1,'" . $_REQUEST["mostrar_codificado"] . "','',2,2,'','','','',''," . intval($modulo[0]["idmodulo"]) . ",'','','pantallas/" . $pantalla[0]["nombre"] . "/adicionar_" . $pantalla[0]["nombre"] . ".php')";
            phpmkr_query($sql1);
            $idcomponente = phpmkr_insert_id();
        }
        if (!$idcomponente) {
            $retorno->exito = 0;
            $rteorno->mensaje .= '<br>No es posible crear el componente ' . $sql1;
        }
    } else {
        $retorno->exito = 0;
        $retorno->mensaje = 'Existe un error al crear la b&uacute;squeda pantalla_' . $pantalla[0]["nombre"] . " <br>" . $sql1;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function generar_modulo($idpantalla, $tipo_retorno) {
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $mensaje = "error al tratar de generar el m&oacute;dulo relacionado con la pantalla";
    $err_code = 0;
    if ($pantalla["numcampos"]) {
        $modulo_formatos = busca_filtro_tabla("A.idmodulo", "modulo A", "A.nombre='modulo_formatos'", "", $conn);
        $existe_modulo = busca_filtro_tabla("", "modulo A", "A.nombre='" . $pantalla[0]["nombre"] . "'", "", $conn);
        if (!$existe_modulo["numcampos"]) {
            $sql1 = "INSERT INTO modulo(nombre,etiqueta,tipo,imagen,enlace,cod_padre,orden)VALUES('" . $pantalla[0]["nombre"] . "','" . $pantalla[0]["etiqueta"] . "','secundario','botones/formatos/modulo.gif','" . $pantalla[0]["ruta_pantalla"] . "/adicionar_" . $pantalla[0]["nombre"] . ".php','" . $modulo_formatos[0]["idmodulo"] . "','1')";
            phpmkr_query($sql1) or die($sql1);
            $mensaje = "Se ha generado el m&oacute;dulo relacionado con la pantalla";
            $err_code = 1;
        } else {
            $mensaje = "El m&oacute;dulo relacionado con la pantalla " . $pantalla[0]["nombre"] . " ya existe";
            $err_code = 1;
        }
    }

    $retorno = array(
        "exito" => $err_code,
        "mensaje" => $mensaje
    );
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function vincular_librerias_componente($pantalla) {
    $campos_pantalla = busca_filtro_tabla("", "pantalla_campos A, pantalla_componente B", "A.etiqueta_html=B.nombre AND A.pantalla_idpantalla=" . $pantalla[0]["idpantalla"], "", $conn);
    for ($i = 0; $i < $campos_pantalla["numcampos"]; $i++) {
        $librerias = explode(",", $campos_pantalla[$i]["librerias"]);
        foreach ($librerias as $key => $libreria) {
            if ($libreria != '') {
                $extension = explode(".", $libreria);
                $cant = count($extension);
                if (strpos($extension[$cant - 1], "@h") === false) {
                    incluir_librerias_pantalla($pantalla[0]["idpantalla"], 0, $libreria, "footer", 2, "a,e,b");
                } else {
                    $libreria = str_replace("@h", "", $libreria);
                    incluir_librerias_pantalla($pantalla[0]["idpantalla"], 0, $libreria, "head", 2, "a,e,b");
                }
            }
        }
        incluir_librerias_pantalla($pantalla[0]["idpantalla"], 0, 'pantallas/generador/' . $campos_pantalla[$i]["nombre"] . '/procesar_componente.php', "head", 2, "a,e,b,m");
    }
}

function validar_nombre_pantalla($datos, $tipo_retorno) {
    global $ruta_db_superior, $conn;
    $retorno = new stdClass();
    $retorno->existe = 0;
    $nombre_pantalla = $datos['nombre_pantalla'];
    $busca_pantalla = busca_filtro_tabla("", "pantalla", "lower(nombre)='" . $nombre_pantalla . "'", "", $conn);
    if ($busca_pantalla['numcampos']) {
        $retorno->existe = 1;
    }
    echo (json_encode($retorno));
}

function vincular_libreria_pantalla($datos, $tipo_retorno) {
    global $ruta_db_superior, $conn;

    $retorno = array();
    $retorno['exito_libreria'] = 0;
    $retorno['exito_include'] = 0;
    $retorno['existe_include'] = 0;

    // INSERT pantalla_libreria
    $existe_libreria = busca_filtro_tabla("idformato_libreria", "formato_libreria", "ruta LIKE '" . $datos['ruta_libreria'] . "' AND formato_idformato=" . $datos["idformato"], "", $conn);
    if (!$existe_libreria['numcampos']) {

        $fieldList = array();
        $fieldList["formato_idformato"] = $datos['idformato'];
        $fieldList["ruta"] = $datos['ruta_libreria'];
        $fieldList["funcionario_idfuncionario"] = $_SESSION['idfuncionario'];
        $fieldList["orden"] = 1;
        $tabla = "formato_libreria";
        $strsql = "INSERT INTO " . $tabla . " (fecha,";
        $strsql .= implode(",", array_keys($fieldList));
        $strsql .= ") VALUES (" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'";
        $strsql .= implode("','", array_values($fieldList));
        $strsql .= "')";
        phpmkr_query($strsql);
        $idpantalla_libreria = phpmkr_insert_id();
        if ($idpantalla_libreria) {
            $retorno['exito_libreria'] = 1;
        }
    } else {
        $idpantalla_libreria = $existe_libreria[0]['idformato_libreria'];
        $retorno['existe_include'] = 1;
    }
    $retorno['idpantalla_libreria'] = $idpantalla_libreria;
    echo (json_encode($retorno));
}

function crear_modulo_formato($idformato) {
    global $conn;
    $idmodulo = 0;
    $datos_formato = busca_filtro_tabla("nombre,etiqueta,cod_padre,ruta_mostrar,ruta_adicionar", "vpantalla_formato", "idformato=" . $idformato, "", $conn);
    // este modulo debe estar creado y debe ser el modulo principal para visualizar los formatos del menu documentos
    $modulo_formato = busca_filtro_tabla("", "modulo", "(nombre = 'modulo_formatos')", "", $conn);
    
    $papa = null;
    if ($modulo_formato["numcampos"]) {
        $submodulo_formato = busca_filtro_tabla("", "modulo", "nombre ='" . $datos_formato[0]["nombre"] . "'", "", $conn);
        if (!$submodulo_formato["numcampos"]) {
            $padre = busca_filtro_tabla("idmodulo", "vpantalla_formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
            
            if ($padre["numcampos"] > 0) {
                $papa = $padre[0]["idmodulo"];
            } else {
                $papa = $modulo_formato[0]["idmodulo"];
            }
            $sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,cod_padre,orden) VALUES ('" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','" . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_mostrar"] . "','" . $papa . "','1')";
            phpmkr_query($sql, $conn) or die("Error al crear el modulo: $sql");
            $modulo_id = phpmkr_insert_id();
           
            $sql = "INSERT INTO permiso(funcionario_idfuncionario,modulo_idmodulo) VALUES('" . $_SESSION['idfuncionario'] . "'," . $modulo_id . ")";
            
            phpmkr_query($sql) or die("Error al crear los permisos: $sql");
            
        } else {
            $padre = busca_filtro_tabla("idmodulo", "vpantalla_formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
            if ($padre["numcampos"] > 0) {
                $papa = $padre[0]["idmodulo"];
            } else {
                $papa = $modulo_formato[0]["idmodulo"];
            }
            $sql = "update modulo set nombre='" . $datos_formato[0]["nombre"] . "',etiqueta='" . $datos_formato[0]["etiqueta"] . "',cod_padre='" . $papa . "' where idmodulo=" . $submodulo_formato[0]["idmodulo"];
            phpmkr_query($sql, $conn);
            $modulo_id = $submodulo_formato[0]["idmodulo"];
        }
    }
    $modulo_crear = busca_filtro_tabla("", "modulo", "nombre = 'creacion_formatos'", "", $conn);
    if ($modulo_crear["numcampos"]) {
        $submodulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'crear_" . $datos_formato[0]["nombre"] . "'", "", $conn);
        if (!$submodulo_formato["numcampos"]) {
            if(empty($papa)) {
                $papa = $modulo_crear[0]["idmodulo"];
            }
            $sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,cod_padre,orden) VALUES ('crear_" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','Crear " . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_adicionar"] . "','" . $papa . "','1')";
            phpmkr_query($sql, $conn);
        }
    }
    return $modulo_id;
}

function generar_archivos_ignorados($idpantalla, $tipo_retorno) {
    global $ruta_db_superior;
    $retorno = array(
        "mensaje" => "Error al tratar de ignorar los archivos ignorados de la pantalla",
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "pantalla", "idpantalla=" . $idpantalla, "", $conn);
    $ruta_carpeta = $pantalla[0]["ruta_pantalla"] . "/" . $pantalla[0]["nombre"] . "/";
    $nombre_pantalla = $pantalla[0]["nombre"];
    $vector_ignorar = array(
        "adicionar",
        "buscar",
        "class",
        "editar",
        "eliminar",
        "encabezado",
        "librerias",
        "mostrar",
        "pie"
    );
    $cadena_ignorados = "";
    for ($i = 0; $i < count($vector_ignorar); $i++) {
        $cadena_ignorados .= $vector_ignorar[$i] . "_" . $nombre_pantalla . ".php" . "\n";
    }
    $cadena_ignorados .= ".gitignore" . "\n";
    if (!$pantalla[0]['versionar']) {
        $cadena_ignorados = "*";
    }
    $cadena_ignore = $ruta_db_superior . $ruta_carpeta . ".gitignore";
    $fp = fopen($cadena_ignore, 'w+');
    if ($fp) {
        $escribe = fwrite($fp, $cadena_ignorados);
        if ($escribe) {
            $retorno["mensaje"] = "Archivos ignorados con &eacute;xito";
            $retorno["exito"] = 1;
        }
        fclose($fp);
    }
    chmod($cadena_ignore, PERMISOS_ARCHIVOS);
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function insertar_anexo_formato($idformato, $form_uuid, $idanexos) {
    global $conn, $ruta_db_superior;
    require_once ($ruta_db_superior . 'StorageUtils.php');
    require_once ($ruta_db_superior . 'filesystem/SaiaStorage.php');
    $ok = 0;
    $larchivos = array();
    if ($idformato != "") {
        $tipo_almacenamiento = "archivos";
        $archivos = busca_filtro_tabla("", "anexos_tmp", "uuid = $form_uuid AND idanexos_tmp=" . $idanexos, "", $conn);

        $buscar_formatos = busca_filtro_tabla("nombre", "formato", "idformato = $idformato", "", $conn);
        if ($buscar_formatos["numcampos"]) {
            $nombre_formato = $buscar_formatos[0]["nombre"];
        }
        $almacenamiento = new SaiaStorage($tipo_almacenamiento);
        if ($archivos["numcampos"]) {
            for ($j = 0; $j < $archivos["numcampos"]; $j++) {
                $ruta_temporal = $ruta_db_superior . $archivos[$j]["ruta"];

                if (file_exists($ruta_temporal)) {

                    $nombre = $archivos[$j]["etiqueta"];
                    $datos_anexo = pathinfo($ruta_temporal);

                    $temp_filename = uniqid() . "." . $datos_anexo["extension"];
                    // $dir_anexos = selecciona_ruta_anexos2($iddoc,"archivos");
                    $dir_anexos = "configuracion/formatos/" . $nombre_formato . "/";
                    $retorno["dir_anexos"] = $dir_anexos;
                    // return $retorno;

                    if (is_file($ruta_temporal)) {
                        $resultado = $almacenamiento->copiar_contenido_externo($ruta_temporal, $dir_anexos . $temp_filename);
                    }
                    $retorno["resultado"] = $resultado;

                    if ($resultado) {
                        $dir_anexos_1 = array(
                            "servidor" => $almacenamiento->get_ruta_servidor(),
                            "ruta" => $dir_anexos . $temp_filename
                        );
                        $campos = array(
                            "idformato" => $idformato,
                            "ruta" => "'" . json_encode($dir_anexos_1) . "'",
                            "etiqueta" => "'" . $nombre . "'",
                            "tipo" => "'" . $datos_anexo["extension"] . "'",
                            "fecha_anexo" => fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s')
                        );

                        if ($tipo_almacenamiento == "archivos") { // Los anexos estan guardados en archivos

                            $sql2 = "INSERT INTO formato_previo(" . implode(", ", array_keys($campos)) . ") values (" . implode(", ", array_values($campos)) . ")";
                            phpmkr_query($sql2, $conn) or alerta("No se puede Adicionar el Anexo " . $ruta_temporal, 'error', 4000);
                            $idanexo = phpmkr_insert_id();
                            // return $sql2;
                            $retorno["idanexo"] = $idanexo;
                            // return $retorno;
                        }
                        $ok = 1;
                        if ($idanexo) {
                            // eliminar el temporal
                            unlink($ruta_temporal);
                            unlink("$ruta_temporal.lock");

                            $update = "UPDATE formato SET documentacion=" . $idanexo . " WHERE idformato=" . $idformato;
                            phpmkr_query($update);
                            array_push($larchivos, $idanexo);

                            // Eliminar los pendientes de la tabla temporal
                            $sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = " . $archivos[$j]["idanexos_tmp"];
                            phpmkr_query($sql2) or die($sql2);
                            $retorno["delete"] = $sql2;
                            // return $retorno;
                            if (array_key_exists($nombre, $permisos)) {
                                $propio = $permisos[$nombre]["propio"];
                                $dependencia = $permisos[$nombre]["dependencia"];
                                $cargo = $permisos[$nombre]["cargo"];
                                $total = $permisos[$nombre]["total"];
                            } else {
                                $propio = "lem";
                                $dependencia = "";
                                $cargo = "";
                                $total = "l";
                            }
                            /*
                             * $sql_permiso = "insert into permiso_anexo(anexos_idanexos,idpropietario,caracteristica_propio,caracteristica_dependencia,caracteristica_cargo,caracteristica_total) values('$idanexo','" . usuario_actual("idfuncionario") . "','$propio','$dependencia','$cargo','$total')";
                             * phpmkr_query($sql_permiso, $conn);
                             * $retorno["permiso"]=$sql_permiso;
                             * $ok=1;
                             */
                        }
                    } else {
                        alerta("!Se produjo un error al copiar el archivo " . $nombre, 'error', 4000);
                        $ok = 2;
                    }
                } else {
                    alerta("!No se encontró el archivo " . $nombre, 'error', 4000);
                    $ok = 2;
                }
            }
        }
    }
    return ($retorno);
}

function quitar_preposiciones_articulos($texto) {
    $separarTexto = explode(" ", $texto);

    /*
     * con este foreach lo que hago es que quito las palabras que sean
     * de menos de 3 caracteres como lo son las, los, un, una y todas esas
     */
    /*
     * foreach($separarTexto as $valor){
     * $caracteres = strlen($valor); // cuento el numero de caracteres
     * if($caracteres > '3'){ // verifico que sea mayor que 3
     * $etiquetas[] = $valor; // agrego la palabra al array etiquetas si es mayor que 3
     * }
     * }
     */
    $articulos_preposiciones = array(
        'a',
        'y',
        'lo',
        'los',
        'la',
        'el',
        'es',
        'un',
        'de',
        'muy',
        'con',
        'unos',
        'unas',
        'este',
        'estos',
        'esos',
        'aquel',
        'aquellos',
        'esta',
        'estas',
        'esas',
        'aquella',
        'aquellas',
        'éste',
        'éstos',
        'ésos',
        'aquél',
        'aquéllos',
        'ésta',
        'éstas',
        'ésas',
        'aquélla',
        'aquéllas',
        'delete',
        'insert',
        'update',
        'ante',
        'bajo',
        'cabe',
        'desde',
        'contra',
        'entre',
        'hacia',
        'hasta',
        'para',
        'por',
        'según',
        'segun',
        'sin',
        'sobre',
        'tras'
    );

    // $resultado = str_replace($articulos_preposiciones,"",$etiquetas);
    $resultado = array_diff($separarTexto, $articulos_preposiciones);
    for ($i = 0; $i < count($resultado); $i++) {
        if ($resultado[$i] == "") {
            unset($resultado[$i]);
        }
    }
    $resultado = array_values($resultado);
    // retorno el resultado
    return $resultado;
}

function validar_nombres($texto) {
    // buscar si existe el nombre
    global $conn;
    $cant = strlen($texto);
    // print_r($texto);
    $buscar_nombres = busca_filtro_tabla("", "formato", "nombre='$texto'", "", $conn);
    $i = 0;
    if ($buscar_nombres["numcampos"]) {
        $i = substr($texto, -3);
        if (strpos($i, "_")) {
            $i++;
        } else {
            $i = 1;
        }
        if (($cant + 3) < 23) {
            $sumar_cant = $cant + 3;
            $nuevo_texto = str_pad($texto, $sumar_cant, "_0" . $i, STR_PAD_RIGHT);
            validar_nombres($nuevo_texto);
        }
    } else {
        $nuevo_texto = $texto;
    }
    return $nuevo_texto;
}
?>
