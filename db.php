<?php
date_default_timezone_set('America/Bogota');

require_once 'filesystem/StorageUtils.php';
require_once 'filesystem/SaiaStorage.php';
require_once 'core/autoload.php';

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
                        phpmkr_query($strsql) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA de INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
                        $idpag = phpmkr_insert_id();
                        array_push($idimagenes, $idpag);

                        Digitalizacion::newRecord([
                            'funcionario' => SessionController::getValue('usuario_actual'),
                            'documento_iddocumento' => $fieldList["id_documento"],
                            'accion' => 'ADICION PAGINA',
                            'justificacion' => "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]),
                            'fecha' => date('Y-m-d H:i:s')
                        ]);
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
                            phpmkr_query($strsql) or error("PROBLEMAS AL EJECUTAR LA INSERCION" . phpmkr_error() . ' SQL:' . $strsql);
                            $idpag = phpmkr_insert_id();
                            array_push($idimagenes, $idpag);
                            Digitalizacion::newRecord([
                                'funcionario' => SessionController::getValue('usuario_actual'),
                                'documento_iddocumento' => $fieldList["id_documento"],
                                'accion' => 'ADICION PAGINA',
                                'justificacion' => "Identificador: $idpag, Nombre: " . basename($fieldList["imagen"]),
                                'fecha' => date('Y-m-d H:i:s')
                            ]);
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
    $Documento = new Documento($iddoc);
    $ruta_destino = $Documento->getStorageRoute() . "/anexos/";
    $nombre_extension = basename($ruta_origen);
    $vector_nombre_extension = explode('.', $nombre_extension);
    $extension = $vector_nombre_extension[end($vector_nombre_extension)];
    $nombre_temporal = uniqid() . "." . $extension;
    $almacenamiento = new SaiaStorage("archivos");
    $almacenamiento->copiar_contenido_externo($ruta_origen, $ruta_destino . $nombre_temporal);

    $pk = Anexos::newRecord([
        'documento_iddocumento' => $iddoc,
        'ruta' => json_encode([
            "servidor" => $almacenamiento->get_ruta_servidor(),
            "ruta" => $ruta_destino . $nombre_temporal
        ]),
        'etiqueta' => $etiqueta,
        'tipo' => $extension,
        'fecha_anexo' => date('Y-m-d H:i:s')
    ]);

    return $pk;
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

/**
 * muestra el consecutivo de un contador
 *
 * @param string $name nombre del contador
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-08
 */
function muestra_contador($name)
{
    $Contador = Contador::findByAttributes(['nombre' => $name]);

    if (!$Contador) {
        throw new Exception("No existe un consecutivo llamado {$name}", 1);
    }

    return $Contador->consecutivo;
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
 * @param string $field
 * @return void
 */
function usuario_actual($field)
{
    $login = SessionController::getLogin();

    if (!$login) {
        SessionController::logout("Su sesión ha expirado, por favor ingrese de nuevo.");
    } else {
        $Funcionario = Funcionario::findByAttributes([
            'login' => $login,
            'estado' => 1
        ], [$field]);

        if ($Funcionario) {
            return $Funcionario->$field;
        } else {
            SessionController::logout("El funcionario se encuentra inactivo", $login);
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

/**
 * obtiene el iddocumento del primer documento
 * que le pertenece a un proceso
 *
 * @param integer $documentId iddocumento de un hijo referencia
 * @return integer
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-08
 */
function buscarPapaPrimero($documentId)
{
    $query = Model::getQueryBuilder()
        ->select('C.nombre_tabla as parent_table', 'B.nombre_tabla as child_table')
        ->from('documento', 'A')
        ->join('A', 'formato', 'B', 'lower(A.plantilla)=lower(B.nombre)')
        ->join('B', 'formato', 'C', 'B.cod_padre = C.idformato')
        ->where('A.iddocumento = :documentId')
        ->setParameter('documentId', $documentId, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetch();

    if ($query['parent_table']) {
        $document = Model::getQueryBuilder()
            ->select('B.documento_iddocumento')
            ->from($query["child_table"], 'A')
            ->join('A',  $query["parent_table"], 'B', "{$query['parent_table']} = id{$query['parent_table']}")
            ->where('A.documento_iddocumento = :documentId')
            ->setParameter('documentId', $documentId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()->fetch();

        return buscarPapaPrimero($document["documento_iddocumento"]);
    } else {
        return $documentId;
    }
}
