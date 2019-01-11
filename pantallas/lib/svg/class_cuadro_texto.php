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
include_once ($ruta_db_superior . "pantallas/lib/svg/class_rectangulo.php");
include_once ($ruta_db_superior . "pantallas/lib/svg/class_texto.php");
class svgTextBox extends svgObject {
	public $text = "Void";
	public $box;

	public function __construct($text, $width, $height) {
		parent::__construct($width, $height);

		//Properties by default, but they could be override later.
		$this -> box = new svgRectangle($width, $height);
		$this -> text = new svgText($text);
		$this -> text -> setTextAnchor('middle');
		$this -> text -> setFont(null, null, null, null);
	}

	public function getXML() {
		$xml = $this -> box -> getXML();
		$xml .= $this -> text -> getXML();
		return $xml;
	}

	public function setX($x = 0) {
		$this -> text -> setX(($this -> width / 2) + $x);
		$this -> box -> setX($x);
	}

	public function setY($y = 0) {
		$this -> text -> setY(($this -> height / 2) + $y);
		$this -> box -> setY($y);
	}

	public function getText() {
		return ($this -> text -> getText());
	}

	public function info() {
		printf("TextBox. Text:%s, Height: %s, Width: %s, X: %d, Y: %d\n", $this -> text -> getText(), $this -> height, $this -> width, $this -> x, $this -> y);
	}

}
?>