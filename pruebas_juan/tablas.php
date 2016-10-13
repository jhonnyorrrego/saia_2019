<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior . "db.php");

$conn = mysqli_connect('saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com', 'saia', 'cerok_saia421_5');

$sql = "SHOW TABLES FROM saia_nucleo";



$datos = mysqli_query($conn, $sql);

while ($fila = mysqli_fetch_row($datos)) {
    echo "Tabla: {".$fila[0]}."\n";
}






?>
