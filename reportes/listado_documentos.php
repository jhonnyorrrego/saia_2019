<?php
     
include_once("../db.php");
include_once("../header.php");
include_once("../formatos/librerias/funciones_generales.php");

//include_once("../calendario/calendario.php");
?>

<?php

$serie = busca_filtro_tabla("","documento","estado<>'ELIMINADO' and tipo_radicado=2","",$conn);
print_r($serie);

?>
