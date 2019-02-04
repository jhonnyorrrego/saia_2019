<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while($max_salida > 0) {
	if(is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
	}

	$ruta .= '../';
	$max_salida--;
}

require_once $ruta_db_superior . 'db.php';

$data = [];

if(!empty($_REQUEST["termino"])) {

	$termino = $_REQUEST["termino"];
	$funcionarios = busca_filtro_tabla("idfuncionario, login, nombres, apellidos, email", "funcionario", "estado = 1 and nombres like '%$termino%' or apellidos like '%$termino%'", "", $conn);
	

	if($funcionarios["numcampos"]) {
		$total = isset($funcionarios['numcampos']) ? $funcionarios['numcampos'] : count($funcionarios);

		for($row = 0; $row < $total; $row++) {
			$fila = [];
			foreach($funcionarios[$row] as $key => $value) {
				if(is_string($key)) {
					$fila[$key] = $value;
				}
			}
			$data[] = $fila;
		}
	}
}

echo json_encode($data);