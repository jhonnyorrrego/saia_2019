<?php
date_default_timezone_set('America/Bogota');

require_once 'StorageUtils.php';
require_once 'filesystem/SaiaStorage.php';

use Gaufrette\StreamMode;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;

defineGlobalVars();

/**
 * define las variables globales
 */
function defineGlobalVars()
{
    if (!$_SESSION) {
        session_start();
    }

    $GLOBALS['sql'] = '';
    $GLOBALS['conn'] = Sql::getInstance();
}

/*
<Clase>
<Nombre>registrar_accion_digitalizacion
<Parametros>$iddoc:id del documento;$accion:accion ejecutada;$justificacion: descripcion que se llena cuando se borra una pagina
<Responsabilidades>crea un registro de cierta accion sobre cierto documento en la tabla digitalizacion
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function registrar_accion_digitalizacion($iddoc, $accion, $justificacion = '')
{
    global $conn;
    $usu = SessionController::getValue('usuario_actual');
    $fecha = fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
    $sql = "insert into digitalizacion(funcionario,documento_iddocumento,accion,justificacion,fecha) values('$usu','$iddoc','$accion','$justificacion',$fecha)";
    phpmkr_query($sql, $conn);
}

/**
 * convierte una cadena a mayusculas
 *
 * @param string $string
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function mayusculas($string)
{
    $string = strtoupper($string);
    return str_replace(
        ["ACUTE;", "TILDE;", "&IQUEST;", "UML;"],
        ["acute;", "tilde;", "&iquest;", "uml;"],
        $string
    );
}

/*<Clase>
<Nombre>leido</Nombre>
<Parametros>$codigo:codigo del funcionario;$llave:id del documento</Parametros>
<Responsabilidades>Marca el documento como leido por la persona que corresponda<Responsabilidades>
<Notas>hace una transferencia del usuario actual para el mismo con el estado LEIDO</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function leido($codigo, $llave)
{
    global $conn;
    $pendiente = busca_filtro_tabla(fecha_db_obtener("fecha_inicial", "Y-m-d H:i:s") . " as fecha_inicial", "asignacion", "documento_iddocumento=" . $llave . " and llave_entidad=" . $codigo, "fecha_inicial DESC", $conn);
    if ($pendiente["numcampos"] > 0) {
        $leido = busca_filtro_tabla("nombre,idtransferencia", "buzon_entrada", "archivo_idarchivo=$llave and origen=$codigo and nombre='LEIDO' AND fecha >= " . fecha_db_almacenar($pendiente[0]["fecha_inicial"], "Y-m-d H:i:s"), "", $conn);
        if (!$leido["numcampos"]) {
            $insertar = "insert into buzon_salida(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
            $insertar .= " values(" . $llave . ",'LEIDO'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$codigo,1,$codigo,1,'DOCUMENTO')";
            phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_salida:' . $insertar);
            $insertar = "insert into buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
            $insertar .= " values(" . $llave . ",'LEIDO'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$codigo,1," . $codigo . ",1,'DOCUMENTO')";
            phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_entrada:' . $insertar);
        }
    } else {
        $leido = busca_filtro_tabla("nombre,idtransferencia", "buzon_salida", "archivo_idarchivo=$llave and destino='$codigo'", "fecha desc", $conn);
        if (!$leido["numcampos"] || $leido[0]["nombre"] <> "LEIDO") {
            $insertar = "insert into buzon_salida(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
            $insertar .= " values(" . $llave . ",'LEIDO'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$codigo,1,$codigo,1,'DOCUMENTO')";
            phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_salida:' . $insertar);
            $insertar = "insert into buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
            $insertar .= " values(" . $llave . ",'LEIDO'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$codigo,1," . $codigo . ",1,'DOCUMENTO')";
            phpmkr_query($insertar, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL buzon_entrada:' . $insertar);
        }
    }
}

/*<Clase>
<Nombre>listar_campos_tabla</Nombre>
<Parametros>$tabla:nombre de la tabla</Parametros>
<Responsabilidades>crea una lista con los nombres de los campos de una tabla<Responsabilidades>
<Notas>el nombre de la tabla puede llegar por parametro o por el request</Notas>
<Excepciones></Excepciones>
<Salida>vector con los nombres de los campos de la tabla especificada</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function listar_campos_tabla($tabla = null, $tipo_retorno = 0)
{
    global $conn;
    return $conn->listar_campos_tabla($tabla, $tipo_retorno);
}

/*
<Clase>
<Nombre>guardar_lob</Nombre>
<Parametros>$campo:nombre del campo;$tabla:nombre de la tabla;$condicion:condicion de actualización;$contenido:texto a insertar o actualizar;$tipo:puede ser 'texto' o 'archivo';$conn:objeto de conexion;$log:si se debe guardar lo hecho en el log, puede ser 0 o 1</Parametros>
<Responsabilidades>Se encarga de insertar y actualizar los campos de tipo CLOB<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $conn, $log = 1)
{
    return $conn->guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log);
}

/*
<Clase>
<Nombre>evento_archivo</Nombre>
<Parametros>$cadena:cadena con los datos que se insertaron en la bd</Parametros>
<Responsabilidades>Guarda en un archivo la copia de los eventos registrados en el log, cada vez que se inserta un registro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function evento_archivo($cadena)
{
    $storage = new SaiaStorage(RUTA_BACKUP_EVENTO);
    $nombre = DB . "_log_" . date("Y_m_d") . ".txt";
    $filesystem = $storage->get_filesystem();
    $contenido = "";

    if ($filesystem->has($nombre)) {
        $mode = "ab";
        $contenido = $cadena . "*|*";
    } else {
        $mode = "wb";
        $contenido = "idevento|||funcionario_codigo|||fecha|||evento|||tabla_e|||estado|||detalle|||registro_id|||codigo_sql*|*" . $cadena . "*|*";
    }

    $stream = $filesystem->createStream($nombre);
    $stream->open(new StreamMode($mode));
    $stream->write($contenido);
    $stream->close();
}

function normalizePath($path)
{
    return array_reduce(explode('/', $path), create_function('$a, $b', '
			if($a === 0)
				$a = "/";

			if($b === "" || $b === ".")
				return $a;

			if($b === "..")
				return dirname($a);

			return preg_replace("/\/+/", "/", "$a/$b");
		'), 0);
}

/*
<Clase>
<Nombre>formato_cargo</Nombre>
<Parametros>$nombre_cargo:texto que corresponde al nombre de un cargo</Parametros>
<Responsabilidades>Formatea con ciertas caracteristicas el texto recibido<Responsabilidades>
<Notas>valida que los números romanos queden en mayuscula sostenida, pero los articulos no, las demás palabras con mayúscula inicial</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function formato_cargo($nombre_cargo)
{
    $cargo = "";
    $pal = '';
    if ($nombre_cargo != '')
        $pal = explode(" ", strtolower($nombre_cargo));
    $cant = count($pal);
    for ($i = 0; $i < $cant; $i++) {
        if ($pal[$i] == "del" || $pal[$i] == "de" || $pal[$i] == "y" || $pal[$i] == "en" || $pal[$i] == "al" || $pal[$i] == "los" || $pal[$i] == "a")
            $cargo .= $pal[$i] . " ";
        else if ($pal[$i] == "ii" || $pal[$i] == "iii" || $pal[$i] == "iv" || $pal[$i] == "vi" || $pal[$i] == "vii" || $pal[$i] == "ix" || $pal[$i] == "viii")
            $cargo .= strtoupper($pal[$i]) . " ";
        else {
            $tilde = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
            $reemplazo = array("{á", "é", "í", "ó", "ú", "ñ");
            $pal[$i] = str_replace($tilde, $reemplazo, $pal[$i]);
            $cargo .= ucwords($pal[$i]) . " ";
        }
    }
    return $cargo;
}

/*
<Clase>
<Nombre>phpmkr_db_close
<Parametros>$conn: objeto que contiene la conexion a la base de datos
<Responsabilidades>Cerrar la conexión actual
<Notas>Examina que la conexion exista y si es asi se encarga de cerrarla
<Excepciones>Error al cerrar la base de datos. Si la conexion que se quiere cerrar no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_db_close($conn)
{
    $conn->disconnect();
}

/*
<Clase>
<Nombre>phpmkr_query
<Parametros>sql: cadena que contiene la sentencia sql a ejecutar
            conectar: objeto que contiene la conexion con la base de datos
<Responsabilidades>ejecutar la sentencia sql y guardar el registro de dicha transaccion en el log, es decir, en la tabla evento
<Notas>Examina la cadena y realiza las acciones dependiendo del tipo de evento que se quiera realizar sobre la base de datos
       Ejecuta la cadena misma y otra que inserta el registro en la tabla que lleva el log de las acciones realizadas.
<Excepciones>Error al ejecutar la busqueda. Si la conexion sobre la que se quiere ejecutar la cadena no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_query($sql)
{
    global $conn;
    return $conn->Ejecutar_Sql($sql);
}

/*
<Clase>
<Nombre>phpmkr_num_fields
<Parametros>$rs puntero que contiene el resultado de una consulta
<Responsabilidades>Retornar el numero de columnas que contiene $rs
<Notas>
<Excepciones>Error en el numero de campos, Si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_num_fields($rs)
{
    global $conn;
    return $conn->Numero_Campos($rs);
}

/*
<Clase>
<Nombre>phpmkr_field_name
<Parametros>$rs: objeto que contiene la consulta, $pos: posicion de la consulta
<Responsabilidades>Retornar el nombre de la columna $pos en la busqueda $rs
<Notas>
<Excepciones>Error en nombre del campo. Si en la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_field_name($rs, $pos)
{
    global $conn;
    return $conn->Nombre_Campo($rs, $pos);
}
/*
<Clase>
<Nombre>phpmkr_num_rows
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>Retornar el numero de filas de la consulta
<Notas>Esta funcion no esta disponible por el momento para Oracle
<Excepciones>Error en numero de filas. Si la conexion con la base datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_num_rows($rs)
{
    global $conn;
    if ($conn) {
        if (!$rs && $conn->res)
            $rs = $conn->res;
        return $conn->Numero_Filas($rs);
    } else {
        alerta("Error en numero de filas." . $rs->sql);
        return false;
    }
}
/*
<Clase>
<Nombre>phpmkr_fetch_array
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades> Retornar un arreglo que contiene la siguiente fila de $rs
<Notas>
<Excepciones>Error en capturar resultado en arreglo. Si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_fetch_array($rs)
{
    global $conn;
    if ($conn) {
        if (!$rs && $conn->res)
            $rs = $conn->res;
        $retorno = $conn->sacar_fila($rs);
        return $retorno;
    } else {
        alerta("Error en capturar resultado en arreglo." . $rs->sql);
        return false;
    }
}
/*
<Clase>
<Nombre>phpmkr_fetch_row
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>Retonar la siguiente fila de $rs en un arreglo
<Notas>pmpmkr_fetch_row y phpmkr_fetch_array hacen exactamente lo mismo
<Excepciones>Error en capturar el resultado del arreglo, si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_fetch_row($rs)
{
    global $conn;
    if ($conn) {
        if (!$rs && $conn->res)
            $rs = $conn->res;
        $retorno = $conn->sacar_fila($rs);
        return $retorno;
    } else {
        alerta("Error en capturar resultado en arreglo." . $rs->sql);
        return false;
    }
}
/*
<Clase>
<Nombre>phpmkr_free_result
<Parametros>$rs: objeto que contiene la consulta
<Responsabilidades>libera el objeto $rs
<Notas>
<Excepciones>Error al liberar el resultado, si la conexion con la base de datos no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_free_result($rs)
{
    global $conn;
    $conn->liberar_resultado($rs);
}
/*
<Clase>
<Nombre>phpmkr_insert_id
<Parametros>
<Responsabilidades>retonar la llave primaria del ultimo registro insertado
<Notas>
<Excepciones>Error al buscar la ultima insercion. Si no existe la conexion con la base de datos
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_insert_id()
{
    global $conn;
    return $conn->Ultimo_Insert();
}
/*
<Clase>
<Nombre>phpmkr_error
<Parametros>
<Responsabilidades>invoca la funcion error de la clase sql
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function phpmkr_error()
{
    global $conn;
    $conn->mostrar_error();
}

/**
 * ejecuta una busqueda sobre la base de datos
 *
 * @param string $campos
 * @param string $tabla
 * @param string $filtro
 * @param string $orden
 * @param string $conn
 * @return void
 */
function busca_filtro_tabla($campos, $tabla, $filtro = '', $orden = '', $conn = null)
{
    $sql = "SELECT ";
    $sql .= $campos ? $campos : "*";
    $sql .= " FROM {$tabla}";
    $sql .= $filtro ? " WHERE {$filtro} " : ' ';
    $sql .= $orden ? (substr(strtolower($orden), 0, 5) == "group" ?
        $orden : "ORDER BY {$orden} ") : '';
    $sql = htmlspecialchars_decode($sql);

    $return = StaticSql::search($sql);
    $return['numcampos'] = count($return);
    $return['tabla'] = $tabla;
    $return['sql'] = $sql;
    return $return;
}

/**
 * ejecuta una busqueda sobre la base de datos
 * con un limite
 *
 * @param string $campos
 * @param string $tabla
 * @param string $filtro
 * @param string $orden
 * @param string $inicio registro inicial
 * @param string $registros cantidad de registros a consultar
 * @param string $conn
 * @return void
 */
function busca_filtro_tabla_limit($campos, $tabla, $filtro, $orden, $inicio, $registros, $conn)
{
    $sql = "SELECT ";
    $sql .= $campos ? $campos : "*";
    $sql .= " FROM {$tabla}";
    $sql .= $filtro ? " WHERE {$filtro} " : ' ';
    $sql .= $orden ? (substr(strtolower($orden), 0, 5) == "group" ?
        $orden : "ORDER BY {$orden} ") : '';
    $sql = htmlspecialchars_decode($sql);

    $return = StaticSql::search($sql, $inicio, $inicio + $registros);
    $return['numcampos'] = count($return);
    $return['tabla'] = $tabla;
    $return['sql'] = $sql;
    return $return;
}

/**
 * recorta un string
 *
 * @param string $string
 * @param int $length
 * @return void
 */
function delimita($string, $length)
{
    if (strlen($string) > $length) {
        $string = substr($string, 0, $length - 3) . '...';
    }

    return $string;
}
/*
<Clase>
<Nombre>busca_tabla
<Parametros>$tabla: tabla sobre la que realiza la busqueda
            $idtabla: identificador del registro que se quiere obtener
<Responsabilidades> Obtener en un arreglo el registro cuyo identificador es $idtabla de la tabla $tabla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function busca_tabla($tabla, $idtabla)
{
    global $sql, $conn;
    $retorno = array();
    $temp = array();
    $retorno["tabla"] = $tabla;
    switch ($tabla) {
        case ("dependencia2"):
            $tabla = "dependencia";
            break;
        case ("cargo2"):
            $tabla = "cargo";
            break;
        case ("cargo3"):
            $tabla = "dependencia_cargo";
            break;
        case ("funcionario2"):
            $tabla = "funcionario";
            break;
    }
    $motor = MOTOR;
    if ($motor == "MySql") {
        $campos = str_replace("to_char", "", $campos);
    }
    $sql = "Select DISTINCT * FROM " . $tabla . " WHERE id" . $tabla . "=" . $idtabla;
    $rs = phpmkr_query($sql, $conn) or error("Error en Busqueda de Proceso SQL: $sql");
    $temp = phpmkr_fetch_array($rs);
    for ($i = 0; $temp; $temp = phpmkr_fetch_array($rs), $i++)
        array_push($retorno, $temp);
    $retorno["numcampos"] = $i;
    phpmkr_free_result($rs);
    return $retorno;
}

/*
<Clase>
<Nombre>extrae_campo</Nombre>
<Parametros>$arreglo:es el arreglo origen, generalmente devuelto por busca_filtro_tabla;$campo: campo a buscar; bandera:parámetro adicionarl U=unico, M=mayusculas, m=minusculas, D=ordenado Descendente</Parametros>
<Responsabilidades>Retorna un arreglo ordenado ascendentemente extrayendo el campo de una matriz que debe tener 2 niveles sacando 1 el campo del segundo nivel esto se utiliza principalmente para retornos tipo BD <Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function extrae_campo($arreglo, $campo, $banderas = "U,M")
{
    $retorno = array();
    for ($i = 0; $i < $arreglo["numcampos"]; $i++) {
        $retorno[$i] = $arreglo[$i][$campo];
    }
    $band = explode(",", $banderas);
    $cont = count($band);
    for ($j = 0; $j < $cont; $j++) {
        switch ($band[$j]) {
            case "U":
                $retorno_aplicado = array_unique($retorno);
                $retorno = $retorno_aplicado;
                sort($retorno, SORT_ASC);
                break;
            case "M":
                unset($retorno_aplicado);
                $retorno_aplicado = array();
                $retorno_aplicado = array_map('strtoupper', $retorno);
                $retorno = $retorno_aplicado;
                sort($retorno, SORT_ASC);
                break;
            case "m":
                unset($retorno_aplicado);
                $retorno_aplicado = array();
                $retorno_aplicado = array_map('strtolower', $retorno);
                $retorno = $retorno_aplicado;
                sort($retorno, SORT_ASC);
                break;
            case "D":
                sort($retorno, SORT_DESC);
                break;
        }
    }
    return $retorno;
}

function sincronizar_carpetas($tipo, $conn)
{
    $idimagenes = array();
    $max_salida = 6;
    $ruta_db_superior = $ruta_arch_tmp = "";
    while ($max_salida > 0) {
        if (is_file($ruta_arch_tmp . "db.php")) {
            $ruta_db_superior = $ruta_arch_tmp;
        }
        $ruta_arch_tmp .= "../";
        $max_salida--;
    }
    include_once $ruta_db_superior . "binario_func.php";
    $rutas = array();
    $usr_tmp_dir = "";
    $dir2 = "";
    $peso = 2000000;
    $tabla = "pagina";
    $estado = "";
    $configuracion = busca_filtro_tabla("*", "configuracion A", "A.tipo='ruta' OR A.tipo='imagen' OR A.tipo='peso'", "A.idconfiguracion DESC", $conn);
    for ($i = 0; $i < $configuracion["numcampos"]; $i++) {
        switch ($configuracion[$i]["nombre"]) {
            case "temporal_digitalizacion":
                $usr_tmp_dir = $configuracion[$i]["valor"] . '_' . SessionController::getLogin();
                break;
            case "ruta_documentos":
                $dir2 = $configuracion[$i]["valor"];
                break;
            case "copia":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $copia = $configuracion[$i]["valor"];
                } else {
                    $copia = 0;
                }
                break;
            case "genera_pdf":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $pdf = $configuracion[$i]["valor"];
                } else {
                    $pdf = 0;
                }
                break;
            case "ancho_imagen":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $imgancho = $configuracion[$i]["valor"];
                } else {
                    $imgancho = 600;
                }
                break;
            case "alto_imagen":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $imgalto = $configuracion[$i]["valor"];
                } else {
                    $imgalto = 700;
                }
                break;
            case "ancho_miniatura":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $miniatura_ancho = $configuracion[$i]["valor"];
                } else {
                    $miniatura_ancho = 90;
                }
                break;
            case "alto_miniatura":
                if (is_numeric($configuracion[$i]["valor"])) {
                    $miniatura_alto = $configuracion[$i]["valor"];
                } else {
                    $miniatura_alto = 120;
                }
                break;
        }
    }
    //Define si se almacena en la BD o en archivos

    $config = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_almacenamiento'", "", $conn);
    if ($config["numcampos"]) {
        $tipo_almacenamiento = $config[0]['valor'];
    } else { // Si no encuentra el registro en configuracion almacena en archivo
        $tipo_almacenamiento = "archivo";
    }

    if ($tipo_almacenamiento == "archivo") { // Se alcenan paginas y miniaturas en la BD
        $tipo_almacenamiento == "archivos";
        if (is_dir($usr_tmp_dir)) { // ruta_temporal
            $directorio = opendir("$usr_tmp_dir");
        } else {
            $directorio = null;
        }
        if ($directorio) { //ruta_temporal
            $cont = 1;
            $ruta_arch_tmp = "";
            $cad = "";
            $cad_temp = "";
            $numero_pagina = "";
            //Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
            while ($archivo = readdir($directorio)) {
                if ($archivo != "." && $archivo != ".." && !is_dir($archivo)) {
                    $archivos[] = $archivo;
                }
            }
            natsort($archivos);
            $alm_paginas = new SaiaStorage("archivos");
            foreach ($archivos as $archivo) {
                $estado = "";
                $dir_dst = "";
                $ruta_arch_tmp = $usr_tmp_dir . "/" . $archivo;
                $path = pathinfo($ruta_arch_tmp);
                if ($archivo && $archivo != "." && $archivo != ".." && is_file("$archivo") != "dir" && (strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg') && @filesize($archivo) <= $peso) {

                    $ic = strrpos($path["basename"], "#");
                    $fc = strrpos($path["basename"], ")");
                    $cad = substr($path["basename"], $ic + 1, $fc - $ic - 1);
                    $punto = strrpos($path["basename"], ".");
                    $cadpunto = substr($path["basename"], 0, $punto);
                    $pag = strrpos($cadpunto, "g");
                    $cont = substr($cadpunto, $pag + 1);
                    if ($cad == "") {
                        $cad = "0";
                    }
                    $fieldList["id_documento"] = $cad;

                    $datos_doc = busca_filtro_tabla("estado," . fecha_db_obtener('fecha', 'Y-m') . " as fecha,iddocumento", "documento", "iddocumento=" . $fieldList["id_documento"], "", $conn);
                    $estado = $datos_doc[0]["estado"];
                    $fecha = $datos_doc[0]["fecha"];

                    $paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina", $conn);
                    $numero_pagina = $paginas["numcampos"];
                    // Este es el punto dode se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.
                    //$ruta_imagenes = ruta_almacenamiento("imagenes");
                    $alm_imagenes = new SaiaStorage("imagenes");
                    $cad2 = $fieldList["id_documento"];
                    $dir_dst = $estado . "/" . $fecha . "/" . $cad2 . "/" . $dir2 . "/";
                    $ruta_dir = $estado . "/" . $fecha . "/" . $cad2;
                    //crear_destino($dir_dst);

                    if ($numero_pagina != "") {
                        $numero_pagina = intval($numero_pagina) + 1;
                    } else {
                        $numero_pagina = 1;
                    }
                    $ruta_img_dst = $dir_dst . "doc" . $fieldList["id_documento"] . "pag" . $numero_pagina . ".jpg";

                    //NUEVO. Para redimensionar en memoria
                    $imagine = new Imagine();
                    $imagen = $imagine->open($ruta_arch_tmp);
                    $width = $imagen->getSize()->getWidth();
                    $height = $imagen->getSize()->getHeight();
                    if ($imgancho && ($width < $height)) {
                        $imgancho = ($imgalto / $height) * $width;
                    } else {
                        $imgalto = ($imgancho / $width) * $height;
                    }
                    $size  = new Box($imgancho, $imgalto);
                    //$image = $imagine->create($size);
                    $minitura = $imagen->thumbnail(new Box($miniatura_ancho, $miniatura_alto));
                    $redim = $imagen->resize($size);
                    //FIN NUEVO. Para redimensionar en memoria
                    //print_r($redim);die();
                    if ($redim) {
                        @unlink($ruta_arch_tmp);
                        $ruta2 = $ruta_img_dst;
                        $dirminiatura = $ruta_dir . "/miniaturas";
                        $ruta_img_min = $dirminiatura . "/doc" . $fieldList["id_documento"] . "pag" . $numero_pagina . ".jpg";
                        /*if (! is_dir($dirminiatura . "/")) {
    if (!mkdir($dirminiatura . "/", 0777)) {
    alerta("Problemas al crear la carpeta " . $dirminiatura . "/" . " de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
    }
    }
    chmod($dirminiatura . "/", PERMISOS_CARPETAS);*/
                        $alm_paginas->almacenar_contenido($ruta_img_dst, $imagen->get('jpeg'));
                        $alm_paginas->almacenar_contenido($ruta_img_min, $minitura->get('jpeg'));
                        $ruta_pagina = array("servidor" => $alm_paginas->get_ruta_servidor(), "ruta" => $ruta_img_dst);
                        $fieldList["ruta"] = json_encode($ruta_pagina);
                        $ruta_miniatura = array("servidor" => $alm_paginas->get_ruta_servidor(), "ruta" => $ruta_img_min);
                        $fieldList["imagen"] = json_encode($ruta_miniatura);

                        array_push($rutas, $fieldList["id_documento"]);
                        $fieldList["pagina"] = $numero_pagina;

                        $campo_adicional = "";
                        $valor_adicional = "";
                        if ($tipo == "pagina") {
                            $campo_adicional = ",fecha_pagina";
                            $valor_adicional = "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                        }
                        $strsql = "INSERT INTO $tipo(id_documento,imagen,pagina,ruta " . $campo_adicional . ") VALUES (" . $fieldList["id_documento"] . ",'" . $fieldList["imagen"] . "'," . $fieldList["pagina"] . ", '" . $fieldList["ruta"] . "' " . $valor_adicional . ")";
                        phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
                        $idpag = phpmkr_insert_id();
                        array_push($idimagenes, $idpag);
                        registrar_accion_digitalizacion($fieldList["id_documento"], 'ADICION PAGINA', "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]));
                    } else {
                        error("Existen Problemas al Cargar el Archivo: $ruta_arch_tmp");
                    }
                } else if (is_file($archivo) && filesize($archivo) > $peso) {
                    alerta($archivo . " Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
                }
                $archivo = readdir($directorio);
            }
            closedir($directorio);
        } //Fin If directorio

        //aqui desarrollo para subir digitalizacion de PDF,DOCX,ETC
        if (is_dir($usr_tmp_dir)) { // ruta_temporal
            $directorio = opendir("$usr_tmp_dir");
        } else {
            $directorio = null;
        }
        if ($directorio) { //ruta_temporal
            $cont = 1;
            $ruta_arch_tmp = "";
            $cad = "";
            $cad_temp = "";
            $numero_pagina = "";
            //Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
            while ($archivo = readdir($directorio)) {
                if ($archivo != "." && $archivo != ".." && !is_dir($archivo)) {
                    if (preg_match("/^.*(?<!\.jpg|jpeg)$/i") === 1) {
                        $archivos[] = $archivo;
                    }
                }
            }
            natsort($archivos);

            $archivos = array_values($archivos);
            $archivos_anexos = array_unique($archivos);

            $ruta_temporal = $_SESSION["ruta_temp_funcionario"];
            foreach ($archivos_anexos as $archivo) {
                $ruta_archivo = $ruta_db_superior . $ruta_temporal . '/' . $archivo;
                if (file_exists($ruta_archivo)) {
                    $ic = strrpos($archivo, "#");
                    $fc = strrpos($archivo, ")");
                    $cad = substr($archivo, $ic + 1, $fc - $ic - 1);
                    if (intval($cad) == intval(@$_REQUEST['x_id_documento'])) {
                        vincular_anexo_documento(@$_REQUEST['x_id_documento'], $ruta_temporal . '/' . $archivo);
                        unlink($ruta_archivo);
                    }
                } //fin if file_exist
            } //recorriendo directorio
        } //fin if directorio

    } elseif ($tipo_almacenamiento == "db") { // Se almacena en la base de datos
        if (is_dir($usr_tmp_dir)) { // ruta_temporal
            $directorio = opendir("$usr_tmp_dir");
        } else {
            $directorio = null;
        }
        if ($directorio) { // ruta_temporal
            $cont = 1;
            $ruta_arch_tmp = "";
            $cad = "";
            $cad_temp = "";
            // Aqui toca recorrer la carpeta que se elija como temporal para buscar el listado de las paginas que se van a subir a la base de datos.
            $archivo = readdir($directorio);

            while ($archivo) {
                $dir_dst = "";
                $ruta_arch_tmp = $usr_tmp_dir . "/" . $archivo;
                $path = pathinfo($ruta_arch_tmp);
                if ($archivo && $archivo != "." && $archivo != ".." && is_file("$archivo") != "dir" && (strtolower($path['extension']) == 'jpg' || strtolower($path['extension']) == 'jpeg') && @filesize($archivo) <= $peso) {
                    //cad define el nombre de la organizacion de las carpetas y el criterio de almacenamiento, sin embargo debe ser cambiando luego de definir el codigo del documento
                    $ic = strrpos($path["basename"], "#");
                    $fc = strrpos($path["basename"], ")");
                    $cad = substr($path["basename"], $ic + 1, $fc - $ic - 1);
                    $punto = strrpos($path["basename"], ".");
                    $cadpunto = substr($path["basename"], 0, $punto);
                    $pag = strrpos($cadpunto, "g");
                    $cont = substr($cadpunto, $pag + 1);
                    if ($cad == "") {
                        $cad = "0";
                    }
                    $fieldList["id_documento"] = $cad;
                    $num = busca_filtro_tabla("A.pagina", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"] . " AND pagina=" . $cont, "", $conn);
                    if ($num["numcampos"] && $cad_temp == "") {
                        $paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina", $conn);
                        $paginas_temporales = array();
                        for ($h = 0; $h < $paginas["numcampos"]; $h++) {
                            $punto2 = strrpos($paginas[$h]["ruta"], ".");
                            $cadpunto2 = substr($paginas[$h]["ruta"], 0, $punto2);
                            $pag2 = strrpos($cadpunto2, "g");
                            $cont2 = substr($cadpunto2, $pag2 + 1);
                            array_push($paginas_temporales, $cont2);
                            array_push($paginas_temporales, $paginas[$h]["pagina"]);
                        }
                        sort($paginas_temporales);
                        $cont3 = count($paginas_temporales);
                        $cad_temp = $paginas_temporales[$cont3 - 1];
                    }
                    //Este es el punto dode se puede hacer el cambio de carpeta en cad donde se almacenaran fisicamente las imagenes.
                    $cad2 = $fieldList["id_documento"];
                    $dir_dst = "../" . $dir2 . "/" . $cad2 . "/";

                    /*if (! is_dir($dir_dst)) {
    if (mkdir($dir_dst, 0777)) {
    $dir_dst = "../" . $dir2 . "/" . $cad2 . "/";
    } else {
    $dir_dst = "../documentos/error/" . $cad2;
    }
    }*/
                    //Me lleva hasta la Ultima pagina del documento.
                    if ($cad_temp != "") {
                        $cont = intval($cad_temp) + intval($cont);
                    }
                    //NUEVO. Para redimensionar en memoria
                    $imagine = new Imagine();
                    $imagen = $imagine->open($ruta_arch_tmp);
                    $width = $imagen->getSize()->getWidth();
                    $height = $imagen->getSize()->getHeight();
                    if ($imgancho && ($width < $height)) {
                        $imgancho = ($imgalto / $height) * $width;
                    } else {
                        $imgalto = ($imgancho / $width) * $height;
                    }
                    $size  = new Box($imgancho, $imgalto);
                    //$image = $imagine->create($size);
                    $minitura = $imagen->thumbnail(new Box($miniatura_ancho, $miniatura_alto));
                    $redim = $imagen->resize($size);
                    //FIN NUEVO. Para redimensionar en memoria
                    //print_r($redim);die();
                    if ($redim) {
                        @unlink($ruta_arch_tmp);
                        $ruta2 = $dir_dst . "doc" . $fieldList["id_documento"] . "pag" . $cont . ".jpg";
                        $dirminiatura = "../miniaturas/documentos/";
                        $ruta_img_min = $dirminiatura . $fieldList["id_documento"] . "/doc" . $fieldList["id_documento"] . "pag" . $cont . ".jpg";
                        /*if (! is_dir($dirminiatura . $fieldList["id_documento"] . "/")) {
    if (!mkdir($dirminiatura . $fieldList["id_documento"] . "/", PERMISOS_CARPETAS)) {
    alerta("Problemas al crear la carpeta " . $dirminiatura . $fieldList["id_documento"] . "/" . " de de Imagenes-Miniaturas Por favor Comuniquese con su Administrador");
    }
    }
    chmod($dirminiatura . $fieldList["id_documento"] . "/", PERMISOS_CARPETAS);*/
                        $fieldList["imagen"] = $ruta_img_min;
                        array_push($rutas, $fieldList["id_documento"]);
                        $fieldList["ruta"] = $ruta2;
                        $fieldList["pagina"] = $cont;

                        $descripcion = "MINIATURA_" . $fieldList["id_documento"];
                        $idbinario_min = almacena_cont_binario_db($minitura->get('jpeg'), $descripcion, $fieldList["imagen"]);
                        $descripcion = "PAGINA_" . $fieldList["id_documento"];
                        $idbinario_pag = almacena_cont_binario_db($imagen->get('jpeg'), $descripcion, $fieldList["ruta"]);
                        if ($idbinario_min && $idbinario_pag) {
                            $strsql = "INSERT INTO $tipo(id_documento,idbinario_min,pagina,idbinario_pag,imagen,ruta) VALUES (" . $fieldList["id_documento"] . ",'" . $idbinario_min . "'," . $fieldList["pagina"] . ", '" . $idbinario_pag . "','" . $fieldList["imagen"] . "','" . $fieldList["ruta"] . "')";
                            phpmkr_query($strsql, $conn) or error("PROBLEMAS AL EJECUTAR LA INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
                            $idpag = phpmkr_insert_id();
                            array_push($idimagenes, $idpag);
                            registrar_accion_digitalizacion($fieldList["id_documento"], 'ADICION PAGINA', "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]));
                        } else {
                            alerta("Error al almacenar el archivo Por favor verifique que el archivo sea accesible y este correctamente almacenado");
                        }
                    } else {
                        error("Existen Problemas al Cargar el Archivo: $ruta_arch_tmp");
                    }
                } else if (filesize($archivo) > $peso) {
                    alerta($archivo . " Excede el tamanio permitido! Por Favor comuniquese con el Administrador del Sistema");
                }
                $archivo = readdir($directorio);
            }
            closedir($directorio);
        }
    }

    $config = busca_filtro_tabla("", "configuracion", "nombre='activar_estampado'", "", $conn);
    if ($fieldList["id_documento"] != '' && $config[0]["valor"] == 'TRUE') {
        if (is_file("digital_signed/estampado_tiempo.php")) {
            include_once("digital_signed/estampado_tiempo.php");
            $retorno = estampar_imagen($idimagenes, $fieldList);
        }
    }

    return true;
}

function vincular_anexo_documento($iddoc, $ruta_origen, $etiqueta = '')
{
    global $conn, $ruta_db_superior;
    include_once($ruta_db_superior . "anexosdigitales/funciones_archivo.php");
    $ruta_destino = selecciona_ruta_anexos2($iddoc, 'archivos');
    $nombre_extension = basename($ruta_db_superior . $ruta_origen);

    $vector_nombre_extension = explode('.', $nombre_extension);
    $extension = $vector_nombre_extension[(count($vector_nombre_extension) - 1)];
    $nombre_temporal = uniqid() . "." . $extension;
    /*mkdir($ruta_db_superior . $ruta_destino, 0777);
	$tmpVar = 1;
	while(file_exists($ruta_db_superior.$ruta_destino. $tmpVar . '_' . $nombre_temporal)){
		$tmpVar++;
	}*/
    //$nombre_temporal = $tmpVar . '_' . $nombre_temporal;

    $almacenamiento = new SaiaStorage("archivos");
    $resultado = $almacenamiento->copiar_contenido_externo($ruta_origen, $ruta_destino . $nombre_temporal);

    //copy($ruta_db_superior . $ruta_origen, $ruta_destino . $nombre_temporal);
    $data_sql = array();
    $data_sql['documento_iddocumento'] = $iddoc;
    //$data_sql['ruta'] = $ruta_destino . $nombre_temporal;
    $arr_ruta = array("servidor" => $almacenamiento->get_ruta_servidor(), "ruta" => $ruta_destino . $nombre_temporal);
    $data_sql['ruta'] = json_encode($arr_ruta);
    $data_sql['etiqueta'] = $etiqueta;
    $data_sql['tipo'] = $extension;

    $datos_documento = busca_filtro_tabla("a.formato_idformato,b.idcampos_formato", "documento a LEFT JOIN campos_formato b ON a.formato_idformato=b.formato_idformato", "b.etiqueta_html='archivo' AND a.iddocumento=" . $iddoc, "", $conn);
    $data_sql['formato'] = null;
    $data_sql['campos_formato'] = null;
    if ($datos_documento['numcampos']) {
        $data_sql['formato'] = $datos_documento[0]['formato_idformato'];
        $data_sql['campos_formato'] = $datos_documento[0]['idcampos_formato'];
    }
    $tabla = "anexos";
    $strsql = "INSERT INTO " . $tabla . " (fecha_anexo,"; //fecha_anexo
    $strsql .= implode(",", array_keys($data_sql));
    $strsql .= ") VALUES (" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'";    //fecha_anexo
    $strsql .= implode("','", array_values($data_sql));
    $strsql .= "')";
    phpmkr_query($strsql, $conn);
    $idanexo = phpmkr_insert_id();
    $data_sql = array();
    $data_sql['anexos_idanexos'] = $idanexo;
    $data_sql['idpropietario'] = SessionController::getValue('idfuncionario');
    $data_sql['caracteristica_propio'] = 'lem';
    $data_sql['caracteristica_total'] = '1';

    $tabla = "permiso_anexo";
    $strsql = "INSERT INTO " . $tabla . " (";
    $strsql .= implode(",", array_keys($data_sql));
    $strsql .= ") VALUES ('";
    $strsql .= implode("','", array_values($data_sql));
    $strsql .= "')";
    $sql1 = $strsql;
    phpmkr_query($sql1);

    return $idanexo;
}

/*
<Clase>
<Nombre>error
<Parametros>$cad: cadena de error
<Responsabilidades>Imprimir la cadena de error
<Notas>Esta Funcion realiza la insercion de el error generado en una rreglo que debe mostrarse en alguna instancia
       puede ser en una marquesina en la parte inferior
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function error($cad, $ruta = "", $file = "", $imprime_cadena = 0)
{
    if (DEBUGEAR) {
        if ($imprime_cadena) {
            echo $cad . "<BR>";
        }
        if ($file == "") {
            $file = str_replace(CARPETA_SAIA . "/saia/", "", $_SERVER["PHP_SELF"]);
        }
        if ($ruta == "") {
            //TODO: Falta validar el contraslash para windows en la ruta del archivo.
            $ruta = $_SERVER["DOCUMENT_ROOT"] . "/" . CARPETA_SAIA . "/errores/" . date("Ymd") . "_" . str_replace(".", "_", $_SERVER["REMOTE_ADDR"]) . ")-(" . str_replace("/", "-", $file) . ").txt";
        }
        $size = file_put_contents($ruta, "[" . date("Y-m-d H:i:s") . "][" . $file . "]" . $cad . "\n\r", FILE_APPEND);
    }
}

/**
 * abre una url
 *
 * @param string $location url destino
 * @param string $target ventana destino
 * @return void
 */
function abrir_url($location, $target = "_blank")
{
    echo "<script language='javascript'>
        window.open(\"" . $location . "\",\"" . $target . "\");
    </script>";
}

/**
 * redirecciona la ventana actual
 *
 * @param string $location url destino
 * @return void
 */
function redirecciona($location)
{
    echo "<script language='javascript'>
        window.location=\"" . $location . "\";
    </script>";
}
/*
<Clase>
<Nombre>enviar_mensaje</Nombre>
<Parametros>$origen:codigo del funcionario que envía el mensaje;$usuarios:codigos de los funcinarios destinos del mensaje;$mensaje:texto del mensaje;$tipo_envio:'msg'(mensajeria instantanea) o 'e-interno' (correo electrónico)</Parametros>
<Responsabilidades>Envía un mensaje instantáneo o de correo electrónico<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>*/
function enviar_mensaje($correo = "", $tipo_usuario = [], $usuarios = [], $asunto, $mensaje, $anexos = [], $iddoc = 0)
{
    global $conn;
    $ok = 0;
    $para = array();
    $copia = array();
    $copia_oculta = array();

    switch ($tipo_usuario["para"]) {
        case 'email':
            if (count($usuarios["para"])) {
                $ok = 1;
                $para = $usuarios["para"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["para"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $para[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["para"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $para[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    switch ($tipo_usuario["copia"]) {
        case 'email':
            if (count($usuarios["copia"])) {
                $ok = 1;
                $copia = $usuarios["copia"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["copia"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["copia"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    switch ($tipo_usuario["copia_oculta"]) {
        case 'email':
            if (count($usuarios["copia_oculta"])) {
                $ok = 1;
                $copia_oculta = $usuarios["copia_oculta"];
            }
            break;

        case 'iddependencia_cargo':
            foreach ($usuarios["copia_oculta"] as $iddep_cargo) {
                $funcionario = busca_filtro_tabla("email", "vfuncionario_dc", "email<>'' and email is not null and iddependencia_cargo='" . $iddep_cargo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia_oculta[] = $funcionario[0]["email"];
                }
            }
            break;

        default:
            foreach ($usuarios["copia_oculta"] as $func_codigo) {
                $funcionario = busca_filtro_tabla("email", "funcionario", "email<>'' and email is not null and funcionario_codigo='" . $func_codigo . "'", "", $conn);
                if ($funcionario["numcampos"]) {
                    $ok = 1;
                    $copia_oculta[] = $funcionario[0]["email"];
                }
            }
            break;
    }

    if ($ok) {
        include_once($ruta_db_superior . "PHPMailer/PHPMailerAutoload.php");

        $configuracion_correo = busca_filtro_tabla("valor,nombre,encrypt", "configuracion", "nombre in('servidor_correo','puerto_servidor_correo','puerto_correo_salida','servidor_correo_salida','correo_notificacion','clave_correo_notificacion','asunto_defecto_correo')", "", $conn);
        for ($i = 0; $i < $configuracion_correo['numcampos']; $i++) {
            switch ($configuracion_correo[$i]['nombre']) {
                case 'servidor_correo':
                    $servidor_correo = $configuracion_correo[$i]['valor'];
                    break;
                case 'puerto_servidor_correo':
                    $puerto_servidor_correo = $configuracion_correo[$i]['valor'];
                    break;
                case 'puerto_correo_salida':
                    $puerto_correo_salida = $configuracion_correo[$i]['valor'];
                    break;
                case 'servidor_correo_salida':
                    break;
                case 'correo_notificacion':
                    $correo_notificacion = $configuracion_correo[$i]['valor'];
                    break;
                case 'clave_correo_notificacion':
                    if ($configuracion_correo[$i]['encrypt']) {
                        include_once('pantallas/lib/librerias_cripto.php');
                        $configuracion_correo[$i]['valor'] = decrypt_blowfish($configuracion_correo[$i]['valor'], LLAVE_SAIA_CRYPTO);
                    }
                    $clave_correo_notificacion = $configuracion_correo[$i]['valor'];
                    break;
                case 'asunto_defecto_correo':
                    $asunto_defecto_correo = $configuracion_correo[$i]['valor'];
                    break;
            }
        }

        switch ($correo) {
            case 'personal':
                $usuario_correo = usuario_actual("email");
                $pass_correo = usuario_actual("email_contrasena");
                break;
            default:
                $usuario_correo = $correo_notificacion;
                $pass_correo = $clave_correo_notificacion;
                break;
        }
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug  = 2;
        $mail->Host = $servidor_correo; //secure.emailsrvr.com - mail.rackspace.com
        $mail->Port = $puerto_correo_salida;
        $mail->SMTPAuth = true;
        $mail->Username = $usuario_correo;
        $mail->Password = $pass_correo;
        $mail->FromName = $usuario_correo;

        if ($asunto != "") {
            $mail->Subject = $asunto;
        } else {
            $mail->Subject = $asunto_defecto_correo;
        }
        $config = busca_filtro_tabla("valor", "configuracion", "nombre='color_institucional'", "", $conn);
        $admin_saia = busca_filtro_tabla("valor", "configuracion", "nombre='login_administrador'", "", $conn);
        $correo_admin = busca_filtro_tabla("email", "funcionario", "login='" . $admin_saia[0]['valor'] . "'", "", $conn);
        $texto_pie = "
  	<table style='border:none; width:100%; font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;	padding: 10px;'>
		<tr>
			<td>
				Este email ha sido enviado autom&aacute;ticamente desde SAIA (Sistema de Administraci&oacute;n Integral de Documentos y Procesos).
				<br>
				<br>
				Por favor, NO responda a este mail.
				<br>
				<br>
				Para obtener soporte o realizar preguntas, envi&eacute; un correo electr&oacute;nico a " . $correo_admin[0]['email'] . "
			</td>
			<td style='text-align:right;'>
				<img src='" . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/imagenes/saia_gray.png'>
			</td>
		</tr>
	</table>";

        $inicio_style = '
  <div id="fondo" style="   padding: 10px; 	background-color: #f5f5f5;	">

  	<div id="encabezado" style="background-color:' . $config[0]["valor"] . ';color:white ;  vertical-align:middle;   text-align: left;    font-weight: bold;  border-top-left-radius:5px;   border-top-right-radius:5px;   padding: 10px;">
  		NOTIFICACI&Oacute;N - SAIA
  	</div>

  	<div id="cuerpo" style="padding: 10px;background-color:white;">
  		<br>
  		<span style="font-weight:bold;color:' . $config[0]["valor"] . ';">' . $asunto . '</span>
  		<hr>
  		<br>';

        $fin_style = '
  	</div>
  	<div  id="pie" style="font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464;vertical-align:middle;padding: 10px;">
  		' . $texto_pie . '
  	</div>
  </div>';

        $mensaje = $inicio_style . $mensaje . $fin_style;

        $mail->Body = $mensaje;
        $mail->IsHTML(true);

        $mail->ClearAllRecipients();
        $mail->ClearAddresses();

        foreach ($para as $fila) {
            $mail->AddAddress($fila, $fila);
        }
        foreach ($copia as $fila) {
            $mail->AddCC($fila, $fila);
        }
        foreach ($copia_oculta as $fila) {
            $mail->AddBCC($fila, $fila);
        }

        if (!empty($anexos)) {
            foreach ($anexos as $fila) {
                $ruta_imagen = json_decode($fila);
                if (is_object($ruta_imagen)) {
                    $etiqueta = explode("/", $ruta_imagen->ruta);
                    $contenido = StorageUtils::get_file_content($fila);
                    if ($contenido !== false) {
                        $mail->AddStringAttachment($contenido, end($etiqueta));
                    }
                } else {
                    $mail->AddAttachment($fila);
                }
            }
        }

        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            if ($iddoc) {
                $radicador_salida = busca_filtro_tabla("valor", "configuracion", "nombre LIKE 'radicador_salida'", "", $conn);
                if ($radicador_salida["numcampos"]) {
                    $funcionario = busca_filtro_tabla("", "funcionario", "login LIKE '" . $radicador_salida[0]["valor"] . "'", "", $conn);
                    if ($funcionario["numcampos"]) {
                        $ejecutores = array($funcionario[0]["funcionario_codigo"]);
                    }
                }
                if (!count($ejecutores)) {
                    $ejecutores = array(SessionController::getValue('usuario_actual'));
                }

                $otros["notas"] = "'Documento enviado por e-mail por medio del correo: " . $mail->FromName;
                if (count($para)) {
                    $otros["notas"] .= " Para :" . implode(",", $para);
                }
                if (count($copia)) {
                    $otros["notas"] .= " Copia :" . implode(",", $copia);
                }
                $otros["notas"] .= "'";
                $datos["archivo_idarchivo"] = $iddoc;
                $datos["tipo_destino"] = 1;
                $datos["tipo"] = "";
                $datos["nombre"] = "DISTRIBUCION";
                transferir_archivo_prueba($datos, $ejecutores, $otros);
            }
            return true;
        }
    } else {
        return false;
    }
}

/*
<Clase>
<Nombre>contador
<Parametros>$cad: tipo de contador
<Responsabilidades>Buscar el contador correpondiente y hacer la debida actualizacion
<Notas>
<Excepciones>NO EXISTE UN CONSECUTIVO LLAMADO. Cuando el contador que llega como parámetro no existe
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function contador($iddocumento, $cad)
{
    global $conn;
    $func = SessionController::getValue('usuario_actual');
    $contador = busca_filtro_tabla("", "contador a", "a.nombre='" . $cad . "'", "", $conn);
    $conn->invocar_radicar_documento($iddocumento, $contador[0]["idcontador"], $func);
}

/*
<Clase>
<Nombre>muestra_contador
<Parametros>$cad: nombre del contador a consultar
<Responsabilidades>Retorna el valor del contador
<Notas>
<Excepciones>NO EXISTE UN CONSECUTIVO LLAMADO. Si no existe el contador que se quiere invocar
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function muestra_contador($cad)
{
    global $sql, $conn;
    $cuenta = busca_filtro_tabla("A.consecutivo,A.idcontador", "contador A", "A.nombre='" . $cad . "'", "", $conn);
    if ($cuenta["numcampos"]) {
        $consecutivo = $cuenta[0]["consecutivo"];
        return $consecutivo;
    } else {
        error("NO EXISTE UN CONSECUTIVO LLAMADO " . $cad);
        return 0;
    }
}

/*
<Clase>
<Nombre>genera_ruta
<Parametros>$destino: identificador del funcionario que recibe el documento
            $tipo: tipo documental del documento asociado
            $doc: identificador del documento
<Responsabilidades>insertar en la ruta y en el buzon_salida los registros de la ruta correspondiente
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function genera_ruta($destino, $tipo, $doc)
{
    global $conn;
    $valores = array();
    $idruta = 0;
    for ($i = 0; $i < count($destino) - 1; $i++) {
        if (isset($destino[$i + 1])) {
            $sql = "INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(" . $destino[$i]['codigo'] . ",'ACTIVO'," . $destino[$i + 1]['codigo'] . "," . $tipo . ",'" . $destino[$i]["condicion"] . "'," . $doc . "," . $destino[$i]['tipo'] . "," . $destino[$i + 1]['tipo'] . "," . $destino[$i]['obligatorio'] . ")";

            phpmkr_query($sql, $conn) or error("No se puede Generar una Ruta entre los funcionarios " . $destino[$i]['codigo'] . " y " . $destino[$i + 1]['codigo']);
            $idruta = phpmkr_insert_id();
            if ($idruta) {
                $valores["archivo_idarchivo"] = $doc;
                $valores["nombre"] = "'POR_APROBAR'";
                $valores["destino"] = "'" . codigo_rol($destino[$i]["codigo"], $destino[$i]["tipo"]) . "'";
                $valores["tipo_destino"] = "'" . $destino[$i]["tipo"] . "'";
                $valores["fecha"] = fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $valores["origen"] = "'" . codigo_rol($destino[$i + 1]["codigo"], $destino[$i + 1]["tipo"]) . "'";
                $valores["tipo_origen"] = "'" . $destino[$i + 1]["tipo"] . "'";
                $valores["tipo"] = "'DOCUMENTO'";
                $valores["activo"] = 1;
                $valores["ruta_idruta"] = $idruta;
                $campos = implode(",", array_keys($valores));
                $values = implode(",", array_values($valores));
                $sql = "INSERT INTO buzon_entrada($campos) VALUES($values)";
                phpmkr_query($sql, $conn) or error("No se puede Generar una Ruta entre los funcionarios " . $destino[$i]['codigo'] . " y " . $destino[$i + 1]['codigo']);
            }
        }
    }
    return true;
}
/*
<Clase>
<Nombre>codigo_rol</Nombre>
<Parametros>$id:identificador de funcionario;$tipo:entidad</Parametros>
<Responsabilidades>busca el codigo del funcionario<Responsabilidades>
<Notas>Esta funcion se creo por la actualizacion de roles en SAIA</Notas>
<Excepciones></Excpciones>
<Salida>codigo del funcionario</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
 */
function codigo_rol($id, $tipo)
{
    global $conn;
    if ($tipo == 5)
        $cod = busca_filtro_tabla("funcionario_codigo as cod", "funcionario,dependencia_cargo", "idfuncionario=funcionario_idfuncionario and iddependencia_cargo=$id", "", $conn);
    else
        return $id;
    return $cod[0]["cod"];
}

/*
<Clase>
<Nombre>busca_cargo_funcionario
<Parametros>$tipo: filtro de la busqueda
            $dato:
            $dependencia:
            $conn: instancia sql
<Responsabilidades>Funcion  que retorna el origen completo de un funcionario incluyendo los codigos de dependencia y cargo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function busca_cargo_funcionario($tipo, $dato, $dependencia, $conn)
{
    global $sql;
    $datorig = array();
    $datorig["numcampos"] = 0;
    $filtro = "";
    if ($tipo == 'nit' || $tipo == 2) {
        $filtro = "A.nit='" . $dato . "'";
    } else if ($tipo == 'id' || $tipo == 1) {
        $filtro = "A.funcionario_codigo=" . $dato;
    } else if ($tipo == 'login' || $tipo == 3) {
        $filtro = "A.login='" . $dato . "'";
    }
    if ($tipo == 'nit' || $tipo == 'id' || $tipo == 'login' || $tipo == 1 || $tipo == 2 || $tipo == 3) {
        $temp = busca_filtro_tabla("*", "funcionario A", $filtro, "", $conn);
        if ($temp["numcampos"] == 0)
            error("Datos del Funcionario Origen de Dependencia no Existe");
        else {
            $dorig = $temp[0]['idfuncionario'];
            $datorig = busca_filtro_tabla("d.*,c.*,f.*,f.estado AS estado_f,d.estado AS estado_d", "dependencia_cargo d, cargo c, funcionario f", "d.funcionario_idfuncionario=f.idfuncionario AND c.idcargo=d.cargo_idcargo AND f.idfuncionario='" . $dorig . "'", "f.estado ASC", $conn);
        }
    } else if ($tipo == "cargo" || $tipo == 4) {
        $datorig = busca_filtro_tabla("A.iddependencia_cargo", "dependencia_cargo A", "A.cargo_idcargo=$dato AND A.dependencia_iddependencia=" . $dependencia, "A.estado", $conn);
        if ($datorig["numcampos"])
            $datorig = busca_cargo_funcionario(5, $datorig[0]["iddependencia_cargo"], "", $conn);
        else alerta(codifica_encabezado("No existe nadie en ésta dependencia con el cargo especificado"));
    } else if ($tipo == 'iddependencia_cargo' || $tipo == 5) {
        $datorig = busca_filtro_tabla("*,f.estado as estado_f,d.estado as estado_d", "dependencia_cargo d,funcionario f,cargo c", "dependencia_cargo d,funcionario f,cargo", "c.idcargo=d.cargo_idcargo AND f.idfuncionario=d.funcionario_idfuncionario AND d.iddependencia_cargo=" . $dato, "f.estado", $conn);
    } else {
        $datorig[0]['iddependencia_cargo'] = $dato;
    }
    if ($temp["numcampos"]) {
        $datorig[0] = array_merge((array) $datorig[0], (array) $temp[0]);
    }

    return $datorig;
}

/**
 * genera una alerta javascript
 *
 * @param string $message mensaje a mostrar
 * @param string $type tipo de alerta: success,error,info,warning
 * @param integer $duration tiempo en pantalla
 * @return void
 */
function alerta($message, $type = 'success', $duration = 3000)
{
    if ($_REQUEST["llamado_ajax"]) {
        return $message;
    }

    echo '<script type="text/javascript">
        top.notification({
            message: "' . $message . '",
            type: "' . $type . '",
            duration: "' . $duration . '"
        });
    </script>';
}

/*
<Clase>
<Nombre>volver
<Parametros>$back: numero de paginas a volver
<Responsabilidades>Devolver la aplicacion $back numero de paginas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function volver($back = "1")
{
    echo '<script type="text/javascript">
        window.history.go(-' . $back . ');
    </script>';
}

/*
<Clase>
<Nombre>agrega_boton
<Parametros>$nombre:
            $imagen:
            $dir:
            $destino:
            $texto:
            $acceso:
            $modulo:
<Responsabilidades>verificar que tenga permisos el usuario e insertar el boton correspondiente
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
 */
function agrega_boton($nombre, $imagen, $dir, $destino, $texto, $acceso, $modulo, $retorno = 0)
{

    global $conn;
    $cadena = "";
    if ($modulo != "") {
        if ($modulo == "formatos") {
            $ayuda = busca_filtro_tabla("f.ayuda", "formato f", "f.nombre='" . strtolower($nombre) . "'", "", $conn);
        } else
            $ayuda = busca_filtro_tabla("A.ayuda", "modulo A", "A.nombre='$modulo'", "", $conn);
        $ok = PermisoController::moduleAccess($modulo);
    } else if (SessionController::getLogin())
        $ok = 1;
    else $ok = 0;
    if ($ok) {
        if ($dir == "" || $dir == null)
            $dir = "#";
        //||!is_file($imagen)
        if ($imagen == "" || $imagen == null) {
            $imagen = "botones/configuracion/default.gif";
        }
        if ($nombre == "" || $nombre == null)
            $nombre = "boton";
        if ($destino == "" || $destino == null)
            $destino = "_self";
        if ($texto == "" || $texto == null)
            $texto = "";
        $alto = 65;
        $ancho = 65;
        $texto = str_replace("_", " ", $texto);
        $texto = mayusculas($texto);
        $alt = $texto;
        $alt = str_replace("<BR>", " ", $alt);
        $ayuda = busca_filtro_tabla("A.ayuda", "modulo A", "A.nombre='$modulo'", "", $conn);
        if ($nombre == "texto") {
            $cadena = '<a title="' . @$ayuda[0]["ayuda"] . '" href="' . $dir . '" target="' . $destino . '"><span class="phpmaker">' . $texto . '</span></a>&nbsp;&nbsp;';
        } else {
            $cadena = '<a title="' . $ayuda[0]["ayuda"] . '" href="' . $dir . '" target="' . $destino . '"><span class="phpmaker"> <img src="' . $imagen . '"></span></a>&nbsp;&nbsp;';
        }
    }

    if ($retorno) {
        return $cadena;
    } else {
        echo $cadena;
        return true;
    }
}

/*
<Clase>
<Nombre>fecha_db_obtener
<Parametros> campo : Campo de la tabla con la fecha a obrener; $formato : formato de la fecha a obtener en fromato tipo PHP;
<Responsabilidades> Retornar la cadena adecuada dependiendo del motor para las consultas
de tipo select
<Notas>
<Excepciones>
<Salida>cadena lista para compementar las secuecias  ejem  TO_CHAR(fecha_ini,'DD-MM-YYYY')
<Pre-condiciones>
<Post-condiciones>
 */
function fecha_db_obtener($campo, $formato = null)
{
    return StaticSql::getDateFormat($campo, $formato);
}

/*
<Clase>
<Nombre>fecha_db_almacenar
<Parametros> fecha : fecha a almacenar conxsecuente al fromato; $formato : formato de la fecha a almacenar tipo PHP;
<Responsabilidades> Retornar la cadena adecuada dependiendo del motor para las consultas
de tipo select
<Notas>
<Excepciones>
<Salida>cadena lista para insertar en la BD
<Pre-condiciones>
<Post-condiciones>
 */

function fecha_db_almacenar($fecha, $formato = null)
{
    return StaticSql::setDateFormat($fecha, $formato);
}

/*<Clase>
<Nombre>suma_fechas</Nombre>
<Parametros>$fecha1:fecha inicial;$cantidad:cantidad de tiempo a sumarle;$tipo:tipo de medida de tiempo usada 'DAY','YEAR','MONTH'</Parametros>
<Responsabilidades>Crea la cadena sql que se necesita para sumar cierta cantidad de tiempo a una fecha determinada<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>Cadena Sql</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function suma_fechas($fecha1, $cantidad, $tipo = "")
{
    global $conn;
    return $conn->suma_fechas($fecha1, $cantidad, $tipo);
}

/*<Clase>
<Nombre>resta_horas</Nombre>
<Parametros>$fecha1:fecha inicial;$fecha2:fecha a restar</Parametros>
<Responsabilidades>Crea la cadena para calcular el numero de horas de diferencia entre dos fechas<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function resta_horas($fecha1, $fecha2)
{
    global $conn;
    return $conn->resta_horas($fecha1, $fecha2);
}

///Recibe la fecha inicial y la fecha que se debe controlar o fecha de referencia, si tiempo =1 es que la fecha iniicial esta por encima ese tiempo de la fecha de control ejemplo si fecha_inicial=2010-11-11 y fecha_control=2011-12-11 quiere decir que ha pasado 1 año , 1 mes y 0 dias desde la fecha inicial a la de control
function compara_fechas($fecha_control, $fecha_inicial)
{
    global $conn;
    return $conn->compara_fechas($fecha_control, $fecha_inicial);
}

/**
 * obtiene un attributo del 
 * usuario logueado
 *
 * @param string $campo
 * @return void
 */
function usuario_actual($campo)
{
    if (!SessionController::getLogin()) {
        SessionController::logout("Su sesión ha expirado, por favor ingrese de nuevo.");
    } else {
        $login = SessionController::getLogin();
        $dato = busca_filtro_tabla("estado,{$campo}", "funcionario", "login='" . $login . "'");
        if ($dato["numcampos"]) {
            if ($dato[0]["estado"] == 1) {
                return $dato[0][$campo];
            } else {
                SessionController::logout("El funcionario se encuentra inactivo", $login);
            }
        } else {
            SessionController::logout("No se encuentra el funcionario en el sistema, por favor comuniquese con el administrador");
        }
    }
}

/*
 * <Clase>
 * <Nombre>crear_archivo</Nombre>
 * <Parametros>$nombre:nombre del archivo a crear;$texto: texto que se va a copiar dentro del archivo;$modo:modo de apertura del archivo</Parametros>
 * <Responsabilidades>Crea un archivo con cierto texto dentro<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function crear_archivo($nombre, $texto = null, $modo = 'wb')
{
    $path = pathinfo($nombre);
    $ruta = $path["dirname"];
    if (!is_dir($ruta)) {
        if (mkdir($ruta, PERMISOS_CARPETAS, true)) {
            chmod($ruta, PERMISOS_CARPETAS);
        } else {
            return false;
        }
    }
    if (is_file($nombre)) {
        unlink($nombre);
    }
    $f = fopen($nombre, $modo);
    $resp = false;
    if ($f) {
        chmod($nombre, PERMISOS_ARCHIVOS);
        $texto = str_replace("? >", "?" . ">", $texto);
        if (fwrite($f, $texto, strlen($texto)) !== false) {
            $resp = $nombre;
        }
    }
    fclose($f);
    return $resp;
}

/*
 * <Clase>
 * <Nombre>crear_destino</Nombre>
 * <Parametros>$destino:estructura de carpetas a crear</Parametros>
 * <Responsabilidades>Crea un conjunto de carpetas con cierta jerarquia<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function crear_destino($destino)
{
    if (!is_dir($destino)) {
        if (!mkdir($destino, PERMISOS_CARPETAS, true)) {
            alerta("no es posible crear la carpeta " . $destino);
            return '';
        }
    }
    return $destino;
}

/*<Clase>
<Nombre>ejecuta_filtro_tabla</Nombre>
<Parametros>$sql2:sentencia sql;$conn:objeto de conexion</Parametros>
<Responsabilidades>Ejecuta una sentencia sql y devuelve un vector con los datos encontrados<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase> */
function ejecuta_filtro_tabla($sql2, $conn2 = null)
{
    global $conn;
    if ($conn2) {
        $conn = $conn2;
    }

    $retorno = array();
    $rs = $conn->Ejecutar_Sql($sql2) or alerta("Error en Busqueda de Proceso SQL: $sql2");
    $temp = phpmkr_fetch_array($rs);
    $i = 0;
    if ($temp) {
        array_push($retorno, $temp);
        $i++;
    }
    for ($temp; $temp = phpmkr_fetch_array($rs); $i++)
        array_push($retorno, $temp);
    $retorno["numcampos"] = $i;
    $retorno["sql"] = $sql2;
    phpmkr_free_result($rs);
    return $retorno;
}

function ruta_almacenamiento($tipo, $raiz = 1)
{
    $max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
    $ruta_db_superior = $ruta = "";
    while ($max_salida > 0) {
        if (is_file($ruta . "db.php")) {
            $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
        }
        $ruta .= "../";
        $max_salida--;
    }

    if ($raiz) {
        $ruta_raiz = $ruta_db_superior;
    } else {
        $ruta_raiz = '';
    }
    $path = StorageUtils::get_storage_path($tipo, true);
    return $ruta_raiz . $path;
}

/* Se debe enviar la cadena completa si es una cadena de texto la que se debe concatenar se deben adicionar las comillas simples ' */
function concatenar_cadena_sql($arreglo_cadena)
{
    global $conn;
    return $conn->concatenar_cadena($arreglo_cadena);
}

function obtener_reemplazo($fun_codigo = 0, $tipo = 1)
{
    global $conn;
    //$fun_codigo= funcionario_codigo del usuario a consultar
    $retorno = array();
    $retorno['exito'] = 0;
    if ($tipo) {
        $reemplazo = busca_filtro_tabla("nuevo,idreemplazo_saia", "reemplazo_saia", "antiguo=" . $fun_codigo . " and estado=1 and procesado=1", "fecha_reemplazo desc", $conn);
    } else {
        $reemplazo = busca_filtro_tabla("antiguo,idreemplazo_saia", "reemplazo_saia", "nuevo=" . $fun_codigo . " and estado=1 and procesado=1", "fecha_reemplazo desc", $conn);
    }
    if ($reemplazo['numcampos']) {
        $retorno['exito'] = 1;
        $retorno['funcionario_codigo'] = extrae_campo($reemplazo, 0);
        $retorno['idreemplazo'] = extrae_campo($reemplazo, 1);
    }
    return $retorno;
}

/*EN ALGUNOS CLIENTES SE TIENE PROBLEMA CON LA CODIFICACION, ESTO LO SOLUCIONA DE FORMA GENERICA*/
function codifica_encabezado($texto)
{
    if (CODIFICA_ENCABEZADO) {
        return utf8_encode($texto);
    } else {
        return $texto;
    }
}
function decodifica_encabezado($texto)
{
    if (CODIFICA_ENCABEZADO) {
        return utf8_decode($texto);
    } else {
        return $texto;
    }
}

function parsear_comilla_sencilla_cadena($cadena)
{
    if (preg_match("/'/", $cadena)) {
        $cadena = str_replace("'", "''", $cadena);
    }

    return $cadena;
}

function return_megabytes($val)
{
    $val = trim($val);

    if (is_numeric($val)) {
        return $val;
    }
    $last = strtolower($val[strlen($val) - 1]);
    $val = substr($val, 0, -1); // necessary since PHP 7.1; otherwise optional

    switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
            break;
        case 'm':
            $val = $val;
            break;
        case 'k':
            $val /= 1024;
            break;
    }

    return $val;
}

/*Manipulacion de Imagenes*/
/*
<Clase>
<Nombre>cambia_tam
<Parametros>$nombreorig: nombre de la imagen
            $nombredest: nombre de la nueva imagen
            $nwidth: ancho del a nueva imagen
            $nheight: alto de la nueva imagen
            $tipo:
<Responsabilidades>cambiar el tamaño de la imagen, generando una nueva de las dimensiones deseadas
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cambia_tam($nombreorig, $nombredest, $nwidth, $nheight, $tipo = '', $binario = false)
{
    $ext = 'jpg';
    // Se obtienen las nuevas dimensiones
    list($width, $height) = getimagesize($nombreorig);
    if ($nwidth && ($width < $height)) {
        $nwidth = ($nheight / $height) * $width;
    } else {
        $nheight = ($nwidth / $width) * $height;
    }
    $image_p = imagecreatetruecolor($nwidth, $nheight);
    imagecolorallocate($image_p, 255, 255, 255);
    if ($ext == 'gif') {
        $image = imagecreatefromgif($nombreorig); ///nombre del archivo origen
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
        imagegif($image_p, $nombredest); ///nombre del destino
        imagedestroy($image_p);
        imagedestroy($image);

        if ($binario) {
            $im = file_get_contents($nombreorig);
            return $im;
        } else {
            return $nombredest;
        }
    } else {
        $image = imagecreatefromjpeg($nombreorig);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
        imagejpeg($image_p, $nombredest, 80); ///nombre del destino
        imagedestroy($image_p);
        imagedestroy($image);
        if ($binario) {
            $im = file_get_contents($nombreorig);
            return $im;
        } else {
            return $nombredest;
        }
    }
    imagedestroy($image_p);
    imagedestroy($image);
    return null;
}
