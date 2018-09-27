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
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

$objetoJson = array(
    "key" => 0
);
$id = 0;
if ($_GET["id"]) {
    $id = $_GET["id"];
}

$condicion_ad = '';
$idexpediente = 0;

// DEFAULT DATOS
$estado_archivo= false;
if (@$_REQUEST['estado_archivo']) {
    $estado_archivo = true;
    $condicion_ad .= " AND (e.estado_archivo IN(" . $_REQUEST['estado_archivo'] . "))";
}

$estado_cierre = false;
if (@$_REQUEST['estado_cierre']) {
    $estado_cierre = true;
    $condicion_ad .= " AND (e.estado_cierre IN(" . $_REQUEST['estado_cierre'] . "))";
}

$condicion_ad = " and " . DHtmlXtreeExpedienteFunc::expedientes_asignados($conn);
if (isset($_REQUEST["excluidos_exp"])) {
    $condicion_ad .= " and idexpediente not in (" . $_REQUEST["excluidos_exp"] . ")";
} else if (isset($_REQUEST["incluir_series"]) && !($estado_cierre || $estado_archivo)) {
    $condicion_ad .= " and e.serie_idserie  in (" . $_REQUEST["incluir_series"] . ")";
}

if (isset($_REQUEST["idexpediente"])) {
    $condicion_ad .= " and e.idexpediente = " . $_REQUEST["idexpediente"];
    $idexpediente = $_REQUEST["idexpediente"];
}

$seleccionados = array();
if (isset($_REQUEST["seleccionados"])) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}
if (isset($_REQUEST["checkbox"])) {
	$checkbox = $_REQUEST["checkbox"];
}
// TERMINA DEFAULT

header('Content-Type: application/json');

$arbol = new DHtmlXtreeExpedienteFunc($conn, $condicion_ad, $idexpediente, $seleccionados,$checkbox);
echo json_encode($arbol->generarXml($id));

class DHtmlXtreeExpedienteFunc {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $idexpediente;
	private $checkbox;
	
    public function __construct($conn, $condicion_ad, $idexpediente, $seleccionados, $checkbox) {
        $this->conn = $conn;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->idexpediente = $idexpediente;
        $this->checkbox = $checkbox;
    }

    public function generarXml($id = 0) {
       
        //$this->llena_expediente($id);
        //$cadenaXML = trim($this->objetoXML->outputMemory());
        //print($this->llena_expediente($id));
        return $this->llena_expediente($id);
    }

    private function llena_expediente($id) {
    	$objetoJson = array();
        if($this->idexpediente) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "entidad_expediente ee
                join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.idexpediente=" . $this->idexpediente, "nombre ASC", $this->conn);
        } else if ($id == 0) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "entidad_expediente ee
            join expediente e on ee.expediente_idexpediente = e.idexpediente", "(cod_padre=0 or cod_padre is null)" . $this->condicion_ad, "nombre ASC", $this->conn);
        } else {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "entidad_expediente ee
                join expediente e on ee.expediente_idexpediente = e.idexpediente", "cod_padre=" . $id . $this->condicion_ad, "nombre ASC", $this->conn);
        }

        //print_r($papas);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $exp = busca_filtro_tabla("", "expediente", "idexpediente = " . $papas[$i]["idexpediente"], "", $this->conn);
                $agrupador = 0;
                if($exp["numcampos"]) {
                    $agrupador = $exp[0]["agrupador"];
                }
				$cerrado=false;
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
                if ($papas[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                    $cerrado=true;
                }

                $hijos = busca_filtro_tabla("count(1) as cant", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.cod_padre=" . $papas[$i]["idexpediente"] . $this->condicion_ad, "", $this->conn);
                $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["serie_idserie"], "", $this->conn);

                // print_r($tipo_docu);

               $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"]= $papas[$i]["idexpediente"] . "#";
				              
                //$this->objetoXML->writeAttribute("nocheckbox", 1);
                if (($hijos[0]["cant"] || $tipo_docu[0]["cant"]) && !$cerrado) {
                   // $this->objetoXML->writeAttribute("child", 1);
                   $item["folder"] = 1;
				   		   
                } else {
                    ///$this->objetoXML->writeAttribute("child", 0);
                    $item["folder"] = 0;
                }
				$hijos_exp = array();
				$hijos_sub = array();
                if ($hijos[0]["cant"] && !$cerrado) {
                    $hijos_exp = $this->llena_expediente($papas[$i]["idexpediente"]);
                }
				if (!$cerrado) {
               	  $hijos_sub = $this->llena_subserie($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
				}
				$item["children"]= array_merge($hijos_exp,$hijos_sub);
                $objetoJson[] = $item;
            }
        }
		return $this->objetoXML=$objetoJson;
    }

    private function llena_subserie($id, $idexp) {
    	$objetoJson = array();
        $papas = busca_filtro_tabla("", "serie", "tipo in (2,3) and tvd=0 and cod_padre=" . $id, "nombre ASC", $this->conn);
		//print_r($papas["sql"]);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $permiso = busca_filtro_tabla("count(*) as cant", "vpermiso_serie", "idfuncionario=" . $_SESSION["idfuncionario"] . " and idserie=" . $papas[$i]["idserie"], "", $this->conn);
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if ($permiso[0]["cant"] == 0) {
                    $text .= " - (Sin permiso)";
                }
                $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"]= "{$papas[$i]["idserie"]}.{$idexp}";
				if ($papas[$i]["tipo"] == 3) {
					$item["checkbox"]=$this->checkbox;
				}
				//$item["checkbox"]=$this->checkbox;			
                if ($papas[$i]["estado"] == 0 || $permiso[0]["cant"] == 0) {
                    //$this->objetoXML->writeAttribute("nocheckbox", 1);
                    $item["folder"] = 1;
                } else {
                    $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["idserie"], "", $this->conn);
                    if ($tipo_docu[0]["cant"]) {
                        //$this->objetoXML->writeAttribute("nocheckbox", 0);
                        //$this->objetoXML->writeAttribute("child", 1);
                        $item["folder"] = 1;						
                        $item["children"] = $this->llena_tipo_documental($papas[$i]["idserie"], $idexp);
                    } else {
                        //$this->objetoXML->writeAttribute("child", 0);
                        $item["folder"] = 0;
                    }
                }

                $objetoJson[] = $item;
            }
        }
        return $this->objetoXML=$objetoJson;
    }

    private function llena_tipo_documental($id, $idexp) {
        $objetoJson = array();
        $papas = busca_filtro_tabla("", "serie", "tipo=3 and tvd=0 and cod_padre=" . $id, "nombre ASC", $this->conn);		
		//print_r($papas["sql"]);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $permiso = busca_filtro_tabla("count(*) as cant", "vpermiso_serie", "idfuncionario=" . $_SESSION["idfuncionario"] . " and idserie=" . $papas[$i]["idserie"], "", $this->conn);
				
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if ($permiso[0]["cant"] == 0) {
                    $text .= " - (Sin permiso)";
                }
                $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"] = $papas[$i]["idserie"] . "." . $idexp;
				$item["checkbox"]=$this->checkbox;				
                if ($papas[$i]["estado"] == 0 || $permiso[0]["cant"] == 0) {
                   // $this->objetoXML->writeAttribute("nocheckbox", 1);
                   $item["folder"] = 1;
                }

                if (in_array($papas[$i]["idserie"], $this->seleccionados) !== false) {
                    //$this->objetoXML->writeAttribute("checked", 1);
                    $item["selected"]=true;
                }
               // $this->objetoXML->writeAttribute("child", 0);               
              // $item["folder"] = 1;

                /* USERDATA */
                /*$this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idexpediente");
                $this->objetoXML->text($idexp);
                $this->objetoXML->endElement();

                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idserie");
                $this->objetoXML->text($papas[$i]["idserie"]);
                $this->objetoXML->endElement();*/
                $item["data"]=array();
				$item["data"]=array("idexpediente"=>$idexp,				
				"idserie"=>$papas[$i]["idserie"]);
                /* FIN USERDATA */

                //$this->objetoXML->endElement();
                $objetoJson[] = $item;
            }
        }
		return $this->objetoXML=$objetoJson;
    }

    public static function expedientes_asignados($conn) {
        // return "1=1";
        $idfunc_actual = usuario_actual('idfuncionario');

        $llaves_exp = array(
            $idfunc_actual
        );

        $roles = busca_filtro_tabla("dependencia_iddependencia,cargo_idcargo", "dependencia_cargo a", "a.estado='1' and a.funcionario_idfuncionario=" . $idfunc_actual, "", $conn);
        $dependencias = extrae_campo($roles, "dependencia_iddependencia");
        $cargos = extrae_campo($roles, "cargo_idcargo");

        $llaves_exp = array_merge($llaves_exp, $dependencias);
        $llaves_exp = array_merge($llaves_exp, $cargos);

        $cadena = "ee.entidad_identidad IN (1, 2, 4) AND ee.llave_entidad IN ('" . implode("','", $llaves_exp) . "')";

        return ($cadena);
    }
}
?>