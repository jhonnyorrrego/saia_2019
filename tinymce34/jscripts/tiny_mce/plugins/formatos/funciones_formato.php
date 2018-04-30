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
$display_add='none;';
$display_ver='block;';
if($_REQUEST["adicionar"]==1){
	$display_add='block';
	$display_ver='none';
}
if (isset($_REQUEST["idfor"])) {
	$idfor = $_REQUEST["idfor"];
} else if (isset($_REQUEST["formato"])) {
	$idfor = $_REQUEST["formato"];
}

if (isset($_REQUEST["guardar"]) && $_REQUEST["guardar"] == 1 && $idfor) {
	$nombre = $_REQUEST["nombre"];
	$exist=busca_filtro_tabla("idfunciones_formato","funciones_formato","nombre_funcion like '".$nombre."'","",$conn);
	if($exist["numcampos"]){
	?>
	<script>
		alert("La funcion (<?php echo $nombre;?>) ya existe en la DB");
	</script>
	<?php
	}else{
	$acciones = implode(",", $_REQUEST["acciones"]);
		$sql = "insert into funciones_formato(nombre,nombre_funcion,etiqueta,ruta,descripcion,acciones) values('{*$nombre*}','$nombre','$nombre','" . $_REQUEST["ruta"] . "','" . $_REQUEST["descripcion"] . "','$acciones')";
	phpmkr_query($sql, $conn) or die("Error al crear la funcion");
		$idfuncion=phpmkr_insert_id();
		if($idfuncion){
			$sql_enlace="INSERT INTO funciones_formato_enlace (funciones_formato_fk,formato_idformato) VALUES (".$idfuncion.",".$idfor.")";
			phpmkr_query($sql_enlace);
		}else{
			?>
			<script>
				alert("Error al vincular el formato con la funcion");
			</script>
			<?php
		}
	}
	redirecciona("funciones_formato.php?tipo=funciones_formato&formato=" . $_REQUEST["formato"]);
	die();
} 
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
			<strong>FUNCIONES <?php $cadena=($_REQUEST["tipo"]=="funciones_generales")?"GENERALES":"FORMATO"; echo($cadena);?></strong>
			<br/>
		</p>
		<a href="formatos.php?tipo=campos_formato&formato=<?php echo $idfor; ?>">Campos del Formato</a>&nbsp;
		<a href='funciones_formato.php?formato=<?php echo $idfor; ?>&adicionar=1'>Adicionar</a>
		<a href='funciones_formato.php?tipo=funciones_formato&formato=<?php echo $idfor; ?>'>Funciones Formato</a>&nbsp;&nbsp;
		<a href='funciones_formato.php?tipo=funciones_generales&idfor=<?php echo $idfor; ?>'>Funciones Generales</a>
		<br/>
		<br/>
	<div id="div_adicionar_funcion" style="display:<?php echo $display_add;?>">
		<script>
			$(document).ready(function() {
				$('#nombre').keyup(function() {
					var texto = $(this).val();
					texto = texto.replace(/[^a-zA-Z0-9_]/, '')
					$(this).val(texto.toLowerCase());
				});
			});
			function validar() {
				if (form1.nombre.value != '' && form1.ruta.value != '') {
					form1.submit();
				} else {
					alert('Debe llenar los campos obligatorios');
				}
			}
			function cancelar(){
				window.location.href="funciones_formato.php?tipo=funciones_formato&formato="+form1.formato.value;
			}
		</script>
		<form method='post' name='form1' id='form1' >
			<table border='1' style='border-collapse:collapse;' align='center'>
				<tr>
					<td>Nombre*</td>
					<td>
					<input type='text' name='nombre' class='required' id='nombre'>
					</td>
				</tr>

				<tr>
					<td>Ruta*</td>
					<td>
					<input type='text' name='ruta' class='required' id='ruta'>
					</td>
				</tr>
				<tr>
					<td>Descripci&oacute;n</td>
					<td>
					<input type='text' name='descripcion' id='descripcion' >
					</td>
				</tr>
				<tr>
					<td >Acciones</td>
					<td >
					<input type="checkbox" name="acciones[]" value="a">
					Adicionar&nbsp;
					<input type="checkbox" name="acciones[]" value="m" checked>
					Mostrar&nbsp;
					<input type="checkbox" name="acciones[]" value="e">
					Editar&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center">
					<input type="button" value="Cancelar" onclick="cancelar();">
					<input type="button" value="Guardar" onclick="validar();">
					</td>
				</tr>
			</table>
			<input type='hidden' id='formato' name='formato' value='<?php echo $idfor;?>'>
			<input type='hidden' name='guardar' value='1'>
			<input type='hidden' name='tipo' value='<?php echo($_REQUEST["tipo"]);?>'>
		</form>
		</div>
		<div id="div_funcion" style="display:<?php echo $display_ver;?>">
		<?php
		$where = "";
		$html = "";
		$colspan = 2;
		if(isset($idfor)) {
			if($_REQUEST["tipo"]=="funciones_generales"){
				$where=' and e.formato_idformato<>'.$idfor;
				$order='GROUP BY f.idfunciones_formato ORDER BY nombre ASC';
			}
			else{
			$colspan = 4;
				$where = " and e.formato_idformato=".$idfor;
				$order= "nombre asc";
		}
		}
		$resultado = busca_filtro_tabla("f.*", "funciones_formato f, funciones_formato_enlace e", "f.idfunciones_formato=e.funciones_formato_fk".$where,$order, $conn);
		if ($resultado["numcampos"]) {
			$html .= "<table border='1' style='border-collapse:collapse;' align='center' class='productTable'>
         <tr align='center' bgcolor='lightgray'>
         <td width='30%'>NOMBRE</td><td colspan='" . $colspan . "'>OPCIONES</td>
      </tr>";
			for ($i = 0; $i < $resultado["numcampos"]; $i++) {
				$html .= "<tr>
					<td>" . $resultado[$i]["etiqueta"] . "</td>
					<td align='center' valign='center'>" . '<img onclick="ajax_showTooltip(window.event,\'detalles.php?tipo=funciones_formato&id=' . $resultado[$i]["idfunciones_formato"] . '\',this);return false"  src="images/mostrar_nota.png"/>' . "</td>";
				$html .= '<td align="center"><a title="' . codifica_encabezado(html_entity_decode($resultado[$i]["descripcion"])) . '" href="javascript:FormatosDialog.insert(\'' . $resultado[$i]["nombre_funcion"] . '\');" >Insertar</a>
				</td>';
				if ($_REQUEST["tipo"]!="funciones_generales") {
					$html .= "<td  align='center'><a href='" . $ruta_db_superior . "formatos/funciones_formatoedit.php?idformato=" . $idfor . "&key=" . $resultado[$i]["idfunciones_formato"] . "&pantalla=tiny' >Editar</a></td>";
					$html .= "<td align='center'><a  href='" . $ruta_db_superior . "formatos/funciones_formatodelete.php?idformato=" . $idfor . "&key=" . $resultado[$i]["idfunciones_formato"] . "&pantalla=tiny' >Eliminar</a></td>";
				}
			}
			$html .= "</table><br/><br/>";
		}
		echo $html;
		?>
		</div>
	</body>
</html>
