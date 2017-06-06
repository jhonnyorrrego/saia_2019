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

	public function __construct($conn, $tablespace = null) {
		$this->conn = $conn;
		$this->tablespace = "SAIA_INDEX01";
		if(!empty($tablespace)) {
			$this->tablespace = $tablespace;
		}
		$this->mover_tablespace = true;
	}

	protected function crear_indice($tabla, $campo, $nombre_indice) {
		parent::crear_indice($tabla, $campo, $nombre_indice);
		return ("CREATE INDEX " . strtoupper($nombre_indice) . " ON " . $tabla . " (" . strtoupper($campo) . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		parent::renombrar_indice($table_space, $tabla, $anterior, $nuevo);
		return ("ALTER INDEX " . strtoupper($anterior) . " RENAME TO " . strtoupper($nuevo) . ";");
	}

	protected function consultar_indice($tabla, $campo) {
		$indices = ejecuta_filtro_tabla("select i.index_name, ic.table_name, ic.column_name
			from user_indexes i
			join user_ind_columns ic on ic.index_name = i.index_name
			where ic.table_name = '$tabla' and ic.column_name = '$campo'
			order by ic.table_name, ic.column_name;", $this->conn);
		if ($indices["numcampos"]) {
			return $indices[0]["INDEX_NAME"];
		}
		return "";
	}

	protected function consultar_nombre_pk($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT cols.table_name, cols.column_name, cons.constraint_name
			FROM user_constraints cons, user_cons_columns cols
			WHERE cols.table_name = 'DOCUMENTO'
			AND cons.constraint_type = 'P'
			AND cons.constraint_name = cols.constraint_name
			AND cons.owner = cols.owner
			ORDER BY cols.table_name, cols.position", $this->conn);
		if ($indices["numcampos"]) {
			return $indices[0]["CONSTRAINT_NAME"];
		}
		return "";
	}

	protected function mover_indice($tablespace, $nombre) {
		return ("ALTER INDEX " . $nombre . " REBUILD TABLESPACE " . $tablespace . ";");
	}

	protected function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name
			FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name
			JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name
			WHERE user_tables.table_name='" . $tabla . "' ORDER BY user_tables.table_name,user_indexes.index_name", $this->conn);
		return $indices;
	}

	protected function listar_sin_indices() {
		$sin_indices = ejecuta_filtro_tabla("SELECT tc.table_name, tc.column_name from user_tab_cols tc
			WHERE table_name not like '%$%'
			AND NOT EXISTS(SELECT null FROM user_indexes ui JOIN user_ind_columns uic ON ui.index_name = uic.index_name WHERE ui.table_name = tc.table_name)
			ORDER BY tc.table_name,tc.column_name", $this->conn);
		return $sin_indices;
	}

	protected function listar_indices_saia() {
		$sin_indices = ejecuta_filtro_tabla("SELECT tc.table_name, tc.column_name
			FROM cf_indice_saia tc
			LEFT JOIN user_ind_columns uic ON uic.table_name = tc.table_name and uic.column_name = tc.column_name
			WHERE uic.index_name is null
			ORDER BY tc.table_name, tc.column_name", $this->conn);
		return $sin_indices;
	}

	protected function listar_campos_tabla($tabla, $solo_nombres=false) {
		$campos = ejecuta_filtro_tabla("select t.table_name, c.column_name
			from user_tables t
			join user_tab_cols c on t.table_name = c.table_name
			where t.table_name = '$tabla'", $this->conn);
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
