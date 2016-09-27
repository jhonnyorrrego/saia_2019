<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1
echo ("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
$inicio = valida("inicio", @$_REQUEST["carpeta_inicial"]);
if (@$include != "") {
	include_once (@$include);
}

function listar_directorios_ruta2($ruta, $nivel, $padre) {
	// abrir un directorio y listarlo recursivo
	if (is_dir($ruta)) {
		$dh = scandir($ruta);
		if ($dh) {
			$cant = count($dh);
			for($i = 0; $i < $cant; $i++) {
				$file = $dh[$i];
				$info = info_archivo($ruta, $file, $nivel);
				$info["nivel"] = $nivel;
				$info["cod_padre"] = $padre;
				if ($file != "." && $file != ".." && $file!=".git") {
					if (is_dir($ruta . "/" . $file)) {
						// solo si el archivo es un directorio, distinto que "." y ".."
						directorio1($info);
						listar_directorios_ruta2($info["siguiente"] . "/", $info["nivel"] + 1, $info["cod_padre"]);
						directorio2($info);
					} else {
						archivo($info);
					}
				}
			}
		}
	} else {
		// echo $ruta."<br>No es ruta valida";
	}
	return (@$info["nombre"]);
}

function directorio1($info) {
	global $texto;
	$id_item = str_replace("//", "/", str_replace("../../", "", $info["ruta"]) . "/" . $info["nombre"] );
	$texto .= "<item style=\"font-family:verdana; font-size:7pt;\" ";
	$uid = uniqid("LVL-" . $info["nivel"] . "-UID-");
	$texto .= "text=\"" . $info ["nombre"] . "\" id=\"" . $uid . "\">\n";
	$texto .= "<userdata name='myurl'></userdata>\n";
  $texto .= "<userdata name='name_url'>".$info["nombre"]."</userdata>\n";
    $texto .= "<userdata name='realpath'>" . trim($id_item) . "</userdata>\n";
	return;
}

function directorio2($info) {
	global $texto;
	$texto .= "</item>\n";
	return;
}

function archivo($info) {
	global $texto, $extensiones_permitidas;
	if (!in_array($info["extension"], $extensiones_permitidas) || @$_REQUEST["solo_carpetas"])
		return;
	$id = 0;
	$nombre = $info["etiqueta"];
	$arreglo = explode("-", $nombre);
	$id_item = str_replace("//", "/", str_replace("../../", "", $info["ruta"]) . "/" . $info["nombre"] . "." . $info["extension"]);
	$texto .= "<item style=\"font-family:verdana; font-size:7pt;\" ";
	$texto .= "text=\"" . $info["nombre"] . "." . $info["extension"] . "\" id=\"" . $id_item . "\">";
	$texto .= "<userdata name='myurl'>" . trim(str_replace("//", "/", $info["ruta"] . "/" . $info["nombre"]) . "." . $info["extension"]) . "</userdata>\n";
	$texto .= "<userdata name='myextension'>" . trim($info["extension"]) . "</userdata>\n";
	$texto .= "<userdata name='realpath'>" . trim($id_item) . "</userdata>\n";
  $texto .= "<userdata name='name_url'>".$info["nombre"]."</userdata>\n";
	$texto .= "</item>\n";
	return;
}

function valida($var, $default) {
	if (isset($_GET[$var]))
		return ($_GET[$var]);
	else if (isset($_POST[$var]))
		return ($_POST[$var]);
	else
		return ($default);
}

function info_archivo($ruta, $cadena, $nivel) {
	$info = array ();
	$info["tipo"] = filetype($ruta . "/" . $cadena);
	$info["ruta"] = $ruta;
	$info["longitud"] = strlen($cadena);
	if (is_dir($ruta . "/" . $cadena)) {
		$info["siguiente"] = str_replace("//", "/", $ruta . "/" . $cadena);
		if ($cadena != "." && $cadena != "..") {
			$info["nombre"] = $cadena;
			$info["etiqueta"] = str_replace("_", " ", $cadena);
		}
	} else {
		$punto = strrpos($cadena, ".");
		$info["nombre"] = substr($cadena, 0, $punto);
		$info["extension"] = substr($cadena, $punto + 1);
		$info["etiqueta"] = str_replace("_", " ", $info["nombre"]);
	}
	return ($info);
}

if (@$_REQUEST["extensiones_permitidas"]) {
	$extensiones_permitidas = explode(",", $_REQUEST["extensiones_permitidas"]);
} else
	$extensiones_permitidas = array (
			"php",
			"js",
			"css"
	);

$iniciales = explode(",", $inicio);
$nombres = explode(",", @$_REQUEST["carpeta_inicial"]);
$cant = count($iniciales);
$texto = "";
$texto .= "<tree id=\"0\">\n";
for($i = 0; $i < $cant; $i++) {
	$nivel = 0;
	if (@$_REQUEST["carpeta_inicial"]) {
		$texto .= "<item style=\"font-family:verdana; font-size:7pt;\" ";
		$uid = uniqid("LVL-" . $nivel . "-UID-");
		$texto .= "text=\"" . @$nombres[$i] . "\" id=\"" .$uid . "\">";
	}
	listar_directorios_ruta2($ruta_db_superior . $iniciales[$i], $nivel+1, 0);
	if (@$_REQUEST["carpeta_inicial"]) {
		$texto .= "</item>\n";
	}
}
$texto .= "</tree>\n";
echo ($texto);
// crear_archivo("test_upload.xml",$texto);
?>