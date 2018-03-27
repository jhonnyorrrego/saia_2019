<?php
$ewCurSec = 0; // Initialise

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}


// Initialize common variables
$x_idreporte = Null;
$x_nombre = Null;
$x_etiqueta= Null;
$x_etiquetax = Null;
$x_etiquetay = Null;
$x_sql_reporte = Null;
$x_tipo_reporte = Null;
$x_nombre_archivo = Null;
$x_plantilla_idplantilla = Null;
$x_mascaras = Null;
$x_precision = Null;
$x_prefijo = Null;
$x_estado = Null;
$x_modulo_idmodulo = Null;
$palabras_restringidas = array("delete","update","truncate","drop","alter"); 
$x_direccion_titulo= Null;


include ($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idreporte","x_modulo_idmodulo","x_plantilla_idplantilla");
include_once($ruta_db_superior."librerias_saia.php");
$validar_enteros=array("key");
desencriptar_sqli('form_info');
echo(librerias_jquery());
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
  $x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];
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
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
$().ready(function() {
	// validar los campos del formato
	$('#reporteedit').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("reporteedit",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
	});
	
});
</script>
<p><span class="internos">
<img class="../imagen_internos" src="../botones/configuracion/reporte.png" border="0">&nbsp;&nbsp;ADICIONAR REPORTES<br><br>
<a id='link_volver' href='listado_graficas.php'>VOLVER A GRAFICAS Y REPORTES</a>&nbsp;&nbsp;<a id='link_volver' href='elegir_filtro.php?accion=listar'>ADMINISTRACION GRAFICOS Y REPORTES</a></span>
</p>
<form name="reporteedit" id="reporteedit" action="reporteedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo reporte."><span class="phpmaker" style="color: #FFFFFF;">NOMBRE*</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>" class="required">
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="Codigo SQL del nuevo reporte. Ej: SELECT DISTINCT nombres,apellidos FROM funcionario WHERE estado=1"><span class="phpmaker" style="color: #FFFFFF;">SQL DEL REPORTE*</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <textarea  name="x_sql_reporte" id="x_sql_reporte"  cols="35" rows="10"  class="required"><?php echo htmlspecialchars(@$x_sql_reporte) ?></textarea>
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado" title="nombre del archivo con que se va a guardar el reporte"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE ARCHIVO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="text" class="required" name="x_nombre_archivo" id="x_nombre_archivo" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre_archivo) ?>">
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
	<tr>
		<td class="encabezado" title="Estado del nuevo reporte."><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type=radio name="x_estado" value="1" id="estado1" checked><label for="estado1">Activo</label> 
        <input type=radio name="x_estado" value="0" id="estado0" ><label for="estado0">Inactivo</label>
      </span>
    </td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Guardar"> 
<input type="hidden" name="idreporte" value="<?php echo $_REQUEST["key"];?>">
</form>
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
  $x_sql_reporte = $fila[0]["sql_reporte"];
  $x_mascaras = $fila[0]["mascaras"];
  $x_modulo_idmodulo = $fila[0]["modulo_idmodulo"];
  $x_nombre_archivo = $fila[0]["nombre_archivo"];
  //$x_plantilla_idplantilla = $fila[0]["plantilla_idplantilla"];
  $x_estado = $fila[0]["estado"];
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
<Responsabilidades>insertar los datos de un reporte nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
global $x_nombre ,$x_etiqueta ,$x_etiquetax ,$x_etiquetay ,$x_sql_reporte ,$x_tipo_reporte ,$x_nombre_archivo ,$x_plantilla_idplantilla ,$x_mascaras ,$x_precision ,$x_prefijo ,$x_estado ,$x_modulo_idmodulo, $x_direccion_titulo;
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = "nombre=".$theValue;

 	
  $theValue = str_replace("'","''",stripslashes($x_sql_reporte)); 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["sql_reporte"] = "sql_reporte=".$theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_mascaras) : $x_mascaras; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["mascaras"] = "mascaras=".$theValue;      
	
	$theValue = $x_nombre_archivo;
	$fieldList["nombre_archivo"] = "nombre_archivo= '" . $theValue . "'" ;
	                                                
  $theValue = ($x_estado != "") ? intval($x_estado) : 1;
	$fieldList["estado"] = "estado=".$theValue;
  
  $theValue = ($x_modulo_idmodulo != "") ? intval($x_modulo_idmodulo) : 0;
	$fieldList["modulo_idmodulo"] = "modulo_idmodulo=".$theValue;
 
	// insert into database
	$strsql = "UPDATE reporte SET ";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= " WHERE idreporte=".$_REQUEST["idreporte"];
	//die($strsql);
	phpmkr_query($strsql, $conn);

    return true;  
}
?>
