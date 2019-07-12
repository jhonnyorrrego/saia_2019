<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}


include_once $ruta_db_superior . 'core/autoload.php';

/*
 * Busca todos los datos relacionados con un funcionario particular
 * como los cargos, las dependencias, las series, los permisos a modulos
 */
/* Esta Funcion esta casi lista */
function busca_datos_administrativos_funcionario($funcionario, $filtrar = array()) {
    global $conn, $sql;
    $serie_f = array();
    $serie_c = array();
    $serie_d = array();

    if (!$funcionario) {
        $funcionario = usuario_actual("idfuncionario");
    }

    // consulta dependencia
    $dependencia = busca_filtro_tabla("B.*", "dependencia_cargo A, dependencia B", "A.dependencia_iddependencia=B.iddependencia AND A.funcionario_idfuncionario=$funcionario AND B.estado=1 AND A.estado=1", "", $conn);

    // consulta cargo
    $cargo = busca_filtro_tabla("B.*", "dependencia_cargo A, cargo B", "A.cargo_idcargo=B.idcargo AND A.funcionario_idfuncionario=$funcionario AND A.estado=1", "", $conn);

    // consulta modulos
    $modulo = busca_filtro_tabla("A.idpermiso,B.*", "permiso A, modulo B", "A.modulo_idmodulo=B.idmodulo AND A.funcionario_idfuncionario=$funcionario", "", $conn);

    // consulta rol
    $rol = busca_filtro_tabla("A.*", "dependencia_cargo A", "A.funcionario_idfuncionario=$funcionario AND A.estado=1", "", $conn);

    // extraccion
    $cargos = extrae_campo($cargo, "idcargo", "U");
    $dependencias = extrae_campo($dependencia, "iddependencia", "U");
    $modulos = extrae_campo($modulo, "idpermiso", "U");
    $roles = extrae_campo($rol, "iddependencia_cargo", "U");
	//$permisos = " AND A.permiso like '%a,v'";
	
	$ids= array();
	$lista_entidad_serie=array();
	$ids=['funcionario'=>$funcionario,
	'cargos' => $cargos,
    'dependencias' => $dependencias,
    'roles' => $roles];
    // series asignadas funcionario
    //$serie_func = busca_filtro_tabla("A.idpermiso_serie as identidad_serie, B.*", "permiso_serie A, serie B,entidad C", " A.estado=1 AND B.estado=1 AND C.nombre like 'funcionario' AND A.llave_entidad=$funcionario AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ".$permisos, "B.nombre", $conn);
    $serie_func = busca_filtro_tabla("A.fk_entidad_serie as identidad_serie, B.serie_idserie as idserie", "permiso_serie A,entidad_serie B,entidad C", " A.estado=1 AND B.estado=1 AND C.nombre like 'funcionario' AND A.llave_entidad=$funcionario AND A.entidad_identidad=C.identidad AND A.fk_entidad_serie=B.identidad_serie AND A.permiso like '%a,v%'", "", $conn);
    
	
    // series asignadas al cargo
    if (@$cargos) {
        //$serie_cargo = busca_filtro_tabla("A.idpermiso_serie as identidad_serie, B.*", "permiso_serie A, serie B,entidad C", "A.estado=1 AND B.estado=1 AND C.nombre like 'cargo' AND A.llave_entidad IN(" . implode(",", $cargos) . ") AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ".$permisos, "B.nombre", $conn);
        $serie_cargo = busca_filtro_tabla("A.fk_entidad_serie as identidad_serie, B.serie_idserie as idserie", "permiso_serie A,entidad_serie B,entidad C", " A.estado=1 AND B.estado=1 AND C.nombre like 'cargo' AND A.llave_entidad IN(" . implode(",", $cargos) . ") AND A.entidad_identidad=C.identidad AND A.fk_entidad_serie=B.identidad_serie AND A.permiso like '%a,v%'", "", $conn);
    } else {
        $serie_cargo["numcampos"] = 0;
    }
	
    // series asignadas al la dependencia
    if (@$dependencias) {
        //$serie_dependencia = busca_filtro_tabla("A.idpermiso_serie as identidad_serie, B.*", "permiso_serie A, serie B,entidad C", "A.estado=1 AND B.estado=1 AND C.nombre like 'dependencia' AND A.llave_entidad IN(" . implode(",", $dependencias) . ") AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ".$permisos, "B.nombre", $conn);
        $serie_dependencia = busca_filtro_tabla("A.fk_entidad_serie as identidad_serie, B.serie_idserie as idserie", "permiso_serie A,entidad_serie B,entidad C", " A.estado=1 AND B.estado=1 AND C.nombre like 'dependencia' AND A.llave_entidad IN(" . implode(",", $dependencias) . ") AND A.entidad_identidad=C.identidad AND A.fk_entidad_serie=B.identidad_serie AND A.permiso like '%a,v%'", "", $conn);
    } else {
        $serie_dependencia["numcampos"] = 0;
    }
    
     // series asignadas al rol
    if (@$roles) {
        //$serie_roles = busca_filtro_tabla("A.idpermiso_serie as identidad_serie, B.*", "permiso_serie A, serie B,entidad C", "A.estado=1 AND B.estado=1 AND C.nombre like 'dependencia_cargo' AND A.llave_entidad IN(" . implode(",", $roles) . ") AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ".$permisos, "B.nombre", $conn);
        $serie_roles = busca_filtro_tabla("A.fk_entidad_serie as identidad_serie, B.serie_idserie as idserie", "permiso_serie A,entidad_serie B,entidad C", " A.estado=1 AND B.estado=1 AND C.nombre like 'dependencia_cargo' AND A.llave_entidad IN(" . implode(",", $roles) . ") AND A.entidad_identidad=C.identidad AND A.fk_entidad_serie=B.identidad_serie AND A.permiso like '%a,v%'", "", $conn);
    } else {
        $serie_roles["numcampos"] = 0;
    }
    // procesando datos
    $serie_f = extrae_campo($serie_func, "idserie", "U");	
    $serie_c = extrae_campo($serie_cargo, "idserie", "U");
    $serie_d = extrae_campo($serie_dependencia, "idserie", "U");
    $serie_r = extrae_campo($serie_roles, "idserie", "U");
	$identidad_f = extrae_campo($serie_func, "identidad_serie", "U");	
    $identidad_c = extrae_campo($serie_cargo, "identidad_serie", "U");
    $identidad_d = extrae_campo($serie_dependencia, "identidad_serie", "U");
    $identidad_r = extrae_campo($serie_roles, "identidad_serie", "U");
	$lista_entidad_serie = array_merge($identidad_f,$identidad_c,$identidad_d,$identidad_r);
	$lista_entidad_serie=array_unique($lista_entidad_serie);
	
	
    $datos = array();
    $datos[0] = array(
        "informacion",
        "",
        "Informaci&oacute;n del Funcionario"
    );
    $datos[1] = array(
        "roles",
        "",
        "Listado de Roles (Dependencia-Cargo) "
    );
    $datos[2] = array(
        "permisos",
        "permiso",
        "Listado de Permisos"
    );
    $datos[4] = array(
        "series_funcionario",
        "serie"
       // "Series Asignadas al Funcionarios"
    );
    $datos[3] = array(
        "perfil",
        "",
        "Listado de Permisos del Perfil"
    );
    $datos["informacion"][0] = $funcionario;
    $datos["informacion"]["numcampos"] = 1;
    $datos["cargos"] = $cargos;
    $datos["dependencias"] = $dependencias;
    $datos["roles"] = $roles;
    $datos["modulos"] = $modulos;
    $datos["series"] = busca_series_funcionario($serie_f, $serie_c, $serie_d, $serie_r);
    $serie_f1 = extrae_campo($serie_func, "identidad_serie", "U");
    $serie_c1 = extrae_campo($serie_cargo, "identidad_serie", "U");
    $serie_d1 = extrae_campo($serie_dependencia, "identidad_serie", "U");
    $datos["series_funcionario"] = $serie_f1;
    $datos["series_cargo"] = $serie_c1;
    $datos["series_dependencia"] = $serie_d1;
	$datos["ids"]=$ids;
	$datos["identidad_serie"]=$lista_entidad_serie;
    return ($datos);
}

/* Esat Funcion esta casi lista */
function busca_series_funcionario($serie_f, $serie_c, $serie_d,$serie_r) {
    $series = array_merge((array) $serie_f, (array) $serie_c, (array) $serie_d, (array) $serie_r);
    $series_gen = array_unique($series);
    sort($series_gen);
    // print_r($series_gen);
    return ($series_gen);
}

/*
 * Esta funcion retorna un listado con los datos de funcionarios que cumplen con
 * tipo_campo(pertenecen a la dependencia, poseen el cargo,poseen la serie) y su valor
 * retorna el listado de funcionarios ordenado Ascendentemente
 */
function busca_funcionarios($tipo_dato, $valor) {
    global $conn;
    $larreglo = array();
    $lfuncionario = array();
    switch ($tipo_dato) {
        case "cargo":
            $cargo = busca_filtro_tabla("*", "cargo A", "A.nombre LIKE '" . $valor . "' and A.estado=1", "", $conn);
            $larreglo = extrae_campo($cargo, "idcargo", "U");
            if ($cargo["numcampos"]) {
                $funcionario = busca_filtro_tabla("*", "dependencia_cargo A", "A.cargo_idcargo IN(" . implode(",", $larreglo) . ") and A.estado=1", "", $conn);
                // print_r($funcionario);
                $lfuncionario = extrae_campo($funcionario, "funcionario_idfuncionario", "U");
                $nfuncionarios = count($lfuncionario);
                if ($nfuncionarios)
                    return ($lfuncionario);
            }
            return ($larreglo);
            break;
        case "dependencia":

            break;
    }
}

function verificar_existencia_funcionario($entidad, $llave_entidad, $funcionario_codigo) {
    global $conn;
    // llave_entidad =-1 es la llave generica es decir cualquiera lo puede hacer
    if ($llave_entidad == -1)
        return (true);

    $condicion = '';
    switch ($entidad) {
        case 1: // funcionario
            $condicion = "funcionario_codigo=" . $funcionario_codigo . " AND funcionario_codigo In(" . $llave_entidad . ")";
            break;
        case 2: // dependencia
            $condicion = 'iddependencia IN(' . $llave_entidad . ") AND funcionario_codigo=" . $funcionario_codigo;
            break;
        case 3: // ejecutor
            break;
        case 4: // cargo
            $condicion = 'idcargo IN(' . $llave_entidad . ") AND funcionario_codigo=" . $funcionario_codigo;
            break;
        case 5: // dependencia cargo
            break;
    }
    $dato = busca_filtro_tabla("", "vfuncionario_dc", $condicion . " AND estado_dc=1 AND estado_dep=1 AND estado=1", "", $conn);
    // print_r($dato);
    // die();
    if ($dato["numcampos"]) {
        return (true);
    }
    return (false);
}
