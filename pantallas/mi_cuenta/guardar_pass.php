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
include_once($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
desencriptar_sqli('form_info');
$pass=$_REQUEST["passwordPwd"];
$sql1="UPDATE funcionario SET clave='".encrypt_md5(trim($pass))."' WHERE idfuncionario=".usuario_actual("idfuncionario");
phpmkr_query($sql1);
if(phpmkr_insert_id()){
	alerta("Contraseña cambiada con exito");
}
else{
	alerta("Problemas al cambiar la contraseña");
}
abrir_url($ruta_db_superior."index_actualizacion.php","_self");
?>
