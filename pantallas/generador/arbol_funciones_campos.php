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
if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}
echo ("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
echo ("<tree id=\"0\">\n");
include_once $ruta_db_superior . 'core/autoload.php';
include_once ($ruta_db_superior . "pantallas/lib/buscar_patron_archivo.php");
if($_REQUEST['funciones_nucleo']){
	llena_funciones($_REQUEST["pantalla_idpantalla"]);
}else{
	llena_categorias($_REQUEST["pantalla_idpantalla"]);
}

echo ("</tree>\n");
$activo = "";
?>
<?php

function llena_categorias($pantalla_idpantalla) {
    if ($pantalla_idpantalla) {
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Campos\" id=\"cat-campos\">");
        listado_campos($pantalla_idpantalla);
        echo ("</item>\n");
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Funciones\" id=\"cat-funciones\">");
        listado_librerias($pantalla_idpantalla, 1);
        echo ("</item>\n");
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Esquemas visuales\" id=\"cat-esquemas\">");
        listado_esquemas($pantalla_idpantalla);
        echo ("</item>\n");
    } else {
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"existe un error al tratar de buscar funciones de la pantalla\" id=\"cat-funciones\" open=\"1\">");
        echo ("</item>\n");
    }
    return;
}

function llena_funciones($pantalla_idpantalla) {
    if ($pantalla_idpantalla) {
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Funciones\" id=\"cat-funciones\">");
        funciones_nucleo($pantalla_idpantalla, 1);
        echo ("</item>\n");    
    } else {
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"existe un error al tratar de buscar funciones de la pantalla\" id=\"cat-funciones\" open=\"1\">");
        echo ("</item>\n");
    }
    return;
}

function funciones_nucleo($pantalla_idpantalla, $tipo) {
    global $conn;
    $consulta_funciones = busca_filtro_tabla("","funciones_nucleo","","",$conn);
    $texto = '';

    if ($consulta_funciones["numcampos"]) {
        for ($i = 0; $i < $consulta_funciones["numcampos"]; $i++) {
        	
            $texto_temp = lista_funciones_vincular($consulta_funciones[$i]["ruta"], $consulta_funciones[$i]["idfunciones_nucleo"],$consulta_funciones[$i]["nombre_funcion"],$consulta_funciones[$i]["etiqueta"]);
            if ($texto_temp != '') {
                
                $texto .= $texto_temp;

                $texto_temp = '';
            }
        }
    }
    echo ($texto);
}

function listado_librerias($pantalla_idpantalla, $tipo) {
    global $conn;
    // Librerias diferentes a las del sistema (tipo_libreria<>2)
    $librerias = busca_filtro_tabla("", "formato_libreria A", " A.formato_idformato=" . $pantalla_idpantalla, "A.orden,A.ruta", $conn);
    $texto = '';
	
    if ($librerias["numcampos"]) {
        for ($i = 0; $i < $librerias["numcampos"]; $i++) {
            $texto_temp = listado_funciones($librerias[$i]["ruta"], $librerias[$i]["idformato_libreria"]);
            if ($texto_temp != '') {
                $texto .= "<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . htmlspecialchars($librerias[$i]["ruta"]) . "\" id=\"lib_" . $librerias[$i]["idformato_libreria"] . "\">";
                $texto .= $texto_temp;
                $texto .= "</item>\n";
                $texto_temp = '';
            }
        }
    }
    echo ($texto);
}

function listado_funciones($ruta_libreria, $idlibreria) {
    global $conn;

    $listado_funciones = buscar_patron_archivo($ruta_libreria, "function", 0);
	
    $texto = '';
    foreach ($listado_funciones["resultado"] as $key => $valor) {
        $cant_funciones = '';
        $pos1 = strpos($valor, "(");
        $pos2 = strpos($valor, ")");
        $nombre = trim(substr($valor, 8, ($pos1 - 8)));
        $dato = trim(substr($valor, 8));
        $texto_param = $dato;
        // strpos($texto_param,'$idformato,$iddoc') valida que la funcion sea valida como funcion de saia para los formatos
        if ($nombre != '' && preg_match('/\$idformato[\s]*,[\s]*\$iddoc/',$texto_param)) {
            $texto .= "<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . htmlspecialchars($texto_param) . "\" id=\"func_" . $idlibreria . "_" . $nombre . "\" >";
            $texto .= "<userdata name='myfunc'>{*" . $nombre . "*}</userdata>\n";
            $texto .= "<userdata name='mylib_id'>" . $idlibreria . "</userdata>\n";
            $texto .= "</item>\n";
        }
    }
    return ($texto);
}

function lista_funciones_vincular($ruta_libreria, $idlibreria,$nombre_funcion,$etiqueta) {
    global $conn;

    $listado_funciones = buscar_funciones_archivo($ruta_libreria, "function", $nombre_funcion,0);
		
	
    $texto = '';
    foreach ($listado_funciones["resultado"] as $key => $valor) {
    	
        $cant_funciones = '';
        $pos1 = strpos($valor, "(");
        $pos2 = strpos($valor, ")");
        $nombre = trim(substr($valor, 8, ($pos1 - 8)));

        $dato = trim(substr($valor, 8));
        $texto_param = $dato;
        // strpos($texto_param,'$idformato,$iddoc') valida que la funcion sea valida como funcion de saia para los formatos
        if ($nombre != '' && preg_match('/\$idformato[\s]*,[\s]*\$iddoc/',$texto_param)) {
            $texto .= "<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . htmlspecialchars($etiqueta) . "\" id=\"func_" . $idlibreria . "_" . $nombre . "\" >";
            $texto .= "<userdata name='myfunc'>{*" . $nombre . "*}</userdata>\n";
            $texto .= "<userdata name='mylib_id'>" . $idlibreria . "</userdata>\n";
            $texto .= "</item>\n";
        }
    }
    return ($texto);
}
function listado_campos($pantalla_idpantalla) {
    global $conn;
    $campos = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $pantalla_idpantalla . " and etiqueta_html<>'campo_heredado'", "A.nombre", $conn);
    if ($campos["numcampos"]) {
        for ($i = 0; $i < $campos["numcampos"]; $i++) {
            echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . htmlspecialchars($campos[$i]["nombre"]) . "\" id=\"campo_" . $campos[$i]["idcampos_formato"] . "\" tooltip=\"" . utf8_encode(htmlspecialchars($campos[$i]["etiqueta"])) . "\" >");
            echo ("<userdata name='mycampo'>{*" . $campos[$i]["nombre"]);
            echo ("*}</userdata>\n");
            echo ("</item>\n");
        }
    }
}

function listado_esquemas($idpantalla) {
    $esquemas = busca_filtro_tabla("", "pantalla_esquema", "1=1", "", $conn);
    for ($i = 0; $i < $esquemas["numcampos"]; $i++) {
        $etiqueta = utf8_encode(htmlspecialchars($esquemas[$i]["etiqueta"]));
        echo ("<item style=\"font-family:verdana; font-size:7pt;\" text=\"" . $etiqueta . "\" id=\"esquema_" . $esquemas[$i]["idpantalla_esquema"] . "\" tooltip=\"" . utf8_encode(htmlspecialchars($etiqueta)) . "\" >");
        echo ("<userdata name='myesquema'>" . $esquemas[$i]["ruta"] . "?idformato=" . $idpantalla . "</userdata>\n");
        echo ("</item>\n");
    }
}
?>
