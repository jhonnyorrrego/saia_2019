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
include_once ($ruta_db_superior . "db.php");

class DHtmlXtreeRolesBuscar {
	private $consultafun, $consultadep, $nombre;
	private $idfun_nucleo = array();
	private $resultado = array();
	private $retorno = array(
		"exito" => 0,
		"mensaje" => "Error al consultar la informaci&oacute;n"
	);

	function __construct($nombre) {
		$this -> nombre = $nombre;
		$func_nucleo = busca_filtro_tabla("idfuncionario", "funcionario", "pertenece_nucleo=1", "", $conn);
		if ($func_nucleo["numcampos"]) {
			$this -> idfun_nucleo = extrae_campo($func_nucleo, "idfuncionario");
		}
	}

	public function obtener_resultados() {
		$this -> consultar_datos();

		$funcionarios = array();
		if ($this -> consultafun['numcampos']) {
			for ($i = 0; $i < $this -> consultafun['numcampos']; $i++) {
				$this -> lista_dependencias_papas($this -> consultafun[$i]['iddependencia']);
				$funcionarios[] = $this -> consultafun[$i]['iddependencia_cargo'];
			}
		}

		$dependencias = array();
		if ($this -> consultadep['numcampos']) {
			for ($i = 0; $i < $this -> consultadep['numcampos']; $i++) {
				$this -> lista_dependencias_papas($this -> consultadep[$i]['iddependencia']);
				$dependencias[] = $this -> consultadep[$i]['iddependencia'] . "#";
			}
		}

		if (!$this -> consultafun["numcampos"] && !$this -> consultadep["numcampos"]) {
			$this -> retorno["mensaje"] = "No se encuentra informaci&oacute;n sobre " . $this -> nombre;
		} else {
			$this -> retorno["datos"] = implode(",", array_unique($this -> resultado));
			$this -> retorno["funcionarios"] = array_unique($funcionarios);
			$this -> retorno["numcampos_func"] = $this -> consultafun["numcampos"];
			$this -> retorno["dependencias"] = array_unique($dependencias);
			$this -> retorno["numcampos_dep"] = $this -> consultadep["numcampos"];
			$this -> retorno["exito"] = 1;
			$this -> retorno["mensaje"] = "";
		}

		return $this -> retorno;
	}

	private function consultar_datos() {
		$parte = "";
		if (count($this -> idfun_nucleo)) {
			$parte = " and idfuncionario not in (" . implode(",", $this -> idfun_nucleo) . ")";
		}
		switch (MOTOR) {
			case 'SqlServer' :
				die("Pendiente de Configurar");
				break;
			default :
				$this -> consultafun = busca_filtro_tabla("iddependencia_cargo,iddependencia", "vfuncionario_dc", "lower(" . concatenar_cadena_sql(array(
					"ifnull(nombres,'')",
					"' '",
					"ifnull(apellidos,'')"
				)) . ") like '%" . $this -> nombre . "%'" . $parte, "cod_padre", $conn);

				$this -> consultadep = busca_filtro_tabla("iddependencia", "dependencia", "lower(nombre) like '%" . $this -> nombre . "%'", "cod_padre", $conn);

				break;
		}

	}

	private function lista_dependencias_papas($id) {
		$buscar_campo = busca_filtro_tabla("cod_padre", "dependencia", "cod_padre IS NOT NULL AND iddependencia=" . $id, "cod_padre", $conn);
		if ($buscar_campo["numcampos"]) {
			$this -> lista_dependencias_papas($buscar_campo[0]["cod_padre"]);
		}
		if ($id == 0) {
			if (array_search($id, $this -> resultado) === false) {
				$this -> resultado[] = $id;
			}
		} else {
			if (array_search($id, $this -> resultado) === false) {
				$this -> resultado[] = $id . "#";
			}
		}
		return;
	}

}

$nombreBuscar = trim(strtolower($_REQUEST['nombre']));
if ($nombreBuscar != "") {
	$classBucar = new DHtmlXtreeRolesBuscar($nombreBuscar);
	$datos = $classBucar -> obtener_resultados();
	echo json_encode($datos);
}
?>