<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

function encrypt_md5($data){
	return(md5(md5($data)));
}
function decrypt_blowfish($data,$key){
	if(!$key && !defined("LLAVE_SAIA_CRYPTO")){
		define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
		$key=LLAVE_SAIA_CRYPTO;
	}
	$iv=pack("H*" , substr($data,0,16));
	$x =pack("H*" , substr($data,16));
	$res = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $x , MCRYPT_MODE_CBC, $iv);
	return trim($res);
}

function encrypt_blowfish($data,$key){
	if(!$key && !defined("LLAVE_SAIA_CRYPTO")){
		define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
		$key=LLAVE_SAIA_CRYPTO;
	}
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
  //die($iv_size);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$crypttext = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_CBC, 
$iv);
	return trim(bin2hex($iv . $crypttext));
}
function cadena_aleatoria($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE){
  $source = 'abcdefghijklmnopqrstuvwxyz';
  if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  if($n==1) $source .= '1234567890';
  if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
  if($length>0){
    $rstr = "";
    $source = str_split($source,1);
    for($i=1; $i<=$length; $i++){
      mt_srand((double)microtime() * 1000000);
      $num = mt_rand(1,count($source));
      $rstr .= $source[$num-1];
    }
  }
  return $rstr;
}
function request_encriptado($param="key_cripto"){
	$iddoc=0;
	$parametros=array();
	if(@$_REQUEST[$param]){
		$iddoc_encript=decrypt_blowfish($_REQUEST[$param],LLAVE_SAIA_CRYPTO);
		$parametros_temp=explode("&",$iddoc_encript);
		foreach ($parametros_temp as $key => $value) {
			$valor=explode("=",$value);
			$parametros[$valor[0]]=$valor[1];
		}
	}
	return($parametros);
}
function seguridad_externa($data){
	global $ruta_db_superior;
	
	include_once($ruta_db_superior."db.php");
	
	$data=decrypt_blowfish($data,LLAVE_SAIA_CRIPTO);
	$data=json_decode($data,1);
	$radicador_web=busca_filtro_tabla("login,funcionario_codigo","funcionario","login='".$data['login_usuario']."' AND funcionario_codigo='".$data['funcionario_codigo']."'","",$conn);
	$ip_ws=busca_filtro_tabla("valor","configuracion","nombre='ip_valida_ws' AND tipo='empresa'","",$conn);
	
	$iplocal=getRealIP();
	$ipremoto=servidor_remoto();
	if($iplocal=="" || $ipremoto==""){
		if($iplocal==""){
			$iplocal=$ipremoto;
		}else{
			$ipremoto=$iplocal;
		}
	}
	if($radicador_web['numcampos'] && $ip_ws[0]['valor']==$iplocal){  //pasa filtro de seguridad
		return(true);	
	}
	return(false);
}

?>