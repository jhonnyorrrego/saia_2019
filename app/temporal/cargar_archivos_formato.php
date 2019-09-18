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
error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'vendor/autoload.php';
use Sirius\Upload\Handler as UploadHandler;
include_once ($ruta_db_superior . "db.php");

if (@$_REQUEST["idformato"] && @$_REQUEST['idcampo_formato']) {
    $idformato = $_REQUEST['idformato'];
    $campo_formato = $_REQUEST['idcampo_formato'];
    if (@$_REQUEST["accion"] && @$_REQUEST["accion"] == "eliminar_temporal") {
        $archivo = $_REQUEST["archivo"];
        eliminar_temporal($idformato, $campo_formato, $archivo);
    } else {
        header('Content-type: application/json');
        $configuracion = busca_filtro_tabla("valor,nombre", "configuracion", "nombre IN ('extensiones_upload', 'tamanio_maximo_upload', 'ruta_temporal')", "");

        $extensiones = '';
        $max_tamanio = '';
        $usuario = usuario_actual("login");
        if ($configuracion['numcampos']) {
            for ($i = 0; $i < $configuracion['numcampos']; $i++) {
                switch ($configuracion[$i]['nombre']) {
                    case 'extensiones_upload' :
                        $extensiones = $configuracion[$i]['valor'];
                        break;
                    case 'tamanio_maximo_upload' :
                        $max_tamanio = $configuracion[$i]['valor'];
                        break;
                    case 'ruta_temporal' :
                        $ruta_temporal = "{$configuracion[$i]['valor']}_{$usuario}/";
                        break;
                }
            }
        }

        $campos = busca_filtro_tabla("nombre", "campos_formato", "formato_idformato = $idformato AND idcampos_formato = $campo_formato", "");
        $lista_campos = array();
        if ($campos["numcampos"]) {
            for ($i = 0; $i < $campos["numcampos"]; $i++) {
                $lista_campos[] = $campos[$i]["nombre"];
            }
        }

        crear_destino($ruta_db_superior . $ruta_temporal);
        $uuid = $_REQUEST['uuid'];

        $uploadHandler = new UploadHandler($ruta_db_superior . $ruta_temporal);

        // set up the validation rules
        $uploadHandler -> addRule('extension', ['allowed' => $extensiones], "{label} debe ser un formato valido ($extensiones)", $_REQUEST["nombre_campo"]);
        //$uploadHandler -> addRule('size', ['max' => "5M"], '{label} debe ser de menos de {max} bytes', $_REQUEST["nombre_campo"]);

        $result = $uploadHandler -> process($_FILES[$_REQUEST["nombre_campo"]]);
        $resp = array();
        if ($result -> isValid()) {
            if ($result instanceof Sirius\Upload\Result\Collection) {
                $archivos = array();
                foreach ($result as $key => $file) {
                    $info = unwrap_file($file);
                    $info["idformato"] = $idformato;
                    $info["idcampo_formato"] = $campo_formato;
                    $info = guardar($info, $uuid, $ruta_temporal);
                    array_push($archivos, $info);
                }
                $resp[$uuid] = $archivos;
            } else {
                $info = unwrap_file($result);
                $info["idformato"] = $idformato;
                $info["idcampo_formato"] = $campo_formato;
                $info = guardar($info, $uuid, $ruta_temporal);
                $resp[$uuid] = $info;
            }
        } else {
            echo json_encode($result->getMessages());
        }
        echo json_encode($resp);
    }
}

function unwrap_file($file) {
    $resp = array();
    $resp["name"] = $file -> __get("name");
    $resp["type"] = $file -> __get("type");
    $resp["size"] = $file -> __get("size");
    $resp["error"] = $file -> __get("error");
    $resp["tmp_name"] = $file -> __get("tmp_name");
    $resp["original_name"] = $file -> __get("original_name");
    return $resp;
}

function guardar($file, $uuid, $ruta_temporal) {
    
    $campos = array(
        "uuid" => "'" . $uuid . "'",
        "ruta" => "'" . $ruta_temporal . $file["name"] . "'",
        "etiqueta" => "'" . $file["original_name"] . "'",
        "tipo" => "'" . $file["type"] . "'",
        "idformato" => $file["idformato"],
        "idcampos_formato" => $file["idcampo_formato"],
        "fecha_anexo" => fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s'),
        "funcionario_idfuncionario" => usuario_actual('idfuncionario')
    );
    $sql2 = "INSERT INTO anexos_tmp(" . implode(", ", array_keys($campos)) . ") values (" . implode(", ", array_values($campos)) . ")";
    phpmkr_query($sql2) or die($sql2);
    $file["id"] = phpmkr_insert_id();
    //$file["sql"] = $sql2;
    return $file;
}

function eliminar_temporal($idformato, $campo_formato, $archivo) {
    global $conn, $ruta_db_superior;
    if (empty($archivo)) {
        die("No se envio identificador");
    }
    $archivos = busca_filtro_tabla("", "anexos_tmp", "idanexos_tmp = " . $archivo, "");
    if ($archivos["numcampos"]) {
        $sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = $archivo";
        phpmkr_query($sql2) or die($sql2);
        $ruta_temporal = $ruta_db_superior . $archivos[0]["ruta"];
        unlink($ruta_temporal);
        unlink("$ruta_temporal.lock");
    } else {
        die("No se encontro archivo con identificador: $archivo");
    }
}
?>