<?php

abstract class IndiceSaia {
	protected $conn;

	protected $tablespace = "";
	protected $array_create = array();
	protected $array_alter = array();
	protected $creados = array();
	//Siempre true a menos que sea Mysql
	protected $renombrar_pk = true;

	//Siempre false a menos que sea Oracle
	protected $mover_tablespace = false;

	protected function crear_indice($tabla, $campo, $nombre_indice) {
		$this->creados[] = strtoupper($nombre_indice);
		$this->creados = array_unique($this->creados);
	}

	protected abstract function consultar_indice($tabla, $campo);

	protected abstract function listar_indices($tabla);

	protected function renombrar_indice($table_space, $tabla, $anterior, $nuevo) {
		unset($this->creados[strtoupper($anterior)]);
		$this->creados[] = strtoupper($nuevo);
		$this->creados = array_unique($this->creados);
	}

	protected abstract function consultar_nombre_pk($tabla);

	protected abstract function mover_indice($tablespace, $nombre);

	protected abstract function listar_sin_indices();

	protected abstract function listar_indices_saia();

	protected abstract function listar_campos_tabla($tabla, $solo_nombres=false);

	public function validar_indices() {
		$this->array_create = array();
		$this->array_alter = array();
		$this->creados = array();
		$this->indices_llaves();
		$this->indices_adicionales();
		$this->indices_saia();

		echo ("--CREATE<hr><br>");
		echo implode("<br/>", $this->array_create);
		echo ("<br><hr>--ALTER O RENAME<hr>");
		echo implode("<br/>", $this->array_alter);
	}

	protected function indices_llaves() {
		$lista_tablas = $this->conn->Lista_Tabla();
		$lista_tablas["numcampos"] = count($lista_tablas);
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			$indices = $this->listar_indices($lista_tablas[$i]);
			$exito = 0;
			$exito_documento = 0;
			$nombre_pk = $this->consultar_nombre_pk($lista_tablas[$i]);
			for($j = 0; $j < $indices["numcampos"]; $j++) {
				if ($this->mover_tablespace && strtoupper($indices[$j]["tablespace_name"]) != strtoupper($this->tablespace)) {
					$this->array_alter[] = $this->mover_indice($this->tablespace, $indices[$j]["index_name"]);
				}
				if (strtoupper($indices[$j]["column_name"]) == "ID" . strtoupper($lista_tablas[$i]) || strtoupper($indices[$j]["column_name"]) == "IDTRANSFERENCIA") {
					//print_r($indices[$j]);die();
					if (!$this->renombrar_pk && $indices[$j]["index_name"] == $nombre_pk) {
						$exito = 1;
					} else {
						$exito = 1;
						//print_r($indices[$j]);die();
						if (strtoupper($indices[$j]["index_name"]) != strtoupper($lista_tablas[$i] . "_PK")) {
							$this->array_alter[] = $this->renombrar_indice($indices[$j]["tablespace_name"], $lista_tablas[$i], $indices[$j]["index_name"], $lista_tablas[$i] . "_pk");
						}
						//print_r($this->array_alter);die();
					}
				}

				if (strtoupper($indices[$j]["column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
					$exito_documento = 1;
					if (strtoupper($indices[$j]["index_name"]) != strtoupper("I_" . $lista_tablas[$i] . "_DOC")) {
						$this->array_alter[] = $this->renombrar_indice($indices[$j]["tablespace_name"], $lista_tablas[$i], $indices[$j]["index_name"], $lista_tablas[$i] . "_doc");
					}
				}
			}

			if ($exito == 0) {
				$this->array_create[] = $this->crear_indice($lista_tablas[$i], "id" . $lista_tablas[$i], $lista_tablas[$i] . "_pk");
			}

			if ($exito_documento == 0) {
				$campos = $this->conn->Busca_tabla($lista_tablas[$i], "documento_iddocumento");
				if ($campos["numcampos"]) {
					$this->array_create[] = $this->crear_indice($lista_tablas[$i], "documento_iddocumento", "i_" . $lista_tablas[$i] . "_doc");
				}
			}
		}

	}

	protected function indices_llaves_new() {
		$lista_tablas = $this->conn->Lista_Tabla();
		$lista_tablas["numcampos"] = count($lista_tablas);
		for($i = 0; $i < $lista_tablas["numcampos"]; $i++) {
			//$indices = $this->listar_indices($lista_tablas[$i]);
			$exito = 0;
			$exito_documento = 0;
			$nombre_pk = $this->consultar_nombre_pk($lista_tablas[$i]);
			$campos = $this->listar_campos_tabla($lista_tablas[$i], true);
			if(empty($nombre_pk)) {
				$candidato = array_search(strtolower("id" . $lista_tablas[$i]), array_map('strtolower', $campos));
				if(!empty($candidato)) {
					$this->array_create[] = $this->crear_indice($lista_tablas[$i], "id" . $lista_tablas[$i], $lista_tablas[$i] . "_pk");
				}
			} else if($this->renombrar_pk) {
				if (strtoupper($nombre_pk) != strtoupper($lista_tablas[$i] . "_PK")) {
					$this->array_alter[] = $this->renombrar_indice($indices[$j]["tablespace_name"], $lista_tablas[$i], $indices[$j]["index_name"], $lista_tablas[$i] . "_pk");
				}
			}
			if($this->mover_tablespace) {
				$indices = $this->listar_indices($lista_tablas[$i]);
				for($j = 0; $j < $indices["numcampos"]; $j++) {
					if ($this->renombrar_pk && $indices[$j]["tablespace_name"] != $this->tablespace) {
						$this->array_alter[] = $this->mover_indice($this->tablespace, $indices[$j]["index_name"]);
					}
				}
			}
		}
	}

	protected function indices_adicionales() {
		$sin_indice = $this->listar_sin_indices();
		for($j = 0; $j < $sin_indice["numcampos"]; $j++) {
			$nombre_indice = $this->obtener_nombre_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"]);

			$sentencia = "";
			if (preg_match("/^ft/i", $sin_indice[$j]["column_name"]) === 1) {
				$sentencia = $this->crear_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"], "i_" . $nombre_indice);
			}
			if (preg_match("/serie/i", $sin_indice[$j]["column_name"]) === 1) {
				$sentencia = $this->crear_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"], "i_" . $nombre_indice);
			}
			if (preg_match("/destino/i", $sin_indice[$j]["column_name"]) === 1) {
				$sentencia = $this->crear_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"], "i_" . $nombre_indice);
			}

			if (preg_match("/_id(serie|documento|archivo)/i", $sin_indice[$j]["column_name"], $matches) === 1) {
				if($matches[2] && strtoupper($matches[2]) == "DOCUMENTO") {
					$nombre_indice = $this->obtener_nombre_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"], "doc");
				}
				$sentencia = $this->crear_indice($sin_indice[$j]["table_name"], $sin_indice[$j]["column_name"], "i_" . $nombre_indice);
			}
			if (!empty($sentencia)) {
				$this->array_create[] = $sentencia;
			}
		}
	}

	protected function indices_saia() {
		$indices = $this->listar_indices_saia();
		for($i = 0; $i < $indices["numcampos"]; $i++) {
			$nombre_indice = $this->obtener_nombre_indice($indices[$i]["table_name"], $indices[$i]["column_name"]);
			$this->array_create[] =  $this->crear_indice($indices[$i]["table_name"], $indices[$i]["column_name"], $nombre_indice);
		}
	}

	protected function obtener_nombre_indice($tabla, $campo, $tipo=null, $sugerencia = null) {
		// Quitar los prefijos de 3 o menos caracteres al nombre de la tabla
		$sufijo = "";
		if(!empty($tipo)) {
			$sufijo = "_$tipo";
		}
		$p_nom_tab = preg_replace("/^([a-zA-Z]{2,3}_)(.*)/", "$2", $tabla);
		if (strlen($p_nom_tab) > 20) {
			$p_nom_tab = substr($p_nom_tab, 0, 19);
		}

		// Quitar los prefijos de 3 o menos caracteres al nombre del campo
		$p_nom_camp = preg_replace("/^([a-zA-Z]{2,3}_)(.*)/", "$2", $campo);
		// $p_nom_camp = ltrim($p_nom_camp, 'id');

		$inicial_campo = substr($p_nom_camp, 0, 10);

		$nombre_indice = $p_nom_tab . "_" . $inicial_campo . $sufijo;
		if (in_array(strtoupper($nombre_indice), $this->creados)) {
			if($sugerencia) {
				$nombre_indice = $sugerencia;
			} else {
				$nombre_indice = $p_nom_tab . "_" . $p_nom_camp;
			}
		}
		return $nombre_indice;
	}
}