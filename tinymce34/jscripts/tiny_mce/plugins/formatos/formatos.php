<?php
@set_time_limit(0);
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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
		<script type="text/javascript" src="jscripts/template.js"></script>
		<style type='text/css'>
			table {
				font-family: verdana;
				font-size: xx-small;
			}
			img {
				border: 0px;
			}
		</style>
		<script type="text/javascript" src="js/ajax-dynamic-content.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/ajax-tooltip.js"></script>
		<link rel="stylesheet" href="css/ajax-tooltip.css" media="screen" type="text/css">
		<link rel="stylesheet" href="css/ajax-tooltip-demo.css" media="screen" type="text/css">
	</head>
	<body>
		<p style="text-align: center">
			<strong>CAMPOS DEL FORMATO</strong>
			<br/>
		</p>
		<a href='<?php echo $ruta_db_superior; ?>formatos/campos_formatoadd.php?idformato=<?php echo $_REQUEST["formato"]; ?>&pantalla=tiny'>Adicionar</a>&nbsp;&nbsp;&nbsp;
		<a href='<?php echo $ruta_db_superior; ?>formatos/campos_formato_ordenar.php?idformato=<?php echo $_REQUEST["formato"]; ?>&pantalla=tiny'>Ordenar</a>&nbsp;&nbsp;
		<a href='funciones_formato.php?tipo=funciones_formato&formato=<?php echo $_REQUEST["formato"]; ?>'>Funciones Formato</a>&nbsp;&nbsp;
		<a href='funciones_formato.php?tipo=funciones_formato&idfor=<?php echo $_REQUEST["formato"]; ?>'>Funciones Generales</a>
		<br>
		<br />
		<?php
		$html = "";
		$resultado = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $_REQUEST["formato"], "nombre asc", $conn);
		if ($resultado["numcampos"]) {
			$html .= "<table border='1' style='border-collapse:collapse;' align='center' class='productTable'>
			<tr align='center' bgcolor='lightgray'><td width='30%'>ETIQUETA</td><td colspan='4'>OPCIONES</td></tr>";
			for ($i = 0; $i < $resultado["numcampos"]; $i++) {
				$html .= "<tr><td  align='center' >" . $resultado[$i]["etiqueta"] . "</td><td align='center' valign='center'>" . '<img onmouseover="ajax_showTooltip(window.event,\'detalles.php?tipo=campos_formato&id=' . $resultado[$i]["idcampos_formato"] . '\',this);return false" onmouseout="ajax_hideTooltip()" src="images/mostrar_nota.png"/>' . "</td>";
				$html .= '<td align="center"><a href="javascript:FormatosDialog.insert(\'' . $resultado[$i]["nombre"] . '\');" >Insertar</a>';
				$html .= "</td><td  align='center'><a  href='" . $ruta_db_superior . "formatos/campos_formatoedit.php?idformato=" . $_REQUEST["formato"] . "&key=" . $resultado[$i]["idcampos_formato"] . "&pantalla=tiny' >Editar</a></td>";
				$html .= "</td><td  align='center'><a  href='" . $ruta_db_superior . "formatos/campos_formatodelete.php?idformato=" . $_REQUEST["formato"] . "&key=" . $resultado[$i]["idcampos_formato"] . "&pantalla=tiny'>Eliminar</a></td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
		}
		echo $html;
	?>
	</body>
</html>