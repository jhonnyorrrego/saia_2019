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
include('db.php');




function generar_version_json($iddoc){
    global $conn;
    
    
    $formato=busca_filtro_tabla('','formato a, documento b','lower(b.plantilla)=lower(a.nombre) AND iddocumento='.$iddoc,'',conn);
    
    $json=array();
    
    $ft=obtener_info_version($iddoc,$formato[0]['nombre_tabla']);
    
    
}
function obtener_info_version($iddoc,$nombre_tabla){
    
}


?>