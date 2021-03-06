<?php
trait TFlujo
{

	function clone()
	{
		$data = $this->getAttributes();
		$class = get_called_class();
		$obj = new $class();
		$obj->setAttributes($data);
		return $obj;
	}

	function findByFk($fkName, $fkValue, $asArray = false)
	{
		return $this->findI([
			$fkName => $fkValue
		], [], '', 0, $asArray);
	}

	function findI($conditions, $fields = [], $order = '', $limit = 0, $asArray = false)
	{


		$table = $this->getTable();
		$select = self::createSelect($fields);
		$condition = self::createCondition($conditions);
		$records = busca_filtro_tabla($select, $table, $condition, $order);

		if ($records['numcampos']) {
			if ($asArray) {
				$response = self::convertToArray($records);
			} else {
				$response = self::convertToObjectCollection($records);
			}
		} else {
			$response = null;
		}

		return $response;
	}

	static function findS($table, $conditions, $fields = [], $order = '', $limit = 0, $asArray = false)
	{


		$select = self::createSelect($fields);
		$condition = self::createCondition($conditions);
		$records = busca_filtro_tabla($select, $table, $condition, $order);

		if ($records['numcampos']) {
			if ($asArray) {
				$response = self::convertToArray($records);
			} else {
				$response = self::convertToObjectCollection($records);
			}
		} else {
			$response = null;
		}

		return $response;
	}

	static function findAll($order = '', $limit = 0, $asArray = false)
	{

		$table = self::getTableName();
		$select = self::createSelect([]);
		$condition = "1 = 1";
		$records = busca_filtro_tabla($select, $table, $condition, $order);

		if ($records['numcampos']) {
			if ($asArray) {
				$response = self::convertToArray($records);
			} else {
				$response = self::convertToObjectCollection($records);
			}
		} else {
			$response = null;
		}

		return $response;
	}

	static function convertToArray($records)
	{
		$total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

		$data = [];
		for ($row = 0; $row < $total; $row++) {
			$fila = [];
			foreach ($records[$row] as $key => $value) {
				if (is_string($key)) {
					$fila[$key] = $value;
				}
			}
			$data[] = $fila;
		}
		return $data;
	}
}
