<?php

abstract class IndiceSaia {
	protected $conn;

	protected $tablespace = "";
	protected $array_create = array();
	protected $array_alter = array();

	protected abstract function crear_indice(string $tabla, string $campo, string $nombre_indice);

	protected abstract function consultar_indice(string $tabla, string $campo);

	protected abstract function listar_indices($tabla);

	protected abstract function renombrar_indice($table_space, $tabla, $anterior, $nuevo);

	protected abstract function consultar_nombre_pk($tabla);

	protected abstract function mover_indice($tablespace, $nombre);

	public function validar_indices($lista_tablas) {
		$this->array_create = array();
		$this->array_alter = array();
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			$indices = $this->listar_indices($lista_tablas[$i]);
			$exito = 0;
			$exito_documento = 0;
			$nombre_pk = $this->consultar_nombre_pk($lista_tablas[$i]);
			for($j = 0; $j < $indices["numcampos"]; $j++) {
				if ($indices[$j]["tablespace_name"] != $this->tablespace) {
					$this->array_alter[] = $this->mover_indice($this->tablespace, $indices[$j]["index_name"]);
				}
				if (strtoupper($indices[$j]["column_name"]) == "ID" . strtoupper($lista_tablas[$i]) || strtoupper($indices[$j]["column_name"]) == "IDTRANSFERENCIA") {
					if (($this instanceof IndiceMysql) && $indices[$j]["index_name"] == $nombre_pk) {
						$exito = 1;
					} else {
						$exito = 1;
						if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_PK")) {
							$this->array_alter[] = $this->renombrar_indice($indices[$j]["tablespace_name"], $lista_tablas[$i], $indices[$j]["index_name"], $lista_tablas[$i] . "_pk");
						}
					}
				}

				if (strtoupper($indices[$j]["column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
					$exito_documento = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_DOC")) {
						$this->array_alter[] = $this->renombrar_indice($indices[$j]["tablespace_name"], $lista_tablas[$i], $indices[$j]["index_name"], $lista_tablas[$i] . "_doc");
					}
				}
			}

			if ($exito == 0) {
				$this->array_create[] = $this->crear_indice($lista_tablas[$i], "id" . $lista_tablas[$i], $lista_tablas[$i] . "_pk");
			}

			if (!$exito_documento) {
				$campos = $this->conn->Busca_tabla($lista_tablas[$i], "documento_iddocumento");
				if ($campos["numcampos"]) {
					$this->array_create[] = $this->crear_indice($lista_tablas[$i], "documento_iddocumento", $lista_tablas[$i] . "_doc");
				}
			}
		}
		echo ("CREATE<hr>");
		echo implode("<br/>", $this->array_create);
		echo ("<hr>ALTER O RENAME<hr>");
		echo implode("<br/>", $this->array_alter);
	}
}