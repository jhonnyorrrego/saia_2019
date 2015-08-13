<?php
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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function cargar_imagen_fondo($idformato,$iddoc){
  global $conn;	

	//echo ('<img background="http://'.RUTA_PDF_LOCAL.'/imagenes/prueba23.jpg" style="width:820px;position:absolute;margin: -172px 0 0 -78px;background: top;	z-index:0;" />');
	
	echo (PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/imagenes/prueba23.jpg"; background-repeat:no-repeat">');
}
function prueba_devolucion($idformato,$iddoc){
	global $conn;
	
	//alerta("entraaa");
	//echo "alerta"; die();

}	