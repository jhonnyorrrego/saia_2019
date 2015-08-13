<?php

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
$ewCurSec = 0; // Initialise
// Initialize common variables  
include_once("../db.php");
$x_observaciones = Null;
$x_idpaso_documento = @$_REQUEST["idpaso_documento"];
//$x_idactividad = @$_REQUEST["idactividad"];
$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".@$_REQUEST["idpaso_documento"],"",$conn);
if($paso_documento["numcampos"]){
  $x_idpaso = $paso_documento[0]["paso_idpaso"];
  $x_iddocumento = $paso_documento[0]["documento_iddocumento"];
  $x_iddiagram = $paso_documento[0]["diagram_iddiagram_instance"]; 
}
else{
  volver(1);
}
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
else{
	// Get fields from form
	$x_observaciones = @$_POST["x_observaciones"];
}
switch ($sAction){
	case "A": // Add
		if (AddData($conn)) { // Add New Record 
      alerta("El flujo ha sido cancelado");		
		}
		else{
      alerta("Existe un problema al tratar de cancelar el flujo, intentelo de nuevo");
    }
    abrir_url("mapeo_diagrama.php?idpaso_documento=".$x_idpaso_documento,"centro");
    exit();
	break;
}
include_once("../formatos/librerias/estilo_formulario.php"); 
?>
<script type="text/javascript" src="../ew.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script>
<?php //include_once("../anexosdigitales/funciones_archivo.php"); ?>
<!--script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script-->
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />    
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_observaciones && !EW_hasValue(EW_this.x_observaciones, "TEXTAREA" )) {
	if (!EW_onError(EW_this, EW_this.x_observaciones, "TEXT", "Por favor ingrese los campos requeridos - Observaciones"))
		return false;
}
return true;
}
//-->                                                      
</script>
<p><span class="internos"><img class="imagen_internos" src="../botones/configuracion/flujos.png" border="0">&nbsp;&nbsp;JUSTIFICACI&Oacute;N CANCELACI&Oacute;N DEL FLUJO<br><br><a href="actividades_paso_usuario.php?idpaso=<?php echo($x_idpaso);?>&diagrama=<?php echo($x_iddiagram); ?>&documento=<?php echo($x_iddocumento);?>&idpaso_documento=<?php echo($x_idpaso_documento); ?>">Regresar al listado</a></span></p>

<form name="terminar_actividad_paso_manual" id="terminar_actividad_paso_manual" action="terminar_flujo.php" method="POST" enctype="multipart/form-data" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Observaciones que justifican la terminacion manual de la actividad."><span class="phpmaker" style="color: #FFFFFF;">Observaciones</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea name="x_observaciones" id="x_observaciones" rows="10" cols="30" value="<?php echo htmlspecialchars(@$x_observaciones) ?>"></textarea>
</span></td>
	</tr>
  <!--tr> 
      <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td>
         <td bgcolor="#F5F5F5">
         <input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>
         <input type="file" name="anexos[]" class="multi" accept="<?php echo $extensiones;?>"></td>
      </tr-->
</table>
<input type="hidden" name="idpaso_documento" value="<?php echo($x_idpaso_documento);?>">
<input type="hidden" name="idactividad" value="<?php echo($x_idactividad);?>">
<input type="submit" name="Action" value="Adicionar">
</form>
<?php //include ("../footer.php") ;
/*

<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un cargo nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
global $x_observaciones,$x_idpaso_documento,$x_idactividad,$x_iddocumento;

	include_once("libreria_paso.php");
	$diagram = busca_filtro_tabla("","paso_documento","idpaso_documento=".$x_idpaso_documento,"",$conn);
	
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_observaciones) : $x_observaciones; 
  	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  	$fieldList["observaciones"] = $theValue;
	$fieldList["diagram_iddiagram_instance"] = $diagram[0]["diagram_iddiagram_instance"];
    $fieldList["documento_idpaso_documento"] = $x_idpaso_documento;
    $fieldList["funcionario_codigo"] = $_SESSION["usuario_actual"];
    $fieldList["fecha"] = fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
    $fieldList["estado_original"] = $diagram[0]["estado_paso_documento"];
    $fieldList["estado_final"] = 3;
    
  	// insert into database
  	$strsql = "INSERT INTO diagram_closed (";
  	$strsql .= implode(",", array_keys($fieldList));
  	$strsql .= ") VALUES (";
  	$strsql .= implode(",", array_values($fieldList));
  	$strsql .= ")";
	
  	phpmkr_query($strsql, $conn) or error("Fallo la busqueda" . phpmkr_error() . ' SQL:' . $strsql);
  	//die();
    /*if(isset($_REQUEST["permisos_anexos"]))
     $permisos=$_REQUEST["permisos_anexos"];
    else 
      $permisos=NULL;*/

    //-----------------Subiendo anexos-----------------------
    //subir_archivo($x_iddocumento);
	cancelar_flujo($x_idpaso_documento);
  	//cargar_archivo($doc,$permisos); // Sube los anexos digitales
  	return (true);
	/*}
	else 
	  return(false);*/
}

function subir_archivo($x_iddocumento){
    foreach ($_FILES as $archivos){
      for($i=0;$i<count($archivos["tmp_name"]);$i++){ 
            if(is_file($archivos["tmp_name"][$i])){
                $estado = busca_filtro_tabla("estado,".fecha_db_obtener('fecha','Y-m')." as fecha","documento","iddocumento=".$x_iddocumento,"",$conn);
                $valor = rand(0,999999999);
                $tipo = explode(".",$archivos["name"][$i]);
                $etiqueta = $tipo[0];
                $extension = $tipo[1];
                $ruta = '../../'.$estado[0]["estado"].'/'.$estado[0]["fecha"].'/'.$x_iddocumento.'/datos_flujo/';
                crear_destino($ruta); 

                $sql = "INSERT INTO paso_actividad_anexo (documento_iddocumento,etiqueta,ruta,tipo) values(".$x_iddocumento.",'".$etiqueta."','".$ruta.$valor.".".$extension."','".$extension."')";

                //echo $ruta." ".$sql."<br>";

                phpmkr_query($sql);
                copy($_FILES["anexos"]["tmp_name"][$i],$ruta.$valor.".".$extension);               

            }

        }

    }

}



?>

