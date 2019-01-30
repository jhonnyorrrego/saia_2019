<?php
include_once "db.php";
include_once "pantallas/lib/librerias_cripto.php";
$salida = 0;
$bValidPwd = false;
$retorno["ingresar"] = 0;
$retorno["mensaje"] = "El nombre de usuario o contrase&ntilde;a introducidos no son correctos! intente de nuevo";
$redirecciona = '#';
$admin = 0;
$redirecciona_exito = 'index_' . $_REQUEST["INDEX"] . ".php";

if ($_REQUEST["userid"] <> "" && $_REQUEST["passwd"] <> "") {
	$dias_sesion = busca_filtro_tabla("valor", "configuracion", "tipo='empresa' AND nombre='tiempo_cookie_login'", "", $conn);
	if ($dias_sesion["numcampos"]) {
		$dias_sess = $dias_sesion[0]["valor"];
	} else {
		$dias_sess = 2;
	}

	$_SESSION["LOGIN" . LLAVE_SAIA] = "";
	$sUserId = @$_REQUEST["userid"];
	$sPassWd = @$_REQUEST["passwd"];

	$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
	$clave_admin = busca_filtro_tabla("A.valor,A.encrypt", "configuracion A", "A.tipo='clave' AND A.nombre='clave_administrador'", "", $conn);
	if ($clave_admin['numcampos']) {
		if ($clave_admin[0]["encrypt"]) {
			$clave_admin[0]["valor"] = decrypt_blowfish($clave_admin[0]["valor"], LLAVE_SAIA_CRYPTO);
		}
	}

	if ($configuracion["numcampos"] && $clave_admin["numcampos"] && $configuracion[0]["valor"] == $sUserId && $clave_admin[0]["valor"] == $sPassWd) {
		$estado_admin = busca_filtro_tabla("estado", "funcionario", "lower(login)='" . strtolower($sUserId) . "'", "", $conn);
		if ($estado_admin[0]['estado']) {
			$_SESSION["LOGIN" . LLAVE_SAIA] = $sUserId;
			$retorno["ingresar"] = 1;
			$retorno["ruta"] = $redirecciona_exito;
			$admin = 1;
			$bValidPwd = true;
		} else {
			$retorno["mensaje"] = "El funcionario esta inactivo o no pertenece al sistema! por favor comuniquese con el administrador del sistema.";
			die(stripslashes(json_encode($retorno)));
		}
	}

	if (!$bValidPwd) {
		$usuario = busca_filtro_tabla("idfuncionario,estado,clave,login", "funcionario A", "A.login = '" . $sUserId . "'", "", $conn);
		if ($usuario["numcampos"]) {
			if ($usuario[0]["estado"] == 1) {
				$roles = busca_filtro_tabla(fecha_db_obtener("A.fecha_final", 'Y-m-d') . " AS fecha_final", "vfuncionario_dc A", "idfuncionario = " . $usuario[0]["idfuncionario"] . " and estado_dc=1", "", $conn);
				if ($roles["numcampos"]) {
					$rol = 0;
					for ($i = 0; $i < $roles["numcampos"]; $i++) {
						if ($roles[$i]["fecha_final"] >= date('Y-m-d')) {
							$rol = 1;
							break;
						}
					}
					if (!$rol) {
						$retorno["mensaje"] = "Error en roles ! El usuario no cuenta con roles activos, fechas caducadas";
					} else {
						$error_hab = 0;
						$ok_valida = 0;
						$habi_concurrente = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='empresa' AND A.nombre='habilita_usuarios_concurrentes'", "", $conn);
						if ($habi_concurrente["numcampos"] && $habi_concurrente[0]["valor"] == 1) {
							$ok_valida = 1;
							$cant_concurrente = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='empresa' AND A.nombre='usuarios_concurrentes'", "", $conn);
							if ($cant_concurrente["numcampos"] == 0 || intval(decrypt_blowfish($cant_concurrente[0]["valor"])) == 0) {
								$error_hab = 1;
							}
						}

						if ($error_hab == 0) {
							$validar_ldap = busca_filtro_tabla("valor", "configuracion", "tipo='LDAP' AND nombre='validar_acceso_ldap'", "", $conn);
							$funcionarios_excluidos = array(
								"cerok",
								"mensajero",
								"radicador_web",
								"radicador_salida"
							);
							$cant = busca_filtro_tabla("count(distinct login) as cant", "log_acceso", "fecha_cierre is null and exito=1 and login not in ('" . implode("','", $funcionarios_excluidos) . "') and login<>'" . $sUserId . "'", "", $conn);
							if ($validar_ldap[0]['valor'] == 0 || ($validar_ldap[0]['valor'] == 1 && in_array(strtolower($sUserId), $funcionarios_excluidos))) {
								if (trim($usuario[0]["clave"]) == trim(encrypt_md5($sPassWd))) {
									if ($ok_valida && intval($cant[0]["cant"]) >= intval(decrypt_blowfish($cant_concurrente[0]["valor"]))) {
										$retorno["mensaje"] = "Se ha alcanzado el limite de conexiones concurrentes";
									} else {
										$_SESSION["LOGIN" . LLAVE_SAIA] = $usuario[0]["login"];
										$bValidPwd = true;
									}
								} else {
									$retorno["mensaje"] = "Error en la clave de acceso! intente de nuevo";
								}
							} elseif ($validar_ldap[0]['valor'] == 1) {
								$conexion_ldap = buscar_fun_dir_activo($sUserId, $sPassWd);
								if ($conexion_ldap['ingreso'] == 0) {
									$retorno["mensaje"] = $conexion_ldap['mensaje'];
								} elseif ($conexion_ldap['ingreso'] == 1) {
									if ($ok_valida == 1 && intval($cant[0]["cant"]) >= intval(decrypt_blowfish($cant_concurrente[0]["valor"]))) {
										$retorno["mensaje"] = "Se ha alcanzado el limite de conexiones concurrentes";
									} else {
										$_SESSION["LOGIN" . LLAVE_SAIA] = $usuario[0]["login"];
										$bValidPwd = true;
									}
								}
							} else {
								$retorno["mensaje"] = "Error al consultar la forma de autenticacion! intente de nuevo";
							}
						} else {
							$retorno["mensaje"] = "Error, no se ha definido la cantidad de usuarios permitidos! por favor comuniquese con el administrador del sistema.";
						}
					}
				} else {
					$retorno["mensaje"] = "Error en roles ! El usuario no cuenta con roles activos";
				}
			} else {
				$retorno["mensaje"] = "El funcionario esta inactivo! por favor comuniquese con el administrador del sistema.";
			}
		} else {
			$retorno["mensaje"] = "El funcionario no pertenece al sistema! por favor comuniquese con el administrador del sistema.";
		}
	}
	if ($bValidPwd) {
		if (@$_POST["rememberme"] <> "") {
			setCookie("saia_userid", $sUserId, time() + $dias_sess * 24 * 60 * 60);
			if (@$_POST["rememberme_pwd"] <> "") {
				setCookie("saia_pwd", $sPassWd, time() + $dias_sess * 24 * 60 * 60);
			} else {
				setCookie("saia_pwd", "", 0);
			}
		} else {
			setCookie("saia_userid", "", 0);
		}
		include_once("tarea_limpiar_carpeta.php");
		$cons_temp_func = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
		if ($cons_temp_func["numcampos"]) {
			$ruta_temp_func = $cons_temp_func[0]["valor"];
		} else {
			$ruta_temp_func = "temporal/temporal";
		}
		borrar_archivos_carpeta($ruta_temp_func . "_" . $sUserId, false);
		if ($admin) {
			$retorno["mensaje"] = "IMPORTANTE! Acaba de ingresar como Administrador del sistema, todas las acciones realizadas son registradas bajo su responsabilidad";
		} else {
			$retorno["mensaje"] = "Bienvenido has ingresado al sistema SAIA";
		}
		$retorno["ruta"] = $redirecciona_exito;
		$retorno["ingresar"] = 1;
	} else {
		$dato = almacenar_sesion(0, $sUserId);
		if (isset($dato["mensaje"])) {
			$retorno["mensaje"] = $dato["mensaje"];
		}
		$retorno["ruta"] = $redirecciona;
	}
} else {
	$retorno["ruta"] = $redirecciona;
}
echo (stripslashes(json_encode($retorno)));

function buscar_fun_dir_activo($user, $clave)
{
	$retorno = array(
		"ingreso" => 0,
		"mensaje" => "Error! Por favor ingrse el usuario y la clave"
	);
	if ($user == '' || $clave == '') {
		return $retorno;
	} else {
		$conf = busca_filtro_tabla("nombre,valor", "configuracion A", "tipo='LDAP'", "", $conn);
		if ($conf["numcampos"]) {
			for ($i = 0; $i < $conf["numcampos"]; $i++) {
				switch ($conf[$i]["nombre"]) {
					case 'servidor':
						$servidor = $conf[$i]["valor"];
						break;
					case 'usuario':
						$usuario = $conf[$i]["valor"];
						break;
					case 'pass':
						$pass = $conf[$i]["valor"];
						break;
					case 'identificacion':
						$identificacion = $conf[$i]["valor"];
						break;
				}
			}

			$ds = ldap_connect($servidor);
			ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
			if (!$ds) {
				$retorno['mensaje'] = "Error al conectarse al servidor " . $servidor;
			} else {
				$r_usuario = ldap_bind($ds, $user . "@" . $identificacion, $clave);
				if ($r_usuario) {
					$sql = "update funcionario set clave='" . encrypt_md5($clave) . "' where login='" . $user . "'";
					phpmkr_query($sql);
					$retorno['ingreso'] = 1;
					$retorno['mensaje'] = "";
				} else {
					$cadena = ldap_error($ds);
					if ($cadena == 'Invalid credentials') {
						$retorno['mensaje'] = "Usuario y/o clave incorrectos";
					} else {
						$retorno['mensaje'] = "El acceso al Directorio activo retorna el siguiente error " . $cadena;
					}
				}
			}
		} else {
			$retorno['mensaje'] = "NO se encontraron los datos de configuracion del LDAP " . $servidor;
		}
	}
	return $retorno;
}
?>
