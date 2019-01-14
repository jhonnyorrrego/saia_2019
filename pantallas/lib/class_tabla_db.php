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
include_once($ruta_db_superior."pantallas/lib/class_campo_db.php");
class tabla_db{
  var $conn;
  var $campos_db=array();
  var $nombre;
  public function __construct($nombre){
    $this->nombre=$nombre;
    $this->conn='';   
    $campos_pantalla=$this->get_tabla_db($this->nombre);    
    for($i=0;$i<$campos_pantalla["numcampos"];$i++){
      $tmp=new campo_db($campos_pantalla[$i]);
      array_push($this->campos_db,$tmp);
    }         
  }
  public function get_tabla_db($nombre_tabla){
    global $conn;
    $campos_pantalla=busca_filtro_tabla("","pantalla_campos","tabla LIKE '".$nombre_tabla."'","orden",$conn);
    return($campos_pantalla);
  }
  public function set_tabla_db($nombre){
    $this->nombre=$nombre;
    $this->conn=$conexion;   
    $campos_pantalla=$this->get_tabla_db($this->nombre);
    foreach($campos_pantalla AS $key=>$valor){
      $tmp=new campo_db($valor);
      array_push($this->campos_db,$tmp);
    }
  }
  public function __destruct(){
  
  }                              
} 
?>