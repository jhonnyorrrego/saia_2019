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
function mostrar_version($iddocumento,$version,$idversion_documento){
    global $conn, $ruta_db_superior;
    $cadena='<div class="row-fluid"><div class="pull-left">Version '.$version.'</div><div class="pull-right"><a class="pull-left" titulo="" href="'.$ruta_db_superior.'pantallas/versiones/arbol_versiones.php?iddoc='.$iddocumento.'&amp;idversion_documento='.$idversion_documento.'" target="detalles"><i title="Ver documento" class="icon-download"></i></a></div></div>';
    return($cadena);
}
?>