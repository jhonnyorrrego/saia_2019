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
$usuario=SessionController::getValue('idfuncionario');
$fecha=date('Y-m-d');
$accion=@$_REQUEST["accion"];
$id=@$_REQUEST["idft_distribucion_fisica"];
if($accion==1){
	$sql1="UPDATE ft_distribucion_fisica SET fecha_entregado=".fecha_db_almacenar($fecha,'Y-m-d').", usuario_entregado='".$usuario."' where idft_distribucion_fisica=".$id;
}
else if($accion==2){
	$sql1="UPDATE ft_distribucion_fisica SET fecha_recibido=".fecha_db_almacenar($fecha,'Y-m-d').", usuario_recibido='".$usuario."' where idft_distribucion_fisica=".$id;
}
phpmkr_query($sql1);
echo("Fecha:".$fecha."<br />Por:".usuario_actual("nombres")." ".usuario_actual("apellidos"));
