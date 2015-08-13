<?php
class Persona{
    private $idbusqueda;
    private $nombre;
    private $etiqueta;
    public function getIdbusqueda(){
      return $this->idbusqueda;
    }
    public function setNombre($nombre){
      $this->nombre = $nombre;
    }
    public function getNombre(){
      return $this->nombre;
    }
    public function setEtiqueta($etiqueta){
      $this->etiqueta = $etiqueta;
    }
    public function getEtiqueta(){
        return $this->etiqueta;
    }
}
if(@$_REQUEST["paso_siguiente_saia"])
  echo($_REQUEST["paso_siguiente_saia"]."@../../funcionario.php");
else 
  echo("#");  
?>