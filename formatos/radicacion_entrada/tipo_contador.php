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


if($_REQUEST['tipo_radicacion']==1){
    $contador=busca_filtro_tabla('','contador','nombre="radicacion_entrada"','',$conn);
}else {
    $contador=busca_filtro_tabla('','contador','nombre="radicacion_salida"','',$conn);
}
$idcontador=array($contador[0]['idcontador']);
$idcontador=json_encode($idcontador);
print_r($idcontador);die();
return $idcontador;

?> 