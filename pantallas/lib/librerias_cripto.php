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
function desencriptar_sqli($campo_info){
	if($_SESSION["token_csrf"]!==$_POST["token_csrf"]){
		alerta("Error de validacion del formulario por favor intente de nuevo (Posible Error: CSRF) ");
	}

	if (array_key_exists($campo_info, $_POST) ) {
    $data = json_decode($_POST[$campo_info], true);
    unset($_REQUEST);
    unset($_POST);
    for($i = 0; $i < count($data); $i ++) {
        $_REQUEST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
        $_POST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
    }

}
unset($_REQUEST["token_csrf"]);
unset($_SESSION["token_csrf"]);
return;
}
function encriptar_sqli($nombre_form,$submit=false,$campo_info="form_info",$ruta_superior="",$retorno=false){

$texto='';
if ($submit) {
	$texto.='<script type="text/javascript">';
}

$texto.='
	if(!$("#'.$campo_info.'").length){
		$("#'.$nombre_form.'").append('."'".'<input type="hidden" id="'.$campo_info.'" name="'.$campo_info.'">'."'".');
	}
	if(!$("#token_csrf").length){
		$("#'.$nombre_form.'").append('."'".'<input type="hidden" id="token_csrf" name="token_csrf">'."'".');
}';


if ($submit) {
	$texto.='$("#'.$nombre_form.'").submit(function(event){';
}
$_SESSION["token_csrf"]=cadena_aleatoria(50);
	$texto.='var salida = false;
      $.ajax({
        type:"POST",
        async: false,
        url: "'.$ruta_superior.'formatos/librerias/encript_data.php",
        data: {datos:JSON.stringify($("#'.$nombre_form.'").serializeArray(), null)},
        success: function(data) {
					//$("#'.$nombre_form.'")[0].reset();
					$("#'.$nombre_form.'").find("input:hidden,input:text, input:password, input:file, select, textarea").val("");
    			$("#'.$nombre_form.'").find("input:radio, input:checkbox").removeAttr("checked").removeAttr("selected");
					//console.log(JSON.stringify($("#'.$nombre_form.'").serializeArray()));
          $("#'.$campo_info.'").val(data);
					//console.log(JSON.stringify($("#'.$nombre_form.'").serializeArray()));
          //console.log($("#'.$campo_info.'").val());
					$("#token_csrf").val("'.$_SESSION["token_csrf"].'");
          salida = true;
        }
      });';
if ($submit) {
	$texto.='return salida;
			event.preventDefault();
	  });
	</script>';
}

	if($retorno){
		return($texto);
	}
	else{
		echo($texto);
	}
	return;
}
?>
