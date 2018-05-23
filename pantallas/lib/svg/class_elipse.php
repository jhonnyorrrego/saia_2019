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
include_once ($ruta_db_superior . "pantallas/lib/svg/class_svg.php");
class svgEllipse extends svgObject {
	private $colorFill = "0,0,0";
	private $colorStroke = "0,0,0";
	private $widthStroke = 1;

	private $radiusX = 10;
	private $radiusY = 10;

	public function __construct($radiusX, $radiusY) {
		parent::__construct($radiusX, $radiusY);
	}

	public function getXML() {
		$xml = '<ellipse cx="%d" cy="%d" rx="%d" ry="%d"  %s />';
		return sprintf($xml, $this -> x, $this -> y, $this -> width, $this -> height, $this -> attr);
	}

	private function rgbString($red, $green, $blue) {
		return sprintf("%d,%d,%d", $red, $green, $blue);
	}

	public function setColorFill($red, $green, $blue) {
		$this -> colorFill = $this -> rgbString($red, $green, $blue);
	}

	public function setWidthStroke($width) {
		$this -> widthStroke = $width;
	}

	public function setColorStroke($red, $green, $blue) {
		$this -> colorStroke = $this -> rgbString($red, $green, $blue);
	}

	public function info() {
		printf("Ellipse. Height: %s, Width: %s, X: %d, Y: %d\n", $this -> height, $this -> width, $this -> x, $this -> y);
	}

}
?>