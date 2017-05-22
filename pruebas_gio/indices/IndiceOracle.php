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

class IndiceOracle extends IndiceSaia {

	public function __construct($conn) {
		$this->conn = $conn;
		$this->tablespace = "SAIA_INDEX01";
	}

	protected function crear_indice(string $tabla, string $campo, string $nombre_indice) {
		return ("CREATE INDEX " . $nombre_indice . " ON " . $tabla . " (" . $campo . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		return ("ALTER INDEX " . strtoupper($anterior) . " RENAME TO " . strtoupper($nuevo) . ";");
	}

	protected function consultar_indice(string $tabla, string $campo) {
	}

	protected function consultar_nombre_pk($tabla) {
	}

	protected function mover_indice($tablespace, $nombre) {
		return ("ALTER INDEX " . $nombre . " REBUILD TABLESPACE " . $tablespace . ";");
	}

	public function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name " . "FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name " . "JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name " . "WHERE user_tables.table_name='" . $tabla . "' ORDER BY user_tables.table_name,user_indexes.index_name", $this->conn);

		return $indices;
	}
}
