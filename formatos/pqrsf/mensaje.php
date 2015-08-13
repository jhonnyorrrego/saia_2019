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
?>
<html>
<body>
<strong>Peticiones:</strong> solicitud de un requerimiento de información por parte del cliente para aportar a la satisfacción de sus necesidades.<br/><br/>

<strong>Quejas:</strong> expresiones de desacuerdo de clientes o personas relacionadas con "nombre del cliente", respecto a sus políticas y/o procedimientos.<br/><br/>

<strong>Reclamos:</strong> demuestra la existencia de un "defecto" en el servicio que afecta la satisfacción plena del cliente.<br/><br/>

<strong>Sugerencias:</strong> ideas generadas por un cliente, enfocadas al mejoramiento del servicio "nombre del cliente" misma.<br/><br/>

<strong>Felicitación:</strong> reconocimiento a las buenas practicas.
</body>
</html>