<?php
$ewCurSec = 0; // Initialise
			
?>
<?php

// Initialize common variables
$x_idgrafico = Null;
$x_nombre = Null;
$x_etiqueta= Null;
$x_etiquetax = Null;
$x_etiquetay = Null;
$x_sql_grafico = Null;
$x_tipo_grafico = Null;
$x_ancho = Null;
$x_alto = Null;
$x_mascaras = Null;
$x_precision = Null;
$x_prefijo = Null;
$x_estado = Null;
$x_modulo_idmodulo = Null;
$palabras_restringidas = array("delete","update","truncate","drop","alter"); 
?>
<?php include ("../db.php") ?>
<?php include ("../phpmkrfn.php") ?>
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
	$x_idgrafico = @$_POST["x_idgrafico"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta= @$_POST["x_etiqueta"];
  $x_etiquetax = @$_POST["x_etiquetax"];
  $x_etiquetay = @$_POST["x_etiquetay"];
  $x_sql_grafico = @$_POST["x_sql_grafico"];
  $x_tipo_grafico = @$_POST["x_tipo_grafico"];
  $x_ancho = @$_POST["x_ancho"];
  $x_alto = @$_POST["x_alto"];
  $x_mascaras = @$_POST["x_mascaras"];
  $x_precision = @$_POST["x_precsion"];
  $x_prefijo = @$_POST["x_prefijo"];
  $x_estado = @$_POST["x_estado"];
  $x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];
  $texto_sql=$_REQUEST["x_sql_grafico"];
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
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			alerta("Adici�n exitosa del registro");
			redirecciona("elegir_filtro.php?accion=listar");
			exit();
		}
		break;
}
?>
<?php include ("../header.php") ?>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
      <?php echo htmlspecialchars(@$x_nombre) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_etiqueta) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del eje X para el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA X</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
       <?php echo htmlspecialchars(@$x_etiquetax) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del eje Y para el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA Y</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_etiquetay) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Codigo SQL del nuevo grafico. 
Debe poseer una mascara valor y un llamada dato en cada uno de los campos qeu se desean implementar ej: SELECT DISTINCT count(A.iddocumento) AS valor,A.estado AS dato FROM documento A,ft_factura B WHERE B.documento_iddocumento=A.iddocumento GROUP BY dato, en este caso se desean contar el numero de Facturas (eje y) agrupadas por estado(eje x)"><span class="phpmaker" style="color: #FFFFFF;">SQL DEL GRAFICO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_sql_grafico) ?>
      </span>
    </td>
	</tr>
		<tr>
		<td class="encabezado" title="Tipo por defecto en que se va a mostrar el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">TIPO DE  GRAFICO</span></td>
		<td bgcolor="#F5F5F5"> <span class="phpmaker">
		<?php
    $tipos=array("Column2D"=>"BARRA","Column3D"=>"BARRA 3D","Pie2D"=>"TORTA","Pie3D"=>"TORTA 3D","Line"=>"LINEA","Area2D"=>"AREA");
    echo $tipos[$x_tipo_grafico];
    ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Ancho en que se muestra el nuevo grafico en pixeles."><span class="phpmaker" style="color: #FFFFFF;">ANCHO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_ancho) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Alto en que se muestra el nuevo grafico en pixeles."><span class="phpmaker" style="color: #FFFFFF;">ALTO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo htmlspecialchars(@$x_alto) ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Mascaras que se adaptan a tomar valores por defecto reemplazados en los valores del grafico asi: nombre_campo(resultado_sql_grafico)|valor_a_buscar@valor_a_reemplazar ejemplo: sql grafico->SELECT sexo FROM funcionario WHERE 1=1 el filtro queda: sexo|1@masculino!2@femenino asi cuando encuentre un 1 en el resultado de sexo lo cambiar� por un masculino y cuando encuentre un 2 lo cambiara por femenino."><span class="phpmaker" style="color: #FFFFFF;">MASCARAS</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php echo $x_mascaras; ?>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">  
       <?php
       if($x_estado)
         echo "Activo";
       else
         echo "Inactivo";  
       ?>
      </span>
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
<Parametros>sKey-id del grafico a buscar;conn-objeto de conexion con la base de datos
<Responsabilidades>Verificar si un grafico existe o no en la bd
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function LoadData($sKey,$conn)
{
global $x_nombre ,$x_etiqueta ,$x_etiquetax ,$x_etiquetay ,$x_sql_grafico ,$x_tipo_grafico ,$x_ancho ,$x_alto ,$x_mascaras ,$x_precision ,$x_prefijo ,$x_estado ,$x_modulo_idmodulo;
$fila=busca_filtro_tabla("","grafico","idgrafico=".$sKey,"",$conn);
if($fila["numcampos"]){
  $x_nombre = $fila[0]["nombre"];
  $x_etiqueta= codifica_encabezado(html_entity_decode($fila[0]["etiqueta"]));
  $x_etiquetax = codifica_encabezado(html_entity_decode($fila[0]["etiquetax"]));
  $x_etiquetay = codifica_encabezado(html_entity_decode($fila[0]["etiquetay"]));
  $x_sql_grafico = stripslashes($fila[0]["sql_grafico"]);
  $x_tipo_grafico = $fila[0]["tipo_grafico"];
  $x_ancho = $fila[0]["ancho"];
  $x_alto = $fila[0]["alto"];
  $x_mascaras = $fila[0]["mascaras"];
  $x_precision = $fila[0]["precision"];
  $x_prefijo = $fila[0]["prefijo"];
  $x_estado = $fila[0]["estado"];
  $x_modulo_idmodulo = $fila[0]["modulo_idmodulo"];
  return(TRUE);
}
return(FALSE);
}
?>
<?php

/*
<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un grafico nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

?>
