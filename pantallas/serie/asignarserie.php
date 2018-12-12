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
//include_once ($ruta_db_superior . "header.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
$retorno= array("exito" =>0, "mensaje" => "Error al ", "accion" => $_REQUEST["accion"]);

if ($_REQUEST["opt"] == 1 && $_REQUEST["serie_idserie"]){//&& $_REQUEST["iddependencia"]) {
        // VINCULACION DE DEPENDENCIAS VS SERIES
    $iddependencia = array();
    if ($_REQUEST["iddependencia"]) {
        $iddependencia = array_unique(explode(",", $_REQUEST["iddependencia"]));
    }
    // $dependencias = array_unique(explode(",", $_REQUEST["iddependencia"]));
    $serie_idserie = $_REQUEST["serie_idserie"];
    // if ($_REQUEST["accion"] == "eliminar") {
    if ($_REQUEST["accion"] == "eliminar") {
        $cond_iddependencia = "";
        if(!empty($iddependencia)) {
            //$cond_iddependencia = " and serie_idserie not in (" . implode(",", $idseries) . ")";
            $cond_iddependencia = " and llave_entidad not in (" . implode(",", $iddependencia) . ")";
        }
        //$delete = "UPDATE entidad_serie SET estado=0 WHERE llave_entidad = $dependencias $cond_iddependencia";
        $delete = "UPDATE entidad_serie SET estado=0 WHERE serie_idserie = $serie_idserie $cond_iddependencia";
        phpmkr_query($delete) or die("Error al eliminar la vinculacion de la serie con la dependencia: $delete");
        // $retorno=0;
        $retorno["exito"] = 1;
        $retorno["mensaje"] = "Se ha retirado el permiso a la serie";
        //$retorno["expandir"] = $dependencias . ".0.0";
    } else {
        /*$cons_serie = busca_filtro_tabla("cod_arbol", "serie", "idserie in (" . implode(",", $idseries) . ")", "", $conn);
        if ($cons_serie["numcampos"]) {
            $cod_arboles = array();
            for ($i = 0; $i < $cons_serie["numcampos"]; $i++) {
                $cod_arboles = array_merge($cod_arboles, explode(".", $cons_serie[$i]["cod_arbol"]));
            }
            $ids = array_filter(array_unique($cod_arboles));

            $temp_dep = $dependencias;*/
            foreach ($iddependencia as $iddep) {
                // $exis = busca_filtro_tabla("llave_entidad", "entidad_serie", "estado=1 and serie_idserie=" . $idserie . " and llave_entidad in (" . implode(",", $temp_dep) . ")", "", $conn);
                $exis = busca_filtro_tabla("serie_idserie", "entidad_serie", "llave_entidad=" . $iddep . " and serie_idserie =" . $serie_idserie, "", $conn);
                if (!$exis["numcampos"]) {
                    $insert = "INSERT INTO entidad_serie (entidad_identidad,serie_idserie,llave_entidad,estado,fecha) VALUES (2," . $serie_idserie . "," . $iddep . ",1," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
                    
                    phpmkr_query($insert) or die("Error al guardar la informacion: $insert");
                } else {
                    $update = "UPDATE entidad_serie SET estado=1 WHERE entidad_identidad=2 and serie_idserie=" . $serie_idserie . " and llave_entidad=" . $iddep;
                    phpmkr_query($update) or die("Error al guardar la vinculacion de la serie con la dependencia: $update");
                }
            }
            $retorno["exito"] = 1;
            $retorno["mensaje"] = "Se ha adicionado el permiso a la serie";
           // $retorno["expandir"] = $temp_dep . ".0.0";
        //}
    }
  
    header('Content-Type: application/json');
	echo (json_encode($retorno));
}

if ($_REQUEST["opt"] == 2 && $_REQUEST["tipo_entidad"] && $_REQUEST["serie_idserie"]) {
    // PERMISOS DE SERIES VS (CARGO,DEPENDENCIA,FUNCIONARIO)
    $series = array_unique(explode(",", $_REQUEST["serie_idserie"]));
    $entidad = array_unique(explode(",", $_REQUEST["identidad"]));
    $entidad_identidad = $_REQUEST["tipo_entidad"];

    switch ($entidad_identidad) {
        case '1':
            // funcionario
            $idfuncionarios = array();
            foreach ($entidad as $rol) {
                if (strpos($rol, "#") === false) {
                    $func = busca_filtro_tabla("idfuncionario", "vfuncionario_dc", "iddependencia_cargo=" . $rol, "", $conn);
                    if ($func["numcampos"]) {
                        $idfuncionarios[] = $func[0]["idfuncionario"];
                    }
                }
            }
            $idllave_entidad = array_unique($idfuncionarios);
            break;
        case '2': // dependencia
        case '4': // cargo
            $idllave_entidad = $entidad;
            break;
    }
    if ($_REQUEST["accion"] == "eliminar") {
        foreach ($series as $idserie) {
            foreach ($idllave_entidad as $id) {
                $delete = "UPDATE permiso_serie SET estado=0 WHERE entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $idserie . " and llave_entidad=" . $id;
                phpmkr_query($delete) or die("Error al eliminar el permiso");
                $cod_padre = busca_filtro_tabla("cod_padre", "serie", "idserie=" . $idserie, "", $conn);
                if ($cod_padre["numcampos"] && $cod_padre[0]["cod_padre"] != "" && $cod_padre[0]["cod_padre"] != 0) {
                    $padre = busca_filtro_tabla("p.idpermiso_serie", "permiso_serie p,serie s", "p.serie_idserie=s.idserie and p.estado=1 and p.entidad_identidad=" . $entidad_identidad . " and p.llave_entidad=" . $id . " and s.cod_padre=" . $cod_padre[0]["cod_padre"], "", $conn);
                    if ($padre["numcampos"] == 0) {
                        $delete = "UPDATE permiso_serie SET estado=0 WHERE entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $cod_padre[0]["cod_padre"] . " and llave_entidad=" . $id;
                        phpmkr_query($delete) or die("Error al eliminar el permiso. n2");
                    } else { // NO APLICA PARA OTRAS CATEGORIAS YA QUE PUEDEN MANEJAR MAS DE 3 NIVELES
                        $subserie = busca_filtro_tabla("s.idserie", "permiso_serie p,serie s", "p.serie_idserie=s.idserie and p.estado=1 and s.tipo=2 and p.entidad_identidad=" . $entidad_identidad . " and p.llave_entidad=" . $id . " and s.cod_padre=" . $cod_padre[0]["cod_padre"], "", $conn);
                        if ($subserie["numcampos"]) {
                            $borrar = 1;
                            for ($i = 0; $i < $subserie["numcampos"]; $i++) {
                                $tipo = busca_filtro_tabla("s.idserie", "permiso_serie p,serie s", "p.serie_idserie=s.idserie and p.estado=1 and s.tipo=3 and p.entidad_identidad=" . $entidad_identidad . " and p.llave_entidad=" . $id . " and s.cod_padre=" . $subserie[$i]["idserie"], "", $conn);
                                if ($tipo["numcampos"]) {
                                    $borrar = 0;
                                    break;
                                }
                            }
                            if ($borrar) {
                                $delete = "UPDATE permiso_serie SET estado=0 WHERE entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $cod_padre[0]["cod_padre"] . " and llave_entidad=" . $id;
                                phpmkr_query($delete) or die("Error al eliminar el permiso. n3");
                            }
                        }
                    }
                }
            }
        }
    } else {
        $cons_serie = busca_filtro_tabla("cod_arbol", "serie", "idserie in (" . implode(",", $series) . ")", "", $conn);
        if ($cons_serie["numcampos"]) {
            $cod_arboles = array();
            for ($i = 0; $i < $cons_serie["numcampos"]; $i++) {
                $cod_arboles = array_merge($cod_arboles, explode(".", $cons_serie[$i]["cod_arbol"]));
            }
            $ids = array_unique($cod_arboles);
            foreach ($ids as $idserie) {
                $array_temp = $idllave_entidad;
                $exis = busca_filtro_tabla("llave_entidad", "permiso_serie", "estado=1 and entidad_identidad=" . $entidad_identidad . " and serie_idserie=" . $idserie . " and llave_entidad in (" . implode(",", $array_temp) . ")", "", $conn);
                if ($exis["numcampos"]) {
                    $ids_insert = extrae_campo($exis, "llave_entidad");
                    $array_temp = array_diff($array_temp, $ids_insert);
                }
                foreach ($array_temp as $id) {
                    $insert = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado) VALUES (" . $entidad_identidad . "," . $idserie . "," . $id . ",1)";
                    phpmkr_query($insert) or die("Error al guardar la informacion");
                }
            }
        }
    }
    notificaciones("Datos actualizados!", "success", 5000);
    abrir_url("permiso_serie.php", "_self");
    die();
	include_once ($ruta_db_superior . "footer.php");
}
?>