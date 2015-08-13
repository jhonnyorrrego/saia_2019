<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
/**
 * 
 */
class carousel  {
    var $idcarousel;
    var $datos_generales;
    var $datos_contenidos;
    function __construct($idcarousel) {
       global $conn;
       $this->idcarousel=$idcarousel; 
       $this->datos_generales=busca_filtro_tabla("","carrusel","idcarrusel=".$this->idcarousel,"",$conn);              
    }
    function exportar_arreglo_json(){
        $datos=$this->datos_generales;
        for($i=0;$i<$datos["numcampos"];$i++){
            foreach ($datos[$i] as $key => $value) {
                if(!is_numeric($key)){
                    $respuesta[$i][$key]=$value;
                }          
            }
            $this->contenidos();
            for($j=0;$j<$this->datos_contenidos["numcampos"];$j++){
                foreach ($this->datos_contenidos[$j] as $key2 => $value2) {
                  if(!is_numeric($key2)){  
                    $respuesta[$i]["listado_contenidos"][$j][$key2]=$value2;
                  }    
                }
            }
        }   
        return(stripslashes(json_encode($respuesta)));        
    }
    function contenidos(){
        $this->datos_contenidos=busca_filtro_tabla("","contenidos_carrusel A"," A.carrusel_idcarrusel=".$this->idcarousel." ","",$conn);     
    }
}
$carrusel=new carousel(@$_REQUEST["idcarousel"]);
echo($carrusel->exportar_arreglo_json());
?>