<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

function encrypt_md5($data) {
	return (md5(md5($data)));
}

function decrypt_blowfish($data, $key) {
	if (is_null($key) && defined("LLAVE_SAIA_CRYPTO")) {
		$key = LLAVE_SAIA_CRYPTO;
	} else if (is_null($key)) {
		define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
		$key = LLAVE_SAIA_CRYPTO;
	}
	$iv = pack("H*", substr($data, 0, 16));
	$x = pack("H*", substr($data, 16));
	$res = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $x, MCRYPT_MODE_CBC, $iv);
	return trim($res);
}

function encrypt_blowfish($data, $key) {
	if (is_null($key) && defined("LLAVE_SAIA_CRYPTO")) {
		$key = LLAVE_SAIA_CRYPTO;
	} else if (is_null($key)) {
		define("LLAVE_SAIA_CRYPTO", "cerok_saia421_5");
		$key = LLAVE_SAIA_CRYPTO;
	}
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$crypttext = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_CBC, $iv);
	return trim(bin2hex($iv . $crypttext));
}

function cadena_aleatoria($length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE) {
	$source = 'abcdefghijklmnopqrstuvwxyz';
	if ($uc == 1)
		$source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if ($n == 1)
		$source .= '1234567890';
	if ($sc == 1)
		$source .= '|@#~$%()=^*+[]{}-_';
	if ($length > 0) {
		$rstr = "";
		$source = str_split($source, 1);
		for ($i = 1; $i <= $length; $i++) {
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1, count($source));
			$rstr .= $source[$num - 1];
		}
	}
	return $rstr;
}

function request_encriptado($param = "key_cripto") {
	$iddoc = 0;
	$parametros = array();
	if (@$_REQUEST[$param]) {
		$iddoc_encript = decrypt_blowfish($_REQUEST[$param], LLAVE_SAIA_CRYPTO);
		$parametros_temp = explode("&", $iddoc_encript);
		foreach ($parametros_temp as $key => $value) {
			$valor = explode("=", $value);
			$parametros[$valor[0]] = $valor[1];
		}
	}
	return ($parametros);
}

function seguridad_externa($data) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "db.php");
	$data = decrypt_blowfish($data, LLAVE_SAIA_CRIPTO);
	$data = json_decode($data, 1);
	$radicador_web = busca_filtro_tabla("login,funcionario_codigo", "funcionario", "login='" . $data['login_usuario'] . "' AND funcionario_codigo='" . $data['funcionario_codigo'] . "'", "", $conn);
	$ip_ws = busca_filtro_tabla("valor", "configuracion", "nombre='ip_valida_ws' AND tipo='empresa'", "", $conn);

	$iplocal = getRealIP();
	$ipremoto = servidor_remoto();
	if ($iplocal == "" || $ipremoto == "") {
		if ($iplocal == "") {
			$iplocal = $ipremoto;
		} else {
			$ipremoto = $iplocal;
		}
	}
	if ($radicador_web['numcampos'] && $ip_ws[0]['valor'] == $iplocal) {//pasa filtro de seguridad
		return (true);
	}
	return (false);
}

function validar_enteros() {
	global $validar_enteros;

	if (isset($validar_enteros)) {
		foreach ($validar_enteros as $key => $valor) {
			if (@$_REQUEST[$valor] && !preg_match("/^[0-9]+$/", @$_REQUEST[$valor])) {
				return ($valor);
			}
		}
	}
	return (false);
}

function desencriptar_sqli($campo_info) {

	if (strpos("script", $_SERVER["PHP_SELF"]) !== false) {
		die("Se encuentra una posible infecci&oacute;n en su c&oacute;digo, a trav&eacute;s DOM-based cross site scripting, por favor contacte a su administrador");
	}

	if (TESTING) {
		unset($_REQUEST["token_csrf"]);
		unset($_SESSION["token_csrf"]);
	}

	if (array_key_exists($campo_info, $_POST)) {
		$data = json_decode(@$_POST[$campo_info], true);
		unset($_REQUEST);
		unset($_POST);
		if (TESTING) {
			unset($data["token_csrf"]);
		}
		$cant = count($data);
		if (!TESTING && $_SESSION["token_csrf"] !== $data["token_csrf"]) {
			alerta("Error de validacion del formulario por favor intente de nuevo (Posible Error: CSRF) ");
			unset($_REQUEST["token_csrf"]);
			unset($_SESSION["token_csrf"]);
			return;
		}

		for ($i = 0; $i < $cant; $i++) {
			if (@$data[$i]["es_arreglo"]) {
				$_REQUEST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = explode(",", decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO));
				$_POST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = explode(",", decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO));
			} else {
				$_REQUEST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
				$_POST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
			}
		}

		$error = validar_enteros();
		if ($error !== false) {
			echo("Se encuentra una posible infecci&oacute;n en su c&oacute;digo, en la llave: " . $_REQUEST[$error] . " (debe ser un entero),por favor contacte a su administrador");
			unset($_REQUEST);
			unset($_POST);
			die();
			//volver(1);
		}
	}
	unset($_REQUEST["token_csrf"]);
	unset($_SESSION["token_csrf"]);

	return;
}

function encriptar_sqli($nombre_form, $submit = false, $campo_info = "form_info", $ruta_superior = "", $retorno = false, $reset_form = true) {
	global $ruta_db_superior;

	$texto = '';
	if ($submit) {
		$texto .= '<script type="text/javascript">  ';
		$texto .= ' $(document).ready(function(){ ';
	}

	$texto .= '
      if(!$("#' . $campo_info . '").length){
        $("#' . $nombre_form . '").append(\'<input type="hidden" id="' . $campo_info . '" name="' . $campo_info . '">\');
      }
    ';

	if ($submit) {
		$texto .= '$("#' . $nombre_form . '").submit(function(event){';
	}

	$texto .= '
      if($(".tiny_formatos").length){
        $.each( $(".tiny_formatos"), function() {
          var id_textarea=$(this).attr("id");
          var contenido_textarea=tinyMCE.get(id_textarea).getContent();
          $("#"+id_textarea).val(contenido_textarea);
        });
		
		 $.each( $(".tiny_avanzado"), function() {
          var id_textarea=$(this).attr("id");
          var contenido_textarea=tinymce.get(id_textarea).getContent();
          $("#"+id_textarea).val(contenido_textarea);
        });
      }';

	$texto .= 'salida_sqli = false;
          $.ajax({
            type:"POST",
            async: false,
            url: "' . $ruta_superior . 'formatos/librerias/encript_data.php",
            data: {datos:JSON.stringify($("#' . $nombre_form . '").serializeArray())},
            success: function(data) {
              //$("#' . $nombre_form . '")[0].reset();
      ';
	if ($reset_form) {
		$texto .= '
          $("#' . $nombre_form . '").find("input:hidden,input:text, input:password, select, textarea").val("");
            $("#' . $nombre_form . '").find("input:radio, input:checkbox, select").removeAttr("checked").removeAttr("selected");
            $.each( $(".tiny_formatos"), function() {
              var id_textarea=$(this).attr("id");
	          tinyMCE.get(id_textarea).setContent("");
	        });
			$.each( $(".tiny_avanzado"), function() {
              var id_textarea=$(this).attr("id");
	          tinymce.get(id_textarea).setContent("");
	        });
        ';
	}
	$texto .= '
              $("#' . $campo_info . '").val(data);
              salida_sqli = true;
            }
          });';
	if ($submit) {
		$texto .= 'return salida_sqli;
          event.preventDefault();
        });

      });
       </script>';
	}

	if ($retorno) {
		return ($texto);
	} else {
		echo($texto);
	}
	return;
}
?>