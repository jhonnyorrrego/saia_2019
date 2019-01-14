<?php
class campo_db{
var $nombre;
var $tipo;
var $longitud;
var $default;
var $nulo;
var $indice=array();
public function __construct($campos_pantalla){
  $this->nombre=$campos_pantalla["nombre"];
  $this->tipo=$campos_pantalla["tipo_dato"];
  $this->longitud=$campos_pantalla["longitud"];
  $this->nulo=$campos_pantalla["obligatoriedad"];
  $banderas=explode(",",$campos_pantalla["banderas"]);
  $cant_banderas=count($banderas);
  for($i=0;$i<$cant_banderas;$i++){
    array_push($this->indice,strlower($banderas[$i]));                 
  } 
}
public function get_campo_db(){
  
}
public function set_campo_db($campos_pantalla){
  $this->nombre=$campos_pantalla["nombre"];
  $this->tipo=$campos_pantalla["tipo_dato"];
  $this->longitud=$campos_pantalla["longitud"];
  $this->nulo=$campos_pantalla["obligatoriedad"];
  $banderas=explode(",",$campos_pantalla["banderas"]);
  $cant_banderas=count($banderas);
  for($i=0;$i<$cant_banderas;$i++){
    array_push($this->indice,strlower($banderas[$i]));                 
  } 
}
public function __destruct(){
  
}
}
?>