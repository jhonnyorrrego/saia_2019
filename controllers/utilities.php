<?php
class Utilities {
    /**
     * @param string $ruta string obtenido de la DB
     * @param string $suf Sufijo que se concatena al Nombre de la imagen
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @author Andres.Agudelo
     * */
    public static function getFileTemp($ruta, $suf = "", $nameFile = null, $force = false) {
        global $ruta_db_superior;
        $retorno = array(
            "exito" => 0,
            "msn" => "",
            "url" => ""
        );
        $filebinario = StorageUtils::get_file_content($ruta);
        if ($filebinario !== false) {
            if (!$nameFile) {
                $nameFile = basename(json_decode($ruta) -> ruta);
            }
            $tempFile = $ruta_db_superior . $_SESSION["ruta_temp_funcionario"] . $suf . $nameFile;

            if (!is_file($temp_pdf) || $force) {
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
        $ok = $permiso -> acceso_modulo_perfil($nombreModulo);
        return $ok;
    }

}
