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
$x_direccion_titulo =Null;
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
  $x_direccion_titulo=@$_REQUEST["x_direccion_titulo"];
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
			alerta("Edici�n exitosa del registro");
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
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - nombre"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="internos">
<img class="../imagen_internos" src="../botones/configuracion/grafico.png" border="0">&nbsp;&nbsp;ADICIONAR GRAFICOS<br><br>
<a id='link_volver' href='listado_graficos.php'>VOLVER A GRAFICOS Y REPORTES</a>&nbsp;&nbsp;<a id='link_volver' href='elegir_filtro.php?accion=listar'>ADMINISTRACION GRAFICOS Y REPORTES</a></span>
</p>
<form name="graficoadd" id="graficoadd" action="graficoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_etiqueta" id="x_etiqueta" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del eje X para el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA X</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_etiquetax" id="x_etiquetax" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_etiquetax) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Etiqueta del eje Y para el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ETIQUETA Y</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_etiquetay" id="x_etiquetay" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_etiquetay) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Codigo SQL del nuevo grafico. 
Debe poseer una mascara valor y un llamada dato en cada uno de los campos qeu se desean implementar ej: SELECT DISTINCT count(A.iddocumento) AS valor,A.estado AS dato FROM documento A,ft_factura B WHERE B.documento_iddocumento=A.iddocumento GROUP BY dato, en este caso se desean contar el numero de Facturas (eje y) agrupadas por estado(eje x)"><span class="phpmaker" style="color: #FFFFFF;">SQL DEL GRAFICO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <textarea  name="x_sql_grafico" id="x_sql_grafico"  cols="35" rows="10" ><?php echo htmlspecialchars(@$x_sql_grafico) ?></textarea>
      </span>
    </td>
	</tr>
		<tr>
		<td class="encabezado" title="Tipo por defecto en que se va a mostrar el nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">TIPO DE  GRAFICO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type=radio name="x_tipo_grafico" value="Column2D" id="Column2D"><label for="tipo_grafico_barra">BARRA</label> 
        <input type=radio name="x_tipo_grafico" value="Column3D" id="Column3D"><label for="tipo_grafico_barra">BARRA 3D</label> 
        <input type=radio name="x_tipo_grafico" value="Pie2D" id="Pie2D"><label for="tipo_grafico_torta">TORTA</label>
        <input type=radio name="x_tipo_grafico" value="Pie3D" id="Pie3D" checked><label for="tipo_grafico_torta">TORTA 3D</label> <br>
        <input type=radio name="x_tipo_grafico" value="Line" id="Line"><label for="tipo_grafico_torta">LINEA</label>
        <input type=radio name="x_tipo_grafico" value="Area2D" id="Area2D"><label for="tipo_grafico_torta">AREA</label>
       <script>
       document.getElementById('<?php echo @$x_tipo_grafico; ?>').checked=true;
      </script>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Ancho en que se muestra el nuevo grafico en pixeles."><span class="phpmaker" style="color: #FFFFFF;">ANCHO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_ancho" id="x_ancho" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_ancho) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Alto en que se muestra el nuevo grafico en pixeles."><span class="phpmaker" style="color: #FFFFFF;">ALTO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_alto" id="x_alto" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_alto) ?>">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Mascaras que se adaptan a tomar valores por defecto reemplazados en los valores del grafico asi: nombre_campo(resultado_sql_grafico)|valor_a_buscar@valor_a_reemplazar ejemplo: sql grafico->SELECT sexo FROM funcionario WHERE 1=1 el filtro queda: sexo|1@masculino!2@femenino asi cuando encuentre un 1 en el resultado de sexo lo cambiar� por un masculino y cuando encuentre un 2 lo cambiara por femenino."><span class="phpmaker" style="color: #FFFFFF;">MASCARAS</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <textarea id="x_mascaras" name="x_mascaras" cols="35" rows="10"><?php echo $x_mascaras; ?></textarea>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Direccion de los titulos en el eje X"><span class="phpmaker" style="color: #FFFFFF;">DIRECCI&Oacute;N DE LOS TITULOS EN EL EJE X</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type=radio name="x_direccion_titulo" value="1" id="x_direccion_titulo1"<?php if($x_direccion_titulo==1) echo('checked');?>><label for="x_direccion_titulo1">Vertical</label> 
        <input type=radio name="x_direccion_titulo" value="0" id="x_direccion_titulo2" <?php if($x_direccion_titulo==0) echo('checked');?>><label for="x_direccion_titulo2">Horizontal</label>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Estado del nuevo grafico."><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">  
        <input type=radio name="x_estado" value="1" id="estado1" <?php if($x_estado==1) echo "checked"; ?>><label for="estado1">Activo</label> 
        <input type=radio name="x_estado" value="0" id="estado0" <?php if($x_estado==0) echo "checked"; ?>><label for="estado0">Inactivo</label>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Asociar el modulo con el nuevo grafico, al otorgar permisos sobre el modulo se le da permiso de acceso al grafico acceso al grafico."><span class="phpmaker" style="color: #FFFFFF;">MODULO</span></td>
		<td bgcolor="#F5F5F5">
		  <?php
        $modulos=busca_filtro_tabla("","modulo","1=1","etiqueta",$conn);
        $cadena='<select name="x_modulo_idmodulo" id="x_modulo_idmodulo" >';
        $cadena.='<option value="0" selected>Ninguno</option>';
        for($i=0;$i<$modulos["numcampos"];$i++){
          {$cadena.='<option value="'.$modulos[$i]["idmodulo"].'" ';
           if($modulos[$i]["idmodulo"]==$x_modulo_idmodulo)
              $cadena.=" selected ";
           $cadena.='>'.$modulos[$i]["etiqueta"].' ('.$modulos[$i]["nombre"].')'.'</option>';
          } 
        }
        $cadena.="</select>";
        echo($cadena);
      ?>
    </td>
	</tr>	
</table>
<p>
<input type="submit" name="Action" value="Guardar"> <input type="hidden" name="idgrafico" value="<?php echo $_REQUEST["key"];?>">
</form>
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
global $x_nombre ,$x_etiqueta ,$x_etiquetax ,$x_etiquetay ,$x_sql_grafico ,$x_tipo_grafico ,$x_ancho ,$x_alto ,$x_mascaras ,$x_precision ,$x_prefijo ,$x_estado ,$x_modulo_idmodulo,$x_direccion_titulo;
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
  $x_direccion_titulo = $fila[0]["direccion_titulo"];
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
function AddData($conn)
{
global $x_nombre ,$x_etiqueta ,$x_etiquetax ,$x_etiquetay ,$x_sql_grafico ,$x_tipo_grafico ,$x_ancho ,$x_alto ,$x_mascaras ,$x_precision ,$x_prefijo ,$x_estado ,$x_modulo_idmodulo, $x_direccion_titulo;
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = "nombre=".$theValue;

  $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta"] = "etiqueta=".$theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiquetax) : $x_etiquetax; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiquetax"] = "etiquetax=".$theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiquetay) : $x_etiquetay; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiquetay"] = "etiquetay=".$theValue;
	
  $theValue = str_replace("'","''",stripslashes($x_sql_grafico));
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["sql_grafico"] = "sql_grafico=".$theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo_grafico) : $x_tipo_grafico; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["tipo_grafico"] = "tipo_grafico=".$theValue;
	
	$theValue = ($x_ancho != "") ? intval($x_ancho) : 200;
	$fieldList["ancho"] = "ancho=".$theValue;

	$theValue = ($x_alto != "") ? intval($x_alto) : 200;
	$fieldList["alto"] = "alto=".$theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_mascaras) : $x_mascaras; 
	$theValue = ($theValue != "") ?  " '" .$theValue." '"   : "NULL";
	$fieldList["mascaras"] = "mascaras=".$theValue;
	
  $theValue = ($x_modulo_idmodulo != "") ? intval($x_modulo_idmodulo) : 0;
	$fieldList["modulo_idmodulo"] = "modulo_idmodulo=".$theValue;
	
  $theValue = ($x_estado != "") ? intval($x_estado) : 1;
	$fieldList["estado"] = "estado=".$theValue;
	  
  $theValue = ($x_direccion_titulo != "") ? intval($x_direccion_titulo) : 1;
	$fieldList["direccion_titulo"] = 'direccion_titulo='.$theValue;


	// insert into database
	$strsql = "UPDATE grafico set ";
	$strsql .= implode(",", array_values($fieldList));
  $strsql .=" WHERE idgrafico=".$_REQUEST["idgrafico"];

	phpmkr_query($strsql, $conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $strsql);
//	die($strsql);
	return true;
}
?>
