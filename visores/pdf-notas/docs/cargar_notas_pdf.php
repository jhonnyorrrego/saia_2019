<?php
set_time_limit(0);
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

if ($_POST['cargar']) {
	$datos = busca_filtro_tabla("", "notas_pdf", "tipo_archivo='" . $_POST["tipo_archivo"] . "' and estado=1 and cod_padre is null and iddocumento=" . $_POST['iddoc'] . " and (pagina='" . $_POST['pagina'] . "' or pagina='pageContainer" . $_POST['pagina'] . "')", "", $conn);

	$notas = array();
	for ($i = 0; $i < $datos['numcampos']; $i++) {
		if ($datos[$i]["tipo"] == 'area') {
			$notas[$i]["type"] = $datos[$i]['tipo'];
			$notas[$i]["color"] = $datos[$i]['color'];
			$notas[$i]["x"] = $datos[$i]['x'];
			$notas[$i]["y"] = $datos[$i]['y'];
			$notas[$i]["width"] = $datos[$i]['ancho'];
			$notas[$i]["height"] = $datos[$i]['alto'];
			$notas[$i]["page"] = $datos[$i]['pagina'];
			$notas[$i]["ui"] = $datos[$i]['uid'];
			$notas[$i]["idft_notas_pdf"] = $datos[$i]['idft_notas_pdf'];
			$notas[$i]["iddocumento"] = $datos[$i]['iddocumento'];
		}
		if ($datos[$i]["tipo"] == 'highlight') {
			$notas[$i]["type"] = $datos[$i]['tipo'];
			$notas[$i]["color"] = $datos[$i]['color'];
			$notas[$i]["ui"] = $datos[$i]['uid'];
			$notas[$i]["idft_notas_pdf"] = $datos[$i]['idft_notas_pdf'];
			$notas[$i]["iddocumento"] = $datos[$i]['iddocumento'];
			$notas[$i]["page"] = $datos[$j]['pagina'];
			$coordenadas = busca_filtro_tabla("", "notas_pdf", "tipo_archivo='" . $_POST["tipo_archivo"] . "' and estado=1 and tipo='highlight' and (cod_padre='" . $datos[$i]['idft_notas_pdf'] . "' or idft_notas_pdf=" . $datos[$i]['idft_notas_pdf'] . " )and iddocumento=" . $_POST['iddoc'], "", $conn);
			for ($j = 0; $j < $coordenadas['numcampos']; $j++) {
				$notas[$i]["x"][] = $coordenadas[$j]['x'];
				$notas[$i]["y"][] = $coordenadas[$j]['y'];
				$notas[$i]["width"][] = $coordenadas[$j]['ancho'];
				$notas[$i]["height"][] = $coordenadas[$j]['alto'];
			}
		}

		if ($datos[$i]["tipo"] == 'sello') {
			$notas[$i]["type"] = $datos[$i]['tipo'];
			$notas[$i]["idft_notas_pdf"] = $datos[$i]['idft_notas_pdf'];
			$notas[$i]["x"] = $datos[$i]['x'];
			$notas[$i]["y"] = $datos[$i]['y'];
			$notas[$i]["width"] = $datos[$i]['ancho'];
			$notas[$i]["height"] = $datos[$i]['alto'];
			$notas[$i]["page"] = $datos[$i]['pagina'];
			$notas[$i]["imagen"] = $datos[$i]['imagen'];

		}
	}
	$notas["numcampos"] = $datos['numcampos'];
	echo(json_encode($notas));

} else if ($_POST['guardar']) {
	$info = array();
	if ($_POST["tipo"] == 'area') {
		$info['iddocumento'] = $_POST["iddoc"];
		$info['tipo_archivo'] = $_POST["tipo_archivo"];
		$info['tipo'] = $_POST["valores"]['type'];
		$info['color'] = "f5f900";
		$info['x'] = $_POST["valores"]['x'];
		$info['y'] = $_POST["valores"]['y'];
		$info['ancho'] = $_POST["valores"]['width'];
		$info['alto'] = $_POST["valores"]['height'];
		$info['pagina'] = $_POST["pageNumber"];
		//$info['uid']=$_POST["valores"]['uuid'];
		$info['uid'] = '1234';
		$info['estado'] = 1;
		$info['fecha_notas'] = date('Y-m-d H:i:s');
		$sql_insert = "insert into notas_pdf (" . implode(',', array_keys($info)) . ") values ('" . implode("','", array_values($info)) . "')";
		phpmkr_query($sql_insert);
		$id = phpmkr_insert_id();
		echo($id);

	} else if ($_POST["tipo"] == 'highlight') {
		$info['iddocumento'] = $_POST["iddoc"];
		$info['tipo_archivo'] = $_POST["tipo_archivo"];
		$info['tipo'] = $_POST["valores"]['type'];
		$info['color'] = "ffff00";
		$info['pagina'] = $_POST["pageNumber"];
		$info['uid'] = $_POST["valores"]['uuid'];
		$info['estado'] = 1;
		$info['fecha_notas'] = date('Y-m-d H:i:s');

		$seleccionado = $_POST["valores"]["rectangles"];
		for ($i = 0; $i < count($seleccionado); $i++) {
			$info['x'] = $seleccionado[$i]['x'];
			$info['y'] = $seleccionado[$i]['y'];
			$info['ancho'] = $seleccionado[$i]['width'];
			$info['alto'] = $seleccionado[$i]['height'];
			$sql_insert = "insert into notas_pdf (" . implode(',', array_keys($info)) . ") values ('" . implode("','", array_values($info)) . "')";
			phpmkr_query($sql_insert);

			if ($i == 0) {
				$id = phpmkr_insert_id();
				$info['cod_padre'] = $id;
			}
		}
		echo($id);
	} else if ($_POST["tipo"] == 'sello') {
		$info['iddocumento'] = $_POST["iddoc"];
		$info['tipo_archivo'] = $_POST["tipo_archivo"];
		$info['tipo'] = $_POST["tipo"];
		$info['color'] = null;
		$info['x'] = $_POST['x'];
		$info['y'] = $_POST['y'];
		$info['pagina'] = $_POST["pageNumber"];
		$info['imagen'] = $_POST["imagen"];
		$imagen = getimagesize($ruta_db_superior . "visores/pdf-notas/docs/logo.jpg");
		if ($_POST['width'] == 0) {
			$info['ancho'] = $imagen[0];
		} else {
			$info['ancho'] = $_POST['width'];
		}

		if ($_POST['height'] == 0) {
			$info['alto'] = $imagen[1];
		} else {
			$info['alto'] = $_POST['height'];
		}

		$info['estado'] = 1;
		$info['fecha_notas'] = date('Y-m-d H:i:s');
		$sql_insert = "insert into notas_pdf (" . implode(',', array_keys($info)) . ") values ('" . implode("','", array_values($info)) . "')";
		phpmkr_query($sql_insert);
		$id = phpmkr_insert_id();
		echo($id);
	}
} else if ($_POST['eliminar']) {
	if ($_POST['idft_notas_pdf'] != "" && $_POST["iddoc"] != '') {
		$sql_update = "update notas_pdf set estado='0' where iddocumento='" . $_POST["iddoc"] . "' and tipo_archivo='" . $_POST["tipo_archivo"] . "' and  (idft_notas_pdf=" . $_POST['idft_notas_pdf'] . " or cod_padre='" . $_POST['idft_notas_pdf'] . "')";
		phpmkr_query($sql_update);

		$sql_comentarios = "update comentario_pdf set estado='0' where iddocumento='" . $_POST["iddoc"] . "' and tipo_archivo='" . $_POST["tipo_archivo"] . "' and ft_notas_pdf='" . $_POST['idft_notas_pdf'] . "' ";
		phpmkr_query($sql_comentarios);
	}
} else if ($_POST['eliminar_todo']) {
	if ($_POST["iddoc"] != '') {
		$sql_update = "update notas_pdf set estado='0' where iddocumento='" . $_POST["iddoc"] . "' and tipo_archivo='" . $_POST["tipo_archivo"] . "'";
		phpmkr_query($sql_update);

		$sql_comentarios = "update comentario_pdf set estado='0' where iddocumento='" . $_POST["iddoc"] . "' and tipo_archivo='" . $_POST["tipo_archivo"] . "'";
		phpmkr_query($sql_comentarios);
	}
}
?>