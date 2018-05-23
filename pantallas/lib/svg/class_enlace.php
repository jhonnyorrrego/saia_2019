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

class svgPath extends svgObject {
	private $colorStroke = "000";
	private $widthStroke = 1;
	private $type = "L";
	private $points = array();

	public function __construct() {
		parent::__construct(0, 0);
	}

	public function getXML() {
		foreach ($this->points AS $point) {
			$text_points .= $point["x"] . "," . $point["y"] . " ";
		}
		$xml = '<path d="M' . $text_points . '"
      style="stroke: #' . $this -> colorStroke . '; stroke-width:' . $this -> widthStroke . 'px; fill: none;
           //marker-start: url(#markerCircle);
           //marker-mid: url(#markerCircle);
           marker-end: url(#markerArrow);"/>';

		/*'<rect x="'.$this->x.'" y="'.$this->y.'" width="'.$this->width.'" height="'.$this->height.'" style="fill:rgb('.$this->colorFill.');stroke-width:'.$this->widthStroke.';stroke:rgb('.$this->colorStroke.')" rx="10" ry=10 />';*/
		return ($xml);
	}

	public function setPoints($points) {
		$this -> points = $points;
	}

	private function rgbString($red, $green, $blue) {
		return sprintf("%d%d%d", $red, $green, $blue);
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
		printf("Rectangle. Height: %s, Width: %s, X: %d, Y: %d\n", $this -> height, $this -> width, $this -> x, $this -> y);
	}

}
?>