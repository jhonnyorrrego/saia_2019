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

$rol=@$_REQUEST["rol"];
$dependencia=busca_filtro_tabla("","vfuncionario_dc A","A.iddependencia_cargo=".$rol,"",$conn);
$padre=busca_filtro_tabla("","dependencia A","A.iddependencia=".$dependencia[0]["cod_padre"],"",$conn);
echo(utf8_encode($dependencia[0]["dependencia"]."|".$padre[0]["nombre"]));
?>