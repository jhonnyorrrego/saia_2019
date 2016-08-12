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



$iddoc=36;
print_r(generar_version_json($iddoc));
function generar_version_json($iddoc){
    global $conn;
    
    $formato=busca_filtro_tabla('','formato a, documento b','lower(b.plantilla)=lower(a.nombre) AND iddocumento='.$iddoc,'',conn);
    
    $json=array();
    
   return $ft=obtener_info_version($iddoc,$formato[0]['nombre_tabla'],'documento_iddocumento');
}
function obtener_info_version($iddoc,$nombre_tabla,$llave){
    global $conn;
    
    $campos_tabla=listar_campos_tabla($nombre_tabla); 
    $keys=array();
    for($i=0;$i<count($campos_tabla);$i++){
        $keys[$campos_tabla[$i]]='';
    }
    
    $select=busca_filtro_tabla('',$nombre_tabla,$llave.'='.$iddoc,'',$conn);
    $json=array();
    for($i=0;$i<$select['numcampos'];$i++){
        for($j=0;$j<count(array_keys($keys));$j++){
            
        }
        $json[$i][]=$select[$i][];
        
    }    
    
    
    
    
    
}


?>