<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

include_once "IndiceSaia.php";

class IndiceMysql implements IndiceSaia {
	private $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function crear_indice(string $tabla, string $campo) {
	}

	public function consultar_indice(string $tabla, string $campo) {
	}

	public function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SHOW INDEX FROM " . $tabla, $this->conn);
		return $indices;
	}

	public function validar_indices($lista_tablas) {
		$array_create = array();
		$array_alter = array();
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			$indices = $this->listar_indices($lista_tablas[$i]);
			//print_r($indices);die();
			$exito = 0;
			$exito_documento = 0;
			for($j = 0; $j < $indices["numcampos"]; $j++) {
				if (strtoupper($indices[$j]["Column_name"]) == "ID" . strtoupper($lista_tablas[$i]) || strtoupper($indices[$j]["Column_name"]) == "IDTRANSFERENCIA") {
					if ($indices[$j]["Key_name"] == "PRIMARY") {
						$exito = 1;
					}
					/*if (strtoupper($indices[$j]["Key_name"]) != strtoupper($lista_tablas[$i] . "_PK")) {
					 $array_alter[] = ("ALTER TABLE " . $lista_tablas[$i] . " RENAME INDEX " . $indices[$j]["Key_name"] . " TO " . $lista_tablas[$i]["nombre"] . "_pk;");
					 }*/
				}

				if (strtoupper($indices[$j]["Column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
					$exito_documento = 1;
					if (strtoupper($indices[$j]["Key_name"]) != strtoupper($lista_tablas[$i] . "_DOC")) {
						$array_alter[] = ("ALTER TABLE " . $lista_tablas[$i] . " RENAME INDEX " . $indices[$j]["Key_name"] . " TO " . $lista_tablas[$i] . "_doc;");
					}
				}
			}

			if ($exito == 0) {
				$array_create[] = ("CREATE INDEX " . $lista_tablas[$i] . "_pk  ON " . $lista_tablas[$i] . " (id" . ($lista_tablas[$i]) . ");");
			}

			if (!$exito_documento) {
				$campos = $this->conn->Busca_tabla($lista_tablas[$i], "documento_iddocumento");
				//print_r($campos);die();
				if ($campos["numcampos"]) {
					$array_create[] = ("CREATE INDEX " . $lista_tablas[$i] . "_doc  ON " . $lista_tablas[$i] . " (documento_iddocumento);");
				}
			}
		}
		echo ("CREATE<hr>");
		echo implode("<br/>", $array_create);
		echo ("<hr>ALTER O RENAME<hr>");
		echo implode("<br/>", $array_alter);
	}
}
