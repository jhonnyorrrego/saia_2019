<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");

ini_set("display_errors", 1);
// sort($paths);

$padre = 0;
$solo_carpetas = 0;
if (@$_REQUEST["solo_carpetas"]) {
    $solo_carpetas = $_REQUEST["solo_carpetas"];
}

$lista = new DHtmlXtreeFileList($ignorar, $solo_carpetas);
$resp = array(
    "key" => 0,
    "children" => $lista->dirToArray($padre)
);

header('Content-Type: application/json');

echo json_encode($resp);

class DHtmlXtreeFileList {

    private $patron_ignorar;

    private $solo_carpetas;

    public function __construct($patron_ignorar, $solo_carpetas = 0) {
        $this->patron_ignorar = $patron_ignorar;
        $this->solo_carpetas = $solo_carpetas;
    }

    // $path = trim($path, '/');
    public function dirToArray($padre, $nivel = 0) {
        $contents = array();
        // Foreach node in $dir

        if ($padre == "NULL" || $padre == 0) {
            $lista = busca_filtro_tabla("iddependencia,cod_padre,nombre", "dependencia", "(cod_padre IS NULL OR cod_padre=0) AND estado=1", "", $conn);
        } else {
            $lista = busca_filtro_tabla("iddependencia,cod_padre,nombre", "dependencia", "estado=1 AND cod_padre=" . $padre, "nombre ASC", $conn);
            // print_r($lista);die();
        }

        // $lista = array_diff($lista, $this->patron_ignorar);
        if ($lista["numcampos"]) {
            for ($i = 0; $i < $lista["numcampos"]; $i++) {
                // Check if it's a node or a folder
                // if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
                // if($info->isDir()) {
                $node_id = array(
                    "key" => $lista[$i]["iddependencia"],
                    "title" => $lista[$i]["nombre"],
                    "folder" => "true"
                );
                // Add directory recursively, be sure to pass a valid path
                // to the function, not just the folder's name
                $hijos = $this->dirToArray($lista[$i]["iddependencia"], $nivel + 1);
                // if(!empty($hijos)) {
                // $id_item = $info->getPathname();
                // $id_item = str_replace("//", "/", str_replace("../", "", $info->getPathname()));
                // $userdata = array('myurl' =>"", 'name_url' => $info->getFileName(), 'realpath' => $id_item);

                // $node_id["data"] = $userdata;


                $funcs = $this->llena_funcionarios($lista[$i]["iddependencia"]);
                if(!empty($funcs)) {
                    $merge = array_merge($hijos, $funcs);
                } else {
                    $merge = $hijos;
                }

                $node_id["children"] = $merge;

                $contents[] = $node_id;

                // }
                /*
                 * } else if(!empty( $node)){
                 * if($this->solo_carpetas == 1) {
                 * continue;
                 * }
                 * // Add node, the keys will be updated automatically
                 * $id_item = str_replace("//", "/", str_replace("../", "", $info->getPathname()));
                 * $id_item = preg_replace("#^/#", "", $id_item);
                 * $userdata = array('myurl' => $id_item, 'myextension' => $info->getExtension(), 'realpath' => $id_item, 'name_url' => $info->getFileName());
                 * $node_id = array("key" => $id_item, "title" => $info->getFileName());
                 * $node_id["data"] = $userdata;
                 * $contents[] = $node_id;
                 * }
                 */
            }
        }
        return $contents;
    }

    private function llena_funcionarios($codigo, $tipo_llenado = "") {
        $ingreso = 0;

        $func = "";
        // GROUP BY funcionario_codigo
        $where_usuarios = "C.tipo_cargo=1 AND B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario  AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 and C.estado=1 AND B.dependencia_iddependencia=" . $codigo;
        // Tipo de LLenado =1 es para los funcionarios
        if ($tipo_llenado == 2 && !empty($dependencias_flujo)) {
            if (!in_array($codigo, $dependencias_flujo)) {
                // return("");
                // print_r($dependencias_flujo);
                $where_usuarios .= " AND dependencia_iddependencia IN(" . implode(",", $dependencias_flujo) . ")";
                $ingreso = 1;
            }
            $ingreso = 1;
        } elseif (!empty($funcionarios_flujo) && $tipo_llenado == 1) {
            $where_usuarios .= " AND funcionario_codigo IN(" . implode(",", $funcionarios_flujo) . ")";
            $ingreso = 1;
        } elseif (!empty($cargos_flujo) && $tipo_llenado == 4) {
            $where_usuarios .= " AND cargo_idcargo IN(" . implode(",", $cargos_flujo) . ")";
            $ingreso = 1;
        }

        if (($tipo_llenado && $ingreso) || $verifica_flujo == 0) {
            if (count($excluidos)) {
                $where_usuarios .= " AND idfuncionario NOT IN (" . implode(",", $excluidos) . ")";
            }
            $usuarios = busca_filtro_tabla("distinct B.iddependencia_cargo,A.login,A.funcionario_codigo,UPPER(A.nombres) AS nombres_ord,UPPER(A.apellidos) AS apellidos,A.sistema,C.nombre AS cargo", "funcionario A,dependencia_cargo B, cargo C", $where_usuarios, "nombres_ord ASC", $conn);
        } else
            return ("");
        // print_r($usuarios);
        $tipo_id = "funcionario_codigo";
        $resp = array();
        if ($tipo_arbol == 'rol')
            $tipo_id = "iddependencia_cargo";
        for ($j = 0; $j < $usuarios["numcampos"]; $j++) {
            $sistema = "";
            if ($usuarios[$j]["sistema"] == 0)
                $sistema = "(Sin SAIA)";
            $valor = in_array($usuarios[$j][$tipo_id], $seleccionados);
            // alerta($valor);

            $node_id = array();

            $userdata = array(
                'ruta' => ""
            );

            if ($usuarios[$j]["nombres_ord"]) {
                $node_id = array(
                    "key" => $usuarios[$j][$tipo_id],
                    "title" => ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombres_ord"] . " " . $usuarios[$j]["apellidos"])))) . "-" . codifica_encabezado(html_entity_decode(formato_cargo(strtolower($usuarios[$j]["cargo"])))) . "  $sistema",
                    "checkbox" => true,
                );
            } else {
                $node_id = array(
                    "key" => $usuarios[$j]["funcionario_codigo"],
                    "title" => codifica_encabezado(html_entity_decode($usuarios[$j]["login"])),
                    "checkbox" => true,
                );
            }
            //$node_id["data"] = $userdata;
            $resp[] = $node_id;
        }
        return $resp;
    }
}
?>
