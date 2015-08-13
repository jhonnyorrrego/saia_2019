<?php include_once('../librerias/estilo_formulario.php'); 
include_once('../librerias/funciones_formatos_generales.php');
 

$path2="../../imagenes";
$imagen="MISION";
$prueba=file_exists($path2);

$directorio=dir($path2);  
while ($archivo = $directorio->read())
{  
$nom_arc=explode(".",$archivo);
$ultimo=count($nom_arc)-1;

if($nom_arc[0]==strtoupper($imagen)){
$ext= $nom_arc[1];
}
 
}
listado_hijos_formato(7,$_REQUEST["iddoc"]); 
if($ext=="PDF"){
redirecciona("../../imagenes/MISION.PDF");

}
if($ext=="JPG"){
echo '<img src="../../imagenes/MISION.JPG" alt="Mision" width="80%" />';

}
?>