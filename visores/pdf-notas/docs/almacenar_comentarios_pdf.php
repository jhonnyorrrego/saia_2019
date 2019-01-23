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

if ($_POST['guardar']) {
	$info = array();
	$info['iddocumento'] = $_POST["iddoc"];
	$info['tipo_archivo'] = $_POST["tipo_archivo"];
	$info['ft_notas_pdf'] = $_POST["ft_notas_pdf"];
	$info['comentario'] = $_POST["comentario"];
	$info['estado'] = 1;
	$info['fecha_comentario'] = date('Y-m-d H:i:s');
	$info['funcionario'] = usuario_actual('login');

	$sql_insert = "insert into comentario_pdf (" . implode(',', array_keys($info)) . ") values ('" . implode("','", array_values($info)) . "')";
	phpmkr_query($sql_insert);
	$id = phpmkr_insert_id();
	$comentario = busca_filtro_tabla("b.tipo", "comentario_pdf a, notas_pdf b", "b.idft_notas_pdf=ft_notas_pdf and a.tipo_archivo='" . $_POST["tipo_archivo"] . "' and a.idcomentario_pdf='" . $id . "' and a.estado=1", "", $conn);
	$resultado = array(
		"idcomentario_pdf" => $id,
		"elemento" => $comentario[0]['tipo']
	);
	echo(json_encode($resultado));
} else if ($_POST['cargar']) {
	$comentario = busca_filtro_tabla("", "comentario_pdf a, notas_pdf b", "b.idft_notas_pdf=ft_notas_pdf and a.tipo_archivo='" . $_POST["tipo_archivo"] . "' and a.iddocumento='" . $_POST['iddoc'] . "' and a.estado=1 and a.ft_notas_pdf='" . $_POST["ft_notas_pdf"] . "'", "", $conn);
	$info = array();
	if ($comentario["numcampos"]) {
		$info["numcampos"] = $comentario["numcampos"];
		for ($i = 0; $i < $comentario["numcampos"]; $i++) {
			$info[$i]["comentario"] = html_entity_decode($comentario[$i]['comentario']);
			$info[$i]['ft_notas_pdf'] = $comentario[$i]['ft_notas_pdf'];
			$info[$i]['idcomentario_pdf'] = $comentario[$i]['idcomentario_pdf'];
			$info[$i]['elemento'] = $comentario[$i]['tipo'];
		}
	} else {
		$info["numcampos"] = 0;
	}
	echo(json_encode($info));
} else if ($_POST['cargar_todo']) {

	$comentario = busca_filtro_tabla("", "comentario_pdf a, notas_pdf b", "b.idft_notas_pdf=ft_notas_pdf and a.tipo_archivo='" . $_POST["tipo_archivo"] . "' and a.iddocumento='" . $_POST['iddoc'] . "' and a.estado=1", "", $conn);
	$info = array();
	if ($comentario["numcampos"]) {
		$info["numcampos"] = $comentario["numcampos"];
		for ($i = 0; $i < $comentario["numcampos"]; $i++) {
			$info[$i]["comentario"] = html_entity_decode($comentario[$i]['comentario']);
			$info[$i]['ft_notas_pdf'] = $comentario[$i]['ft_notas_pdf'];
			$info[$i]['idcomentario_pdf'] = $comentario[$i]['idcomentario_pdf'];
			$info[$i]['elemento'] = $comentario[$i]['tipo'];
		}
	} else {
		$info["numcampos"] = 0;
	}
	echo(json_encode($info));

} else if ($_POST['eliminar']) {
	if ($_POST['idcomentario_pdf'] != "") {
		$sql_comentarios = "update comentario_pdf set estado='0' where iddocumento='" . $_POST["iddoc"] . "' and tipo_archivo='" . $_POST["tipo_archivo"] . "' and idcomentario_pdf='" . $_POST['idcomentario_pdf'] . "' ";
		phpmkr_query($sql_comentarios);
	}
}
?>