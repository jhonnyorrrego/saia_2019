<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
	include_once($ruta_db_superior."db.php");
	include_once($ruta_db_superior."librerias_saia.php");
	include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");
	
	//notificaciones_saia();
?>