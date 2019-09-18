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
//include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");


$campo_seleccion=$_REQUEST["campo_seleccion"];
$campo_tabla=$_REQUEST["campo_tabla"];
$llave_seleccion=$_REQUEST["llave_seleccion"];
$tabla=$_REQUEST["tabla"];

$func=busca_filtro_tabla($campo_seleccion,$tabla,$campo_tabla."=".$llave_seleccion,"");
$file=$ruta_db_superior.$func[0][$campo_seleccion];
$contenido_archivo=file_get_contents($file);

header("Content-Type: image/jpeg");
echo decrypt_blowfish($contenido_archivo,LLAVE_SAIA_CRYPTO);

function decrypt_blowfish($data,$key){
	if(!defined("LLAVE_SAIA_CRYPTO")){
		define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
		$key=LLAVE_SAIA_CRYPTO;
	}
	$iv=pack("H*" , substr($data,0,16));
	$x =pack("H*" , substr($data,16));
	$res = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $x , MCRYPT_MODE_CBC, $iv);
	return trim($res);
}
?>
