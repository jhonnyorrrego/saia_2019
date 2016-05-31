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
 
	include_once('db.php');
	$ruta=array('jhon.rodriguez@cerok.com');
	 $asunto='preba asunto';
      $mensaje='Saludos,<br><br>Ud. tiene pendiente una solicitud de gastos. Por favor revisar SAIA'; 
      enviar_mensaje('','email',$ruta,$asunto,$mensaje,'e-interno');
?>

