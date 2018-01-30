<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida --;
}

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
include_once ($ruta_db_superior . "db.php");

class SaiaUploadHandler extends UploadHandler {

    /*protected function initialize() {
        parent::initialize();
        //print_r($this->options);die();
    }*/

    protected function handle_form_data($file, $index) {
        if(is_null($index)) {
            $index = 0;
        }
        $file->idformato = @$_REQUEST['idformato'][$index];
        $file->idcampos_formato = @$_REQUEST['idcampo_formato'][$index];
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
        $index = null, $content_range = null) {
            $file = parent::handle_file_upload(
                $uploaded_file, $name, $size, $type, $error, $index, $content_range
                );
            if (empty($file->error)) {

                $campos = array(
                    "idanexos_tmp" => 'NULL',
                    "uuid" => "'" . $file->uuid . "'",
                    "ruta" => "'" . $this->options["ruta_temp_saia"] . $file->name . "'",
                    "etiqueta" => "'" . $file->name . "'",
                    "tipo" => "'" . $file->type . "'",
                    "idformato" => $file->idformato,
                    "idcampos_formato" => $file->idcampos_formato,
                    "fecha_anexo" => date('Y-m-d H:i:s'),
                    "funcionario_idfuncionario" => usuario_actual('idfuncionario')
                );

                $sql2 = "INSERT INTO anexos_tmp(" . implode(", ", array_keys($campos)) . ") values (" .
                    implode(", ", array_values($campos)) . ")";
                //phpmkr_query($sql2) or die($sql2);

                //$file->id = $conn->Ultimo_Insert();
                $file->sql = $sql2;
/*

                        $file->name,
                        $file->size,
                        $file->type,
                        $file->idformato,
                        $file->idcampos_formato
                        */
            }
            return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file->uuid = uniqid();
        }
    }

}

//print_r($_REQUEST);
//print_r($_FILES);
//die();
if (@$_REQUEST["fu_idformato"] && @$_REQUEST['fu_idcampos_formato']) {

    $configuracion = busca_filtro_tabla("valor,nombre", "configuracion", "nombre IN ('extensiones_upload', 'tamanio_maximo_upload', 'ruta_temporal')", "", $conn);

    $extensiones = '';
    $max_tamanio = '';
    $usuario = usuario_actual("login");
    if ($configuracion['numcampos']) {
        for ($i = 0; $i < $configuracion['numcampos']; $i ++) {
            switch ($configuracion[$i]['nombre']) {
                case 'extensiones_upload':
                    $extensiones = str_replace(',', '|', $configuracion[$i]['valor']);
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

    $idformato = $_REQUEST['fu_idformato'][0];
    $campos_formato = $_REQUEST['fu_idcampos_formato'];
    $campos = busca_filtro_tabla("nombre", "campos_formato", "formato_idformato = $idformato AND idcampos_formato IN (" . implode(", ", $campos_formato) . ")", "", $conn);
    $lista_campos = array();
    if($campos["numcampos"]) {
        for($i = 0; $i < $campos["numcampos"]; $i++) {
            $lista_campos[] = $campos[$i]["nombre"]; // tal vez finalizar con "[]";
        }
    }

    $options = array(
        'upload_dir' => $ruta_db_superior . $ruta_temporal,
        'upload_url' => $ruta_db_superior . $ruta_temporal,
        'accept_file_types' => '/\.(' . $extensiones . ')$/i',
        'max_file_size' => $max_tamanio,
        "param_name" => implode("[],", $lista_campos),
        "ruta_temp_saia" => $ruta_temporal,
    );
    crear_destino($ruta_db_superior . $ruta_temporal);
    $upload_handler = new SaiaUploadHandler($options);
}

?>