<?php 


include_once('db.php');


$nombre="ft_proceso";
$formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.nombre_tabla LIKE '".$nombre."'","idformato DESC",$conn);
print_r($formato);
?>

