<?php
include_once "IndiceSaia.php";

class IndiceOracle implements IndiceSaia {
	private $conn;
	public function __construct($conn) {
		$this->conn =  $conn;
	}

	public function crear_indice(string $tabla, string $campo) {
	}

	public function consultar_indice(string $tabla, string $campo) {
	}

	public function listar_indices($tabla) {
		$indices = ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name  WHERE user_tables.table_name='" . $tabla . "' ORDER BY user_tables.table_name,user_indexes.index_name", $this->conn);

		return $indices;
	}

	public function validar_indices($lista_tablas) {
		$tablespace = "SAIA_INDEX01";
		$array_create = array();
		$array_alter = array();
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			$indices = $this->listar_indices($lista_tablas[$i]);
			$exito = 0;
			$exito_documento = 0;
			for($j = 0; $j < $indices["numcampos"]; $j++) {
				if ($indices[$j]["tablespace_name"] != $tablespace) {
					$array_alter[] = ("ALTER INDEX " . $indices[$j]["index_name"] . " REBUILD TABLESPACE " . $tablespace . ";");
				}
				if (strtoupper($indices[$j]["column_name"]) == "ID" . strtoupper($lista_tablas[$i]) || strtoupper($indices[$j]["column_name"]) == "IDTRANSFERENCIA") {
					$exito = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_PK")) {
						$array_alter[] = ("ALTER INDEX " . strtoupper($indices[$j]["index_name"]) . " RENAME TO " . strtoupper($lista_tablas[$i]["nombre"]) . "_PK;");
					}
				}

				if (strtoupper($indices[$j]["column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
					$exito_documento = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_DOC")) {
						$array_alter[] = ("ALTER INDEX " . strtoupper($indices[$j]["index_name"]) . " RENAME TO " . strtoupper($lista_tablas[$i]) . "_DOC;");
					}
				}
			}

			if ($exito == 0) {
				$array_create[] = ("CREATE INDEX " . ($lista_tablas[$i]) . "_PK  on " . ($lista_tablas[$i]) . " (id" . ($lista_tablas[$i]) . ");");
			}

			if (!$exito_documento) {
				$campos = $this->conn->Busca_tabla($lista_tablas[$i], "documento_iddocumento");
				if (count($campos)) {
					$array_create[] = ("CREATE INDEX " . ($lista_tablas[$i]) . "_DOC  on " . ($lista_tablas[$i]) . " (documento_iddocumento);");
				}
			}
		}
		echo ("CREATE<hr>");
		echo implode("<br/>", $array_create);
		echo ("<hr>ALTER O RENAME<hr>");
		echo implode("<br/>", $array_alter);
	}
}
