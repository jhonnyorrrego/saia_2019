<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;
  }

  $ruta .= "../";
  $max_salida--;
}
include_once $ruta_db_superior . 'controllers/autoload.php';

global $conn;
$id = $_REQUEST["id"];
$seleccionado = [];

if (isset($_REQUEST["seleccionado"])) {
  $seleccionado = explode(",", $_REQUEST["seleccionado"]);
}

if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
  header("Content-type: application/xhtml+xml");
} else {
  header("Content-type: text/xml");
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">";
echo "<tree id=\"0\">\n";  

//si paso la entidad, para que marque las series relacionadas
if (isset($_REQUEST["entidad"],$_REQUEST["llave_entidad"]) && $_REQUEST["entidad"] && $_REQUEST["llave_entidad"]) {
  if ($_REQUEST["entidad"] == "funcionario") {
    $asignados = busca_filtro_tabla("distinct modulo_idmodulo", "permiso", "funcionario_idfuncionario=" . $_REQUEST["llave_entidad"], "", $conn);
    $seleccionado = extrae_campo($asignados, "modulo_idmodulo", "U");
  } else {
    $asignados = busca_filtro_tabla("distinct modulo_idmodulo", "permiso_perfil", "perfil_idperfil=" . $_REQUEST["llave_entidad"], "", $conn);
    $seleccionado = extrae_campo($asignados, "modulo_idmodulo", "U");
  }
}

if ($id) {
  $inicio = busca_filtro_tabla("*", 'modulo', "idmodulo={$id}", "", $conn);
  echo "<item style=\"font-family:verdana; font-size:7pt;\" ";
  echo "text=\"" . $inicio[0]["nombre"] . "(" . $inicio[0]["codigo"] . ") \" id=\"" . $inicio[0]["id$tabla"] . "\" checked=\"1\" >\n";
  llena_serie($id);
  echo "</item>\n";
} else {
  llena_serie("NULL");
}
echo "</tree>\n";

function llena_serie($id){
  global $conn, $seleccionado;

  if (intval($id)) {
    $papas = busca_filtro_tabla("*", "modulo", "cod_padre={$id}", "etiqueta ASC", $conn);
  } else {
    $papas = busca_filtro_tabla("*", "modulo", "cod_padre IS NULL OR cod_padre=0", "etiqueta ASC", $conn);
  }

  if ($papas["numcampos"]) {
    for ($i = 0; $i < $papas["numcampos"]; $i++) {
      echo "<item style=\"font-family:verdana; font-size:7pt;\" ";
      echo "text=\"" . htmlspecialchars($papas[$i]["etiqueta"]) . " (" . $papas[$i]["nombre"] . ") \" ";
      echo " id=\"" . $papas[$i]["idmodulo"] . "\"";

      if (in_array($papas[$i]["idmodulo"], $seleccionado)) {
        echo " checked=\"1\" ";
      }
      echo " >\n";
      llena_serie($papas[$i]["idmodulo"]);
      echo "</item>\n";
    }
  }
  return true;
}
?>