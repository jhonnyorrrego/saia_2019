<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");

$formato_hallazgo=busca_filtro_tabla("idformato","formato a","a.nombre LIKE '%hallazgo%plan%mejoramiento'","",$conn);
$campos_formato_hallazgo=busca_filtro_tabla("","campos_formato a","a.formato_idformato=".$formato_hallazgo[0]['idformato'],"",$conn);
$vector_campos_id=array();
for($i=0;$i<$campos_formato_hallazgo['numcampos'];$i++){
    $vector_campos_id[$campos_formato_hallazgo[$i]['nombre']]=$campos_formato_hallazgo[$i]['idcampos_formato'];
}

print_r($vector_campos_id);
?>