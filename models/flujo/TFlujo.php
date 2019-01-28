<?php
trait TFlujo {

	function clone() {
		$data = $this->getAttributes();
		$class = get_called_class();
		$obj = new $class();
		$obj->setAttributes($data);
		return $obj;
	}

	function findByFk($fkName, $fkValue, $asArray = false) {
		return $this->findI([
				$fkName => $fkValue
		], [], '', 0, $asArray);
	}

	function findI($conditions, $fields = [], $order = '', $limit = 0, $asArray = false) {
		global $conn;

		$table = $this->getTable();
		$select = self::createSelect($fields);
		$condition = self::createCondition($conditions);

		if($limit) {
			$records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
		} else {
			$records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
		}

		if($records['numcampos']) {
			if($asArray) {
				$response = self::convertToArray($records);
			} else {
				$response = self::convertToObjectCollection($records);
			}
		} else {
			$response = null;
		}

		return $response;
	}

	static function findAll($order = '', $limit = 0, $asArray = false) {
		global $conn;
		$table = self::getTableName();
		$select = self::createSelect([]);
		$condition = "1 = 1";

		if($limit) {
			$records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
		} else {
			$records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
		}
		if($records['numcampos']) {
			if($asArray) {
				$response = self::convertToArray($records);
			} else {
				$response = self::convertToObjectCollection($records);
			}
		} else {
			$response = null;
		}

		return $response;
	}

	static function convertToArray($records) {
		$total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

		$data = [];
		for($row = 0; $row < $total; $row++) {
			$fila = [];
			foreach($records[$row] as $key => $value) {
				if(is_string($key)) {
					$fila[$key] = $value;
				}
			}
			$data[] = $fila;
		}
		return $data;
	}
}