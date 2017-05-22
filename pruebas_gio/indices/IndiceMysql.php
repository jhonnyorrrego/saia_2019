<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

include_once "IndiceSaia.php";

class IndiceMysql extends IndiceSaia {

	public function __construct($conn) {
		$this->conn = $conn;
	}

	protected function crear_indice(string $tabla, string $campo, string $nombre_indice) {
		return ("CREATE INDEX " . $nombre_indice . " ON " . $tabla . " (" . $campo . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		return ("ALTER TABLE " . $tabla . " RENAME INDEX " . $anterior . " TO " . $nuevo . ";");
	}

	protected function consultar_indice(string $tabla, string $campo) {
	}

	protected function consultar_nombre_pk($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT DISTINCT t.*
		FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS t
		WHERE t.CONSTRAINT_TYPE= 'PRIMARY KEY'
		AND t.TABLE_NAME = '$tabla'
		AND t.TABLE_SCHEMA = '" . $this->conn->Conn->Db . "'", $this->conn);
		// SELECT DISTINCT s.* FROM INFORMATION_SCHEMA.STATISTICS s WHERE 1= 1 AND s.TABLE_NAME = 'accion' AND s.TABLE_SCHEMA = 'saia_release1'
		if ($indices["numcampos"]) {
			return $indices[0]["CONSTRAINT_NAME"];
		}
		return "";
	}

	public function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT DISTINCT TABLE_NAME table_name,
		INDEX_NAME index_name, COLUMN_NAME column_name, TABLE_SCHEMA tablespace_name
		FROM INFORMATION_SCHEMA.STATISTICS
		WHERE TABLE_SCHEMA = '" . $this->conn->Conn->Db . "' ORDER BY TABLE_NAME", $this->conn);
		// $indices = ejecuta_filtro_tabla("SHOW INDEX FROM " . $tabla, $this->conn);
		// print_r($indices);die();

		return $indices;
	}

	protected function mover_indice($tablespace, $nombre) {
		return null;
	}

}
