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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "class.funcionarios.php");

$idfuncionario = $_SESSION["idfuncionario"];

$campo_llave = "idserie";
if (@$_REQUEST['campo_llave']) {
    $campo_llave = @$_REQUEST['campo_llave'];
}

$campo = "";
if (isset($_REQUEST['campo'])) {
    $campo = $_REQUEST['campo'];
}

if (isset($_REQUEST['valor'])) {
    $datos = busca_filtro_tabla("nombre_serie,idserie,identidad_serie,cod_padre", "vpermiso_serie", "tipo=3 and idfuncionario = " . $idfuncionario . " and permiso = 'l,a,v' and estado_serie=1 and tvd=0 and categoria=2 and lower(nombre_serie) like '%" . strtolower(htmlentities($_REQUEST['valor'])) . "%'", "nombre_serie ASC", $conn);
    $html = "<ul style='font-size:12pt'>";
    if ($datos['numcampos']) {
        for ($i = 0; $i < $datos['numcampos']; $i++) {
            //$archivo=array(1=>"Gesti&oacute;n",2=>"Central",3=>"Hist&oacute;rico");
            $nombre_subserie = "";
            $nombre_serie = "";
            $subserie = busca_filtro_tabla("nombre, idserie, cod_padre, codigo", "serie", "idserie=" . $datos[$i]['cod_padre'], "", $conn);
            if ($subserie["numcampos"]) {
                $nombre_subserie = $subserie[0]['nombre'] . "-(" . $subserie[0]['codigo'] . ")";
                $serie = busca_filtro_tabla("nombre, codigo", "serie", "idserie=" . $subserie[0]['cod_padre'], "", $conn);
                if ($serie["numcampos"]) {
                    $nombre_serie = $serie[0]['nombre'] . "-(" . $serie[0]['codigo'] . ")";
                }
            }
            $cadena_serie = $nombre_serie . "-" . $nombre_subserie;
            $dependencia = busca_filtro_tabla("d.nombre", "entidad_serie es, dependencia d", "es.llave_entidad = d.iddependencia and es.identidad_serie=" . $datos[$i]['identidad_serie'], "", $conn);
            if ($dependencia["numcampos"]) {
                $nombre_dependencia = $dependencia[0]["nombre"];
            }
            $etiqueta = $nombre_dependencia . "-" . $cadena_serie . "-<b>" . $datos[$i]['nombre_serie'] . "</b>";
            $html .= "<li onclick=\"cargar_datos('" . $datos[$i][$campo_llave] . "','" . ucfirst($datos[$i]['nombre_serie']) . "','$campo')\">" . ucfirst($etiqueta) . "</li>";
        }
    } else {
        $html .= "<li onclick=\"cargar_datos(0)\">No hay coincidencias</li>";
    }
    $html .= "</ul>";
    echo $html;
}
?>