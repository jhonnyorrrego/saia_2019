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

class svgRectangle extends svgObject {
	private $colorFill = "0,0,0";
	private $colorStroke = "0,0,0";
	private $widthStroke = 1;
	private $rx = 0;
	private $ry = 0;

	public function __construct($width, $height) {
		parent::__construct($width, $height);
	}

	public function getXML() {
		$xml = '<rect x="' . $this -> x . '" y="' . $this -> y . '" width="' . $this -> width . '" height="' . $this -> height . '" ' . $this -> attr . ' rx="' . $this -> rx . '" ry="' . $this -> ry . '"/>';
		return ($xml);
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

	public function roundBorder($rx = 0, $ry = 0) {
		$this -> rx = $rx;
		$this -> ry = $ry;
	}

	public function info() {
		printf("Rectangle. Height: %s, Width: %s, X: %d, Y: %d\n", $this -> height, $this -> width, $this -> x, $this -> y);
	}

}
?>