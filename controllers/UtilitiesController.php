<?php
class UtilitiesController {
    /** Genera el archivo temporal con nombre y ruta que se especifique (almacenamiento nuevo)
     * @param string $ruta string obtenido de la DB
     * @param string $suf Sufijo que se concatena al Nombre de la imagen
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @param string $ruta_almacenar ruta donde desea almacenar la imagen
     * @author Andres.Agudelo
     * */
    public static function getFileTemp($param = array("ruta"=>NULL,"sufijo"=>"","filename"=>NULL,"force"=>false,"ruta_almacenar"=>NULL)) {
        global $ruta_db_superior;
        $retorno = array(
            "exito" => 0,
            "msn" => "",
            "url" => ""
        );

        $filebinario = StorageUtils::get_file_content($param["ruta"]);
        if ($filebinario !== false) {
            if (!$param["filename"]) {
                $nameFile = basename(json_decode($param["ruta"]) -> ruta);
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
     * @param string $nombreModulo nombre del modulo
     * @return boolean
     * @author Andres.Agudelo
     * */
    public static function permisoModulo($nombreModulo) {
        $permiso = new PERMISO();
        return $permiso -> acceso_modulo_perfil($nombreModulo);
    }

    /**
     * retorna el string ferencia
     * del archivo almacenado para la bd
     *
     * @param string $route ruta destino
     * @param string $storageType tipo para instanciar saiaStorage
     * @param string $content binario a guardar
     * @return void
     */
    public static function createFileDbRoute($route, $storageType, $content) {
        $SaiaStorage = new SaiaStorage($storageType);
        $size = $SaiaStorage -> almacenar_contenido($route, $content, false);

        if ($size) {
            $response = json_encode([
            "servidor" => $SaiaStorage -> get_ruta_servidor(),
            "ruta" => $route]);
        } else {
            $response = NULL;
        }

        return $response;
    }

    /**
     * retorna la cantidad de dias habiles entre 2 fecha
     *
     * @param Object $Fecha_inicial Objeto de la clase DateTime
     * @param Object $Fecha_final Objeto de la clase DateTime
     *
     * @return int
     *
     */
    function dias_habiles_entre_fechas($Fecha_inicial, $Fecha_final) {
        global $conn;

        if (!is_object($Fecha_inicial) || !is_object($Fecha_final)) {
            $dias_restantes = 0;
        } else {
            $Fecha_inicial -> setTime(0, 0, 0);
            $Fecha_final -> setTime(0, 0, 0);

            $diferencia = $Fecha_final -> diff($Fecha_inicial);

            if ($diferencia -> invert) {
                $fecha_inicial = $Fecha_inicial -> format('Y-m-d');
                $fecha_final = $Fecha_final -> format('Y-m-d');

                $signo = "1";
            } else {
                $fecha_inicial = $Fecha_final -> format('Y-m-d');
                $fecha_final = $Fecha_inicial -> format('Y-m-d');

                $signo = "-1";
            }

            $busca_festivos = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento='-1'  AND fecha_inicial < " . fecha_db_almacenar($fecha_final, 'Y-m-d') . " AND fecha_final > " . fecha_db_almacenar($fecha_inicial, 'Y-m-d'), "", $conn);
            $numero_festivos = $busca_festivos['numcampos'];

            $dias_restantes = ($diferencia -> days - $numero_festivos) * $signo;
        }

        return $dias_restantes;
    }

}
