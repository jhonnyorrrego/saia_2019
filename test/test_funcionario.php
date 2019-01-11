<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

class DHtmlXtreeRoles {
	private $id = 0;
	private $objetoXML;
	private $campo = "iddependencia_cargo";
	private $condicion_dep = "";
	private $condicion_vfun = "";
	private $sin_padre = false;
	private $seleccionados = array();
	private $idfun_nucleo = array();
	private $cargar_partes = 0;
	private $uid = 0;

	public function __construct($id) {
		$this -> id = $id;
		$func_nucleo = busca_filtro_tabla("idfuncionario", "funcionario", "pertenece_nucleo=1", "", $conn);
		if ($func_nucleo["numcampos"]) {
			$this -> idfun_nucleo = extrae_campo($func_nucleo, "idfuncionario");
		}
	}

	public function configura_datos_request($datos) {
		if (isset($datos["idcampofun"])) {
			$this -> campo = $datos["idcampofun"];
		}
		if (isset($datos["cargar_partes"])) {
			$this -> cargar_partes = $datos["cargar_partes"];
		}
		if (isset($datos["uid"])) {
			$this -> uid = $datos["uid"];
		}

		$condicion_dep = "";
		if (isset($datos["excluidos_dep"])) {
			$condicion_dep .= " and iddependencia not in (" . $datos["excluidos_dep"] . ")";
		}
		if (isset($datos["estado_dep"])) {
			$condicion_dep .= " and estado=" . $datos["estado_dep"];
		}
		$this -> condicion_dep = $condicion_dep;

		$condicion_vfun = "";
		if (isset($datos["excluidos_car"])) {
			$condicion_vfun .= " and idcargo not in (" . $datos["excluidos_car"] . ")";
		}

		if (isset($datos["excluidos_idfunc"])) {
			$idfunExcluidos = explode(",", $datos["excluidos_idfunc"]);
			if (count($this -> idfun_nucleo)) {
				$func_excl = array_merge($idfunExcluidos, $this -> idfun_nucleo);
			} else {
				$func_excl = $idfunExcluidos;
			}
			$condicion_vfun .= " and idfuncionario not in (" . implode(",", $func_excl) . ")";
		} elseif (count($this -> idfun_nucleo)) {
			$condicion_vfun .= " and idfuncionario not in (" . implode(",", $this -> idfun_nucleo) . ")";
		}

		if (isset($datos["excluidos_rol"])) {
			$condicion_vfun .= " and iddependencia_cargo not in (" . $datos["excluidos_rol"] . ")";
		}
		$this -> condicion_vfun = $condicion_vfun;

		if (isset($datos["seleccionados"])) {
			$this -> seleccionados = explode(",", $datos["seleccionados"]);
		}

		if (isset($datos["sin_padre"])) {
			$this -> sin_padre = true;
		}
	}

	public function generarXml() {
		$this -> objetoXML = new XMLWriter();
		$this -> objetoXML -> openMemory();
		$this -> objetoXML -> setIndent(true);
		$this -> objetoXML -> setIndentString("\t");
		$this -> objetoXML -> startDocument('1.0', 'utf-8');
		$this -> objetoXML -> startElement("tree");
		$this -> objetoXML -> writeAttribute("id", $this -> id);

		$this -> id = str_replace("#", "", $this -> id);

		$this -> llena_dependencia($this -> id);
		if ($this -> cargar_partes && $this -> uid) {
			$this -> llena_funcionario($this -> id);
		}

		$this -> objetoXML -> endElement();
		$this -> objetoXML -> endDocument();
		$cadenaXML = trim($this -> objetoXML -> outputMemory());
		return $cadenaXML;
	}

	private function llena_dependencia($id) {
		global $conn;
		if ($id == 0) {
			$papas = busca_filtro_tabla("", "dependencia", "(cod_padre=0 or cod_padre is null)" . $this -> condicion_dep, "nombre ASC", $conn);
		} else {
			$papas = busca_filtro_tabla("", "dependencia", "cod_padre=" . $id . $this -> condicion_dep, "nombre ASC", $conn);
		}
		if ($papas["numcampos"]) {
			for ($i = 0; $i < $papas["numcampos"]; $i++) {
				$text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
				if ($papas[$i]["estado"] == 0) {
					$text .= " - INACTIVO";
				}
				$this -> objetoXML -> startElement("item");
				$this -> objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
				$this -> objetoXML -> writeAttribute("text", $text);
				$this -> objetoXML -> writeAttribute("id", $papas[$i]["iddependencia"] . "#");
				if ($this -> sin_padre) {
					$this -> objetoXML -> writeAttribute("nocheckbox", 1);
				}

				$hijos = busca_filtro_tabla("count(*) as cant", "dependencia", "cod_padre=" . $papas[$i]["iddependencia"] . $this -> condicion_dep, "", $conn);
				$cant_func = busca_filtro_tabla("count(*) as cant", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $papas[$i]["iddependencia"] . $this -> condicion_vfun, "", $conn);

				if ($hijos[0]["cant"] || $cant_func[0]["cant"]) {
					$this -> objetoXML -> writeAttribute("child", 1);
				} else {
					$this -> objetoXML -> writeAttribute("child", 0);
				}

				if (!$this -> cargar_partes && $hijos[0]["cant"]) {
					$this -> llena_dependencia($papas[$i]["iddependencia"]);
				}

				/*FUNCIONARIO*/
				if (!$this -> cargar_partes && $cant_func[0]["cant"]) {
					$this -> llena_funcionario($papas[$i]["iddependencia"]);
				}
				/*TERMINA FUNCIONARIO*/
				$this -> objetoXML -> endElement();
			}
		}
	}

	private function llena_funcionario($iddep) {
		global $conn;
		$papas = busca_filtro_tabla("iddependencia_cargo,idfuncionario,funcionario_codigo,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia=" . $iddep . $this -> condicion_vfun, "", $conn);
		if ($papas["numcampos"]) {
			for ($i = 0; $i < $papas["numcampos"]; $i++) {
				$text = $papas[$i]["nombres"] . " " . $papas[$i]["apellidos"] . " - " . $papas[$i]["cargo"];
				$this -> objetoXML -> startElement("item");
				$this -> objetoXML -> writeAttribute("style", "font-family:verdana; font-size:7pt;");
				$this -> objetoXML -> writeAttribute("text", $text);
				$this -> objetoXML -> writeAttribute("id", $papas[$i][$this -> campo]);
				if (in_array($papas[$i][$this -> campo], $this -> seleccionados) !== false) {
					$this -> objetoXML -> writeAttribute("checked", 1);
				}
				$this -> objetoXML -> writeAttribute("child", 0);
				$this -> objetoXML -> endElement();

				/*USERDATA*/
				$this -> objetoXML -> startElement("userdata");
				$this -> objetoXML -> writeAttribute("name", "idfuncionario");
				$this -> objetoXML -> text($papas[$i]["idfuncionario"]);
				$this -> objetoXML -> endElement();

				$this -> objetoXML -> startElement("userdata");
				$this -> objetoXML -> writeAttribute("name", "funcionario_codigo");
				$this -> objetoXML -> text($papas[$i]["funcionario_codigo"]);
				$this -> objetoXML -> endElement();

				$this -> objetoXML -> startElement("userdata");
				$this -> objetoXML -> writeAttribute("name", "iddependencia");
				$this -> objetoXML -> text($papas[$i]["iddependencia"]);
				$this -> objetoXML -> endElement();
				/*TERMINA USERDATA*/

			}
		}
	}

}

$id = 0;
if ($_GET["id"]) {
	$id = $_GET["id"];
}

$classRoles = new DHtmlXtreeRoles($id);
$classRoles -> configura_datos_request($_REQUEST);
$cadenaXML = $classRoles -> generarXml();

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
	header("Content-type: application/xhtml+xml");
} else {
	header("Content-type: text/xml");
}
echo $cadenaXML;
?>