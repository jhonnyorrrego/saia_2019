<?php include_once('../librerias/estilo_formulario.php'); include_once('../librerias/funciones_formatos_generales.php');?><p></p>

<?php

$path2="../../imagenes";
$imagen="VISION";
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
if($ext=="PDF"){
redirecciona("../../imagenes/VISION.PDF");

}
if($ext=="JPG"){
echo '<img src="../../imagenes/VISION.JPG" alt="Vision" width="80%" />';

}
if($ext=="PNG"){
echo '<img src="../../imagenes/VISION.PNG" alt="Vision" width="80%" />';

}

listado_hijos_formato(124,$_REQUEST["iddoc"]);?>