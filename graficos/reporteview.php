<?php
$ewCurSec = 0; // Initialise
			
?>
<?php
// Initialize common variables
$x_idreporte = Null;
$x_nombre = Null;
$x_mascaras = Null;
$x_sql_reporte = Null;
$x_tipo_reporte = Null;
$x_nombre_archivo = Null;
$x_plantilla_idplantilla = Null;
$x_estado = Null;
$palabras_restringidas = array("delete","update","truncate","drop","alter"); 
?>
<?php include ("../db.php") ?>
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
	$x_idreporte = @$_POST["x_idreporte"];
	$x_nombre = @$_POST["x_nombre"];
  $x_mascaras = @$_POST["x_mascaras"];
  $x_sql_reporte = @$_POST["x_sql_reporte"];
  $x_tipo_reporte = @$_POST["x_tipo_reporte"];
  $x_nombre_archivo = @$_POST["x_nombre_archivo"];
  $x_plantilla_idplantilla = @$_POST["x_plantilla_idplantilla"];
  $x_estado = @$_POST["x_estado"];
  $texto_sql=@$_REQUEST["x_sql_reporte"];
  $texto2=strtolower(str_replace(" ","",$texto));
  for($i=0;$i<count($palabras_restringidas);$i++){
    if(strpos($texto2,@$palabras_restringidas[$i])){
      alerta("Acaba de ingresar una palabra restringida por favor ingrese de nuevo los datos sin las palabras ".explode("<br>",$palabras_restringidas));
      volver(1);
    }
  }
  
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			redirecciona("elegir_filtro.php?accion=listar");
			exit();
		}
		break;
	
}
?>
<?php include ("../header.php") ?>
<script type="text/javascript" src="../ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
$().ready(function() {
	// validar los campos del formato
	$('#reporteedit').validate();
	
});
</script>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" width=100%>
	<tr>
		<td class="encabezado" title="Nombre del nuevo reporte."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE*</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_nombre) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Codigo SQL del nuevo reporte. Ej: SELECT DISTINCT nombres,apellidos FROM funcionario WHERE estado=1"><span class="phpmaker" style="color: #FFFFFF;">SQL DEL REPORTE*</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_sql_reporte) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="nombre del archivo con que se va a guardar el reporte"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE ARCHIVO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_nombre_archivo) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Mascaras que se adaptan a tomar valores por defecto reemplazados en los valores del grafico asi: nombre_campo(resultado_sql_grafico)|valor_a_buscar@valor_a_reemplazar ejemplo: sql grafico->SELECT sexo FROM funcionario WHERE 1=1 el filtro queda: sexo|1@masculino!2@femenino asi cuando encuentre un 1 en el resultado de sexo lo cambiará por un masculino y cuando encuentre un 2 lo cambiara por femenino."><span class="phpmaker" style="color: #FFFFFF;">MASCARAS</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo $x_mascaras; ?>
      </span>
    </td>
	</tr>
	<!--tr>
		<td class="encabezado" title="formato en que se muestra el nuevo reporte"><span class="phpmaker" style="color: #FFFFFF;">FORMATO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="tipo de reporte"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE REPORTE</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
       
      </span>
    </td>
	</tr-->
	<tr>
		<td class="encabezado" title="Estado del nuevo reporte."><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5">
     <?php
       if($x_estado)
         echo "Activo";
       else
         echo "Inactivo";  
       ?>
    </td>
	</tr>
</table>
<script>
document.getElementById("header").style.display="none";
</script>
<?php include ("../footer.php") ?>
<?php

/*
<Clase>
<Nombre>LoadData
<Parametros>sKey-id del reporte a buscar;conn-objeto de conexion con la base de datos
<Responsabilidades>Verificar si un reporte existe o no en la bd
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LoadData($sKey,$conn)
{
global $x_nombre ,$x_etiqueta ,$x_etiquetax ,$x_etiquetay ,$x_sql_reporte ,$x_tipo_reporte ,$x_nombre_archivo ,$x_plantilla_idplantilla ,$x_mascaras ,$x_precision ,$x_prefijo ,$x_estado ,$x_modulo_idmodulo,$x_direccion_titulo;
$fila=busca_filtro_tabla("","reporte","idreporte=".$sKey,"",$conn);
if($fila["numcampos"]){
  $x_nombre = $fila[0]["nombre"];
  $x_mascaras = $fila[0]["mascaras"];
  $x_sql_reporte = $fila[0]["sql_reporte"];
  $x_tipo_reporte = $fila[0]["tipo_reporte"];
  $x_nombre_archivo = $fila[0]["nombre_archivo"];
  $x_plantilla_idplantilla = $fila[0]["plantilla_idplantilla"];
  $x_estado = $fila[0]["estado"];
  return(TRUE);
}
return(FALSE);
}

?>
