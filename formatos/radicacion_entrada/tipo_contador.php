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

include_once($ruta_db_superior."core/autoload.php");


if($_REQUEST['tipo_radicacion']==1){
    $contador=busca_filtro_tabla('','contador','nombre="radicacion_entrada"','',$conn);
    $tipo="E";
}else {
    $contador=busca_filtro_tabla('','contador','nombre="radicacion_salida"','',$conn);
    $tipo="I";
}
$fecha=date('Y-m-d');
$idcontador=array(0=>$fecha."-<b>".$contador[0]['consecutivo']."</b>-".$tipo);
$idcontador=json_encode($idcontador);
echo ($idcontador); 
 
 
?> 