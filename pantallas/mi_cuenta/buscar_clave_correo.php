<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
$pass_correo=$_REQUEST["clave"];
$busqueda=busca_filtro_tabla("clave_correo","funcionario","idfuncionario=".usuario_actual('idfuncionario'),"",$conn);

//$busqueda=busca_filtro_tabla("","funcionario","idfuncionario=".usuario_actual('idfuncionario')." AND email_contrasena='".$pass_correo."'","",$conn);

if($busqueda[0]['clave_correo'] == '' || $busqueda[0]['clave_correo'] == $pass_correo){
	echo '0';
}else{
	echo '1';
}
?>