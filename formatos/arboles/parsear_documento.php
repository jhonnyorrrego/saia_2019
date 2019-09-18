<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

$id=explode("-",@$_REQUEST["id"]);
$idformato=$id[0];
$campoid=$id[1];
$idft=$id[2];
$formato=busca_filtro_tabla("nombre_tabla","formato A","A.idformato=".$idformato,"");
$dato=busca_filtro_tabla("A.documento_iddocumento as iddoc,A.nombre",$formato[0]["nombre_tabla"]." A","A.".$campoid."=".$idft,"");
$texto="ordenar.php?key=".$dato[0]["iddoc"]."&mostrar_formato=1|".$dato[0]["nombre"];
echo($texto);
?>