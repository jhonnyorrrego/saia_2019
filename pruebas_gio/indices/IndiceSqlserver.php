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

	protected function crear_indice(string $tabla, string $campo, string $nombre_indice) {
		return ("CREATE INDEX " . $nombre_indice . " ON " . $tabla . " (" . $campo . ");");
	}

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		return ("EXEC sp_rename N'" . $table_space . "." . $tabla . "." . $anterior . "', N'" . $nuevo . "', N'INDEX';");
	}

	protected function consultar_indice(string $tabla, string $campo) {
	}

	protected function consultar_nombre_pk($tabla) {
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

}
