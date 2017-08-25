<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . 'db.php');

class CalendarCol {
	private $year;
	// Constantes para el calculo de la pascua. Se toman para el rango 1900-2099
	private $M = 24, $N = 5;
	private $festivosFijos = array();
	private $festivosLunes = array();
	private $timezone;

	private function init($year, $tz = "America/Bogota") {
		global $conn;

		$this->timezone = new DateTimeZone($tz);
		$fecha = new DateTime("2000-01-01", $this->timezone);

		// Festivos Fijos
		$festivos_fijos = busca_filtro_tabla("valor", "configuracion", "tipo='festivos' AND nombre='festivos_fijos'", "", $conn);
		$vector_festivos_fijos = array();
		if ($festivos_fijos['numcampos']) {
			$vector_festivos_fijos = explode(',', $festivos_fijos[0]['valor']);
		}
		for($i = 0; $i < count($vector_festivos_fijos); $i++) {
			array_push($this->festivosFijos, new DateTime("$year-" . $vector_festivos_fijos[$i]));
		}

		// Festivos Lunes
		$festivos_lunes = busca_filtro_tabla("valor", "configuracion", "tipo='festivos' AND nombre='festivos_lunes'", "", $conn);
		$vector_festivos_lunes = array();
		if ($festivos_lunes['numcampos']) {
			$vector_festivos_lunes = explode(',', $festivos_lunes[0]['valor']);
		}
		for($i = 0; $i < count($vector_festivos_lunes); $i++) {
			array_push($this->festivosLunes, new DateTime("$year-" . $vector_festivos_lunes[$i]));
		}
	}

	function __construct($year) {
		$this->year = $year;
		$this->init($year);
	}

	private function obtenerSiguienteLunes($fechaOrig) {
		// Copiar la fecha original
		$fecha = new DateTime($fechaOrig->format('Y-m-d'), $this->timezone);
		// $fecha->setDate($fechaOrig->getTime());
		// Si es lunes devolver la fecha recibida
		if (date('w', $fecha->getTimestamp()) === '1') {
			return $fecha;
		}
		for($i = 1; $i < 7; $i++) {
			$fecha->add(new DateInterval('P1D'));
			// System.out.println("Siguiente lunes: "+sdf.format(fecha.getTime()));
			if (date('w', $fecha->getTimestamp()) === '1') {
				return $fecha;
			}
		}
		return false;
	}

	private function calcularMN() {
		if ($this->year >= 1583 && $this->year <= 1699) {
			$this->M = 22;
			$this->N = 2;
		}
		if ($this->year >= 1700 && $this->year <= 1799) {
			$this->M = 23;
			$this->N = 3;
		}
		if ($this->year >= 1800 && $this->year <= 1899) {
			$this->M = 23;
			$this->N = 4;
		}
		if ($this->year >= 1900 && $this->year <= 2099) {
			$this->M = 24;
			$this->N = 5;
		}
		if ($this->year >= 2100 && $this->year <= 2199) {
			$this->M = 24;
			$this->N = 6;
		}
		if ($this->year >= 2200 && $this->year <= 2299) {
			$this->M = 25;
			$this->N = 0;
		}
	}

	public function calcularPascua() {
		// calcular las constantes M y N. Solo es necesario si la fecha no esta entre 1900-2099
		// calcularMN();
		$pascua = new DateTime();
		$abril26 = new DateTime();
		$abril26->setDate($this->year, 4, 26);
		$abril25 = new DateTime();
		$abril26->setDate($this->year, 4, 25);
		$pascua->setDate($this->year, 1, 1);
		$this->calcularMN();
		$a = $this->year % 19;
		$b = $this->year % 4;
		$c = $this->year % 7;
		$d = (19 * $a + $this->M) % 30;
		$e = (2 * $b + 4 * $c + 6 * $d + $this->N) % 7;
		// Si d + e < 10, entonces la Pascua caerá en el día (d + e + 22) de marzo
		if (($d + $e) < 10) {
			$dia = $d + $e + 22;
			$pascua->setDate($this->year, 3, $dia);
		} else { // En caso contrario (d + e > 9), caerá en el día (d + e − 9) de abril
			$dia = $d + $e - 9;
			$pascua->setDate($this->year, 4, $dia);
		}
		// Existen dos excepciones a tener en cuenta:
		// Si la fecha obtenida es el 26 de abril, entonces la Pascua caerá en el 19 de abril.
		if ($abril26 == $pascua) {
			$pascua->setDate($pascua->format('Y'), $pascua->format('m'), 19);
		} else if ($abril25 == $pascua && $d == 28 && $e == 6 && $a > 10) { // Si la fecha obtenida es el 25 de abril, con d = 28, e = 6 y a > 10, entonces la Pascua caerá en el 18 de abril.
			$pascua->setDate($pascua->format('Y'), $pascua->format('m'), 18);
		}

		return $pascua;
	}

	public function getFestivosLunes() {
		if ($this->year < 1984) {
			return $this->festivosLunes;
		}
		$festivos = array();
		foreach ( $this->festivosLunes as $f ) {
			array_push($festivos, $this->obtenerSiguienteLunes($f));
		}
		return $festivos;
	}

	public function getFestivosPascua() {
		$festivos = array();
		$pascua = $this->calcularPascua();
		// Copiar la fecha original
		$juevesSanto = new DateTime($pascua->format('Y-m-d'));
		// juevesSanto.setTime(pascua.getTime());
		$juevesSanto->sub(new DateInterval('P3D'));

		array_push($festivos, $juevesSanto);
		$viernesSanto = new DateTime($pascua->format('Y-m-d'));
		// $viernesSanto.setTime(pascua.getTime());
		$viernesSanto->sub(new DateInterval('P2D'));
		array_push($festivos, $viernesSanto);
		// Pascua+ 43 séptimo lunes Ascensión de Jesús
		$ascencion = new DateTime($pascua->format('Y-m-d'));
		// ascencion.setTime(pascua.getTime());
		$ascencion->add(new DateInterval('P43D'));
		array_push($festivos, $ascencion);

		// Pascua+ 64 décimo lunes Corpus Christi
		$corpus = new DateTime($pascua->format('Y-m-d'));
		// corpus.setTime(pascua.getTime());
		$corpus->add(new DateInterval('P64D'));
		array_push($festivos, $corpus);

		// Pascua+ 71 undécimo lunes Sagrado Corazón de Jesús
		$corazon = new DateTime($pascua->format('Y-m-d'));
		// corazon.setTime(pascua.getTime());
		$corazon->add(new DateInterval('P71D'));
		array_push($festivos, $corazon);

		return $festivos;
	}

	public function getFestivosFijos() {
		return $this->festivosFijos;
	}

	public function esDiaNoHabil() {
		global $conn;

		$dias_no_habiles = busca_filtro_tabla("valor", "configuracion", "tipo='festivos' AND nombre='dias_no_habiles'", "", $conn);
		$vector_dias_no_habiles = explode(',', $dias_no_habiles[0]['valor']);
		$vector_dias_no_habiles_int = array();
		$vector_config = array(
				'l' => 1,
				'm' => 2,
				'x' => 3,
				'j' => 4,
				'v' => 5,
				's' => 6,
				'd' => 7
		); // dias de las semana segun php date('N', strtotime($needle)
		for($i = 0; $i < count($vector_dias_no_habiles); $i++) {
			$vector_dias_no_habiles_int[] = $vector_config[$vector_dias_no_habiles[$i]];
		}
		return ($vector_dias_no_habiles_int);
	}

	public function esFestivo($fecha) {
		$needle = new DateTime($fecha);

		if (in_array(intval(date('N', strtotime($fecha))), $this->esDiaNoHabil())) {
			return true;
		}
		if (in_array($needle, $this->getfestivosFijos())) {
			return true;
		}
		if (in_array($needle, $this->getFestivosLunes())) {
			return true;
		}
		if (in_array($needle, $this->getFestivosPascua())) {
			return true;
		}
		return false;
	}

	public static function obtener_festivos_anio($year) {
		$instance = new self($year);
		$festivos = array();
		$festivos = array_merge($festivos, $instance->getfestivosFijos());
		$festivos = array_merge($festivos, $instance->getFestivosLunes());
		$festivos = array_merge($festivos, $instance->getFestivosPascua());
		return $festivos;

	}
}
?>