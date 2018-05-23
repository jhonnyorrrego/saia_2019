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
include_once ($ruta_db_superior . "pantallas/lib/svg/class_elipse.php");

class svgCircle extends svgEllipse {
	public function __construct($radius) {
		parent::__construct($radius, $radius);
	}

	public function info() {
		printf("Circle. Height: %s, Width: %s, X: %d, Y: %d\n", $this -> height, $this -> width, $this -> x, $this -> y);
	}

}
?>