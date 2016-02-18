<?php
die();
set_time_limit(0);
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

$funcionarios=busca_filtro_tabla("","funcionario a","","",$conn);
for($i=0;$i<$funcionarios["numcampos"];$i++){
	$sql2="update funcionario set clave='".encrypt_md5(trim($funcionarios[$i]["clave"]))."' where idfuncionario=".$funcionarios[$i]["idfuncionario"];
	phpmkr_query($sql2);
}
?>