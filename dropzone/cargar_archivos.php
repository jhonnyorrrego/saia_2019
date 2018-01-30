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

error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'vendor/autoload.php';

use Sirius\Upload\Handler as UploadHandler;

include_once ($ruta_db_superior . "db.php");

header('Content-type: application/json');

//var_dump($_REQUEST);
//var_dump($_FILES);
//die();

if (@$_REQUEST["idformato"] && @$_REQUEST['idcampo_formato']) {

    $configuracion = busca_filtro_tabla("valor,nombre", "configuracion", "nombre IN ('extensiones_upload', 'tamanio_maximo_upload', 'ruta_temporal')", "", $conn);

    $extensiones = '';
    $max_tamanio = '';
    $usuario = usuario_actual("login");
    if ($configuracion['numcampos']) {
        for ($i = 0; $i < $configuracion['numcampos']; $i++) {
            switch ($configuracion[$i]['nombre']) {
                case 'extensiones_upload':
                    $extensiones = $configuracion[$i]['valor'];
                    break;
                case 'tamanio_maximo_upload':
                    $max_tamanio = $configuracion[$i]['valor'];
                    break;
                case 'ruta_temporal':
                    $ruta_temporal = "{$configuracion[$i]['valor']}_{$usuario}/";
                    break;
            }
        }
    }

    $idformato = $_REQUEST['idformato'];
    $campo_formato = $_REQUEST['idcampo_formato'];
    $campos = busca_filtro_tabla("nombre", "campos_formato", "formato_idformato = $idformato AND idcampos_formato = $campo_formato", "", $conn);
    $lista_campos = array();
    if ($campos["numcampos"]) {
        for ($i = 0; $i < $campos["numcampos"]; $i++) {
            $lista_campos[] = $campos[$i]["nombre"]; // tal vez finalizar con "[]";
        }
    }

    crear_destino($ruta_db_superior . $ruta_temporal);
    $uuid = $_REQUEST['uuid'];

    $uploadHandler = new UploadHandler($ruta_db_superior . $ruta_temporal);

    // set up the validation rules
    $uploadHandler->addRule('extension', [
        'allowed' => $extensiones
    ], "{label} debe ser un formato valido ($extensiones)", $_REQUEST["nombre_campo"]);
    $uploadHandler->addRule('size', [
        'max' => $max_tamanio
    ], '{label} debe ser de menos de {max} bytes', $_REQUEST["nombre_campo"]);
    // $uploadHandler->addRule('imageratio', ['ratio' => 1], '{label} should be a sqare image', $_REQUEST["nombre_campo"]);

    $result = $uploadHandler->process($_FILES[$_REQUEST["nombre_campo"]]);
    //var_dump($result);
    $resp = array();
    if ($result instanceof Sirius\Upload\Result\Collection) {
        foreach ($result as $key => $file) {
            $resp[$uuid] = unwrap_file($file);
            // var_dump($file);
        }
    } else {
        $resp[$uuid] = unwrap_file($result);
    }

    /*
     * if ($result->isValid()) {
     * }
     */
    echo json_encode($resp);
}

function unwrap_file($file, $uuid) {
    $resp = array();
    $resp["name"] = $file->__get("name");
    $resp["type"] = $file->__get("type");
    $resp["size"] = $file->__get("size");
    $resp["error"] = $file->__get("error");
    $resp["tmp_name"] = $file->__get("tmp_name");
    $resp["original_name"] = $file->__get("original_name");
    return $resp;
}
?>