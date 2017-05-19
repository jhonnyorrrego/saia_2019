<?php
include_once "IndiceSaia.php";

class IndiceMysql implements IndiceSaia {

	public function crear_indice(string $tabla, string $campo) {
	}

	public function consultar_indice(string $tabla, string $campo) {
	}

	public function listar_indices() {
		$indices=ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name  WHERE user_tables.table_name='".$tablas[$i]."' ORDER BY user_tables.table_name,user_indexes.index_name",$conn);

		return $indices;
	}
}
