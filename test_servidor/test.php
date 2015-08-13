<?php
include_once("../saia_pruebas/db.php");
$archivo="Chrysanthemum.jpg";
$destino="fabricato/SGD/DATA/Digitalizacion/sgd/hh1";
$crear_carpeta=mkdir($destino,0777);
if($crear_carpeta){
  echo("Carpeta creada <br />");
}
else{
  echo("Error creando la carpeta prueba<br />");
}
$copia=copy($archivo,$destino."/copia_".$archivo);
if($copia!==false){
  echo("<br />Prueba copiadondo ".$archivo." a ".$destino."/copia_".$archivo."<br />");
}
else{
  echo("<br />Error al copiar el archivo ".$archivo." a ".$destino." <br />");
}
$renombrar=rename($archivo,$destino."/".$archivo);
if($renombrar){
  echo("Movido el archivo ".$archivo." a ".$destino." <br />");
}
else{
  echo("Error no es posible mover el archivo ".$archivo." a ".$destino." <br />");
}                     
  
$crear_archivo=file_put_contents("prueba.txt","Hola mundo");
if($crear_archivo){
  echo("El archivo prueba.txt fue creado con exito<br />"); 
}
else{
  echo("El archivo prueba.txt no puede ser creado <br />");
}
phpmkr_db_connect();
$resultado=busca_filtro_tabla("","accion","1=1","",$conn);
print_r($resultado);

redirecciona("../fabricato/SGD/DATA/Digitalizacion/Impuestos/impto000001.PDF");
redirecciona("../../fabricato/SGD/DATA/Digitalizacion/Digitalizacion Documentos Contables/FABRICATO ENTREGA 1 PARTE 2/3/00001608668/00000009.pdf");

?>