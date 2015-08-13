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

function pord($idformato,$iddoc){
echo "<td><input type='text' name='numero_requesicion' id='numero_requesicion' value='123'></td>";

}
function pprod($idformato,$iddoc){
echo "<td><input type='text' name='codigo_producto' id='codigo_producto' value='123'></td>";


}
function pum($idformato,$iddoc){
	echo "<td><input type='text' name='codigo_unidad_medida' id='codigo_unidad_medida' value='123'></td>";


}