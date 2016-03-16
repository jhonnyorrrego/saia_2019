<?php
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
?>