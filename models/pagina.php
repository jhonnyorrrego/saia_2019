<?php
require_once $ruta_db_superior . 'models/model.php';

class Pagina extends Model {
  protected $table = 'pagina';
  protected $primary = 'consecutivo';
  protected $id_documento;
  protected $imagen;
  protected $pagina;
  protected $ruta;
  protected $fecha_pagina;

  function __construct($id) {
    parent::__construct($id);
  }

  public static function getAllResultDocument($iddoc) {
    global $conn;
    $retorno = array();
    $data = busca_filtro_tabla("consecutivo,imagen,ruta", "pagina", "id_documento=" . $iddoc, "", $conn);
    if ($data["numcampos"]) {
      $retorno["numcampos"] = $data["numcampos"];
      for ($i = 0; $i < $data["numcampos"]; $i++) {
        $retorno["data"][$i] = new Pagina($data[$i]['consecutivo']);
        $retorno["img_small"][$i] = Utilities::getFileTemp($data[$i]['imagen'], 'S');
        $retorno["img_big"][$i] = Utilities::getFileTemp($data[$i]['ruta'], 'B');
      }
    }
    return $retorno;
  }

}
