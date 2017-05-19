<?php
include_once "IndiceSaia.php";

class IndiceMysql implements IndiceSaia {

	public function crear_indice(string $tabla, string $campo) {
	}

	public function consultar_indice(string $tabla, string $campo) {
	}

	public function listar_indices() {
		$indices = ejecuta_filtro_tabla("SELECT  t.name AS table_name, i.name AS index_name, s.name AS tablespace_name, c.name AS column_name
    from sys.schemas s
    inner join sys.tables t on t.schema_id = s.schema_id
    inner join sys.indexes i on i.object_id = t.object_id
    inner join sys.index_columns ic on ic.object_id = t.object_id
    and ic.index_id=i.index_id
    inner join sys.columns c on c.object_id = t.object_id
    and ic.column_id = c.column_id
    where t.name='" . $tablas[$i] . "'
    order by index_name", $conn);
		return $indices;
	}

}
