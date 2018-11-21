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

$objetoJson = array(
    "key" => 0
);
$id = 0;
/*if ($_GET["id"]) {
    $id = $_GET["id"];
}*/
$partes=false;
if(isset($_REQUEST["cargar_partes"]) && $_REQUEST["cargar_partes"]==1){
	$partes = true;
}
if($partes && $_REQUEST["id"]){
	//$datos = explode(".",$_REQUEST["id"]);	//id[0] idserie id[1] idexp
	//$id=$datos[1];
	$id=$_REQUEST["id"];
		
}
$condicion_ad = '';
$idexpediente = 0;

// DEFAULT DATOS
$estado_archivo = false;
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
//$condicion_ad = " and " . expedientes_asignados($conn);
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

if (isset($_REQUEST["agrupador"])) {
    $agrupador = $_REQUEST["agrupador"];
}
if (isset($_REQUEST["serie_idserie"])) {
    $serie_idserie = $_REQUEST["serie_idserie"];
}
$idfuncionario = usuario_actual("idfuncionario");
$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
$lista_entidades = implode(",", $datos_admin_funcionario["identidad_serie"]);

if(!$id){
$arbol=llena_expediente($id,$idexpediente,$lista_entidades,$condicion_ad,$partes);
}
elseif($id && $agrupador==1){
	$arbol=llena_expediente($id,0,$lista_entidades,$condicion_ad,$partes);
}
else{
	if($agrupador==0 && $serie_idserie){
		$arbol_exp=llena_expediente($id,0,$lista_entidades,$condicion_ad,$partes);
		$arbol_serie=llena_subserie($serie_idserie,$id);
		$arbol = array_merge($arbol_exp,$arbol_serie);
	}
}

// TERMINA DEFAULT

header('Content-Type: application/json');

//$arbol = new DHtmlXtreeExpedienteFunc($conn, $condicion_ad, $idexpediente, $seleccionados, $checkbox,$lista_entidades,$partes);
//echo json_encode($arbol->generarXml($id));
echo json_encode($arbol);

/*class DHtmlXtreeExpedienteFunc {

    private $objetoXML;
    private $conn;
    private $condicion_ad;
    private $seleccionados;
    private $idexpediente;
	private $checkbox;
	private $lista_entidades;
	private $partes;

    public function __construct($conn, $condicion_ad, $idexpediente, $seleccionados, $checkbox,$lista_entidades,$partes) {
        $this->conn = $conn;
        $this->condicion_ad = $condicion_ad;
        $this->seleccionados = $seleccionados;
        $this->idexpediente = $idexpediente;
        $this->checkbox = $checkbox;
		$this->lista_entidades = $lista_entidades;
		$this->partes = $partes;
    }

    public function generarXml($id = 0) {

        //$this->llena_expediente($id);
        //$cadenaXML = trim($this->objetoXML->outputMemory());
        //print($this->llena_expediente($id));
        return $this->llena_expediente($id);
    }*/

    /*private */function llena_expediente($id,$idexpediente,$lista_entidades,$condicion_ad,$partes) {
    	global $conn;
    	$objetoJson = array();
		//$id = explode(".",$id);
		//print_r($id);
        //if($this->idexpediente) {
        if($idexpediente) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee
                join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.idexpediente=" . $idexpediente, "nombre ASC", $conn);
        } else if ($id == 0) {
            $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee
            join expediente e on ee.expediente_idexpediente = e.idexpediente", "(cod_padre=0 or cod_padre is null) and e.fk_entidad_serie in (" . $lista_entidades .")", "nombre ASC", $conn);
        } else {
                $papas = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "cod_padre=" . $id . " and e.fk_entidad_serie in (" . $lista_entidades .")", "nombre ASC", $conn);
        }
		//print_r($papas["sql"]);
        if ($papas["numcampos"]) {
            for ($i = 0; $i < $papas["numcampos"]; $i++) {
                $cerrado=false;
                $text = $papas[$i]["nombre"] . " (" . $papas[$i]["codigo_numero"] . ")";
                if ($papas[$i]["estado_cierre"] == 2) {
                    $text .= " - CERRADO";
                    $cerrado=true;
                }

                $hijos = busca_filtro_tabla("count(1) as cant", "entidad_expediente ee join expediente e on ee.expediente_idexpediente = e.idexpediente", "e.cod_padre=" . $papas[$i]["idexpediente"] . $condicion_ad, "", $conn);
                $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["serie_idserie"], "", $conn);
               // print_r($tipo_docu);
               $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"]= $papas[$i]["idexpediente"];

                //$this->objetoXML->writeAttribute("nocheckbox", 1);
                $item["data"] = array(
					"idexpediente" => $papas[$i]["idexpediente"],
					"serie_idserie" => $papas[$i]["serie_idserie"],
					"agrupador" => $papas[$i]["agrupador"]
			    );
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
                    $hijos_exp = llena_expediente($papas[$i]["idexpediente"],$idexpediente,$lista_entidades,$condicion_ad,$partes);
                }
				if(!$partes){
					//if (!$cerrado) {
						//!$this->partes=false;
	               	  $hijos_sub = llena_subserie($papas[$i]["serie_idserie"], $papas[$i]["idexpediente"]);
					//}
					$item["children"]= array_merge($hijos_exp,$hijos_sub);
				}
				else{
					$item["folder"] = 1;
					$item["lazy"] = true;
				}
                $objetoJson[] = $item;
            }
        }
		//return $this->objetoXML=$objetoJson;
		return $objetoJson;
    }

    /*private*/ function llena_subserie($id, $idexp) {
    	global $conn,$checkbox;
    	$objetoJson = array();
        $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso",
            "vpermiso_serie",
            "tipo in (2,3) and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"], "nombre ASC", $conn);
		
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

                $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            $item["title"] = $text;
				$item["key"]= "{$papas[$i]["idserie"]}.{$idexp}";
				if ($papas[$i]["tipo"] == 3 && $tiene_permisos) {
					$item["checkbox"]=$checkbox;
				}
				//$item["checkbox"]=$this->checkbox;
				//if(!$partes){
					if ($papas[$i]["estado"] == 0 || !$tiene_permisos) {
	                    //$this->objetoXML->writeAttribute("nocheckbox", 1);
	                    $item["folder"] = 1;
	                } else {
	                    $tipo_docu = busca_filtro_tabla("count(1) as cant", "serie", "tipo=3 and tvd=0 and cod_padre=" . $papas[$i]["idserie"], "", $conn);
	                    if ($tipo_docu[0]["cant"]) {
	                        //$this->objetoXML->writeAttribute("nocheckbox", 0);
	                        //$this->objetoXML->writeAttribute("child", 1);
	                        $item["folder"] = 1;
	                        $item["children"] = llena_tipo_documental($papas[$i]["idserie"], $idexp);
	                    } else {
	                        //$this->objetoXML->writeAttribute("child", 0);
	                        $item["folder"] = 0;
	                    }
	                }
				/*}
				else{
					$item["lazy"] = true;
				}*/

                $objetoJson[] = $item;
            }
        }
       // return $this->objetoXML = $objetoJson;
       return $objetoJson;
    }

    /*private */function llena_tipo_documental($id, $idexp) {
        global $conn,$checkbox;
        $objetoJson = array();

        $papas = busca_filtro_tabla("distinct idserie, nombre_serie nombre, codigo, tipo, estado_serie estado, permiso",
            "vpermiso_serie",
            "tipo=3 and tvd=0 and cod_padre=" . $id . " and idfuncionario = " . $_SESSION["idfuncionario"], "nombre ASC", $conn);
		//print_r($papas["sql"]);
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
                
                $item = array();
				$item["extraClasses"] = "estilo-dependencia";
	            
				$item["key"] = $papas[$i]["idserie"] . "." . $idexp;
				if (!$tiene_permisos || $tiene_permiso_lectura) {
                    $text .= " - (Sin permiso)";
                }
				else{
					$item["checkbox"]=$checkbox;
				}
				$item["title"] = $text;
				if ($papas[$i]["estado"] == 0 || !$tiene_permisos) {
                   // $this->objetoXML->writeAttribute("nocheckbox", 1);
                   $item["folder"] = 1;
                }

                /*if (in_array($papas[$i]["idserie"], $seleccionados) !== false) {
                    //$this->objetoXML->writeAttribute("checked", 1);
                    $item["selected"]=true;
                }/*
               // /$this->objetoXML->writeAttribute("child", 0);
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
		//return $this->objetoXML=$objetoJson;
		return $objetoJson;
    }
?>