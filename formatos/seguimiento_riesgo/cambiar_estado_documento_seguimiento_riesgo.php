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

if(isset($_REQUEST['iddocumento'])){
 $update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=".$_REQUEST['iddocumento'];
phpmkr_query($update); 
$nombre  = usuario_actual('nombres').' '.usuario_actual('apellidos');
$mensaje = 'Se elimina el documeto por el funcionario '.$nombre;  
registrar_accion_digitalizacion($_REQUEST['iddocumento'],'ELIMINACION DEL DOCUMENTO',$mensaje);
}
echo(1);