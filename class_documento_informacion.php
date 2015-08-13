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
function anexos_documento($iddoc,$arreglo=0){
  $anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
  if($arreglo)
    return($anexos);
  else 
      return($anexos["numcampos"]);
}
function paginas_documento($iddoc,$arreglo=0){
  $paginas=busca_filtro_tabla("","pagina","id_documento=".$iddoc,"",$conn);
  if($arreglo)
    return($paginas);
  else 
      return($paginas["numcampos"]);  
}
function notas_documento($iddco,$arreglo,$transferencia,$notas_postit){
  //$notas_transferencia=busca_filtro_tabla("","buzon_salida","documento_iddocumento=".);
}
?>