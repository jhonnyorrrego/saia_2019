<?php include ("db.php") ?>
<?php
/*
<Clase>
<Nombre>aprueba_prestamo
<Parametros>
<Responsabilidades>esta pantalla muestra aquellos documentos que se han reservado para el dia en curso
                   dondole la opcion al usuario de aprobar o rechazar el prestamo.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php

// Initialize common variables
$documentos = Null;

?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{
	// Get fields from form
	$documentos = $_POST["documentos"];
}
switch ($sAction)
{
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adicion exitosa del registro.";
			ob_end_clean();
			?>
      <script>
      alert('PRESTAMO REGISTRADO');
      location = "aprueba_prestamo.php";
      </script>
      <?php
			exit();
		}
		break;
		
		case "D": // Negar el prestamo
		if (Niegue($conn)) { // Add New Record
			ob_end_clean();
			?>
      <script>
      alert('LOS PRESTAMOS HAN SIDO NEGADOS');
      location = "aprueba_prestamo.php";
      </script>
      <?php
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_numero && !EW_hasValue(EW_this.x_numero, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_numero, "TEXT", "Por favor ingrese los campos requeridos - numero"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="internos">
APROBACI&Oacute;N DE PR&Eacute;STAMOS<br></span></p>
<form name="aprueba_prestamo" id="aprueba_prestamo" action="aprueba_prestamo.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<?php
$hoy = date("Y-m-d H:i:s");
$solicitudes = busca_filtro_tabla("A.idsolicitud, A.documento_iddocumento, A.descripcion, B.nombres, B.apellidos, to_char(A.fecha, 'YYYY/MM/DD HH24:MI:SS') as fecha, to_char(C.fecha_inicial, 'YYYY/MM/DD HH24:MI:SS') as fecha_inicial, to_char(C.fecha_final, 'YYYY/MM/DD HH24:MI:SS') as fecha_final, A.idalmacenamiento","solicitud A, funcionario B, reserva C","B.funcionario_codigo=A.investigador_idinvestigador AND A.solicitar_a=".usuario_actual("funcionario_codigo")." AND A.estado='PENDIENTE' AND A.idsolicitud=C.solicitud_idsolicitud AND C.fecha_inicial<=to_date('".$hoy."','YYYY-MM-DD HH24:MI:SS')", "", $conn);
if($solicitudes["numcampos"]>0)
{ 
?>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">APROBAR</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">SOLICITADO POR</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ALMACENADO EN</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">FECHA SOLICITUD</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO SOLICITADO</span></td>
	</tr>
  <?php
  for($i=0; $i<$solicitudes["numcampos"]; $i++)
  {
   	// Colores de las filas alternados
	  $sItemRowClass = " bgcolor=\"#FFFFFF\"";
	  if ($i % 2 <> 0)
		  $sItemRowClass = " bgcolor=\"#F5F5F5\"";
		echo "<tr ".$sItemRowClass.">";  
    echo "<td><input type=\"checkbox\" name=\"documentos[]\" value=\"".$solicitudes[$i]["idsolicitud"]."\"></td>";
    echo "<td>".$solicitudes[$i]["nombres"]." ".$solicitudes[$i]["apellidos"]."</td>";
    echo "<td>".$solicitudes[$i]["descripcion"]."</td>";
    $ubicacion = busca_filtro_tabla("C.numero, C.estanteria, C.ubicacion, B.etiqueta","almacenamiento A, folder B, caja C", "A.idalmacenamiento=".$solicitudes[$i]["idalmacenamiento"]." AND A.folder_idfolder=B.idfolder AND B.caja_idcaja=C.idcaja", "", $conn);
    echo "<td>"."Caja: ".$ubicacion[0]["numero"]." Folder: ".$ubicacion[0]["etiqueta"]." Ubicada en: ".$ubicacion[0]["ubicacion"]." Estanteria: ".$ubicacion[0]["estanteria"]."</td>";
    echo "<td>".substr($solicitudes[$i]["fecha"],0,16)."</td>";
    echo "<td>Desde ".$solicitudes[$i]["fecha_inicial"]." Hasta ".$solicitudes[$i]["fecha_final"]."</td>";
    echo "</tr>";
  }
  ?>
</table>

<p>
<input type="submit" name="Action" value="Prestar" onclick="return enblanco(0)">
<input type="submit" name="Denegar" value="Denegar" onclick="return enblanco(1)">
<?php
}
else
  echo "NO HAY SOLICITUDES PARA EL DIA DE HOY";
?>
</form>
<?php include ("footer.php") ?>
<script>
/*
<Clase>
<Nombre>en blanco
<Parametros>opcion: indica si el prestamo se está aprobando o rechazando
<Responsabilidades>
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function enblanco(opcion)
{
  var arreglo = document.getElementsByName('documentos[]');
  for(var i=0; i<arreglo.length; i++)
  {
    if(arreglo[i].checked==1)
    {
      if(opcion==1)
        a_add.value='D';
      return true;
    }  
  }
  alert('No se ha seleccionado ningun documento');
  return false;
}
</script>

<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables
/*
<Clase>
<Nombre>AddData
<Parametros>$conn: conexion activa con la base de datos
<Responsabilidades>Actualiza la solicitud para indicar que el ejemplar ha sido entregado en prestamo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
  global $documentos;
  foreach($documentos as $prestar)
  {
    $sqlInsert = "UPDATE solicitud SET estado = 'APROBADO' WHERE idsolicitud = ".$prestar;
    phpmkr_query($sqlInsert, $conn);
  }
	return true;
}

/*
<Clase>
<Nombre>Niegue
<Parametros>$conn: conexion activa con la base de datos
<Responsabilidades>Actualiza la solicitud para indicar que el prestamo ha sido negado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function Niegue($conn)
{
  global $documentos;
  foreach($documentos as $prestar)
  {
    $sqlInsert = "UPDATE solicitud SET estado = 'DESCARTADO' WHERE idsolicitud = ".$prestar;
    phpmkr_query($sqlInsert, $conn);
  }
	return true;
}
?>
