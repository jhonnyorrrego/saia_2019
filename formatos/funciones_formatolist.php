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

if (!$_REQUEST["idformato"]) {
	notificaciones("NO se recibio el identificador del formato", 'error');
	die();
}
$parte_table = "";
$idformato = $_REQUEST["idformato"];
$formato = busca_filtro_tabla("DISTINCT A.*", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $idformato, "A.etiqueta", $conn);
$datos_formato = busca_filtro_tabla("nombre,etiqueta", "formato", "idformato=" . $idformato, "", $conn);
if ($formato["numcampos"]) {
	$acciones = array("m" => "Mostrar", "a" => "Adicionar", "e" => "Editar");
	for ($i = 0; $i < $formato["numcampos"]; $i++) {
		$funciones_orig = busca_filtro_tabla("B.formato_idformato", "funciones_formato_enlace B", "B.funciones_formato_fk=" . $formato[$i]["idfunciones_formato"], " B.idfunciones_formato_enlace asc", $conn);
		$formato_orig = $funciones_orig[0]["formato_idformato"];
		if ($formato_orig != $idformato) {// busco el nombre del formato inicial
			$dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
			if ($dato_formato_orig["numcampos"]) {
				// si el archivo existe dentro de la carpeta formatos
				if (is_file($ruta_db_superior . FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $formato[$i]["ruta"])) {
					$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $formato[$i]["ruta"]);
				} elseif (is_file($ruta_db_superior . $formato[$i]["ruta"])) {
					// si el archivo existe en la ruta especificada partiendo de la raiz
					$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . $formato[$i]["ruta"]);
				} else {
					$ruta_formato = 'Error: ' . $x_ruta . "|id=" . $formato[$i]["idfunciones_formato"];
				}
			}
		} else {
			// si el archivo existe dentro de la carpeta formatos
			if (is_file($ruta_db_superior . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $formato[$i]["ruta"])) {
				$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $formato[$i]["ruta"]);
			} elseif (is_file($ruta_db_superior . $formato[$i]["ruta"])) {
				// si el archivo existe en la ruta especificada partiendo de la raiz
				$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . $formato[$i]["ruta"]);
			} else {
				$ruta_formato = 'Error: ' . $formato[$i]["ruta"] . "|id=" . $formato[$i]["idfunciones_formato"];
			}
		}

		$accion = explode(",", $formato[$i]["acciones"]);
		$nomb_accion = array();
		foreach ($acciones as $key => $value) {
			if (in_array($key, $accion)) {
				$nomb_accion[] = $value;
			}
		}
		$parte_table .= '<tr>';
		$parte_table .= '<td>' . $formato[$i]["nombre"] . '</td>
		<td>' . $formato[$i]["etiqueta"] . '</td>
		<td>' . $formato[$i]["descripcion"] . '</td>
		<td>' . implode(", ", $nomb_accion) . '</td>
		<td>' . $ruta_formato . '</td>
		<td style="text-align:center"><a class="btn btn-mini btn-warning" href="funciones_formatoedit.php?idformato=' . $idformato . '&key=' . $formato[$i]["idfunciones_formato"] . '">Editar</a></td>
		<td style="text-align:center"><a class="btn btn-mini btn-danger" href="funciones_formatodelete.php?idformato=' . $idformato . '&key=' . $formato[$i]["idfunciones_formato"] . '">X</a></td>';

		$parte_table .= '</tr>';
	}
}
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
?>
<html>
	<body>
		<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		<script type='text/javascript'>
			hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
		</script>
		<p>
			<legend></br>Funciones del formato <?php echo("<b>" . $datos_formato[0]["etiqueta"] . "</b>");?></legend></br>
			<a class="btn btn-mini btn-info" href="campos_formatolist.php?idformato=<?php echo($idformato);?>">Campos del Formato</a>
			<a class="btn btn-mini btn-info" href="formatoadd_paso2.php?key=<?php echo($idformato);?>">Dise&ntilde;o del Formato</a>
			<a class="btn btn-mini btn-info highslide" style="text-decoration:none" href="asignar_funciones.php?idformato=<?php echo($idformato);?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 550, height:400,preserveContent:false } )">Asignar Funciones</a>
			<a class="btn btn-mini btn-info highslide" style="text-decoration:none" href="funciones_formato_ordenar.php?idformato=<?php echo($idformato);?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 550, height:400,preserveContent:false } )">Ordenar Funciones</a>
			<a class="btn btn-mini btn-success" href="llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo($idformato);?>">Publicar Formato</a>
		</p>
		<p>
			<table class="table table-bordered">
				<tr class="encabezado_list">
					<td>Nombre</td>
					<td>Etiqueta </td>
					<td>Descripci&oacute;n </td>
					<td>Acciones </td>
					<td>Ruta</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php echo $parte_table;?>
			</table>
	</body>
</html>