<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

require_once $ruta_db_superior . 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

class Excelphp {

	public static function leer_archivo_excel($archivo, $key = array()) {
		$ok1 = false;
		if (in_array(1, $key)) {// Retorna las columnas con Numeros "1"
			$ok1 = true;
		}
		$ok2 = false;
		if (in_array(2, $key)) {// Retorna las columnas con letras "A"
			$ok2 = true;
		}
		$ok3 = false;
		if (in_array(3, $key)) {// Retorna las columnas con el encabezado "nombre"
			$ok3 = true;
		}
		if (!$ok1 && !$ok2 && !$ok3) {
			$ok1 = true;
		}

		$inputFileType = PHPExcel_IOFactory::identify($archivo);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objReader -> setReadDataOnly(true);
		$objPHPExcel = $objReader -> load($archivo);
		$objWorksheet = $objPHPExcel -> getActiveSheet();

		$retorno = array();
		if ($ok3) {
			$encabezado = array();
		}
		$i = 1;
		foreach ($objWorksheet->getRowIterator() as $row) {
			$j = 0;
			$col = 'A';
			$cellIterator = $row -> getCellIterator();
			$cellIterator -> setIterateOnlyExistingCells(false);
			foreach ($cellIterator as $cell) {
				if ($i == 1) {
					if (trim($cell -> getValue())) {
						$encabezado[$j] = str_replace(" ", "_", $cell -> getValue());
					} else {
						$encabezado[$j] = $col;
					}
				}
				if ($ok1) {
					$retorno[$i][$j] = $cell -> getValue();
				}
				if ($ok2) {
					$retorno[$i][$col] = $cell -> getValue();
				}
				if ($ok3) {
					$retorno[$i][$encabezado[$j]] = $cell -> getValue();
				}
				$j++;
				$col++;
			}
			$i++;
		}
		return $retorno;
	}

}
