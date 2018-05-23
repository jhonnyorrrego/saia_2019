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
class svgCanvas extends svgObject {
	private $xml = '<svg  id="svgElem" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  xmlns:drag="http://www.codedread.com/dragsvg" width="%d" height="%d" %s>';

	public function __construct($width, $height, $aditional_text = "") {
		$this -> xml = sprintf($this -> xml, $width, $height, $aditional_text);
		$this -> xml .= '%s</svg>';
	}

	public function finishCanvas() {

	}

	public function setXML($xml) {
		$this -> xml = sprintf($this -> xml, $xml);
	}

	public function getXML() {
		return sprintf($this -> xml);
	}

}
?>