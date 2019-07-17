<?php session_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
$ewCurSec = 0; // Initialise

?>
<?php

// Initialize common variables
$x_asignacion = Null;
$x_accion = Null;
$x_periocidad = Null;
$x_tipo_periocidad = Null;
$x_fecha_inicio = Null;
$x_fecha_final = Null;
$x_estado = Null;
$x_entidad = Null;
$x_llave = Null;
?>
<?php include("../db.php") ?>
<?php include("../phpmkrfn.php") ?>
<?php

if (isset($_REQUEST["modo"]))
	$modo = $_REQUEST["modo"];
else
	$modo = "usuario";


// Load Key Parameters
$sKey = @$_REQUEST["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",", $sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	abrir_url("tareas_documentolist.php", "centro");
}
$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idasignacion=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction) {
	case "I": // Display
		if (LoadRecordCount($sDbWhere, $conn) <= 0) {
			//phpmkr_db_close($conn);
			abrir_url("tareas_documentolist.php", "centro");
		}
		break;
	case "D": // Delete
		if (DeleteData($sKey, $conn)) {
			//phpmkr_db_close($conn);
			abrir_url("asignaciones.php?modo=" . $_REQUEST["modo"], "centro");
		} else alerta("No se ha sido posible Realizar la eliminacion", 'error', 4000);
		break;
}
?>
<?php include("../header.php") ?>
<!--p><span class="phpmaker">Borrar Tabla: control asignacion<br><br><a href="control_asignacionlist.php">Regresar al listado</a></span></p-->
<form action="asignaciondelete.php" method="post">
	<p>
		<input type="hidden" name="a_delete" value="D">
		<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
		<input type="hidden" name="key" value="<?php echo  htmlspecialchars($sKey); ?>">
		<input type="hidden" name="modo" value="<?php echo  htmlspecialchars($modo); ?>">
		<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
			<tr class="encabezado_list">
				<td valign="top">Tarea</td>
				<td valign="top">Fecha Inicio</td>
				<td valign="top">Fecha Vencimiento</td>
				<td valign="top">Estado</td>
				<td valign="top">Asignado A</td>
				<td valign="top">Periodicidad</td>
				<td valign="top">Tipo Periodicidad</td>
			</tr>
			<?php
			$nRecCount = 0;
			foreach ($arRecKey as $sRecKey) {
				$sRecKey = trim($sRecKey);
				$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
				$nRecCount = $nRecCount + 1;

				// Set row color
				$sItemRowClass = " bgcolor=\"#FFFFFF\"";

				// Display alternate color for rows
				if ($nRecCount % 2 <> 0) {
					$sItemRowClass = " bgcolor=\"#F5F5F5\"";
				}
				if (LoadData($sRecKey, $conn)) {
					?>
					<tr<?php echo $sItemRowClass; ?>>
						<td><span class="phpmaker">
								<?php
								if ($x_tarea_idtarea) {
									$tarea = busca_filtro_tabla("", "tarea", "idtarea=" . $x_tarea_idtarea, "", $conn);
									if ($tarea["numcampos"]) {
										echo ($tarea[0]["descripcion"]);
									}
								}
								?>
							</span></td>
						<td><span class="phpmaker">
								<?php echo $x_fecha_inicio; ?>
							</span></td>
						<td><span class="phpmaker">
								<?php echo $x_fecha_final; ?>
							</span></td>
						<td><span class="phpmaker">
								<?php echo $x_estado; ?>
							</span></td>
						<td><span class="phpmaker">
								<?php
								$entidad = busca_filtro_tabla("", "entidad", "identidad=" . $x_entidad, "", $conn);
								if ($entidad["numcampos"]) {
									echo ($entidad[0]["nombre"] . ":<br />");
								}
								switch ($entidad[0]["nombre"]) {
									case "funcionario":
										$valor = "login AS nombre";
										$campo = "funcionario_codigo";
										break;
									default:
										$valor = "nombre";
										$campo = "id" . $entidad[0]["nombre"];
										break;
								}
								$llave = busca_filtro_tabla($valor, $entidad[0]["nombre"], $campo . "='" . $x_llave . "'", "", $conn);
								if ($llave["numcampos"]) {
									echo ($llave[0]["nombre"]);
								}
								?>
							</span></td>
						<td><span class="phpmaker">
								<?php echo $x_periocidad; ?>
							</span></td>
						<td><span class="phpmaker">
								<?php
								echo (parseo_formato_fecha($x_tipo_periocidad));
								?>
							</span></td>
						</tr>
					<?php
					}
				}
				?>
		</table>
		<p>
			<?php listado_controles_asignaciones(); ?>
			<br />
			<input type="submit" name="Action" value="Confirmar Eliminacion">
</form>
<?php


include("../footer.php") ?>
<?php
//phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey, $conn)
{
	global $x_asignacion, $x_accion, $x_periocidad, $x_tipo_periocidad, $x_fecha_inicio, $x_fecha_final, $x_estado,
		$x_entidad, $x_llave;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT B.* FROM asignacion B";
	$sSql .= " WHERE  idasignacion = " . $sKeyWrk;
	//die($sql);
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql, $conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	} else {
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_accion = $row["accion"];
		$x_periocidad = $row["reprograma"];
		$x_tipo_periocidad = $row["tipo_reprograma"];
		$x_fecha_inicio = $row["fecha_inicial"];
		$x_fecha_final = $row["fecha_final"];
		$x_estado = $row["estado"];
		$x_entidad = $row["entidad_identidad"];
		$x_llave = $row["llave_entidad"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey, $conn)
{
	global $conn;
	$datos = busca_filtro_tabla("", "asignacion", $sqlKey, "", $conn);
	return ($datos["numcampos"]);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey, $conn)
{
	global $conn;
	include_once("funciones.php");
	elimina_asignacion($sqlKey, "ELIMINA");
	return (true);  // TODO revisar el retrun de la funcion  elimina_asignacion
}

function listado_controles_asignaciones()
{
	global $conn;
	$idformato = @$_REQUEST["key"];
	$funciones = busca_filtro_tabla("*", "control_asignacion A", "asignacion_idasignacion=" . $idformato, "", $conn);
	$lfunciones = array();
	if ($funciones["numcampos"]) {
		echo ('Acciones o Controles vinculados Con la Asignacion que desea Terminar:<br /><br /><table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
  	<tr class="encabezado_list">
      <td valign="top">Proxima Ejecucion</td>
  	  <td valign="top">Accion</td>
		  <td valign="top">Periocidad</td>
		  <td valign="top">Tipo periocidad</td>
		  <td valign="top">anticipacion</td>
		  <td valign="top">Tipo anticipacion</td>
		  <td valign="top">Ejecutar hasta</td>
  	</tr>');
		for ($i = 0; $i < $funciones["numcampos"]; $i++) {
			$colorfila = " bgcolor=\"#FFFFFF\"";
			// Display alternate color for rows
			if ($i % 2 <> 0) {
				$colorfila = " bgcolor=\"#F5F5F5\"";
			}
			echo ('<tr ' . $colorfila . '>');
			echo ('<td><span class="phpmaker">' . $funciones[$i]["fecha_actualizacion"] . '</span></td><td><span class="phpmaker">' . $funciones[$i]["accion"] . '</span></td>');
			echo ('<td><span class="phpmaker">' . $funciones[$i]["periocidad"] . '</span></td><td><span class="phpmaker">' . parseo_formato_fecha($funciones[$i]["tipo_periocidad"]) . '</span></td>');
			echo ('<td><span class="phpmaker">' . $funciones[$i]["anticipacion"] . '</span></td><td><span class="phpmaker">' . parseo_formato_fecha($funciones[$i]["tipo_anticipacion"]) . '</span></td>');
			echo ('<td><span class="phpmaker">' . $funciones[$i]["ejecutar_hasta"] . '</span></td>');
			echo ('</tr>');
			echo ('</table>');
		}
	} else echo ('<spanclass="phpmaker"> NO SE ENCONTRARON CONTROLES PARA ESTA ASIGNACION</span>');
}
function parseo_formato_fecha($tipo)
{
	$cad = "";
	switch ($tipo) {
		case "hour":
			$cad = "Hora(s)";
			break;
		case "day":
			$cad = "D&iacute;a(s)";
			break;
		case "month":
			$cad = "Mes(es)";
			break;
		case "year":
			$cad = "A&ntilde;o(s)";
			break;
	}
	return ($cad);
}
?>