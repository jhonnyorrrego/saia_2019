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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");

$datos=busca_filtro_tabla('iddependencia','vfuncionario_dc','iddependencia_cargo='.$_REQUEST['iddependencia_cargo'],'',conn);

$datos[1]=$datos[0]['iddependencia'];
$datos[2]=$datos[0]['iddependencia'];
echo($datos);