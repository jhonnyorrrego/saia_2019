
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

$idformato_informe_contraloria=busca_filtro_tabla("idformato","formato","nombre='informe_contraloria'","",$conn);

?>


<?php include_once('../librerias/estilo_formulario.php'); include_once('../librerias/funciones_formatos_generales.php');?><?php listado_hijos_formato($idformato_informe_contraloria[0]['idformato'],$_REQUEST["iddoc"]); ?>