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

class IndiceSqlserver extends IndiceSaia {

	public function __construct($conn) {
		$this->conn = $conn;
	}

	protected function crear_indice($tabla, $campo, $nombre_indice) {
		parent::crear_indice($tabla, $campo, $nombre_indice);
		return ("CREATE INDEX " . $nombre_indice . " ON " . $tabla . " (" . $campo . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		parent::renombrar_indice($table_space, $tabla, $anterior, $nuevo);
		return ("EXEC sp_rename N'" . $table_space . "." . $tabla . "." . $anterior . "', N'" . $nuevo . "', N'INDEX';");
	}

	protected function consultar_indice($tabla, $campo) {
	}

	protected function consultar_nombre_pk($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME
		FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
		WHERE OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + QUOTENAME(CONSTRAINT_NAME)), 'IsPrimaryKey') = 1
		AND TABLE_NAME = '$tabla'", $this->conn);
		if ($indices["numcampos"]) {
			return $indices[0]["CONSTRAINT_NAME"];
		}
		return "";
	}

	public function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT  t.name AS table_name, i.name AS index_name, s.name AS tablespace_name, c.name AS column_name
		    from sys.schemas s
		    inner join sys.tables t on t.schema_id = s.schema_id
		    inner join sys.indexes i on i.object_id = t.object_id
		    inner join sys.index_columns ic on ic.object_id = t.object_id and ic.index_id=i.index_id
		    inner join sys.columns c on c.object_id = t.object_id and ic.column_id = c.column_id
		    where t.name='" . $tabla . "'
		    order by index_name", $this->conn);
		return $indices;
	}

	protected function mover_indice($tablespace, $nombre) {
		return null;
	}

	protected function listar_sin_indices() {
		$sin_indice = ejecuta_filtro_tabla("SELECT t.name AS table_name, s.name AS tablespace_name, c.name AS column_name
		    from sys.schemas s
		    inner join sys.tables t on t.schema_id = s.schema_id
		    inner join sys.columns c on c.object_id = t.object_id
		    where not exists( select null from sys.indexes i
		    join sys.index_columns ic on ic.index_id=i.index_id
		    where i.object_id = t.object_id and ic.object_id = t.object_id and ic.column_id = c.column_id) order by t.name, c.name", $this->conn);
		return $sin_indice;
	}

	protected function listar_indices_saia() {
		$indices = ejecuta_filtro_tabla("SELECT ci.table_name, ci.tablespace_name, ci.column_name
		    from sys.schemas s
		    inner join sys.tables t on t.schema_id = s.schema_id
		    inner join cf_indice_saia ci on ci.table_name = t.name
		    inner join sys.columns c on c.object_id = t.object_id and c.name = ci.column_name
		    where not exists( select null from sys.indexes i
		    	join sys.index_columns ic on ic.index_id=i.index_id
		    	where i.object_id = t.object_id and ic.object_id = t.object_id and ic.column_id = c.column_id
			) order by ci.table_name, ci.tablespace_name", $this->conn);
		return $indices;
	}

	protected function listar_campos_tabla($tabla, $solo_nombres=false) {
		if($solo_nombres) {
			$resp = array();
			for($i = 0; $i < $campos["numcampos"]; $i++) {
				$resp[] = $campos[$i]["column_name"];
			}
			return $resp;
		}
	}

}
