<?php
class UtilitiesController
{
    /** Genera el archivo temporal con nombre y ruta que se especifique (almacenamiento nuevo)
     * @param array 
     * : [ruta] string obtenido de la DB
     * : [sufijo] string Sufijo que se concatena al Nombre de la imagen
     * : [filename] string Nombre de la imagen
     * : [force] boolean para sobreescribir la imagen
     * : [ruta_almacenar] string ruta donde desea almacenar la imagen
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     * */
    public static function getFileTemp(array $param = array("ruta" => null, "sufijo" => "", "filename" => null, "force" => false, "ruta_almacenar" => null)) : array
    {
        global $ruta_db_superior;
        $retorno = array(
            "exito" => 0,
            "msn" => "",
            "url" => ""
        );

        $filebinario = StorageUtils::get_file_content($param["ruta"]);
        if ($filebinario !== false) {
            if (!$param["filename"]) {
                $nameFile = basename(json_decode($param["ruta"])->ruta);
            } else {
                $nameFile = $param["filename"];
            }
            if ($param["ruta_almacenar"]) {
                $tempFile = $ruta_db_superior . $param["ruta_almacenar"] . $param["sufijo"] . $nameFile;
                crear_destino($ruta_db_superior . $param["ruta_almacenar"]);
            } else {
                $tempFile = $ruta_db_superior . $_SESSION["ruta_temp_funcionario"] . $param["sufijo"] . $nameFile;
                crear_destino($ruta_db_superior . $_SESSION["ruta_temp_funcionario"]);
            }

            if (!is_file($tempFile) || $force) {
                $ok = file_put_contents($tempFile, $filebinario);
                if ($ok !== false) {
                    if (is_file($tempFile)) {
                        $retorno["exito"] = 1;
                        $retorno["url"] = $tempFile;
                    } else {
                        $retorno["msn"] = "Error al obtener el temporal";
                    }
                } else {
                    $retorno["msn"] = "Error al escribir en el archivo temporal";
                }
            } else {
                $retorno["url"] = $tempFile;
                $retorno["exito"] = 1;
            }
        } else {
            $retorno["msn"] = "Error al obtener el binario";
        }

        return $retorno;
    }

    /**
     * Retorna si tiene o no permiso sobre el modulo
     * 
     * @param string $nombreModulo nombre del modulo
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     * */
    public static function permisoModulo(string $nombreModulo)
    {
        $permiso = new PERMISO();
        return $permiso->acceso_modulo_perfil($nombreModulo);
    }

    /**
     * retorna el string ferencia
     * del archivo almacenado para la bd
     *
     * @param string $route
     *            ruta destino
     * @param string $storageType
     *            tipo para instanciar saiaStorage
     * @param string $content
     *            binario a guardar
     * @return void
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
     * Retorna un array con instancias segun SQL
     *
     * @param string $nameInstance : Nombre de la instancia a generar
     * @param string $nameIdInstance : Nombre del campo que se enviar al constructor de la instancia
     * @param string $sql : Consulta SQL 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function instanceSql(string $nameInstance, string $nameIdInstance, string $sql) : array
    {
        $data = [];
        $consulta = ejecuta_filtro_tabla($sql);
        if ($consulta['numcampos']) {
            for ($i = 0; $i < $consulta['numcampos']; $i++) {
                $data[] = new $nameInstance($consulta[$i][$nameIdInstance]);
            }
        }
        return $data;
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
    /**
     * Devuelve un array con los ids de las instancias
     *
     * @param array $instance : Array de instancias
     * @return array
     */
    public static function getIdsInstance(array $instance) : array
    {
        $data = [];
        foreach ($instance as $inst) {
            $data[] = $inst->getPK();
        }
        return $data;
    }
    /**
     * Ejecuta Select en la DB y retorna datos
     *
     * @param string $sql : Select a ejecutar
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function ejecutaSelect(string $sql) : array
    {
        $data = [
            'numcampos' => 0
        ];
        $records = Conexion::getConnection()->executeSelect($sql);
        $cant = count($records);
        if ($cant) {
            $data = $records;
            $data['numcampos'] = $cant;
        }
        return $data;
    }
    /**
     * filtra el array eliminando los datos vacios
     *
     * @param array $data : valores a procesar
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function cleanForm(array $data) : array
    {
        $response = array_filter($data, function ($val, $key) {
            return trim($val) != '';
        }, ARRAY_FILTER_USE_BOTH);

        return $response;
    }

}
