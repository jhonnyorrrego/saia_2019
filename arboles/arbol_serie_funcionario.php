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

/**
 * NO se deben agregar campos a la vista si esta repite el mismo funcionario o serie eje: permiso_serie
 * si esta una serie activa y otra inactiva saldra dos veces en el arbol
 * preguntar a Andres agudelo antes de cambiar la vista (vpermiso_serie)
 */

// DEFAULT DATOS
$objetoJson = array(
    "key" => 0
);
$tipo = array(
    1 => 0,
    2 => 0,
    3 => 1
);
if (isset($_REQUEST["tipo1"])) {
    $tipo[1] = $_REQUEST["tipo1"];
}
if (isset($_REQUEST["tipo2"])) {
    $tipo[2] = $_REQUEST["tipo2"];
}

if (isset($_REQUEST["tipo3"])) {
    $tipo[3] = $_REQUEST["tipo3"];
}

$condicion_ad = " and idfuncionario=" . $_SESSION["idfuncionario"];
if (isset($_REQUEST["categoria"])) {
    $condicion_ad .= " and categoria=" . $_REQUEST["categoria"];
} else {
    $condicion_ad .= " and categoria=2";
}
if (isset($_REQUEST["tvd"])) {
    $condicion_ad .= " and tvd=" . $_REQUEST["tvd"];
} else {
    $condicion_ad .= " and tvd=0";
}
if (isset($_REQUEST["estado_serie"])) {
    $condicion_ad .= " and estado_serie=" . $_REQUEST["estado_serie"];
}
if (isset($_REQUEST["excluidos"])) {
    $condicion_ad .= " and idserie not in (" . $_REQUEST["excluidos"] . ")";
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}

if (isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
}
// TERMINA DEFAULT

$id = 0;
$incluir_padre = false;

/*if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

if($id < 0) {
    $id = 0;
}*/
/*if (isset($_REQUEST["id"])) {
	
	$objetoJson["key"] = $_REQUEST["id"];	
	$id =  $_REQUEST["id"];
    if ($id[0] == 0) {
        $hijos_dep = llena_serie($id[0]);
        if (!empty($hijos_dep)) {
            $hijos[] = $hijos_dep;
        }
    }	
	$objetoJson["children"] = $hijos;
}
else{
    $objetoJson["key"] = 0;
    $hijos_dep = llena_serie(0); // TRD
    if (!empty($hijos_dep)) {
        $hijos = $hijos_dep;
    }
    $objetoJson["children"] = $hijos;
}*/

if(isset($_REQUEST["mostrar_padre"]) && $_REQUEST["mostrar_padre"] == "1") {
    $incluir_padre = true;
}

header('Content-Type: application/json');

$arbol = new DHtmlXtreeSeries($conn, $tipo, $condicion_ad, $seleccionados, $incluir_padre,$checkbox);
echo  json_encode($arbol->generarXml($id));

class DHtmlXtreeSeries {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $incluir_padre;
	private $checkbox;
    private $tipo = array(
        1 => 0,
        2 => 0,
        3 => 1
    );

    public function __construct($conn, $tipo, $condicion_ad, $seleccionados, $incluir_padre=false,$checkbox) {
        $this->conn = $conn;
        $this->tipo = $tipo;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->incluir_padre = $incluir_padre;
		$this->checkbox = $checkbox;
    }

    public function generarXml($id=0) {
      //  $this->llena_serie($id);
      
       return $this->llena_serie($id);
	   
        //return $cadenaXML;
    }

    private function llena_serie($id) {
    	$objetoJson = array();
        if ($id == 0) {
            $papas = busca_filtro_tabla("", "vpermiso_serie", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre_serie ASC", $this->conn);
			$this->incluir_padre = false;
        } else if($this->incluir_padre) {
        	$papas = busca_filtro_tabla("", "vpermiso_serie", "idserie=" . $id . $this->condicion_ad, "nombre_serie ASC", $this->conn);
            $this->incluir_padre = false;
        } else {
            $papas = busca_filtro_tabla("", "vpermiso_serie", "cod_padre=" . $id . $this->condicion_ad, "nombre_serie ASC", $this->conn);
        }
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $text = $papas[$i]["nombre_serie"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado_serie"] == 0) {
                    $text .= " - INACTIVO";
                }
				$item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"]= $papas[$i]["idserie"];
				$item["checkbox"]=$this->checkbox;
				//print_r($this->tipo[$papas[$i]["tipo"]]);
                if ($this->tipo[$papas[$i]["tipo"]] == 0 ||$papas[$i]["estado_serie"] == 0) {
                    
                    $item["checkbox"]= false;
                }
                if (in_array($papas[$i]["idserie"], $this->seleccionados) !== false) {
                    $item["selected"]=true;
                }
                $hijos = busca_filtro_tabla("count(*) as cant", "vpermiso_serie", "cod_padre=" . $papas[$i]["idserie"] . $this->condicion_ad, "", $this->conn);
                if ($hijos[0]["cant"]) {
                    $item["children"] = $this->llena_serie($papas[$i]["idserie"]);
                } else {
                    $item["folder"] = 1;
                }

                /* USERDATA */				
				$item["data"]=array();
				$item["data"]=array("nombre_serie"=>$papas[$i]["nombre_serie"],				
				"codigo"=>$papas[$i]["codigo"],
				"entidad_identidad"=>$papas[$i]["entidad_identidad"]);
                /* FIN USERDATA */
				$objetoJson[] = $item;
				//print_r($item);
            }
        }
		return $this->objetoXML=$objetoJson;
    }
}
?>