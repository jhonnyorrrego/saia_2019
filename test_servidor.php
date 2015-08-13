<?php
/*testeo de servidor
 * Para realizar el test del servidor se requiere tener el siguiente archivo al mismo nivel de este script llamado
 * Desert.jpg
 * */
/*unlink("pruebas/Desert.jpg");
unlink("pruebas/prueba.txt");
rmdir("pruebas");
die();*/
crear_archivo();
function crear_carpeta(){
	$destino="pruebas/";
	$crear_carpeta=mkdir($destino,0777);
	if($crear_carpeta){
	  echo("Carpeta creada <br />");
    mover_archivo();
	}
	else{
	  echo("Error creando la carpeta prueba<br />");
	}
}

function copiar_archivo(){
	$archivo="prueba.txt";
	$destino="pruebas/prueba.txt";
  $archivoftp="pruebas/Desert.jpg";
	$destinoftp="Copy_Desert.jpg";
	$copia=copy($archivo,$destino);
  if($copia!==false){
	  echo("<br />Prueba copiadondo ".$archivo." (creado por apache...) a ".$destino."/".$archivo."<br />");  
	  $copia=copy($archivoftp,$destinoftp);
	  if($copia!==false){
	     echo("<br />Prueba copiadondo ".$archivo." (cargado via ftp...) a ".$destino."/".$archivo."<br />");
	  }
	  else{
		   echo("<br />Error al copiar el archivo ".$archivo." (cargado via ftp) a ".$destino." <br />");
	  }
  }  
  else{
	  echo("<br />Error al copiar el archivo ".$archivo." (creado por apache) a ".$destino." <br />");
  }
}
function mover_archivo(){
  $archivo="Desert.jpg";
  $destino="pruebas";  
	$renombrar=rename($archivo,$destino."/".$archivo);
	if($renombrar){
	  echo("Movido el archivo ".$archivo." a ".$destino." <br />");
	}
	else{
	  echo("Error no es posible mover el archivo ".$archivo." a ".$destino." <br />");
	}                     
}
function crear_archivo(){
  crear_carpeta();
	$crear_archivo=file_put_contents("prueba.txt","Hola mundo");
	if($crear_archivo){
	  echo("El archivo prueba.txt fue creado con exito<br />"); 
    copiar_archivo();
	}
	else{
	  echo("El archivo prueba.txt no puede ser creado <br />");
	}
}
?>