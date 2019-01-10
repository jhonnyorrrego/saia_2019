<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
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
    array_push($this->indice,strtolower($banderas[$i]));                 
  }
} 
public function set_campo_db($campos_pantalla){
  $this->nombre=$campos_pantalla["nombre"];
  $this->tipo=$campos_pantalla["tipo_dato"];
  $this->longitud=$campos_pantalla["longitud"];
  $this->nulo=$campos_pantalla["obligatoriedad"];
  $banderas=explode(",",$campos_pantalla["banderas"]);
  $cant_banderas=count($banderas);
  for($i=0;$i<$cant_banderas;$i++){
    array_push($this->indice,strtolower($banderas[$i]));                 
  } 
}
public function __destruct(){
  
}
}

?>