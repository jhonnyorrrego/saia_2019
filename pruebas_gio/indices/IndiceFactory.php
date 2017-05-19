<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");

class IndiceFactory {

	public function getIndice() {
		switch ($conn->motor) {
			case "MySql":
				return new IndiceMysql();
			case "Oracle":
				return new IndiceOracle();
			case "SqlServer":
				return new IndiceSqlserver();
			case "MSSql":
				return new IndiceMssql();
		}

	}
}
