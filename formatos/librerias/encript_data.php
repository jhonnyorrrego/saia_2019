<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");

print_r($_REQUEST);
die();
$data = array();
if (isset($_POST["datos"])) {
    $info = json_decode($_POST["datos"], true);
    for($i = 0; $i < count($info); $i ++) {
        $data[$i]["name"] = encrypt_blowfish($info[$i]["name"], LLAVE_SAIA_CRYPTO);
        $data[$i]["value"] = encrypt_blowfish($info[$i]["value"], LLAVE_SAIA_CRYPTO);
    }
}
echo json_encode($data);

?>