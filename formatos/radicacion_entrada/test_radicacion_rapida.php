<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">");
echo("<tree id=\"0\">\n");

$ok = new Permiso();

//FORMATO radicacion_entrada
$formato_radicacion = busca_filtro_tabla("etiqueta,nombre", "formato", "nombre='radicacion_entrada'", "", $conn);
if ($formato_radicacion["numcampos"]) {
	$ok_radicacion_entrada = $ok -> acceso_modulo_perfil("crear_" . $formato_radicacion[0]['nombre']);
	if ($ok_radicacion_entrada) {
		echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
		echo("text=\"" . ucwords(strtolower(htmlspecialchars($formato_radicacion[0]["etiqueta"]))) . " Origen Externo\" id=\"radicacion_entrada\" ></item>");

		echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
		echo("text=\"" . ucwords(strtolower(htmlspecialchars($formato_radicacion[0]["etiqueta"]))) . " Origen Interno\" id=\"radicacion_salida\" ></item>");
	}
}

//FORMATO pqrsf
$formato_pqrsf = busca_filtro_tabla("etiqueta,nombre", "formato", "nombre='pqrsf'", "", $conn);
if ($formato_pqrsf["numcampos"]) {
	$ok_pqrsf = $ok -> acceso_modulo_perfil("crear_" . $formato_pqrsf[0]['nombre']);
	if ($ok_pqrsf) {
		echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
		echo("text=\"" . ucwords(strtolower(htmlspecialchars($formato_pqrsf[0]["etiqueta"]))) . " \" id=\"pqrsf\" ></item>");
	}
}

echo("</tree>\n");
?>
