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
     * @param string $route ruta destino
     * @param string $storageType tipo para instanciar saiaStorage
     * @param string $content binario a guardar
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

}
