<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
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
include_once($ruta_db_superior."formatos/librerias/num2letras.php");

function mostrar_solicitante($idformato,$iddoc){
	global $ruta_db_superior;
	
$consulta=busca_filtro_tabla("A.nombres","vfuncionario_dc A,ft_solicid_matenimiento B"," A.iddependencia_cargo=B.dependencia AND  B.documento_iddocumento=".$iddoc,"",$conn);	
	//print_r($consulta);
	echo $consulta[0]['nombres'];
}



?>