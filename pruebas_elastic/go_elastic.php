<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");

$go_cfg = array();
$go_cfg[] = config_inicial();
$go_cfg[] = "[[source]]";

$go_cfg[] = 'schema="' . $conn->Conn->Db . '"';
$go_cfg[] = 'tables=["documento","ft_pqrsf", "ft_clasificacion_pqrsf", "ft_analisis_pqrsf"]';
$go_cfg[] = "\n";

$go_cfg[] = "[[rule]]";

$go_cfg[] = 'schema = "' . $conn->Conn->Db . '"';
$go_cfg[] = 'index = "documentos"';
$go_cfg[] = 'type = "DOCUMENTO"';
$go_cfg[] = 'table = "documento"';
$formatos = busca_filtro_tabla("idformato, nombre, nombre_tabla", "formato", "cod_padre = 0 and nombre = 'pqrsf'", "nombre ", $conn);
//print_r($conn);die();
for($i = 0; $i < $formatos["numcampos"]; $i++) {
	$go_cfg[] = "\n[[rule]]";
	$go_cfg[] = 'schema = "' . $conn->Conn->Db . '"';
	$go_cfg[] = 'index = "documentos"';
	$go_cfg[] = 'type = "' . strtoupper($formatos[$i]["nombre"]) . '"';
	$go_cfg[] = 'table = "' . $formatos[$i]["nombre_tabla"] . '"';
	$hijos = obtener_info_hijos($formatos[$i]["idformato"]);
	if(!empty($hijos)) {
		$go_cfg = array_merge($go_cfg, $hijos);
	}
}
print_r($go_cfg);
file_put_contents("formatos.toml", implode("\n", $go_cfg));
die();

function obtener_info_hijos($idformato) {
	global $conn;
	$info_formato = busca_filtro_tabla("idformato, nombre, nombre_tabla, item", "formato", "idformato=$idformato", "", $conn);

	if (!$info_formato["numcampos"]) {
		return array();
	}
	$es_item1 = $info_formato[0]["item"] == '1';
	$tabla1 = $info_formato[0]["nombre_tabla"];
	$plantilla_padre = $info_formato[0]["nombre"];
	$idplantilla_padre = $info_formato[0]["idformato"];
	$formatos_hijos = busca_filtro_tabla("h.idformato, h.nombre, h.nombre_tabla, h.item", "formato h", "h.cod_padre = $idplantilla_padre", "", $conn);

	//print_r($formatos_hijos);die();
	$datos_hijos = array();
	for($i = 0; $i < $formatos_hijos["numcampos"]; $i++) {
		$plantilla = strtoupper($formatos_hijos[$i]["nombre"]);
		$tabla = $formatos_hijos[$i]["nombre_tabla"];
		$es_item = $formatos_hijos[$i]["item"] == '1';
		$idformato_hijo = $formatos_hijos[$i]["idformato"];
		$datos_hijos[] = "\n[[rule]]";
		$datos_hijos[] = 'schema = "' . $conn->Conn->Db . '"';
		$datos_hijos[] = 'index = "documentos"';
		$datos_hijos[] = 'type = "' . $plantilla . '"';
		$datos_hijos[] = 'table = "' . $tabla . '"';
		$datos_hijos[] = 'parent = "' . strtolower($tabla1) . '"';

		$datos_hijos = array_merge($datos_hijos, obtener_info_hijos($idformato_hijo));
		// print_r($documentos_hijos);die();
	}
	return $datos_hijos;
}

function config_inicial() {
	global $conn;

	$datos = '# MySQL address, user and password
# user must have replication privilege in MySQL.
my_addr = "' . $conn->Conn->Host . ':' . $conn->Conn->Puerto . '"
my_user = "' . $conn->Conn->Usuario . '"
my_pass = "' . $conn->Conn->Pass . '"
my_charset = "utf8"

# Elasticsearch address
es_addr = "127.0.0.1:9200"

# mysql or mariadb
flavor = "mysql"

# mysqldump execution path
# if not set or empty, ignore mysqldump.
mysqldump = "mysqldump"

# minimal items to be inserted in one bulk
bulk_size = 128

# force flush the pending requests if we don not have enough items >= bulk_size
flush_bulk_time = "200ms"

# MySQL data source
';
	return $datos;
}
