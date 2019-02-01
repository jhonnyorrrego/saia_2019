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
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

$idfuncionario = usuario_actual("idfuncionario");

$datos_admin_funcionario = busca_datos_administrativos_funcionario($idfuncionario);
$lista_entidades = implode(",", $datos_admin_funcionario["identidad_serie"]);
 //print_r($lista_entidades);
$campo_llave="idexpediente";
if (@$_REQUEST['campo_llave']) {
	$campo_llave=@$_REQUEST['campo_llave'];
}

$campo="";
if(isset($_REQUEST['campo'])){
	$campo=$_REQUEST['campo'];
}
if (isset($_REQUEST['valor'])) {
	if (MOTOR == 'MySql') {
		//$datos = busca_filtro_tabla("a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre, estado_archivo, cod_padre, fk_idcaja", "vexpediente_serie a", $lista2 . $estado_cierre . $estado_archivo . $excluidos . " and lower(nombre) like '" . strtolower(htmlentities($_REQUEST['valor'])) . "%'", "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by nombre asc limit 0,10", $conn);
    $datos = busca_filtro_tabla("DISTINCT idexpediente,serie_idserie,nombre,codigo_numero,estado_cierre,agrupador,e.fk_idcaja,e.cod_padre", "entidad_expediente ee
            join expediente e on ee.expediente_idexpediente = e.idexpediente", "(e.propietario=$idfuncionario or e.fk_entidad_serie in (" . $lista_entidades .")) and e.estado_cierre =1 and lower(nombre) like '%" . strtolower(htmlentities($_REQUEST['valor'])) . "%'", "nombre ASC", $conn);
    
	}
	//print_r($datos["sql"]);
   /*
	if (MOTOR == 'Oracle') {
		$datos = busca_filtro_tabla("", "(SELECT a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre, estado_archivo, cod_padre FROM vexpediente_serie a WHERE " . $lista2 . $estado_cierre . $estado_archivo . $excluidos . " and lower(nombre) like '%" . strtolower(htmlentities($_REQUEST['valor'])) . "%' GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by nombre asc)", " ROWNUM <= 10", "", $conn);
	}
	if (MOTOR == 'SqlServer') {
		$datos = busca_filtro_tabla("TOP 10 a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre, estado_archivo, cod_padre, fk_idcaja", "vexpediente_serie a", $lista2 . $estado_cierre . $estado_archivo . $excluidos . " and lower(nombre) like '%" . strtolower(htmlentities($_REQUEST['valor'])) . "%'", "GROUP BY a.fecha, a.nombre, a.cod_arbol, a.idexpediente, estado_cierre order by nombre asc", $conn);
	}*/
	$html = "<ul>";
	if ($datos['numcampos']) {
		for ($i = 0; $i < $datos['numcampos']; $i++) {
			//$archivo=array(1=>"Gesti&oacute;n",2=>"Central",3=>"Hist&oacute;rico");
			$nom_caja=busca_filtro_tabla("no_consecutivo","caja","idcaja=".$datos[$i]['fk_idcaja'],"",$conn);
			if($nom_caja['numcampos']){
				$caja=$nom_caja[0]['no_consecutivo'] . '-';
			}
			$padre = busca_filtro_tabla("nombre", "expediente", "idexpediente=" . $datos[$i]['cod_padre'], "", $conn);
			$etiqueta = $caja. $datos[$i]['nombre'];

			$html .= "<li onclick=\"cargar_datos('" . $datos[$i][$campo_llave] . "','" . ucfirst($datos[$i]['nombre']) . "','$campo')\">
            " . ucfirst($etiqueta) . "</li>";
		}
	} else {
		$html .= "<li onclick=\"cargar_datos(0)\">No hay coincidencias</li>";
	}
	$html .= "</ul>";
	echo $html;
}
?>