<?php
date_default_timezone_set('America/Bogota');

require_once 'filesystem/StorageUtils.php';
require_once 'filesystem/SaiaStorage.php';
require_once 'core/autoload.php';

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
}

/**
 * crea un registro de cierta accion sobre cierto documento en la tabla digitalizacion
 *
 * @param integer $iddoc id del documento
 * @param string $accion accion ejecutada
 * @param string $justificacion descripcion que se llena cuando se borra una pagina
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function registrar_accion_digitalizacion($iddoc, $accion, $justificacion = '')
{
    $userCode = SessionController::getValue('usuario_actual');

    Digitalizacion::newRecord([
        'funcionario' => $userCode,
        'documento_iddocumento' => $iddoc,
        'accion' => $accion,
        'justificacion' => $justificacion,
        'fecha' => date('Y-m-d H:i:s')
    ]);
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

    $pendiente = busca_filtro_tabla(fecha_db_obtener("fecha_inicial", "Y-m-d H:i:s") . " as fecha_inicial", "asignacion", "documento_iddocumento=" . $llave . " and llave_entidad=" . $codigo, "fecha_inicial DESC");

    if ($pendiente["numcampos"] > 0) {
        $leido = busca_filtro_tabla("nombre,idtransferencia", "buzon_entrada", "archivo_idarchivo=$llave and origen=$codigo and nombre='LEIDO' AND fecha >= " . fecha_db_almacenar($pendiente[0]["fecha_inicial"], "Y-m-d H:i:s"), "");
        if (!$leido["numcampos"]) {
            BuzonSalida::newRecord([
                'archivo_idarchivo' => $llave,
                'nombre' => 'LEIDO',
                'fecha' => date('Y-m-d H:i:s'),
                'origen' => $codigo,
                'tipo_origen' => '1',
                'destino' => $codigo,
                'tipo_destino' => '1',
                'tipo' => 'DOCUMENTO'
            ]);

            BuzonEntrada::newRecord([
                'archivo_idarchivo' => $llave,
                'nombre' => 'LEIDO',
                'fecha' => date('Y-m-d H:i:s'),
                'origen' => $codigo,
                'tipo_origen' => '1',
                'destino' => $codigo,
                'tipo_destino' => '1',
                'tipo' => 'DOCUMENTO'
            ]);
        }
    } else {
        $leido = busca_filtro_tabla("nombre,idtransferencia", "buzon_salida", "archivo_idarchivo=$llave and destino='$codigo'", "fecha desc");
        if (!$leido["numcampos"] || $leido[0]["nombre"] <> "LEIDO") {

            BuzonSalida::newRecord([
                'archivo_idarchivo' => $llave,
                'nombre' => 'LEIDO',
                'fecha' => date('Y-m-d H:i:s'),
                'origen' => $codigo,
                'tipo_origen' => '1',
                'destino' => $codigo,
                'tipo_destino' => '1',
                'tipo' => 'DOCUMENTO'
            ]);

            $insertar = "insert into buzon_entrada(archivo_idarchivo,nombre,fecha,origen,tipo_origen,destino,tipo_destino,tipo)";
            $insertar .= " values(" . $llave . ",'LEIDO'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$codigo,1," . $codigo . ",1,'DOCUMENTO')";

            BuzonEntrada::newRecord([
                'archivo_idarchivo' => $llave,
                'nombre' => 'LEIDO',
                'fecha' => date('Y-m-d H:i:s'),
                'origen' => $codigo,
                'tipo_origen' => '1',
                'destino' => $codigo,
                'tipo_destino' => '1',
                'tipo' => 'DOCUMENTO'
            ]);
        }
    }
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

/**
 * ejecuta una sentencia a la db
 *
 * @param string $sql
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function phpmkr_query($sql)
{
    return Connection::getInstance()->query($sql);
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
    $QueryBuilder = Model::getQueryBuilder()
        ->select($campos ? $campos : '*')
        ->from($tabla);

    if ($filtro) {
        $QueryBuilder->where($filtro);
    }

    if ($orden) {
        $QueryBuilder->add('orderBy', $orden);
    }

    $response = $QueryBuilder->execute()->fetchAll();
    $response['numcampos'] = count($response);
    return $response;
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

function sincronizar_carpetas($tipo)
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
    $configuracion = busca_filtro_tabla("*", "configuracion A", "A.tipo='ruta' OR A.tipo='imagen' OR A.tipo='peso'", "A.idconfiguracion DESC");
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

    $config = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_almacenamiento'", "");
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

                    $datos_doc = busca_filtro_tabla("estado," . fecha_db_obtener('fecha', 'Y-m') . " as fecha,iddocumento", "documento", "iddocumento=" . $fieldList["id_documento"], "");
                    $estado = $datos_doc[0]["estado"];
                    $fecha = $datos_doc[0]["fecha"];

                    $paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina");
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
                    $num = busca_filtro_tabla("A.pagina", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"] . " AND pagina=" . $cont, "");
                    if ($num["numcampos"] && $cad_temp == "") {
                        $paginas = busca_filtro_tabla("A.pagina,A.ruta", "" . $tabla . " A", "A.id_documento=" . $fieldList["id_documento"], "A.pagina");
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

    $config = busca_filtro_tabla("", "configuracion", "nombre='activar_estampado'", "");
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

    $datos_documento = busca_filtro_tabla("a.formato_idformato,b.idcampos_formato", "documento a LEFT JOIN campos_formato b ON a.formato_idformato=b.formato_idformato", "b.etiqueta_html='archivo' AND a.iddocumento=" . $iddoc, "");
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
    phpmkr_query($strsql);
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

/**
 * ejecuta el procedimiento para asignar el numero
 *
 * @param string $counter nombre del contador
 * @param integer $documentId 
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-09-09
 */
function contador($counter, $documentId)
{
    $Contador = Contador::findByAttributes([
        'nombre' => $counter
    ]);
    switch (MOTOR) {
        case 'MySql':
        case 'Oracle':
            $sql = "CALL sp_asignar_radicado({$documentId}, {$Contador->getPK()})";
            break;
        case 'SqlServer':
            $sql = "EXEC sp_asignar_radicado @iddoc={$documentId}, @idcontador={$Contador->getPK()}";
            break;
        default:
            throw new Exception("Motor indefinido", 1);
            break;
    }

    Connection::getInstance()->query($sql);
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
    global  $conn;
    $cuenta = busca_filtro_tabla("A.consecutivo,A.idcontador", "contador A", "A.nombre='" . $cad . "'", "");
    if ($cuenta["numcampos"]) {
        $consecutivo = $cuenta[0]["consecutivo"];
        return $consecutivo;
    } else {
        error("NO EXISTE UN CONSECUTIVO LLAMADO " . $cad);
        return 0;
    }
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

/**
 * crea una carpeta con los permisos
 * indicados en el define
 *
 * @param string $directory
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function crear_destino($directory)
{
    if (!is_dir($directory)) {
        if (!mkdir($directory, PERMISOS_CARPETAS, true)) {
            throw new Exception("no es posible crear la carpeta {$directory}", 1);
        }
    }
    return $directory;
}

function obtener_reemplazo($fun_codigo = 0, $tipo = 1)
{

    //$fun_codigo= funcionario_codigo del usuario a consultar
    $retorno = array();
    $retorno['exito'] = 0;
    if ($tipo) {
        $reemplazo = busca_filtro_tabla("nuevo,idreemplazo_saia", "reemplazo_saia", "antiguo=" . $fun_codigo . " and estado=1 and procesado=1", "fecha_reemplazo desc");
    } else {
        $reemplazo = busca_filtro_tabla("antiguo,idreemplazo_saia", "reemplazo_saia", "nuevo=" . $fun_codigo . " and estado=1 and procesado=1", "fecha_reemplazo desc");
    }
    if ($reemplazo['numcampos']) {
        $retorno['exito'] = 1;
        $retorno['funcionario_codigo'] = extrae_campo($reemplazo, 0);
        $retorno['idreemplazo'] = extrae_campo($reemplazo, 1);
    }
    return $retorno;
}

/**
 * crea la nueva ruta de radicacion para un documento
 *
 * @param array $ruta2 [
 *    [
 *        funcionario: funcionario_codigo, iddependencia_cargo
 *        tipo_firma: 1 => firma , 0 => no firma
 *        tipo => 1 => funcionario_codigo, 5 => iddependencia_cargo
 *    ]
 * ]
 * @param integer $iddoc iddocumento
 * @param integer $firma1
 * @return void
 * @date 2019
 */
function insertar_ruta($ruta2, $iddoc, $firma1 = 1)
{
    if ($ruta2) {
        if ($ruta2[0]['tipo'] == 5) {
            $VfuncionarioDc = VfuncionarioDc::findByRole($ruta2[0]['funcionario']);
            $userId = $VfuncionarioDc->funcionario_codigo;
        } else {
            $userId = $ruta2[0]['funcionario'];
        }
    }

    if (!$ruta2 || $userId != SessionController::getValue('usuario_actual')) {
        $ruta = [];
        array_push($ruta, [
            "funcionario" => SessionController::getValue('usuario_actual'),
            "tipo_firma" => $firma1,
            "tipo" => 1
        ]);
        $ruta = array_merge($ruta, $ruta2);
    } else {
        $ruta = $ruta2; // :'(
    }

    RutaDocumento::inactiveByType($iddoc, RutaDocumento::TIPO_RADICACION);

    //nueva relacion de ruta con el documento
    $fk_ruta_documento = RutaDocumento::newRecord([
        'fk_documento' => $iddoc,
        'tipo' => RutaDocumento::TIPO_RADICACION,
        'estado' => 1,
        'tipo_flujo' => RutaDocumento::FLUJO_SERIE
    ]);

    $radicador = busca_filtro_tabla("f.funcionario_codigo", "configuracion c,funcionario f", "c.nombre='radicador_salida' and f.login=c.valor", "");
    array_push($ruta, array(
        "funcionario" => $radicador[0]["funcionario_codigo"],
        "tipo_firma" => 0,
        "tipo" => 1
    ));
    phpmkr_query("UPDATE buzon_entrada SET activo=0, nombre=CONCAT('ELIMINA_',nombre) where archivo_idarchivo='" . $iddoc . "' and (nombre='POR_APROBAR' OR nombre='REVISADO' OR nombre='APROBADO' OR nombre='VERIFICACION')");
    phpmkr_query("UPDATE buzon_salida SET nombre=CONCAT('ELIMINA_',nombre) WHERE archivo_idarchivo='" . $iddoc . "' and nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')");

    for ($i = 0; $i < count($ruta) - 1; $i++) {
        if (!isset($ruta[$i]["tipo_firma"])) {
            $ruta[$i]["tipo_firma"] = 1;
        }
        if (!isset($ruta[$i]["tipo"])) {
            $ruta[$i]["tipo"] = 1;
        }
        if (!isset($ruta[$i + 1]["tipo"])) {
            $ruta[$i + 1]["tipo"] = 1;
        }

        if ($ruta[$i]["tipo"] == 5) {
            $func_codigo1 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i]["funcionario"], "");
            $funcionario1 = $func_codigo1[0]['funcionario_codigo'];
        } else {
            $funcionario1 = $ruta[$i]["funcionario"];
        }

        $retorno1 = obtener_reemplazo($funcionario1, 1);
        if ($retorno1['exito']) {
            $funcionario1 = $retorno1['funcionario_codigo'][0];
            if ($ruta[$i]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno1['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i]["funcionario"], "");
                if ($equiv["numcampos"]) {
                    $ruta[$i]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i]["tipo"] = 1;
                    $ruta[$i]["funcionario"] = $funcionario1;
                }
            }
        }

        if ($ruta[$i + 1]["tipo"] == 5) {
            $func_codigo2 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i + 1]["funcionario"], "");
            $funcionario2 = $func_codigo2[0]['funcionario_codigo'];
        } else {
            $funcionario2 = $ruta[$i + 1]["funcionario"];
        }

        $retorno2 = obtener_reemplazo($funcionario2, 1);
        if ($retorno2['exito']) {
            $funcionario2 = $retorno2['funcionario_codigo'][0];
            if ($ruta[$i + 1]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno2['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i + 1]["funcionario"], "");
                if ($equiv["numcampos"]) {
                    $ruta[$i + 1]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i + 1]["tipo"] = 1;
                    $ruta[$i + 1]["funcionario"] = $funcionario2;
                }
            }
        }

        $idruta = Ruta::newRecord([
            'destino' => $ruta[$i + 1]["funcionario"],
            'origen' =>  $ruta[$i]["funcionario"],
            'documento_iddocumento' => $iddoc,
            'condicion_transferencia' => 'POR_APROBAR',
            'tipo_origen' =>  $ruta[$i]["tipo"],
            'tipo_destino' =>  $ruta[$i + 1]["tipo"],
            'orden' => $i,
            'obligatorio' => $ruta[$i]["tipo_firma"],
            'idenlace_nodo' =>  $ruta[$i]["paso_actividad"] ?? null,
            'fk_ruta_documento' => $fk_ruta_documento
        ]);

        BuzonEntrada::newRecord([
            'origen' =>  $funcionario2,
            'destino' => $funcionario1,
            'archivo_idarchivo' => $iddoc,
            'activo' => 1,
            'tipo_origen' => $ruta[$i + 1]["tipo"],
            'tipo_destino' =>  $ruta[$i]["tipo"],
            'ruta_idruta' => $idruta,
            'nombre' => 'POR_APROBAR',
            'fecha' => date("Y-m-d H:i:s"),
        ]);
    }
}


/**
 * realiza la transferencia de un documento
 *
 * @param int $idformato si se van buscar en un documento los destinos
 * @param int $iddoc identificador del documento a transferir
 * @param string $destinos lista de funcionarios 
 * @param int $tipo tipo de destinos. 1: roles, 2: se busca en el formato, 3: funcionario_codigo
 * @param string $notas nota de transferencia
 * @param string $nombre nombre de transferencia
 * @return void
 */
function transferencia_automatica(
    $idformato = null,
    $iddoc,
    $destinos,
    $tipo,
    $notas = "",
    $nombre = "TRANSFERIDO"
) {
    $adicionales = array();

    if ($tipo == "1") { // cuando es una lista de funcionarios fijos (roles)
        $vector = explode("@", $destinos);
    } elseif ($tipo == "3") { // cuando es una lista de funcionarios fijos (funcionario_codigo)
        $vector = explode("@", $destinos);
    } elseif ($tipo == "2") { // cuando el listado se toma de un campo del formato (roles)
        $formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato = " . $idformato, "");
        $dato = busca_filtro_tabla($destinos, $formato[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "");

        if ($dato['numcampos']) {
            $vector = explode(",", $dato[0][0]);
        } else {
            $vector = [];
        }
    }

    if ($notas) {
        $adicionales["notas"] = "'" . $notas . "'";
        $datos["ver_notas"] = 1;
    }

    foreach ($vector as $fila) {
        if (!strpos($fila, "#")) {
            if ($tipo == 3) {
                $lista = array(
                    $fila
                );
            } else {
                if ($fila) {
                    $codigos = busca_filtro_tabla("funcionario_codigo", "funcionario,dependencia_cargo", "funcionario_idfuncionario=idfuncionario AND iddependencia_cargo=$fila", "");
                    $lista = array(
                        $codigos[0]["funcionario_codigo"]
                    );
                }
            }
        } else {
            $lista = buscar_funcionarios(str_replace("#", "", $fila));
        }

        $datos["tipo_destino"] = "1";
        $datos["archivo_idarchivo"] = $iddoc;
        $datos["origen"] = $_SESSION["usuario_actual"];
        $datos["nombre"] = $nombre;
        $datos["tipo"] = "";
        $datos["tipo_origen"] = "1";
        transferir_archivo($datos, $lista, $adicionales);
    }
}

/*
 * <Clase>
 * <Nombre>componente_ejecutor</Nombre>
 * <Parametros>$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Presenta el formulario para llenar los datos de un ejecutor, segun los parametros enviados. se usa en las pantallas de adicionar y editar del formato en cuestion<Responsabilidades>
 * <Notas>
 * Se usa cuando un formato tiene un campo de etiqueta html 'Remitente'(ejecutor)
 * el valor en el campo debe ser de la forma:
 * tipo@a1,a2@b1,b2,b3@nombre_funcion
 * tipo:unico o multiple
 * a1,a2:nombres de los campos con autocompletar, pueden ser: nombre, identificacion o ambos
 * b1,b2,b3:nombres de los otros campos del formulario. los permitidos son:(identificacion,direccion,telefono,email,cargo,empresa,ciudad,titulo)
 * nombre_funcion: nombre de la funci�n que se va a llamar al momento de mostrar los datos en pantalla, si se deja vac�o se toma por defecto mostrar_valor_campo
 * Ej: multiple@nombre,identificacion@cargo,empresa,direccion,telefono,email,titulo,ciudad (usado en la carta)
 * </Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function componente_ejecutor($idcampo, $iddoc)
{
    $adicionales = "";
    $campo = busca_filtro_tabla("", "campos_formato", "idcampos_formato=$idcampo", "");
    $formato = busca_filtro_tabla("", "formato", "idformato=" . $campo[0]["formato_idformato"], "");
    if ($iddoc != "")
        $adicionales = "&iddoc=$iddoc";
    if ($campo[0]["valor"] != "")
        $parametros = explode("@", $campo[0]["valor"]);
    else
        $parametros = array(
            "multiple",
            "nombre,identificacion",
            "cargo,empresa,direccion,telefono,email,titulo,ciudad"
        );

    $campos = explode(",", $parametros[2]);
    echo '<iframe border=0 frameborder="0" style="background: #FFFFFF;" framespacing="0" name="frame_' . $campo[0]["nombre"] . '" id="frame_' . $campo[0]["nombre"] . '" src="../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=' . $campo[0]["nombre"] . '&tabla=' . $formato[0]["nombre_tabla"] . '&campos_auto=' . $parametros[1] . '&tipo=' . $parametros[0] . '&campos=' . $parametros[2] . $adicionales . '" width="100%" ></iframe>
    <script>
        $( document ).ready(function() {               
            $(window).resize(function(){
                document.getElementById("frame_' . $campo[0]["nombre"] . '").style.height = "100px";
                document.getElementById("frame_' . $campo[0]["nombre"] . '").style.height = $("#frame_' . $campo[0]["nombre"] . '").contents().height() + "px";
            });
        });
    </script>';
}

/*
 * <Clase>
 * <Nombre>genera_campo_listados_editar</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Maneja el adicionar y el editar de los campos tipo radiobutton, select y checkbox de los formatos<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function genera_campo_listados_editar($idformato, $idcampo, $iddoc = null, $buscar = 0)
{
    $CamposFormato = new CamposFormato($idcampo);
    $sql = trim($CamposFormato->valor);
    $accion = strtoupper(substr($sql, 0, strpos($sql, ' ')));
    $llenado = "";
    $valor = null;
    $required = '';

    if ($CamposFormato->obligatoriedad) {
        $obligatorio[] = "class='required'";
        $required = 'required';
    }

    if ($accion == "SELECT") {
        throw new Exception("error al ejecutar la busqueda", 1);
    } else {
        $llenado = json_decode($CamposFormato->opciones, true);
    }

    $tipo = $CamposFormato->etiqueta_html;
    $nombre = $CamposFormato->nombre;

    $tabla = busca_filtro_tabla("nombre_tabla,item", "formato", "idformato=$idformato", "");
    if ($buscar) {
        $default = "";
    } elseif ($iddoc != null) {
        if ($tabla[0]["item"]) {
            $valor = busca_filtro_tabla($CamposFormato->nombre, $tabla[0]['nombre_tabla'], "id" . $tabla[0]['nombre_tabla'] . "=$iddoc", "");
        } else {
            $valor = busca_filtro_tabla($CamposFormato->nombre, $tabla[0]['nombre_tabla'], "documento_iddocumento=$iddoc", "");
        }
        $default = $valor[0][0];
    } else {
        $default = $CamposFormato->predeterminado;
    }

    $texto = "";
    $listado3 = array();
    if ($llenado != "" && $llenado != "Null") {
        $listado1 = $llenado;
        $cont1 = count($listado1);

        for ($i = 0; $i < $cont1; $i++) {
            $listado2 = $listado1[$i];

            array_push($listado3, $listado2);
        }
    }
    $cont3 = count($listado3);
    switch ($tipo) {
        case "radio":
            $texto .= '<div class="radio radio-success">';
            for ($j = 0; $j < $cont3; $j++) {

                $texto .= '<input ' . $required . ' type="' . $tipo . '" ';
                if ($buscar) {
                    $texto .= ' name="bqsaia_g@' . $nombre . '" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '" class="radio"';
                } else {
                    $texto .= ' name="' . $nombre . '" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '"';
                }
                if (($llenado[$j]['llave']) == $default) {
                    $texto .= ' checked ';
                }
                if ($j == 0) {
                    $texto .= $obligatorio;
                }
                $texto .= ' aria-required="true"><label class="" for="' . $nombre . $j . '">' . $llenado[$j]['item'] . '</label>';
            }
            $texto .= "</div>";
            break;
        case "checkbox":
            $texto .= '<div class="checkbox check-success">';

            $lista_default = explode(',', $default);
            for ($j = 0; $j < $cont3; $j++) {
                $texto .= '<input type="checkbox" ';

                if ($j == 0 && $obligatorio) {
                    $required = "required";
                } else {
                    $required = "";
                }

                $texto .= ' class="' . $required . ' checkbox" name="' . $nombre . '[]" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '"';
                if (in_array(($llenado[$j]['item']), $lista_default)) {
                    $texto .= ' checked ';
                }
                $texto .= '><label for="' . $nombre . $j . '">' . strip_tags($llenado[$j]['item']) . "</label>";
            }
            $texto .= "</div>";
            break;
        case "select":
            $texto = ' <div class="form-group ">';
            $texto = '<select name="' . $nombre . '" id="' . $nombre . '" ' . $obligatorio . '>
              <option value="" selected >Por favor seleccione...</option>';
            for ($j = 0; $j < $cont3; $j++) {
                $texto .= '<option value="' . $llenado[$j]['llave'] . '"';
                if (($llenado[$j]['llave']) == $default) {
                    $texto .= ' selected ';
                }
                $texto .= '>' . $llenado[$j]['item'] . '</option>';
            }
            $texto .= '</select>';
            $texto .= '
                     <script>
                    $(document).ready(function() {

                        $("#' . $nombre . '").select2();
                        $("#' . $nombre . '").addClass("full-width");
                    });
                    </script>
                     ';
            break;
    }
    echo $texto;
}

/*
 * <Clase>
 * <Nombre>mes
 * <Parametros>mes:numero que identifica el mes
 * <Responsabilidades>devuelve una cadena con el nombre del mes
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */

function digitalizar_formato($idformato, $iddoc)
{
    echo '<div class="form-group" id="tr_digitalizacion">
            <label class = "etiqueta_campo" title = "">DESEA DIGITALIZAR?</label>
            <div class = "row">
                <div class = "col-3 px-1">
                    <div class = "radio radio-success">
                        <input  class = "form-check-input" name="digitalizacion" type="radio" id="digitaliza_si" value="1" checked>
                        <label class = "etiqueta_selector" for = "digitaliza_si">Si</label>
                        <input class = "form-check-input" id="digitaliza_no" name="digitalizacion" type="radio" value="0" >
                        <label class = "etiqueta_selector" for = "digitaliza_no">No</label>
                    </div>
                </div>
            </div>
        </div>';
}

function mes($mes)
{
    switch ($mes) {
        case 1:
            return "enero";
        case 2:
            return "febrero";
        case 3:
            return "marzo";
        case 4:
            return "abril";
        case 5:
            return "mayo";
        case 6:
            return "junio";
        case 7:
            return "julio";
        case 8:
            return "agosto";
        case 9:
            return "septiembre";
        case 10:
            return "octubre";
        case 11:
            return "noviembre";
        case 12:
            return "diciembre";
    }
}

/**
 * muestra el valor almacenado de un formato
 *
 * @param string $campo nombre del campos_formato
 * @param integer $idformato
 * @param integer $iddoc
 * @param integer $tipo
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function mostrar_valor_campo($campo, $idformato, $iddoc, $tipo = null)
{
    $retorno = "";
    $Documento = new Documento($iddoc);
    $CamposFormato = CamposFormato::findByAttributes([
        'nombre' => $campo
    ]);
    $ft = $Documento->getFt();
    $fieldValue = $ft[$CamposFormato->nombre];
    if ($CamposFormato) {
        if ($CamposFormato->etiqueta_html == "arbol_fancytree") {
            $retorno = mostrar_seleccionados_ft($idformato, $CamposFormato->getPK(), $Documento->getPK(), 1);
        } elseif ($CamposFormato->etiqueta_html == "archivo") {
            $files = Anexos::findAllByAttributes([
                'estado' => 1,
                'documento_iddocumento' => $Documento->getPK(),
                'campos_formato' => $CamposFormato->getPK(),
            ]);

            foreach ($files as $Anexos) {
                $retorno .= $Anexos->etiqueta . "\n";
            }
        } elseif (($CamposFormato->etiqueta_html == 'textarea_cke') || ($CamposFormato->etiqueta_html == 'hidden') || ($CamposFormato->etiqueta_html == 'radio')) {
            $retorno = $fieldValue;
        } elseif ($CamposFormato->etiqueta_html == "moneda") {
            $retorno = "$ {fieldValue}";
        } elseif ($CamposFormato->etiqueta_html == "ejecutor") {
            throw new Exception("pendiente desarrollar para los ejecutores", 1);
        }
    }
    return $retorno;
}

/*
 * <Clase>
 * <Nombre>generar_ruta_documento</Nombre>
 * <Parametros>$iddoc:id del documento</Parametros>
 * <Responsabilidades>
 * Se encarga de generar la ruta de un documento de manera automatica.
 * <Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function generar_ruta_documento($idformato, $iddoc)
{

    $diagram_instance = busca_filtro_tabla('', 'paso_documento A, diagram_instance B', 'A.diagram_iddiagram_instance=B.iddiagram_instance AND A.documento_iddocumento=' . $iddoc, '', conn);
    if ($diagram_instance["numcampos"]) {
        $listado_pasos = busca_filtro_tabla("", "paso A, paso_actividad B, accion C", "B.estado=1 AND A.idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND (C.nombre LIKE 'confirmar%' OR C.nombre LIKE 'aprobar%') AND A.diagram_iddiagram=" . $diagram_instance[0]["diagram_iddiagram"] . " AND B.paso_anterior=" . $diagram_instance[0]["paso_idpaso"], "");
        $ruta = array();
        // pasos_ruta se debe almacenar por medio de acciones si se va a confirmar, confirmar y firmar, aprobar o aprobar y firmar, confirmar y responsable, aprobar y responsable o confirmar y firma manual o confirmar y firma manual validar si se hace por medio del paso_actividad o por medio de la accion intencionalidad por medio del paso_actividad
        for ($i = 0; $i < $listado_pasos["numcampos"]; $i++) {
            array_push($ruta, array(
                "funcionario" => -1,
                "tipo_firma" => 1,
                "paso_actividad" => $listado_pasos[$i]["idpaso_actividad"]
            ));
        }
        if (count($ruta)) {
            insertar_ruta($ruta, $iddoc, 0);
        }
    } else {
        generar_ruta_documento_fija_formato($idformato, $iddoc);
    }
}

function generar_ruta_documento_fija_formato($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    include_once($ruta_db_superior . "formatos/librerias/funciones_formatos_generales.php");
    $dato = busca_filtro_tabla("", "formato_ruta", "formato_idformato=" . $idformato, "orden");
    $rut = array();
    for ($i = 0; $i < $dato["numcampos"]; $i++) {
        $funcionario = "";
        if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 1) {
            $funcionario = $dato[$i]["llave"];
        } else if ($dato[$i]["entidad"] == 2 && $dato[$i]["tipo_campo"] == 1) {
            $cargo = busca_filtro_tabla("", "cargo a, dependencia_cargo b, funcionario c", "idcargo=" . $dato[$i]["llave"] . " and cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and b.estado=1", "");
            $funcionario = $cargo[0]["funcionario_codigo"];
        } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 1) {
            $funcionario_temp = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $dato[$i]["llave"], "");
            if ($funcionario_temp["numcampos"]) {
                if ($funcionario_temp[0]["estado_dc"] && $funcionario_temp[0]["estado"]) {
                    $funcionario = $funcionario_temp[0]["funcionario_codigo"];
                } else {
                    $funcionario_temp2 = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia=" . $funcionario_temp[0]["iddependencia"] . " AND idcargo=" . $funcionario_temp[0]["idcargo"] . " AND estado_dc=1 AND estado=1", "");
                    if ($funcionario_temp2["numcampos"]) {
                        $funcionario = $funcionario_temp2[0]["funcionario_codigo"];
                    }
                }
            }
        } else if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 2) {
            $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "");
            $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $iddoc, "");
            $funcionario = $datos[0][$formato[0]["nom_campo"]];
        } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 2) {
            $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "");
            $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $iddoc, "");
            $funcionario_codigo = busca_filtro_tabla("B.funcionario_codigo", "dependencia_cargo A, funcionario B", "A.iddependencia_cargo=" . $datos[0][$formato[0]["nom_campo"]] . " AND A.funcionario_idfuncionario=B.idfuncionario", "");
            $funcionario = $funcionario_codigo[0]["funcionario_codigo"];
        } else if ($dato[$i]["tipo_campo"] == 3) {
            include_once($ruta_db_superior . $dato[$i]["ruta"]);
            $funcionario = call_user_func_array($dato[$i]["funcion"], array(
                $idformato,
                $iddoc
            ));
        }
        if ($i == 0 && $funcionario == usuario_actual("funcionario_codigo"))
            continue;
        if ($funcionario != '') {
            array_push($rut, array(
                "funcionario" => $funcionario,
                "tipo_firma" => $dato[$i]["firma"]
            ));
        }
    }
    if ($dato["numcampos"])
        insertar_ruta($rut, $iddoc);
    return;
}
