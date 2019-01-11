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
class svgImage extends svgObject {
	private $path;

	public function __construct($width, $height, $path) {
		parent::__construct($width, $height);
		$this -> path = $path;
	}

	public function setPath($path) {
		$this -> path = $path;
	}

	public function addLink($link) {
		$this -> link = $link;
	}

	public function getXML() {
		$xml = '<image x="' . $this -> x . '" y="' . $this -> y . '" width="' . $this -> width . '" height="' . $this -> height . '"
     xlink:href="' . $this -> path . '" ' . $this -> attr . '/>';
		return ($xml);
	}

}
?>