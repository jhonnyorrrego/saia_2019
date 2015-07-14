<?php 
header('Content-Type: application/json');
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
//Procesar archivo debio crear una copia del archivo que se necesita en la carpeta temporal del usuario conectado
//Se debe validar que al ingresar a la pantalla el usuario se debe autenticar  y almacenar en una tabla el token de conexion

// echo(getcwd());
$ruta=str_replace("../","",$_REQUEST["ruta"]);
// echo("<br>".$ruta."<br>");
//echo(file_get_contents($ruta_db_superior.$ruta));

$path_parts = pathinfo($ruta);

//$path_parts['dirname'];
//$path_parts['basename'];
//$path_parts['extension'];
//$path_parts['filename']; 

//$contenido = file_get_contents($ruta_db_superior.$ruta);
$resultado = "ko";
$mensaje = "error al guardar el archivo";
$fileName = $ruta_db_superior.$ruta;
if(file_exists($filename)) {
    $r = file_put_contents($fileName, $_REQUEST["contenido"]);
    if($r) {
	    $resultado = "ok";
	    $mensaje = "archivo actualizado con éxito";
    }
} else {
	$mensaje = "No existe el archivo en la ruta" . getcwd();
}
/*$tmpfname = tempnam(sys_get_temp_dir(), $path_parts['filename'] . "_");
if(!empty($path_parts['extension'])) {
	$tmpfname .= "." . $path_parts['extension'];
}
$tmpHandle = fopen($tmpfname, "w");
fwrite($tmpHandle, $contenido);
fclose($tmpHandle);
*/
echo json_encode(array('resultado' => $resultado,'mensaje'=> $mensaje, 'ruta' => $ruta_db_superior.$ruta));

?>