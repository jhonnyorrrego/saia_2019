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
		$this->renombrar_pk = false;
	}

	protected function crear_indice($tabla, $campo, $nombre_indice) {
		parent::crear_indice($tabla, $campo, $nombre_indice);
		return ("CREATE INDEX " . $nombre_indice . " ON " . $tabla . " (" . $campo . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		parent::renombrar_indice($table_space, $tabla, $anterior, $nuevo);
		return ("ALTER TABLE " . $tabla . " RENAME INDEX " . $anterior . " TO " . $nuevo . ";");
	}

	protected function consultar_indice($tabla, $campo) {
		$indices = ejecuta_filtro_tabla("SELECT DISTINCT t.*
				FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS t
				WHERE t.CONSTRAINT_TYPE <> 'PRIMARY KEY'
				AND t.TABLE_NAME = '$tabla'
				AND t.TABLE_SCHEMA = '" . $this->conn->Conn->Db . "'", $this->conn);
		// SELECT DISTINCT s.* FROM INFORMATION_SCHEMA.STATISTICS s WHERE 1= 1 AND s.TABLE_NAME = 'accion' AND s.TABLE_SCHEMA = 'saia_release1'
		if ($indices["numcampos"]) {
			return $indices[0]["CONSTRAINT_NAME"];
		}
		return "";
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
		WHERE TABLE_NAME = '$tabla' AND TABLE_SCHEMA = '" . $this->conn->Conn->Db . "' ORDER BY TABLE_NAME", $this->conn);
		// $indices = ejecuta_filtro_tabla("SHOW INDEX FROM " . $tabla, $this->conn);
		// print_r($indices);die();

		return $indices;
	}

	protected function mover_indice($tablespace, $nombre) {
		return null;
	}

	protected function listar_sin_indices() {
		$sin_indices = ejecuta_filtro_tabla("select distinct a.table_name, a.column_name
			from information_schema.columns a
			left join INFORMATION_SCHEMA.STATISTICS c on c.TABLE_NAME = a.table_name and a.TABLE_SCHEMA = c.TABLE_SCHEMA and a.column_name = c.column_name
			where a.TABLE_SCHEMA = '" . $this->conn->Conn->Db . "'
			and c.INDEX_NAME is null order by a.table_name, a.column_name", $this->conn);
		return $sin_indices;
	}

	protected function listar_indices_saia() {
		$sin_indices = ejecuta_filtro_tabla("select distinct a.table_name, a.column_name
			from cf_indice_saia a
			left join INFORMATION_SCHEMA.STATISTICS c on c.TABLE_NAME = a.table_name and a.tablespace_name = c.TABLE_SCHEMA and a.column_name = c.column_name
			where a.tablespace_name = '" . $this->conn->Conn->Db ."'
			and c.INDEX_NAME is null
			order by a.table_name,a.column_name;", $this->conn);
		return $sin_indices;
	}

	protected function listar_campos_tabla($tabla, $solo_nombres=false) {
		$campos = ejecuta_filtro_tabla("select distinct a.table_name, a.column_name
			from information_schema.columns a
			where a.TABLE_SCHEMA = '" . $this->conn->Conn->Db . "'
			and a.TABLE_NAME = '$tabla'", $this->conn);
		if($solo_nombres) {
			$resp = array();
			for($i = 0; $i < $campos["numcampos"]; $i++) {
				$resp[] = $campos[$i]["column_name"];
			}
			return $resp;
		}
		return $campos;
	}
}
