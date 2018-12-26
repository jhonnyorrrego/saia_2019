<?php
require_once $ruta_db_superior . 'models/model.php';

class Pagina extends Model {
    public static $primary = 'consecutivo';
    protected $id_documento;
    protected $imagen;
    protected $pagina;
    protected $ruta;
    protected $fecha_pagina;
    protected $dbAttributes;

    function __construct($id) {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'id_documento',
            'imagen',
            'pagina',
            'ruta',
            'fecha_pagina'
        ];
    
        // set the date attributes on the schema
        $dateAttributes = ['fecha_pagina'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * @return int valor del atributo pagina
     * @author Andres.Agudelo
     */
    public function getPagina() {
        return $this -> pagina;
    }

    public function deletePagina() {
        $delete = "DELETE FROM pagina WHERE consecutivo=" . $this -> getPK();
        phpmkr_query($delete) or die("Error al eliminar la pagina");

        $almacenamiento = new SaiaStorage("archivos");
        $fileMiniatura = json_decode($this -> imagen);
        if (is_object($fileMiniatura)) {
            if ($almacenamiento -> get_filesystem() -> has($fileMiniatura -> ruta)) {
                $del1 = $almacenamiento -> eliminar($fileMiniatura -> ruta);
            }
        }

        $fileArchivo = json_decode($this -> ruta);
        if (is_object($fileArchivo)) {
            if ($almacenamiento -> get_filesystem() -> has($fileArchivo -> ruta)) {
                $del2 = $almacenamiento -> eliminar($fileArchivo -> ruta);
            }
        }
        return true;
    }

    /**
     * @param string $sufijo para agregarle un sufijo al nombre, util cuando las imagenes se llaman iguales
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @return string/boolean false en caso de error o string de la ruta de la imagen en miniatura
     * @author Andres.Agudelo
     * */
    public function getUrlImagenTemp($sufijo = 'S', $nameFile = null, $force = false) {
        return $this -> getUrlTemp($this -> imagen, $sufijo, $nameFile, $force);
    }

    /**
     * @param string $sufijo para agregarle un sufijo al nombre, util cuando las imagenes se llaman iguales
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @return string/boolean false en caso de error o string de la ruta de la imagen en completa
     * @author Andres.Agudelo
     * */
    public function getUrlRutaTemp($sufijo = 'B', $nameFile = null, $force = false) {
        return $this -> getUrlTemp($this -> ruta, $sufijo, $nameFile, $force);
    }

    /**
     * @param string $campo nombre del campo (DB) de la imagen
     * @param string $sufijo para agregarle un sufijo al nombre, util cuando las imagenes se llaman iguales
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @return string/boolean false en caso de error o string de la ruta de la imagen en completa
     * @author Andres.Agudelo
     *
     * */
    protected function getUrlTemp($campo, $sufijo, $nameFile, $force) {
        $urlTemp = false;
        $urlImg = Utilities::getFileTemp($campo, $sufijo, $nameFile, $force);
        if ($urlImg["exito"]) {
            $urlTemp = $urlImg["url"];
        }
        return $urlTemp;
    }

    /**
     * @param int $iddoc identificacion del documento
     * @param string $order es el order by de la consulta
     * @return Array coleccion de datos de la pagina (instancias de Pagina)
     * @author Andres.Agudelo
     * */

    public static function getAllResultDocument($iddoc, $order = "") {
        $response = array();
        $response['data'] = self::findAllByAttributes(['id_documento' => $iddoc], ["consecutivo","imagen","ruta"], $order);
        $response['numcampos'] = count($response['data']);

        return $response;
    }

}
