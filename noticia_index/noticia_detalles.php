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
include_once($ruta_db_superior."librerias_saia.php"); 


echo(estilo_bootstrap());
?>


<!DOCTYPE html>
<html>
	<head>
		
	</head>
	
		
	<body>
		<h5>Configuración de Noticias y contenido relacionado</h5>
		<br/>
		
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#">Inicio</a></li>
		  <li><a href="#">Perfil</a></li>
		  <li><a href="#">Mensajes</a></li>
		</ul>		
				
		
	</body>
	
</html>