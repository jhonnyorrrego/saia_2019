<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

$sql = "CREATE TABLE calendario_saia(
idcalendario_saia int(11) NOT NULL auto_increment,
fecha date NOT NULL default '0000-00-00',
tipo int(11) NOT NULL default '3',
estilo varchar(255) NOT NULL default '',
datos varchar(255) NOT NULL default '',
encabezado_izquierda varchar(255) NOT NULL default '',
encabezado_centro varchar(255) NOT NULL default '',
encabezado_derecho varchar(255) NOT NULL default '',
adicionar_evento varchar(255) NOT NULL default '',
PRIMARY KEY (idcalendario_saia)
)";

phpmkr_query($sql);

?>