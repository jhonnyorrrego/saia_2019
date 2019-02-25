<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['iddoc']) {
        if($_REQUEST['actualizar_pdf']){
            include_once $ruta_db_superior . 'class_impresion_' . $_REQUEST['exportar'] . '.php';
            
            $Documento = new Documento($_REQUEST['iddoc']);
            $jsonRoute = json_decode($Documento->pdf);
        }else{
            $jsonRoute = json_decode(base64_decode($_REQUEST['ruta']));
        }

        if (is_object($jsonRoute)) {
            $temporalFile = $_SESSION["ruta_temp_funcionario"] . '/' . strtolower(basename($jsonRoute->ruta));
            $relativeRoute = $ruta_db_superior . $temporalFile;

            if ($_REQUEST['actualizar_pdf']) {
                $content = StorageUtils::get_file_content(json_encode($jsonRoute));
                if($content){
                    file_put_contents($relativeRoute, $content);
                }
                
                if (!is_file($relativeRoute)) {
                    $Response->message = "Error al generar el PDF";
                }
            }

            if(is_file($relativeRoute)){
                $Response->data = $temporalFile;
                $Response->success = 1;
            }
        } else {
            $Response->message = "Error al resolver la ruta del pdf";
        }
    } else {
        $Response->message = "documento invalido";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);