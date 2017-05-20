<?php
include_once "IndiceSaia.php";

class IndiceSqlserver implements IndiceSaia {
	private $conn;
	public function __construct($conn) {
		$this->conn =  $conn;
	}

	public function crear_indice(string $tabla, string $campo) {
	}

	public function consultar_indice(string $tabla, string $campo) {
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

	public function validar_indices($lista_tablas) {
		$array_create = array();
		$array_alter = array();
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			$indices = $this->listar_indices($lista_tablas[$i]);
			$exito = 0;
			$exito_documento = 0;
			for($j = 0; $j < $indices["numcampos"]; $j++) {
				if (strtoupper($indices[$j]["column_name"]) == "ID" . strtoupper($lista_tablas[$i]) || strtoupper($indices[$j]["column_name"]) == "IDTRANSFERENCIA") {
					$exito = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_PK")) {
						$array_alter[] = ("EXEC sp_rename N'" . ($indices[$j]["tablespace_name"]) . "." . ($indices[$j]["table_name"]) . "." . ($indices[$j]["index_name"]) . "', N'" . ($lista_tablas[$i]) . "_PK', N'INDEX';");
					}
				}

				if (strtoupper($indices[$j]["column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
					$exito_documento = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_DOC")) {
						$array_alter[] = ("EXEC sp_rename N'" . ($indices[$j]["tablespace_name"]) . "." . ($indices[$j]["table_name"]) . "." . ($indices[$j]["index_name"]) . "', N'" . ($lista_tablas[$i]) . "_DOC', N'INDEX';");
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
