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
include_once($ruta_db_superior . "db.php");
$id_x = @$_REQUEST["id"];

$idcategoria = null;

if (isset($_REQUEST["idcategoria_formato"])) {
    $idcategoria = $_REQUEST["idcategoria_formato"];
}

$tipo = '';
if (isset($_REQUEST["tipo"])) {
    $tipo = $_REQUEST["tipo"];
}
$seleccionados = array();
if ($_REQUEST["seleccionados"]) {
    $seleccionados = explode(",", $_REQUEST["seleccionados"]);
}

if ($seleccionados) {
    $id_x = buscar_papa($seleccionados);

}

function buscar_papa($idcategoriaFormato)
{
    if (is_array($idcategoriaFormato) !== false) {
        $idcategoriaFormato = implode(",", $idcategoriaFormato);
    }
    $exit = $exit + 1;
    if ($exit > 20) {
        return false;
    }
    $categoriaFormato = busca_filtro_tabla("", "categoria_formato", "idcategoria_formato in(" . $idcategoriaFormato . ") and cod_padre<>0", "", $conn);
    if ($categoriaFormato["numcampos"] > 0 && $categoriaFormato[0]["cod_padre"] > 0) {
        $padre = busca_filtro_tabla("", "categoria_formato", "idcategoria_formato=" . $categoriaFormato[0]["cod_padre"], "", $conn);
        $id_padre = buscar_papa($padre[0]["idcategoria_formato"]);
        return $id_padre;
    } else {
        return $idcategoriaFormato;
    }
}
$objetoJson = [
    "key" => 0
];

$seleccionable = null;
if (isset($_REQUEST["seleccionable"])) {
    $seleccionable = $_REQUEST["seleccionable"];
    if ($seleccionable == "checkbox") {
        $seleccionable = 1;
    } else {
        $seleccionable = "radio";
    }
}

$objetoJson = llena_formato(0, 0, '', $seleccionados, $seleccionable);


header('Content-Type: application/json');

echo json_encode($objetoJson);

function llena_formato($id, $nivel = 0, $cod_padre, $seleccionados = null, $seleccionable = null)
{
    global $conn;

    /*if ($tipo != 1) {
        $where = " AND estado=1 ";
    }*/
    if (empty($id)) {
        $papas = busca_filtro_tabla("*", "categoria_formato", "(cod_padre=0 OR cod_padre is null)" . $where, "", $conn);

    } else if ($cod_padre != '') {
        $papas = busca_filtro_tabla("*", "categoria_formato", "cod_padre='" . $cod_padre . "'" . $where, "", $conn);
    } else {
        $papas = busca_filtro_tabla("*", "categoria_formato", "cod_padre=" . $id . $where, "", $conn);
    }


    if (isset($_REQUEST['seleccionados'])) {
        $seleccionados = explode(",",$_REQUEST['seleccionados']);
        
    }

    $resp = array();
    if ($papas["numcampos"]) {
        for ($i = 0; $i < $papas["numcampos"]; $i++) {
            $hijos = busca_filtro_tabla("count(*) total", "categoria_formato", "cod_padre=" . $papas[$i]["idcategoria_formato"], "", $conn);
            $item = [
                "extraClasses" => "estilo-arbol kenlace_saia"
            ];
            $item["expanded"] = true;
            if ($_REQUEST['tipo'] != 1) {
                $item["title"] = $papas[$i]["nombre"];
                $item["key"] = "-1";
            } else {
                $estado = '';
                if ($papas[$i]["estado"] == 1) {
                    $estado = ' (Activo)';
                } else if ($papas[$i]["estado"] == 2) {
                    $estado = ' (Inactivo)';
                }

                $concatenar_padre = '';
                if ($papas[$i]["cod_padre"]) {
                    $concatenar_padre = ',' . $papas[$i]["cod_padre"];
                }
                $item["title"] = html_entity_decode($papas[$i]["nombre"]);
                $item["key"] = $papas[$i]["idcategoria_formato"];
                $item["data"] = array(
                    'estado' => $estado
                );
                for ($j=0; $j <count($seleccionados) ; $j++) { 
                    if($papas[$i]["idcategoria_formato"] == $seleccionados[$j]){
                        $item["selected"] = true;
                    }
                }
                
            }
          
            if ($hijos[0]["total"]) {
                $children = llena_formato($papas[$i]["idcategoria_formato"], $nivel++, '', $seleccionados, $seleccionable);
                if ($children) {
                    $item["children"] = $children;
                }
            } else if ($seleccionable) {
                $item["checkbox"] = $seleccionable;
            }
            $resp[] = $item;
        }
    }

    return $resp;
}
?>
