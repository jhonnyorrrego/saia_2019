<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/svg/class_rectangulo.php");

class svgSquare extends svgRectangle {
	public function __construct($width) {
		parent::__construct($width, $width);
	}

	public function info() {
		printf("Square. Size: %s, X: %d, Y: %d\n", $this -> height, $this -> x, $this -> y);
	}

}
?>