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
include_once($ruta_db_superior."librerias_saia.php");

$dependencia=$_REQUEST['iddependencia'];

$datos=busca_filtro_tabla('','ft_dependencias_ruta a,ft_ruta_distribucion b,documento c','lower(c.estado)="aprobado" AND b.documento_iddocumento=c.iddocumento AND a.ft_ruta_distribucion=b.idft_ruta_distribucion AND a.dependencia_asignada='.$dependencia,'',$conn);
//print_r($datos);

if($datos['numcampos']>0){
    echo json_encode(1);
}else{
    echo json_encode(0);
}