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
include_once ($ruta_db_superior . "class.funcionarios.php");

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

//$condicion_ad = " and " . DHtmlXtreeExpedienteFunc::expedientes_asignados($conn);
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
$idfuncionario = usuario_actual("idfuncionario");
$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
$lista_entidades = implode(",", $datos_admin_funcionario["identidad_serie"]);
// TERMINA DEFAULT

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
    header("Content-type: application/xhtml+xml");
} else {
    header("Content-type: text/xml");
}

$arbol = new DHtmlXtreeExpedienteFunc($conn, $condicion_ad, $idexpediente, $seleccionados,$lista_entidades);
echo $arbol->generarXml($id);

class DHtmlXtreeExpedienteFunc {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $idexpediente;
    private $lista_entidades;

    public function __construct($conn, $condicion_ad, $idexpediente, $seleccionados,$lista_entidades) {
        $this->conn = $conn;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->idexpediente = $idexpediente;
		$this->lista_entidades = $lista_entidades;
    }

    public function generarXml($id = 0) {
        $this->objetoXML = new XMLWriter();
        $this->objetoXML->openMemory();
        $this->objetoXML->setIndent(true);
        $this->objetoXML->setIndentString("\t");
        $this->objetoXML->startDocument('1.0', 'utf-8');
        $this->objetoXML->startElement("tree");
        $this->objetoXML->writeAttribute("id", 0);
        $this->llena_expediente($id);
        $this->objetoXML->endElement();
        $this->objetoXML->endDocument();
        $cadenaXML = trim($this->objetoXML->outputMemory());
        return $cadenaXML;
    }

    private function llena_expediente($id) {
        if($this->idexpediente) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre", "entidad_expediente ee
                join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.idexpediente=" . $this->idexpediente, "nombre ASC", $this->conn);
        } else if ($id == 0) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee
            join expediente e on ee.expediente_idexpediente = e.idexpediente", "(cod_padre=0 or cod_padre is null) and e.fk_entidad_serie in (497)", "nombre ASC", $this->conn);
        } else {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee
                join expediente e on ee.expediente_idexpediente = e.idexpediente", "cod_padre=" . $id ." and e.fk_entidad_serie in (497)","nombre ASC", $this->conn);
        }

        //print_r($papas);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $agrupador = $papas[$i]["agrupador"];
                if($agrupador){
					 continue;
                }
				$cerrado=false;
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
                if ($papas[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                    $cerrado=true;
                }

                $hijos = busca_filtro_tabla("count(1) as cant", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.cod_padre=" . $papas[$i]["idexpediente"] . $this->condicion_ad, "", $this->conn);
                $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["serie_idserie"], "", $this->conn);

                // print_r($hijos);

                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;font-weight:bold");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $papas[$i]["idexpediente"] . "#");
                $this->objetoXML->writeAttribute("nocheckbox", 1);
                if (($hijos[0]["cant"] || $tipo_docu[0]["cant"]) && !$cerrado) {
                    $this->objetoXML->writeAttribute("child", 1);
                } else {
                    $this->objetoXML->writeAttribute("child", 0);
                }
                if ($hijos[0]["cant"] && !$cerrado) {
                    $this->llena_expediente($papas[$i]["idexpediente"]);
                }
				if (!$cerrado) {
                $this->llena_subserie($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
				}
                $this->objetoXML->endElement();
            }
        }
    }

    private function llena_subserie($id, $idexp) {
        $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso",
            "vpermiso_serie",
            "tipo in (2,3) and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"], "nombre ASC", $this->conn);

        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $permisos = array();
                $tiene_permisos = false;
                $tiene_permiso_lectura = false;

                if(!empty($papas[$i]["permiso"])) {
                    $permisos = explode(",", $papas[$i]["permiso"]);
                    $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
                    $tiene_permiso_lectura = count($permisos) == 1 && in_array("l", $permisos);
                }
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if (!$tiene_permisos || $tiene_permiso_lectura) {
                    $text .= " - (Sin permiso)";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", "{$papas[$i]["idserie"]}.{$idexp}");

                if ($papas[$i]["estado"] == 0 || !$tiene_permisos) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                } else {
                    $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["idserie"], "", $this->conn);
                    if ($tipo_docu[0]["cant"]) {
                        $this->objetoXML->writeAttribute("nocheckbox", 0);
                        $this->objetoXML->writeAttribute("child", 1);
                        $this->llena_tipo_documental($papas[$i]["idserie"], $idexp);
                    } else if($papas[$i]["tipo"]==3){
                    		/* USERDATA */
				                $this->objetoXML->startElement("userdata");
				                $this->objetoXML->writeAttribute("name", "idexpediente");
				                $this->objetoXML->text($idexp);
				                $this->objetoXML->endElement();
				
				                $this->objetoXML->startElement("userdata");
				                $this->objetoXML->writeAttribute("name", "idserie");
				                $this->objetoXML->text($papas[$i]["idserie"]);
				                $this->objetoXML->endElement();
			                /* FIN USERDATA */
                    	}
                    	else {
                        $this->objetoXML->writeAttribute("child", 0);
                    }
                }

                $this->objetoXML->endElement();
            }
        }
    }

    private function llena_tipo_documental($id, $idexp) {
        $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso",
            "vpermiso_serie",
            "tipo=3 and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"], "nombre ASC", $this->conn);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $permisos = array();
                $tiene_permisos = false;
                $tiene_permiso_lectura = false;

                if(!empty($papas[$i]["permiso"])) {
                    $permisos = explode(",", $papas[$i]["permiso"]);
                    $tiene_permisos = in_array("a", $permisos) || in_array("v", $permisos);
                    $tiene_permiso_lectura = count($permisos) == 1 && in_array("l", $permisos);
                }
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo"] . ")";
                if ($papas[$i]["estado"] == 0) {
                    $text .= " - INACTIVO";
                }
                if (!$tiene_permisos || $tiene_permiso_lectura) {
                    $text .= " - (Sin permiso)";
                }
                $this->objetoXML->startElement("item");
                $this->objetoXML->writeAttribute("style", "font-family:verdana; font-size:7pt;");
                $this->objetoXML->writeAttribute("text", $text);
                $this->objetoXML->writeAttribute("id", $papas[$i]["idserie"] . "." . $idexp);
                if ($papas[$i]["estado"] == 0 || !$tiene_permisos) {
                    $this->objetoXML->writeAttribute("nocheckbox", 1);
                }

                if (in_array($papas[$i]["idserie"], $this->seleccionados) !== false) {
                    $this->objetoXML->writeAttribute("checked", 1);
                }
                $this->objetoXML->writeAttribute("child", 0);

                /* USERDATA */
                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idexpediente");
                $this->objetoXML->text($idexp);
                $this->objetoXML->endElement();

                $this->objetoXML->startElement("userdata");
                $this->objetoXML->writeAttribute("name", "idserie");
                $this->objetoXML->text($papas[$i]["idserie"]);
                $this->objetoXML->endElement();
                /* FIN USERDATA */

                $this->objetoXML->endElement();
            }
        }
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