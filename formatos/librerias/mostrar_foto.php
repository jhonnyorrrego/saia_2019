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
$func=busca_filtro_tabla("firma","funcionario","funcionario_codigo=".$_REQUEST["codigo"],"",$conn);

header("Content-Type: image/jpeg");
if(MOTOR=="Oracle"){
	echo stripslashes($func[0]["firma"]);	
}elseif(MOTOR=="MySql")   {
	echo $func[0]["firma"];
}else{
	echo stripslashes(base64_decode($func[0]["firma"]));
}
?>
