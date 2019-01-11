<?php
abstract class svgObject {
	protected $width;
	protected $height;
	protected $x;
	protected $y;
	protected $clase;
	protected $id;
	protected $attr;
	protected $attr_temp;
	protected $traslate;
	protected $rotate;

	function __construct($width, $height) {
		$this -> clase = array();
		$this -> id = "bpmn";
		$this -> width = $width;
		$this -> height = $height;
		$this -> attr = "";
		$this -> attr_temp = "";
		$this -> translate;
		$this -> rotate;
	}

	public function info() {
		printf("Objeto. Alto: %s, Ancho: %s, X: %d, Y: %d\n", $this -> height, $this -> width, $this -> x, $this -> y);
	}

	abstract function getXML();

	public function setX($x = 0) {
		$this -> x = $x;
	}

	public function setY($y = 0) {
		$this -> y = $y;
	}

	public function addClass($class) {
		array_push($this -> clase, $class);
		$this -> setAttr();
	}

	public function addId($id) {
		$this -> id = ' id="' . $id . '"';
		$this -> setAttr();
	}

	public function addAttr($name, $val) {
		$this -> attr_temp = $name . '="' . $val . '"';
	}

	public function setAttr() {
		$this -> attr = ' class="' . implode(" ", $this -> clase) . '" ' . $this -> id;
		if ($this -> translate != '' || $this -> rotate != '') {
			$this -> attr .= ' transform="' . $this -> translate . ' ' . $this -> rotate . '"';
		}
		$this -> attr .= " " . $this -> attr_temp;
	}

	public function rotate($degress, $rx = 0, $ry = 0) {
		//$rx,$ry es la posicion desde donde se debe rotar la figura
		$this -> rotate = ' rotate(' . $degress . ', ' . $rx . ',' . $ry . ') ';
		$this -> setAttr();
	}

	public function translate($x, $y) {
		$this -> translate = ' translate(' . $x . ',' . $y . ')';
		$this -> setAttr();
	}

}
?>