<?php
$q=$_GET["q"];
if(!$q)return;
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

$busqueda=busca_filtro_tabla("a.idft_certificado_vertimiento, a.codigo_ciiu, a.actividad, a.nombre, a.direccion, a.descripcion","ft_certificado_vertimiento a","a.codigo_ciiu LIKE lower('%".$q."%')","",$conn);

//print_r($busqueda);
for($i=0;$i<$busqueda["numcampos"];$i++){
echo $busqueda[$i]["codigo_ciiu"]."|".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]))."|".codifica_encabezado(html_entity_decode($busqueda[$i]["actividad"]))."|".codifica_encabezado(html_entity_decode($busqueda[$i]["direccion"]))."|".codifica_encabezado(html_entity_decode($busqueda[$i]["descripcion"]))."\n";
//echo $busqueda[$i]["actividad"]."|\n";
}

?>
