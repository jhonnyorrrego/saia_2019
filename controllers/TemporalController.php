<?php
class TemporalController
{
    public static $saiaDir = 'temporal/saia';
    /**
     * limpia una carpeta
     *
     * @param string $dir ruta a la carpeta
     * @param boolean $remove si la carpeta debe ser eliminada
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function cleanDirectory($dir, $remove = false)
    {
        if (is_dir($dir)) {

            if (!$dh = @opendir($dir)) {
                return;
            }
            while (false !== ($obj = readdir($dh))) {
                if ($obj == '.' || $obj == '..') {
                    continue;
                }
                if (!@unlink($dir . '/' . $obj)) {
                    self::cleanDirectory($dir . '/' . $obj, true);
                }
            }
            closedir($dh);

            if ($remove) { //elimina la carpeta
                @rmdir($dir);
            }
        } else {
            mkdir($dir, PERMISOS_CARPETAS, true);
        }
    }

    /**
     * crea un archivo en la carpeta temporal del 
     * funcionario logueado con base a un json de bd
     *
     * @param string $dbString json de archivo almacenado en bd
     * @param string $prefix prefijo del nuevo archivo temporal
     * @param boolean $force sobreescribir en caso de existir un archivo con el mismo nombre
     * @return object
     *  ->success indica si el archivo fue creado
     *  ->route ruta al nuevo archivo
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function createTemporalFile($dbString, $prefix = '', $force = false)
    {
        global $ruta_db_superior;

        $response = (object)[
            'success' => 0,
            'route' => ''
        ];

        $binary = StorageUtils::get_file_content($dbString);
        if ($binary) {
            $fileName = $prefix . Anexo::getNameFromJson($dbString);
            $temporalRoute = SessionController::getTemporalDir() . '/' . $fileName;
            $relativeRoute = $ruta_db_superior . $temporalRoute;

            if (!is_file($relativeRoute) || $force) {
                file_put_contents($relativeRoute, $binary);
            }

            if (is_file($relativeRoute)) {
                $response->success = 1;
                $response->route = $temporalRoute;
            }
        }

        return $response;
    }

    /**
     * retorna el string ferencia
     * del archivo almacenado para la bd
     *
     * @param string $route ruta donde se guardara el archivo
     * @param string $storageType tipo para instanciar saiaStorage
     * @param string $content binario a guardar
     * @return string string para guardar en base de datos
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function createFileDbRoute(string $route, string $storageType, string $content)
    {
        $SaiaStorage = new SaiaStorage($storageType);
        $size = $SaiaStorage->almacenar_contenido($route, $content, false);

        if ($size) {
            $response = json_encode([
                "servidor" => $SaiaStorage->get_ruta_servidor(),
                "ruta" => $route
            ]);
        } else {
            $response = null;
        }

        return $response;
    }

    /** 
     * @param string $rutaBase
     * @param string $storageType
     * @param int $idTemp
     * @return array | string[]
     */

    public static function moverAnexoTemporal($rutaBase, $storageType, $idTemp, $borrar = true)
    {
        global $conn, $ruta_db_superior;
        $storage = new SaiaStorage($storageType);
        $dir_anexos = array();

        $archivos = busca_filtro_tabla("", "anexos_tmp", "idanexos_tmp = $idTemp", "", $conn);
        for ($j = 0; $j < $archivos["numcampos"]; $j++) {
            $ruta_temporal = $ruta_db_superior . $archivos[$j]["ruta"];

            if (file_exists($ruta_temporal)) {
                $nombre = $archivos[$j]["etiqueta"];
                $datos_anexo = pathinfo($ruta_temporal);

                $temp_filename = uniqid() . "." . $datos_anexo["extension"];

                if (is_file($ruta_temporal)) {
                    $resultado = $storage->copiar_contenido_externo($ruta_temporal, $rutaBase . $temp_filename);
                }
                if ($resultado) {
                    $dir_anexos = array(
                        "servidor" => $storage->get_ruta_servidor(),
                        "ruta" => $rutaBase . $temp_filename
                    );

                    // eliminar el temporal
                    if ($borrar) {
                        unlink($ruta_temporal);
                        unlink("$ruta_temporal.lock");

                        // Eliminar los pendientes de la tabla temporal
                        $sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = " . $archivos[$j]["idanexos_tmp"];
                        phpmkr_query($sql2) or die($sql2);
                    }
                } else {
                    alerta("!Se produjo un error al copiar el archivo " . $nombre, 'error', 4000);
                }
            } else {
                alerta("!No se encontró el archivo " . $nombre, 'error', 4000);
            }
        }
        return $dir_anexos;
    }
}
