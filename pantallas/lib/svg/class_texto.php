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

class svgText extends svgObject {

	private $colorFill = "0,0,0";
	private $textAnchor = "center";
	private $text = "Void";

	private $fontFamily = "serif";
	private $fontStyle = "normal";
	private $fontWeight = "normal";
	private $fontSize = 10;

	public function __construct($text) {
		$this -> text = $text;
	}

	public function getXML() {
		$xml = '<text x="%d" y="%d" fill="rgb(%s)" text-anchor="%s"';
		$xml = sprintf($xml, $this -> x, $this -> y, $this -> colorFill, $this -> textAnchor);
		$xml .= 'font-family="%s" font-style="%s" font-weight="%s" font-size="%d"';
		$xml = sprintf($xml, $this -> fontFamily, $this -> fontStyle, $this -> fontWeight, $this -> fontSize);
		$xml .= '>%s</text>';
		$xml = sprintf($xml, $this -> text);
		return $xml;
	}

	private function rgbString($red, $green, $blue) {
		return sprintf("%d,%d,%d", $red, $green, $blue);
	}

	public function setColorFill($red, $green, $blue) {
		$this -> colorFill = $this -> rgbString($red, $green, $blue);
	}

	public function setText($text) {
		$this -> text = $text;
	}

	public function setTextAnchor($anchor) {
		$this -> textAnchor = $anchor;
	}

	public function setFont($fontFamily = null, $fontStyle = null, $fontWeight = null, $fontSize = null) {
		if ($fontFamily != null) {
			$this -> fontFamily = $fontFamily;
		}

		if ($fontStyle != null) {
			$this -> fontStyle = $fontStyle;
		}
		if ($fontWeight != null) {
			$this -> fontWeight = $fontWeight;
		}
		if ($fontSize != null) {
			$this -> fontSize = $fontSize;
		}

	}

	public function info() {
		printf("Text. Text: %s\n", $this -> getText());
	}

	public function getText() {
		return $this -> text;
	}

}
?>