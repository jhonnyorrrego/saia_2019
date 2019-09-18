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

/*muestra una imagen con la firma del funcionario identificado con $_GET["codigo"]*/
$func=busca_filtro_tabla("imagen","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["id"],"");

header("Content-Type: image/jpeg");
if(MOTOR=="Oracle")
   echo stripslashes($func[0]["imagen"]);
elseif(MOTOR=="MySql")   
    echo $func[0]["imagen"];
?>
