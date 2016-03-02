<?php 
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;
  }
  $ruta .= "../";
  $max_salida--;
}
include_once($ruta_db_superior."pantallas/header_adicionar.php");
echo(estilo_bootstrap("3"));
?>

<?php
echo(librerias_jquery("2"));
include_once($ruta_db_superior."pantallas/header_adicionar.php");
?>