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
global $conn;
/*muestra una imagen con la firma del funcionario identificado con $_GET["codigo"]*/
$campo=$_REQUEST["campo_modificar"];
$idformato=$_REQUEST["idformato"];
$iddoc=$_REQUEST["iddoc"];

$formato=busca_filtro_tabla("","formato a","a.idformato=".$_REQUEST["idformato"],"",$conn);

$func=busca_filtro_tabla($campo." as firma",$formato[0]["nombre_tabla"]." a","documento_iddocumento=".$iddoc,"",$conn);

header("Content-Type: image/jpeg");
if(MOTOR=="Oracle")
  	echo $func[0]["firma"];
elseif(MOTOR=="MySql")    
    echo $func[0]["firma"];
?>